@extends('admin.layouts.master')

@section('title','User')
@section('page_title','See All User')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 text-left">
                    <h6>User Management</h6>
                    <p class="text-info">See all user</p>
                </div>
                @if(Auth::user()->hasRole('Admin'))
                    <div class="col-lg-6 text-right">
                        @can('user-create')
                            <a class="btn btn-outline-success" href="{{ route('users.create') }}"> New user</a>
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
                        <th>Roles</th>
                        <th width="280px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $key => $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-outline-info" href="{{ route('users.show',$user->id) }}">Show</a>
                                @can('user-edit')
                                    <a class="btn btn-outline-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                @endcan
                                @can('user-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger']) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    {!! $data->render() !!}
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
