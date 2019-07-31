<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppEnvironment extends Model
{
    use SoftDeletes;

    public function user()
        {
            return $this->hasMany('App\User');
        }
    public function app_details()
        {
            return $this->belongsTo('App\AppDetails');
        }
}
