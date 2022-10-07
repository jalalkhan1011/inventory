@extends('admin.layouts.master')

@section('title','Product Sub Category')
@section('page_title','Create sub category')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 text-left">
                    <h6>{{ __('Sub Category') }}</h6>
                    <p class="text-info">{{ __('Create sub category') }}</p>
                </div>
            </div>
            <hr>
            <form action="{{ route('subcategorystore') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="form-label">{{ __('Name') }} <span class="text-danger"> *</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name">
                        <div class="clearfix"></div>
                        @if($errors->has('name'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-12">
                        <label class="form-label">{{ __('Parent Category') }} <span class="text-danger"> *</span></label>
                        <select class="custom-select" name="parent_id">
                            <option value="">{{ __('Select parent category') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="clearfix"></div>
                        @if($errors->has('parent_id'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('parent_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-12">
                        <label class="form-label">{{ __('Status') }} <span class="text-danger"> *</span></label>
                        <select class="custom-select" name="status">
                            <option disabled>{{ __('Select state') }}</option>
                            <option value="Active" selected>{{ __('Active') }}</option>
                            <option value="Inactive">I{{ __('Inactive') }}</option>
                        </select>
                        <div class="clearfix"></div>
                        @if($errors->has('Status'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('Status') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                <a href="{{ route('subcategorylist') }}" class="btn btn-primary" title="Back">{{ __('Back') }}</a>
            </form>
        </div>
    </div>
@endsection


