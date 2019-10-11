<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $guarded = [];

    public function measurement() {
        return $this->belongsTo(Measurement::class);
    }
}
