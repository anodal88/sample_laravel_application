<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $table = 'order_lines';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price','tax','quantity','discount','total','project_id','order_id'
    ];

    /*Get project of the orderline*/
    public function project()
    {
        return $this->belongsTo('App\Project','project_id');
    }

    /*Get order of the orderline*/
    public function order()
    {
        return $this->belongsTo('App\Order','order_id');
    }
    /*
     * Function that calculate the totals of the line
     * and is called from event listeners
     * */
    public function calculateTotals(){
        $this->total= ($this->price*$this->quantity)+$this->tax+$this->discount;
    }

}
