<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventChild extends Model
{
    public $table = "events_child";
    protected $fillable =[
        'parent_id', 'title', 'start_date', 'end_date'];
}
