<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $guarded = [];

    protected $with = ['ingredient'];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
