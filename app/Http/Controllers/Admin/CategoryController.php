<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreCategory;
use App\Http\Requests\RequestUpdateCategory;
use App\Traits\ValidateCategory;


class CategoryController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::where("name", "like", "%" . $request->query("search") . "%")->get();

        return view("Admin/Categories/list", ["categories" => $categories])->with("search", $request->query("search"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Admin/categories/add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestStoreCategory $request)
    {
        $requestData = $request->validated();

        $imgUrl = time() . $requestData["image"]->getClientOriginalName();
        $requestData["image"]->move(public_path("asset/img/Categories"),$imgUrl);
        $requestData["image"] = $imgUrl;

        $check = Category::create($requestData);

        return redirect(route("admin.categories.index"))->with(["add" => $check]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $category = Category::find($id);

        return view("admin/categories/edit", ["category" => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestUpdateCategory $request, string $id)
    {
        
        // $request -> setCategoryId($category->id);

        $requestData = $request->validated();
        // dd($requestData);

        $category = Category::find($id);

        if(count($requestData) == 2){
            $imgUrl = $category -> image;

            if($imgUrl != "avatar-2.jpg"){
                unlink(public_path("asset/img/Categories/" . $imgUrl));
            }
            $imgUrl = time() . $requestData["image"]->getClientOriginalName();
            $requestData["image"]->move(public_path("asset/img/categories"),$imgUrl);
            $category->image = $imgUrl; 
        }

        $category ->name = $requestData["name"];

        $check = $category->save();

        return redirect(route("admin.categories.index"))->with(["update" => $check]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = Category::find($id)->delete();

        return redirect(route('admin.categories.index'))->with(["delete" => $check]);
    }
}
