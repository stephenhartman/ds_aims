<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    protected $table = 'occupations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'organization', 'position', 'start_year', 'end_year', 'testimonial'
    ];

    /**
     * Many occupations to one milestone
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alum()
    {
        return $this->belongsTo(Alumnus::class);
    }
}
