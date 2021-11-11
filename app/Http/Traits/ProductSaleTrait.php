<?php
namespace App\Http\Traits;

use App\Models\Product;
use App\Models\ProductSaleItem;
use App\Models\ProductTransaction;

trait ProductSaleTrait
{
    private function saleItem($request,$productSaleId)
    {
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
                'unit_id' => $request->unit_id[$i],
                'total_item_price' => $request->total_item_price[$i],
                'product_sale_id' => $productSaleId->id,
                'user_id' => auth()->user()->id,
                'created_at' => now()
            ]);
        }
    }

    private function saleQtyCalculation($request,$productSaleId)
    {
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
    }

    private function saleTransaction($request,$productSaleId,$employeeId)
    {
        $productId = count($_POST['product_id']);
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
                'product_sale_id' => $productSaleId->id,
                'employee_id' => $employeeId->id,
                'user_id' => auth()->user()->id,
                'created_at' => now()
            ]);
        }
    }

    private function updateProduct($request,$productSaleId)
    {
        $saleItemId = ProductSaleItem::where('product_sale_id',$productSaleId->id)->select('product_id')->get()->toArray();//data get form table array format that why use toArray and update multiple data on by one

        $saleItem = [];
        foreach ($saleItemId as $row){
            $saleItem[] = $row['product_id'];
        }
        foreach ($saleItem as $i => $product){
            $productFind = Product::find($product);

            if($productFind['id']){
                $data = [
                    'qty' => $productFind['qty'] + $request->sale_qty[$i]
                ];

                $productFind->update($data);
            }
        }
    }
}
