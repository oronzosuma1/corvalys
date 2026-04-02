<!DOCTYPE html>
<html lang="{{ $language }}">
<head>
    <meta charset="utf-8">
    <title>Corvalys Proposal</title>
    <style>
        @page {
            margin: 0;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1f2937;
            font-size: 11pt;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        .page {
            padding: 50px 55px;
            page-break-after: always;
        }
        .page:last-child {
            page-break-after: auto;
        }

        /* Header */
        .header {
            border-bottom: 3px solid #0F7B6C;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header-brand {
            font-size: 28pt;
            font-weight: bold;
            color: #0F7B6C;
            letter-spacing: 2px;
        }
        .header-subtitle {
            font-size: 10pt;
            color: #6b7280;
            margin-top: 2px;
        }
        .header-right {
            float: right;
            text-align: right;
            font-size: 9pt;
            color: #6b7280;
            margin-top: 5px;
        }

        /* Cover section */
        .cover-title {
            font-size: 22pt;
            font-weight: bold;
            color: #1B3A5C;
            margin: 60px 0 15px;
        }
        .cover-client {
            font-size: 14pt;
            color: #0F7B6C;
            margin-bottom: 40px;
        }
        .cover-meta {
            font-size: 10pt;
            color: #6b7280;
        }
        .cover-meta td {
            padding: 4px 15px 4px 0;
        }
        .cover-meta .label {
            font-weight: bold;
            color: #374151;
            width: 120px;
        }

        /* Section */
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 14pt;
            font-weight: bold;
            color: #1B3A5C;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 6px;
            margin-bottom: 12px;
        }
        .section-subtitle {
            font-size: 11pt;
            font-weight: bold;
            color: #0F7B6C;
            margin: 12px 0 6px;
        }

        /* Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        .data-table th {
            background-color: #1B3A5C;
            color: #ffffff;
            font-size: 9pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 12px;
            text-align: left;
        }
        .data-table td {
            padding: 8px 12px;
            font-size: 10pt;
            border-bottom: 1px solid #e5e7eb;
        }
        .data-table tr:nth-child(even) td {
            background-color: #f9fafb;
        }

        /* Highlight boxes */
        .highlight-box {
            background-color: #f0fdf9;
            border: 1px solid #0F7B6C;
            border-radius: 6px;
            padding: 15px 20px;
            margin: 15px 0;
        }
        .highlight-box .box-label {
            font-size: 9pt;
            font-weight: bold;
            color: #0F7B6C;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .highlight-box .box-value {
            font-size: 18pt;
            font-weight: bold;
            color: #1B3A5C;
            margin-top: 4px;
        }

        .cost-row {
            display: inline-block;
            width: 48%;
            vertical-align: top;
        }

        /* Summary stats */
        .stats-table {
            width: 100%;
            border-collapse: collapse;
        }
        .stats-table td {
            width: 33%;
            text-align: center;
            padding: 15px 10px;
            border: 1px solid #e5e7eb;
        }
        .stats-table .stat-label {
            font-size: 8pt;
            font-weight: bold;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stats-table .stat-value {
            font-size: 16pt;
            font-weight: bold;
            color: #1B3A5C;
            margin-top: 4px;
        }

        /* Lists */
        .item-list {
            list-style: none;
            padding: 0;
        }
        .item-list li {
            padding: 5px 0 5px 18px;
            position: relative;
            font-size: 10pt;
        }
        .item-list li:before {
            content: "\2022";
            color: #0F7B6C;
            font-weight: bold;
            position: absolute;
            left: 0;
            font-size: 14pt;
            line-height: 1;
        }

        /* Risk items */
        .risk-item {
            padding: 5px 0 5px 18px;
            position: relative;
            font-size: 10pt;
            color: #991b1b;
        }
        .risk-item:before {
            content: "!";
            color: #dc2626;
            font-weight: bold;
            position: absolute;
            left: 2px;
        }

        /* Footer */
        .footer {
            border-top: 2px solid #0F7B6C;
            padding-top: 15px;
            margin-top: 40px;
            font-size: 8pt;
            color: #9ca3af;
            text-align: center;
        }
        .footer .company-name {
            color: #0F7B6C;
            font-weight: bold;
            font-size: 9pt;
        }

        /* Terms */
        .terms-text {
            font-size: 9pt;
            color: #6b7280;
            line-height: 1.6;
        }
        .terms-text p {
            margin-bottom: 8px;
        }

        .text-primary { color: #0F7B6C; }
        .text-navy { color: #1B3A5C; }
        .text-muted { color: #6b7280; }
        .text-sm { font-size: 10pt; }
        .text-bold { font-weight: bold; }
        .mt-10 { margin-top: 10px; }
        .mb-10 { margin-bottom: 10px; }
    </style>
</head>
<body>
@php
    $t = [
        'en' => [
            'proposal_title' => 'Project Proposal',
            'prepared_for' => 'Prepared for',
            'company' => 'Company',
            'date' => 'Date',
            'language' => 'Language',
            'ref' => 'Reference',
            'executive_summary' => 'Executive Summary',
            'service_type' => 'Recommended Service',
            'approach' => 'Suggested Approach',
            'tech_readiness' => 'Technology Readiness',
            'cost_estimate' => 'Cost Estimate',
            'estimated_cost' => 'Estimated Investment',
            'estimated_hours' => 'Estimated Hours',
            'hourly_rate' => 'Hourly Rate',
            'complexity' => 'Complexity',
            'feasibility' => 'Feasibility',
            'proposed_services' => 'Proposed Services',
            'service' => 'Service',
            'description' => 'Description',
            'timeline' => 'Project Timeline',
            'phase' => 'Phase',
            'duration' => 'Duration',
            'phase_1' => 'Discovery & Analysis',
            'phase_1_dur' => '1-2 weeks',
            'phase_2' => 'Design & Architecture',
            'phase_2_dur' => '1-2 weeks',
            'phase_3' => 'Development & Implementation',
            'phase_3_dur' => '3-6 weeks',
            'phase_4' => 'Testing & QA',
            'phase_4_dur' => '1-2 weeks',
            'phase_5' => 'Deployment & Training',
            'phase_5_dur' => '1 week',
            'risks' => 'Risk Assessment',
            'next_steps' => 'Next Steps',
            'terms' => 'Terms & Conditions',
            'terms_1' => 'This proposal is valid for 30 days from the date of issue.',
            'terms_2' => 'All prices are in EUR and exclude VAT unless otherwise stated.',
            'terms_3' => 'Payment terms: 30% upon project start, 40% at midpoint delivery, 30% upon final delivery and acceptance.',
            'terms_4' => 'Project scope changes may affect the timeline and cost. Any changes will be communicated and agreed upon in writing.',
            'terms_5' => 'Corvalys retains the right to use subcontractors as needed, while maintaining full responsibility for deliverables.',
            'terms_6' => 'All intellectual property developed during the project will be transferred to the client upon full payment.',
            'contact_title' => 'Contact Information',
            'contact_text' => 'For questions about this proposal, please contact us.',
        ],
        'it' => [
            'proposal_title' => 'Proposta Progetto',
            'prepared_for' => 'Preparata per',
            'company' => 'Azienda',
            'date' => 'Data',
            'language' => 'Lingua',
            'ref' => 'Riferimento',
            'executive_summary' => 'Riepilogo Esecutivo',
            'service_type' => 'Servizio Consigliato',
            'approach' => 'Approccio Suggerito',
            'tech_readiness' => 'Maturita Tecnologica',
            'cost_estimate' => 'Stima dei Costi',
            'estimated_cost' => 'Investimento Stimato',
            'estimated_hours' => 'Ore Stimate',
            'hourly_rate' => 'Tariffa Oraria',
            'complexity' => 'Complessita',
            'feasibility' => 'Fattibilita',
            'proposed_services' => 'Servizi Proposti',
            'service' => 'Servizio',
            'description' => 'Descrizione',
            'timeline' => 'Timeline del Progetto',
            'phase' => 'Fase',
            'duration' => 'Durata',
            'phase_1' => 'Analisi e Scoperta',
            'phase_1_dur' => '1-2 settimane',
            'phase_2' => 'Design e Architettura',
            'phase_2_dur' => '1-2 settimane',
            'phase_3' => 'Sviluppo e Implementazione',
            'phase_3_dur' => '3-6 settimane',
            'phase_4' => 'Testing e QA',
            'phase_4_dur' => '1-2 settimane',
            'phase_5' => 'Deploy e Formazione',
            'phase_5_dur' => '1 settimana',
            'risks' => 'Analisi dei Rischi',
            'next_steps' => 'Prossimi Passi',
            'terms' => 'Termini e Condizioni',
            'terms_1' => 'Questa proposta e valida per 30 giorni dalla data di emissione.',
            'terms_2' => 'Tutti i prezzi sono in EUR e non includono IVA salvo diversa indicazione.',
            'terms_3' => 'Termini di pagamento: 30% all\'avvio del progetto, 40% alla consegna intermedia, 30% alla consegna finale e accettazione.',
            'terms_4' => 'Modifiche all\'ambito del progetto possono influire su tempistiche e costi. Eventuali modifiche saranno comunicate e concordate per iscritto.',
            'terms_5' => 'Corvalys si riserva il diritto di utilizzare subappaltatori se necessario, mantenendo piena responsabilita sui deliverable.',
            'terms_6' => 'Tutta la proprieta intellettuale sviluppata durante il progetto sara trasferita al cliente al completamento del pagamento.',
            'contact_title' => 'Informazioni di Contatto',
            'contact_text' => 'Per domande su questa proposta, non esitate a contattarci.',
        ],
        'fr' => [
            'proposal_title' => 'Proposition de Projet',
            'prepared_for' => 'Preparee pour',
            'company' => 'Entreprise',
            'date' => 'Date',
            'language' => 'Langue',
            'ref' => 'Reference',
            'executive_summary' => 'Resume Executif',
            'service_type' => 'Service Recommande',
            'approach' => 'Approche Suggeree',
            'tech_readiness' => 'Maturite Technologique',
            'cost_estimate' => 'Estimation des Couts',
            'estimated_cost' => 'Investissement Estime',
            'estimated_hours' => 'Heures Estimees',
            'hourly_rate' => 'Taux Horaire',
            'complexity' => 'Complexite',
            'feasibility' => 'Faisabilite',
            'proposed_services' => 'Services Proposes',
            'service' => 'Service',
            'description' => 'Description',
            'timeline' => 'Calendrier du Projet',
            'phase' => 'Phase',
            'duration' => 'Duree',
            'phase_1' => 'Decouverte et Analyse',
            'phase_1_dur' => '1-2 semaines',
            'phase_2' => 'Conception et Architecture',
            'phase_2_dur' => '1-2 semaines',
            'phase_3' => 'Developpement et Implementation',
            'phase_3_dur' => '3-6 semaines',
            'phase_4' => 'Tests et QA',
            'phase_4_dur' => '1-2 semaines',
            'phase_5' => 'Deploiement et Formation',
            'phase_5_dur' => '1 semaine',
            'risks' => 'Evaluation des Risques',
            'next_steps' => 'Prochaines Etapes',
            'terms' => 'Termes et Conditions',
            'terms_1' => 'Cette proposition est valable 30 jours a compter de la date d\'emission.',
            'terms_2' => 'Tous les prix sont en EUR et hors TVA sauf indication contraire.',
            'terms_3' => 'Conditions de paiement : 30% au demarrage du projet, 40% a la livraison intermediaire, 30% a la livraison finale.',
            'terms_4' => 'Les modifications du perimetre du projet peuvent affecter le calendrier et les couts.',
            'terms_5' => 'Corvalys se reserve le droit d\'utiliser des sous-traitants tout en maintenant la pleine responsabilite des livrables.',
            'terms_6' => 'Toute propriete intellectuelle developpee sera transferee au client apres paiement complet.',
            'contact_title' => 'Informations de Contact',
            'contact_text' => 'Pour toute question concernant cette proposition, n\'hesitez pas a nous contacter.',
        ],
        'de' => [
            'proposal_title' => 'Projektvorschlag',
            'prepared_for' => 'Erstellt fur',
            'company' => 'Unternehmen',
            'date' => 'Datum',
            'language' => 'Sprache',
            'ref' => 'Referenz',
            'executive_summary' => 'Zusammenfassung',
            'service_type' => 'Empfohlener Service',
            'approach' => 'Vorgeschlagener Ansatz',
            'tech_readiness' => 'Technologische Reife',
            'cost_estimate' => 'Kostenschatzung',
            'estimated_cost' => 'Geschatzte Investition',
            'estimated_hours' => 'Geschatzte Stunden',
            'hourly_rate' => 'Stundensatz',
            'complexity' => 'Komplexitat',
            'feasibility' => 'Machbarkeit',
            'proposed_services' => 'Vorgeschlagene Dienstleistungen',
            'service' => 'Dienstleistung',
            'description' => 'Beschreibung',
            'timeline' => 'Projektzeitplan',
            'phase' => 'Phase',
            'duration' => 'Dauer',
            'phase_1' => 'Analyse und Entdeckung',
            'phase_1_dur' => '1-2 Wochen',
            'phase_2' => 'Design und Architektur',
            'phase_2_dur' => '1-2 Wochen',
            'phase_3' => 'Entwicklung und Implementierung',
            'phase_3_dur' => '3-6 Wochen',
            'phase_4' => 'Tests und QA',
            'phase_4_dur' => '1-2 Wochen',
            'phase_5' => 'Bereitstellung und Schulung',
            'phase_5_dur' => '1 Woche',
            'risks' => 'Risikobewertung',
            'next_steps' => 'Nachste Schritte',
            'terms' => 'Allgemeine Geschaftsbedingungen',
            'terms_1' => 'Dieses Angebot ist 30 Tage ab Ausstellungsdatum gultig.',
            'terms_2' => 'Alle Preise sind in EUR und verstehen sich ohne MwSt.',
            'terms_3' => 'Zahlungsbedingungen: 30% bei Projektstart, 40% bei Zwischenlieferung, 30% bei Endlieferung.',
            'terms_4' => 'Anderungen am Projektumfang konnen sich auf Zeitplan und Kosten auswirken.',
            'terms_5' => 'Corvalys behalt sich das Recht vor, Subunternehmer einzusetzen.',
            'terms_6' => 'Alle im Projekt entwickelten geistigen Eigentumsrechte werden nach vollstandiger Zahlung ubertragen.',
            'contact_title' => 'Kontaktinformationen',
            'contact_text' => 'Bei Fragen zu diesem Angebot kontaktieren Sie uns bitte.',
        ],
        'es' => [
            'proposal_title' => 'Propuesta de Proyecto',
            'prepared_for' => 'Preparada para',
            'company' => 'Empresa',
            'date' => 'Fecha',
            'language' => 'Idioma',
            'ref' => 'Referencia',
            'executive_summary' => 'Resumen Ejecutivo',
            'service_type' => 'Servicio Recomendado',
            'approach' => 'Enfoque Sugerido',
            'tech_readiness' => 'Madurez Tecnologica',
            'cost_estimate' => 'Estimacion de Costos',
            'estimated_cost' => 'Inversion Estimada',
            'estimated_hours' => 'Horas Estimadas',
            'hourly_rate' => 'Tarifa por Hora',
            'complexity' => 'Complejidad',
            'feasibility' => 'Viabilidad',
            'proposed_services' => 'Servicios Propuestos',
            'service' => 'Servicio',
            'description' => 'Descripcion',
            'timeline' => 'Cronograma del Proyecto',
            'phase' => 'Fase',
            'duration' => 'Duracion',
            'phase_1' => 'Descubrimiento y Analisis',
            'phase_1_dur' => '1-2 semanas',
            'phase_2' => 'Diseno y Arquitectura',
            'phase_2_dur' => '1-2 semanas',
            'phase_3' => 'Desarrollo e Implementacion',
            'phase_3_dur' => '3-6 semanas',
            'phase_4' => 'Pruebas y QA',
            'phase_4_dur' => '1-2 semanas',
            'phase_5' => 'Despliegue y Capacitacion',
            'phase_5_dur' => '1 semana',
            'risks' => 'Evaluacion de Riesgos',
            'next_steps' => 'Proximos Pasos',
            'terms' => 'Terminos y Condiciones',
            'terms_1' => 'Esta propuesta es valida por 30 dias desde la fecha de emision.',
            'terms_2' => 'Todos los precios estan en EUR y no incluyen IVA salvo indicacion contraria.',
            'terms_3' => 'Condiciones de pago: 30% al inicio del proyecto, 40% en entrega intermedia, 30% en entrega final.',
            'terms_4' => 'Los cambios en el alcance del proyecto pueden afectar el cronograma y los costos.',
            'terms_5' => 'Corvalys se reserva el derecho de utilizar subcontratistas manteniendo plena responsabilidad.',
            'terms_6' => 'Toda propiedad intelectual desarrollada sera transferida al cliente tras el pago completo.',
            'contact_title' => 'Informacion de Contacto',
            'contact_text' => 'Para preguntas sobre esta propuesta, no dude en contactarnos.',
        ],
    ];

    $l = $t[$language] ?? $t['en'];
    $langLabels = ['en' => 'English', 'it' => 'Italiano', 'fr' => 'Francais', 'de' => 'Deutsch', 'es' => 'Espanol'];
@endphp

{{-- PAGE 1: Cover & Executive Summary --}}
<div class="page">
    {{-- Header --}}
    <div class="header">
        <span class="header-right">
            {{ $l['ref'] }}: CRV-{{ str_pad($lead->id, 4, '0', STR_PAD_LEFT) }}<br>
            {{ now()->format('d/m/Y') }}
        </span>
        <div class="header-brand">CORVALYS</div>
        <div class="header-subtitle">AI & Technology Solutions</div>
    </div>

    {{-- Cover --}}
    <div class="cover-title">{{ $l['proposal_title'] }}</div>
    <div class="cover-client">{{ $lead->company ?? $lead->name }}</div>

    <table class="cover-meta">
        <tr>
            <td class="label">{{ $l['prepared_for'] }}:</td>
            <td>{{ $lead->name }}</td>
        </tr>
        @if($lead->company)
        <tr>
            <td class="label">{{ $l['company'] }}:</td>
            <td>{{ $lead->company }}</td>
        </tr>
        @endif
        <tr>
            <td class="label">{{ $l['date'] }}:</td>
            <td>{{ now()->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td class="label">{{ $l['language'] }}:</td>
            <td>{{ $langLabels[$language] ?? $language }}</td>
        </tr>
    </table>

    {{-- Executive Summary --}}
    <div class="section" style="margin-top: 40px;">
        <div class="section-title">{{ $l['executive_summary'] }}</div>

        {{-- Stats --}}
        <table class="stats-table" style="margin: 15px 0;">
            <tr>
                <td>
                    <div class="stat-label">{{ $l['estimated_cost'] }}</div>
                    <div class="stat-value">EUR {{ number_format($assessment['estimated_cost_min'] ?? 0, 0, ',', '.') }} - {{ number_format($assessment['estimated_cost_max'] ?? 0, 0, ',', '.') }}</div>
                </td>
                <td>
                    <div class="stat-label">{{ $l['estimated_hours'] }}</div>
                    <div class="stat-value">{{ $assessment['estimated_hours_min'] ?? '-' }} - {{ $assessment['estimated_hours_max'] ?? '-' }}h</div>
                </td>
                <td>
                    <div class="stat-label">{{ $l['complexity'] }} / {{ $l['feasibility'] }}</div>
                    <div class="stat-value">{{ $assessment['complexity'] ?? '-' }}/5 &middot; {{ ucfirst($assessment['feasibility'] ?? '-') }}</div>
                </td>
            </tr>
        </table>

        @if(isset($assessment['recommended_service_type']))
            <div class="section-subtitle">{{ $l['service_type'] }}</div>
            <p class="text-sm">{{ $assessment['recommended_service_type'] }}</p>
        @endif

        @if(isset($assessment['tech_readiness_assessment']))
            <div class="section-subtitle">{{ $l['tech_readiness'] }}</div>
            <p class="text-sm">{{ $assessment['tech_readiness_assessment'] }}</p>
        @endif

        @if(isset($assessment['suggested_approach']))
            <div class="section-subtitle">{{ $l['approach'] }}</div>
            <p class="text-sm">{{ $assessment['suggested_approach'] }}</p>
        @endif
    </div>

    {{-- Footer --}}
    <div class="footer">
        <span class="company-name">Corvalys S.r.l.</span> &middot; AI & Technology Solutions<br>
        info@corvalys.com &middot; www.corvalys.com
    </div>
</div>

{{-- PAGE 2: Services, Timeline, Risks --}}
<div class="page">
    <div class="header">
        <span class="header-right">{{ $l['ref'] }}: CRV-{{ str_pad($lead->id, 4, '0', STR_PAD_LEFT) }}</span>
        <div class="header-brand">CORVALYS</div>
        <div class="header-subtitle">AI & Technology Solutions</div>
    </div>

    {{-- Cost Estimate --}}
    <div class="section">
        <div class="section-title">{{ $l['cost_estimate'] }}</div>
        <div class="highlight-box">
            <table width="100%">
                <tr>
                    <td width="50%">
                        <div class="box-label">{{ $l['estimated_cost'] }}</div>
                        <div class="box-value">EUR {{ number_format($assessment['estimated_cost_min'] ?? 0, 0, ',', '.') }} - {{ number_format($assessment['estimated_cost_max'] ?? 0, 0, ',', '.') }}</div>
                    </td>
                    <td width="25%" style="text-align: center;">
                        <div class="box-label">{{ $l['estimated_hours'] }}</div>
                        <div class="box-value" style="font-size: 14pt;">{{ $assessment['estimated_hours_min'] ?? '-' }} - {{ $assessment['estimated_hours_max'] ?? '-' }}h</div>
                    </td>
                    <td width="25%" style="text-align: center;">
                        <div class="box-label">{{ $l['hourly_rate'] }}</div>
                        <div class="box-value" style="font-size: 14pt;">EUR {{ $assessment['hourly_rate'] ?? '-' }}/h</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Timeline --}}
    <div class="section">
        <div class="section-title">{{ $l['timeline'] }}</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 10%;">#</th>
                    <th style="width: 55%;">{{ $l['phase'] }}</th>
                    <th style="width: 35%;">{{ $l['duration'] }}</th>
                </tr>
            </thead>
            <tbody>
                @for($i = 1; $i <= 5; $i++)
                <tr>
                    <td style="text-align: center; font-weight: bold; color: #0F7B6C;">{{ $i }}</td>
                    <td>{{ $l['phase_' . $i] }}</td>
                    <td>{{ $l['phase_' . $i . '_dur'] }}</td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>

    {{-- Risks --}}
    @if(isset($assessment['risks']) && is_array($assessment['risks']) && count($assessment['risks']))
    <div class="section">
        <div class="section-title">{{ $l['risks'] }}</div>
        @foreach($assessment['risks'] as $risk)
            <div class="risk-item">{{ $risk }}</div>
        @endforeach
    </div>
    @endif

    {{-- Next Steps --}}
    @if(isset($assessment['next_steps']) && is_array($assessment['next_steps']) && count($assessment['next_steps']))
    <div class="section">
        <div class="section-title">{{ $l['next_steps'] }}</div>
        <ul class="item-list">
            @foreach($assessment['next_steps'] as $step)
                <li>{{ $step }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Footer --}}
    <div class="footer">
        <span class="company-name">Corvalys S.r.l.</span> &middot; AI & Technology Solutions<br>
        info@corvalys.com &middot; www.corvalys.com
    </div>
</div>

{{-- PAGE 3: Terms & Contact --}}
<div class="page">
    <div class="header">
        <span class="header-right">{{ $l['ref'] }}: CRV-{{ str_pad($lead->id, 4, '0', STR_PAD_LEFT) }}</span>
        <div class="header-brand">CORVALYS</div>
        <div class="header-subtitle">AI & Technology Solutions</div>
    </div>

    {{-- Terms --}}
    <div class="section">
        <div class="section-title">{{ $l['terms'] }}</div>
        <div class="terms-text">
            <p>1. {{ $l['terms_1'] }}</p>
            <p>2. {{ $l['terms_2'] }}</p>
            <p>3. {{ $l['terms_3'] }}</p>
            <p>4. {{ $l['terms_4'] }}</p>
            <p>5. {{ $l['terms_5'] }}</p>
            <p>6. {{ $l['terms_6'] }}</p>
        </div>
    </div>

    {{-- Contact --}}
    <div class="section" style="margin-top: 40px;">
        <div class="section-title">{{ $l['contact_title'] }}</div>
        <p class="text-sm" style="margin-bottom: 15px;">{{ $l['contact_text'] }}</p>

        <table style="font-size: 10pt;">
            <tr>
                <td style="padding: 3px 15px 3px 0; font-weight: bold; color: #0F7B6C;">Email:</td>
                <td>info@corvalys.com</td>
            </tr>
            <tr>
                <td style="padding: 3px 15px 3px 0; font-weight: bold; color: #0F7B6C;">Web:</td>
                <td>www.corvalys.com</td>
            </tr>
        </table>
    </div>

    {{-- Signature area --}}
    <div style="margin-top: 60px; border-top: 1px solid #e5e7eb; padding-top: 20px;">
        <table width="100%">
            <tr>
                <td width="50%" style="vertical-align: top;">
                    <p style="font-size: 9pt; color: #6b7280; margin-bottom: 40px;">Corvalys S.r.l.</p>
                    <div style="border-top: 1px solid #374151; width: 200px; padding-top: 5px;">
                        <p style="font-size: 9pt; color: #6b7280;">Signature / Date</p>
                    </div>
                </td>
                <td width="50%" style="vertical-align: top;">
                    <p style="font-size: 9pt; color: #6b7280; margin-bottom: 40px;">{{ $lead->company ?? $lead->name }}</p>
                    <div style="border-top: 1px solid #374151; width: 200px; padding-top: 5px;">
                        <p style="font-size: 9pt; color: #6b7280;">Signature / Date</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    {{-- Footer --}}
    <div class="footer">
        <span class="company-name">Corvalys S.r.l.</span> &middot; AI & Technology Solutions<br>
        info@corvalys.com &middot; www.corvalys.com
    </div>
</div>

</body>
</html>
