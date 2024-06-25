@extends('layouts.default')

@section('title', 'View Employee')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">View Employee</div>
                    <div class="card-body">
                        <form>
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <input type="text" name="first_name" placeholder="First Name" class="form-control" value="{{ old('first_name', $employee->first_name) }}" required disabled>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" placeholder="Last Name" name="last_name" class="form-control" value="{{ old('last_name', $employee->last_name) }}" required autofocus disabled>
                            </div>
                            <div class="form-group mt-3">
                                <input type="email" placeholder="Email" name="email" class="form-control" value="{{ old('email', $employee->email) }}" required autofocus disabled>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" name="phone" placeholder="Phone" class="form-control" value="{{ old('phone', $employee->phone) }}" required autofocus disabled>
                            </div>
                            <div class="form-group mt-3">
                                <select name="gender" class="form-control" required disabled>
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender', $employee->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $employee->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender', $employee->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" name="company" placeholder="Company" class="form-control" value="{{ old('company-id', $employee->company->name) }}" required autofocus disabled>
                            </div>
{{--                            <div class="form-group mt-3">--}}
{{--                                <select name="company_id" class="form-control" disabled>--}}
{{--                                    <option value="">Select Company</option>--}}
{{--                                        <option value="{{ $company->id }}" {{ old('company_id', $employee->company_id) == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>--}}

{{--                                </select>--}}
{{--                            </div>--}}

                            <a href="{{ route('List') }}" class="btn btn-dark d-block w-100 mt-3">Back to List</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
