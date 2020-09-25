<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   protected $hidden = [
       'created_at',
       'updated_at',
       'deleted_at',
       'password',
       'remember_token'
   ];
}
