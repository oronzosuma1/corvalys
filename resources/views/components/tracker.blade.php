@props(['category' => 'analytics', 'src' => null, 'id' => null, 'inline' => null])

<script type="text/plain"
        data-tracker-category="{{ $category }}"
        @if($src) data-src="{{ $src }}" @endif
        @if($id) id="{{ $id }}" @endif>
@if($inline){!! $inline !!}@else{{ $slot }}@endif
</script>
