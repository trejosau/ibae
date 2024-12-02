<div class="container-fluid mt-5" style="background-color: var(--color-footer); padding: 20px; border-radius: 8px;">
    <h2 class="text-center mb-4" style="color: var(--color-acento); font-weight: bold;">Historial de Pagos</h2>
</div>

<div>
<livewire:pagos-estudiantes />
</div>


<script>
    document.querySelectorAll('.clickable-row').forEach(row => {
        row.addEventListener('click', function() {
            const detailsRow = this.nextElementSibling;
            detailsRow.style.display = detailsRow.style.display === 'none' ? '' : 'none';
        });
    });
</script>


