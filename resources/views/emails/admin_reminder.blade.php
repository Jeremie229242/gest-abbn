
@component('mail::message')
# Rappel d’abonnement de {{ $subscription->site->nom }}

Bonjour,

L'abonnement de **{{ $subscription->site->nom }}** concernant  **{{ $subscription->type }}** lié à **{{ $subscription->entity }}** va expirer le **{{ $subscription->expiration_date->format('d/m/Y') }}**.

Merci de penser à le renouveler.

@component('mail::button', ['url' => url('/subscriptions/'.$subscription->id)])
Voir l’abonnement
@endcomponent

Cordialement,
**L’équipe Gestion Abonnements**
@endcomponent
