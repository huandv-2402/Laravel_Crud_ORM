<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = "Categories";
    public $primaryKey = "id";
    // public $incrementing = true;

    public $timestamps = true;

    public $attribute = [
        "image" => "avatar-2.jpg"
    ];

    public $fillable = ["name","image"];

    public function Products(){
        return $this -> hasMany(Product::class,"category_id");
    }


    public function countProducts(){
        return count($this -> Products);
    }
}
