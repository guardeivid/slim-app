<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'lavalle.usuarios';

    protected $fillable = ['nombre', 'email', 'password'];
}