@extends('admin.layouts.master')

@section('title','User profile')
@section('page_title','Create profile')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 text-left">
                    <h6>Profile</h6>
                    <p class="text-info">Edit profile</p>
                </div>
            </div>
            <hr>
            @if(session('message'))
                <div class="alert {{ Session('alert-class','alert-success','alert-block') }}">
                    <button type="button" class="close" data-dissmiss="alert">x</button>
                    <strong>{{ session('message') }}</strong>
                </div>
            @endif
            <form action="{{ url('profiles') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="form-label">Profile image</label><br>
                                @if(!empty($profile->profile_image))
                                    <img class="image-preview" id="profile_image"  src="{{ file_exists('uploads/profileImage/'.$profile->profile_image) ? asset('uploads/profileImage/'.$profile->profile_image) : asset('default/Profile_avatar.png') }}" alt="...">
                                    <input type="file" class="pt-1" name="profile_image" onchange="loadFile()">
                                @else
                                    <img class="image-preview" id="profile_image"  src="{{  asset('default/Profile_avatar.png') }}" alt="...">
                                    <input type="file" class="pt-1" name="profile_image" onchange="loadFile()">
                                @endif
                                <div class="clearfix"></div>
                                @if($errors->has('profile_image'))
                                    <span class="form-text">
                                        <strong class="text-danger form-control-sm">{{ $errors->first('profile_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Name <span class="text-danger"> *</span></label>
                        <input type="text" name="name" value="{{ old('name',$user->name) }}" class="form-control" placeholder="Name" required/>
                        <div class="clearfix"></div>
                        @if($errors->has('name'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Mobile <span class="text-danger"> *</span></label>
                        <input type="number" name="mobile" minlength="11" maxlength="11" value="{{ old('mobile',$profile->mobile) }}" class="form-control" placeholder="Mobile" required/>
                        <div class="clearfix"></div>
                        @if($errors->has('mobile'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('mobile') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Email <span class="text-danger"> *</span></label>
                        <input type="email" name="email" value="{{ old('email',$user->email) }}" class="form-control" placeholder="Email" required/>
                        <div class="clearfix"></div>
                        @if($errors->has('email'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" />
                        <div class="clearfix"></div>
                        @if($errors->has('password'))
                            <span class="form-text">
                                <strong class="text-danger form-control-sm">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Address <span class="text-danger"> *</span></label>
                    <input type="text" name="address" class="form-control" value="{{ old('address',$profile->address) }}" placeholder="1234 Main St" required/>
                    <div class="clearfix"></div>
                    @if($errors->has('address'))
                        <span class="form-text">
                            <strong class="text-danger form-control-sm">{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        var loadFile = function () {
            var profile_image = document.getElementById('profile_image');
            profile_image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endpush
