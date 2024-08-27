<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationDetail extends Model
{
    protected $fillable = ['reservation_id','event_id','quantite','prix'];
    use HasFactory;
}
