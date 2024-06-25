<!DOCTYPE html>
<html>
<head>
    <title>Welcome to the Company</title>
</head>
<body>
<h1>Welcome, {{ $employee->first_name }} {{ $employee->last_name }}</h1>
<p>We are excited to have you join our company. Below are your details:</p>
<ul>
    <li><strong>First Name:</strong> {{ $employee->first_name }}</li>
    <li><strong>Last Name:</strong> {{ $employee->last_name }}</li>
    <li><strong>Email:</strong> {{ $employee->email }}</li>
    <li><strong>Phone:</strong> {{ $employee->phone }}</li>
    <li><strong>Gender:</strong> {{ $employee->gender }}</li>
    <li><strong>Company:</strong> {{ $employee->company->name }}</li>
</ul>
<p>We look forward to working with you!</p>
</body>
</html>
