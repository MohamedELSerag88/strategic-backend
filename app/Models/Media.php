<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $guarded = ['id'];

    protected $appends = ['full_path', 'file_type'];

    public function getFullPathAttribute()
    {
        return \URL::to('') . '/' . $this->path;
    }
    public function getFileTypeAttribute()
    {
        if (str_contains($this->type, 'video')) {
            return 'video';
        }
        if (str_contains($this->type, 'audio')) {
            return 'audio';
        }
        if (str_contains($this->type, 'pdf')) {
            return 'pdf';
        }
        return 'image';
    }
}
