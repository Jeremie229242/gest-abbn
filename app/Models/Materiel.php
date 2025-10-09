<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Materiel extends Model
{
    use HasFactory;

    use SoftDeletes;
    use HasFactory;

    public $table = 'materiels';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
            'code',
            'ordi',
            'type',
            'numero',
            'capacite',
            'ram',
            'marque',
            'apartpers',
            'apartsite',
            'etat',
            'personnel_id',
            'site_id',
            'user_id',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($materiel) {
            $materiel->code = self::generateCode($materiel->ordi, $materiel->marque);
        });

        static::updating(function ($materiel) {
            if ($materiel->isDirty('ordi')) {
                $materiel->code = self::generateCode($materiel->ordi, $materiel->marque);
            }
        });
    }

    public static function generateCode($ordi, $marque)
    {
        $ordiPart = strtoupper(substr($ordi, 0, 3));
        $marquePart = strtoupper(substr($marque, 0, 3));


        // Récupérer le dernier code généré qui correspond au format
        $lastCode = DB::table('materiels')
            ->where('code', 'like', "SM-MAT-$ordiPart-$marquePart%")
            ->orderBy('id', 'desc')
            ->value('code');

        if ($lastCode) {

            // Extraire le numéro de la fin du dernier code

            $number = (int)substr($lastCode, -8);
            $newNumber = str_pad($number + 1, 8, '0', STR_PAD_LEFT);
        } else {
            // Si aucun code n'existe encore

            $newNumber = str_pad(1, 8, '0', STR_PAD_LEFT);
        }

        return "SM-MAT-$ordiPart-$marquePart-$newNumber";
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'personnel_id');
    }

    
    public function site()
    {
        return $this->belongsTo(Site::class);
    }




}
