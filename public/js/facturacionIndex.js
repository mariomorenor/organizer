var $table = $('#table');

$table.bootstrapTable({
    locale: 'es_SP',
    showColumns: true,
    url: '/pagos'
});

function accionesFormatter(value,row) {
    return '<button title="Detalles" class="btn btn-primary btn-sm">'+
            '<i class="fas fa-info-circle fa-2x"></i>'+
            '</button>'+
            '<button title="facturar" class="ml-1 btn btn-danger btn-sm">'+
            '<i class="fas fa-file-invoice-dollar fa-2x"></i>'+
            '</button>'
            
}