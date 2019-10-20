<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class News extends Model
{
    protected $table = 'news';
    protected $perPage = 4;
    protected $dates = ['created_at', 'created_at'];
    protected $fillable = ['title', 'description', 'content', 'thumbnail'];

    public static function getNews($searchData) {
        $query = DB::table('news')
            ->select('news.*')
            ->orderBy('news.id', 'DESC');
        if (isset($searchData['name'])) {
            $query->where('news.title', 'LIKE', '%'.$searchData['title'].'%');
        }
        return $query->paginate();
    }


    public function category() {
        return $this->belongsTo('App\Models\Category', 'id_category', 'id');
    }
}
