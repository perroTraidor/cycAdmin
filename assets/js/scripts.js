$(document).ready(function() {

    // Función para inicializar autocompletar de proveedor en cualquier modal
    function inicializarAutocomplete(modal, autocompleteField, hiddenField) {
        var autocompleteInput = modal.find(autocompleteField);  // Busca el campo de autocompletar dentro del modal
        var hiddenInput = modal.find(hiddenField);  // Campo oculto donde se almacena el ID del proveedor seleccionado

        // Si el campo de autocompletar existe en el modal
        if (autocompleteInput.length) {
            autocompleteInput.autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '/index.php?entidad=proveedores&accion=search',  // URL para buscar proveedores
                        dataType: 'json',
                        data: {
                            term: request.term  // Término de búsqueda ingresado por el usuario
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item.nombre,  // Mostrar el nombre del proveedor
                                    value: item.id  // Asignar el ID del proveedor como valor
                                };
                            }));
                        }
                    });
                },
                select: function(event, ui) {
                    hiddenInput.val(ui.item.value);  // Asignar el ID del proveedor al campo oculto
                    autocompleteInput.val(ui.item.label);  // Mostrar el nombre del proveedor en el campo de autocompletar
                    cargarDatosProveedor(ui.item.value, modal);  // Cargar datos del proveedor en el modal
                    return false;  // Evitar que el campo de autocompletar se sobrescriba con el ID
                }
            });
        }
    }

    // Función para cargar datos del proveedor seleccionado en el modal
    function cargarDatosProveedor(proveedorId, modal) {
        console.log('Proveedor ID:', proveedorId);
        $.ajax({
            url: '/index.php',
            method: 'GET',
            data: {
                entidad: 'proveedores',
                accion: 'obtenerDatosProveedor',
                id: proveedorId
            },
            dataType: 'json',  // Esto asegura que jQuery procese la respuesta como JSON automáticamente
            success: function(response) {
                console.log(response);  // Aquí imprimimos directamente la respuesta para verificarla
    
                if (response.error) {
                    alert(response.error);
                } else {
                    // Completar los campos del modal con los datos del proveedor
                    modal.find('#nombre').val(response.nombre);
                    modal.find('#domicilio').val(response.domicilio);
                    modal.find('#telefono').val(response.telefono);
                    modal.find('#cuit').val(response.cuit);
                    modal.find('#email').val(response.email);
                }
            },
            error: function() {
                alert('Error al obtener los datos del proveedor.');
            }
        });
    }


