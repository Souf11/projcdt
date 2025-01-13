<!-- resources/views/admin/professor_dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Professors & Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex justify-center items-center">
        <div class="w-full max-w-4xl p-8 bg-white rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-center mb-6">Professors and Their Courses</h2>
            
            <div class="mb-4">
                <a href="{{ route('admin.logout') }}" class="bg-red-600 text-white py-2 px-4 rounded">Logout</a>
            </div>

            @foreach ($professors as $professor)
                <div class="mb-8">
                    <h3 class="text-xl font-semibold">{{ $professor->name }}</h3>
                    <p class="text-gray-600">{{ $professor->email }}</p>
                    
                    @if($professor->courses->isEmpty())
                        <p class="text-red-500">No courses assigned yet.</p>
                    @else
                        <table class="min-w-full mt-4 table-auto">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 border">Groupe</th>
                                    <th class="px-4 py-2 border">Course Name</th>
                                    <th class="px-4 py-2 border">Details</th>
                                    <th class="px-4 py-2 border">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($professor->courses as $course)
                                    <tr>
                                        <td class="px-4 py-2 border">{{ $course->groupe }}</td>
                                        <td class="px-4 py-2 border">{{ $course->course_name }}</td>
                                        <td class="px-4 py-2 border">{{ $course->details }}</td>
                                        <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($course->date)->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
