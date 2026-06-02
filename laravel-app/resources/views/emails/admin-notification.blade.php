<x-mail::message>
# {{ $mailSubject }}

{{ $mailContent }}

@if ($actionUrl)
<x-mail::button :url="$actionUrl">
{{ $actionText ?? 'View Details' }}
</x-mail::button>
@endif

Thanks,<br>
{{ config('app.name', 'e-Doptcat') }} Team
</x-mail::message>
