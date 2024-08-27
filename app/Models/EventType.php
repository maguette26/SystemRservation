<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    protected $fillable = ['categorie'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
    use HasFactory;
}
