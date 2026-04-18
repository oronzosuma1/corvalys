{{--
    @deprecated Use <x-consent-script /> instead.
    This component is kept as a backward-compatible alias and forwards to the
    new <x-consent-script> component. See consent-script.blade.php.
--}}
@props(['category' => 'analytics', 'src' => null, 'id' => null, 'inline' => null])

<x-consent-script :category="$category" :src="$src" :id="$id">
    @if($inline){!! $inline !!}@else{{ $slot }}@endif
</x-consent-script>
