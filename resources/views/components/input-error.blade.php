@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-xs text-red-600 mt-1.5 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center gap-1">
                <i data-lucide="x-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                {{ $message }}
            </li>
        @endforeach
    </ul>
@endif
