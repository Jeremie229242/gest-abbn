
@component('mail::message')
# Rappel d’abonnement de {{ $subscription->client->rai_soci }}

Bonjour,

L'abonnement de **{{ $subscription->client->rai_soci }}** concernant  **{{ $subscription->type }}** lié à **{{ $subscription->name }}** va expirer le **{{ $subscription->expiration_date->format('d/m/Y') }}**.

Merci de penser à le renouveler.

@component('mail::button', ['url' => url('/subscriptions/'.$subscription->id)])
Voir l’abonnement
@endcomponent

Cordialement,
**L’équipe Gestion Abonnements**
@endcomponent
