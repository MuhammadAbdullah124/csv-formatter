<?php

namespace App\Http\Controllers;

use App\Models\CsvMapping;
use App\Models\InventoryItem;
use App\Models\Store;
use App\Services\WmsExportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CsvUploadController extends Controller
{
    public function create(Store $store): View
    {
        $mapping = $store->csvMappings()->latest()->first();

        return view('stores.upload', [
            'store' => $store,
            'savedMapping' => $mapping?->column_map ?? [
                'product_name' => 'Product Name',
                'sku' => 'SKU',
                'quantity' => 'Quantity',
                'price' => 'Price',
                'barcode' => 'Barcode',
                'location_id' => 'Location ID',
            ],
        ]);
    }

    public function upload(Request $request, Store $store): RedirectResponse
    {
        $validated = $request->validate([
            'csv_file' => ['required', 'file', 'mimes:csv,txt'],
            'mapping' => ['required', 'array'],
        ]);

        $path = $request->file('csv_file')->store('csv-imports');
        $rows = $this->parseCsv(storage_path('app/'.$path));
        $columnMap = $validated['mapping'];

        CsvMapping::updateOrCreate(
            ['store_id' => $store->id, 'mapping_name' => 'default'],
            ['column_map' => $columnMap]
        );

        $inventory = $this->normalizeRows($rows, $columnMap);

        foreach ($inventory as $item) {
            InventoryItem::updateOrCreate(
                ['store_id' => $store->id, 'sku' => $item['sku'] ?? $item['barcode'] ?? uniqid('item-')],
                [
                    'product_name' => $item['product_name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'location_id' => $item['location_id'],
                    'barcode' => $item['barcode'],
                    'metadata' => [
                        'source_file' => $path,
                    ],
                ]
            );
        }

        return redirect()->route('stores.upload', $store)->with('status', 'CSV imported successfully.');
    }

    public function wmsExport(Store $store, WmsExportService $service)
    {
        $items = $store->inventoryItems()->get()->map(fn ($item) => [
            'sku' => $item->sku,
            'location_id' => $item->location_id,
            'quantity' => $item->quantity,
            'barcode' => $item->barcode,
        ]);

        return $service->response($items, strtolower(str_replace(' ', '-', $store->slug)).'-wms.csv');
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function parseCsv(string $filePath): array
    {
        $handle = fopen($filePath, 'r');
        $header = fgetcsv($handle);

        if ($header === false) {
            return [];
        }

        $rows = [];

        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) !== count($header)) {
                continue;
            }

            $rows[] = array_combine($header, $row);
        }

        fclose($handle);

        return $rows;
    }

    /**
     * @param  array<int, array<string, mixed>>  $rows
     * @param  array<string, string>  $columnMap
     * @return array<int, array<string, mixed>>
     */
    protected function normalizeRows(array $rows, array $columnMap): array
    {
        return collect($rows)->map(function (array $row) use ($columnMap): array {
            $quantity = (float) str_replace([' ', ','], '', (string) ($row[$columnMap['quantity']] ?? 0));
            $price = (float) str_replace(['$', ',', ' '], '', (string) ($row[$columnMap['price']] ?? 0));

            return [
                'product_name' => $row[$columnMap['product_name']] ?? 'Unnamed Product',
                'sku' => (string) ($row[$columnMap['sku']] ?? $row[$columnMap['barcode']] ?? ''),
                'quantity' => (int) round($quantity),
                'price' => $price,
                'location_id' => $row[$columnMap['location_id']] ?? 'A1',
                'barcode' => $row[$columnMap['barcode']] ?? '',
            ];
        })->all();
    }
}
