<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventSignUp extends Model
{
    use SoftDeletes;

    public $table = "event_sign_ups";
    protected $fillable = [
        'user_id', 'event_id', 'number_attending', 'notes'];
    protected $dates = ['deleted_at'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }

}
