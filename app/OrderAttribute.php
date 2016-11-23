<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderAttribute extends Model
{
    protected $table = 'order_attributes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'deductible_price'
    ];


    /**
     * Get the order that owns the atributeorder.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
