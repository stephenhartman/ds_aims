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
     * One alum has one milestone
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function milestone()
    {
        return $this->hasOne(Milestone::class);
    }
}
