<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
  
    protected $table = "categories";

    protected $fillable = [
        'code_id','name','description', 
    ];
    
    public function product()
    {
        return $this->hasMany(Product::class);    
    }

}
