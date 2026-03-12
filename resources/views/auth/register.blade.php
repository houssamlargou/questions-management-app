<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Project</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-sm bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        
        <div class="bg-blue-600 py-4 text-center">
            <h1 class="text-xl font-bold text-white uppercase tracking-tight">Inscription</h1>
        </div>

        <form method="POST" action="/register" class="p-6 space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Nom complet</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 outline-none text-sm transition"
                    placeholder="Votre nom">
                @error('name') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 outline-none text-sm transition"
                    placeholder="email@exemple.com">
                @error('email') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Mot de passe</label>
                <input type="password" name="password" required
                    class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 outline-none text-sm transition"
                    placeholder="••••••••">
                @error('password') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Confirmation</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 outline-none text-sm transition"
                    placeholder="••••••••">
            </div>

            <div class="pt-2">
                <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded shadow-sm transition duration-200 text-sm">
                    S'inscrire
                </button>
            </div>

            <p class="text-center text-xs text-gray-500 mt-2">
                Déjà inscrit ? 
                <a href="/login" class="text-blue-600 font-bold hover:underline">Connexion</a>
            </p>
        </form>
    </div>

</body>
</html>