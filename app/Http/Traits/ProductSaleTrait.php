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
                'stock_qty' => $request->stock_qty[$j],
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

    private function saleProductItemArray($productSaleId)
    {
        $saleProducts = ProductSaleItem::where('product_sale_id',$productSaleId->id)->select('product_id')->get()->toArray();
        $oldSaleProducts = [];

        foreach ($saleProducts as $saleProduct){
            $oldSaleProducts[] = $saleProduct['product_id'];
        }

        return $oldSaleProducts;
    }

    private function saleProductBatchUpdate($request,$productSaleId)
    {
        $previousSaleProducts = $this->saleProductItemArray($productSaleId);
        $addProducts = array_diff($request->product_id,$previousSaleProducts);
        $removeProducts = array_diff($previousSaleProducts,$request->product_id);

        foreach ($addProducts as $i => $addProduct){
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

        foreach ($removeProducts as $removeProduct){
            ProductSaleItem::where('product_sale_id',$productSaleId)->where('product_id',$removeProduct)->delete();
        }
    }

    private function updateProductStockIncrease($request,$productSaleId)
    {
        $productSaleItemId = ProductSaleItem::where('product_sale_id',$productSaleId->id)->select('product_id')->get()->toArray();//data get form table array format that why use toArray and update multiple data on by one

        $usedProductStock = [];
        foreach ($productSaleItemId as $row){
            $usedProductStock[] = $row['product_id'];
        }


        foreach ($usedProductStock as $i => $productStock){
            $productStockFind = ProductStock::find($productStock);

            if($productStockFind['product_id']){
                $data = [
                    'p_reduce_qty' => $productStockFind['p_reduce_qty'] + $request->u_p_q[$i],
                ];

                $productStockFind->update($data);

            }
        }
    }

    private function updateProductStock($request,$productSaleId)
    {
        $productSaleItemId = ProductSaleItem::where('product_sale_id',$productSaleId->id)->select('product_id')->get()->toArray();//data get form table array format that why use toArray and update multiple data on by one

        $usedProductStock = [];
        foreach ($productSaleItemId as $row){
            $usedProductStock[] = $row['product_id'];
        }


        foreach ($usedProductStock as $i => $productStock){
            $productStockFind = ProductStock::find($productStock);

            if($productStockFind['product_id']){
                $data = [
                    'p_reduce_qty' => $productStockFind['p_reduce_qty'] - $request->sale_qty[$i],
                ];

                $productStockFind->update($data);

            }
        }
    }

    private function updateSaleItem($request,$productSaleId)
    {
        $productSaleItemIds = ProductSaleItem::where('product_sale_id',$productSaleId->id)->select('id')->get()->toArray();

        $saleItems = [];
        foreach ($productSaleItemIds as $row){
            $saleItems[] = $row['id'];
        }

        foreach ($saleItems as $s => $saleItem){
            $productFind = ProductSaleItem::find($saleItem);

            $data = [
                'product_id' => $request->product_id[$s],
                'customer_id' => $request->customer_id,
                'category_id' => $request->category_id[$s],
                'brand_id' => $request->brand_id[$s],
                'stock_qty' => $request->stock_qty[$s],
                'sale_qty' => $request->sale_qty[$s],
                'sale_price' => $request->sale_price[$s],
                'unit_id' => $request->unit_id[$s],
                'total_item_price' => $request->total_item_price[$s],
                'updated_at' => now()
            ];

            $productFind->update($data);
        }
    }

    private function saleTransactionUpdate($request,$productSaleId,$employeeId)
    {
        DB::table('product_transactions')->where('product_sale_id',$productSaleId->id)->delete();

        if(Role::findByName('Admin')){
            $productId = count($_POST['product_id']);
            for($j =0; $j<$productId; $j++){
                ProductTransaction::create([
                    'product_id' => $request->product_id[$j],
                    'customer_id' => $request->customer_id,
                    'category_id' => $request->category_id[$j],
                    'brand_id' =>  $request->brand_id[$j],
                    's_qty' => $request->sale_qty[$j],
                    'stock_qty' => $request->stock_qty[$j],
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
