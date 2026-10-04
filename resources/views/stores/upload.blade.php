@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold tracking-tight text-slate-900">CSV Upload & Mapping</h1>
                <p class="mt-1 text-slate-500">Smart column matching for {{ $store->name }}.</p>
            </div>
            <div class="flex gap-3">
                <x-button variant="secondary" type="button">Download Backup</x-button>
                <a href="{{ route('stores.wms-export', $store) }}" class="inline-flex items-center justify-center rounded-md bg-[#84cc16] px-4 py-2 text-sm font-semibold text-[#0a2318] hover:bg-[#a3e635]">
                    WMS Export
                </a>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
            <x-card>
                <div class="mb-4">
                    <div class="text-lg font-semibold text-slate-900">Upload CSV</div>
                    <p class="mt-1 text-sm text-slate-500">Choose a file and map the essential fields.</p>
                </div>

                <form action="{{ route('stores.upload.post', $store) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-6 text-center">
                        <input type="file" name="csv_file" class="block w-full text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-[#0a2318] file:px-4 file:py-2 file:text-sm file:font-medium file:text-white" required>
                    </div>

                    <div x-data="{
                        columns: ['Product Name','SKU','Quantity','Price','Barcode','Location ID'],
                        selected: {{ json_encode($savedMapping) }}
                    }" class="space-y-4">
                        <div class="grid gap-3 md:grid-cols-2">
                            @foreach (['product_name' => 'Product Name', 'sku' => 'SKU', 'quantity' => 'Quantity', 'price' => 'Price', 'barcode' => 'Barcode', 'location_id' => 'Location ID'] as $key => $label)
                                <label class="space-y-2 text-sm text-slate-700">
                                    <span class="font-medium">{{ $label }}</span>
                                    <select name="mapping[{{ $key }}]" x-model="selected['{{ $key }}']" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 focus:border-[#84cc16] focus:outline-none">
                                        <option value="">Select a column</option>
                                        <template x-for="column in columns" :key="column">
                                            <option :value="column" x-text="column"></option>
                                        </template>
                                    </select>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <x-button variant="secondary" type="button">Cancel</x-button>
                        <x-button type="submit">Import & Save Mapping</x-button>
                    </div>
                </form>
            </x-card>

            <x-card>
                <div class="mb-4">
                    <div class="text-lg font-semibold text-slate-900">Saved Mapping</div>
                    <p class="mt-1 text-sm text-slate-500">Previously used column configuration for this store.</p>
                </div>

                <div class="space-y-3 text-sm text-slate-700">
                    @foreach ($savedMapping as $field => $column)
                        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 px-3 py-2">
                            <span class="font-medium capitalize">{{ str_replace('_', ' ', $field) }}</span>
                            <span class="text-slate-600">{{ $column }}</span>
                        </div>
                    @endforeach
                </div>
            </x-card>
        </div>

        <x-card>
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-slate-900">Parsed Inventory Preview</h2>
                    <p class="text-sm text-slate-500">Client-side search and filter support is ready for the imported data.</p>
                </div>
                <div class="flex items-center gap-2">
                    <input type="text" placeholder="Search rows..." class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm focus:border-[#84cc16] focus:outline-none">
                    <select class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm focus:border-[#84cc16] focus:outline-none">
                        <option>All columns</option>
                        <option>SKU</option>
                        <option>Product</option>
                    </select>
                </div>
            </div>

            <x-table :columns="['Product', 'SKU', 'Quantity', 'Price', 'Location', 'Barcode']" :rows="[
                ['Classic Tee', 'SKU-101', '42', '$29.00', 'A-01', 'BRC-1021'],
                ['Cotton Shirt', 'SKU-102', '18', '$35.00', 'A-04', 'BRC-7202'],
                ['Hoodie', 'SKU-115', '26', '$59.00', 'C-02', 'BRC-8814'],
            ]" />
        </x-card>
    </div>
@endsection
