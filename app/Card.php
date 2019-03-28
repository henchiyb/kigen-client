<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'Card';
    public function user()
    {
        return $this->belongsTo('App\User', "userId");
    }
}
