@extends('admin.layouts.master')

@section('title','Product Brand')
@section('page_title','See all brand')

@section('content')
    @include('sweetalert::alert')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 text-left">
                    <h6>Product brand</h6>
                    <p class="text-info">See all brand</p>
                </div>
                <div class="col-lg-6 text-right">
                    @can('brand-create')
                        <a class="btn btn-outline-success" href="{{ route('brands.create') }}"> New Brand</a>
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
                        <th>Description</th>
                        <th width="280px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 0; @endphp
                    @foreach($brands as $brand)
                        <tr>
                            <td>{{ sprintf('%02d',++$i) }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->description }}</td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item"><a href="" class="btn btn-outline-info" title="Show"><i class="fa fa-eye"></i> </a></li>
                                    @can('brand-edit')
                                        <li class="list-inline-item"><a href="{{ route('brands.edit',$brand->id) }}" class="btn btn-outline-warning" title="Edit"><i class="fa fa-pencil-alt"></i> </a> </li>
                                    @endcan
                                    @can('brand-delete')
                                        <li class="list-inline-item">
                                            <form class="" action="{{ route('brands.destroy',$brand->id) }}" method="post" id="deleteButton{{ $brand->id }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-outline-danger" title="Delete" onclick="sweetalertDelete({{ $brand->id }})"><i class="fa fa-trash-alt"></i> </button>
                                            </form>
                                        </li>
                                    @endcan
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $brands->links() }}
            </div>
        </div>
    </div>
@endsection
