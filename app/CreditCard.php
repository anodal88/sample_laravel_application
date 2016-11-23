<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $table = 'credit_cards';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'localizator', 'number','expire_month','expire_year','type','valid_until','first_name','last_name'
    ];

    /**
     * Get the user owner of the card.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
