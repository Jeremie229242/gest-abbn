<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Maintenances extends Model
{
    use HasFactory;

    use SoftDeletes;
    use HasFactory;

    public $table = 'maintenances';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [

            'code',
            'date_panne',
            'observation',
            'motif',
            'dure',
            'status',
            'reparation',
            'materiel_id',
            'user_id',

    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($maintenance) {
            $maintenance->code = self::generateCode();
        });


    }

    public static function generateCode()
    {
        // Récupérer le dernier code généré
        $lastCode = DB::table('maintenances')->orderBy('id', 'desc')->value('code');

        if ($lastCode) {
            // Extraire le numéro de la fin du dernier code
            $number = (int)substr($lastCode, -7);
            $newNumber = str_pad($number + 1, 7, '0', STR_PAD_LEFT);
        } else {
            // Si aucun code n'existe encore
            $newNumber = str_pad(1, 7, '0', STR_PAD_LEFT);
        }

        return 'SM-MAINT-' . $newNumber;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function materiel()
    {
        return $this->belongsTo(Materiel::class, 'materiel_id');
    }
    public function Site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }
}
