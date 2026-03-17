<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions | GeoQuestions</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100">
    <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">
        
        <header class="mb-8 rounded-3xl border border-slate-200 bg-white px-6 py-6 shadow
                             [0_12px_40px_rgba(15,23,42,0.06)] sm:px-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">GeoQuestions</p>
                    <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
                        Questions Feed
                    </h1>
                    <p class="mt-2 text-sm text-slate-500">
                        Browse recent questions from the community.
                    </p>
                </div>
                @auth
                    <a href="{{ route('questions.create') }}"
                       class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-5 py-3
                             text-sm font-semibold text-white transition hover:bg-blue-600">
                        Ask a Question
                    </a>
                @endauth
            </div>
        </header>
        @if ($questions->isEmpty())
            <div class="rounded-3xl border border-slate-200 bg-white px-6 py-12 text-center shadow
                             [0_12px_40px_rgba(15,23,42,0.05)]">
                <h2 class="text-lg font-semibold text-slate-800">No questions yet</h2>
                <p class="mt-2 text-sm text-slate-500">
                    No one has posted a question yet. Be the first one to ask.
                </p>
                @auth
                    <a href="{{ route('questions.create') }}"
                       class="mt-6 inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5
                             py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                        Create the first question
                    </a>
                @endauth
            </div>
        @else
            <div class="space-y-4">
                @foreach ($questions as $question)
                    <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow
                                            [0_10px_30px_rgba(15,23,42,0.04)] transition hover:-translate-y-0.5 hover:border-blue-200
                                            hover:shadow-[0_16px_40px_rgba(59,130,246,0.08)]">
                        <a href="{{ route('questions.show', $question->id) }}" class="block">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <span class="inline-flex rounded-full bg-blue-50 px-3 py-1 text-[11px]
                                            font-semibold uppercase tracking-[0.18em] text-blue-600">
                                        Question #{{ $question->id }}
                                    </span>
                                    <h2 class="mt-4 text-xl font-bold leading-snug text-slate-900 transition
                                            group-hover:text-blue-600">
                                        {{ $question->title }}
                                    </h2>
                                </div>
                            </div>
                            <p class="mt-3 text-sm leading-7 text-slate-600 line-clamp-2">
                                {{ $question->body }}
                            </p>
                            <div class="mt-5 flex items-center gap-3 text-xs font-medium text-slate-400">
                                <span>Read more</span>
                                <span>·</span>
                                <span>{{ $question->created_at->diffForHumans() }}</span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>