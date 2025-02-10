<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image', 'category_id' ,'sales_count',   'is_sponsored', 'is_valentine' ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
