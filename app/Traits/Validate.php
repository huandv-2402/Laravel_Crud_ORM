<?php

    namespace App\Traits;

    use Illuminate\Support\Facades\DB;

    trait Validate{

        public function validateName($name, &$error){

            if(empty($name)){

                $error["name"] = "* Tên không được bỏ trống";
                return false;


            }elseif(strlen($name) <= 8){

                $error["name"] = "* Độ dài tên phải > 8 ký tự";
                return false;


            }elseif(strlen($name) >= 60){

                $error["name"] = "* Độ dài tên phải < 60 ký tự";
                return false;


            }
            return true;
        }





        public function validateEmailCreate($email, &$error){

    

            if(empty($email)){

                $error["email"] = "* Email không được bỏ trống";
                return false;

            }elseif(DB::table("users")->where("email","like",$email)->count("email") != 0){
                $error["email"] = "* Email đã tồn tại";
                return false;
            }

            return true;
        }


        public function validateAge($age, &$error){

            if(empty($age)){

                $error["age"] = "* Age không được bỏ trống";
                return false;

            }elseif($age < 18){
                $error["age"] = "* Age phải >= 18";
                return false;
            }elseif($age > 50){
                $error["age"] = "* Age phải <= 50";
                return false;
            }
            return true;
        }

    }


?>

