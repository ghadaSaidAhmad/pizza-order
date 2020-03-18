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
        'name','status', 'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['user'];

    protected $appends = ['user_name','user_address'];

     /**
     * Get the user that order this order.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getUserNameAttribute()
    {
        return $this->attributes['UserName'] = $this->user->name;
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getUserAddressAttribute()
    {
        return $this->attributes['UserAddress'] = $this->user->address;
    }


    /**
     * Get the items for the order post.
     */

    public function items()
    {
    
    return $this->hasMany('App\Item');
    }
}
