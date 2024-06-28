@extends('layouts.default')

@section('title', 'Edit Company')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Company</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('updateCompany', $company->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="form-group mb-3 text-center">
                                @if ($company->logo)
                                    <div>
                                        <img src="{{ $logoUrl }}" alt="Company Logo" width="150" class="mt-2">
                                    </div>
                                @endif
                                    <div class="form-group m-3">
                                        <input type="file" id="logo"  class="form-control w-40"  name="logo">
                                    </div>
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="Name" id="name" class="form-control" name="name" value="{{ old('name', $company->name) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <input type="email" placeholder="Email" id="email" class="form-control" name="email" value="{{ old('email', $company->email) }}" required>
                            </div>

                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Update Company</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
