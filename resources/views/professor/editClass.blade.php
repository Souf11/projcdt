<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Cours</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar (same as in cahier.blade.php) -->
    <nav class="bg-blue-600 text-white py-4 px-6 flex justify-between items-center" style="background-color: #041228;">
        <h1 class="text-lg font-bold">{{ auth('professor')->user()->name }}</h1>
        <div class="flex items-center">
            <a href="{{ route('home') }}" class="mr-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Ajouter un élément
            </a>
            @auth('professor')
            <form action="{{ route('professor.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded">
                    Déconnexion
                </button>
            </form>
            @endauth
        </div>
    </nav>

    <!-- Edit Class Form -->
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-4xl w-full p-8 bg-white rounded-lg shadow-lg">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center">Modifier le Cours</h2>

            <form action="{{ route('professor.updateClass', $class->id) }}" method="POST" class="mt-8">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="course_name" class="block text-sm font-semibold text-gray-700">Nom du Cours</label>
                    <input type="text" name="course_name" id="course_name" value="{{ old('course_name', $class->course_name) }}" class="mt-2 w-full p-3 border border-gray-300 rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label for="date" class="block text-sm font-semibold text-gray-700">Date</label>
                    <input type="date" name="date" id="date" value="{{ old('date', $class->date) }}" class="mt-2 w-full p-3 border border-gray-300 rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label for="groupe" class="block text-sm font-semibold text-gray-700">Groupe</label>
                    <input type="text" name="groupe" id="groupe" value="{{ old('groupe', $class->groupe) }}" class="mt-2 w-full p-3 border border-gray-300 rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label for="details" class="block text-sm font-semibold text-gray-700">Détails</label>
                    <textarea name="details" id="details" rows="4" class="mt-2 w-full p-3 border border-gray-300 rounded-lg" required>{{ old('details', $class->details) }}</textarea>
                </div>

                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg" style="background-color: #041228;">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
