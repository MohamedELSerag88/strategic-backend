<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name','status'];


    public function permissions()
    {
        return $this->belongsToMany(Feature::class,'role_permissions', 'role_id', 'feature_id')
            ->withPivot(['has_read', 'has_create','has_update','has_delete']);
    }

}
