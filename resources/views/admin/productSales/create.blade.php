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
                        <table class="table table-bordered" id="otherpersonId">
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
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
    <script>
        $(document).ready(function (){
            $('.rowAdd').click(function (){
                var getTr = $('tr.rowFirst:first');
                $('tbody.newRow').append("<tr class='removableRow'>"+getTr.html()+"<tr>");
                var defultRow = $('tr.removableRow:last');
            });
        });
        // $(document).on("click","span.rowRemove",function (){
        //     $(this).closest("tr.removableRow").remove();
        // });
        $(document).on("click", "span.rowRemove ", function () {
            var count = $("#otherpersonId tr").length - 1;
            if (count > 1) {
                $(this).parents("tr").remove();
            }
        });
    </script>
@endpush


