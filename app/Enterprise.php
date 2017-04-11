<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    public $fillable = ['name', 'address', 'contacts', 'phone'];
}
