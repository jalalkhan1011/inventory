@extends('admin.layouts.master')

@section('title','Product sub category')
@section('page_title','See all sub category')

@section('content')
    @include('sweetalert::alert')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 text-left">
                    <h6>{{ __('Product sub category') }}</h6>
                    <p class="text-info">{{ __('See all sub category') }}</p>
                </div>
                <div class="col-lg-6 text-right">
                        <a class="btn btn-outline-success" href="{{ route('subcategories') }}"> {{ __('New Sub Category') }}</a>
                </div>
            </div>
            <hr>
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

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

