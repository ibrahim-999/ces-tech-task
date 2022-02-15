@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Company's Employees
                    <span class="float-right">
                        <a href="/employees/{{ $company->id }}/create" class="btn btn-success ">Add Employee</a>
                    <a href="/companies" class="btn btn-primary ">Back</a>
                    </span>
                </div>

                <div class="card-body">
                    @if(count($employees) > 0)

                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Image</th>
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
                                <?php $employee_image_path = "images/".$employee->image; ?>
                            @if(!empty($employee->image)&& file_exists($employee_image_path))
                                <img  style="width: 100px;"  src="{{asset('images/'.$employee->image)}}">
                            @else
                                <img  style="width: 100px;"  src="{{asset('images/no-image.png')}}">
                            @endif
                            </td>
                            <td>
                                <a href="/employees/{{$employee->id}}/edit" class="btn btn-primary">Edit</a>
                                <a href="#" class="btn btn-danger" onclick="event.preventDefault();
                                    document.getElementById('delete-employee').submit();">s</a>

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
