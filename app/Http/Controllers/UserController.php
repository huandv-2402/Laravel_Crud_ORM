<?php

namespace App\Http\Controllers;


use App\Traits\Validate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    use Validate;


    public function index()
    {
        $listUser = DB::table("users")->leftJoin("departments", "users.department_id", "=", "departments.id")->select("users.id", "users.name", "users.email", "users.age", "departments.name as tenphong")->get();

        return view('user/list', ["listUser" => $listUser]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listDepartment = DB::table("departments")->select("id", "name")->get();

        return view('user/add', ["listDepartment" => $listDepartment]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $error = [];


        $check1 = $this->validateName($request->input("name"),$error);
        $check2 = $this->validateEmailCreate($request->input("email"),$error);
        $check3 = $this->validateAge($request->input("age"),$error);


        if ($check1 && $check2 && $check3) {
            $check = DB::table("users")->insert([
                "name" => $request->input("name"),
                "email" => $request->input("email"),
                "age" => $request->input("age"),
                "department_id" => $request->input("department_id"),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]);

            if ($check) {
                return redirect(route('users.create'))->with('check',$check);
            } else {
                return redirect(route('users.create'))->with('check',$check);
            }
        }
        return redirect(route('users.create'))->with(["error"=>$error, "data" => ["name" => $request->input("name"), "email" => $request->input("email"), "age" => $request->input("age"), "department_id" => $request->input("department_id")]]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $listDepartment = DB::table("departments")->select("id", "name")->get();
        $user = DB::table("users")->find($id);

        return view('user/edit',["user" => $user, "listDepartment" => $listDepartment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $error = [];

        $check1 = $this->validateName($request->input("name"),$error);
        $check2 = $this->validateAge($request->input("age"),$error);

        if ($check1 && $check2) {
            $check = DB::table("users")->where("id","=",$id)->update([
                "name" => $request->input("name"),
                "age" => $request->input("age"),
                "department_id" => $request->input("department_id"),
                "updated_at" => Carbon::now()
            ]);

            if ($check) {
                return redirect(route('users.edit',['user' => $id]))->with('check',$check);
            } else {
                return redirect(route('users.edit',['user' => $id]))->with('check',$check);
            }
        }
        return redirect(route('users.edit',['user' => $id]))->with(["error"=>$error, "data" => ["name" => $request->input("name"), "email" => $request->input("email"), "age" => $request->input("age"), "department_id" => $request->input("department_id")]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = DB::table("users")->where("id","=",$id)->delete();

        // dd($check);
        if($check === 1){
            $check = true;
        }else{
            $check = false;
        }

        return redirect(route('users.index'))->with("check",$check);
    }
}
