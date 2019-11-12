<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class RiverSection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'diffuse', 'river_id', 'diffuse', 'velosity'
    ];

    public function river()
    {
        return $this->belongsTo(River::class, 'river_id');;
    }
}
