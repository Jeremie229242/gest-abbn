<?php

namespace App\Models;

use App\Models\User;
use App\Models\Role;

use Carbon\Carbon;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Permission extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'permissions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'name',
        'slug',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function fromDateTime($value){
        return Carbon::parse(parent::fromDateTime($value))->format('Y-d-m');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    // Mutateur pour le slug
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_permissions', "user_id", "permission_id");
    }
}
