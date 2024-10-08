<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = "products";
    public $primaryKey = "id";
    public $timestamps = true;
    public $attribute = [];
    public $fillable = ["name","image","description","price","quantity","category_id"];

    public function Category(){
        return $this -> belongsTo(Category::class,"category_id");
    }

    public function nameCategory(){
        if($this -> Category == NULL){
            return "Chưa phân loại";
        }else{
            return ($this -> Category) -> name;
        }
    }

    public function CategoryId(){
        if($this -> Category == NULL){
            return 0;
        }else{
            return ($this -> Category) -> id;
        }
    }
}
