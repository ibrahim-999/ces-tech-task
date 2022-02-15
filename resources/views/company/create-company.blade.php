@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new company
                    <a href="/companies" class="btn btn-primary float-right">Back</a>
                </div>

                <div class="card-body">

                    <form action="/companies" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Company name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" name="image" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" name="address" class="form-control" required>
                                </div>
                            </div>

                            {{-- Get logged in user_id --}}
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

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