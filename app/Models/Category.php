<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title'];

    public function codes()
    {
        return $this->belongsToMany(Code::class);
    }

    public function code_listing()
    {
        return $this->hasMany(Code::class);
    }
}