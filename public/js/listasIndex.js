

var $table = $('#table');
var $calendar = $("#datepicker");
var $Fecha_Titulo = $('#fechaTitle');
var $Fecha_Inicio = $('#fechaInicio');
var $Fecha_Fin = $('#fechaFin');
var f = new Date();
var $total_codigos=0;
var $optionFechas = true // True significa que ha elegido una Fecha Especifica, False - Rango de fechas

$Fecha_Inicio.val(moment().subtract(1,'days').format('LL'))
$Fecha_Fin.val(moment().format('LL'))

$('#input_fecha_actualizar').val('ss');
$table.bootstrapTable({
    queryParams:{
        fecha: moment(f).format('YYYY-MM-DD'),
     
    },
    responseHandler: function (res) {
        // console.log(res)
        return res;
      }

});

$calendar.datepicker({
    maxDate:0,
    onSelect: function (fecha, calendario) {
        
        setTimeout(function () {eliminar_color_amarillo_datepicker_maldita_sea()  }, 1);
        $Fecha_Titulo.empty().append(fecha);
        var day = addZero(calendario.selectedDay);
        var month = addZero(calendario.selectedMonth + 1);
        var year = addZero(calendario.selectedYear);
        $calendar.datepicker( "option", "appendText", moment(year+month+day).format('LL'));
        f = moment(year+month+day).format('YYYY-MM-DD')
        $table.bootstrapTable("refreshOptions",{
            queryParams:{
                fecha: f
            },
        })
     
       
    },
});
$calendar.datepicker( "option", "appendText", moment().format('LL'));

$Fecha_Inicio.datepicker({
    maxDate: moment().subtract(1,'days')._d,
    minDate: moment('20200320').format('LL'),
    onSelect: function (fecha,calendario) {
       var day = addZero(calendario.selectedDay);
       var month = addZero(calendario.selectedMonth + 1);
       var year = addZero(calendario.selectedYear);
        $Fecha_Fin.datepicker("option","minDate",moment(year+month+day).add(1,'days').format('LL'))
    }
});

$Fecha_Fin.datepicker({
    maxDate: moment()._d,
    minDate: moment()._d,
    onSelect: function (fecha, calendario) {  
        var day = addZero(calendario.selectedDay);
        var month = addZero(calendario.selectedMonth + 1);
        var year = addZero(calendario.selectedYear);
         $Fecha_Inicio.datepicker("option","maxDate",moment(year+month+day).subtract(1,'days').format('LL'))

    }
});

function addZero(valor) {
    return nuevoValor = valor < 10 ? '0'+valor: valor;
}

$('.f').click(function (e) {
    if ($('input[name="labelFecha"]:checked').val() == 2) {
        $('#btnbuscar').removeAttr('disabled')
        $calendar.datepicker( "option", "disabled", true );
        $optionFechas = false;
    }else{
        $('#btnbuscar').attr('disabled','disabled');
        $calendar.datepicker( "option", "disabled", false );
        $optionFechas = true
    }
  });

function codigoFootterFormatter(data) {
    $total_codigos = data.length;
    return "Total Reses:";
}

function cantidadFooterFoormatter(data) {
    return data.map(function (row) {
        return row['cantidad'];
      }).reduce(function (suma,valor_actual) { 
            return suma+valor_actual;
       },0);
}

function fechaFooterFormatter(data) {
    return "Total Registros: "+$total_codigos;
}

setTimeout(function () {eliminar_color_amarillo_datepicker_maldita_sea()  }, 1);

function eliminar_color_amarillo_datepicker_maldita_sea() {
    $(document).find('a.ui-state-highlight').removeClass('ui-state-highlight');
}   

function fechaFormatter(value,row) {
    return moment(value).format('ll');
}

