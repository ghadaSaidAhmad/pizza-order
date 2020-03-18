<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pizza_id', 'order_id','size','number'
    ];

     /**
     * Get the user that order this order.
     */
    public function Order()
    {
        return $this->belongsTo('App\Order');
    }

    
}
