@extends('admin.layouts.master')

@section('title','Product unit')
@section('page_title','See all unit')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 text-left">
                    <h6>Product Unit</h6>
                    <p class="text-info">See all unit</p>
                </div>
                <div class="col-lg-6 text-right">
                    @can('unit-create')
                        <a class="btn btn-success" href="{{ route('units.create') }}"> Create New unit</a>
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
                    <th>Status</th>
                    <th width="280px">Action</th>
                </tr>
                </thead>
                <tbody>
                @php $i = 0; @endphp
                @foreach($units as $unit)
                    <tr>
                        <td>{{ sprintf('%02d',++$i) }}</td>
                        <td>{{ $unit->name }}</td>
                        <td>{{ $unit->status }}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="" class="btn btn-sm btn-info" title="Show"><i class="fa fa-eye"></i> </a></li>
                                @can('unit-edit')
                                    <li class="list-inline-item"><a href="{{ route('units.edit',$unit->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-pencil-alt"></i> </a> </li>
                                @endcan
                                @can('unit-delete')
                                    <li class="list-inline-item">
                                        <form class="" action="{{ route('units.destroy',$unit->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you want to delete {{$unit->name}} ?')"><i class="fa fa-trash-alt"></i> </button>
                                        </form>
                                    </li>
                                @endcan
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $units->links() }}
        </div>
    </div>
@endsection
