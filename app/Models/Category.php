<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'image', 'parent_id'];
    protected $table = 'categories';

    public function child()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id')->withDefault([
            "name" => "قسم رئيسي"
        ]);
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'category_id');
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
}
