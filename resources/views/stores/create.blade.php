@extends('layouts.app')

@section('content')
    <x-card>
        <div class="mb-5">
            <h1 class="text-2xl font-semibold text-slate-900">Create Store</h1>
            <p class="mt-1 text-sm text-slate-500">Add a new store and assign it to an admin user.</p>
        </div>

        <form action="{{ route('stores.store') }}" method="POST" class="space-y-5">
            @csrf

            <label class="block">
                <span class="mb-1 block text-sm font-medium text-slate-700">Store Name</span>
                <input type="text" name="name" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 focus:border-[#84cc16] focus:outline-none" required>
            </label>

            <label class="block">
                <span class="mb-1 block text-sm font-medium text-slate-700">Slug</span>
                <input type="text" name="slug" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 focus:border-[#84cc16] focus:outline-none" required>
            </label>

            <div class="flex justify-end gap-3">
                <x-button variant="secondary" type="button">Cancel</x-button>
                <x-button type="submit">Create Store</x-button>
            </div>
        </form>
    </x-card>
@endsection
