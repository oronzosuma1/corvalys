<?php

namespace App\Services;

use App\Models\Lead;
use Illuminate\Support\Facades\Http;

class ClaudeService
{
    private string $apiKey;
    private string $model = 'claude-sonnet-4-20250514';
    private string $baseUrl = 'https://api.anthropic.com/v1/messages';

    public function __construct()
    {
        $this->apiKey = config('claude.api_key');

        // Fallback: if env var was pre-set as empty in the system,
        // Laravel's Dotenv (immutable) won't override it. Read .env directly.
        if (empty($this->apiKey) && file_exists(base_path('.env'))) {
            $envContent = file_get_contents(base_path('.env'));
            if (preg_match('/^ANTHROPIC_API_KEY=(.+)$/m', $envContent, $matches)) {
                $this->apiKey = trim($matches[1]);
            }
        }

        if (empty($this->apiKey)) {
            throw new \RuntimeException('ANTHROPIC_API_KEY is not configured. Set it in your .env file.');
        }
    }

    public function generateQuotation(array $answers, string $clientDescription): array
    {
        $tariffe = config('corvalys.tariffe');
        $prompt = $this->buildQuotationPrompt($answers, $clientDescription, $tariffe);

        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
            'anthropic-version' => '2023-06-01',
            'content-type' => 'application/json',
        ])->timeout(30)->post($this->baseUrl, [
            'model' => $this->model,
            'max_tokens' => 1500,
            'messages' => [['role' => 'user', 'content' => $prompt]],
        ]);

        if ($response->failed()) {
            throw new \Exception('Claude API error: ' . $response->body());
        }

        $text = $response->json('content.0.text');
        $clean = preg_replace('/```json|```/', '', trim($text));

        return json_decode($clean, true) ?? throw new \Exception('Invalid JSON from Claude');
    }

    public function autoAssessLead(Lead $lead): array
    {
        $tariffe = config('corvalys.tariffe');
        $prompt = $this->buildAutoAssessPrompt($lead, $tariffe);

        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
            'anthropic-version' => '2023-06-01',
            'content-type' => 'application/json',
        ])->timeout(45)->post($this->baseUrl, [
            'model' => $this->model,
            'max_tokens' => 2000,
            'messages' => [['role' => 'user', 'content' => $prompt]],
        ]);

        if ($response->failed()) {
            throw new \Exception('Claude API error: ' . $response->body());
        }

        $text = $response->json('content.0.text');
        $clean = preg_replace('/```json|```/', '', trim($text));

        return json_decode($clean, true) ?? throw new \Exception('Invalid JSON from Claude auto-assess');
    }

    private function buildAutoAssessPrompt(Lead $lead, array $tariffe): string
    {
        $techItems = collect([
            'ERP' => $lead->uses_erp ? 'Si' . ($lead->erp_name ? " ({$lead->erp_name})" : '') : 'No',
            'Excel' => $lead->uses_excel ? 'Si' : 'No',
            'Database' => $lead->uses_database ? 'Si' . ($lead->database_name ? " ({$lead->database_name})" : '') : 'No',
            'Team IT' => $lead->has_it_team ? 'Si' . ($lead->it_team_size ? " ({$lead->it_team_size} persone)" : '') : 'No',
            'Cloud' => $lead->uses_cloud ? 'Si' . ($lead->cloud_provider ? " ({$lead->cloud_provider})" : '') : 'No',
            'API integrations' => $lead->has_api_integrations ? 'Si' : 'No',
            'Uso AI attuale' => $lead->current_ai_usage ?? 'none',
        ])->map(fn($v, $k) => "- {$k}: {$v}")->implode("\n");

        $tariffeText = collect($tariffe)
            ->map(fn($t, $k) => "- {$k}: {$t['min']}-{$t['max']} EUR/h")
            ->implode("\n");

        return <<<PROMPT
Sei l'assistente AI di Corvalys (consulenza AI & software). Devi fare un assessment automatico iniziale di fattibilita per un nuovo lead.

Tariffe orarie base:
{$tariffeText}

INFORMAZIONI LEAD:
Nome: {$lead->name}
Azienda: {$lead->company}
Settore: {$lead->industry}
Dimensione azienda: {$lead->company_size}
Paese: {$lead->country}
Website: {$lead->website}

Servizio richiesto: {$lead->service_type}
Descrizione progetto: {$lead->project_description}
Pain points: {$lead->pain_points}
Risultati attesi: {$lead->expected_outcomes}
Timeline desiderata: {$lead->desired_timeline}
Budget: {$lead->budget_range}
Volume mensile: {$lead->monthly_volume}

MATURITA TECNOLOGICA (Score: {$lead->tech_maturity_score}/10 - {$lead->getTechMaturityLabel()}):
{$techItems}

Genera SOLO JSON valido con questo schema esatto:
{
  "estimated_hours_min": <int>,
  "estimated_hours_max": <int>,
  "estimated_cost_min": <int EUR>,
  "estimated_cost_max": <int EUR>,
  "hourly_rate": <int EUR/h media>,
  "complexity": <1-5>,
  "feasibility": "<alta|media|bassa>",
  "recommended_service_type": "<string>",
  "tech_readiness_assessment": "<string breve>",
  "suggested_approach": "<string, max 200 parole>",
  "risks": ["<risk1>", "<risk2>", ...],
  "next_steps": ["<step1>", "<step2>", ...]
}
PROMPT;
    }

    private function buildQuotationPrompt(array $a, string $desc, array $tariffe): string
    {
        return <<<PROMPT
Sei l'assistente di quotazione privato di Enzo, AI engineer e consulente.
Competenze: Agentic AI (Claude, Ollama, multi-agent), Supply Chain (MDVRP, routing), Backend (FastAPI, Laravel, Python, PostgreSQL), AI Act compliance, Industry 4.0, finanza quantitativa. Lavora principalmente da solo.

Tariffe orarie base:
- strategy: {$tariffe['strategy']['min']}-{$tariffe['strategy']['max']} EUR/h
- development: {$tariffe['development']['min']}-{$tariffe['development']['max']} EUR/h
- compliance: {$tariffe['compliance']['min']}-{$tariffe['compliance']['max']} EUR/h
- supplychain: {$tariffe['supplychain']['min']}-{$tariffe['supplychain']['max']} EUR/h
- industry40: {$tariffe['industry40']['min']}-{$tariffe['industry40']['max']} EUR/h
- llm: {$tariffe['llm']['min']}-{$tariffe['llm']['max']} EUR/h

Valutazione di Enzo:
Tipo servizio: {$a['service_type']}
Settore: {$a['sector']}
Complessità tecnica (1-5): {$a['complexity']}
Familiarità dominio: {$a['domain_expertise']}
Output richiesto: {$a['output_type']}
Timeline: {$a['timeline']}
Stima ore: {$a['hours_estimate']}
Team cliente: {$a['client_team']}
Budget vs stima: {$a['budget_alignment']}
Chiarezza scope: {$a['scope_clarity']}
Rischi: {$a['risk_flags']}
Note di Enzo: {$a['notes']}

Descrizione originale del cliente: {$desc}

Genera SOLO JSON valido con schema:
{"min_eur", "max_eur", "hours_min", "hours_max", "hourly_rate", "confidence", "contract_type", "breakdown":{"analisi","sviluppo","pm","testing"}, "warnings":[...], "strengths":[...], "negotiation_notes", "proposal_highlights"}
PROMPT;
    }
}
