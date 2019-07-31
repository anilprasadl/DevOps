<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppDetails extends Model
{
    use SoftDeletes;

    public function user()
        {
            return $this->hasMany('App\User');
        }
    public function app_env()
        {
            return $this->hasMany('App\AppEnvironment');        
        }
}
