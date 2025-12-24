<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionInvoice extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',

        'invoice_date'

    ];
    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'due_date',
        'amount',
        'currency',
        'status',
        'paid_at',
        'payment_method',
        'transaction_ref',
        'file_path',
        'subscription_id',
        'client_id'
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
