<?php

namespace App\Http\Traits;


use App\Models\Employee;
use App\Models\Product;
use App\Models\ProductTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


trait ProductTransactionTraits
{
    private function productTransaction($product)//This function use for add product details into production_transactions table
    {
        $employeeId = Employee::where('employee_id',auth()->user()->id)->first();

        if(Auth::user()->hasRole('Admin')){
            $data = [
                'product_id' => $product->id,
                'category_id' => $product->category_id,
                'brand_id' => $product->brand_id,
                'supplier_id' => $product->supplier_id,
                'p_qty' => $product->qty,
                'stock_qty' => $product->qty,
                'p_unit_amount' => $product->unit_price,
                's_unit_amount' => $product->sale_price,
                'p_total_amount' => $product->total_price,
                'status' => 'p',
                'user_id' => auth()->user()->id,
                'created_at' => now()
            ];

            $productTransaction = ProductTransaction::create($data);
        }else{
            $data = [
                'product_id' => $product->id,
                'category_id' => $product->category_id,
                'brand_id' => $product->brand_id,
                'supplier_id' => $product->supplier_id,
                'p_qty' => $product->qty,
                'stock_qty' => $product->qty,
                'p_unit_amount' => $product->unit_price,
                's_unit_amount' => $product->sale_price,
                'p_total_amount' => $product->total_price,
                'employee_id' =>  $employeeId->id,
                'status' => 'p',
                'user_id' => auth()->user()->id,
                'created_at' => now()
            ];

            $productTransaction = ProductTransaction::create($data);
        }


        return $productTransaction;
    }

    private function productQty(Request $request,Product $product)//user for calculation product quantity
    {

        $productQty = $product->qty;
        $requestQty = $request->qty;

        if($requestQty >= $productQty){
            $qty = $requestQty - $productQty;
            $totalQty = $productQty + $qty;
        }else{
            $qty = $productQty - $requestQty;
            $totalQty = $productQty - $qty;
        }

        return $totalQty;
    }

    private function unitPrice(Request $request,Product $product)//user for calculation product unit price
    {
        $unitPrice = $product->unit_price;
        $requestUnitPrice = $request->unit_price;

        if($requestUnitPrice >= $unitPrice){
            $price = $requestUnitPrice - $unitPrice;
            $totalUnitPrice = $unitPrice + $price;
        }else{
            $price = $unitPrice - $requestUnitPrice;
            $totalUnitPrice = $unitPrice - $price;
        }

        return $totalUnitPrice;
    }

    private function salePrice(Request $request,Product $product)//user for calculation product sale price
    {
        $salePrice = $product->sale_price;
        $requestSalePrice = $request->sale_price;

        if($requestSalePrice >= $salePrice){
            $sale = $requestSalePrice - $salePrice;
            $totalSalePrice = $salePrice + $sale;
        }else{
            $sale = $salePrice - $requestSalePrice;
            $totalSalePrice = $salePrice - $sale;
        }

        return $totalSalePrice;
    }

    private function stockQty(Request $request,Product $product)//user for calculating product stock quantity on production_transaction table
    {
        $productId = Product::findOrFail($product->id);
        $productTransaction = ProductTransaction::where('product_id',$productId->id)->first();

        $productQty = $product->qty;
        $requestQty = $request->qty;

        if($requestQty >= $productQty){
            $qty = $requestQty - $productQty;
            $totalQty = $productQty + $qty;
            $productTransaction->update([
                'stock_qty' => $totalQty,
                'p_qty' => $totalQty,
                'updated_at' => now()
            ]);
        }else{
            $qty = $productQty - $requestQty;
            $totalQty = $productQty - $qty;
            $productTransaction->update([
                'stock_qty' => $totalQty,
                'p_qty' => $totalQty,
                'updated_at' => now()
            ]);
        }

        return  $productTransaction ;
    }

    private function purchaseUnitPrice(Request $request,Product $product)//user for calculating product purchase unit price on production_transaction table
    {
        $productId = Product::findOrFail($product->id);
        $productTransaction = ProductTransaction::where('product_id',$productId->id)->first();

        $unitPrice = $product->unit_price;
        $requestUnitPrice = $request->unit_price;

        if($requestUnitPrice >= $unitPrice){
            $price = $requestUnitPrice - $unitPrice;
            $totalUnitPrice = $unitPrice + $price;
            $productTransaction->update([
                'p_unit_amount' => $totalUnitPrice,
                'p_total_amount' => $request->total_price,
                'updated_at' => now()
            ]);
        }else{
            $price = $unitPrice - $requestUnitPrice;
            $totalUnitPrice = $unitPrice - $price;
            $productTransaction->update([
                'p_unit_amount' => $totalUnitPrice,
                'p_total_amount' => $request->total_price,
                'updated_at' => now()
            ]);
        }

        return $productTransaction;
    }

    private function saleUnitPrice(Request $request,Product $product)//user for calculating product sale unit price on production_transaction table
    {
        $productId = Product::findOrFail($product->id);
        $productTransaction = ProductTransaction::where('product_id',$productId->id)->first();

        $salePrice = $product->sale_price;
        $requestSalePrice = $request->sale_price;

        if($requestSalePrice >= $salePrice){
            $sale = $requestSalePrice - $salePrice;
            $totalSalePrice = $salePrice + $sale;
            $productTransaction->update(['s_unit_amount' => $totalSalePrice]);
        }else{
            $sale = $salePrice - $requestSalePrice;
            $totalSalePrice = $salePrice - $sale;
            $productTransaction->update(['s_unit_amount' => $totalSalePrice]);
        }

        return $productTransaction;
    }

    private function productCategoryId(Request $request,Product $product)//user for calculating product category_id on production_transaction table
    {
        $productId = Product::findOrFail($product->id);
        $productTransaction = ProductTransaction::where('product_id',$productId->id)->first();

        $productTransaction->update(['category_id' => $request->category_id]);

        return $productTransaction;
    }

    private function productBrandId(Request $request,Product $product)//user for calculating product brand_id on production_transaction table
    {
        $productId = Product::findOrFail($product->id);
        $productTransaction = ProductTransaction::where('product_id',$productId->id)->first();

        $productTransaction->update(['brand_id' => $request->brand_id]);

        return $productTransaction;
    }

    private function productSupplierId(Request $request,Product $product)
    {
        $productId = Product::findOrFail($product->id);
        $productTransaction = ProductTransaction::where('product_id',$productId->id)->first();

        $productTransaction->update(['supplier_id' => $request->supplier_id]);

        return $productTransaction;
    }
}
