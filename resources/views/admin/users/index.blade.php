@extends('admin.layouts.master')

@section('title','User')
@section('page_title','See All User')

@section('content')
    @include('sweetalert::alert')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 text-left">
                    <h6>{{ __('User Management') }}</h6>
                    <p class="text-info">{{ __('See all user') }}</p>
                </div>
                @if(Auth::user()->hasRole('Admin'))
                    <div class="col-lg-6 text-right">
                        @can('user-create')
                            <a class="btn btn-outline-success" href="{{ route('users.create') }}"> {{ __('New user') }}</a>
                        @endcan
                    </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table card-table">
                    <thead class="thead-light">
                    <tr>
                        <th>{{ __('No') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Roles') }}</th>
                        <th>{{ __('Action') }}</th>
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
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-info" href="{{ route('users.show',$user->id) }}"><i class="fa fa-eye"></i></a>
                                    </li>
                                    @can('user-edit')
                                        <li class="list-inline-item">
                                            <a class="btn btn-outline-warning" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-pencil-alt"></i></a>
                                        </li>
                                    @endcan
                                    @can('user-delete')
                                        <li class="list-inline-item">
                                            <form class="" action="{{ route('users.destroy',$user->id) }}" method="post" id="deleteButton{{ $user->id }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-outline-danger" title="Delete" onclick="sweetalertDelete({{ $user->id }})"><i class="fa fa-trash-alt"></i> </button>
                                            </form>
                                        </li>
                                    @endcan
                                </ul>
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
