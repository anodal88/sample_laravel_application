<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingBox extends Model
{
    protected $table = 'shippingboxes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'boxname', 'height', 'width', 'weight','depth'
    ];

    /**
     * Get the mattetemplates that can be shipped on this box .
     */
    public function mattetemplates()
    {
        return $this->hasMany('App\MatteTemplate');
    }
}
