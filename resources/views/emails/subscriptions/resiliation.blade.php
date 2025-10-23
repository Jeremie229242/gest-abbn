@component('mail::message')
# Résiliation d’abonnement

Bonjour,

L’abonnement **{{ $subscription->name }}** a été **résilié**.

- **Motif :** {{ $subscription->motif }}
- **Date de résiliation :** {{ $subscription->date_res }}

Merci de votre compréhension.

@component('mail::button', ['url' => config('app.url')])
Voir le site
@endcomponent

Cordialement,
L’équipe {{ config('app.name') }}
@endcomponent

