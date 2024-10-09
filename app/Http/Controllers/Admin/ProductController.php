<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Traits\ValidateProduct;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreProduct;
use App\Http\Requests\RequestUpdateProduct;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::select("id","name")->get();

        // Chưa phân loại
        if($request->query("category_id") == "-1"){
            $products = Product::where("name","like","%". $request->query("search") ."%")->whereIn("category_id",Category::onlyTrashed()->pluck("id"))->paginate(4);
        
        // Phân loại
        }elseif($request->query("category_id") != "0" && $request->query("category_id") != NULL){
            $products = Product::where("name","like","%". $request->query("search") ."%")->where("category_id","=",$request->query("category_id"))->paginate(4);

        // Tất cả
        }else{
            $products = Product::paginate(4);
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
    public function store(RequestStoreProduct $request)
    {
        $requestData = $request->validated();

        $imgUrl = time() . $requestData["image"]->getClientOriginalName();
        $requestData["image"]->move(public_path("asset/img/Products"),$imgUrl);
        $requestData["image"] = $imgUrl;

        $check = Product::create($requestData);
        return redirect(route('admin.products.index'))->with(["add" => $check]);
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
    public function update(RequestUpdateProduct $request, string $id)
    {
        $requestData = $request->validated();

        $product = Product::find($id);

        if(count($requestData) == 6){
            $imgUrl = $product -> image;
            if($imgUrl != "avatar-2.jpg"){
                unlink(public_path("asset/img/products/" / $imgUrl));
            }
            $imgUrl = time() . $requestData["image"]->getClientOriginalName();
            $requestData["image"]->move(public_path("asset/img/products"),$imgUrl);
            $product->image = $imgUrl;
        }

        $product->name = $requestData["name"];
        $product->category_id = $requestData["category_id"];
        $product->quantity = $requestData["quantity"];
        $product->price = $requestData["price"];
        $product->description = $requestData["description"];

        $check = $product->save();
        return redirect(route('admin.products.index'))->with(["update" => $check]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = Product::find($id)->delete();

       
        return redirect(route('admin.products.index'))->with(["delete" => $check]);

    }
}
