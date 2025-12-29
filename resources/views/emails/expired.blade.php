@component('mail::message')
# Rappel  d’abonnement

Bonjour {{ $subscription->client->rai_soci }},

Votre abonnement **{{ $subscription->type }}** lié à **{{ $subscription->name }}** a expirer depuis le **{{ $subscription->expiration_date->format('d/m/Y') }}**.

Merci de penser à le renouveler.

@component('mail::button', ['url' => url('/subscriptions/'.$subscription->id)])
Voir l’abonnement
@endcomponent

Cordialement,
**L’équipe Gestion Abonnements**
@endcomponent