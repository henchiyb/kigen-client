<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    public function images(){
        return $this->hasMany('App\FarmImage', 'farm_id');
    }
}
