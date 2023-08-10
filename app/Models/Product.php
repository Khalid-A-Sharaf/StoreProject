<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'description', 'image', 'price', 'discount_price', 'category_id'];
    protected $table = 'products';
    protected $casts = [
        'color' => 'array'
    ];

    public  function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault();
    }

    public function productColorSize()
    {
        return $this->hasMany(ProductColorSize::class, 'product_id');
    }

    public function productColor()
    {
        return $this->hasMany(ProductColor::class, 'product_id');
    }

    public function productSize()
    {
        return $this->hasMany(ProductSize::class, 'product_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_color', 'product_id', 'color_id', 'id', 'id');
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 'active')->get();
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://kalada.gr/wp-content/uploads/2021/07/on-C100969_Image_01.jpeg';
            // return 'https://www.incathlab.com/images/products/default_product.png';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset($this->image);
    }

    public function getSalePercentAttribute()
    {
        if (!$this->discount_price) {
            return 0;
        }
        return number_format(100 - (100 * $this->price / $this->discount_price), 0);
        // return round(100 - (100 * $this->price / $this->discount_price), 0);
    }
}
