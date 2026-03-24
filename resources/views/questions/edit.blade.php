<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Question | GeoQuestions</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#FDFDFE] font-sans antialiased text-slate-900 flex flex-col items-center justify-center py-12 px-4">

    <div class="mb-6 w-full max-w-3xl">
        <a href="{{ route('questions.show', $question->id) }}" class="group inline-flex items-center gap-2 text-xs font-bold text-slate-400 transition-all hover:text-indigo-600">
            <div class="flex h-7 w-7 items-center justify-center rounded-full border border-slate-200 bg-white shadow-sm transition-colors group-hover:border-indigo-100 group-hover:bg-indigo-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                </svg>
            </div>
            Discard changes
        </a>
    </div>

    <div class="w-full max-w-3xl bg-white rounded-[2.5rem] shadow-[0_20px_70px_rgba(79,70,229,0.06)] border border-slate-100 overflow-hidden flex flex-col md:flex-row">

        <div class="w-full md:w-5/12 bg-slate-900 p-8 lg:p-10 flex flex-col justify-between text-white relative overflow-hidden">
            <div class="absolute -top-10 -left-10 h-64 w-64 rounded-full bg-indigo-500/10 blur-3xl"></div>
            
            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 rounded-full bg-indigo-500/20 px-3 py-1 text-[9px] font-black uppercase tracking-[0.2em] text-indigo-300 ring-1 ring-inset ring-indigo-500/30">
                    Draft Editor
                </div>
                <h1 class="text-3xl font-[800] tracking-tight mt-6 leading-tight">
                    Refine your <span class="text-indigo-400">Question.</span>
                </h1>
                <p class="text-slate-400 text-xs mt-4 leading-relaxed font-medium">
                    Update your details to help the community provide the best insights possible.
                </p>
            </div>

            <div class="relative z-10 bg-white/5 p-4 rounded-2xl backdrop-blur-md border border-white/10 mt-10">
                <div class="flex items-center gap-3">
                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-indigo-500 text-white shadow-lg shadow-indigo-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-wider text-white">Live Update</p>
                        <p class="text-[10px] text-slate-400 font-medium">Visible instantly after save.</p>
                    </div>
                </div>
            </div>
        </div>

        <main class="w-full md:w-7/12 p-8 lg:p-10">
            <form method="POST" action="{{ route('questions.update', $question->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="flex items-center gap-2 bg-rose-50 border border-rose-100 text-rose-600 text-[10px] font-bold uppercase tracking-widest p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.268 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="group">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 group-focus-within:text-indigo-600 transition-colors">
                        Question Headline
                    </label>
                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $question->title) }}"
                        required
                        class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-xl focus:ring-4 focus:ring-indigo-500/5 focus:border-indigo-500 focus:bg-white outline-none text-sm font-bold text-slate-800 transition-all placeholder:text-slate-300"
                        placeholder="e.g. How to find coordinates?">
                </div>

                <div class="group">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 group-focus-within:text-indigo-600 transition-colors">
                        Description & Details
                    </label>
                    <textarea
                        name="body"
                        rows="6"
                        required
                        class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-xl focus:ring-4 focus:ring-indigo-500/5 focus:border-indigo-500 focus:bg-white outline-none text-sm font-medium leading-relaxed text-slate-600 transition-all resize-none placeholder:text-slate-300"
                        placeholder="Provide more context here..."
                    >{{ old('body', $question->body) }}</textarea>
                </div>

                <div class="pt-4 flex flex-col sm:flex-row gap-3">
                    <button
                        type="submit"
                        class="flex-[1.5] bg-slate-900 hover:bg-indigo-600 text-white font-black py-4 px-6 rounded-xl shadow-lg shadow-indigo-100 transition-all text-[10px] uppercase tracking-[0.2em] active:scale-[0.97]">
                        Update Question
                    </button>

                    <a href="{{ route('questions.show', $question->id) }}" 
                       class="flex-1 px-6 py-4 bg-white text-slate-400 font-bold rounded-xl hover:bg-slate-50 hover:text-slate-600 transition-all text-[10px] text-center border border-slate-100 uppercase tracking-[0.2em]">
                        Cancel
                    </a>
                </div>
            </form>
        </main>
    </div>

</body>
</html>