<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function productCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function productThumbnail()
    {
        return $this->hasOne(Thumbnail::class);
    }

    public function productPrices()
    {
        return $this->hasOne(Price::class);
    }
}
