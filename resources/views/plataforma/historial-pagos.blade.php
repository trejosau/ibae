<div class="container-fluid mt-5" style="background-color: #f9f3f0; padding: 20px; border-radius: 8px;">
    <h2 class="text-center mb-4" style="color: #d9534f;">Historial de Pagos</h2>
   
<livewire:pagosestudiantes />
@livewireScripts
@livewireStyles



</div>

<script>
    document.querySelectorAll('.clickable-row').forEach(row => {
        row.addEventListener('click', function() {
            const detailsRow = this.nextElementSibling;
            detailsRow.style.display = detailsRow.style.display === 'none' ? '' : 'none';
        });
    });
</script>


