<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    protected $table = 'texts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
    ];



    /**
     * Get the Matte record associated
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    /**
     * Get the EngravedPlatte record associated
     */
    public function engravedplate()
    {
        return $this->belongsTo('App\EngravedPlate');
    }
}
