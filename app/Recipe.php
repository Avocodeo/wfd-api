<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Ingredient;

class Recipe extends Model
{
    protected $guarded = [];

    protected $with = ['category', 'ingredients'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->withPivot('quantity');
    }
}
