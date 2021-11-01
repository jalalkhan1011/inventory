@extends('admin.layouts.master')

@section('title','Product Unit')
@section('page_title','Edit unit')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 text-left">
                    <h6>Units</h6>
                    <p class="text-info">Edit unit</p>
                </div>
            </div>
            <hr>
            @if(session('message'))
                <div class="alert {{ Session('alert-class','alert-success','alert-block') }}">
                    <button type="button" class="close" data-dissmiss="alert">x</button>
                    <strong>{{ session('message') }}</strong>
                </div>
            @endif
            <form action="{{ route('units.update',$unit->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="form-label">Name <span class="text-danger"> *</span></label>
                        <input type="text" name="name" value="{{ old('name',$unit->name) }}" class="form-control" placeholder="Name" required/>
                        <div class="clearfix"></div>
                        @if($errors->has('name'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label class="form-label">Status <span class="text-danger"> *</span></label>
                        <select class="custom-select" name="status">
                            <option>Select state</option>
                            <option value="Active" {{ $unit->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ $unit->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
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
                <a href="{{ route('units.index') }}" class="btn btn-primary" title="Back">Back</a>
            </form>
        </div>
    </div>
@endsection

