<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOffer extends Model
{
    use HasFactory;
    protected $fillable=['product_id','quantity','price','address','phone','user_id'];
    protected $table='product_offers';

    public function getProduct()
    {
        return $this->belongsTo(Blog::class,'product_id','id');
    }
}
