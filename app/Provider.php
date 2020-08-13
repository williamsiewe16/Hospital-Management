<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    public function machines(){
        return $this->hasMany("App\Machine");
    }
}
