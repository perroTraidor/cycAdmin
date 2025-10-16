let totalCheques = 0; // Variable para acumular el total de cheques/echeqs
let grandTotalOp = 0; // Variable para el total general de la OP
let renglonId = 0; // Identificador único para cada fila
let chequesDetails = []; // Array para almacenar los detalles de los cheques


// Evento para seleccionar forma de pago en modalNuevaOp
document.getElementById('forma').addEventListener('change', function() {
    renglonId++;  // Incrementar para cada nuevo renglón
    
    
    const selectedValue = this.value;
    let formaLabel = '';
    if (selectedValue === 'che' || selectedValue === 'ech') {
        // Abre el modal de cheques/echeqs
        $('#modalChequesEcheqs').modal('show');
    } else if (selectedValue === 'efe') {
        formaLabel = 'Efectivo';
    } else if (selectedValue === 'tra') {
        formaLabel = 'Transferencia';
    }
    if (formaLabel) {
        
        // Agrega un nuevo renglón para Efectivo/Transferencia
        const newRenglon = `
        <div class="row renglonOp" id="renglon-${renglonId}">
            <div class="col">
                <label for="subtotal">Subtotal (${formaLabel})</label>
                <input type="text" class="form-control subtotal" required>
            </div>
        </div>`;
        document.getElementById('formaPagoContainer').insertAdjacentHTML('beforeend', newRenglon);

        // Agregar los inputs hidden para enviar los datos
        const formaPagoHidden = `<input type="hidden" name="forma_pagos[]" value="${selectedValue}">`;
        const subtotalHidden = `<input type="hidden" name="subtotales[]" class="subtotalHidden" id="subtotal-${renglonId}">`;

        document.getElementById('formaPagoContainer').insertAdjacentHTML('beforeend', formaPagoHidden + subtotalHidden);

    }
});

// Función para agregar cheques/echeqs en modalChequesEcheqs
document.getElementById('addCheque').addEventListener('click', function() {
    const banco = document.getElementById('banco').value;
    const fechaPago = document.getElementById('fechaPago').value;
    const numeroCheque = document.getElementById('numeroCheque').value;
    const importeCheque = parseFloat(document.getElementById('importeCheque').value);

    // Validación de campos
    if (!banco || !fechaPago || !numeroCheque || isNaN(importeCheque)) {
        alert('Por favor, complete todos los campos correctamente.');
        return;
    }

    // Sumar el importe al total de cheques/echeqs
    totalCheques += importeCheque;

    // Crear un nuevo renglón en modalChequesEcheqs para cargar otro cheque/echeq
    const nuevaFilaCheque = `
    <div class="row renglonCheque">
        <div class="col">${banco}</div>
        <div class="col">${fechaPago}</div>
        <div class="col">${numeroCheque}</div>
        <div class="col">${importeCheque.toFixed(2)}</div>
    </div>`;
    
    
    // Crear inputs hidden para capturar los detalles del cheque
    const chequeDetails = `
    <input type="hidden" name="cheques[banco][]" value="${banco}">
    <input type="hidden" name="cheques[fecha_pago][]" value="${fechaPago}">
    <input type="hidden" name="cheques[numero][]" value="${numeroCheque}">
    <input type="hidden" name="cheques[importe][]" value="${importeCheque.toFixed(2)}">`;
    
    document.getElementById('chequesContainer').insertAdjacentHTML('beforeend', nuevaFilaCheque + chequeDetails);

    // Actualizar subtotal del modalChequesEcheqs
    document.getElementById('subtotalCheques').value = totalCheques.toFixed(2);

    // Agregar los detalles del cheque al array chequesDetails
    chequesDetails.push({banco, fechaPago, numeroCheque, importeCheque});

    // Limpiar campos del modal para el próximo cheque/echeq
    document.getElementById('banco').value = '';
    document.getElementById('fechaPago').value = '';
    document.getElementById('numeroCheque').value = '';
    document.getElementById('importeCheque').value = '';
    
});



