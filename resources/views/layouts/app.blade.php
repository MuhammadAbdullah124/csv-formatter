@php
    $user = auth()->user();
    $store = $user ? $user->ownedStores()->latest()->first() : null;
    $uploadRoute = $store ? route('stores.upload', $store) : route('stores.create');
    $displayName = $user?->name ?? 'Guest';
    $displayEmail = $user?->email ?? 'guest@example.com';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Spark Admin') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="bg-[#f8fafc] text-slate-900 antialiased">
        <div class="min-h-screen bg-[#f8fafc]">
            <div class="flex min-h-screen">
                <aside class="w-72 shrink-0 bg-[#0a2318] text-slate-100">
                    <div class="flex items-center gap-3 border-b border-white/10 px-6 py-5">
                        <div class="flex h-8 w-8 items-center justify-cente