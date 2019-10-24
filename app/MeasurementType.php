<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeasurementType extends Model
{
    protected $guarded = [];

    public function measurement()
    {
        return $this->hasMany(Measurement::class);
    }
}