// Al cerrar el modal de cheques/echeqs
document.getElementById('cerrarModalCheques').addEventListener('click', function() {
    // Pasar el total de cheques al renglón en modalNuevaOp
    const newRenglonCheque = `
    <div class="row renglonOp id="renglon-${renglonId}">
        <div class="col">
            <label>Subtotal Cheques/Echeqs</label>
            <input type="text" class="form-control subtotal" value="${totalCheques.toFixed(2)}" readonly>
        </div>
    </div>`;
    
    document.getElementById('formaPagoContainer').insertAdjacentHTML('beforeend', newRenglonCheque);

    const formaPagoHiddenCheques = `<input type="hidden" name="forma_pagos[]" value="che">`;
    const subtotalHiddenCheques = `<input type="hidden" name="subtotales[]" class="subtotalHidden" id="subtotal-${renglonId}" value="${totalCheques.toFixed(2)}" readonly>`;

    document.getElementById('formaPagoContainer').insertAdjacentHTML('beforeend', formaPagoHiddenCheques + subtotalHiddenCheques);


    grandTotalOp = parseFloat(document.getElementById('grandTotalOp').value) || 0; // Obtener el valor actual del total general
    // Sumar al total general de la OP
    grandTotalOp += totalCheques;
    document.getElementById('grandTotalOp').value = grandTotalOp.toFixed(2);

    // Resetear el total de cheques para el próximo uso del modal
    totalCheques = 0;

    const chequesJSON = JSON.stringify(chequesDetails);
    const chequesDetailsHidden = `<input type="hidden" name="cheques_details" value='${chequesJSON}'>`;
    document.getElementById('formaPagoContainer').insertAdjacentHTML('beforeend', chequesDetailsHidden);

    // Resetear chequesDetails y totalCheques
    chequesDetails = [];
    totalCheques = 0;

    // Cerrar el modal
    $('#modalChequesEcheqs').modal('hide');
});

// Actualizar el total general de la OP cuando cambian los subtotales de efectivo/transferencia
document.getElementById('formaPagoContainer').addEventListener('input', function(e) {
    if (e.target && e.target.classList.contains('subtotal')) {
        const allSubtotals = document.querySelectorAll('.subtotal');
        let total = 0;
        allSubtotals.forEach((subtotal, index) => {
            const value = parseFloat(subtotal.value) || 0;
            total += value;

            // Actualizar el hidden correspondiente al subtotal
            document.querySelectorAll('.subtotalHidden')[index].value = value.toFixed(2);
        });
        document.getElementById('grandTotalOp').value = total.toFixed(2);
    }
});

document.getElementById('modalNuevaOp').addEventListener('shown.bs.modal', function() {
    const today = new Date().toISOString().split('T')[0];  // Formato YYYY-MM-DD
    document.getElementById('fechaop').value = today;
});

    // Función para recalcular el total general de la OP
function recalcularGrandTotal() {
    const allSubtotals = document.querySelectorAll('.subtotal');
    let total = 0;
    allSubtotals.forEach(subtotal => {
        total += parseFloat(subtotal.value) || 0;
    });
    document.getElementById('grandTotalOp').value = total.toFixed(2);
}

// Llamar a recalcularGrandTotal cada vez que cambie un subtotal
document.getElementById('formaPagoContainer').addEventListener('input', function(e) {
    if (e.target && e.target.classList.contains('subtotal')) {
        recalcularGrandTotal();
    }
});


