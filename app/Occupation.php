<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    /**
     * TODO Fillable
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'example',
    ];

    /**
     * Many occupations to one milestone
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alum()
    {
        return $this->belongsTo(Alum::class);
    }
}
