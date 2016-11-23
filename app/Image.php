<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'url'
    ];


    /**
     * Get the project that owns the image.
     */
    public function project()
    {
        return $this->belongsTo('App\Project','project_id');
    }

    /**
     * Get the project that owns the image.
     */
    public function ImgTemplate()
    {
        return $this->belongsTo('App\ImgTemplate','imgtemplate_id');
    }
}
