




@component('mail::message')

Bonjour {{ $subscription->client->rai_soci }},

Ceci est un rappel concernant votre abonnement **{{ $subscription->type }}** lié à **{{ $subscription->name }}**
qui expirera le **{{ $subscription->expiration_date->format('d/m/Y') }}**.

<p>
            Pour éviter toute interruption de service, nous vous invitons à renouveler votre abonnement dès que possible.
        </p>

Si vous avez des questions, vous pouvez nous contacter.

Cordialement,
**ParcSoft**
📧 support@parcsoft.com
🌐 https://parcsoft.com

@endcomponent







