@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-slate-900">{{ $store->name }}</h1>
                <p class="mt-1 text-sm text-slate-500">Inventory overview and recent CSV imports.</p>
            </div>
            <a href="{{ route('stores.upload', $store) }}" class="inline-flex items-center justify-center rounded-lg bg-[#0a2318] px-4 py-2 text-sm font-medium text-white hover:bg-[#0d2a21]">
                Upload CSV
            </a>
        </div>

        <div class="grid grid-cols-3 gap-6">
            <x-card>
                <div class="text-sm text-slate-500">Inventory Items</div>
                <div class="mt-3 text-3xl font-semibold text-slate-900">{{ $store->inventoryItems()->count() }}</div>
            </x-card>
            <x-card>
                <div class="text-sm text-slate-500">Active Mapping</div>
                <div class="mt-3 text-3xl font-semibold text-slate-900">{{ $store->csvMappings()->count() }}</div>
            </x-card>
            <x-card>
                <div class="text-sm text-slate-500">Status</div>
                <div class="mt-3 text-3xl font-semibold text-[#0a2318]">{{ ucfirst($store->status) }}</div>
            </x-card>
        </div>

        <x-card>
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-slate-900">Inventory Data</h2>
                <input type="text" placeholder="Search inventory..." class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm focus:border-[#84cc16] focus:outline-none">
            </div>

            <x-table :columns="['Product', 'SKU', 'Quantity', 'Price', 'Location', 'Barcode']" :rows="$store->inventoryItems()->get()->map(fn ($item) => [
                $item->product_name,
                $item->sku,
                $item->quantity,
                '$'.number_format($item->price, 2),
                $item->location_id,
                $item->barcode,
            ])->toArray()" />
        </x-card>
    </div>
@endsection
