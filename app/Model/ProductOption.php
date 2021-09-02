<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function productVariants() {
        return $this->hasMany('App\Models\ProductVariant');
    }
}