function accionesFormatter(value,row) {
  
    return '<button type="button" title="Eliminar Registro" onclick="eliminar_Registros('+false+','+"'"+row.cliente_codigo+"'"+')" class=" border border-dark btn btn-danger btn-sm"><svg class="bi bi-trash-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'+
    '<path fill-rule="evenodd" d="M2.5 1a1 1 0 00-1 1v1a1 1 0 001 1H3v9a2 2 0 002 2h6a2 2 0 002-2V4h.5a1 1 0 001-1V2a1 1 0 00-1-1H10a1 1 0 00-1-1H7a1 1 0 00-1 1H2.5zm3 4a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7a.5.5 0 01.5-.5zM8 5a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7A.5.5 0 018 5zm3 .5a.5.5 0 00-1 0v7a.5.5 0 001 0v-7z" clip-rule="evenodd"/>'+
  '</svg>'+
  '<button type="button" data-toggle="modal" data-backdrop="static" onclick="mostrar_Datos_modal_Actualizar('+"'"+row.cliente_codigo+"'"+')" data-target="#modalActualizar_Registro" class="btn btn-warning border border-dark btn-sm ml-1">'+
  '<svg class="bi bi-pencil-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'+
      '<path d="M15.502 1.94a.5.5 0 010 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 01.707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 00-.121.196l-.805 2.414a.25.25 0 00.316.316l2.414-.805a.5.5 0 00.196-.12l6.813-6.814z"/>'+
      '<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 002.5 15h11a1.5 1.5 0 001.5-1.5v-6a.5.5 0 00-1 0v6a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5H9a.5.5 0 000-1H2.5A1.5 1.5 0 001 2.5v11z" clip-rule="evenodd"/>'+
  '</svg>'+
'</button>';
// +
// '<a type="button" role="button" class="btn btn-sm btn-success ml-1 border border-dark" href="pagos/'+row.codigo+'">'+
// '<svg class="bi bi-info-circle-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'+
// '<path fill-rule="evenodd" d="M8 16A8 8 0 108 0a8 8 0 000 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>'+
// '</svg>'+
// '</a>'
}

function eliminar_Registros(all=false,v='') {
    if(all){
        Swal.fire({
            icon: 'warning',
            title: 'Eliminar TODOS los registros FECHA: '+moment($calendar.datepicker("getDate")).format('LL')+'?',
            text: 'Si realiza esta acción, los datos se pe+rderán para siempre.',
            confirmButtonText: 'Sí, Continuar',
            confirmButtonColor: 'red',
            showCancelButton: true,
            cancelButtonText:'Cancelar',
            cancelButtonColor: 'purple'
        }).then((result)=>{
            if(result.value){
                eliminar(1,1)  
            }
        })
    }else{
        Swal.fire({
            icon: 'warning',
            title: 'Eliminar el Registro '+v+'?',
            text: 'Si realiza esta acción, los datos se perderán para siempre.',
            confirmButtonText: 'Sí, Continuar',
            confirmButtonColor: 'red',
            showCancelButton: true,
            cancelButtonText:'Cancelar',
            cancelButtonColor: 'purple'
        }).then((result)=>{
            if(result.value){
                eliminar(v)
            }
        })
    }
}

function eliminar(v,all=0) {
    $.ajax({
        url: '/listas/'+v,
        method: 'DELETE',
        data: {
            fecha: moment(f).format('YYYY-MM-DD'),
            codigos: $table.bootstrapTable('getData').map(function (row) {
                return row.cliente_codigo;
              }),
            todos: all
        } ,
        success: function (response) {
            // console.log(response);
            if (all==0) { 
                $table.bootstrapTable('remove',{
                    field: 'cliente_codigo',
                    values: v
                });
            }else{
                $table.bootstrapTable('removeAll');
            }
          },
        error: function (error) {
              console.log(error);
              Swal.fire({
                  icon:'error',
                  title:'Error!',
                  text: 'Se produjo un Error, Intente nuevamente.'
              })
            }
    });
}

function mostrar_Datos_modal_Actualizar(codigo) { 
    var row = $table.bootstrapTable('getRowByUniqueId', codigo)
    $('#input_fecha_actualizar').val(moment(f).format('YYYY-MM-DD'));
    $('#codigo_actualizar').text(row.cliente_codigo);
    $('#input_cantidad_actualizar').val(row.cantidad);
    $('#input_descripcion_actualizar').val(row.descripcion); 
}

function actualizarRegistro(codigo) {
    $.ajax({
        url: '/listas/'+codigo,
        method: 'PUT',
        data: $('#formActualizar_Registro').serialize(),
        success: function (response) {
            // console.log(response);
            Swal.fire({
                icon: 'success',
                title: 'Registro Actualizado Correctamente',
                timer:1200
            }).then(()=>{
                $('#modalActualizar_Registro').modal('hide');
                $table.bootstrapTable('refresh')
            })
          },
          error: function (error) {
              console.log(error)
            }
    });
}

function buscarPorFechas() {
    $table.bootstrapTable('refreshOptions',{
        queryParams:{
            codigo:'',
            fecha_Inicio : moment($Fecha_Inicio.datepicker("getDate")).format('YYYY-MM-DD'),
            fecha_Fin : moment($Fecha_Fin.datepicker("getDate")).format('YYYY-MM-DD'),
        }
    })
}

function buscarCodigo(rows,text) {
    return rows.filter(function (row) { 
        return row.cliente_codigo.toUpperCase().startsWith(text.toUpperCase());
     })
    
}