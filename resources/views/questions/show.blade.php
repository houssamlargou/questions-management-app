<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $question->title }} | GeoQuestions</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F8FAFC] font-sans antialiased text-slate-900">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
 
        <div class="mb-8">
            <a href="{{ route('questions.index') }}"
               class="group inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition-all hover:text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to community
            </a>
        </div>
 
        <div class="grid items-start gap-8 md:grid-cols-[1fr_320px]">
            <main class="space-y-6">
                <article class="overflow-hidden rounded-[2.5rem] border border-slate-200 bg-white shadow-sm transition-shadow hover:shadow-md">
                    
                    <div class="relative overflow-hidden bg-slate-900 px-6 py-10 sm:px-10 sm:py-14">
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(99,102,241,0.15),transparent_50%)]"></div>
                        <div class="absolute -bottom-24 -left-24 h-48 w-48 rounded-full bg-indigo-500/10 blur-3xl"></div>

                        <div class="relative z-10">
                            <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                                <div class="flex flex-wrap items-center gap-3">
                                    <span class="inline-flex items-center rounded-lg bg-indigo-500/20 px-3 py-1 text-[10px] font-black uppercase tracking-[0.2em] text-indigo-300 ring-1 ring-inset ring-indigo-500/30">
                                        Post #{{ $question->id }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-400">
                                        &bull; {{ $question->created_at->diffForHumans() }}
                                    </span>
                                </div>

                                @auth
                                @if (auth()->id() === $question->user_id)
                                    <div class="flex flex-wrap items-center gap-3">
            
                                        <a href="{{ route('questions.edit', $question->id) }}"
                                        class="group inline-flex items-center gap-2 rounded-xl bg-white/5 px-4 py-2 text-[10px] font-black uppercase tracking-[0.2em] text-white backdrop-blur-md ring-1 ring-white/10 transition-all hover:bg-white hover:text-slate-900 hover:ring-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 transition-transform group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Manage Topic
                                        </a>

                                        <form method="POST" action="{{ route('questions.destroy', $question->id) }}"
                                            onsubmit="return confirm('Are you sure you want to permanently delete this topic?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="group inline-flex items-center gap-2 rounded-xl bg-rose-500/10 px-4 py-2 text-[10px] font-black uppercase tracking-[0.2em] text-rose-400 backdrop-blur-md ring-1 ring-rose-500/20 transition-all hover:bg-rose-600 hover:text-white hover:ring-rose-600 active:scale-95">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 opacity-70 transition-opacity group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete Topic
                                            </button>
                                        </form>

                                    </div>
                                @endif
                            @endauth
                            </div>
     
                            <h1 class="mt-8 text-3xl font-[800] tracking-tight text-white sm:text-5xl md:leading-[1.1]">
                                {{ $question->title }}
                            </h1>
                        </div>
                    </div>
     
                    <div class="px-6 py-10 sm:px-12">
                        <div class="prose prose-slate max-w-none">
                            <div class="whitespace-pre-line text-[17px] leading-[1.8] text-slate-600 font-medium">
                                {{ $question->body }}
                            </div>
                        </div>

                        @auth
                        <div class="mt-12 flex items-center justify-between border-t border-slate-50 pt-10">
                            @php $isFavorited = $question->favorites->contains('user_id', auth()->id()); @endphp

                            @if ($isFavorited)
                                <form method="POST" action="{{ route('favorites.destroy', $question->id) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-2.5 rounded-2xl bg-rose-50 px-6 py-3 text-xs font-black uppercase tracking-widest text-rose-600 transition-all hover:bg-rose-100 active:scale-95">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                        </svg>
                                        In your library
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('favorites.store', $question->id) }}">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-2.5 rounded-2xl bg-slate-900 px-6 py-3 text-xs font-black uppercase tracking-widest text-white transition-all hover:bg-indigo-600 hover:shadow-xl hover:shadow-indigo-500/20 active:scale-95">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                        Save Topic
                                    </button>
                                </form>
                            @endif

                            <div class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400">
                                <span class="h-1.5 w-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                Live Discussion
                            </div>
                        </div>
                        @endauth 
                    </div>
                </article>

                <section class="space-y-6 pt-6">
                    <div class="flex items-center justify-between px-4">
                        <h2 class="text-2xl font-[800] text-slate-900 tracking-tight">Community <span class="text-indigo-600">Insights</span></h2>
                        <span class="rounded-xl bg-slate-100 px-3 py-1.5 text-xs font-black text-slate-500 ring-1 ring-slate-200">
                            {{ $question->answers->count() }} Total
                        </span>
                    </div>

                    @if ($question->answers->isEmpty())
                        <div class="rounded-[2.5rem] border-2 border-dashed border-slate-100 bg-white/50 p-16 text-center">
                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-50 text-slate-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <p class="mt-6 text-sm font-bold text-slate-400 uppercase tracking-widest">No answers yet</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($question->answers as $answer)
                                <div class="rounded-[2rem] border border-slate-100 bg-white p-8 transition-all hover:shadow-lg hover:shadow-indigo-500/5">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-4">
                                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-900 text-xs font-black text-white">
                                                {{ strtoupper(substr($answer->user?->name ?? 'U', 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-black text-slate-900 tracking-tight">{{ $answer->user?->name ?? 'Unknown user' }}</p>
                                                <p class="text-[10px] font-bold uppercase tracking-widest text-indigo-500">{{ $answer->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-6 text-[16px] leading-relaxed text-slate-600 font-medium">
                                        {{ $answer->body }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>

                <section class="rounded-[2.5rem] border border-slate-200 bg-white p-10 shadow-sm overflow-hidden relative">
                    <div class="absolute top-0 right-0 p-8 opacity-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </div>

                    <h2 class="text-xl font-[800] text-slate-900 tracking-tight">Share your <span class="text-indigo-600">Expertise</span></h2>
                    
                    @auth
                        <form method="POST" action="{{ route('answers.store', $question->id) }}" class="mt-8 relative z-10">
                            @csrf
                            @if ($errors->any())
                                <div class="mb-6 rounded-2xl bg-rose-50 border border-rose-100 p-4 text-[11px] font-black uppercase tracking-widest text-rose-600">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <textarea
                                id="body"
                                name="body"
                                rows="5"
                                required
                                class="w-full rounded-[1.5rem] border border-slate-100 bg-slate-50 p-6 text-sm font-medium outline-none transition-all focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 placeholder:text-slate-300"
                                placeholder="Type your insightful response here..."
                            >{{ old('body') }}</textarea>

                            <button type="submit" class="mt-6 inline-flex items-center justify-center rounded-2xl bg-slate-900 px-10 py-4 text-xs font-black uppercase tracking-widest text-white transition-all hover:bg-indigo-600 hover:shadow-xl hover:shadow-indigo-500/20 active:scale-95">
                                Post Insight
                            </button>
                        </form>
                    @else
                        <div class="mt-8 rounded-3xl bg-slate-50 p-8 text-center border border-slate-100">
                            <p class="text-sm font-bold text-slate-500 uppercase tracking-widest">
                                Please <a href="#" class="text-indigo-600 underline decoration-2 underline-offset-4">log in</a> to contribute.
                            </p>
                        </div>
                    @endauth
                </section>
            </main>
 
            <aside class="space-y-6 md:sticky md:top-8">
                <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Curated By</h3>
                    <div class="mt-6 flex items-center gap-4">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-900 text-lg font-black text-white shadow-lg shadow-slate-200">
                            {{ strtoupper(substr($question->user?->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-black text-slate-900 tracking-tight">{{ $question->user?->name ?? 'Unknown' }}</p>
                            <p class="text-[11px] font-bold text-slate-400">{{ $question->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
 
                <div class="group relative overflow-hidden rounded-[2.5rem] bg-slate-900 p-10 text-white">
                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-indigo-500/20 blur-2xl transition-all group-hover:bg-indigo-500/40"></div>
                    
                    <h3 class="relative z-10 text-2xl font-[800] tracking-tight leading-none">Geo<br><span class="text-indigo-400">Hub.</span></h3>
                    <p class="relative z-10 mt-6 text-xs leading-relaxed text-slate-400 font-medium">
                        Explore more insights or spark a new discussion with the global community.
                    </p>
 
                    <div class="relative z-10 mt-10 flex flex-col gap-3">
                        <a href="{{ route('questions.index') }}"
                           class="flex items-center justify-center rounded-2xl bg-white py-4 text-[10px] font-black uppercase tracking-widest text-slate-900 transition-all hover:bg-indigo-50 active:scale-95">
                            Browse All
                        </a>
                        @auth
                            <a href="{{ route('questions.create') }}"
                               class="flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 py-4 text-[10px] font-black uppercase tracking-widest transition-all hover:bg-white/10 active:scale-95">
                                Ask Question
                            </a>
                        @endauth
                    </div>
                </div>
            </aside>
        </div>
    </div>
</body>
</html>