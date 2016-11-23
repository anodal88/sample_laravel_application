<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address','appartment_number','zip_code','longitude','latitude'
    ];




    /**
     * Get the city that owns the location.
     */
    public function city()
    {
        return $this->belongsTo('App\City','city_id');
    }

    /**
     * Users under the Location.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
