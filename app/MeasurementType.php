<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeasurementType extends Model
{
    protected $guarded = [];

    public function measurements()
    {
        return $this->hasMany(Measurement::class);
    }
}
