<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Resalt extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cleanTime', 'date', 'sectionId'
    ];

    protected $with = [
        'section', 'resaltValues'
    ];

    public function section()
    {
        return $this->belongsTo(RiverSection::class, 'sectionId');
    }

    public function resaltValues()
    {
        return $this->belongsToMany(ResaltValue::class, 'resalt_values', 'resaltId');
    }

    public function setResaltValuesAttribute($value) {
        $this->resaltValues()->sync($value);
    }
}
