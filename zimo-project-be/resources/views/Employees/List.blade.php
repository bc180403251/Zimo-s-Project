{{--@extends('layouts.default')--}}

{{--@section('title', 'Employees')--}}

{{--@section('content')--}}
{{--    <div class="container mt-5">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                @if(session('success'))--}}
{{--                    <div class="alert alert-success">--}}
{{--                        {{ session('success') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h3>Employees</h3>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <table class="table table-bordered">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>Sr#</th>--}}
{{--                                <th>First Name</th>--}}
{{--                                <th>Last Name</th>--}}
{{--                                <th>Email</th>--}}
{{--                                <th>phone</th>--}}
{{--                                <th>Gender</th>--}}
{{--                                <th>Company</th>--}}
{{--                                <th>Actions</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($employees as $index => $employee)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ $index + 1 }}</td>--}}
{{--                                    <td>{{ $employee->first_name }}</td>--}}
{{--                                    <td>{{$employee->last_name}}</td>--}}
{{--                                    <td>{{ $employee->email }}</td>--}}
{{--                                    <td>{{ $employee->phone }}</td>--}}
{{--                                    <td>{{ $employee->gender }}</td>--}}
{{--                                    <td>{{ $employee-> company->name}}</td>--}}

{{--                                    <td>--}}
{{--                                        <a href="{{url(route('view', $employee->id))}}" class="btn btn-info btn-sm">View</a>--}}
{{--                                        <a href="{{url(route('update', $employee->id))}}" class="btn btn-primary btn-sm">Edit</a>--}}
{{--                                        <form action="{{route('delete', $employee->id)}}" method="POST" style="display:inline;">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                            <input type="hidden" name="employee_id" value="{{$employee->id}}">--}}
{{--                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this company?');">Delete</button>--}}
{{--                                        </form>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

@extends('layouts.default')
@section('title','Employee List')

@section('content')
    <div class="container">

        <h2>Employee list</h2>
        <table class="table table-bordered" id="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>First name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
            </tr>
            </thead>
        </table>
    </div>
    <script>
        $(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('employee.data') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'first_name', name: 'first_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'gender', name: 'gender' },
                ]
            });
        });
    </script>
    </div>

@endsection



