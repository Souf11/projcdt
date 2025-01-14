<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cahier de Texte</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
<nav class="bg-blue-600 text-white py-4 px-6 flex justify-between items-center" style="background-color: #041228;">
    <h1 class="text-lg font-bold">{{ auth('professor')->user()->name }}</h1>
    <div class="flex items-center">
        <!-- "Ajouter un Élément" Button -->
        <a href="{{ route('home') }}" class="mr-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
            Ajouter un élément
        </a>

        @auth('professor')
        <!-- Logout Form -->
        <form action="{{ route('professor.logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded">
                Déconnexion
            </button>
        </form>
        @endauth
    </div>
</nav>

    <!-- Page Content -->
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-4xl w-full p-8 bg-white rounded-lg shadow-lg">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center">Mon Cahier de Texte</h2>

            <div class="mt-6">
                @if($classes->isEmpty())
                    <p class="text-center text-gray-600">Aucune classe disponible pour le moment.</p>
                @else
                    <ul class="space-y-4">
                        @foreach($classes as $class)
                            <li class="bg-gray-100 p-4 rounded-md">
                                <h3 class="text-xl font-bold text-gray-900">{{ $class->course_name }} ({{ $class->groupe }})</h3>
                                <p class="text-sm text-gray-600">{{ $class->date }}</p>
                                <p class="mt-2 text-gray-700">{{ $class->details }}</p>

                                <div class="mt-4 flex justify-between">
                                    <!-- Edit Button -->
                                    <a href="{{ route('professor.editClass', $class->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded" style="background-color: #041228;">
                                        Modifier
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('professor.deleteClass', $class->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
