<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Add your CSS and JS files here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <!-- Admin Sidebar -->
    <div class="sidebar">
        <!-- Add sidebar menu here -->
        <ul>
            <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.professors.index') }}">Professors</a></li>
            <li><a href="{{ route('admin.courses.index') }}">Courses</a></li>
            <!-- Add more links as needed -->
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')  <!-- This is where the page content will be injected -->
    </div>

    <!-- Add your JS files here -->
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
