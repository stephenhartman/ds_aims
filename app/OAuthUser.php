<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OAuthUser extends Model
{
    protected $table = 'oauth_users';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
    ];

    protected $hidden = [
    ];

    protected $guarded = [
        'id',
        'user_id',
        'oauth_id',
        'access_token',
        'refresh_token',
        'oauth_driver_id'
    ];


    public function oauthDriver() {
        return $this->hasOne('App\OAuthDriver', 'oauth_driver_id', 'id');
    }
}
