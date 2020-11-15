<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = "products";

    protected $fillable = [
        'code_id','name','description','price', 'stock','category_id','created_at', 
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);    
    }
}
