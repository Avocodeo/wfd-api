<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $guarded = [];

    protected $with = ['recipe'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
