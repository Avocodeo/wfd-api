<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['quantity', 'low', 'high',];

    protected $guarded = [];

    protected $with = ['inventory'];

    public function inventory()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
