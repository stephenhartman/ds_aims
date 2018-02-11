<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventChild extends Model
{
    use SoftDeletes;

    public $table = "events_child";
    protected $fillable =[
        'parent_id', 'title', 'start_date', 'end_date'];
    protected $dates = ['deleted_at'];
}
