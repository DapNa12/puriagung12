@props(['name', 'show' => false, 'maxWidth' => '2xl'])

@php
$maxWidthClass = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth] ?? 'sm:max-w-2xl';
@endphp

<div
    id="modal-{{ $name }}"
    data-modal-name="{{ $name }}"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: {{ $show ? '' : 'none' }};"
>
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity" onclick="closeModal('{{ $name }}')"></div>
    <div class="relative bg-white rounded-xl shadow-xl border border-slate-200 {{ $maxWidthClass }} mx-auto mt-20">
        {{ $slot }}
    </div>
</div>

<script>
    function openModal(name) {
        const el = document.getElementById('modal-' + name);
        if (el) {
            el.style.display = '';
            document.body.classList.add('overflow-y-hidden');
            el.querySelector('[autofocus]')?.focus();
        }
    }

    function closeModal(name) {
        const el = document.getElementById('modal-' + name);
        if (el) {
            el.style.display = 'none';
            document.body.classList.remove('overflow-y-hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[data-open-modal]').forEach(btn => {
            btn.addEventListener('click', function() {
                openModal(this.getAttribute('data-open-modal'));
            });
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('[id^="modal-"]').forEach(el => {
                    if (el.style.display !== 'none') {
                        closeModal(el.getAttribute('data-modal-name'));
                    }
                });
            }
        });
    });
</script>
