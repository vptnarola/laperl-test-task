<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $timestamp = true;

 	protected $fillable = [
        'country_id', 'city_id','name','slug','id_slug'
    ];
}
