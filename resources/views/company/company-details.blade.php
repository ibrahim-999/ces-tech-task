@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Company's Employees
                    <a href="/employees/{{ $company->id }}/create" class="btn btn-success float-right">Add Employee</a>
                </div>


                <div class="card-body">
                    @if(count($employees) > 0)

                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                        @foreach ($employees as $employee)

                          <tr>
                            <td>{{ $employee->first_name }}</td>
                            <td>{{ $employee->last_name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>
                                <a href="/employees/{{$employee->id}}/edit" class="btn btn-primary">Edit</a>
                                <a href="#" class="btn btn-danger" onclick="event.preventDefault();
                                    document.getElementById('delete-employee').submit();">Remove</a>

                                <form id="delete-employee" action="/employees/{{ $employee->id }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">

                                </form>
                            </td>
                          </tr>

                        @endforeach

                        </tbody>
                      </table>
                        
                    @else

                        <p>No company found</p>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
