<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Email extends Model
{
    use HasFactory;


    use HasFactory;

    public $table = 'emails';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [

            'code',
            'name',
            'email',
            'user_id',

    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($email) {
            $email->code = self::generateCode();
        });


    }

    public static function generateCode()
    {
        // Récupérer le dernier code généré
        $lastCode = DB::table('emails')->orderBy('id', 'desc')->value('code');

        if ($lastCode) {
            // Extraire le numéro de la fin du dernier code
            $number = (int)substr($lastCode, -7);
            $newNumber = str_pad($number + 1, 7, '0', STR_PAD_LEFT);
        } else {
            // Si aucun code n'existe encore
            $newNumber = str_pad(1, 7, '0', STR_PAD_LEFT);
        }

        return 'Mail-' . $newNumber;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
 public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class, 'email_subscriptions');
    }
}

