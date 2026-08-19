@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'flex items-center gap-2 p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-sm text-emerald-700']) }}>
        <i data-lucide="check-circle" class="w-4 h-4 flex-shrink-0"></i>
        {{ $status }}
    </div>
@endif
