@extends('admin.layouts.master')

@section('title','Supplier')
@section('page_title','See all supplier')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 text-left">
                    <h6>Supplier Management</h6>
                    <p class="text-info">See all supplier</p>
                </div>
                <div class="col-lg-6 text-right">
                    @can('supplier-create')
                        <a class="btn btn-success" href="{{ route('suppliers.create') }}"> Create New Supplier</a>
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
                        <th>Shop name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th width="280px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 0; @endphp
                    @foreach($suppliers as $supplier)
                        <tr>
                            <td>{{ sprintf('%02d',++$i) }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->shop_name }}</td>
                            <td>{{ $supplier->mobile }}</td>
                            <td>{{ $supplier->email }}</td>
                            <td>{{ $supplier->address }}</td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item"><a href="" class="btn btn-sm btn-info" title="Show"><i class="fa fa-eye"></i> </a></li>
                                    <li class="list-inline-item"><a href="{{ url('admin/suppliers/'.$supplier->id.'/edit') }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-pencil-alt"></i> </a> </li>
                                    <li class="list-inline-item">
                                        <form class="" action="{{ url('admin/suppliers/'.$supplier->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you want to delete {{$supplier->name}} ?')"><i class="fa fa-trash-alt"></i> </button>
                                        </form>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $suppliers->links() }}
            </div>
        </div>
    </div>
@endsection
