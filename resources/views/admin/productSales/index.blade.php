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
                        <a class="btn btn-success" href="{{ url('product-management/sales/create') }}"> Create New Product sale</a>
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
                        <th>Due</th>
                        <th>Change</th>
                        <th>Discount</th>
                        <th>Paid amount</th>
                        <th>Grand total</th>
                        <th width="280px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = $dueTotal = $changeTotal = $paidTotal = $grandTotal = 0; @endphp
                    @foreach($productSales as $productSale)
                        @php
                            $dueTotal += $productSale->due;
                            $changeTotal += $productSale->change;
                            $paidTotal += $productSale->total_price;
                            $grandTotal += $productSale->grand_total;
                        @endphp
                        <tr>
                            <td>{{ sprintf('%02d',++$i) }}</td>
                            <td>{{ $productSale->customers->name }}</td>
                            <td>{{ $productSale->due }}</td>
                            <td>{{ $productSale->change }}</td>
                            <td>{{ $productSale->discount }}</td>
                            <td>{{ $productSale->total_price }}</td>
                            <td>{{ $productSale->grand_total }}</td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item"><a href="" class="btn btn-sm btn-info" title="Show"><i class="fa fa-eye"></i> </a></li>
                                    <li class="list-inline-item"><a href="{{ url('product-management/sales/'.$productSale->id.'/edit') }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-pencil-alt"></i> </a> </li>
                                    <li class="list-inline-item">
                                        <form class="" action="{{ url('product-management/sales/'.$productSale->id) }}" method="post">
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
                    <tfoot>
                    <tr>
                        <td colspan="2" class="text-right font-weight-semibold">Total:</td>
                        <td>{{ $dueTotal }}</td>
                        <td>{{ $changeTotal }}</td>
                        <td></td>
                        <td>{{ $paidTotal }}</td>
                        <td>{{ $grandTotal }}</td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>
                {{ $productSales->links() }}
            </div>
        </div>
    </div>
@endsection

