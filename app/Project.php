<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'hash_name','price','preview','favorite'
    ];

    /**
     * Get the text of the project.
     */
    public function text()
    {
        return $this->hasOne('App\Text');
    }
    /**
     * Get the iamge for the project.
     */
    public function images()
    {
        return $this->hasMany('App\Image');
    }

    /**
     * Get the frame that owns the project.
     */
    public function frame()
    {
        return $this->belongsTo('App\Frame','frame_id');
    }


    /**
     * Get the color that owns the project.
     */
    public function background_color()
    {
        return $this->belongsTo('App\Color','background_color_id');
    }


    /**
     * Get the order lines where project was included.
     */
    public function orderLines()
    {
        return $this->hasMany('App\OrderLine');
    }

    /**
     * Get the order that owns the project.
     */
    public function owner()
    {
        return $this->belongsTo('App\User','owner_id');
    }


    /**
     * Get the MatteTemplate that owns the project.
     */
    public function mattetemplate()
    {
        return $this->belongsTo('App\MatteTemplate','matte_template_id');
    }

    public function getDescripcion(){
        return "Project Name: ".$this->name."Frame: ".$this->frame->name." BackgroundColor: ".$this->background_color->code." Price: ".$this->price;
    }
}
