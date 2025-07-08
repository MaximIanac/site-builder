<div id="sortable-container" {{ $attributes->merge(['class' => '']) }}>
    {{ $slot }}
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('sortable-container');

        Sortable.create(container, {
            animation: 150,
            filter: '.draggable-container',
            onStart: function(evt) {
                const item = evt.item;
                const alpineData = Alpine.$data(item);
                if (alpineData.open) {
                    evt.preventDefault();
                    return false;
                }
            },
            onEnd: function(evt) {
                console.log('New order:', evt.oldIndex, '->', evt.newIndex);
            }
        });
    });
</script>
@endpush

