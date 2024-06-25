@extends('layouts.default')

@section('title', 'Create Employee')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header ">Create Employee</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('createEmployee')}}">
                            @csrf
                            <div class="form-group ">
                                <input type="text" name="first_name" placeholder="First Name" class="form-control" required>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" placeholder="Last Name" name="last_name" class="form-control" required autofocus>
                            </div>
                            <div class="form-group mt-3">
                                <input type="email" placeholder="Email" name="email" class="form-control" required autofocus>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" name="phone" placeholder="Phone" class="form-control" required autofocus>
                            </div>
                            <div class="form-group mt-3">
                                <select name="gender"  class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group mt-3">
{{--                                <label for="company_id">Company</label>--}}
                                <select name="company_id" class="form-control" >
                                    <option value="">Select Company</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-dark d-block w-100 mt-3">Create Employee</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
