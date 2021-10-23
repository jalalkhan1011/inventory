<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\ProductSaleItem;
use App\Models\ProductTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductSaleController extends Controller
{
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

        $productId = count($_POST['product_id']);
        for($i=0; $i<$productId; $i++){
            ProductSaleItem::create([
                'product_id' => $request->product_id[$i],
                'customer_id' => $request->customer_id,
                'category_id' => $request->category_id[$i],
                'brand_id' => $request->brand_id[$i],
                'stock_qty' => $request->stock_qty[$i],
                'sale_qty' => $request->sale_qty[$i],
                'sale_price' => $request->sale_price[$i],
                'total_item_price' => $request->total_item_price[$i],
                'product_sale_id' => $productSaleId->id,
                'user_id' => auth()->user()->id,
                'created_at' => now()
            ]);
        }

        $saleProductId = ProductSaleItem::where('product_sale_id',$productSaleId->id)->select('product_id')->get()->toArray();//get array data form product item table

        $productSaleQty = [];
        foreach ($saleProductId as $row){
            $productSaleQty[] = $row['product_id'];
        }
        foreach ( $productSaleQty as $k=>$saleQty ){
            $saleQtyFind = Product::findOrFail($saleQty);

            if($saleQtyFind['id']){
                $data = [
                    'qty' => $saleQtyFind['qty'] - $request->sale_qty[$k]
                ];

                $saleQtyFind->update($data );
            }
        }

        for($j =0; $j<$productId; $j++){
            ProductTransaction::create([
                'product_id' => $request->product_id[$j],
                'customer_id' => $request->customer_id,
                'category_id' => $request->category_id[$j],
                'brand_id' =>  $request->brand_id[$j],
                's_qty' => $request->sale_qty[$j],
                'stock_qty' => $request->stock_qty[$j] -  $request->sale_qty[$j],
                's_unit_amount' => $request->sale_price[$j],
                's_total_amount' => $request->total_item_price[$j],
                'status' => 'S',
                'employee_id' => $employeeId->id,
                'user_id' => auth()->user()->id,
                'created_at' => now()
            ]);
        }

        return redirect(route('productsales.index'));
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
//        dd( $productSale);
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
    public function update(Request $request, ProductSale $productSale)
    {
        //
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
        return DB::table('products')
            ->select('categories.name','products.category_id','products.brand_id','brands.name as brandName','products.qty','products.sale_price')
            ->leftjoin('categories','categories.id','=','products.category_id')
            ->leftJoin('brands','brands.id','=','products.brand_id')
            ->where('products.id','=',$id)
            ->first();
    }
}
