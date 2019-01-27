<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class CentroPoblado extends Model
{
    //use SoftDeletes;

    /** Table Names */
    protected $table = 'ign.centros_poblados';

    /** Primary Keys */
    protected $primaryKey = 'gid';
    public $incrementing = true;
    protected $keyType = 'int';

    /** Timestamps */
    public $timestamps = false;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /** Database Connection */
    protected $connection = 'default';

    /** Default Attribute Values */
    protected $attributes = [];

    /** Mass Assignment */
    protected $fillable = [];
    protected $guarded = ['*'];

    /** Date Mutators */
    protected $dates = ['created_at', 'updated_at'];

    /** Hiding Attributes From JSON */
    protected $hidden = [];
    protected $visible = [];
}