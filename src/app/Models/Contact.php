<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tell',
        'address',
        'building',
        'detail'
    ];

    //category_idのデフォルト値を1に設定
    protected $attributes = [
    'category_id' => 1,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
