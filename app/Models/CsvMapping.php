<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CsvMapping extends Model
{
    protected $fillable = [
        'store_id',
        'mapping_name',
        'column_map',
    ];

    protected $casts = [
        'column_map' => 'array',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
