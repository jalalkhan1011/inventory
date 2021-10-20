@extends('admin.layouts.master')

@section('title','Product Sale')
@section('page_title','Sale Product')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 text-left">
                    <h6>Product Sale</h6>
                    <p class="text-info">Sale Product</p>
                </div>
            </div>
            <hr>
            @if(session('message'))
                <div class="alert {{ Session('alert-class','alert-success','alert-block') }}">
                    <button type="button" class="close" data-dissmiss="alert">x</button>
                    <strong>{{ session('message') }}</strong>
                </div>
            @endif
            <form action="{{ route('productsales.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Customer Name <span class="text-danger"> *</span></label>
                        <select class="custom-select" name="customer_id" required>
                            <option value="">Select one</option>
                            @foreach($customers as $key => $customer)
                                <option value="{{ $key }}">{{ $customer }}</option>
                            @endforeach
                        </select>
                        <div class="clearfix"></div>
                        @if($errors->has('customer_id'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('customer_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <table class="table table-bordered" id="productId">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th  class="addButton"><span class="btn btn-info btn-sm pull-right rowAdd"><i class="fa fa-plus"></i></span></th>
                                </tr>
                            </thead>
                            <tbody class="newRow">
                                <tr class="rowFirst">
                                    <td>
                                        <select class="custom-select product" id="product" name="product_id[]" required>
                                            <option value="">Select one</option>
                                            @foreach($products as $key => $product)
                                                <option value="{{ $key }}">{{ $product }}</option>
                                            @endforeach
                                        </select>
                                        <div class="clearfix"></div>
                                        @if($errors->has('product_id'))
                                            <span class="form-text">
                                                <strong class="text-danger form-control-sm">{{ $errors->first('product_id') }}</strong>
                                            </span>
                                        @endif
                                        <input type="hidden" name="price" class="form-control price" value="" id="price">
                                    </td>
                                    <td>
                                        <input type="text" name="category_name" class="form-control categoryName" readonly>
                                        <input type="hidden" name="category_id[]" class="form-control categoryId">
                                    </td>
                                    <td>
                                        <input type="text" name="brand_name" class="form-control brandName" readonly>
                                        <input type="hidden" name="brand_id[]" class="form-control brandId">
                                    </td>
                                    <td>
                                        <input type="number" name="stock_qty[]"  class="form-control stockQty" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="sale_price[]" class="form-control salePrice" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="sale_qty[]" class="form-control saleQty" id="saleQty" required>
                                    </td>
                                    <td>
                                        <input type="number" name="total_item_price[]" value="" class="form-control totalItemPrice" id="totalItemPrice"  readonly required>
                                    </td>
                                    <td class="removeButton"><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-trash-alt"></i></span></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-right" colspan="6">Sub total</td>
                                    <td>
                                        <input type="number" name="sub_total" value="" class="form-control subTotal" id="subTotal" placeholder="0.00" readonly>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="6">Discount</td>
                                    <td>
                                        <input type="number" name="discount" value="" class="form-control discount" id="discount" placeholder="0.00%">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="6">Grand total</td>
                                    <td>
                                        <input type="number" name="grand_total" value="" class="form-control grandTotal" id="grandTotal" placeholder="0.00" readonly required>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="6">Paid Amount</td>
                                    <td>
                                        <input type="number" name="total_price" value="" class="form-control totalPrice" id="totalPrice" placeholder="0.00"  required>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr id="changeTotal" style="display: none">
                                    <td class="text-right" colspan="6">Change</td>
                                    <td>
                                        <input type="number" name="change" value="0.00" class="form-control change" id="change" placeholder="0.00"  required>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr id="dueTotal" style="display: none">
                                    <td class="text-right" colspan="6">Due</td>
                                    <td>
                                        <input type="number" name="due" value="0.00" class="form-control due" id="due" placeholder="0.00"  required>
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('productsales.index') }}" class="btn btn-primary" title="Back">Back</a>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script>
        $(document).ready(function (){
            $('.grandTotal').attr('readonly',true);
        });
        $(document).ready(function (){
            $('.rowAdd').click(function (){
                var getTr = $('tr.rowFirst:first');
                $('tbody.newRow').append("<tr class='removableRow'>"+getTr.html()+"<tr>");
                var defultRow = $('tr.removableRow:last');
                defultRow.find('select.product').attr('disabled',false);
                defultRow.find('input.categoryName').attr('readonly',true);
                defultRow.find('input.brandName').attr('readonly',true);
                defultRow.find('input.stockQty').attr('readonly',true);
                defultRow.find('input.salePrice').attr('readonly',true);
            });
        });
        // $(document).on("click","span.rowRemove",function (){ //user for delete all row one by one
        //     $(this).closest("tr.removableRow").remove();
        // });
        $(document).on("click", "span.rowRemove ", function () {//delete all row one by one but except last one row
            var count = $("#productId tr").length - 1;
            if (count > 1) {
                $(this).parents("tr").remove();
            }
        });

        $(document).on('change','.product',function (){
            var thisRow = $(this).closest('tr');
            var productId = thisRow.find('.product').val();

            $.ajax({
                type: "GET",
                url : "/admin/product-details/"+productId,//this id from form vai request
                data: {'productId':productId},
                success: function (data){
                    thisRow.find('.categoryId').val(data.category_id); //user for append data into row column product wise
                    thisRow.find('.categoryName').val(data.name);
                    thisRow.find('.brandId').val(data.brand_id);
                    thisRow.find('.brandName').val(data.brandName);
                    thisRow.find('.stockQty').val(data.qty);
                    thisRow.find('.salePrice').val(data.sale_price);
                    thisRow.find('.price').val(data.sale_price);
                }
            });

        });

       $(document).on('keyup change','.saleQty',function () {
           var total = 0;
           var thisRow = $(this).closest('tr');
           var saleQty = parseFloat($(this).val())||0;
           var productPrice = parseFloat(thisRow.find('.price').val() || 0) ;

           var priceAmount = productPrice * saleQty;

           // alert(priceAmount);

           thisRow.find('.totalItemPrice').val(parseFloat(priceAmount).toFixed(2));

          $('.totalItemPrice').each(function (){
              total += parseFloat($(this).val())||0;
          });
           $('.subTotal').val(parseFloat(total).toFixed(2));
           $('.grandTotal').val(parseFloat(total).toFixed(2));
       });

       $(document).on('keyup change','.discount','.saleQty',function (){
           var productDis = $(this).val()||0;
           var subTotal = parseFloat($('.subTotal').val())||0;
           var totDiscount = parseFloat((subTotal * productDis)/100)||0;
           var grandTotal = subTotal - totDiscount;

           $('.grandTotal').val(parseFloat(grandTotal).toFixed(2));
       });

       $(document).on('keyup change','.totalPrice',function (){
           var paidAmount = parseFloat($(this).val()) || 0;
           var grandTotal = parseFloat($('.grandTotal').val()) || 0;

           var dueTotal = parseFloat(grandTotal) - parseFloat(paidAmount);

           if(grandTotal <= paidAmount){
              $('#due').val(0.00);
              $('#change').val(parseFloat(parseFloat(paidAmount) - parseFloat(grandTotal)).toFixed(2));
              $('#changeTotal').show();
              $('#dueTotal').hide();
           }else{
               $('#changeTotal').hide();
               $('#dueTotal').show();
               $('#due').val(parseFloat(dueTotal).toFixed(2));
               $('#change').val(0.00);
           }
       })
    </script>
@endpush


