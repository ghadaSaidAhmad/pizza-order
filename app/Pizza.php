<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'flavor'
    ];

    /**
     * Get the order that contain this pizza.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
