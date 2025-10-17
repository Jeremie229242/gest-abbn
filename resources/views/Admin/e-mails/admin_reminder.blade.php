


@component('mail::message')
# 🔔 Rappel d’abonnement

Bonjour **{{ $subscription->user->name ?? 'Administrateur' }}**,

L’abonnement du site **{{ $subscription->site->name ?? 'Non défini' }}**
pour l’application **{{ $subscription->name }}** arrive à expiration dans **{{ $daysLeft }} jours**.

- **Date d’expiration :** {{ \Carbon\Carbon::parse($subscription->expiration_date)->format('d/m/Y') }}
- **Type :** {{ $subscription->type }}
- **Entité :** {{ $subscription->entity }}

@component('mail::button', ['url' => url('/admin/subscriptions/'.$subscription->id)])
Voir les détails
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
