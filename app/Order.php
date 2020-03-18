<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'user_id'
    ];

     /**
     * Get the user that order this order.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * Get the items for the order post.
     */

    public function items()
    {
    
    return $this->hasMany('App\Item');
    }
}
