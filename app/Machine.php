<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{

    protected $fillable = [
        "name", "model", "function", "threat", "description", "status", "addDate", "lastStatusUpdateDate"
    ];

    public $timestamps = false;
}