// Función para cargar los datos del documento (compra o pago)
function cargarDatosDoc(docId, docNro, tipoDoc, proveedor) {
    let url, modal;

    // Verifica si es una compra o un pago para cargar la URL y el modal correcto
    if (tipoDoc === 'compra') {
        url = '/index.php?entidad=compras&accion=obtenerDatosCompra';
        modal = $('#modalVerCompra');  // Modal específico para compras
        data = { id:docId };
    } else if (tipoDoc === 'pago') {
        url = '/index.php?entidad=ops&accion=obtenerDatosOp';
        modal = $('#modalVerOp');  // Modal específico para pagos
        data = { id:docNro };
    }
    
    console.log('Doc ID:', docId, 'Tipo:', tipoDoc, 'Proveedor:', proveedor, 'Doc nro:', docNro);
    
    // Realiza la petición AJAX para obtener los datos
    $.ajax({
        url: url,
        method: 'GET',
        data: data,
        dataType: 'json',  // Esto asegura que jQuery procese la respuesta como JSON automáticamente
        success: function(response) {
            console.log(response);  // Verifica la respuesta en la consola

            if (response.error) {
                alert(response.error);
            } else {
                // Completa los campos del modal según sea compra o pago
                if (tipoDoc === 'compra') {
                    modal.find('#proveedor').val(proveedor);
                    modal.find('#proveedor_id').val(response.proveedores_id_prov);
                    modal.find('#letra').val(response.letra);
                    modal.find('#suc').val(response.suc);
                    modal.find('#fecha').val(response.fecha);
                    modal.find('#numero').val(response.numero);
                    modal.find('#neto').val(response.neto);
                    modal.find('#iva21').val(response.iva21);
                    modal.find('#exento').val(response.exento);
                    modal.find('#total').val(response.total);
                } else if (tipoDoc === 'pago') {
                
                     // Populate payment table
                const tableBodyPago = $('#tablaFormasPago tbody');
                tableBodyPago.empty();  // Clear existing rows

                response.formas_pago.forEach(function(formaPago) {
                    const row = `<tr data-id="${formaPago.id}">
                        <td>${formaPago.forma}</td>
                        <td>${formaPago.importe}</td>
                    </tr>`;
                    tableBodyPago.append(row);
                });

                // Llenar la tabla de imputaciones
                const tableBodyImputaciones = $('#tablaImputaciones tbody');
                tableBodyImputaciones.empty();  // Limpiar filas anteriores
                console.log(response.imputaciones)
                response.imputaciones.forEach(function(imputacion) {
                    const row = `<tr>
                        <td>${imputacion.numero_factura}</td>
                        <td>${imputacion.fecha_factura}</td>
                        <td>${imputacion.importe_imputado}</td>
                    </tr>`;
                    tableBodyImputaciones.append(row);
                });

                // Completar los campos restantes
                $('#importe').val(response.total);
                $('#numero').val(response.numero);
                $('#proveedor').val(proveedor);
                $('#proveedores_id_prov').val(response.proveedores_id_prov);
                $('#fechaop').val(response.fechaop);
                }

                // Mostrar el modal correspondiente
                modal.modal('show');
            }

        },
        error: function() {
            alert('Error al obtener los datos del documento.');
        }
    });
}

// Capturar el click en el botón "Ver"
$(document).on('click', '.btnVerDoc', function(e) {
    e.preventDefault();

    // Obtener el ID del documento y el tipo de documento (compra o pago) de los atributos data
    var docId = $(this).data('id');
    var docNro = $(this).data('nro');
    var tipoDoc = $(this).data('tipo');
    var proveedor = $(this).data('proveedor');
    
    console.log('Tipo de Documento:', tipoDoc, proveedor, docNro); // Verifica que el tipo de documento se está capturando correctamente

    // Cargar los datos del documento y mostrar el modal correspondiente
    cargarDatosDoc(docId, docNro, tipoDoc, proveedor);
});

$('#modalNuevaOp').on('show.bs.modal', function (e) {
    // Realizar la solicitud AJAX para obtener el último número
    var modal = $(this);
    $.ajax({
        url: '/index.php?entidad=ops&accion=obtenerUltimoNumero',  // Asegúrate de que la URL coincida con tu sistema de rutas
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);
            // Verificar si se recibió el último número
            if (response.ultimo_numero) {
                console.log("Ultimo numero recibido: " + response.ultimo_numero);
                // Asignar el número al campo correspondiente
                modal.find('#numero').val(response.ultimo_numero);
            } else {
                alert('Error: ' + response.error);
            }
        },
        error: function() {
            alert('Error en la comunicación con el servidor.');
        }
    });
});




    // Capturar el evento de mostrar cualquier modal y aplicar autocompletado
    $('.modal').on('shown.bs.modal', function(event) {
        var modal = $(this);  // El modal que está siendo mostrado



        // Inicializar autocompletar para los campos en el modal
        inicializarAutocomplete(modal, '#proveedor_autocomplete_compra', '#proveedor_id_compra');
        inicializarAutocomplete(modal, '#proveedor_autocomplete_resumen', '#proveedor_id_resumen');
        inicializarAutocomplete(modal, '#proveedor_autocomplete_buscar', '#proveedor_id_buscar');
        inicializarAutocomplete(modal, '#proveedor_autocomplete_op', '#proveedor_id_op');
    });

});

