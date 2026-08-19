<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['name', 'show' => false, 'maxWidth' => '2xl']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['name', 'show' => false, 'maxWidth' => '2xl']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$maxWidthClass = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth] ?? 'sm:max-w-2xl';
?>

<div
    id="modal-<?php echo e($name); ?>"
    data-modal-name="<?php echo e($name); ?>"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: <?php echo e($show ? '' : 'none'); ?>;"
>
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity" onclick="closeModal('<?php echo e($name); ?>')"></div>
    <div class="relative bg-white rounded-xl shadow-xl border border-slate-200 <?php echo e($maxWidthClass); ?> mx-auto mt-20">
        <?php echo e($slot); ?>

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
<?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\components\modal.blade.php ENDPATH**/ ?>