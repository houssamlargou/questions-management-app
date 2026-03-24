<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | GeoQuestions</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F8FAFC] font-sans antialiased text-slate-900">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">

        <div class="mb-8">
            <a href="/" class="group inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition-all hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to home
            </a>
        </div>

        <div class="grid gap-8 lg:grid-cols-[1.4fr_0.6fr]">
            
            <main class="space-y-6">
                <section class="relative overflow-hidden rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm sm:p-10">
                    <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-blue-50/50 blur-3xl"></div>
                    
                    <div class="relative z-10">
                        <div class="flex flex-col gap-6 sm:flex-row sm:items-center">
                            <div class="flex h-24 w-24 shrink-0 items-center justify-center rounded-[2rem] bg-gradient-to-br from-slate-800 to-slate-900 text-3xl font-bold text-white shadow-xl shadow-slate-200">
                                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                            </div>
                            
                            <div>
                                <span class="inline-flex items-center rounded-lg bg-blue-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-widest text-blue-600 ring-1 ring-inset ring-blue-100">
                                    Personal Account
                                </span>
                                <h1 class="mt-3 text-4xl font-extrabold tracking-tight text-slate-900">
                                    User Profile
                                </h1>
                                <p class="mt-2 text-[15px] leading-relaxed text-slate-500">
                                    Manage your community contributions, track your favorite discussions, and view your account performance.
                                </p>
                            </div>
                        </div>

                        <div class="mt-12 grid gap-4 sm:grid-cols-3">
                            <div class="group rounded-3xl border border-slate-100 bg-slate-50/50 p-6 transition-all hover:bg-white hover:shadow-lg hover:shadow-slate-100">
                                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">Questions</p>
                                <div class="mt-3 flex items-baseline gap-2">
                                    <p class="text-3xl font-black text-slate-900">--</p>
                                    <span class="text-xs font-medium text-slate-400">posts</span>
                                </div>
                            </div>

                            <div class="group rounded-3xl border border-slate-100 bg-slate-50/50 p-6 transition-all hover:bg-white hover:shadow-lg hover:shadow-slate-100">
                                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">Favorites</p>
                                <div class="mt-3 flex items-baseline gap-2">
                                    <p class="text-3xl font-black text-slate-900">--</p>
                                    <span class="text-xs font-medium text-slate-400">saved</span>
                                </div>
                            </div>

                            <div class="group rounded-3xl border border-slate-100 bg-slate-50/50 p-6 transition-all hover:bg-white hover:shadow-lg hover:shadow-slate-100">
                                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">Status</p>
                                <div class="mt-3 flex items-center gap-2">
                                    <div class="h-2.5 w-2.5 animate-pulse rounded-full bg-green-500"></div>
                                    <p class="text-xl font-bold text-slate-900">Active</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="rounded-[2rem] border-2 border-dashed border-slate-200 bg-transparent p-12 text-center">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-slate-300 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-bold text-slate-900">Activity History</h3>
                    <p class="mt-1 text-sm text-slate-500">Detailed list of your questions and answers is coming soon.</p>
                </div>
            </main>

            <aside class="space-y-6">
                <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
                    <div class="bg-slate-50 px-6 py-4 border-b border-slate-100">
                        <h2 class="text-sm font-bold text-slate-900">Account Details</h2>
                    </div>
                    <div class="p-6 space-y-5">
                        <div class="flex flex-col gap-1">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Display Name</label>
                            <p class="text-sm font-semibold text-slate-700">--</p>
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Email Address</label>
                            <p class="text-sm font-semibold text-slate-700">--</p>
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Member Since</label>
                            <p class="text-sm font-semibold text-slate-700">{{ now()->format('M Y') }}</p>
                        </div>
                        
                        <button class="mt-2 w-full rounded-xl border border-slate-200 py-2.5 text-xs font-bold text-slate-600 transition hover:bg-slate-50">
                            Edit Profile
                        </button>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-[2rem] bg-slate-900 p-8 text-white">
                    <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-blue-500/20 blur-2xl"></div>
                    <h3 class="relative z-10 text-lg font-bold italic text-sky-300">New Feature!</h3>
                    <p class="relative z-10 mt-2 text-sm leading-relaxed text-slate-300">
                        Soon you'll be able to earn badges based on your community contributions.
                    </p>
                    <div class="mt-6 h-1 w-full rounded-full bg-white/10">
                        <div class="h-1 w-1/3 rounded-full bg-blue-500"></div>
                    </div>
                    <p class="mt-2 text-[10px] font-medium text-slate-500">DEVELOPMENT PROGRESS: 33%</p>
                </div>
            </aside>
            
        </div>
    </div>
</body>
</html>