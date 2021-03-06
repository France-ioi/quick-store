<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataRecord extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'user_id', 
        'key',
        'value',
        'last_access'
    ];


    public static function boot()
    {
        parent::boot();
        $cfg = config('data_record');
        self::creating(function($model) use ($cfg) {
            $model->key = substr($model->key, 0, $cfg['key_max_length']);
            $model->value = substr($model->value, 0, $cfg['value_max_length']);
        });
        self::updating(function($model) use ($cfg) {
            $model->key = substr($model->key, 0, $cfg['key_max_length']);
            $model->value = substr($model->value, 0, $cfg['value_max_length']);
        });
    }    

}
