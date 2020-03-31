var $table = $('#table');
var $buttonEliminar = $('#remove');
var selections = [];


$table.bootstrapTable({});

$table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
    selections = getIdSelections();
    $buttonEliminar.prop('disabled', !$table.bootstrapTable('getSelections').length)
})

$buttonEliminar.click(function () {
    var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
        return row.codigo
    })
    Swal.fire({
        icon: 'warning',
        title: 'Eliminar Registro(s)',
        text: 'Los Registros Eliminados no podrán ser Recuperados',
        confirmButtonColor: 'green',
        cancelButtonColor: 'red',
        showCancelButton: true,
        confirmButtonText: 'Sí, Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            eliminar_Cliente();
        }
    });



})

function getIdSelections() {
    return $.map($table.bootstrapTable('getSelections'), function (row) {
        return row.codigo
    })
}

function operateFormatter(value, row) {
    return '<a role="button" href="/clientes/' + row.codigo + '/edit" class="btn btn-warning border border-dark btn-sm ml-2"><svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
        '<path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"/>' +
        '<path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd"/>' +
        '</svg></a'
}

function eliminar_Cliente() {
    $.ajax({
        url: '/clientes/' + 1,
        method: 'DELETE',
        data: {
            codigos: selections
        },
        success: function (response) {

            Swal.fire({
                icon: 'success',
                title: 'Registro Eliminado Correctamente!',
                timer: 1500
            })
            $table.bootstrapTable('remove', {
                field: 'codigo',
                values: selections
            })
            $buttonEliminar.prop('disabled', !$table.bootstrapTable('getSelections').length)

        },
        error: function (error) {
            console.log(error)
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Se Produjo un Error Intente Nuevamente',
                timer: 1400,
            });
        }
    });
}

function customSearch(data, text) {
    return data.filter(function (row) {
        return row.codigo.toUpperCase().startsWith(text.toUpperCase());
    })
}

