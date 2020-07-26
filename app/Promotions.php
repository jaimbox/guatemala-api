<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotions extends Model
{
    protected $fillable = ['title', 'price', 'address', 'latitude', 'longitude'];
}
