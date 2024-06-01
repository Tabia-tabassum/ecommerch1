<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;
    protected $fillable=['post_id','category_id'];

    protected $table='post_categories';

    public function postCategory()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function postDetails()
    {
        return $this->hasOne(Blog::class,'id','post_id');
    }

}
