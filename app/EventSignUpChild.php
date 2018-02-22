<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventSignUpChild extends Model
{
    use SoftDeletes;

    public $table = "event_sign_ups_child";
    protected $fillable = [
        'user_id', 'event_id', 'child_id', 'number_attending', 'notes'
    ];
    protected $dates = ['deleted_at'];

}
