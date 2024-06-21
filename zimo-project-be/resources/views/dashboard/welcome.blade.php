<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            padding: 1rem;
            width: 250px;
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
        .content {
            flex-grow: 1;
            padding: 1rem;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <h3 class="text-center text-white">Dashboard</h3>
    <a href="{{url(route('create'))}}">Companies</a>
    <a href="{{url(route('List'))}}">List Of Companies</a>
    <a href="#profile">Profile</a>
    <a href="#settings">Settings</a>
    <a href="#logout">Logout</a>
</div>
<main class="content">
    <div id="home" class="section">
        <h1>Home</h1>
        <p>Welcome to the home section of your dashboard.</p>
    </div>
    <div id="profile" class="section">
        <h1>company</h1>
        <p>Manage your profile information here.</p>
    </div>
    <div id="settings" class="section">
        <h1>Settings</h1>
        <p>Adjust your settings here.</p>
    </div>
    <div id="logout" class="section">
        <h1>Logout</h1>
        <p>Click here to log out of your account.</p>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
