@extends('layouts.default')

@section('title', 'Create Company')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Create Company</h3>
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
                        <form method="POST" action= {{route('storeCompany')}} >
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Name" id="name" class="form-control" name="name"  required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" placeholder="Email" id="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="file" id="MyFile" class="form-control"  name="filename">
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Create Company</button>
                            </div>
{{--                            <div class="d-grid mx-auto mt-3">--}}
{{--                                <button type="submit" class="btn btn-dark btn-block" {{url(route('dashboard'))}}>Cancel</button>--}}
{{--                            </div>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
