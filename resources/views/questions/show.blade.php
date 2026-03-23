<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $question->title }} | GeoQuestions</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100">
    <div class="mx-auto max-w-6xl px-4 py-6 sm:px-6 lg:px-8">
 
        <div class="mb-5">
            <a href="{{ route('questions.index') }}"
               class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition 
                             hover:text-slate-900">
                <span> </span>
                <span>Back to questions</span>
            </a>
        </div>
 
        <div class="grid items-start gap-5 md:grid-cols-[1.55fr_0.62fr]">
 
            <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white 
                             shadow-[0_18px_60px_rgba(15,23,42,0.06)]">
                
                <div class="relative overflow-hidden border-b border-slate-100 bg-slate-900 px-6 
                             py-8 sm:px-8">
                    <div class="absolute inset-0 bg-[radial
                             gradient(circle_at_top_left,rgba(59,130,246,0.35),transparent_30%),radial
                             gradient(circle_at_bottom_right,rgba(14,165,233,0.20),transparent_30%)]"></div>
 
                    <div class="relative z-10">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="inline-flex rounded-full border border-white/10 bg-white/10 
                             px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-sky-200">
                                Question #{{ $question->id }}
                            </span>
 
                            <span class="text-xs font-medium text-slate-300">
                                {{ $question->created_at->diffForHumans() }}
                            </span>
                        </div>
 
                        <h1 class="mt-5 max-w-3xl text-3xl font-bold tracking-tight text-white 
                             sm:text-4xl">
                            {{ $question->title }}
                        </h1>
 
                        <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-300">
                            A community question shared on GeoQuestions. Read the full details below.
                        </p>
                    </div>
                </div>
 
                <div class="px-6 py-6 sm:px-8 sm:py-8">
                    <div class="mb-6 flex flex-wrap items-center gap-3 border-b border-slate-100 
                             pb-5">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-50 
                             text-sm font-bold text-blue-600">
                            {{ strtoupper(substr($question->user?->name ?? 'U', 0, 1)) }}
                        </div>
 
                        <div>
                            <p class="text-sm font-semibold text-slate-800">
                                {{ $question->user?->name ?? 'Unknown user' }}
                            </p>
                            <p class="text-xs text-slate-400">
                                Posted on {{ $question->created_at->format('M d, Y \a\t H:i') }}
                            </p>
                        </div>
                    </div>
 
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 px-5 py-5 sm:px-6 
                             sm:py-6">
                        <h2 class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-400">
                            Question Details
                        </h2>
 
                        <div class="mt-4 whitespace-pre-line text-[15px] leading-8 text-slate-700">
                            {{ $question->body }}
                        </div>
                        
                    </div>
                    <div class="mt-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-bold text-slate-900">Answers</h2>
        <span class="text-sm text-slate-400">
            {{ $question->answers->count() }} answer(s)
        </span>
    </div>

    @if ($question->answers->isEmpty())
        <div class="mt-4 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4 text-sm text-slate-500">
            No answers yet. Be the first to answer this question.
        </div>
    @else
        <div class="mt-5 space-y-4">
            @foreach ($question->answers as $answer)
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-blue-50 text-sm font-bold text-blue-600">
                            {{ strtoupper(substr($answer->user?->name ?? 'U', 0, 1)) }}
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-slate-900">
                                {{ $answer->user?->name ?? 'Unknown user' }}
                            </p>
                            <p class="text-xs text-slate-400">
                                {{ $answer->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 whitespace-pre-line text-sm leading-7 text-slate-700">
                        {{ $answer->body }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
                </div>
                <div class="mt-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.04)]">
    <h2 class="text-lg font-bold text-slate-900">Your Answer</h2>
    <p class="mt-2 text-sm text-slate-500">
        Write a helpful answer to this question.
    </p>

    @auth
        <form method="POST" action="{{ route('answers.store', $question->id) }}" class="mt-5 space-y-4">
            @csrf

            @if ($errors->any())
                <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-4 text-sm text-red-700">
                    <p class="font-semibold">Please fix this first:</p>
                    <p class="mt-1">{{ $errors->first() }}</p>
                </div>
            @endif

            <div>
                <label for="body" class="block text-sm font-semibold text-slate-700">
                    Answer
                </label>
                <textarea
                    id="body"
                    name="body"
                    rows="5"
                    required
                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 resize-none"
                    placeholder="Write your answer here..."
                >{{ old('body') }}</textarea>
            </div>

            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-600"
            >
                Submit answer
            </button>
        </form>
    @else
        <div class="mt-5 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4 text-sm text-slate-600">
            You need to be logged in to submit an answer.
        </div>
    @endauth
</div>
            </article>
 
            <aside class="space-y-4 md:sticky md:top-3 self-start">
 
                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow
                             [0_10px_30px_rgba(15,23,42,0.04)]">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-400">
                        Author
                    </p>
 
                    <div class="mt-4 rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-50 
                             text-sm font-bold text-blue-600">
                                {{ strtoupper(substr($question->user?->name ?? 'U', 0, 1)) }}
                            </div>
 
                            <div>
                                <p class="text-sm font-semibold text-slate-900">
                                    {{ $question->user?->name ?? 'Unknown user' }}
                                </p>
                                <p class="text-xs text-slate-400">
                                    Posted {{ $question->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
 
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-slate-900 p-4 
                             text-white shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-sky-200">
                        Continue browsing
                    </p>
 
                    <h3 class="mt-2.5 text-lg font-bold leading-6">
                        Explore more questions.
                    </h3>
 
                    <p class="mt-2 text-xs leading-5 text-slate-300">
                        Go back to the feed or create another question.
                    </p>
 
                    <div class="mt-4 flex flex-col gap-2">
                        <a href="{{ route('questions.index') }}"
                           class="inline-flex items-center justify-center rounded-2xl bg-white px-4 py-2.5 
                             text-sm font-semibold text-slate-900 transition hover:bg-slate-100">
                            Browse all questions
                        </a>
 
                        @auth
                            <a href="{{ route('questions.create') }}"
                               class="inline-flex items-center justify-center rounded-2xl border border
                             white/10 bg-white/10 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg
                             white/15">
                                Ask another question
                            </a>
                        @endauth
                    </div>
                </div>
            </aside>
        </div>
        
    </div>
    
</body>
</html>