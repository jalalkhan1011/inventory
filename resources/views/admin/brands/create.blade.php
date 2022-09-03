@extends('admin.layouts.master')

@section('title','Product Brand')
@section('page_title','Create brand')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 text-left">
                    <h6>Brand</h6>
                    <p class="text-info">Create brand</p>
                </div>
            </div>
            <hr>
            <form action="{{ route('brands.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="form-label">Name <span class="text-danger"> *</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name" required/>
                        <div class="clearfix"></div>
                        @if($errors->has('name'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label class="form-label">Description <span class="text-danger"> </span></label>
                        <textarea  name="description"  class="form-control" placeholder="Write here">{{ old('description') }}</textarea>
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
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
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
                <a href="{{ url('admin/brands') }}" class="btn btn-primary" title="Back">Back</a>
            </form>
        </div>
    </div>
@endsection

