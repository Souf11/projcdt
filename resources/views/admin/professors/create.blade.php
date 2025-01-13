<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professors and Classes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    
    </style>

    <div class="card">
        <div class="card-header" style="background-color:rgb(12, 40, 85)">Add New Professor</div>
        <div class="card-body">
            {{-- Display validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Add Professor Form --}}
            <form action="{{ route('admin.professors.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Le nom du professeur" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="L'email du professeur" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Le mot de passe du professeur" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirmer le mot de passe" required>
                </div>

                <button type="submit" class="btn btn-primary w-100" style="background-color:rgb(12, 40, 85)" >Add Professor</button>
            </form>
        </div>
    </div>
</div>
@endsection

</body>
</html>
