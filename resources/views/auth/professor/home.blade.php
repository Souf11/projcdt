<!-- aaaaaaaaaaaaaaaaaaaaaaaaaaa -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professeur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-4xl w-full p-8 bg-white rounded-lg shadow-lg">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">Bienvenue, {{ auth('professor')->user()->name }}!</h2>
                <p class="mt-2 text-sm text-gray-600">Voici votre espace dédié.</p>
            </div>

            <!-- Home Content -->
            <div class="mt-8 space-y-6">
                <div class="bg-indigo-100 p-6 rounded-lg shadow-sm">
                    <h3 class="text-xl font-medium text-gray-800">Informations du Profil</h3>
                    <p class="mt-2 text-gray-600">Nom: {{ auth('professor')->user()->name }}</p>
                    <p class="mt-2 text-gray-600">Email: {{ auth('professor')->user()->email }}</p>
                    <p class="mt-2 text-gray-600">Matière: {{ auth('professor')->user()->subject }}</p>
                </div>

                <!-- Example Action Buttons -->
                <div class="flex justify-between">
                    <a href="#" class="w-1/2 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Modifier le Profil
                    </a>
                    
                    <a href="{{ route('professor.logout') }}" class="w-1/2 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Se Déconnecter
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
