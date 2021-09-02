<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    public function product () {
        return $this->belongsTo('App\Model\Product');
    }

    public function color() {
        return $this->belongsTo(ProductOption::class, 'color_id');
    }

    public function size() {
        return $this->belongsTo(ProductOption::class, 'size_id');
    }
}
