@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit company</div>

                <div class="card-body">

                    <form action="/companies/{{ $company->id }}" method="post" enctype="multipart/form-data" >
                        @csrf

                        <input type="hidden" name="_method" value="PATCH">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Company name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $company->name }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" name="image" class="form-control"  value="{{ $company->image }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><Address></Address></label>
                                    <input type="text" name="address" class="form-control" value="{{ $company->address }}" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </div>
                            
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection