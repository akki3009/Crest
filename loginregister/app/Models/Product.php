<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable=['pname','cname','productcode','price','saleprice','quantity','porder','pstatus'];

    public function imagenames(){
        return $this->hasMany(ProductImage::class,'productid');
    }
    public function categoryname()
    {
        return $this->belongsTo(Category::class,'cname');
    }
}
