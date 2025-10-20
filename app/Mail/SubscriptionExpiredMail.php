<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\Subscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionExpiredMail extends Mailable
{
    use Queueable;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subscription;

    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: "Rappel : Abonnement {$this->subscription->name} arrive à expiration",
    //     );
    // }
    public function build()
    {
        return $this->subject('⚠️ Abonnement expiré - ' . $this->subscription->name)
                    ->view('emails.expired'); // 🔹 Ton template HTML
    }
    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     return new Content(
    //         markdown: 'emails.expired',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
