@extends('admin.layouts.master')

@section('title','Customer')
@section('page_title','See all customer')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 text-left">
                    <h6>Customer Management</h6>
                    <p class="text-info">See all customer</p>
                </div>
                <div class="col-lg-6 text-right">
                    @can('customer-create')
                        <a class="btn btn-success" href="{{ route('customers.create') }}"> New Employee</a>
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
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th width="280px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 0; @endphp
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ sprintf('%02d',++$i) }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email ? $customer->email : 'Null' }}</td>
                            <td>{{ $customer->mobile }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item"><a href="" class="btn btn-sm btn-info" title="Show"><i class="fa fa-eye"></i> </a></li>
                                    @can('customer-edit')
                                    <li class="list-inline-item"><a href="{{ route('customers.edit',$customer->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-pencil-alt"></i> </a> </li>
                                    @endif
                                    @can('customer-delete')
                                    <li class="list-inline-item">
                                        <form class="" action="{{ route('customers.destroy',$customer->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you want to delete {{$customer->name}} ?')"><i class="fa fa-trash-alt"></i> </button>
                                        </form>
                                    </li>
                                    @endcan
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $customers->links() }}
            </div>
        </div>
    </div>
@endsection
