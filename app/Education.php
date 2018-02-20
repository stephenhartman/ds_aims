<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school', 'location', 'start_year', 'end_year', 'testimonial'
    ];

    /**
     * Many educations to one milestone
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alumnus()
    {
        return $this->belongsTo(Alumnus::class);
    }
}
