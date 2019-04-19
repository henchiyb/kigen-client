<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "user";
    
    public function hasRole($role){
        return ($role == $this->role);
    }

    public function card(){
        return $this->hasOne('App\Card', 'userId');
    }

    public function addEmployer(User $user){
        $this->employers()->attach($user->id);
    }

    public function removeEmployer(User $user){
        $this->employers()->detach($user->id);
    }

    public function employers(){
        return $this->belongsToMany('App\User', 'manager_employers',
            'manager_id', 'employer_id');
    }

    public function getRoles(){
        return $this->belongsToMany('App\Role\Role', 'user_role',
            'user_id', 'role_id');
    }
}
