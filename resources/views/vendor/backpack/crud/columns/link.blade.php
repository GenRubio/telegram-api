@php
    $url = $entry->{$column['name']};
    if (!str_contains($url, 'http:') && !str_contains($url, 'https:')) {
        $url = '//' . $url;
    }
@endphp
<a href="{{ $url }}" target="_blank">{{ $entry->{$column['name']} }}</a>
