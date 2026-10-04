<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryItem extends Model
{
    protected $fillable = [
        'store_id',
        'sku',
        'product_name',
        'quantity',
        'price',
        'location_id',
        'barcode',
        'metadata',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
        'metadata' => 'array',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
