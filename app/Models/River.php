<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class River extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function sections()
    {
        return $this->hasMany(RiverSection::class, 'river_id');
    }
}
