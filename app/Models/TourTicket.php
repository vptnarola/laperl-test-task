<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourTicket extends Model
{
    use HasFactory;
    protected $timestamp = true;

 	protected $guarded = [];

 	public function tour(){
        return $this->belongsTo(Tour::class,'tour_id');
    }
}
