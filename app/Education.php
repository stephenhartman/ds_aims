<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
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
     * Many educations to one milestone
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alum()
    {
        return $this->belongsTo(Alum::class);
    }
}
