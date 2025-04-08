<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'seller_id', 'name', 'description', 'price', 'image_url', 'category_id', 'condition', 'status', 'brand'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function getIsSoldAttribute()
    {
        return $this->transaction()->exists();
    }
}
