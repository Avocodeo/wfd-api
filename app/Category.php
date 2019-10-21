<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected $with = ['type'];

    public function type()
    {
        return $this->belongsTo(Category::class);
    }
}
