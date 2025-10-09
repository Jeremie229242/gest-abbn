<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;

use App\Models\Permission;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Role extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'roles';

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


    // Mutateur pour le slug
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }
   

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles', "role_id", "user_id");
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}

