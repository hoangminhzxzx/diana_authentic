<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function ProductVariants () {
        return $this->hasMany('App\Model\ProductVariant');
    }
}
