@extends('layouts.app')

@section('title', 'Cookie Policy — Corvalys')

@section('content')
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-heading text-3xl sm:text-4xl font-bold text-navy mb-4">Cookie Policy</h1>
        <p class="text-sm text-gray-400 mb-12">Ultimo aggiornamento: [DA AGGIORNARE] &mdash; Versione 1.0</p>

        <div class="prose prose-lg max-w-none prose-headings:font-heading prose-headings:text-navy">

            <p class="text-amber-700 bg-amber-50 border border-amber-200 rounded-lg px-4 py-3 text-sm font-medium">
                [DA AGGIORNARE CON TESTO LEGALE DEFINITIVO]
            </p>

            <h2>1. Cosa sono i cookie</h2>
            <p>
                I cookie sono piccoli file di testo che vengono salvati sul dispositivo dell&rsquo;Utente durante la navigazione su un sito web. Servono a memorizzare informazioni relative alla visita e a migliorare l&rsquo;esperienza di navigazione.
            </p>

            <h2>2. Tipologie di cookie utilizzati</h2>

            <h3>2.1 Cookie tecnici (necessari)</h3>
            <p>
                Sono indispensabili per il corretto funzionamento del sito. Non richiedono il consenso dell&rsquo;Utente.
            </p>
            <table>
                <thead>
                    <tr>
                        <th>Cookie</th>
                        <th>Finalit&agrave;</th>
                        <th>Durata</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>XSRF-TOKEN</td>
                        <td>Protezione CSRF</td>
                        <td>Sessione</td>
                    </tr>
                    <tr>
                        <td>corvalys_session</td>
                        <td>Gestione sessione utente</td>
                        <td>2 ore</td>
                    </tr>
                    <tr>
                        <td>cookie_consent</td>
                        <td>Memorizzazione preferenze cookie</td>
                        <td>12 mesi</td>
                    </tr>
                </tbody>
            </table>

            <h3>2.2 Cookie analitici</h3>
            <p>
                Utilizzati per raccogliere informazioni statistiche sull&rsquo;uso del sito in forma aggregata e anonima.
            </p>
            <table>
                <thead>
                    <tr>
                        <th>Cookie</th>
                        <th>Fornitore</th>
                        <th>Finalit&agrave;</th>
                        <th>Durata</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>[DA INSERIRE]</td>
                        <td>[DA INSERIRE]</td>
                        <td>Analisi traffico</td>
                        <td>[DA INSERIRE]</td>
                    </tr>
                </tbody>
            </table>

            <h3>2.3 Cookie di profilazione</h3>
            <p>
                [DA AGGIORNARE] Al momento questo sito non utilizza cookie di profilazione. In caso di futura introduzione, la presente policy verr&agrave; aggiornata e verr&agrave; richiesto il consenso preventivo dell&rsquo;Utente.
            </p>

            <h2>3. Cookie di terze parti</h2>
            <p>
                Il sito potrebbe utilizzare servizi di terze parti che installano i propri cookie:
            </p>
            <ul>
                <li>[DA INSERIRE &mdash; es. Google Analytics, Plausible, ecc.]</li>
                <li>[DA INSERIRE &mdash; es. servizi di live chat, video embedding, ecc.]</li>
            </ul>

            <h2>4. Come gestire i cookie</h2>
            <p>
                L&rsquo;Utente pu&ograve; gestire le preferenze sui cookie in diversi modi:
            </p>
            <ul>
                <li><strong>Banner cookie:</strong> al primo accesso al sito, un banner consente di accettare o rifiutare i cookie non tecnici</li>
                <li><strong>Impostazioni del browser:</strong> la maggior parte dei browser consente di bloccare o eliminare i cookie dalle impostazioni</li>
            </ul>

            <h3>Istruzioni per i principali browser:</h3>
            <ul>
                <li><strong>Chrome:</strong> Impostazioni &gt; Privacy e sicurezza &gt; Cookie</li>
                <li><strong>Firefox:</strong> Impostazioni &gt; Privacy e sicurezza &gt; Cookie</li>
                <li><strong>Safari:</strong> Preferenze &gt; Privacy &gt; Cookie</li>
                <li><strong>Edge:</strong> Impostazioni &gt; Cookie e autorizzazioni del sito</li>
            </ul>

            <h2>5. Conseguenze della disattivazione dei cookie</h2>
            <p>
                La disattivazione dei cookie tecnici potrebbe impedire il corretto funzionamento di alcune funzionalit&agrave; del sito. La disattivazione dei cookie analitici non influisce sulla navigazione.
            </p>

            <h2>6. Riferimenti normativi</h2>
            <ul>
                <li>Regolamento UE 2016/679 (GDPR)</li>
                <li>Direttiva 2002/58/CE (ePrivacy)</li>
                <li>Provvedimento del Garante Privacy dell&rsquo;8 maggio 2014</li>
                <li>Linee guida cookie e altri strumenti di tracciamento del 10 giugno 2021</li>
            </ul>

            <h2>7. Titolare del trattamento</h2>
            <p>
                <strong>[Nome Societ&agrave;]</strong><br>
                Email: enzo@corvalys.eu<br>
                Per ulteriori informazioni si rimanda alla <a href="{{ route('privacy') }}">Privacy Policy</a>.
            </p>

            <h2>8. Aggiornamenti</h2>
            <p>
                La presente Cookie Policy pu&ograve; essere aggiornata in qualsiasi momento. La data dell&rsquo;ultimo aggiornamento &egrave; indicata in cima a questa pagina.
            </p>

        </div>
    </div>
</section>
@endsection
