@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard
                    <a href="/companies" class="btn btn-success float-right">Companies</a>
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
                                        <img src="{{ asset('images/'. $company->image) }}" alt="" class=" 
                                        width: 50px; 
                                        height: 50px; 
                                        display: block; 
                                        text-indent: -9999px;"/>
                                        <h4>{{ $company->name }}</h4>
                                        <small><strong>Address :</strong> {{ $company->address }}</small></br>
                                        <span class="float-right">
                                            <a href="/companies/{{ $company->id }}" class="btn btn-primary">Details</a>
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
