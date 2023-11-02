<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_name',
        'area',
        'genre',
        'overview',
        'picture',
    ];

    public function favorites(){
        return $this->belongsToMany(User::class);
    }

    public function reservations(){
        return $this->belongsToMany(User::class);
    }

    public function scopeAreaSearch($query,$area_keyword){
        if(!empty($area_keyword)){
            $query->where('area', $area_keyword);
        }
    }
    public function scopeGenreSearch($query, $genre_keyword)
    {
        if (!empty($genre_keyword)) {
            $query->where('genre', $genre_keyword);
        }
    }
    public function scopeTextSearch($query, $text_keyword)
    {
        if (!empty($text_keyword)) {
            $query->where('store_name', 'like', '%' . $text_keyword . '%');
        }
    }

}
