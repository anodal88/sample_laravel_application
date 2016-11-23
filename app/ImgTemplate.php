<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImgTemplate extends Model
{
    protected $table = 'img_templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'orientation', 'cornerRadio','height','width'
    ];

    /*Function that return all fillable attributes in a array*/
    public function getSpecifications()
    {
        foreach ($this->getFillable() as $field)
        {
            $result[$field]= $this[$field];
        }
        return $result;
    }



    /**
     * matte template of the imgtemplate
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function mattetemplates()
    {
        return $this->belongsToMany('App\MatteTemplate','imgtemplate_mattetemplate','imgtemplate_id','mattetemplate_id')
            ->withPivot('row', 'column','rowspan','colspan','marginTop',
                'marginLeft','marginRight','marginBottom','order')
            ->withTimestamps();
    }

    /**
     * Get the iamges related with this imgTemplate.
     */
    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
