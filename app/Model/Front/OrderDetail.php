<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    public function orderMaster() {
        return $this->belongsTo('Model\Front\OrderMaster', 'order_id');
    }
}
