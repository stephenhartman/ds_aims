<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /** The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'settings' => 'array'
    ];

    /**
     * One user has one alum
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function alum()
    {
        return $this->hasOne(Alum::class);
    }

    /**
     * One user to many posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Many users to many roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Authorize roles within the scope of a controller
     *
     * @param $roles
     * @return bool
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles);
        }
        return $this->hasRole($roles) || redirect('/welcome')->with('status', 'Unauthorized!');
    }

    /**
     * Check multiple roles
     *
     * @param $roles
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Check a single role
     *
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }
}
