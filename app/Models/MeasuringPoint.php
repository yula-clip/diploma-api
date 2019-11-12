<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MeasuringPoint extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'x', 'y', 'river_section_id', 'measure_id'
    ];

    public function river_section()
    {
        return $this->belongsTo(RiverSection::class, 'river_section_id');
    }
}
