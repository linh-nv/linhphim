<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Movie_API extends Model
{
    use HasFactory;

    protected $table = 'movies_api';

    protected $fillable = [
        'created',
        'modified',
        '_id',
        'name',
        'slug',
        'origin_name',
        'content',
        'type',
        'status',
        'thumb_url',
        'poster_url',
        'is_copyright',
        'sub_docquyen',
        'chieurap',
        'trailer_url',
        'time',
        'episode_current',
        'episode_total',
        'quality',
        'lang',
        'notify',
        'showtimes',
        'year',
        'view',
        'actor',
        'director',
        'category',
        'country',
        'episodes',
    ];

    protected $casts = [
        'created' => 'array',
        'modified' => 'array',
        'actor' => 'array',
        'director' => 'array',
        'category' => 'array',
        'country' => 'array',
        'episodes' => 'array',
    ];

    public static function createFromApi($slug)
    {
        // Lấy dữ liệu từ API
        $apiData = Http::timeout(120)->get("https://ophim1.com/phim/$slug")->json();

        // Tạo một đối tượng MovieAPI mới
        $movieAPI = new Movie_API();

        // Gán dữ liệu từ API cho các thuộc tính của đối tượng MovieAPI
        foreach ($movieAPI->getFillable() as $field) {
            if ($field === 'episodes') {
                // Xử lý episodes riêng biệt
                $movieAPI->$field = $apiData['episodes'] ?? null;
            } else {
                $movieAPI->$field = $apiData['movie'][$field] ?? null;
            }
        }

        return $movieAPI;
    }
}
