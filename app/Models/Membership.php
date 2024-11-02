<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type','duration','start_date','end_date','job','nationality','resident_country','phone'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
