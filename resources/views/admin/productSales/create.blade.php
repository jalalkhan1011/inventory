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
            <form action="{{ url('product-management/sales') }}" method="post" enctype="multipart/form-data">
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
                                    <th>Unit</th>
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
                                        <input type="number" name="stock_qty[]" step="0.01"  class="form-control stockQty" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="sale_price[]" step="0.01" class="form-control salePrice" readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="unit_name[]"   class="form-control unitName" readonly>
                                        <input type="hidden" name="unit_id[]" class="form-control unitId">
                                    </td>
                                    <td>
                                        <input type="number" name="sale_qty[]" step="0.01" class="form-control saleQty" id="saleQty" required>
                                    </td>
                                    <td>
                                        <input type="number" name="total_item_price[]" step="0.01" value="" class="form-control totalItemPrice" id="totalItemPrice"  readonly required>
                                    </td>
                                    <td class="removeButton"><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-trash-alt"></i></span></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-right" colspan="7">Sub total</td>
                                    <td>
                                        <input type="number" name="sub_total" step="0.01" value="" class="form-control subTotal" id="subTotal" placeholder="0.00" readonly>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="7">Discount</td>
                                    <td>
                                        <input type="number" step="0.01" name="discount" value="" class="form-control discount" id="discount" placeholder="0.00%">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="7">Grand total</td>
                                    <td>
                                        <input type="number" step="0.01" name="grand_total" value="" class="form-control grandTotal" id="grandTotal" placeholder="0.00" readonly required>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="7">Paid Amount</td>
                                    <td>
                                        <input type="number" step="0.01" name="total_price" value="" class="form-control totalPrice" id="totalPrice" placeholder="0.00"  required>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr id="changeTotal" style="display: none">
                                    <td class="text-right" colspan="7">Change</td>
                                    <td>
                                        <input type="number" name="change" step="0.01" value="0.00" class="form-control change" id="change" placeholder="0.00" readonly required>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr id="dueTotal" style="display: none">
                                    <td class="text-right" colspan="7">Due</td>
                                    <td>
                                        <input type="number" name="due" value="0.00" step="0.01" class="form-control due" id="due" placeholder="0.00" readonly required>
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ url('product-management/sales') }}" class="btn btn-primary" title="Back">Back</a>
            </form>
        </div>
    </div>
@endsection
@push('js')
    @include('js.productjs')
@endpush


