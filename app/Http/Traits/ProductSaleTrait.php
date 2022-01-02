<?php
namespace App\Http\Traits;

use App\Models\Product;
use App\Models\ProductSaleItem;
use App\Models\ProductStock;
use App\Models\ProductTransaction;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

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
        foreach ( $productSaleQty as $k=>$saleStockQty ){
            $saleStockQtyFind = ProductStock::findOrFail($saleStockQty);

            if($saleStockQtyFind['id']){
                $data = [
                    'p_reduce_qty' => abs($saleStockQtyFind['p_reduce_qty'] - $request->sale_qty[$k])
                ];
//                dd($data);
                $saleStockQtyFind->update($data );
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

    private function updateProductStock($request,$productSaleId)
    {
//        dd($request->all());
        $productSaleItemId = ProductSaleItem::where('product_sale_id',$productSaleId->id)->select('product_id')->get()->toArray();//data get form table array format that why use toArray and update multiple data on by one

        $usedProductStock = [];
        foreach ($productSaleItemId as $row){
            $usedProductStock[] = $row['product_id'];
        }

        foreach ($usedProductStock as $i => $productStock){
            $productStockFind = ProductStock::find($productStock);

            if($productStockFind['product_id']){
                $data = [
                    'p_reduce_qty' => $productStockFind['p_reduce_qty'] + $request->u_p_q[$i]
                ];
//                dd($data);
                $productStockFind->update($data);
            }
        }
    }

    private function updateSaleItem($request,$productSaleId)
    {
        DB::table('product_sale_items')->where('product_sale_id',$productSaleId->id)->delete();

        $this->saleItem($request,$productSaleId);

        $productSaleItemIds = ProductSaleItem::where('product_sale_id',$productSaleId->id)->select('product_id')->get()->toArray();

        $usedProductStocks = [];
        foreach ($productSaleItemIds as $row){
            $usedProductStocks[] = $row['product_id'];
        }

        foreach ($usedProductStocks as $i => $productStocks){
            $productStockFinds = ProductStock::find($productStocks);

            if($productStockFinds['product_id']){
                $data = [
                    'p_reduce_qty' => $productStockFinds['p_reduce_qty'] - $request->sale_qty[$i]
                ];


                $productStockFinds->update($data);
            }
        }
    }

    private function updateProductTransaction($request,$productSaleId)
    {
        $saleTransProductId = ProductTransaction::where('product_sale_id',$productSaleId->id)->select('id')->get()->toArray();

        $productTransId = [];
        foreach ($saleTransProductId as $row){
            $productTransId[] = $row['id'];
        }
        foreach  ($productTransId as $k => $saleTrans){
            $saleTransFind = ProductTransaction::find($saleTrans);

            if($saleTransFind['id']){
                $data = [
                    's_qty' => $saleTransFind['s_qty'] - $request->sale_qty[$k],
                    'stock_qty' => $saleTransFind['stock_qty'] + $request->sale_qty[$k],
                    's_total_amount' => $request->total_item_price[$k]
                ];

                $saleTransFind->update($data);
            }
        }
    }

    private function saleItemDeleteAndUpdate($request,$productSaleId)
    {
        DB::table('product_sale_items')->where('product_sale_id',$productSaleId->id)->delete();
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

    private function saleTransactionDeleteAndUpdate($request,$productSaleId,$employeeId)
    {
        DB::table('product_transactions')->where('product_sale_id',$productSaleId->id)->delete();

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
        if(Role::findByName('Admin')){
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
                    'user_id' => auth()->user()->id,
                    'created_at' => now()
                ]);
            }
        }else{
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
    }
}
