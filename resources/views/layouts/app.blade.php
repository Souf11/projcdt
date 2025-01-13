<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS Inside the HTML File -->
    <style>
        /* Basic resets and body styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #4e73df;
            padding: 10px;
        }

        .navbar-brand {
            color: #fff !important;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            padding: 8px 15px;
        }

        .navbar-nav .nav-link:hover {
            background-color: #375a8c;
            border-radius: 5px;
        }

        /* Main Content Area */
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Footer Styling */
        footer {
            background-color: #f8f9fc;
            color: #777;
            font-size: 0.9rem;
        }

        /* Card Styling for Professors and Courses */
        .card {
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #4e73df;
            color: white;
            font-weight: bold;
        }

        .card-body {
            padding: 15px;
            background-color: #f9fafc;
        }

        /* Tables */
        .table {
            margin-top: 20px;
        }

        .table thead {
            background-color: #4e73df;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Custom Buttons */
        .btn-custom {
            background-color: #4e73df;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
        }

        .btn-custom:hover {
            background-color: #375a8c;
        }

        /* Spacing and Alignment */
        .mt-4 {
            margin-top: 2rem !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="text-white p-4 flex justify-between items-center" style="background-color: #041228;">

    <a href="{{ route('admin.home') }}" class="text-lg font-bold no-underline text-white">Admin</a>


    <div>
        <!-- Logout Form -->
        <form action="{{ route('admin.logout') }}" method="POST" class="inline-block">
            @csrf
            <button type="submit" class="bg-red-500 px-4 py-2 rounded text-white hover:bg-red-900"> 
                Se deconnecter
            </button>
        </form>
    </div>
</nav>

    <!-- Main Content -->
    <div class="container mt-4">
        @yield('content')
    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
