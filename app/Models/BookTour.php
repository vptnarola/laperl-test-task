<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTour extends Model
{
    use HasFactory;
    protected $timestamp = true;

 	protected $guarded = [];

 	public function tour(){
        return $this->belongsTo(Tour::class,'tour_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
