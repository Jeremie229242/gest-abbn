<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subscription extends Model
{



    use HasFactory;

    public $table = 'subscriptions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'subscription_date',
         'expiration_date'
    ];

    protected $fillable = [
        'code',
        'name',
        'subscription_date',
        'expiration_date',
        'remind_before_days',
        'type',
        'parent_id',
        'user_id',
        'client_id',
        'resilier',
        'motif',
'qnadb',
        'status',
        'position',

    ];



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subs) {
            $subs->code = self::generateCode();
        });


    }

    public static function generateCode()
    {
        // Récupérer le dernier code généré
        $lastCode = DB::table('subscriptions')->orderBy('id', 'desc')->value('code');

        if ($lastCode) {
            // Extraire le numéro de la fin du dernier code
            $number = (int)substr($lastCode, -7);
            $newNumber = str_pad($number + 1, 7, '0', STR_PAD_LEFT);
        } else {
            // Si aucun code n'existe encore
            $newNumber = str_pad(1, 7, '0', STR_PAD_LEFT);
        }

        return 'Abonn-' . $newNumber;
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function invoices()
{
    return $this->hasMany(SubscriptionInvoice::class);
}

// Abonnement précédent
public function parent()
{
    return $this->belongsTo(Subscription::class, 'parent_id');
}

// Renouvellements
public function renewals()
{
    return $this->hasMany(Subscription::class, 'parent_id')
        ->orderByDesc('subscription_date');
}

public function notifications()
{
    return $this->hasMany(SubscriptionNotification::class);
}









}
