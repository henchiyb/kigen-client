<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    public function post()
    {
        return $this->belongsTo('App\Product');
    }
    public function getImgLink(){
        return $this->img_link;
    }
}
