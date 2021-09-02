<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;

class OrderMaster extends Model
{
    protected $table = 'order_master';
    public function orderDetails() {
        return $this->hasMany('Model\Front\OrderDetail');
    }
}
