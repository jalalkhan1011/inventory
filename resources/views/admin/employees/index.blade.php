@extends('admin.layouts.master')

@section('title','Employee')
@section('page_title','See all employee')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 text-left">
                    <h6>Employee Management</h6>
                    <p class="text-info">See all employee</p>
                </div>
                @if(Auth::user()->hasRole('Admin'))
                    <div class="col-lg-6 text-right">
                        @can('employee-create')
                            <a class="btn btn-success" href="{{ route('employees.create') }}"> Create New Employee</a>
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
                    <th>Address</th>
                    <th width="280px">Action</th>
                </tr>
                </thead>
                <tbody>
                @php $i = 0; @endphp
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ sprintf('%02d',++$i) }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="" class="btn btn-sm btn-info" title="Show"><i class="fa fa-eye"></i> </a></li>
                                <li class="list-inline-item"><a href="{{ url('admin/employees/'.$employee->id.'/edit') }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-pencil-alt"></i> </a> </li>
                                <li class="list-inline-item">
                                    <form class="" action="{{ url('admin/employees/'.$employee->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you want to delete {{$employee->name}} ?')"><i class="fa fa-trash-alt"></i> </button>
                                    </form>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            {{ $employees->links() }}
        </div>
    </div>
@endsection
