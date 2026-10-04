<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;

class WmsExportService
{
    /**
     * @param  Collection<int, array<string, mixed>>  $items
     */
    public function buildCsv(Collection $items): string
    {
        $handle = fopen('php://temp', 'r+');

        fputcsv($handle, ['SKU', 'LOCATION_ID', 'INVENTORY_QTY', 'BARCODE']);

        foreach ($items as $item) {
            fputcsv($handle, [
                $item['sku'] ?? '',
                $item['location_id'] ?? '',
                $item['quantity'] ?? 0,
                $item['barcode'] ?? '',
            ]);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return $csv ?: '';
    }

    /**
     * @param  Collection<int, array<string, mixed>>  $items
     */
    public function response(Collection $items, string $filename = 'wms-export.csv'): StreamedResponse
    {
        return response()->streamDownload(function () use ($items) {
            echo $this->buildCsv($items);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
