<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Sign_Up extends Model
{
    public $table = "user_sign_ups";
    protected $fillable = [
        'user_id', 'event_id', 'number_attending', 'notes'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }

}
