<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'height', 'width','name'
    ];



    /**
     * Get the mattetemplates that can be shipped on this box .
     */
    public function mattetemplates()
    {
        return $this->hasMany('App\MatteTemplate');
    }
}
