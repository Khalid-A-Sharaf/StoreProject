<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'status', 'payment_method', 'payment_status',];
    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest Customer'
        ]);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details', 'order_id', 'product_id', 'id', 'id')
            ->using(OrderDetail::class)
            ->withPivot([
                'product_name', 'price', 'quantity', 'options',
            ]);
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')->where('type', 'billing');
    }

    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')->where('type', 'shipping');
    }

    protected static function booted()
    {
        static::creating(function (Order $order) {
            $order->number = Order::getNextOrderNumber();
        });
    }

    public static function getNextOrderNumber()
    {
        $year = Carbon::now()->year;
        $number = Order::whereYear('created_at', $year)->max('number');
        if ($number) {
            return $number + 1;
        }
        return $year . '0001';
    }
}
