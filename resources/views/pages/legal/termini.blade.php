@extends('layouts.app')

@section('title', 'Termini di Servizio — Corvalys')

@section('content')
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-heading text-3xl sm:text-4xl font-bold text-navy mb-4">Termini e Condizioni di Servizio</h1>
        <p class="text-sm text-gray-400 mb-12">Ultimo aggiornamento: [DA AGGIORNARE] &mdash; Versione 1.0</p>

        <div class="prose prose-lg max-w-none prose-headings:font-heading prose-headings:text-navy">

            <p class="text-amber-700 bg-amber-50 border border-amber-200 rounded-lg px-4 py-3 text-sm font-medium">
                [DA AGGIORNARE CON TESTO LEGALE DEFINITIVO]
            </p>

            <h2>1. Premesse e definizioni</h2>
            <p>
                I presenti Termini e Condizioni di Servizio (di seguito &ldquo;Termini&rdquo;) regolano l&rsquo;utilizzo della piattaforma Corvalys e dei servizi correlati offerti da:
            </p>
            <p>
                <strong>[Nome Societ&agrave;]</strong><br>
                Sede legale: [Indirizzo]<br>
                P.IVA: [Numero]<br>
                Email: enzo@corvalys.eu
            </p>
            <p>Per &ldquo;Utente&rdquo; si intende qualsiasi persona fisica o giuridica che accede alla piattaforma o usufruisce dei servizi.</p>

            <h2>2. Accettazione dei Termini</h2>
            <p>
                L&rsquo;utilizzo della piattaforma Corvalys implica l&rsquo;accettazione integrale dei presenti Termini. L&rsquo;Utente che non intenda accettare i Termini &egrave; tenuto a non utilizzare la piattaforma.
            </p>

            <h2>3. Descrizione dei servizi</h2>
            <p>Corvalys offre i seguenti servizi:</p>
            <ul>
                <li><strong>AI Cash Controller:</strong> gestione automatizzata delle fatture e dei flussi di cassa</li>
                <li><strong>AI Approval Coordinator:</strong> gestione dei flussi approvativi documentali</li>
                <li><strong>AI Admin &amp; Compliance Officer:</strong> gestione scadenze e compliance AI Act</li>
                <li><strong>Servizi di consulenza:</strong> strategia AI, sviluppo custom, compliance AI Act</li>
            </ul>

            <h2>4. Registrazione e account</h2>
            <p>
                Per accedere ai servizi &egrave; necessario creare un account fornendo dati veritieri e completi. L&rsquo;Utente &egrave; responsabile della riservatezza delle proprie credenziali e di tutte le attivit&agrave; svolte tramite il proprio account.
            </p>

            <h2>5. Piani e prezzi</h2>
            <p>
                [DA AGGIORNARE CON DETTAGLI SPECIFICI DEI PIANI]
            </p>
            <p>
                I prezzi sono espressi in Euro e si intendono IVA esclusa salvo diversa indicazione. Il Titolare si riserva il diritto di modificare i prezzi con preavviso di 30 giorni.
            </p>

            <h2>6. Periodo di prova gratuito</h2>
            <p>
                Corvalys offre un periodo di prova gratuito di 3 mesi. Al termine del periodo di prova, l&rsquo;Utente potr&agrave; scegliere se sottoscrivere un piano a pagamento o interrompere l&rsquo;utilizzo del servizio. Non &egrave; richiesta carta di credito per il periodo di prova.
            </p>

            <h2>7. Obblighi dell&rsquo;Utente</h2>
            <p>L&rsquo;Utente si impegna a:</p>
            <ul>
                <li>Utilizzare il servizio in conformit&agrave; alle leggi vigenti</li>
                <li>Non utilizzare il servizio per scopi illeciti o fraudolenti</li>
                <li>Non tentare di accedere ad aree riservate della piattaforma</li>
                <li>Non sovraccaricare intenzionalmente l&rsquo;infrastruttura del servizio</li>
                <li>Mantenere aggiornati i dati del proprio account</li>
            </ul>

            <h2>8. Propriet&agrave; intellettuale</h2>
            <p>
                Tutti i contenuti della piattaforma (software, testi, grafiche, loghi, marchi) sono di propriet&agrave; esclusiva del Titolare o dei suoi licenzianti. &Egrave; vietata la riproduzione, distribuzione o utilizzo non autorizzato.
            </p>

            <h2>9. Limitazione di responsabilit&agrave;</h2>
            <p>
                Il Titolare non sar&agrave; responsabile per danni indiretti, incidentali o consequenziali derivanti dall&rsquo;utilizzo del servizio. I suggerimenti e le analisi forniti dagli strumenti AI hanno natura informativa e non costituiscono consulenza professionale.
            </p>

            <h2>10. Protezione dei dati</h2>
            <p>
                Il trattamento dei dati personali &egrave; regolato dalla <a href="{{ route('privacy') }}">Privacy Policy</a>. L&rsquo;Utente acconsente al trattamento dei propri dati secondo quanto ivi previsto.
            </p>

            <h2>11. Recesso e cancellazione</h2>
            <p>
                L&rsquo;Utente pu&ograve; recedere dal servizio in qualsiasi momento. I dati verranno conservati per il periodo previsto dalla normativa vigente e dalla Privacy Policy.
            </p>

            <h2>12. Modifiche ai Termini</h2>
            <p>
                Il Titolare si riserva il diritto di modificare i presenti Termini. Le modifiche saranno comunicate all&rsquo;Utente con preavviso di almeno 15 giorni. L&rsquo;uso continuato del servizio dopo l&rsquo;entrata in vigore delle modifiche costituisce accettazione delle stesse.
            </p>

            <h2>13. Legge applicabile e foro competente</h2>
            <p>
                I presenti Termini sono regolati dalla legge italiana. Per qualsiasi controversia sar&agrave; competente il Foro di [DA INSERIRE].
            </p>

        </div>
    </div>
</section>
@endsection
