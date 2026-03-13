<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | GeoQuestions</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-xl font-bold text-blue-600 tracking-tight">
                        Geo<span class="text-gray-800">Questions</span>
                    </a>
                </div>

                <div class="hidden sm:flex sm:items-center sm:space-x-8">
                    <a href="/questions" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition">All Questions</a>
                    
                    @auth
                        <a href="/favorites" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition">My Favorites</a>
                        <a href="/my-questions" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition">My Questions</a>
                        
                        @if(auth()->user()->role == 'admin')
                            <a href="/admin" class="text-sm font-bold text-red-600 hover:text-red-700">Admin Panel</a>
                        @endif
                    @endauth
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <div class="flex items-center gap-4 border-l pl-4 border-gray-100">
                            <div class="text-right hidden md:block">
                                <p class="text-xs font-bold text-gray-800 leading-none">{{ auth()->user()->name }}</p>
                                <p class="text-[10px] text-blue-500 uppercase font-bold mt-1">{{ auth()->user()->role }}</p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-xs bg-gray-100 text-gray-600 px-3 py-2 rounded-lg hover:bg-red-50 hover:text-red-600 transition font-bold uppercase tracking-tighter">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endauth

                    @guest
                        <div class="flex items-center gap-3">
                            <a href="/login" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition">Login</a>
                            <a href="/register" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition">
                                Register
                            </a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
    <main class="max-w-4xl mx-auto mt-10 p-4">
        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8">
            <div class="p-8 text-center">
                @auth
                    <h2 class="text-2xl font-bold text-gray-800">Welcome back, {{ auth()->user()->name }}!</h2>
                    <p class="text-gray-500 mt-2">Ready to answer some new questions today?</p>
                    <div class="mt-6">
                        <a href="/questions/create" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-100">
                            + Ask a Question
                        </a>
                    </div>
                @endauth

                @guest
                    <h2 class="text-2xl font-bold text-gray-800">Welcome to GeoQuestions</h2>
                    <p class="text-gray-500 mt-2">The platform to ask questions based on your current location.</p>
                    <div class="mt-6 flex justify-center gap-3">
                        <a href="/register" class="px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition">Get Started Now</a>
                    </div>
                @endguest
            </div>

            <div class="grid grid-cols-3 border-t border-gray-100 bg-gray-50/50">
                <div class="py-4 text-center border-r border-gray-100">
                    <p class="text-xl font-bold text-gray-800">24</p>
                    <p class="text-[10px] uppercase text-gray-400 font-bold tracking-tighter text-nowrap">Questions</p>
                </div>
                <div class="py-4 text-center border-r border-gray-100">
                    <p class="text-xl font-bold text-gray-800">152</p>
                    <p class="text-[10px] uppercase text-gray-400 font-bold tracking-tighter text-nowrap">Answers</p>
                </div>
                <div class="py-4 text-center">
                    <p class="text-xl font-bold text-gray-800">89</p>
                    <p class="text-[10px] uppercase text-gray-400 font-bold tracking-tighter text-nowrap">Members</p>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center mb-4 px-2">
            <h3 class="font-bold text-gray-700 italic">Recent Questions</h3>
            <a href="/questions" class="text-sm text-blue-600 hover:underline font-semibold">View all</a>
        </div>
        
        <div class="space-y-4">
             <div class="bg-white p-6 rounded-xl border border-gray-200 text-gray-400 text-center italic text-sm">
                No questions found at the moment...
             </div>
        </div>

    </main>

</body>
</html>