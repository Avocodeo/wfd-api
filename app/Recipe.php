<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $guarded = [];

    protected $with = ['recipe'];

    public function categoy()
    {
        return $this->belongsTo(Category::class);
    }
}
