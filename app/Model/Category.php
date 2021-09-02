<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = ['title','parent_id'];

    public function childs() {
        return $this->hasMany('App\Model\Category','parent_id','id') ;
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
