<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintainer extends Model
{

    protected $fillable = [
        "id", "name", "status", "expertise"
    ];

    public $timestamps = false;

    public function maintainedMachines (){
        return $this->belongsToMany("App\Maintainer")->withPivot(["date"]);
    }
}
