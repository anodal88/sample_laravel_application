<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /*I just add the relationships id to handle mor fast with create methods*/
        'notes', 'order_number','order_date','shipping_date','total','total_taxes','discounts','user_id','status_id'
    ];

    /*Override __construct to define the number of the order*/
    function __construct( $attributes = array())
    {
        parent::__construct($attributes);
        $this->order_number= strtoupper(unique_random("orders","order_number",10));
    }

    /**
     * Get the status that owns the order.
     */
    public function status()
    {
        return $this->belongsTo('App\Status','status_id');
    }


    /**
     * Get attributes of the order.
     */
    public function OrderAttributes()
    {
        return $this->hasMany('App\AttributeOrder');
    }

    /**
     * Get transactions of the order.
     */
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }


    /**
     * Get the order lines of the order.
     */
    public function orderLines()
    {
        return $this->hasMany('App\OrderLine');
    }
    /*Funtion that update the totalof the order*/
    public function updateTotal(){
        $this->total=0;
        foreach ($this->orderLines as $line){
            $this->total+=$line->total;
        }
    }

}