document.getElementById('formNuevaOp').addEventListener('submit', function(e) {

    // Prevenir el envío del formulario hasta armar el JSON
    e.preventDefault();

    // Inicializar el objeto para formas de pago
    const formasPago = [];

    // Recorrer los renglones para obtener las formas de pago
    document.querySelectorAll('.renglonOp').forEach((renglon, index) => {
        const formaPago = document.querySelectorAll('input[name="forma_pagos[]"]')[index].value;  // Obtener la forma de pago
        const subtotal = parseFloat(document.querySelectorAll('input[name="subtotales[]"]')[index].value) || 0;  // Obtener el subtotal

        // Solo agregar si el subtotal es mayor que 0
        if (subtotal > 0) {

            // Si es cheque o echeq, también incluir los detalles específicos
            if (formaPago === 'che' || formaPago === 'ech') {
                const cheques = [];  // Array para almacenar cada cheque

                // Recorrer los inputs hidden de los cheques y agregar los detalles al array de cheques
                document.querySelectorAll('input[name="cheques[banco][]"]').forEach((_, chequeIndex) => {
                    const cheque = {
                        banco: document.querySelectorAll('input[name="cheques[banco][]"]')[chequeIndex].value,
                        fecha_pago: document.querySelectorAll('input[name="cheques[fecha_pago][]"]')[chequeIndex].value,
                        numero: document.querySelectorAll('input[name="cheques[numero][]"]')[chequeIndex].value,
                        importe: parseFloat(document.querySelectorAll('input[name="cheques[importe][]"]')[chequeIndex].value) || 0
                    };
                    cheques.push(cheque);
                });

                // Agregar los cheques como parte de esta forma de pago
                formasPago.push({
                    tipo: formaPago,
                    subtotal: subtotal,
                    cheques: cheques
                });
            } else {
                // Para efectivo o transferencia, solo agregar el subtotal
                formasPago.push({
                    tipo: formaPago,
                    subtotal: subtotal
                });
            }
        }
    });

    // Convertir el objeto a JSON y agregarlo como un input hidden en el formulario
    const jsonFormasPago = JSON.stringify(formasPago);
    const jsonInput = `<input type="hidden" name="formasPagoJson" value='${jsonFormasPago}'>`;
    document.getElementById('formNuevaOp').insertAdjacentHTML('beforeend', jsonInput);

    const totalOp = parseFloat(document.getElementById('grandTotalOp').value) || 0;
    if (totalOp <= 0) {
        alert('El total de la orden de pago debe ser mayor a cero.');
        return;
    }

    // Enviar el formulario ahora que ya agregamos el JSON
    this.submit();
    
});


// Listener para abrir el modal de facturas desde modalNuevaOp
document.getElementById('BuscaFacturas').addEventListener('click', function(e) {
    e.preventDefault(); // Prevenir el comportamiento por defecto del botón
    const proveedorId = document.getElementById('proveedor_id_op').value;

    // Llamar a la función que carga las facturas del proveedor
    cargarFacturasParaImputacion(proveedorId);

    // Mover modalFacturas fuera de modalNuevaOp para evitar conflictos
    $('#modalFacturas').appendTo("body");

    // Abrir modalFacturas sin cerrar modalNuevaOp
    $('#modalFacturas').modal({
        backdrop: 'static',  // Evita que modalNuevaOp se cierre
        keyboard: false      // Deshabilita el cierre con "Escape"
    }).modal('show');
});

