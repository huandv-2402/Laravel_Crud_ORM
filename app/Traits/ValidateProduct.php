<?php
  

namespace App\Traits;

use App\Models\Product;

trait ValidateProduct {

    public function validateName($name, &$error){
        if(empty($name)){

            $error = " * Tên không được bỏ trống";            
            return false;
        }

        if(strlen($name) < 8){
            $error = " * Độ dài tên không được < 8 ký tụ";            
            return false;
        }elseif(strlen($name) > 150){
            $error = " * Độ dài tên không được > 150 ký tụ";                
            return false;
        }


        if(count(Product::where("name","like",$name)->get()) != 0 ){
            $error = " * Tên đã tồn tại";
            return false;
        }

        return true;
    }

    public function validateNameUpdate($name, &$error){
        if(empty($name)){

            $error = " * Tên không được bỏ trống";            
            return false;
        }

        if(strlen($name) < 8){
            $error = " * Độ dài tên không được < 8 ký tụ";            
            return false;
        }elseif(strlen($name) > 150){
            $error = " * Độ dài tên không được > 150 ký tụ";                
            return false;
        }

        return true;
    }
    
    
    public function validateDescription($description, &$error){
        if(empty($description)){

            $error = " * Mô tả không được bỏ trống";            
            return false;
        }

        return true;
    }



    public function validatePrice($price,&$error){
        if(empty($price)){

            $error = " * Giá tiền không được bỏ trống";            
            return false;
        }

        if($price <= 0){
            $error = " * Giá tiền không được âm";            
            return false;
        }

        if($price > 9999999.99){
            $error = " * Giá tiền vượt quá giới hạn";            
            return false;
        }

        return true;
    }

    public function validateQuantity($quantity,&$error){
        if(empty($quantity)){

            $error = " * Số lượng không được bỏ trống";            
            return false;
        }

        if($quantity <= 0){
            $error = " * Số lượng không được âm";            
            return false;
        }

        return true;
    }


}

?>