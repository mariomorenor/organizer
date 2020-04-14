

var $table = $('#table');
var $inputCodigo = $('#codigo_a_insertar');

$table.bootstrapTable({
    locale:'es_SP',
    height:'600',
    toolbar: '#toolbar',
    
});

$('#codigo_a_insertar').keyup(function (e) { 

    if(e.which == 13){
        e.preventDefault();
        if($inputCodigo.val()=="") return
        insertarCodigo();
    }
});

$('#formPagos').submit(function (e) { 
    if ($table.bootstrapTable("getData").length < 1) {
        e.preventDefault();
        
    } 
});

function insertarCodigo() {
        var codigos = $table.bootstrapTable('getData');
        var existe = false;
        codigos.forEach(element => {
            if ($('#codigo_a_insertar').val() == element.codigo) {
                existe = true;
            }
        });
        if (!existe) {
            $.get({
                url: '/pagos/comprobarSaldo/' + $('#codigo_a_insertar').val(),
                success: function (response) {
                 
                  if (response === '') {
                      Swal.fire({
                          icon: 'info',
                          title: 'No Existe saldo pendiente para el codigo '+ $('#codigo_a_insertar').val()
                      })
                  }else{
                    $table.bootstrapTable('insertRow', {
                        index: $table.bootstrapTable('getData').length,
                        row: {
                            codigo: response.codigo,
                            saldo: response.saldo
                        }
                    })
                    $table.bootstrapTable('scrollTo', 'bottom');
                    $('#codigo_a_insertar').val('')
    
                    $('.calendar').datepicker({
                     
                    });
                    $('.calendar').datepicker("setDate",new Date());
                  }

                },
                error: function (error) {
                    console.log(error)
                    Swal.fire({
                        icon: 'error',
                        title: 'El Código "' + $('#codigo_a_insertar').val() + '" No Existe',
                        text: 'Revise que el Código Ingresado Existe en la Base de Datos'
                    })
                }
            });
    
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'El Código ' + $('#codigo_a_insertar').val() + ' Ya está en la Lista',
                timer: 2000
            })
        }
    

}


function accionesFormatter(value,row) {
    return '<button type="button" onclick="eliminarFila('+ "'"+row.codigo+ "'"+')" class="btn btn-danger btn-sm">'+
            '<i class="fas fa-minus-circle"></i>'+
            '</button>';
}

function eliminarFila(val) {
    $table.bootstrapTable('remove',{
        field: 'codigo',
        values: val
    });
}

function codigoFormatter(value,row) {
    
    return '<input type="text" hidden name="codigo[]" required value="'+value+'" >'+value
}

function dineroFormatter(value,row) {
    return '<input type="number" name="dinero[]" step="0.01" required class="form-control text-center" placeholder="$" >'
}
function resesFormatter(value,row) {
    return '<input type="number" name="reses[]" step="1" class="form-control text-center" >'
}

function fechaFormatter(value, row) {
    return '<input type="date" name="fecha[]" value="'+moment().format('YYYY-MM-DD')+'" required class="form-control text-center" >'
}

function descripcionFormatter() {
    return '<input type="text" class="form-control" name="descripcion[]" placeholder="Observaciones">'
}



// function enviarFormulario() {
//    $('#formPagos').submit(function (e) { 
    
//    });
// }