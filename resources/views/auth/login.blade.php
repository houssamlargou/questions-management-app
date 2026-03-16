<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Project</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-sm bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">

        <div class="bg-blue-600 py-4 text-center">
            <h1 class="text-xl font-bold text-white uppercase tracking-tight">Connexion</h1>
        </div>

        <form method="POST" action="/login" class="p-6 space-y-4">
            @csrf

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 text-sm rounded p-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 outline-none text-sm transition"
                    placeholder="email@exemple.com"
                >
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Mot de passe</label>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 outline-none text-sm transition"
                    placeholder="••••••••"
                >
            </div>

            <div class="pt-2">
                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded shadow-sm transition duration-200 text-sm"
                >
                    Se connecter
                </button>
            </div>

            <p class="text-center text-xs text-gray-500 mt-2">
                Pas encore inscrit ?
                <a href="/register" class="text-blue-600 font-bold hover:underline">Créer un compte</a>
            </p>
        </form>
    </div>

</body>
</html>