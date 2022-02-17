{{-- @extends('layouts.app')

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
 --}}


 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    <section style="padding-top:60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
    </section>
    {!! $dataTable->scripts() !!}
</body>
</html>
