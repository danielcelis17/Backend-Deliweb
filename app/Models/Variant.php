<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    //Relacion uno a muchos inversa
    public function products(){
        return $this->belongsToMany(Product::class);
    }

    //Relacion muchos a muchos
     public function features(){
        return $this->belongsToMany(Feature::class)->withPivot('value')->withTimestamps();
    }
}
