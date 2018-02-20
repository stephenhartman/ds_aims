<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumnus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'phone_number', 'social_pref', 'street_address', 'city', 'state', 'zipcode',
        'year_graduated', 'volunteer', 'photo_url'
    ];

    /**
     * One user has one alum
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * One alum has many education milestones
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    /**
     * One alum has many occupation milestones
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function occupations()
    {
        return $this->hasMany(Occupation::class);
    }
}
