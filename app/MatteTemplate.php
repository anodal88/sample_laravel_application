<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatteTemplate extends Model
{
    protected $table = 'matte_templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'orientation', 'description', 'thumbnail','height','width','margin','rows','columns','html_template'
    ];



    /**
     * Get the projects for that matte .
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }
    /*Function that return an array*/
    public function getSpecifications(){

        foreach ($this->getFillable() as $field)
        {
            if($field!='description' && $field!='name' && $field!='thumbnail')
                $result[$field]= $this[$field];

        }


        foreach ($this->imgtemplates as $img)
        {
            $imgtpl=$img->getSpecifications();
            $imgtpl['idtpl']=$img->id;
            $imgtpl['row']=$img->pivot->row;
            $imgtpl['column']=$img->pivot->column;
            $imgtpl['rowspan']=$img->pivot->rowspan;
            $imgtpl['colspan']=$img->pivot->colspan;
            $imgtpl['marginTop']=$img->pivot->marginTop;
            $imgtpl['marginLeft']=$img->pivot->marginLeft;
            $imgtpl['marginRight']=$img->pivot->marginRight;
            $imgtpl['marginBottom']=$img->pivot->marginBottom;
            $imgtpl['order']=$img->pivot->order;
            $result['images'][]=$imgtpl;
        }
        foreach ($this->engravedplates as $ep){
            $eptpl=$ep->getSpecifications();
            $eptpl['row']=$ep->pivot->row;
            $eptpl['column']=$ep->pivot->column;
            $eptpl['rowspan']=$ep->pivot->rowspan;
            $eptpl['colspan']=$ep->pivot->colspan;
            $eptpl['marginTop']=$ep->pivot->marginTop;
            $eptpl['marginLeft']=$ep->pivot->marginLeft;
            $eptpl['marginRight']=$ep->pivot->marginRight;
            $eptpl['marginBottom']=$ep->pivot->marginBottom;
            $eptpl['order']=$ep->pivot->order;
            $result['engravedplates'][]=$eptpl;
        }
        return $result;
    }

    /**
     * imgtemplate of the matte template
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function imgtemplates()
    {
        return $this->belongsToMany('App\ImgTemplate','imgtemplate_mattetemplate','mattetemplate_id','imgtemplate_id')
            ->withPivot('row', 'column','rowspan','colspan','marginTop',
            'marginLeft','marginRight','marginBottom','order')
            ->withTimestamps();
    }
    /**
     * imgtemplate of the matte template
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function engravedplates()
    {
        return $this->belongsToMany('App\EngravedPlate','engravedplate_mattetemplate','mattetemplate_id','engravedplate_id')
            ->withPivot('row', 'column','rowspan','colspan','marginTop',
            'marginLeft','marginRight','marginBottom','order')
            ->withTimestamps();
    }

    /**
     * Get the shipping box.
     */
    public function shippingbox()
    {
        return $this->belongsTo('App\ShippingBox','shippingbox_id');
    }
    /**
     * Get the Size .
     */
    public function size()
    {
        return $this->belongsTo('App\Size','size_id');
    }
}
