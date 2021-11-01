@extends('admin.layouts.master')

@section('title','Product')
@section('page_title','Create Product')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 text-left">
                    <h6>Product</h6>
                    <p class="text-info">Create Product</p>
                </div>
            </div>
            <hr>
            @if(session('message'))
                <div class="alert {{ Session('alert-class','alert-success','alert-block') }}">
                    <button type="button" class="close" data-dissmiss="alert">x</button>
                    <strong>{{ session('message') }}</strong>
                </div>
            @endif
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Name <span class="text-danger"> *</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name" required/>
                        <div class="clearfix"></div>
                        @if($errors->has('name'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Code <span class="text-danger"> *</span></label>
                        <input type="text" name="code" value="{{ $code }}" class="form-control" placeholder="#p-1011" required readonly/>
                        <div class="clearfix"></div>
                        @if($errors->has('code'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('code') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Category <span class="text-danger"> *</span></label>
                        <select class="custom-select" name="category_id" required>
                            <option value="">Select one</option>
                            @foreach($categories as $key => $category)
                                <option value="{{ $key }}">{{ $category }}</option>
                            @endforeach
                        </select>
                        <div class="clearfix"></div>
                        @if($errors->has('category_id'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('category_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Brand <span class="text-danger"> *</span></label>
                        <select class="custom-select" name="brand_id" required>
                            <option value="">Select one</option>
                            @foreach($brands as $key => $brand)
                                <option value="{{ $key }}">{{ $brand }}</option>
                            @endforeach
                        </select>
                        <div class="clearfix"></div>
                        @if($errors->has('brand_id'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('brand_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Purchase Date <span class="text-danger"> *</span></label>
                        <input type="date" name="purchase_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        <div class="clearfix">
                            @if($errors->has('purchase_date'))
                                <span class="form-text">
                                    <strong class="text-danger form-control-sm">{{ $errors->first('purchase_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Purchase Date <span class="text-danger"> *</span></label>
                        <input type="date" name="expire_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        <div class="clearfix">
                            @if($errors->has('expire_date'))
                                <span class="form-text">
                                    <strong class="text-danger form-control-sm">{{ $errors->first('expire_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label">Quantity <span class="text-danger"> *</span></label>
                        <input type="number" name="qty" id="qty" class="form-control" step="0.01" min = "1"   oninput="maxLengthCheck(this)" maxlength="5" value="{{ old('qty') }}" required>
                        <div class="clearfix">
                            @if($errors->has('qty'))
                                <span class="form-text">
                                    <strong class="text-danger form-control-sm">{{ $errors->first('qty') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label">Unit <span class="text-danger"> *</span></label>
                        <select class="custom-select" name="unit_id" required>
                            <option value="">Select one</option>
                            @foreach($units as $key => $unit)
                                <option value="{{ $key }}">{{ $unit }}</option>
                            @endforeach
                        </select>
                        <div class="clearfix"></div>
                        @if($errors->has('unit_id'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('unit_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label">Unit price <span class="text-danger"> *</span></label>
                        <input type="number" name="unit_price" id="unit_price" class="form-control" step="0.01" min = "1"   oninput="maxLengthCheck(this)" maxlength="5" value="{{ old('qty') }}" required>
                        <div class="clearfix">
                            @if($errors->has('unit_price'))
                                <span class="form-text">
                                    <strong class="text-danger form-control-sm">{{ $errors->first('unit_price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Sale price <span class="text-danger"> *</span></label>
                        <input type="number" name="sale_price" id="sale_price" class="form-control" step="0.01" min = "1" onkeypress="return isNumeric()"  oninput="maxLengthCheck(this)" maxlength="5" value="{{ old('qty') }}" required>
                        <div class="clearfix">
                            @if($errors->has('sale_price'))
                                <span class="form-text">
                                    <strong class="text-danger form-control-sm">{{ $errors->first('sale_price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Total price <span class="text-danger"> *</span></label>
                        <input type="number" name="total_price" id="total_price" class="form-control" step="0.01" min = "1"   oninput="maxLengthCheck(this)" maxlength="5" value="" placeholder="0.00" required readonly>
                        <div class="clearfix">
                            @if($errors->has('total_price'))
                                <span class="form-text">
                                    <strong class="text-danger form-control-sm">{{ $errors->first('total_price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Supplier <span class="text-danger"> *</span></label>
                        <select class="custom-select" name="supplier_id" required>
                            <option value="">Select one</option>
                            @foreach($suppliers as $key => $supplier)
                                <option value="{{ $key }}">{{ $supplier }}</option>
                            @endforeach
                        </select>
                        <div class="clearfix"></div>
                        @if($errors->has('supplier_id'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('supplier_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Status <span class="text-danger"> *</span></label>
                        <select class="custom-select" name="status" required>
                            <option value="">Select one</option>
                            <option value="Active" selected>Active</option>
                            <option value="Active">Inactive</option>
                        </select>
                        <div class="clearfix"></div>
                        @if($errors->has('Status'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('Status') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Description <span class="text-danger"> </span></label>
                    <textarea  name="description" class="form-control" placeholder="Write here" rows="10">{{ old('description') }}</textarea>
                    <div class="clearfix"></div>
                    @if($errors->has('description'))
                        <span class="form-text">
                            <strong class="text-danger form-control-sm">{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('products.index') }}" class="btn btn-primary" title="Back">Back</a>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#qty').on('keyup chang',function (){
            var qty = parseFloat($('#qty').val())||0;
            var unitPrice = parseFloat($('#unit_price').val())||0;

            var Price = parseFloat(qty * unitPrice);

            $('#total_price').val(parseFloat(Price).toFixed(2));
        });
        $('#unit_price').on('keyup chang',function (){
            var qty = parseFloat($('#qty').val())||0;
            var unitPrice = parseFloat($('#unit_price').val())||0;

            var Price = parseFloat(qty * unitPrice);

           $('#total_price').val(parseFloat(Price).toFixed(2));
        })
    </script>
    <script>
        function maxLengthCheck(object) {
            if (object.value.length > object.maxLength)
                object.value = object.value.slice(0, object.maxLength)
        }
    </script>
@endpush

