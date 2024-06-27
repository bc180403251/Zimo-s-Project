<!-- resources/views/companies/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Company</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Company Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Company Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $company->email) }}" required>
            </div>

            <div class="form-group">
                <label for="logo">Company Logo</label>
                @if ($company->logo)
                    <div>
                        <img src="{{ $company->logo }}" alt="Company Logo" width="150">
                    </div>
                    <button type="button" class="btn btn-secondary mt-2" onclick="document.getElementById('logo').click();">Change Profile</button>
                @endif
                <input type="file" name="logo" class="form-control d-none" id="logo">
            </div>

            <button type="submit" class="btn btn-primary">Update Company</button>
        </form>
    </div>
@endsection
