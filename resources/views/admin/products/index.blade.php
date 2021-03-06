@extends('admin.layouts.master')

@section('title','Product')
@section('page_title','See all product')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 text-left">
                    <h6>Products</h6>
                    <p class="text-info">See all products</p>
                </div>
                <div class="col-lg-6 text-right">
                    @can('product-create')
                        <a class="btn btn-outline-success" href="{{ route('products.create') }}"> New Product</a>
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
            <div class="table-responsive">
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
                    @foreach($products as $product)
                        <tr>
                            <td>{{ sprintf('%02d',++$i) }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->code ? $product->code : 'NUll' }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->brand->name }}</td>
                            <td>{{ $product->qty }}</td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item"><a href="" class="btn btn-outline-info" title="Show"><i class="fa fa-eye"></i> </a></li>
                                    @can('product-edit')
                                        <li class="list-inline-item"><a href="{{ route('products.edit',$product->id) }}" class="btn btn-outline-warning" title="Edit"><i class="fa fa-pencil-alt"></i> </a> </li>
                                    @endcan
                                    @can('product-delete')
                                        <li class="list-inline-item">
                                            <form class="" action="{{ route('products.destroy',$product->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-outline-danger" title="Delete" onclick="return confirm('Are you want to delete {{$product->name}} ?')"><i class="fa fa-trash-alt"></i> </button>
                                            </form>
                                        </li>
                                    @endcan
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
