@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Companies
                    <a href="/companies/create" class="btn btn-success float-right">Add Company</a>
                </div>


                <div class="card-body">
                    @if(count($companies) > 0)
                        
                    @foreach ($companies as $company)
                            {{-- <div class="well">
                                <h3>{{ $company->name }}</h3>
                                <small>Location : {{ $company->location }}</small>
                            </div> --}}

                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h4>{{ $company->name }}</h4>
                                    <small><Address></Address> : {{ $company->address }}</small>
                                    <span class="float-right">
                                        <a href="/companies/{{ $company->id }}/edit" class="btn btn-primary">Edit</a>
                                        <a href="#" class="btn btn-danger" onclick="event.preventDefault();
                                            document.getElementById('delete-company').submit();">Delete</a>

                                        <form id="delete-company" action="/companies/{{ $company->id }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">

                                        </form>
                                    </span>
                                </li>
                            </ul>
                        @endforeach
                        
                    @else

                        <p>No company found</p>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
