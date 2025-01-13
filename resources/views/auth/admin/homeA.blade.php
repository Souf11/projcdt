<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Admin Dashboard</h1>

        <div class="row">
            <!-- Professors Summary Card -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Total Professors</h4>
                        <p class="card-text">{{ $professors->count() }}</p>
                        <a href="{{ route('admin.professors.index') }}" class="btn btn-light">Manage Professors</a>
                    </div>
                </div>
            </div>

            <!-- Courses Summary Card -->
            <div class="col-md-4">
                <div class="card text-white bg-success mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Total Courses</h4>
                        <p class="card-text">{{ $courses->count() }}</p>
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-light">Manage Courses</a>
                    </div>
                </div>
            </div>

            <!-- New Professor and Course Cards -->
            <div class="col-md-4">
                <div class="card text-white bg-info mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Add New Professor</h4>
                        <a href="{{ route('admin.professors.create') }}" class="btn btn-light">Add Professor</a>
                    </div>
                </div>
                <div class="card text-white bg-warning mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Add New Course</h4>
                        <a href="{{ route('admin.courses.create') }}" class="btn btn-light">Add Course</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Professors Table -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Professors</h4>
                    </div>
                    <div class="card-body">
                        @if($professors->isEmpty())
                            <p>No recent professors added.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($professors as $professor)
                                        <tr>
                                            <td>{{ $professor->name }}</td>
                                            <td>{{ $professor->email }}</td>
                                            <td>
                                                <a href="{{ route('admin.professors.edit', $professor) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('admin.professors.destroy', $professor) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this professor?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent Courses Table -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Courses</h4>
                    </div>
                    <div class="card-body">
                        @if($courses->isEmpty())
                            <p>No recent courses added.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Group</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($courses as $course)
                                        <tr>
                                            <td>{{ $course->course_name }}</td>
                                            <td>{{ $course->groupe }}</td>
                                            <td>{{ $course->date }}</td>
                                            <td>
                                                <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

</body>
</html>
