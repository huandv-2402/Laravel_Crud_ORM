<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Traits\ValidateProduct;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    use ValidateProduct;

    protected $error = [
        "name" => [
            "status" => false,
            "error" => ""
        ],
        "image" => [
            "status" => false,
            "error" => ""
        ],
        "description" => [
            "status" => false,
            "error" => ""
        ],
        "price" => [
            "status" => false,
            "error" => ""
        ],
        "quantity" => [
            "status" => false,
            "error" => ""
        ]
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::select("id","name")->get();

        // Chưa phân loại
        if($request->query("category_id") == "-1"){
            $products = Product::where("name","like","%". $request->query("search") ."%")->whereIn("category_id",Category::onlyTrashed()->pluck("id"))->get();
        
        // Phân loại
        }elseif($request->query("category_id") != "0" && $request->query("category_id") != NULL){
            $products = Product::where("name","like","%". $request->query("search") ."%")->where("category_id","=",$request->query("category_id"))->get();

        // Tất cả
        }else{
            $products = Product::all();
        }

        

        return view("admin/products/list",["products"=>$products, "categories" => $categories])->with(["search"=>$request->query("search"), "category_id" => $request->query("category_id")]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Chưa xóa mềm
        $categories = Category::select("id","name")->get();

        // Đã xóa mềm
        $temp = Category::select("id")->onlyTrashed()->get()->random();


        return view("Admin/Products/add",["categories"=> $categories,"temp" => $temp]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this -> error["name"]["status"] = $this -> validateName($request->input("name"),$this -> error["name"]["error"]);
        $this -> error["description"]["status"] = $this -> validateDescription($request->input("description"),$this -> error["description"]["error"]);
        $this -> error["price"]["status"] = $this -> validatePrice($request->input("price"),$this -> error["price"]["error"]);
        $this -> error["quantity"]["status"] = $this -> validateQuantity($request->input("quantity"),$this -> error["quantity"]["error"]);

        if($request -> hasFile("image")){
            $this -> error["image"]["status"] = true;
        }else{
            $this -> error["image"]["status"] = false;
            $this -> error["image"]["error"] = " * Ảnh không được bỏ trống";
        }


        if($this -> error["name"]["status"] && $this -> error["description"]["status"] && $this -> error["price"]["status"] && $this -> error["quantity"]["status"] && $this -> error["image"]["status"]){

            $imgUrl = time() . $request->file("image")->getClientOriginalName();
            $request->file("image")->move((public_path("asset/img/products")),$imgUrl);

            $check = Product::create([
                "name" => $request->input("name"),
                "image" => $imgUrl,
                "description" => $request->input("description"),
                "price" => $request->input("price"),
                "quantity" => $request->input("quantity"),
                "category_id" => $request->input("category_id")
            ]);
            return redirect(route("admin.products.index"))->with(["add" => $check]);

        }else{
            return redirect(route('admin.products.create'))->with(["error" => $this -> error, "name" => $request->input("name"),"quantity"=>$request->input("quantity"),"price"=>$request->input("price"),"description"=>$request->input("description"),"category_id" => $request->input("category_id")]);
        }
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
    public function edit(string $id, Request $request)
    {
        // Chưa xóa mềm
        $categories = Category::select("id","name")->get();

        // Đã xóa mềm
        $temp = Category::select("id")->onlyTrashed()->get()->random();

        $product = Product::find($id);


        return view("Admin/Products/edit",["categories"=> $categories,"temp" => $temp,"product" => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this -> error["name"]["status"] = $this -> validateNameUpdate($request->input("name"),$this -> error["name"]["error"]);
        $this -> error["description"]["status"] = $this -> validateDescription($request->input("description"),$this -> error["description"]["error"]);
        $this -> error["price"]["status"] = $this -> validatePrice($request->input("price"),$this -> error["price"]["error"]);
        $this -> error["quantity"]["status"] = $this -> validateQuantity($request->input("quantity"),$this -> error["quantity"]["error"]);

        if($this -> error["name"]["status"] && $this -> error["description"]["status"] && $this -> error["price"]["status"] && $this -> error["quantity"]["status"]){
            $product = Product::find($id);
            $imgUrl = $product->image;
            
            if($request->hasFile("image")){
                $imgUrl = time() . $request->file("image")->getClientOriginalName();
                $request->file("image")->move(public_path("asset/img/Products"),$imgUrl);
                if($product->image !== "avatar-2.jpg"){
                    unlink(public_path(public_path("asset/img/Products/" . $product->image)));
                }
            }

            $product->name = $request->input("name");
            $product->category_id = $request->input("category_id");
            $product->quantity = $request->input("quantity");
            $product->price = $request->input("price");
            $product->image = $imgUrl;
            $product->description = $request->input("description");

            $check = $product->save();

            return redirect(route('admin.products.index'))->with(["update" => $check]);

        }else{
            return redirect(route('admin.products.edit',["product" => $id]))->with(["error" => $this -> error, "name" => $request->input("name")??"","quantity"=>$request->input("quantity")??"","price"=>$request->input("price")??"","description"=>$request->input("description")??"", "category_id" => $request->input("category_id")]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = Product::find($id)->delete();

        if($check){
            return redirect(route('admin.products.index'))->with(["delete" => true]);
        }else{
            return redirect(route('admin.products.index'))->with(["delete" => false]);
        }
    }
}
