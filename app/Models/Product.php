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
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function toArray()
    {
        $data = parent::toArray();

//        if ($this->getCategory) {
//            $data['category'] = $this->category->toArray();
//        }

        if ($this->category) {
            $data['category_name'] = $this->category->name;
        }

        return $data;
    }
}
