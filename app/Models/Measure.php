<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value', 'substId', 'measPointId'
    ];

    protected $with = [
        'substance', 'measuring_point'
    ];

    public function substance()
    {
        return $this->belongsTo(Substance::class, 'substId');
    }

    public function measuring_point()
    {
        return $this->belongsTo(MeasuringPoint::class, 'measPointId');
    }
}
