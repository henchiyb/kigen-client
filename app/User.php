<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "user";

    public function card(){
        return $this->hasOne('App\Card', 'userId');
    }
}
