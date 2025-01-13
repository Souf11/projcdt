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
        <h2 class="mb-4 text-2xl font-bold">Liste des professeurs</h2>

        <!-- Button to add a new professor -->
        <a href="{{ route('admin.professors.create') }}" class="btn btn-primary mb-4 inline-block text-white px-4 py-2 rounded" style="background-color: #041228;" >
            Ajouter
        </a>

        <!-- Loop through the professors and display their courses -->
        @foreach($professors as $professor)
            <div class="card mb-4 bg-white p-4 rounded shadow-md">
                <div class="card-header  text-white p-4 rounded" style="background-color: #041228;">
                    <h4>{{ $professor->name }}</h4>
                    <p>{{ $professor->email }}</p>
                </div>
                <div class="card-body">
                    <h5 class="font-semibold">Classes:</h5>
                    <ul class="list-group">
                        @if($professor->courses->isEmpty())
                            <li class="list-group-item">Pas de seances</li>
                        @else
                            @foreach($professor->courses as $course)
                                <li class="list-group-item">
                                    <strong>{{ $course->course_name }}</strong><br>
                                    <small>{{ $course->date }}</small><br>
                                    <p>{{ $course->details }}</p>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- Edit and Delete buttons -->
                <div class="card-footer flex justify-between mt-4">
                <a href="{{ route('admin.professors.edit', $professor->id) }}" class="btn btn-primary mb-4 inline-block text-white px-4 py-2 rounded" style="background-color: #041228;">
    Modifier
</a>

                    <form action="{{ route('admin.professors.destroy', $professor->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce professeur ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger bg-red-500 text-white px-4 py-2 rounded">Supprimer</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection

</body>
</html>
