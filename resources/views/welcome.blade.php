<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center p-6">

    <div class="w-full max-w-2xl bg-white shadow-lg rounded-2xl border border-gray-200 overflow-hidden">
        <div class="bg-blue-600 px-6 py-4">
            <h1 class="text-2xl font-bold text-white">Questions Management App</h1>
        </div>

        <div class="p-6 space-y-6">
            @auth
                <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                    <h2 class="text-lg font-bold text-green-700">Connexion réussie</h2>
                    <p class="text-sm text-gray-700 mt-2">
                        Bienvenue,
                        <span class="font-semibold">{{ auth()->user()->name }}</span>
                    </p>
                    <p class="text-sm text-gray-500">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            @endauth

            @guest
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                    <h2 class="text-lg font-bold text-yellow-700">Vous n'êtes pas connecté</h2>
                    <p class="text-sm text-gray-700 mt-2">
                        Connectez-vous ou créez un compte pour continuer.
                    </p>

                    <div class="mt-4 flex gap-3">
                        <a href="/login" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                            Login
                        </a>
                        <a href="/register" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg text-sm font-semibold">
                            Register
                        </a>
                    </div>
                </div>
            @endguest

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-gray-50 rounded-xl border p-4">
                    <p class="text-sm text-gray-500">Questions</p>
                    <h3 class="text-2xl font-bold text-gray-800">0</h3>
                </div>

                <div class="bg-gray-50 rounded-xl border p-4">
                    <p class="text-sm text-gray-500">Answers</p>
                    <h3 class="text-2xl font-bold text-gray-800">0</h3>
                </div>

                <div class="bg-gray-50 rounded-xl border p-4">
                    <p class="text-sm text-gray-500">Users</p>
                    <h3 class="text-2xl font-bold text-gray-800">1+</h3>
                </div>
            </div>
        </div>
    </div>

</body>
</html>