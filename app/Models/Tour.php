<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $timestamp = true;

 	protected $guarded = [];

 	public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

    public function tourTicket(){
        return $this->hasOne(TourTicket::class);
    }
}
