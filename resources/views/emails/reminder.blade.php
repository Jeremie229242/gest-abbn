
@component('mail::message')
# Rappel d’abonnement

Bonjour,

Votre abonnement **{{ $subscription->type }}** lié à **{{ $subscription->entity }}** va expirer le **{{ $subscription->expiration_date->format('d/m/Y') }}**.

<p>
            Pour éviter toute interruption de service, nous vous invitons à renouveler votre abonnement dès que possible.
        </p>

@component('mail::button', ['url' => url('/Admin/subscriptions/'.$subscription->id)])
Voir l’abonnement
@endcomponent

Cordialement,
**L’équipe Gestion Abonnements**
@endcomponent



