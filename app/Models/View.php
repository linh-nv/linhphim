<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    public $timestamps = false;
    use HasFactory;
    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id', 'id');
    }
}
