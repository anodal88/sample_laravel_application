<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password', 'api_token', 'active'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];

    /**
     * Roles of the user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }



    /**
     * Orders of the user.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }



    /**
     * Get the location of the user.
     */
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    /**
     * Get the project for the user.
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    /**
     * Get the project for the user.
     */
    public function creditcards()
    {
        return $this->hasMany('App\CreditCard');
    }




}

