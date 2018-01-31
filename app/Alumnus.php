<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumnus extends Model
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
     * One user has one alum
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * One alum has many education milestones
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    /**
     * One alum has many occupation milestones
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function occupations()
    {
        return $this->hasMany(Occupation::class);
    }
}
