<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $guarded = [];

    protected $with = ['supplier'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
