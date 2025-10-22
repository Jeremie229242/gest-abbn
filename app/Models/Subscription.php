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
        'file_path',
        'user_id',
        'client_id',
        'resilier',
        'motif',
        'date_res',
        'date_fac',

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



  





}
