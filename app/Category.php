<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected $with = ['type'];

    public function recipe()
    {
        return $this->hasMany(Recipe::class);
    }
}
