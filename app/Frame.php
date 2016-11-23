<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    protected $table = 'frames';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'top','left','bottom','right'
    ];


    /**
     * Get the project for the frame.
     */
    public function project()
    {
        return $this->hasMany('App\Project');
    }
}
