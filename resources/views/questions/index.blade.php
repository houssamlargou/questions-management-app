<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions | GeoQuestions</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#FDFDFE] font-sans antialiased text-slate-900">
    <div class="mx-auto max-w-5xl px-4 py-12 sm:px-6 lg:px-8">
        
        <header class="relative mb-12 overflow-hidden rounded-[3rem] bg-slate-900 p-8 shadow-2xl shadow-indigo-100 sm:p-14">
            <div class="absolute -right-20 -top-20 h-96 w-96 rounded-full bg-indigo-500/10 blur-3xl"></div>
            <div class="absolute -left-20 -bottom-20 h-64 w-64 rounded-full bg-blue-500/10 blur-3xl"></div>

            <div class="relative z-10 flex flex-col gap-10 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-xl">
                    <div class="inline-flex items-center gap-2 rounded-full bg-indigo-500/20 px-4 py-1.5 text-[10px] font-black uppercase tracking-[0.2em] text-indigo-300 ring-1 ring-inset ring-indigo-500/30">
                        Knowledge Base
                    </div>
                    <h1 class="mt-6 text-4xl font-[800] tracking-tight text-white sm:text-5xl">
                        Community <span class="text-indigo-400">Feed.</span>
                    </h1>
                    <p class="mt-4 text-lg font-medium text-slate-400 leading-relaxed">
                        Explore the latest inquiries, insights, and geographical discussions from members worldwide.
                    </p>
                </div>

                @auth
                    <div class="shrink-0">
                        <a href="{{ route('questions.create') }}"
                           class="inline-flex items-center justify-center rounded-2xl bg-white px-8 py-4 text-sm font-bold text-slate-900 transition-all hover:bg-indigo-50 hover:scale-105 active:scale-95 shadow-xl shadow-white/5">
                            Ask a Question
                        </a>
                    </div>
                @endauth
            </div>

            <div class="relative z-10 mt-12 max-w-2xl">
                <form method="GET" action="{{ route('questions.search') }}" class="group relative flex items-center">
                    <div class="absolute left-5 text-slate-400 transition-colors group-focus-within:text-indigo-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="q"
                        value="{{ $query ?? '' }}"
                        placeholder="Search for topics, locations, or keywords..."
                        class="w-full rounded-3xl border-none bg-white/10 py-5 pl-14 pr-32 text-white placeholder:text-slate-500 backdrop-blur-md outline-none ring-1 ring-white/20 transition-all focus:bg-white focus:text-slate-900 focus:placeholder:text-slate-400 focus:ring-4 focus:ring-indigo-500/20"
                    >
                    <button
                        type="submit"
                        class="absolute right-2 rounded-2xl bg-indigo-600 px-6 py-3 text-xs font-black uppercase tracking-widest text-white transition-all hover:bg-indigo-500 active:scale-95"
                    >
                        Search
                    </button>
                </form>
            </div>
        </header>

        @if ($questions->isEmpty())
            <div class="rounded-[3rem] border border-slate-100 bg-white/50 p-20 text-center shadow-sm backdrop-blur-sm">
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-[2rem] bg-slate-50 text-slate-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <h2 class="mt-8 text-2xl font-bold text-slate-800">The feed is currently quiet</h2>
                <p class="mt-2 text-slate-500 font-medium">Be the first to spark a conversation in the community.</p>
                @auth
                    <a href="{{ route('questions.create') }}"
                       class="mt-10 inline-flex items-center justify-center rounded-2xl bg-slate-900 px-8 py-4 text-sm font-bold text-white transition-all hover:bg-indigo-600 hover:shadow-xl hover:shadow-indigo-100">
                        Start the Discussion
                    </a>
                @endauth
            </div>
        @else
            <div class="space-y-8">
                @foreach ($questions as $question)
                    <article class="group relative rounded-[2.5rem] border border-transparent bg-white p-2 shadow-[0_15px_40px_rgba(0,0,0,0.02)] transition-all hover:border-indigo-100 hover:shadow-2xl hover:shadow-indigo-500/5">
                        <a href="{{ route('questions.show', $question->id) }}" class="block p-8 sm:p-10">
                            <div class="flex flex-col gap-6 sm:flex-row sm:items-start sm:justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-4">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 text-[10px] font-black text-white">
                                            Q
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] font-black uppercase tracking-widest text-indigo-500">Post #{{ $question->id }}</span>
                                            <span class="text-[11px] font-bold text-slate-400">{{ $question->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    
                                    <h2 class="mt-6 text-2xl font-[800] leading-tight text-slate-900 transition-colors group-hover:text-indigo-600">
                                        {{ $question->title }}
                                    </h2>
                                    
                                    <p class="mt-4 line-clamp-2 text-base leading-relaxed text-slate-500 font-medium">
                                        {{ $question->body }}
                                    </p>
                                </div>
                                
                                <div class="hidden lg:block">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-50 text-slate-300 transition-all group-hover:bg-indigo-50 group-hover:text-indigo-600 group-hover:rotate-45">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-10 flex items-center justify-between border-t border-slate-50 pt-8">
                                <div class="flex items-center gap-6">
                                    <div class="flex items-center gap-2">
                                        <div class="h-2 w-2 animate-pulse rounded-full bg-green-500"></div>
                                        <span class="text-[11px] font-black uppercase tracking-widest text-slate-700">Open Discussion</span>
                                    </div>
                                    
                                    @auth
                                        @php $isFavorited = $question->favorites->contains('user_id', auth()->id()); @endphp
                                        @if ($isFavorited)
                                            <div class="flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1 text-[10px] font-bold text-rose-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                                </svg>
                                                Saved
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                                
                                <span class="text-xs font-black uppercase tracking-widest text-indigo-600 group-hover:translate-x-1 transition-transform">
                                    Read Insight &rarr;
                                </span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>