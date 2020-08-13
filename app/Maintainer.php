<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintainer extends Model
{
    public function maintainedMachines (){
        return $this->belongsToMany("App\Maintainer")->withPivot(["date"]);
    }
}
