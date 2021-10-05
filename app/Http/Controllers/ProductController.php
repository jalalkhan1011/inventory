<?php

namespace App\Http\Controllers;

use App\Http\Traits\ProductTransactionTraits;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ProductTransactionTraits;
    function __construct(){
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
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
        $suppliers = Suppliers::pluck('name','id');
        $code = '#p'.' '.'-'.' '.mt_rand(1000000,9999999);

        return view('admin.products.create',compact('categories','brands','suppliers','code'));
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
            'name' => 'required|unique:products,name,NULL,id,deleted_at,NULL',//validation for unique value
            'category_id' => 'required',
            'brand_id' => 'required',
            'qty' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'total_price' => 'required|numeric',
            'supplier_id' => 'required',
            'description' => 'nullable',
            'purchase_date' => 'required',
            'expire_date' => 'required'
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        $product = Product::create($data);


        $this->productTransaction($product);

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
        $suppliers = Suppliers::pluck('name','id');
        $selected_supplier = $product->supplier->id;

        return view('admin.products.edit',compact('product','categories','brands','suppliers','selected_categories','selected_brand','selected_supplier'));
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
            'name' => 'required|unique:products,name,'.$product->id.',id,deleted_at,NULL',//validation for unique value
            'category_id' => 'required',
            'brand_id' => 'required',
            'qty' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'total_price' => 'required|numeric',
            'supplier_id' => 'required',
            'description' => 'nullable',
            'purchase_date' => 'required',
            'expire_date' => 'required',
        ]);

        $totalQty = $this->productQty($request,$product);
        $totalUnitPrice = $this->unitPrice($request,$product);
        $totalSalePrice = $this->salePrice($request,$product);

        $data = [
            'name' => $request->name,
            'code' => $product->code,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'purchase_date' => date('Y-m-d',strtotime($request->purchase_date)),
            'expire_date' => date('Y-m-d',strtotime($request->expire_date)),
            'qty' => $totalQty,
            'unit_price' => $totalUnitPrice,
            'sale_price' => $totalSalePrice,
            'total_price' => $request->total_price,
            'supplier_id' => $request->supplier_id,
            'status' => $request->status,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'updated_at' => now()
        ];

        $product->update($data);

        $this->stockQty($request,$product);
        $this->purchaseUnitPrice($request,$product);
        $this->saleUnitPrice($request,$product);

        if($product->category_id != $request->category_id){
        }else{
            $this->productCategoryId($request,$product);
        }

        if($product->brand_id != $request->brand_id){
        }else{
           $this->productBrandId($request,$product);
        }

        if($product->supplier_id != $request->supplier_id){
        }else{
            $this->productSupplierId($request,$product);
        }

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
