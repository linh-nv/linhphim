<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Movie extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function genre(){
        return $this->belongsTo(Genre::class,'genre_id','id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function episode(){
        return $this->hasMany(Episode::class);
    }
    public function movie_genre(){
        return $this->belongsToMany(Genre::class,'movie_genre','movie_id','genre_id');
    }
    public function views(){
        return $this->hasMany(View::class);
    }
    
}
