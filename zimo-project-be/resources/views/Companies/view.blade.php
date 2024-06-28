@extends('layouts.default')

@section('title', 'View Company')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">View Company</div>
                    <div class="card-body text-center">
                        @if ($company->logo)
                            <div class="mb-3">
                                <img src="{{ $company->logo }}" alt="Company Logo" class="img-fluid" style="max-width: 200px;">
                            </div>
                        @endif
                        <form>
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <input type="text" name="name" placeholder="Company Name" class="form-control" value="{{ old('name', $company->name) }}"  disabled>
                            </div>
                            <div class="form-group mt-3">
                                <input type="email" placeholder="Company Email" name="email" class="form-control" value="{{ old('email', $company->email) }}"  disabled>
                            </div>
                            <a href="{{ route('company') }}" class="btn btn-dark d-block w-100 mt-3">Back to List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
