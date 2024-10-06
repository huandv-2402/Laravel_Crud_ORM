<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\ValidateCategory;


class CategoryController extends Controller
{

    use ValidateCategory;


    protected $error = [
        "name" => [
            "status" => false,
            "error" => ""
        ],
        "image" => [
            "status" => false,
            "error" => ""
        ],
    ];


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
    public function store(Request $request)
    {
        $this->error["name"]["status"] = $this->validateName($request->input("name"), $this->error["name"]["error"]);


        if ($request->hasFile("image")) {
            $this->error["image"]["status"] = true;
        } else {
            $this->error["image"]["status"] = false;
            $this->error["image"]["error"] = " * Ảnh không được bỏ trống";
        }

        if ($this->error["image"]["status"] && $this->error["name"]["status"]) {
            // Xử lý ảnh
            $imageUrl = time() . $request->file("image")->getClientOriginalName();
            $request->file("image")->move(public_path('asset/img/Categories'), $imageUrl);

            $check = Category::create([
                "name" => $request->input("name"),
                "image" => $imageUrl
            ]);

            return redirect(route("admin.categories.index"))->with(["add" => $check]);
        } else {

            return redirect(route('admin.categories.create'))->with(["error" => $this->error, "name" => $request->input("name")]);
        }
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
    public function update(Request $request, string $id)
    {
        $this->error["name"]["status"] = $this->validateNameUpdate($request->input("name"), $this->error["name"]["error"]);

        if ($this->error["name"]["status"]) {
            $category = Category::find($id);
            $imageUrl = $category->image;

            if ($request->hasFile("image")) {

                // Xử lý ảnh
                $imageUrl = time() . $request->file("image")->getClientOriginalName();
                $request->file("image")->move(public_path('asset/img/Categories'), $imageUrl);
                if ($category->image !== "avatar-2.jpg") {
                    unlink(public_path('asset/img/Categories/') . $category->image);
                }
            }

            $category->name = $request->input("name");
            $category->image = $imageUrl;

            $check = $category->save();


            return redirect(route('admin.categories.index'))->with(["update" => $check]);
        } else {
            return redirect(route('admin.categories.edit', ['category' => $id]))->with(["error" => $this->error, "name" => $request->input("name") ?? ""]);
        }
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
