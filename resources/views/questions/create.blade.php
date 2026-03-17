<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Question</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-3xl bg-white rounded-[2rem] shadow-2xl border border-gray-100 overflow-hidden flex flex-col md:flex-row">
        
        <div class="w-full md:w-5/12 bg-blue-600 p-8 flex flex-col justify-between text-white relative overflow-hidden">
            <div class="absolute -top-10 -left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            
            <div class="relative z-10">
                <span class="text-[10px] uppercase font-black tracking-[0.2em] text-blue-200">New Topic</span>
                <h1 class="text-3xl font-black tracking-tight mt-3 leading-tight">Post Your Question</h1>
                <p class="text-blue-100 text-xs mt-4 leading-relaxed font-medium opacity-80">
                    Reach out to the community. Fill in the details and get the answers you need.
                </p>
            </div>

            <div class="relative z-10 bg-white/10 p-4 rounded-2xl backdrop-blur-sm border border-white/10 mt-8">
                <div class="flex items-center gap-3">
                    <span class="text-2xl">💡</span>
                    <p class="text-[10px] font-bold uppercase tracking-wider">Sharing is caring</p>
                </div>
            </div>
        </div>

        <form method="POST" action="/questions" class="w-full md:w-7/12 p-8 space-y-5">
            @csrf

            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-600 text-[11px] font-bold uppercase p-3 rounded-r-lg shadow-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="group">
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition">Title</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-blue-500 focus:bg-white outline-none text-sm transition duration-300 shadow-inner"
                    placeholder="Enter your question title">
            </div>

            <div class="group">
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1 group-focus-within:text-blue-600 transition">Question Body</label>
                <textarea
                    name="body"
                    rows="5"
                    required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-blue-500 focus:bg-white outline-none text-sm transition duration-300 shadow-inner resize-none"
                    placeholder="Describe your question here...">{{ old('body') }}</textarea>
            </div>

            <div class="pt-2 flex flex-col sm:flex-row gap-3">
                <button
                    type="submit"
                    class="flex-1 bg-blue-600 hover:bg-gray-900 text-white font-black py-3.5 px-6 rounded-xl shadow-lg shadow-blue-100 transition duration-300 text-xs uppercase tracking-widest">
                    Submit Question
                </button>
                
                <a href="/questions" class="px-6 py-3.5 bg-gray-100 text-gray-500 font-bold rounded-xl hover:bg-gray-200 transition text-[11px] text-center border border-gray-200 uppercase tracking-widest">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</body>
</html>