// Función para cargar las facturas con saldo
function cargarFacturasParaImputacion(proveedorId) {
    $.ajax({
        url: '/index.php?entidad=ops&accion=obtenerFacturasConSaldo',
        method: 'GET',
        data: { id: proveedorId },
        dataType: 'json',
        success: function(response) {
            const tableBody = $('#modalFacturas tbody');
            tableBody.empty();  // Limpiar la tabla antes de agregar nuevas filas
            
            console.log(response)
            
            if (response.error) {
                alert(response.error);
            } else {
                // Iterar sobre las facturas y agregarlas a la tabla
                response.forEach(function(factura) {
                
                    //console.log(factura)

                    const numeroFactura = factura.numero;  // Ajusta según el nombre correcto del campo
                    const fechaFactura = factura.fecha;
                    const total = factura.total ? parseFloat(factura.total) : 0;  // Ajusta el campo correcto
                    const saldo = factura.saldo ? parseFloat(factura.saldo) : 0;  // Ajusta el campo correcto

                    const row = `
                        <tr>
                            <td>${numeroFactura || ''}</td>
                            <td>${fechaFactura || ''}</td>
                            <td>$ ${total.toFixed(2)}</td>
                            <td>$ ${saldo.toFixed(2)}</td>
                            <td><input type="number" class="form-control imputarMonto" data-factura-id="${factura.id}" max="${saldo}" placeholder="Monto a imputar"></td>
                        </tr>`;
                    tableBody.append(row);
                });

                // Mostrar el total del pago para aplicar
                const grandTotalOp = document.getElementById('grandTotalOp').value;
                document.querySelector('#totalDisponible').textContent = `Total del pago para aplicar: $ ${grandTotalOp}`;

                // Agregar evento para actualizar el total de imputaciones
                document.querySelectorAll('.imputarMonto').forEach(input => {
                input.addEventListener('input', actualizarTotalImputaciones);
                
                });
            }
        },
        error: function() {
            alert('Error al obtener las facturas del proveedor.');
        }
    });
}

// Función para actualizar el total de imputaciones
function actualizarTotalImputaciones() {
    let totalImputado = 0;
    document.querySelectorAll('.imputarMonto').forEach(input => {
        totalImputado += parseFloat(input.value) || 0;
    });
    document.querySelector('#totalImputar').textContent = `Total de Imputaciones: $ ${totalImputado.toFixed(2)}`;
}

// Manejar el cierre del modal de facturas
document.querySelector('#modalFacturas .btn-close').addEventListener('click', function() {
    $('#modalFacturas').modal('hide');
});

// Manejar la confirmación de imputaciones
document.querySelector('#modalFacturas .btn:not(.btn-close)').addEventListener('click', function() {
    const totalImputado = calcularTotalImputado();
    const grandTotalOp = parseFloat(document.getElementById('grandTotalOp').value);
    
    if (Math.abs(totalImputado - grandTotalOp) > 0.01) {
        alert('El total imputado no coincide con el total de la orden de pago.');
    } else {
        // Aquí puedes agregar la lógica para guardar las imputaciones
        $('#modalFacturas').modal('hide');
    }
});

// Función para calcular el total imputado
function calcularTotalImputado() {
    let totalImputado = 0;
    $('.imputarMonto').each(function() {
        const monto = parseFloat($(this).val()) || 0;
        totalImputado += monto;
    });
    return totalImputado;
}

// Capturar evento cuando se cierra modalFacturas
$('#modalFacturas').on('hide.bs.modal', function() {
    // Inicializar arrays para almacenar los IDs de las facturas y los montos a imputar
    let facturas = [];

    // Recorrer cada fila de la tabla en modalFacturas
    $('#modalFacturas tbody tr').each(function() {
        const facturaId = $(this).find('.imputarMonto').data('factura-id');
        const montoImputado = parseFloat($(this).find('.imputarMonto').val()) || 0;

        if (montoImputado > 0) {
            facturas.push({
                id: facturaId,
                monto: montoImputado
            });
            console.log(facturas)
        }
    });

    // Agregar los inputs hidden a modalNuevaOp
    agregarInputsHiddenFacturas(facturas);
});

// Función para agregar inputs hidden en modalNuevaOp
function agregarInputsHiddenFacturas(facturas) {
    // Eliminar cualquier input hidden previamente agregado para las facturas
    $('#facturasImputadasContainer').empty();

    // Recorrer el array de facturas y crear inputs hidden
    facturas.forEach(function(factura, index) {
        // Crear un input hidden para el id de la factura
        const inputId = `<input type="hidden" name="facturas[${index}][id]" value="${factura.id}">`;
        
        // Crear un input hidden para el monto a imputar
        const inputMonto = `<input type="hidden" name="facturas[${index}][monto]" value="${factura.monto}">`;

        // Agregar los inputs al contenedor en modalNuevaOp
        $('#facturasImputadasContainer').append(inputId, inputMonto);
    });
}