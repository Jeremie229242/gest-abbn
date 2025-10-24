<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestationObservation extends Model
{
    protected $fillable = [
        'prestation_id',
        'observation',
        'obs_debut_date',
        'obs_fin_date',
        'obs_debut_time',
        'obs_fin_time'
    ];

    public function prestation()
    {
        return $this->belongsTo(Prestation::class);
    }
}

