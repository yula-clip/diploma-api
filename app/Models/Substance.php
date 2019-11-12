<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Substance extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'latinName', 'coefficient1', 'coefficient2', 'coefficient3', 'unitsMeasure', 'validValues', 'status'
    ];
}
