<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Prestation extends Model
{


    use HasFactory;

    public $table = 'prestations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'pest_date',

    ];

    protected $fillable = [
        'code',
        'name',
        'status',
        'pest_date',
        'duration_days',
        'type',
        'file_path',
        'user_id',
        'client_id',
        'montant',

        'observation',
        'obs_debut_date',
        'obs_fin_date',
        'obs_debut_time',
        'obs_fin_time',
        'pest_fin_date',
        'prest_debut_time',
        'prest_fin_time',
        'pestclot_date',
        'fac_date',
    ];



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($prests) {
            $prests->code = self::generateCode();
        });


    }

    public static function generateCode()
    {
        // Récupérer le dernier code généré
        $lastCode = DB::table('prestations')->orderBy('id', 'desc')->value('code');

        if ($lastCode) {
            // Extraire le numéro de la fin du dernier code
            $number = (int)substr($lastCode, -7);
            $newNumber = str_pad($number + 1, 7, '0', STR_PAD_LEFT);
        } else {
            // Si aucun code n'existe encore
            $newNumber = str_pad(1, 7, '0', STR_PAD_LEFT);
        }

        return 'Presta-' . $newNumber;
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
