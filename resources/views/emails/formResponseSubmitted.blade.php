@component('mail::message')

{{-- Begin section --}}
@foreach ($response->data as $section)

# {{ $section['title'] }}

{{-- Begin field --}}
@foreach ($section['fields'] as $field)
<p>
<strong>{{ $loop->iteration }}. {{ $field['label'] }}</strong><br>
{{ $field['value'] ?? '-' }}
</p>
@endforeach
{{-- End field --}}

@endforeach
{{-- End section --}}

@endcomponent
