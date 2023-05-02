<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'categories_id',
        'price',
        'image',
        'quantity',
    ];

    public $timestamps = true;

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function toArray()
    {
        $data = parent::toArray();

        if ($this->getCategory) {
            $data['category'] = $this->getCategory->toArray();
        }

        return $data;
    }
}
