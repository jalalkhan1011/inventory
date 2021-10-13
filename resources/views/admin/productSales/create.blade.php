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
                                        <select class="custom-select product" id="product" name="product_id" required>
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
                                    </td>
                                    <td>
                                        <input type="text" name="category_name" class="form-control categoryName" disabled>
                                        <input type="hidden" name="category_id[]" class="form-control categoryId">
                                    </td>
                                    <td>
                                        <input type="text" name="brand_name" class="form-control brandName" disabled>
                                        <input type="hidden" name="brand_id[]" class="form-control brandId">
                                    </td>
                                    <td>
                                        <input type="number" name="stock_qty[]" class="form-control stockQty" disabled>
                                    </td>
                                    <td>
                                        <input type="number" name="sale_price[]" class="form-control salePrice" disabled>
                                    </td>
                                    <td>
                                        <input type="number" name="sale_qty[]" class="form-control saleQty" id="saleQty">
                                    </td>
                                    <td>
                                        <input type="number" name="total_item_price[]" class="form-control totalItemPrice" id="totalItemPrice" disabled>
                                    </td>
                                    <td class="removeButton"><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-trash-alt"></i></span></td>
                                </tr>
                            </tbody>
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
            $('.rowAdd').click(function (){
                var getTr = $('tr.rowFirst:first');
                $('tbody.newRow').append("<tr class='removableRow'>"+getTr.html()+"<tr>");
                var defultRow = $('tr.removableRow:last');
                defultRow.find('select.product').attr('disabled',false);
                defultRow.find('text.categoryName').attr('disabled',true);
                defultRow.find('text.brandName').attr('disabled',true);
                defultRow.find('number.stockQty').attr('disabled',true);
                defultRow.find('number.salePrice').attr('disabled',true);
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
                    thisRow.find('.salePrice').val(data.unit_price);
                }
            });

        });
    </script>
@endpush

