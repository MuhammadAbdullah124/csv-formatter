@props(['columns' => [], 'rows' => []])

<div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-slate-200 text-sm text-slate-700">
        <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
            <tr>
                @foreach ($columns as $column)
                    <th class="px-4 py-3">{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 bg-white">
            @foreach ($rows as $row)
                <tr class="hover:bg-slate-50">
                    @foreach ($row as $cell)
                        <td class="px-4 py-3">{{ $cell }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
