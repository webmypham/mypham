<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $hidden = ['password'];

    protected $dates = ['created_at', 'created_at'];
    protected $fillable = ['email', 'password', 'name', 'phone', 'address', 'id_role'];

    public static function getUsers($searchData) {
        $query = DB::table('users')
            ->select('users.*')
            ->where('id_role', '<>', 1)
            ->orderBy('users.id', 'DESC');
        if (isset($searchData['email'])) {
            $query->where('users.email', 'LIKE', '%'.$searchData['email'].'%');
        }
        return $query->paginate();
    }


}
