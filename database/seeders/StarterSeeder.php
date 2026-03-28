<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Page;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StarterSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::firstOrCreate(
            ['email' => 'enzo@corvalys.eu'],
            [
                'name' => 'Enzo',
                'password' => Hash::make('cambia-questa-password'),
                'is_admin' => true,
            ]
        );

        // Article 1 - AI Act
        Article::firstOrCreate(
            ['slug' => 'ai-act-pmi-obblighi-2026'],
            [
                'title' => 'AI Act 2026: cosa devono fare le PMI italiane entro agosto',
                'category' => 'ai-act',
                'excerpt' => "Dal 2 agosto 2026 l'AI Act europeo diventa obbligatorio anche per le PMI che usano strumenti AI. Ecco cosa fare adesso.",
                'reading_time_min' => 6,
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'body' => <<<'MD'
## Chi è un deployer AI?

Ogni azienda che usa ChatGPT, un CRM con AI, o qualsiasi SaaS con funzionalità intelligenti è classificata come **deployer** sotto l'AI Act europeo.

Questo significa che anche la tua PMI, se usa uno di questi strumenti, ha degli obblighi legali a partire dal 2 agosto 2026.

## Le scadenze che contano

- **2 febbraio 2025**: obblighi di AI literacy già in vigore
- **2 agosto 2025**: obblighi per i modelli GPAI (provider come OpenAI, Anthropic)
- **2 agosto 2026**: DEADLINE PRINCIPALE — Annex III e Art. 50 trasparenza

## Cosa deve fare una PMI deployer

**Passo 1 — Inventario**: elenca tutti gli strumenti AI in uso nella tua azienda. Include CRM, chatbot, tool di marketing, assistenti di scrittura, analisi dati.

**Passo 2 — Classificazione**: per ciascuno, valuta se impatta persone in modo significativo. Un chatbot che risponde ai clienti? Probabile rischio medio. Un tool che analizza CV? Alto rischio.

**Passo 3 — Policy**: crea una policy interna di uso dell'AI. Chi può usare cosa, con quali limiti, come si gestiscono i dati.

**Passo 4 — Formazione**: documenta che il team sa usare gli strumenti. Non basta "mandarli a un corso" — serve evidenza tracciabile.

**Passo 5 — Verifica vendor**: chiedi ai tuoi fornitori SaaS se sono conformi all'AI Act. Se non lo sanno, è un red flag.

## Le sanzioni per le PMI

Per una PMI con EUR 2M di fatturato, la sanzione massima (con riduzione PMI) è circa EUR 30.000. Non è certezza di multa, ma è un rischio reale che può essere evitato con una preparazione adeguata.

## Come Corvalys aiuta

Il Tool C di Corvalys AI Desk genera automaticamente l'inventario AI, la risk classification e la policy interna. [Scopri il piano Pro](/prezzi).

Non aspettare agosto 2026. [Contattaci](/contatto) per un assessment gratuito della tua situazione.
MD,
            ]
        );

        // Article 2 - Payments
        Article::firstOrCreate(
            ['slug' => 'ritardi-pagamenti-pmi-automazione'],
            [
                'title' => 'Le PMI italiane perdono 9,85 ore a settimana inseguendo fatture',
                'category' => 'ai-pmi',
                'excerpt' => "I dati EU Payment Observatory 2025 mostrano una crisi silenziosa di liquidità. L'automazione AI può cambiare questa equazione.",
                'reading_time_min' => 5,
                'is_published' => true,
                'published_at' => now()->subDays(12),
                'body' => <<<'MD'
## Il problema in numeri

Secondo l'EU Payment Observatory Annual Report 2025:

- **52%** delle imprese europee ha avuto problemi per ritardi nei pagamenti nel 2024
- **9,85 ore/settimana** spese in media a inseguire pagamenti
- **EUR 100 miliardi** di cash flow annuo bloccato in ritardi
- Tempi medi B2B: **60,3 giorni** (legge: max 30-60 giorni)

Questi numeri raccontano una storia di inefficienza sistemica che colpisce soprattutto le PMI, che hanno meno risorse per gestire il ciclo attivo.

## Perché succede

Le PMI usano email, fogli Excel, promemoria manuali. Nessun sistema automatico di monitoraggio. Risultato: le fatture scadono senza che nessuno le abbia viste.

Il problema non è la volontà — è la visibilità. Quando gestisci 50-200 fatture al mese con strumenti manuali, qualcosa sfugge sempre.

## La soluzione: delegare a un AI Cash Controller

Un sistema AI può gestire l'intero ciclo: ricezione fattura → classificazione → monitoraggio scadenze → sollecito automatico → escalation se non pagato.

Il Tool A di Corvalys fa esattamente questo. Ogni mattina ti prepara un brief con tre informazioni: cosa devi pagare, cosa devi incassare, cosa è a rischio.

## I risultati attesi

- Riduzione ore su pagamenti: da 9,85 a meno di 3 ore/settimana (>70%)
- Rilevamento scadenze: 0 fatture scadute non identificate
- DSO migliorato: riduzione media 15-20% nei giorni di incasso

[Prova il Tool A di Corvalys — 3 mesi gratis](/prezzi).
MD,
            ]
        );

        // Article 3 - Agentic AI
        Article::firstOrCreate(
            ['slug' => 'agentic-ai-sistemi-multi-agente-pmi'],
            [
                'title' => 'Agentic AI per PMI: cosa sono i sistemi multi-agente',
                'category' => 'supply-chain',
                'excerpt' => "I sistemi multi-agente sono la prossima frontiera dell'AI aziendale. Spieghiamo cosa sono e perché cambieranno il modo in cui le PMI lavorano.",
                'reading_time_min' => 7,
                'is_published' => true,
                'published_at' => now()->subDays(20),
                'body' => <<<'MD'
## Cosa è un agente AI

Un agente AI è un sistema che può: percepire un contesto, prendere decisioni, eseguire azioni, e adattarsi ai risultati. Non è solo un chatbot — è un collaboratore autonomo con obiettivi specifici.

La differenza chiave rispetto a un chatbot è l'autonomia: un agente non aspetta che tu gli faccia una domanda. Monitora, analizza e agisce proattivamente.

## Sistemi multi-agente

Quando più agenti AI collaborano su un compito complesso si parla di sistema multi-agente. Ogni agente ha una specializzazione e comunica con gli altri per completare un workflow end-to-end.

Pensalo come un team di specialisti, ciascuno con un ruolo preciso, che si coordinano automaticamente.

## Un caso reale (anonimizzato)

Per un cliente nel settore trasporti aereo ho costruito un sistema con 4 agenti specializzati:

1. **Extraction agent** (Ollama/Qwen): estrae dati da PDF e email di fatture
2. **Validation agent** (regole business): controlla coerenza, duplicati, importi
3. **Classification agent** (categorie budget): assegna centro di costo e categoria
4. **Notification agent** (email + audit trail): informa il team contabile e registra tutto

Risultato: da 4 ore/giorno di lavoro manuale a 15 minuti di review umana. Il sistema processa 200+ documenti al giorno con un tasso di errore inferiore all'1%.

## Quando ha senso per una PMI

Multi-agente ha senso quando:

- Il processo ha più fasi distinte con logica diversa
- Ogni fase richiede competenze o dati differenti
- Il volume è alto (>50 documenti/giorno)
- Gli errori umani sono frequenti e costosi
- Serve un audit trail completo

## Come iniziare

Il punto di partenza è un'analisi del processo esistente. Non serve partire con un sistema complesso — spesso il primo agente da implementare è quello che elimina il task più ripetitivo.

[Contattami](/contatto) per una valutazione gratuita iniziale.
MD,
            ]
        );

        // ── Products (Prodotti) ──────────────────────────────────────

        Service::firstOrCreate(
            ['slug' => 'cash-controller'],
            [
                'type' => 'prodotto',
                'name' => 'AI Cash Controller',
                'short_description' => 'Your AI assistant for cash flow management. Monitors invoices, sends automatic reminders, and prepares a daily morning brief.',
                'description' => <<<'MD'
## Funzionalità principali

- **Morning Brief giornaliero**: ogni mattina ricevi un riepilogo con fatture in scadenza, incassi attesi e situazioni critiche
- **Monitoraggio automatico fatture**: traccia tutte le fatture attive e passive con alert intelligenti
- **Solleciti automatici**: invio automatico di reminder ai clienti con ritardi, personalizzati per tono e urgenza
- **Dashboard cash flow**: visione in tempo reale della liquidità aziendale
- **Classificazione intelligente**: categorizzazione automatica delle fatture per centro di costo

## Come funziona

1. **Connessione**: colleghi il tuo gestionale o carichi le fatture via email/CSV
2. **Analisi**: l'AI analizza scadenze, pattern di pagamento e rischi
3. **Azione**: solleciti automatici, brief giornalieri e alert proattivi
4. **Ottimizzazione**: il sistema impara dai tuoi dati e migliora nel tempo

## Per chi è

- PMI con 50-500 fatture/mese che vogliono ridurre i tempi di incasso
- Studi professionali che gestiscono la contabilità di più clienti
- CFO e responsabili amministrativi che vogliono visibilità in tempo reale sul cash flow
MD,
                'price_from' => 49,
                'price_to' => null,
                'price_unit' => 'mese',
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'approval-coordinator'],
            [
                'type' => 'prodotto',
                'name' => 'AI Approval Coordinator',
                'short_description' => 'Manages the document approval workflow with a complete audit trail. No more lost approvals via WhatsApp.',
                'description' => <<<'MD'
## Funzionalità principali

- **Workflow di approvazione configurabili**: definisci chi approva cosa, con quanti livelli e in quale ordine
- **Audit trail completo**: ogni azione è tracciata con timestamp, utente e commento
- **Notifiche multi-canale**: email, Slack, Teams — mai più approvazioni perse su WhatsApp
- **Dashboard stato documenti**: vedi a colpo d'occhio cosa è in attesa, approvato o rifiutato
- **Escalation automatica**: se un approvatore non risponde entro il tempo limite, il sistema scala automaticamente

## Come funziona

1. **Configurazione**: definisci i tuoi workflow di approvazione (fatture, ordini, contratti, etc.)
2. **Invio**: carica o inoltra il documento da approvare
3. **Routing intelligente**: l'AI instrada il documento all'approvatore corretto in base a regole e importo
4. **Tracciamento**: ogni passaggio è registrato con audit trail immutabile
MD,
                'price_from' => 49,
                'price_to' => null,
                'price_unit' => 'mese',
                'is_active' => true,
                'sort_order' => 2,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'compliance-officer'],
            [
                'type' => 'prodotto',
                'name' => 'AI Admin & Compliance Officer',
                'short_description' => 'Tracks deadlines, generates AI inventory, and prepares you for the AI Act of August 2, 2026. Your digital office manager.',
                'description' => <<<'MD'
## Funzionalità principali

- **Inventario AI automatico**: scansione e catalogazione di tutti gli strumenti AI in uso nella tua azienda
- **Risk classification**: valutazione automatica del livello di rischio per ciascun sistema AI secondo l'AI Act
- **Scadenzario intelligente**: traccia tutte le deadline normative con alert anticipati
- **Generazione policy**: creazione automatica delle policy interne di utilizzo AI
- **Report di compliance**: documentazione pronta per audit e ispezioni
- **Monitoraggio continuo**: alert quando cambia la normativa o quando introduci nuovi strumenti AI

## Come funziona

1. **Scan iniziale**: analisi di tutti i tool e servizi AI attivi in azienda
2. **Classificazione**: ogni sistema viene classificato per rischio secondo Annex III dell'AI Act
3. **Piano d'azione**: generazione automatica del piano di adeguamento con priorità e scadenze
4. **Monitoraggio**: aggiornamenti continui su nuovi obblighi e cambiamenti normativi
MD,
                'price_from' => 89,
                'price_to' => null,
                'price_unit' => 'mese',
                'is_active' => true,
                'sort_order' => 3,
            ]
        );

        // ── Consulting services (Consulenze) ────────────────────────

        Service::firstOrCreate(
            ['slug' => 'ai-strategy'],
            [
                'type' => 'consulenza',
                'name' => 'AI Strategy & Assessment',
                'short_description' => 'We map your processes, identify AI automation opportunities, and define a realistic roadmap.',
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'ai-development'],
            [
                'type' => 'consulenza',
                'name' => 'AI Development & Integration',
                'short_description' => 'We design and develop AI agents, SaaS integrations, and end-to-end automations.',
                'is_active' => true,
                'sort_order' => 2,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'supply-chain-ai'],
            [
                'type' => 'consulenza',
                'name' => 'Supply Chain & Logistics AI',
                'short_description' => 'Routing optimization, MDVRP, demand forecasting, and logistics automation with AI.',
                'is_active' => true,
                'sort_order' => 3,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'ai-act-compliance'],
            [
                'type' => 'consulenza',
                'name' => 'AI Act Compliance',
                'short_description' => 'Complete preparation for the AI Act: system inventory, risk assessment, internal policies, training.',
                'is_active' => true,
                'sort_order' => 4,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'industry-40'],
            [
                'type' => 'consulenza',
                'name' => 'Industry 4.0 & IoT',
                'short_description' => 'Sensor integration, predictive maintenance, digital twin, and industrial automation.',
                'is_active' => true,
                'sort_order' => 5,
            ]
        );

        Service::firstOrCreate(
            ['slug' => 'llm-multi-agent'],
            [
                'type' => 'consulenza',
                'name' => 'LLM & Multi-Agent Systems',
                'short_description' => 'Architecture and development of multi-agent systems, RAG, fine-tuning, and on-premise LLM deployment.',
                'is_active' => true,
                'sort_order' => 6,
            ]
        );

        // ── Pages ─────────────────────────────────────────────────────

        Page::firstOrCreate(
            ['slug' => 'chi-siamo'],
            [
                'title' => 'About Us',
                'body' => 'An AI-first company helping European SMEs modernize with pragmatism and strategic vision.',
                'meta_description' => 'Learn about Corvalys, an AI-first company helping European SMEs modernize with pragmatic, compliant AI solutions.',
                'is_published' => true,
            ]
        );

        Page::firstOrCreate(
            ['slug' => 'missione'],
            [
                'title' => 'Our Mission',
                'body' => <<<'MD'
Corvalys was founded with a clear goal: making artificial intelligence accessible, practical, and compliant for European micro, small, and medium enterprises.

We don't sell technology for its own sake. We analyze business processes, identify inefficiencies, and build AI solutions that deliver measurable results from day one.

Our approach combines expertise in Agentic AI, supply chain, regulatory compliance, and software development to deliver a complete service: from strategy to implementation.
MD,
                'meta_description' => 'Our mission is making AI accessible, practical, and compliant for European SMEs.',
                'is_published' => true,
            ]
        );

        Page::firstOrCreate(
            ['slug' => 'cosa-facciamo'],
            [
                'title' => 'What We Do',
                'body' => <<<'MD'
**AI Suite for SMEs** — We develop ready-to-use AI tools for invoice management, document approvals, and AI Act compliance. Zero technical setup required.

**Custom Consulting** — We design and implement custom AI systems: multi-agent, supply chain optimization, Industry 4.0, and regulatory readiness.

**Training & Support** — We never leave our clients alone. We train teams, monitor results, and iterate until goals are achieved.
MD,
                'meta_description' => 'Corvalys builds AI tools for SMEs, offers custom AI consulting, and provides ongoing training and support.',
                'is_published' => true,
            ]
        );

        Page::firstOrCreate(
            ['slug' => 'valori'],
            [
                'title' => 'Our Values',
                'body' => <<<'MD'
**Clarity** — No buzzwords. We explain what we do, why, and how much it costs.

**Measurable Impact** — Every project has KPIs defined upfront. If there's no ROI, we don't propose it.

**Data Ethics** — GDPR and AI Act are not checkboxes. They are the foundation of how we work.

**Partnership** — We are not vendors. We are partners who grow with our clients.
MD,
                'meta_description' => 'Clarity, measurable impact, data ethics, and partnership: the values that drive Corvalys.',
                'is_published' => true,
            ]
        );
    }
}
