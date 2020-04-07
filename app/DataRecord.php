<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataRecord extends Model
{
    protected $fillable = [
        'user_id', 
        'key',
        'value'
    ];
}
