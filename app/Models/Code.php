<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
       // Allow mass assignment for these attributes
       protected $fillable = [
        'title',
        'code',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
