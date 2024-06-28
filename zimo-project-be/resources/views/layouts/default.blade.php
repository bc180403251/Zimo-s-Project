<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Zimo Project')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @yield('styles')
    @yield('head-scripts')
    <style>
        body {
            display: flex;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            padding: 1rem;
            width: 250px;
            transition: width 0.3s;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar.collapsed {
            width: 0;
            padding: 1rem 0;
        }
        .sidebar.collapsed a {
            display: none;
        }
        .toggle-btn {
            position: absolute;
            top: 15px;
            left: 15px;
            cursor: pointer;
            z-index: 1000;
        }
        .content {
            flex-grow: 1;
            padding: 1rem;
        }
    </style>
</head>
<body>
<div class="toggle-btn">
    <span>&#8942;</span> <!-- Three dots icon -->
</div>
<div class="sidebar">
    <h3 class="text-center text-white">Dashboard</h3>
    <a href="{{ url(route('create')) }}">Companies</a>
    <a href="{{ url(route('company')) }}">List Of Companies</a>
    <a href="{{ url(route('createEmployee')) }}">Create Employee</a>
    <a href="{{ url(route('employeelist')) }}">Employees List</a>
    <a href="#logout">Logout</a>
</div>
<div class="content">
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@yield('body-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.querySelector('.toggle-btn');
        const sidebar = document.querySelector('.sidebar');

        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
        });
    });
</script>
</body>
</html>
