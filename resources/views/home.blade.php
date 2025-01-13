<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professeur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <!-- Navbar -->
<nav class="bg-blue-600 text-white py-4 px-6 flex justify-between items-center" style="background-color: #041228;">
    <h1 class="text-lg font-bold">{{ auth('professor')->user()->name }}</h1>
    <div class="flex items-center space-x-4">
        @auth('professor')
        <!-- Cahier de Texte Button -->
        <a href="{{ route('professor.cahierDeTexte') }}" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white">
            Voir mon Cahier de Texte
        </a>

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
            <div class="text-center">
                <!-- Check if the professor is authenticated -->
                @auth('professor')
                <h2 class="text-3xl font-extrabold text-gray-900">
                    Bienvenue, {{ auth('professor')->user()->name }}!
                </h2>
                <p class="mt-2 text-sm text-gray-600">Ajoutez les informations de votre classe ci-dessous.</p>
                @else
                <h2 class="text-3xl font-extrabold text-gray-900">
                    Bienvenue, Professeur!
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Veuillez vous connecter pour accéder à vos informations.
                </p>
                @endauth
            </div>

            @auth('professor')
            <!-- Class Information Form -->
            <div class="mt-8 space-y-6">
                <form id="add-class-form" action="{{ route('professor.addClass') }}" method="POST" class="space-y-4">
                    @csrf
                    <!-- Date -->
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Date du cours</label>
                        <input type="date" id="date" name="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <!-- Groupe -->
                    <div>
                        <label for="groupe" class="block text-sm font-medium text-gray-700">Groupe</label>
                        <input type="text" id="groupe" name="groupe" placeholder="Exemple: Groupe A" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <!-- Nom du cours -->
                    <div>
                        <label for="course_name" class="block text-sm font-medium text-gray-700">Nom du cours</label>
                        <input type="text" id="course_name" name="course_name" placeholder="Exemple: Mathématiques" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <!-- Lesson Details -->
                    <div>
                        <label for="details" class="block text-sm font-medium text-gray-700">Détails du cours</label>
                        <textarea id="details" name="details" rows="4" placeholder="Entrez les détails de la leçon ici..." class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="button" id="add-class-button" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" style="background-color: #041228;">
                            Ajouter les informations du cours
                        </button>
                    </div>
                </form>
            </div>
            @endauth
        </div>
    </div>

    <script>
        // Wait for the DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function () {
            // Get the button by its ID
            const addButton = document.getElementById('add-class-button');

            // Add event listener for the click event
            addButton.addEventListener('click', function () {
                // Show the alert with the custom message
                alert('Ajouté dans le Cahier de Texte');

                // Submit the form after the alert
                document.getElementById('add-class-form').submit();
            });
        });
    </script>
</body>

</html>
