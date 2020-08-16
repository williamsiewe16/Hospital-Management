<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{

    protected $fillable = [
        "id", "name", "contractNumber", "warranty", "nativeCountry"
    ];

    public $timestamps = false;

    public function machines(){
        return $this->hasMany("App\Machine");
    }
}
