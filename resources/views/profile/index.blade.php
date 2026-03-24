<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | GeoQuestions</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#FDFDFE] font-sans antialiased text-slate-900">
    <div class="mx-auto max-w-6xl px-4 py-12 sm:px-6 lg:px-8">

        <div class="mb-10">
            <a href="/" class="group inline-flex items-center gap-2.5 text-sm font-bold text-slate-400 transition-all hover:text-indigo-600">
                <div class="flex h-8 w-8 items-center justify-center rounded-full border border-slate-200 bg-white shadow-sm transition-colors group-hover:border-indigo-100 group-hover:bg-indigo-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                </div>
                Back to Explore
            </a>
        </div>

        <div class="grid gap-10 lg:grid-cols-[1.4fr_0.6fr]">
            
            <main class="space-y-10">
                <section class="relative overflow-hidden rounded-[3rem] border border-slate-200/60 bg-white p-8 shadow-[0_20px_50px_rgba(0,0,0,0.02)] sm:p-12">
                    <div class="absolute -right-16 -top-16 h-80 w-80 rounded-full bg-indigo-50/50 blur-3xl"></div>
                    <div class="absolute -left-16 -bottom-16 h-64 w-64 rounded-full bg-blue-50/30 blur-3xl"></div>
                    
                    <div class="relative z-10">
                        <div class="flex flex-col gap-8 sm:flex-row sm:items-end">
                            <div class="relative inline-block shrink-0">
                                <div class="absolute inset-0 animate-pulse rounded-[2.2rem] bg-indigo-200 blur-md"></div>
                                <div class="relative flex h-28 w-28 items-center justify-center rounded-[2.2rem] bg-slate-900 text-4xl font-extrabold text-white shadow-2xl">
                                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                </div>
                                <div class="absolute -bottom-2 -right-2 flex h-9 w-9 items-center justify-center rounded-2xl bg-white p-1.5 shadow-lg border border-slate-100">
                                    <div class="h-full w-full rounded-xl bg-green-500"></div>
                                </div>
                            </div>
                            
                            <div class="flex-1">
                                <div class="flex items-center gap-3">
                                    <h1 class="text-4xl font-[800] tracking-tight text-slate-900">{{ explode(' ', $user->name)[0] }}'s Space</h1>
                                    <span class="rounded-full bg-indigo-50 px-3 py-1 text-[10px] font-bold uppercase tracking-widest text-indigo-600">Member</span>
                                </div>
                                <p class="mt-3 max-w-md text-[16px] leading-relaxed text-slate-500 font-medium">
                                    Contributing to the community through curious questions and curated favorites.
                                </p>
                            </div>
                        </div>

                        <div class="mt-12 grid grid-cols-3 gap-8 border-t border-slate-50 pt-10">
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Questions</p>
                                <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ $user->questions_count }}</p>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Collection</p>
                                <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ $user->favorites_count }}</p>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Trust Score</p>
                                <p class="mt-2 text-3xl font-extrabold text-indigo-600">High</p>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="grid gap-10 lg:grid-cols-2">
                    
                    <section>
                        <div class="flex items-center justify-between mb-6 px-2">
                            <h2 class="text-xl font-bold text-slate-900">Your Posts</h2>
                            <div class="h-px flex-1 mx-4 bg-slate-100"></div>
                            <span class="text-xs font-bold text-slate-400">{{ $user->questions->count() }} total</span>
                        </div>

                        <div class="space-y-4">
                            @forelse ($user->questions as $question)
                                <a href="{{ route('questions.show', $question->id) }}" class="group block rounded-3xl border border-transparent bg-white p-6 shadow-sm transition-all hover:border-slate-200 hover:shadow-xl hover:shadow-slate-200/40">
                                    <div class="flex justify-between items-start gap-4">
                                        <h3 class="text-[15px] font-bold leading-snug text-slate-800 group-hover:text-indigo-600 transition-colors">{{ $question->title }}</h3>
                                        <div class="rounded-full bg-slate-50 p-1 group-hover:bg-indigo-50 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 group-hover:text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="mt-4 flex items-center gap-3">
                                        <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-300">{{ $question->created_at->format('M d, Y') }}</span>
                                    </div>
                                </a>
                            @empty
                                <div class="rounded-[2rem] border-2 border-dashed border-slate-100 p-10 text-center">
                                    <p class="text-sm font-medium text-slate-400 italic">No questions published yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </section>

                    <section>
                        <div class="flex items-center justify-between mb-6 px-2">
                            <h2 class="text-xl font-bold text-slate-900">Curated</h2>
                            <div class="h-px flex-1 mx-4 bg-slate-100"></div>
                            <span class="text-xs font-bold text-slate-400">{{ $user->favorites->count() }} saved</span>
                        </div>

                        <div class="space-y-4">
                            @forelse ($user->favorites as $favorite)
                                @if ($favorite->question)
                                    <a href="{{ route('questions.show', $favorite->question->id) }}" class="group block rounded-3xl bg-slate-900 p-6 shadow-lg transition-all hover:translate-y-[-4px] hover:shadow-indigo-200">
                                        <h3 class="text-[15px] font-bold leading-snug text-white group-hover:text-indigo-300 transition-colors">{{ $favorite->question->title }}</h3>
                                        <div class="mt-4 flex items-center justify-between">
                                            <div class="flex items-center gap-2">
                                                <div class="h-5 w-5 rounded-lg bg-indigo-500/20 text-[9px] flex items-center justify-center font-bold text-indigo-300">
                                                    {{ strtoupper(substr($favorite->question->user->name ?? 'U', 0, 1)) }}
                                                </div>
                                                <span class="text-[11px] font-medium text-slate-400">{{ $favorite->question->user->name ?? 'Community' }}</span>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-rose-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </a>
                                @endif
                            @empty
                                <div class="rounded-[2rem] border-2 border-dashed border-slate-100 p-10 text-center">
                                    <p class="text-sm font-medium text-slate-400 italic">Collection is currently empty.</p>
                                </div>
                            @endforelse
                        </div>
                    </section>
                </div>
            </main>

            <aside class="space-y-8">
                <div class="rounded-[2.5rem] border border-slate-200/60 bg-white/80 p-8 shadow-sm backdrop-blur-md">
                    <h2 class="text-xs font-black uppercase tracking-[0.25em] text-slate-400 mb-8">Account Details</h2>
                    <div class="space-y-6">
                        <div class="group">
                            <p class="text-[10px] font-bold text-indigo-500 uppercase tracking-widest mb-1">Full Name</p>
                            <p class="text-[15px] font-bold text-slate-800">{{ $user->name }}</p>
                        </div>
                        <div class="group">
                            <p class="text-[10px] font-bold text-indigo-500 uppercase tracking-widest mb-1">Email</p>
                            <p class="text-[15px] font-bold text-slate-800">{{ $user->email }}</p>
                        </div>
                        <div class="group">
                            <p class="text-[10px] font-bold text-indigo-500 uppercase tracking-widest mb-1">Joined Community</p>
                            <p class="text-[15px] font-bold text-slate-800">{{ $user->created_at->format('M Y') }}</p>
                        </div>
                        
                        <button class="mt-4 w-full rounded-2xl bg-slate-900 py-4 text-xs font-bold text-white transition-all hover:bg-indigo-600 hover:shadow-lg hover:shadow-indigo-200 active:scale-[0.98]">
                            Edit Settings
                        </button>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-[2.5rem] bg-indigo-600 p-8 text-white shadow-xl shadow-indigo-100">
                    <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-white/10 blur-xl"></div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-indigo-200">Coming Soon</p>
                    <h3 class="mt-4 text-xl font-extrabold leading-tight">Achievement Badges</h3>
                    <p class="mt-3 text-sm font-medium leading-relaxed text-indigo-100/80">
                        We're building a new way to showcase your expertise. Stay active to unlock early access.
                    </p>
                    <div class="mt-8 flex items-center gap-2">
                        <div class="h-1 flex-1 rounded-full bg-white/20">
                            <div class="h-1 w-1/3 rounded-full bg-white"></div>
                        </div>
                        <span class="text-[10px] font-bold">33%</span>
                    </div>
                </div>
            </aside>
            
        </div>
    </div>
</body>
</html>