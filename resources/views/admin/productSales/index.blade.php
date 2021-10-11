@extends('admin.layouts.master')

@section('title','Product Sale')
@section('page_title','See all sale product')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 text-left">
                    <h6>Products</h6>
                    <p class="text-info">See all sale product</p>
                </div>
                <div class="col-lg-6 text-right">
                    @can('product-sale-create')
                        <a class="btn btn-success" href="{{ route('productsales.create') }}"> Create New Product sale</a>
                    @endcan
                </div>
            </div>
            <hr>
            @if(session('message'))
                <div  class="alert {{ Session('alert-class', 'alert-success','alert-block') }}">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ session('message') }}</strong>
                </div>
            @endif
            <table class="table card-table">
                <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Qty</th>
                    <th width="280px">Action</th>
                </tr>
                </thead>
                <tbody>
                @php $i = 0; @endphp
                @foreach($productSales as $productSale)
                    <tr>
{{--                        <td>{{ sprintf('%02d',++$i) }}</td>--}}
{{--                        <td>{{ $product->name }}</td>--}}
{{--                        <td>{{ $product->code ? $product->code : 'NUll' }}</td>--}}
{{--                        <td>{{ $product->category->name }}</td>--}}
{{--                        <td>{{ $product->brand->name }}</td>--}}
{{--                        <td>{{ $product->qty }}</td>--}}
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="" class="btn btn-sm btn-info" title="Show"><i class="fa fa-eye"></i> </a></li>
                                <li class="list-inline-item"><a href="{{ route('productsales.edit',$productSale->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-pencil-alt"></i> </a> </li>
                                <li class="list-inline-item">
                                    <form class="" action="{{ route('productsales.destroy',$productSale->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you want to delete {{$productSale->id}} ?')"><i class="fa fa-trash-alt"></i> </button>
                                    </form>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $productSales->links() }}
        </div>
    </div>
@endsection

