<?php
  

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait ValidateCategory {


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


        if(count(DB::table("categories")->where("name","like",$name)->get()) != 0 ){
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


}

?>