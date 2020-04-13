var $table = $('#table');

$table.bootstrapTable({
    locale: 'es_SP',
    showColumns: true,
    url: '/pagos',
    height: '800'
});

function accionesFormatter(value,row) {
    return '<a role="button" href="/pagos/'+row.codigo+'" title="Detalles" class="btn btn-primary btn-sm">'+
            '<i class="fas fa-info-circle fa-2x"></i>'+
            '</a>'+
            '<button title="facturar" class="ml-1 btn btn-danger btn-sm">'+
            '<i class="fas fa-file-invoice-dollar fa-2x"></i>'+
            '</button>'
            
}