<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Client extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'clients';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [

        'rai_soci',
        'intitule',
        'adresse',
        'numero',
        'inter_prin',
        'pays',
        'ville',
'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function emails()
{
    return $this->belongsToMany(Email::class, 'email_clients');
}

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subscriptions()
{
    return $this->hasMany(Subscription::class);
}

    public function prestations()
{
    return $this->hasMany(Prestation::class);
}

}
