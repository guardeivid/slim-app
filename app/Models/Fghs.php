<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fghs extends Model
{
    
    /* Table Name */
    protected $table = 'usuarios';

    /* Mass Assignment */
    protected $fillable = ['nombre','email','editor'];
}