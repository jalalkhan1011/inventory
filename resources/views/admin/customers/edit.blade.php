@extends('admin.layouts.master')

@section('title','Customers')
@section('page_title','Edit customer')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 text-left">
                    <h6>customer</h6>
                    <p class="text-info">Edit customer</p>
                </div>
            </div>
            <hr>
            @if(session('message'))
                <div class="alert {{ Session('alert-class','alert-success','alert-block') }}">
                    <button type="button" class="close" data-dissmiss="alert">x</button>
                    <strong>{{ session('message') }}</strong>
                </div>
            @endif
            <form action="{{ route('customers.update',$customer->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Name <span class="text-danger"> *</span></label>
                        <input type="text" name="name" value="{{ old('name',$customer->name) }}" class="form-control" placeholder="Name" required/>
                        <div class="clearfix"></div>
                        @if($errors->has('name'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Mobile <span class="text-danger"> *</span></label>
                        <input type="number" name="mobile" value="{{ old('mobile',$customer->mobile) }}" class="form-control" minlength="11" maxlength="11" placeholder="01XXX-XXXXXX" required/>
                        <div class="clearfix"></div>
                        @if($errors->has('mobile'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('mobile') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Email <span class="text-danger"> </span></label>
                        <input type="email" name="email" value="{{ old('email',$customer->email) }}" class="form-control" placeholder="Email"/>
                        <div class="clearfix"></div>
                        @if($errors->has('email'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Zip <span class="text-danger"> </span></label>
                        <input type="text" name="zip_code" value="{{ old('zip_code', $customer->zip_code) }}" class="form-control" minlength="4" maxlength="8" placeholder="Ex-9242" required/>
                        <div class="clearfix"></div>
                        @if($errors->has('zip_code'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('zip_code') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Address <span class="text-danger"> *</span></label>
                    <input type="text" name="address" value="{{ old('address',$customer->address) }}" class="form-control" placeholder="1234 Main St" required/>
                    <div class="clearfix"></div>
                    @if($errors->has('address'))
                        <span class="form-text">
                            <strong class="text-danger form-control-sm">{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('customers.index') }}" class="btn btn-primary" title="Back">Back</a>
            </form>
        </div>
    </div>
@endsection

