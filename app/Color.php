<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code'
    ];


    /**
     * Get the project for the frame.
     */
    public function project()
    {
        return $this->hasMany('App\Project');
    }
}
