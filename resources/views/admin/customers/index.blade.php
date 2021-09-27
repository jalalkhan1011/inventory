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
                @if(Auth::user()->hasRole('Admin'))
                    <div class="col-lg-6 text-right">
                        @can('employee-create')
                            <a class="btn btn-success" href="{{ route('customers.create') }}"> Create New Employee</a>
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
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->mobile }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="" class="btn btn-sm btn-info" title="Show"><i class="fa fa-eye"></i> </a></li>
                                <li class="list-inline-item"><a href="{{ route('categories.edit',$customer->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-pencil-alt"></i> </a> </li>
                                <li class="list-inline-item">
                                    <form class="" action="{{ route('customers.destroy',$customer->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you want to delete {{$customer->name}} ?')"><i class="fa fa-trash-alt"></i> </button>
                                    </form>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            {{ $customers->links() }}
        </div>
    </div>
@endsection
