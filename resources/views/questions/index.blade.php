<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions | GeoQuestions</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F9FBFC] font-sans antialiased text-slate-900">
    <div class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
        
        <header class="relative mb-10 overflow-hidden rounded-[2.5rem] bg-slate-900 px-8 py-10 shadow-2xl shadow-slate-200">
            <div class="absolute right-0 top-0 -mr-16 -mt-16 h-64 w-64 rounded-full bg-blue-500/10 blur-3xl"></div>
            <div class="relative z-10 flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-lg bg-blue-500/10 px-3 py-1 text-[10px] font-bold uppercase tracking-widest text-blue-400 ring-1 ring-inset ring-blue-500/20">
                        Community
                    </div>
                    <h1 class="mt-3 text-4xl font-extrabold tracking-tight text-white">
                        Questions Feed
                    </h1>
                    <p class="mt-2 text-slate-400">
                        Discover insights and share knowledge with the community.
                    </p>
                </div>
                @auth
                    <a href="{{ route('questions.create') }}"
                       class="inline-flex items-center justify-center rounded-2xl bg-white px-6 py-3.5 text-sm font-bold text-slate-900 transition-all hover:bg-blue-50 hover:scale-105 active:scale-95">
                        Ask a Question
                    </a>
                @endauth
            </div>
        </header>

        @if ($questions->isEmpty())
            <div class="rounded-[2rem] border-2 border-dashed border-slate-200 bg-white px-6 py-16 text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-slate-50 text-slate-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <h2 class="mt-4 text-xl font-bold text-slate-800">Silence is golden, but questions are better</h2>
                <p class="mt-2 text-slate-500">No one has posted yet. Why not break the ice?</p>
                @auth
                    <a href="{{ route('questions.create') }}"
                       class="mt-8 inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-bold text-white transition hover:bg-blue-700 shadow-lg shadow-blue-100">
                        Start the Conversation
                    </a>
                @endauth
            </div>
        @else
            <div class="grid gap-6">
                @foreach ($questions as $question)
                    <article class="group relative rounded-[2rem] border border-slate-200 bg-white p-1 transition-all hover:border-blue-300 hover:shadow-xl hover:shadow-blue-500/5">
                        <a href="{{ route('questions.show', $question->id) }}" class="block p-7">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3">
                                        <span class="text-[10px] font-bold uppercase tracking-widest text-blue-600">
                                            #{{ $question->id }}
                                        </span>
                                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                                        <span class="flex items-center gap-1 text-xs font-medium text-slate-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $question->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    
                                    <h2 class="mt-3 text-2xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors leading-tight">
                                        {{ $question->title }}
                                    </h2>
                                    
                                    <p class="mt-3 line-clamp-2 text-[15px] leading-relaxed text-slate-500">
                                        {{ $question->body }}
                                    </p>
                                </div>
                                
                                <div class="hidden sm:block">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-50 text-slate-300 transition-all group-hover:bg-blue-600 group-hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 flex items-center justify-between border-t border-slate-50 pt-6">
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-1.5">
                                        <div class="h-2 w-2 rounded-full bg-green-500"></div>
                                        <span class="text-xs font-bold text-slate-700">Active</span>
                                    </div>
                                    
                                    @auth
                                        @php $isFavorited = $question->favorites->contains('user_id', auth()->id()); @endphp
                                        @if ($isFavorited)
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1 text-[10px] font-bold text-red-600 ring-1 ring-inset ring-red-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                                </svg>
                                                Saved
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-[10px] font-bold text-slate-500">
                                                Community Post
                                            </span>
                                        @endif
                                    @endauth
                                </div>
                                
                                <span class="text-xs font-bold text-blue-600 group-hover:underline">
                                    View Discussion &rarr;
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