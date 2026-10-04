<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function index(): View
    {
        $stores = Store::withCount('inventoryItems')->latest()->get();

        return view('dashboard', [
            'stores' => $stores,
            'metrics' => [
                'net_income' => 196000,
                'total_return' => 32000,
                'revenue' => 196000,
            ],
        ]);
    }

    public function create(): View
    {
        return view('stores.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->userOrFail();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:stores,slug'],
        ]);

        $store = Store::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'owner_id' => auth()->id(),
            'status' => 'active',
            'currency' => 'USD',
        ]);

        return redirect()->route('stores.upload', $store);
    }

    public function show(Store $store): View
    {
        $store->load('inventoryItems');

        return view('stores.show', compact('store'));
    }
}
