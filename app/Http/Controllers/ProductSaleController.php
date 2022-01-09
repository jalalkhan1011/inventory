<?php

namespace App\Http\Controllers;

use App\Http\Traits\ProductSaleTrait;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\ProductSaleItem;
use App\Models\ProductStock;
use App\Models\ProductTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductSaleController extends Controller
{
    use ProductSaleTrait;

    function __construct()
    {
        $this->middleware('permission:product-sale-list|product-sale-create|product-sale-edit|product-sale-delete', ['only' => ['index','show']]);
        $this->middleware('permission:product-sale-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-sale-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-sale-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productSales = ProductSale::latest()->paginate(10);

        return view('admin.productSales.index',compact('productSales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::pluck('name','id');
        $products = Product::pluck('name','id');

        return view('admin.productSales.create',compact('customers','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employeeId = Employee::where('employee_id',auth()->user()->id)->first();
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        $productSaleId = ProductSale::create($data);

        $this->saleItem($request,$productSaleId);//this function used to insert multiple product into product_sale_items table and this function comes from ProductSaleTrait

        $this->saleQtyCalculation($request,$productSaleId);// this function used to calculate qty into products table and this function comes form ProductSaleTrait

        $this->saleTransaction($request,$productSaleId,$employeeId);//this function used to insert data into product_transactions table and the function comes from ProductSaleTrait File

        return redirect('product-management/sales');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductSale  $productSale
     * @return \Illuminate\Http\Response
     */
    public function show(ProductSale $productSale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductSale  $productSale
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductSale $productSale,$id)
    {
        $productSaleId = ProductSale::findOrFail($id);
        $products = Product::pluck('name','id');
        $customers = Customer::pluck('name','id');
        $selected_customers =  $productSaleId->customers->id;

        $productSaleItems = ProductSaleItem::where('product_sale_id', $productSaleId->id)->get();


        return view('admin.productSales.edit',compact('productSaleId','customers','products','productSaleItems','selected_customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductSale  $productSale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductSale $productSale,$id)
    {
        $employeeId = Employee::where('employee_id',auth()->user()->id)->first();
        $productSaleId = ProductSale::findOrFail($id);

        $this->updateProductStock($request,$productSaleId);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        $productSaleId->update($data);

        $this->updateSaleItem($request,$productSaleId);

        $this->saleTransactionUpdate($request,$productSaleId,$employeeId);

       return  redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductSale  $productSale
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSale $productSale)
    {
        //
    }

    public function productDetails($id)//this id is the parameter that's comes from route parameters
    {
        return DB::table('products as p')
            ->select('c.name','p.category_id','p.brand_id','b.name as brandName','p.qty','p.sale_price','u.name as unitName','p.unit_id','pst.p_reduce_qty')
            ->leftJoin('product_stocks as pst','pst.product_id','=','p.id')
            ->leftjoin('categories as c','c.id','=','p.category_id')
            ->leftJoin('brands as b','b.id','=','p.brand_id')
            ->leftJoin('units as u','u.id','=','p.unit_id')
            ->where('p.id','=',$id)
            ->first();
    }
}
