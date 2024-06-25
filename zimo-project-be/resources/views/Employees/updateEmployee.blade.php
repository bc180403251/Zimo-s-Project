
@extends('layouts.default')
@section('title','Update Employee')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Employee</div>

                    <div class="card-body">
                        <form action="{{route('update', $employee->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <input type="text" placeholder="First Name" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $employee->first_name) }}" required>
                            </div>

                            <div class="form-group mt-3">

                                <input type="text" placeholder="Last Name" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $employee->last_name) }}" required>
                            </div>

                            <div class="form-group mt-3">
                                <input type="email" placeholder="Email" class="form-control" id="email" name="email" value="{{ old('email', $employee->email) }}" required>
                            </div>

                            <div class="form-group mt-3">
                                <input type="text" placeholder="Phone" class="form-control" id="phone" name="phone" value="{{ old('phone', $employee->phone) }}" required>
                            </div>

                            <div class="form-group mt-3">

                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="male" {{ old('gender', $employee->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $employee->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender', $employee->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                {{--                                <label for="company_id">Company</label>--}}
                                <select name="company_id" class="form-control" >
                                    <option value="">Select Company</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id', $employee->company_id) == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-dark d-block w-100 mt-3">Update Employee</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
