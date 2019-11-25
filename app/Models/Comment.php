<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['id_product', 'id_user', 'content', 'user_name', 'reply'];

    public function user() {
        return $this->belongsTo('App\Models\User', 'id_user', 'id');
    }


    public function product() {
        return $this->belongsTo('App\Models\Product', 'id_product', 'id');
    }

    public static function getComment($searchData) {
        $query = DB::table('comments')
            ->select('comments.*', 'products.name', 'users.email as user_mail')
            ->leftJoin('products', 'products.id', '=','comments.id_product')
            ->leftJoin('users', 'users.id', '=','comments.id_user')
            ->orderBy('comments.id', 'DESC');
        if (isset($searchData['content'])) {
            $query->where('comments.content', 'LIKE', '%'.$searchData['content'].'%');
        }
        return $query->paginate();
    }
}
