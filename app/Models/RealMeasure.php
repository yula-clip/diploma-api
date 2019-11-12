<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class RealMeasure extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value', 'date', 'substance_id'
    ];

    protected $with = [
        'substance', 'measuring_points'
    ];

    public function measuring_points()
    {
        return $this->belongsToMany(MeasuringPoint::class, 'real_measure_measuring_point', 'real_measure_id', 'measuring_point_id');
    }

    public function substance()
    {
        return $this->belongsTo(Substance::class, 'substance_id');
    }

    public function setMeasuringPointsAttribute($value) {
        $this->measuring_points()->sync($value);
    }
}
