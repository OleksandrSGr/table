<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tables extends Model
{
    protected $table = 'content';
    public $timestamps = false;
    protected $guarded = [];
}
