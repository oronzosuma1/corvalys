{{--
    <x-consent-script category="analytics|marketing|functional" src="..." id="..." />

    Renders a <script type="text/plain"> tag that is NOT executed by the browser.
    A loader in app.js converts it to a real <script> tag once the user has
    granted consent for the specified category via the consent:updated event.

    Usage (external script):
        <x-consent-script category="analytics" src="https://www.googletagmanager.com/gtag/js?id=G-XXX" />

    Usage (inline script):
        <x-consent-script category="analytics">
            console.log('analytics booted');
        </x-consent-script>
--}}
@props([
    'category' => 'analytics',
    'src' => null,
    'id' => null,
    'async' => false,
    'defer' => false,
])
<script type="text/plain"
        data-consent="{{ $category }}"
        data-tracker-category="{{ $category }}"
        @if($src) data-src="{{ $src }}" @endif
        @if($async) data-async="true" @endif
        @if($defer) data-defer="true" @endif
        @if($id) id="{{ $id }}" @endif>{{ $slot }}</script>
