var $table = $('#table');



$table.bootstrapTable({
    height: '380',
    url: '/pagos/'+$('#codigo').val(),
    sortable: true,
    queryParams:{
        tipo_transaccion: 'all'
    }
   
});

function buscar_por_Filtro(option='all') {
    $table.bootstrapTable("refreshOptions",{
        queryParams:{
            tipo_transaccion: option
        }
    })
}