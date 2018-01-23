<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
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
     * Many milestones to one alum
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alum()
    {
        return $this->belongsTo(Alum::class);
    }

    /**
     * One milestone has many educations
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    /**
     * One milestone has many occupations
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function occupations()
    {
        return $this->hasMany(Education::class);
    }
}
