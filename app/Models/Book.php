<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'price',
        'seller_id',
        'number_purchased',
        // 'author',
        // 'cover',
        'file',
        'description'
    ];

    public function  category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
