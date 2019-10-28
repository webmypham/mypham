<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $table = 'categories';
    protected $perPage = 20;
    protected $dates = ['created_at', 'created_at'];
    protected $fillable = ['name', 'id_parent', 'is_parent', 'image'];

    public static function getParent() {
        return DB::table('categories')->where('is_parent', 1)->get();
    }

    public static function getChild($id_parent) {
        return DB::table('categories')
            ->where('is_parent', 0)
            ->where('id_parent', $id_parent)
            ->get();
    }

    /**
     * Get list categories from database.
     *
     * @param Array $data
     * @return Collection
     */
    public static function getCategories(array $data)
    {
        $builder = DB::table('categories')
            ->select('categories.*', 'parent.name as parent_name')
            ->leftJoin('categories as parent', 'categories.id_parent', '=', 'parent.id')
            ->orderBy('created_at', 'DESC');

        if (isset($data['name'])) {
            $builder->searchLike(['name' => $data['name']]);
        }

        if (isset($data['parent_id'])) {
            $builder->search(['parent_id' => $data['parent_id']]);
        }

        return $builder->paginate();
    }

    public static function getCategory($id) {
        $builder = DB::table('categories')
            ->select('categories.*', 'parent.name as parent_name')
            ->leftJoin('categories as parent', 'categories.id_parent', '=', 'parent.id')
            ->where('categories.id', '=', $id);
        return $builder->first();
    }

    public static function getCategoryChild($id) {
        $query = DB::table('categories')
            ->select('categories.*')
            ->where('id_parent', '=', $id)
            ->orWhere('id', '=', $id)
            ->get();
        return $query->toArray();
    }
}
