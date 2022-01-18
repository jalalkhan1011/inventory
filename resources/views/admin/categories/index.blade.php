@extends('admin.layouts.master')

@section('title','Product category')
@section('page_title','See all category')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 text-left">
                    <h6>Product category</h6>
                    <p class="text-info">See all category</p>
                </div>
                <div class="col-lg-6 text-right">
                    @can('category-create')
                        <a class="btn btn-success" href="{{ route('categories.create') }}"> New Category</a>
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
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ sprintf('%02d',++$i) }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item"><a href="" class="btn btn-sm btn-info" title="Show"><i class="fa fa-eye"></i> </a></li>
                                    @can('category-edit')
                                        <li class="list-inline-item"><a href="{{ route('categories.edit',$category->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-pencil-alt"></i> </a> </li>
                                    @endcan
                                    @can('category-delete')
                                    <li class="list-inline-item">
                                        <form class="" action="{{ route('categories.destroy',$category->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you want to delete {{$category->name}} ?')"><i class="fa fa-trash-alt"></i> </button>
                                        </form>
                                    </li>
                                    @endcan
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
