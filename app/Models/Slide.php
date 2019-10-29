<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class Slide extends Model
{
    protected $table = 'slides';
    protected $dates = ['created_at', 'created_at'];
    protected $fillable = ['name', 'image', 'order'];
}
