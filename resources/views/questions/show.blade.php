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
               class="group inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition-all hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to questions
            </a>
        </div>
 
        <div class="grid items-start gap-8 md:grid-cols-[1fr_320px]">
 
            <main class="space-y-6">
                <article class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm transition-shadow hover:shadow-md">
                    
                    <div class="relative overflow-hidden bg-slate-900 px-6 py-10 sm:px-10 sm:py-12">
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(59,130,246,0.2),transparent_50%)]"></div>
                        <div class="absolute -bottom-24 -left-24 h-48 w-48 rounded-full bg-blue-500/10 blur-3xl"></div>

                        <div class="relative z-10">
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="inline-flex items-center rounded-lg bg-blue-500/10 px-2.5 py-1 text-[10px] font-bold uppercase tracking-widest text-blue-400 ring-1 ring-inset ring-blue-500/20">
                                    Question #{{ $question->id }}
                                </span>
                                <span class="text-xs font-medium text-slate-400">
                                    • {{ $question->created_at->diffForHumans() }}
                                </span>
                            </div>
     
                            <h1 class="mt-6 text-3xl font-extrabold tracking-tight text-white sm:text-4xl md:leading-[1.15]">
                                {{ $question->title }}
                            </h1>
                        </div>
                    </div>
     
                    <div class="px-6 py-8 sm:px-10">
                        <div class="prose prose-slate max-w-none">
                            <div class="whitespace-pre-line text-[16px] leading-relaxed text-slate-600">
                                {{ $question->body }}
                            </div>
                        </div>

                        @auth
                        <div class="mt-10 flex items-center justify-between border-t border-slate-100 pt-8">
                            @php $isFavorited = $question->favorites->contains('user_id', auth()->id()); @endphp

                            @if ($isFavorited)
                                <form method="POST" action="{{ route('favorites.destroy', $question->id) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-red-50 px-5 py-2.5 text-sm font-bold text-red-600 transition hover:bg-red-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                        </svg>
                                        Saved to Favorites
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('favorites.store', $question->id) }}">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-blue-600 shadow-lg shadow-slate-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                        Add to Favorites
                                    </button>
                                </form>
                            @endif
                        </div>
                        @endauth 
                    </div>
                </article>

                <section class="space-y-4">
                    <div class="flex items-center justify-between px-2">
                        <h2 class="text-xl font-bold text-slate-900">Answers</h2>
                        <span class="rounded-full bg-slate-200 px-3 py-1 text-xs font-bold text-slate-600">
                            {{ $question->answers->count() }}
                        </span>
                    </div>

                    @if ($question->answers->isEmpty())
                        <div class="rounded-3xl border-2 border-dashed border-slate-200 bg-white p-10 text-center">
                            <p class="text-sm font-medium text-slate-500">No answers yet. Be the first to share your knowledge!</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($question->answers as $answer)
                                <div class="rounded-3xl border border-slate-200 bg-white p-6 transition-all hover:border-blue-200">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 text-sm font-bold text-white shadow-sm">
                                            {{ strtoupper(substr($answer->user?->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-900">{{ $answer->user?->name ?? 'Unknown user' }}</p>
                                            <p class="text-xs font-medium text-slate-400">{{ $answer->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-4 text-[15px] leading-relaxed text-slate-600">
                                        {{ $answer->body }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>

                <section class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900">Share your expertise</h2>
                    
                    @auth
                        <form method="POST" action="{{ route('answers.store', $question->id) }}" class="mt-6">
                            @csrf
                            @if ($errors->any())
                                <div class="mb-4 rounded-xl bg-red-50 p-4 text-sm font-medium text-red-600 ring-1 ring-red-200">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <textarea
                                id="body"
                                name="body"
                                rows="4"
                                required
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"
                                placeholder="Type your answer here..."
                            >{{ old('body') }}</textarea>

                            <button type="submit" class="mt-4 w-full rounded-xl bg-slate-900 py-3 text-sm font-bold text-white transition hover:bg-blue-600 sm:w-auto sm:px-8">
                                Post Answer
                            </button>
                        </form>
                    @else
                        <div class="mt-6 rounded-2xl bg-slate-50 p-6 text-center border border-slate-100">
                            <p class="text-sm font-medium text-slate-600">Please <a href="#" class="text-blue-600 underline">log in</a> to participate in the discussion.</p>
                        </div>
                    @endauth
                </section>
            </main>
 
            <aside class="space-y-6 md:sticky md:top-8">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Asked By</h3>
                    <div class="mt-4 flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-lg font-bold text-slate-700 ring-1 ring-slate-200">
                            {{ strtoupper(substr($question->user?->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900">{{ $question->user?->name ?? 'Unknown' }}</p>
                            <p class="text-xs font-medium text-slate-500">{{ $question->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
 
                <div class="group relative overflow-hidden rounded-[2rem] bg-slate-900 p-8 text-white">
                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-blue-500/20 blur-2xl transition-all group-hover:bg-blue-500/30"></div>
                    
                    <h3 class="relative z-10 text-xl font-bold">Have a similar doubt?</h3>
                    <p class="relative z-10 mt-3 text-sm leading-relaxed text-slate-400">
                        Join our community of experts and get your questions answered in minutes.
                    </p>
 
                    <div class="relative z-10 mt-8 flex flex-col gap-3">
                        <a href="{{ route('questions.index') }}"
                           class="flex items-center justify-center rounded-xl bg-white px-4 py-3 text-xs font-bold text-slate-900 transition hover:bg-slate-100">
                            Browse All
                        </a>
                        @auth
                            <a href="{{ route('questions.create') }}"
                               class="flex items-center justify-center rounded-xl border border-white/20 bg-white/5 px-4 py-3 text-xs font-bold transition hover:bg-white/10">
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