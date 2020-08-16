<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{

    protected $fillable = [
        "id", "code", "name",  "service", /*"function", "threat", "description", "status",*/ "cost", "origin", "addDate", "expirationDate" //"lastStatusUpdateDate"
    ];

    public $timestamps = false;

    public function provider (){
        return $this->belongsTo("App\Provider");
    }

    public function maintainers (){
        return $this->belongsToMany("App\Maintainer")->withPivot(["date"]);
    }
}
