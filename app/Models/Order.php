<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Config;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $table = 'orders';
    protected $perPage = 20;
    protected $dates = ['created_at', 'created_at'];
    protected $fillable = [
        'id_user',
        'status',
        'id_payment',
        'status_payment',
        'amount'
    ];

    const NO_RENEWAL = 0;
    const IS_RENEWAL = 1;

    const NO_REASON = 0;
    const IS_REASON = 1;

    const STATUS_DEFAULT = -1;
    const STATUS_WAIT = 0;
    const STATUS_CANCEL = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_START_MEET = 3;
    const STATUS_RENEWAL = 4;
    const STATUS_COMPLETE = 5;
    const STATUS_RATE = 6;
    const STATUS_CANCEL_RENEWAL = 7;
    const STATUS_EDIT = 8;
    const STATUS_TMP = 9;
    const STATUS_DELIVERY = 10;

    const SEEN = 1;
    const NOT_SEEN = 0;

    public static function getList($searchParam) {
        $query = DB::table('orders')
            ->select('orders.*', 'users.name as customer_name')
            ->join('users', 'users.id', '=', 'orders.id_user')
            ->orderBy('orders.id', 'DESC');
        if(isset($searchParam['name'])) {
            $query->where('name', 'LIKE', '%'.$searchParam['name'].'%');
        }
        if(isset($searchParam['phone'])) {
            $query->where('phone', 'LIKE', '%'.$searchParam['phone'].'%');
        }
        return $query->paginate();
    }

    public static function getOrderById($id) {
        $query = DB::table('orders')
            ->select('orders.*', 'users.name as customer_name')
            ->join('users', 'users.id', '=', 'orders.id_user')
            ->where('orders.id', $id)
            ->first();
        return $query;
    }

    public static function getStatusNameAttribute($status)
    {
        switch ($status) {
            case Order::STATUS_WAIT:
                {
                    return "Đang xử lý";
                }
            case Order::STATUS_ACTIVE:
                {
                    return "Đã xác nhận";
                }
            case Order::STATUS_CANCEL:
                {
                    return "Đã huỷ";
                }
            case Order::STATUS_DELIVERY:
                {
                    return "Đang giao hàng";
                }
            case Order::STATUS_COMPLETE:
                {
                    return "Đã giao thành công";
                }
            case Order::STATUS_RATE:
                {
                    return "Đã hoàn thành";
                }
            case Order::STATUS_START_MEET:
                {
                    return "Bắt đầu gặp";
                }
            default:
                return "Không xác định";
        }
    }

    public static function getStatusClassNameAttribute($status)
    {
        switch ($status) {
            case Order::STATUS_WAIT:
                {
                    return "primary";
                }
            case Order::STATUS_ACTIVE:
                {
                    return "info";
                }
            case Order::STATUS_CANCEL:
                {
                    return "danger";
                }
            case Order::STATUS_DELIVERY:
                {
                    return "warning";
                }
            case Order::STATUS_COMPLETE:
                {
                    return "success";
                }
            case Order::STATUS_RATE:
                {
                    return "success";
                }
            case Order::STATUS_START_MEET:
                {
                    return "info";
                }
            default:
                return "default";
        }
    }
}
