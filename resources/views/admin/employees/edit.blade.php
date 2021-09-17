@extends('admin.layouts.master')

@section('title','Employee')
@section('page_title','Edit employee')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 text-left">
                    <h6>Employee</h6>
                    <p class="text-info">Edit employee</p>
                </div>
            </div>
            <hr>
            @if(session('message'))
                <div class="alert {{ Session('alert-class','alert-success','alert-block') }}">
                    <button type="button" class="close" data-dissmiss="alert">x</button>
                    <strong>{{ session('message') }}</strong>
                </div>
            @endif
            <form action="{{ url('admin/employees/'.$employee->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Name <span class="text-danger"> *</span></label>
                        <input type="text" name="name" value="{{ old('name',$employee->name) }}" class="form-control" placeholder="Name" required/>
                        <div class="clearfix"></div>
                        @if($errors->has('name'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Email <span class="text-danger"> *</span></label>
                        <input type="email" name="email" value="{{ old('email',$employee->email) }}" class="form-control" placeholder="Email" required/>
                        <div class="clearfix"></div>
                        @if($errors->has('email'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Address <span class="text-danger"> *</span></label>
                    <input type="text" name="address" class="form-control" value="{{ old('address',$employee->address) }}" placeholder="1234 Main St" required/>
                    <div class="clearfix"></div>
                    @if($errors->has('address'))
                        <span class="form-text">
                            <strong class="text-danger form-control-sm">{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection

