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
                    <th width="280px">Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td> </td>
                        <td></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
