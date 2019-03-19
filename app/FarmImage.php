<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FarmImage extends Model
{
    protected $table = 'farm_images';
    public function farm(){
        return $this->belongsTo('App\Farm', 'farm_id');
    }
}
