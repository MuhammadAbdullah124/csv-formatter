@props(['variant' => 'primary', 'as' => 'button'])

@php
    $classes = match ($variant) {
        'primary' => 'inline-flex items-center justify-center rounded-md bg-[#0a2318] px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-[#0d2d20]',
        'secondary' => 'inline-flex items-center justify-center rounded-md border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50',
        'success' => 'inline-flex items-center justify-center rounded-md bg-[#84cc16] px-4 py-2 text-sm font-semibold text-[#0a2318] hover:bg-[#a3e635]',
        default => 'inline-flex items-center justify-center rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white',
    };
@endphp

@if ($as === 'a')
    <a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
