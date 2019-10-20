<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $guarded = [];

    protected $with = ['type'];

    public function type()
    {
        return $this->belongsTo(MeasurementType::class);
    }
}
