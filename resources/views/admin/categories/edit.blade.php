@extends('admin.layouts.master')

@section('title','Product Category')
@section('page_title','Edit category')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 text-left">
                    <h6>Category</h6>
                    <p class="text-info">Edit category</p>
                </div>
            </div>
            <hr>
            @if(session('message'))
                <div class="alert {{ Session('alert-class','alert-success','alert-block') }}">
                    <button type="button" class="close" data-dissmiss="alert">x</button>
                    <strong>{{ session('message') }}</strong>
                </div>
            @endif
            <form action="{{ url('admin/categories/'.$category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="form-label">Name <span class="text-danger"> *</span></label>
                        <input type="text" name="name" value="{{ old('name',$category->name) }}" class="form-control" placeholder="Name" required/>
                        <div class="clearfix"></div>
                        @if($errors->has('name'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label class="form-label">Description <span class="text-danger"> </span></label>
                        <textarea  name="description"  class="form-control" placeholder="Write here">{{ old('description',$category->description) }}</textarea>
                        <div class="clearfix"></div>
                        @if($errors->has('description'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label class="form-label">Status <span class="text-danger"> *</span></label>
                        <select class="custom-select" name="status">
                            <option>Select state</option>
                            <option value="Active" {{ $category->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ $category->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <div class="clearfix"></div>
                        @if($errors->has('Status'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('Status') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ url('admin/categories') }}" class="btn btn-primary" title="Back">Back</a>
            </form>
        </div>
    </div>
@endsection

