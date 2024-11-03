<div class="container mt-5">
    <h2 class="text-center mb-4">Historial de Pagos</h2>

    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre o ID de estudiante" />
    </div>

    <div class="mb-3">
        <label for="paymentTypeFilter" class="form-label">Filtrar por Tipo de Pago:</label>
        <select id="paymentTypeFilter" class="form-select">
            <option value="">Todos</option>
            <option value="colegiatura">Colegaturas</option>
            <option value="inscripcion">Inscripciones</option>
        </select>
    </div>

    <table class="table table-striped table-responsive">
        <thead>
        <tr>
            <th>ID Estudiante</th>
            <th>Nombre del Estudiante</th>
            <th>Tipo de Pago</th>
            <th>Fecha y Hora de Pago</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody id="paymentHistory">
        <tr data-type="colegiatura" class="clickable-row">
            <td>001</td>
            <td>Juan Pérez</td>
            <td>Colegiatura</td>
            <td>10/10/2024 14:30</td>
            <td>$1,000</td>
        </tr>
        <tr class="details-row" style="display: none;">
            <td colspan="5">
                <div class="p-3">
                    <strong>Detalles del Pago:</strong>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2">
                            Inscripción Curso Belleza ene-feb sábados 2024:
                            <span class="badge bg-primary ms-2">$500</span>
                        </li>
                        <li class="mb-2">
                            Semana 1 Curso Belleza ene-feb sábados 2024:
                            <span class="badge bg-secondary ms-2">$250</span>
                        </li>
                        <li class="mb-2">
                            Semana 2 Curso Belleza ene-feb sábados 2024:
                            <span class="badge bg-success ms-2">$250</span>
                        </li>
                    </ul>
                    <strong>Total del Pago: </strong>
                    <span class="total-amount">$1,000</span>
                </div>
            </td>
        </tr>
        <tr data-type="inscripcion" class="clickable-row">
            <td>002</td>
            <td>Maria López</td>
            <td>Inscripción</td>
            <td>05/10/2024 10:15</td>
            <td>$400</td>
        </tr>
        <tr class="details-row" style="display: none;">
            <td colspan="5">
                <div class="p-3">
                    <strong>Detalles de la Venta:</strong>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2">
                            Inscripción Curso de Arte:
                            <span class="badge bg-info ms-2">$400</span>
                        </li>
                    </ul>
                    <strong>Total de la Venta: </strong>
                    <span class="total-amount">$400</span>
                </div>
            </td>
        </tr>
        <tr data-type="colegiatura" class="clickable-row">
            <td>003</td>
            <td>Andrés Torres</td>
            <td>Colegiatura</td>
            <td>12/10/2024 09:00</td>
            <td>$900</td>
        </tr>
        <tr class="details-row" style="display: none;">
            <td colspan="5">
                <div class="p-3">
                    <strong>Detalles de la Venta:</strong>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2">
                            Inscripción Curso de Fotografía:
                            <span class="badge bg-warning ms-2">$300</span>
                        </li>
                        <li class="mb-2">
                            Semana 1 Curso de Fotografía:
                            <span class="badge bg-danger ms-2">$300</span>
                        </li>
                        <li class="mb-2">
                            Semana 2 Curso de Fotografía:
                            <span class="badge bg-info ms-2">$300</span>
                        </li>
                    </ul>
                    <strong>Total de la Venta: </strong>
                    <span class="total-amount">$900</span>
                </div>
            </td>
        </tr>
        <tr data-type="inscripcion" class="clickable-row">
            <td>004</td>
            <td>Lucía García</td>
            <td>Inscripción</td>
            <td>15/10/2024 11:45</td>
            <td>$500</td>
        </tr>
        <tr class="details-row" style="display: none;">
            <td colspan="5">
                <div class="p-3">
                    <strong>Detalles de la Venta:</strong>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2">
                            Inscripción Curso de Música:
                            <span class="badge bg-success ms-2">$500</span>
                        </li>
                    </ul>
                    <strong>Total de la Venta: </strong>
                    <span class="total-amount">$500</span>
                </div>
            </td>
        </tr>
        <tr data-type="colegiatura" class="clickable-row">
            <td>005</td>
            <td>Fernando Ruiz</td>
            <td>Colegiatura</td>
            <td>20/10/2024 08:30</td>
            <td>$1,800</td>
        </tr>
        <tr class="details-row" style="display: none;">
            <td colspan="5">
                <div class="p-3">
                    <strong>Detalles de la Venta:</strong>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2">
                            Inscripción Curso de Diseño:
                            <span class="badge bg-danger ms-2">$600</span>
                        </li>
                        <li class="mb-2">
                            Semana 1 Curso de Diseño:
                            <span class="badge bg-warning ms-2">$600</span>
                        </li>
                        <li class="mb-2">
                            Semana 2 Curso de Diseño:
                            <span class="badge bg-secondary ms-2">$600</span>
                        </li>
                    </ul>
                    <strong>Total de la Venta: </strong>
                    <span class="total-amount">$1,800</span>
                </div>
            </td>
        </tr>
        <!-- Additional rows can be added as needed -->
        </tbody>
    </table>
</div>

<script>
    document.querySelectorAll('.clickable-row').forEach(row => {
        row.addEventListener('click', function() {
            const detailsRow = this.nextElementSibling;
            detailsRow.style.display = detailsRow.style.display === 'none' ? '' : 'none';
        });
    });

    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#paymentHistory tr.clickable-row');

        rows.forEach(function(row) {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
            // Hide corresponding details row
            const detailsRow = row.nextElementSibling;
            detailsRow.style.display = 'none'; // Reset details display when filtering
        });
    });

    document.getElementById('paymentTypeFilter').addEventListener('change', function() {
        const selectedType = this.value;
        const rows = document.querySelectorAll('#paymentHistory tr.clickable-row');

        rows.forEach(function(row) {
            const rowType = row.getAttribute('data-type');
            if (selectedType === '' || rowType === selectedType) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
                const detailsRow = row.nextElementSibling;
                detailsRow.style.display = 'none'; // Hide details row when filtering
            }
        });
    });
</script>
