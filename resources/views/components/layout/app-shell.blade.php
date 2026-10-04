@props(['title' => 'Dashboard'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }} | {{ config('app.name', 'Spark Admin') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="bg-[#f8fafc] text-slate-900 antialiased">
        <div class="min-h-screen bg-[#f8fafc]">
            <div class="flex min-h-screen">
                <aside class="w-72 bg-[#0a2318] text-slate-100">
                    <div class="flex items-center gap-3 border-b border-white/10 px-6 py-5">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#84cc16] text-[#0a2318]">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4"><path d="M10 1.5l1.9 5.8 5.6.2-4.4 3.2 1.7 5.8-5.8-4.1-5.8 4.1 1.7-5.8L2.5 7.5l5.6-.2L10 1.5z"/></svg>
                        </div>
                        <div>
                            <div class="text-xl font-semibold">Spark Admin</div>
                        </div>
                    </div>

                    <nav class="space-y-6 px-4 py-5">
                        <div>
                            <p class="mb-2 px-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-slate-400">Menu</p>
                            <div class="space-y-1">
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-xl bg-[#0d2a21] px-3 py-2.5 text-sm font-medium text-[#dfeee8]">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 12.75V5.5A2.5 2.5 0 015.5 3h13A2.5 2.5 0 0121 5.5v7.25M3 12.75h18M7 12.75v7.75m10-7.75v7.75"/></svg>
                                    Dashboard
                                </a>
                                <a href="{{ route('stores.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-slate-300 hover:bg-[#0d2a21] hover:text-white">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M4 7.5A2.5 2.5 0 016.5 5h11A2.5 2.5 0 0120 7.5v9A2.5 2.5 0 0117.5 19h-11A2.5 2.5 0 014 16.5v-9zM8 5v14M16 5v14"/></svg>
                                    Stores
                                </a>
                            </div>
                        </div>

                        <div>
                            <p class="mb-2 px-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-slate-400">Admin</p>
                            <div class="space-y-1">
                                <a href="{{ route('stores.upload', ['store' => 1]) }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-slate-300 hover:bg-[#0d2a21] hover:text-white">
                                    CSV Upload
                                </a>
                            </div>
                        </div>
                    </nav>

                    <div class="mt-auto border-t border-white/10 p-4">
                        <div class="flex items-center gap-3 rounded-xl bg-[#0d2a21] px-3 py-2">
                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-[#84cc16] text-sm font-bold text-[#0a2318]">A</div>
                            <div class="min-w-0">
                                <p class="truncate text-sm font-semibold text-white">Administrator</p>
                                <p class="truncate text-xs text-slate-400">admin@example.com</p>
                            </div>
                        </div>
                    </div>
                </aside>

                <div class="flex-1">
                    <header class="flex items-center justify-between border-b border-slate-200 bg-white/80 px-6 py-4 backdrop-blur-sm">
                        <div class="flex items-center gap-3">
                            <button class="rounded-lg border border-slate-200 p-2 text-slate-600 hover:bg-slate-50">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            </button>
                            <div class="relative">
                                <input class="w-[420px] rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 pl-10 text-sm text-slate-700 placeholder:text-slate-400 focus:border-[#84cc16] focus:outline-none" placeholder="Search anything in Spark..." />
                                <svg class="pointer-events-none absolute left-3 top-3 h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <button class="rounded-full border border-slate-200 p-2 text-slate-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v2m0 14v2m9-9h-2M5 12H3m14.95 7.05l-1.41-1.41M8.46 8.46L7.05 7.05m9.9 0l-1.41 1.41M8.46 15.54l-1.41 1.41"/></svg>
                            </button>
                            <button class="rounded-full border border-slate-200 p-2 text-slate-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2a2 2 0 01-.6 1.4L4 17h5m6 0a3 3 0 11-6 0"/></svg>
                            </button>
                            <div class="flex items-center gap-3 rounded-full border border-slate-200 px-2 py-1.5">
                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-[#84cc16] to-[#1f7a54] text-sm font-bold text-white">A</div>
                                <div class="pr-2 text-sm font-medium text-slate-700">Administrator</div>
                            </div>
                        </div>
                    </header>

                    <main class="p-6">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>
