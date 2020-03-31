var $calendario = $('#datepicker');
var $table = $('#table');
var $LabelTotalReses = $('#labelTotalReses');
var $total_Reses = 0;
var $modified = false;
var $ultimaFecha = moment().format('LL');

$('#fecha').val(moment().format('YYYY/MM/DD'))

setTimeout(function () {eliminar_color_amarillo_datepicker_maldita_sea()  }, 1);

$table.bootstrapTable({
    queryParams:{
        fecha: $('#fecha').val(),
    },
    // responseHandler: function (res) {
    //     console.log(res)
    //   }
});

$LabelTotalReses.text($total_Reses)

$calendario.datepicker({
    duration: "slow",
    maxDate: 0,
    minDate: moment('20200323').format('LL'),
    onSelect: function (fecha, calendario) {
        setTimeout(function () {eliminar_color_amarillo_datepicker_maldita_sea()  }, 1);
        if ($modified) {
            Swal.fire({
                icon: 'info',
                title: 'Atención!',
                text: 'Si aún no ha guardado la Lista al cambiar de Fecha se perderá',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Continuar',
                cancelButtonColor: 'purple',
            }).then((result) => {
                if (result.value) {
                    $table.bootstrapTable('refresh');
                    $ultimaFecha = moment($calendario.datepicker('getDate')).format('LL')
                    
                } else {
                    setTimeout(function () {eliminar_color_amarillo_datepicker_maldita_sea()  }, 1);
                    $calendario.datepicker('setDate', $ultimaFecha)
                }
            })
        } else {
            $table.bootstrapTable('refresh');
            $ultimaFecha = moment($calendario.datepicker('getDate')).format('LL')
        }
        $('#fecha').val(moment($calendario.datepicker('getDate')).format('YYYY/MM/DD'))
    }
});

function codigoFormatter(value) {
    return '<input name="codigo[]" value="'+value+'" hidden>'+value
}

function cantidadFormatter(value, row, index) {
    $LabelTotalReses.text($table.bootstrapTable('getData').length);
    
    return '<div class="d-flex">'+
            '<div class="my-auto mr-2">'+
                '<button type="button"  onclick="actualizarCantInput(' + index + ',' + 3 + ')" style="width: 2.3rem" class="btn btn-sm btn-outline-primary mb-1 border border-dark">+5</button>'+
                '<button type="button" onclick="actualizarCantInput(' + index + ',' + 4 + ')" class=" border border-dark btn btn-sm btn-outline-warning text-dark">- 5</button>'+
            '</div>'+
            '<input name="cantidad[]" id="input_' + index + '" type="text" readonly class="form-control input_cantidad my-auto" style="width: 4rem" min="1" value="1" required>'+
            '<div class="ml-2">'+
                '<button type="button" onclick="actualizarCantInput(' + index + ',' + 1 + ')" class="btn btn-primary border border-dark btn-sm mb-1">+</button>'+
                '<button  onclick="actualizarCantInput(' + index + ',' + 2 + ')" type="button" class="btn btn-warning border border-dark btn-sm">&#8211</button>'+
            '</div>'+
        '</div>'
}

function fechaFormatter(value, row) {
    return moment($calendario.datepicker('getDate')).format('LL');
}

function observacionFormatter(value, row) {

    return '<input type="text" name="observacion[]" class="form-control" value="">'
}

function sumarReses(numFilas) {
    $modified = true
    for (let index = 0; index < numFilas; index++) {
        $total_Reses += Number(document.getElementById('input_' + index).value)
    }
    $LabelTotalReses.text($total_Reses);
    $total_Reses = 0;
}

function actualizarCantInput(i, btn) {
    v = document.getElementById('input_' + i).value;
    switch (btn) {
        case 1:
            v++;
            break;
        case 2:
            v--;
            break;
        case 3:
            v = Number(v) + 5;
            break;
        case 4:
            v = Number(v) - 5;
            break;
    }
    document.getElementById('input_' + i).value = v < 1 ? 1 : v;
    sumarReses($table.bootstrapTable('getData').length)
}

function accionesFormatter(value, row) {
    return '<button type="button" onclick="eliminar_Registros(' + false + "," + "'" + row.codigo + "'" + ')" class="btn btn-danger btn-sm"><svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
        '<path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>' +
        '<path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>' +
        '</svg>'
}

function eliminar_Registros(all = false, value) {
    if (all) {
        $table.bootstrapTable('removeAll');
    } else {
        $table.bootstrapTable('remove', {
            field: 'codigo',
            values: value
        })
    }
    $modified = true;
}

$('#codigo_a_insertar').keyup(function (e) { 
 
    if(e.which == 13){
        insertar_Registro();
        
    }
});
function insertar_Registro() {
    $modified = true
    var codigos = $table.bootstrapTable('getData');
    var existe = false;
    codigos.forEach(element => {
        if ($('#codigo_a_insertar').val() == element.codigo) {
            existe = true;
        }
    });
    if (!existe) {
        $.get({
            url: '/clientes/comprobarCliente/' + $('#codigo_a_insertar').val(),
            success: function (response) {
               
                $table.bootstrapTable('insertRow', {
                    index: $table.bootstrapTable('getData').length,
                    row: {
                        codigo: response.codigo,
                    }
                })
                $table.bootstrapTable('scrollTo', 'bottom');
                $('#codigo_a_insertar').val('')
            },
            error: function (error) {
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

function eliminar_color_amarillo_datepicker_maldita_sea() {
    $(document).find('a.ui-state-highlight').removeClass('ui-state-highlight');
}

function enviarFormulario() {
    $.post({
        url: $('#formAgregar_Lista').attr('action'),
        data: $('#formAgregar_Lista').serialize(),
        success: function (response) {
            console.log(response)
            Swal.fire({
                icon:'success',
                title:"Lista Guardada Correctamente!",
                timer: 1500
            }).then(()=>{
                window.location = '/listas'
            });
            
          },
          error: function (error) {
            console.log(error)
              Swal.fire({
                  icon:'error',
                    title: 'Error!',
                    text: 'Siguientes Códigos: '+error.responseJSON + ' ya Existen en la Fecha Elegida.'
              })
            }
    });
}
