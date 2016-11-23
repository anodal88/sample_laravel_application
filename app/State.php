<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code'
    ];


    /**
     * Get the country that owns the state.
     */
    public function country()
    {
        return $this->belongsTo('App\Country','country_id');
    }


    /**
     * Get the city for the state.
     */
    public function cities()
    {
        return $this->hasMany('App\City');
    }

}
