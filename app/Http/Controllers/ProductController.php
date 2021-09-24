<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function __construct(){
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index,show']]);
        $this->middleware('permission:product-create', ['only' => ['create,store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit,update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status','Active')->pluck('name','id');
        $brands = Brand::where('status','Active')->pluck('name','id');
        $code = '#p'.' '.'-'.' '.mt_rand(1000000,9999999);

        return view('admin.products.create',compact('categories','brands','code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products,name,NULL,id,deleted_at,NULL',
            'category_id' => 'required',
            'brand_id' => 'required',
            'qty' => 'required|numeric',
            'description' => 'nullable',
            'purchase_date' => 'required',
            'expire_date' => 'required'
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        Product::create($data);

        return redirect('admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::where('status','Active')->pluck('name','id');
        $selected_categories = $product->category->id;
        $brands = Brand::where('status','Active')->pluck('name','id');
        $selected_brand = $product->brand->id;

        return view('admin.products.edit',compact('product','categories','brands','selected_categories','selected_brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'sometimes|required|unique:products,name,'.$product->id,
            'category_id' => 'required',
            'brand_id' => 'required',
            'qty' => 'required|numeric',
            'description' => 'nullable',
            'purchase_date' => 'required',
            'expire_date' => 'required'
        ]);

        $productQty = $product->qty;
        $requestQty = $request->qty;

        if($requestQty >= $productQty){
            $qty = $requestQty - $productQty;
            $totalQty = $productQty + $qty;
        }else{
            $qty = $productQty - $requestQty;
            $totalQty = $productQty - $qty;
        }

        $data = [
            'name' => $request->name,
            'code' => $product->code,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'purchase_date' => date('Y-m-d',strtotime($request->purchase_date)),
            'expire_date' => date('Y-m-d',strtotime($request->expire_date)),
            'qty' => $totalQty,
            'status' => $request->status,
            'description' => $request->description,
            'user_id' => auth()->user()->id
        ];

        $product->update($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('admin/products');
    }
}
