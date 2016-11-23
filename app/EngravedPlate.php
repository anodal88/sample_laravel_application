<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EngravedPlate extends Model
{
    protected $table = 'engravedplates';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','height','width','plateStyle','textStyle'
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
        return $this->belongsToMany('App\MatteTemplate','engravedplate_mattetemplate','engravedplate_id','mattetemplate_id')
            ->withPivot('row', 'column','rowspan','colspan','marginTop',
                'marginLeft','marginRight','marginBottom','order')
            ->withTimestamps();
    }

    /**
     * Get the texts related with this engravedplate.
     */
    public function texts()
    {
        return $this->hasMany('App\Text');
    }
}
