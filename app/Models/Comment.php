<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    public function user() {
        return $this->belongsTo('App\Models\User', 'id_user', 'id');
    }
}
