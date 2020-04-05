import bootstrapTable from 'bootstrap-table';
import btable_LOCALE from 'bootstrap-table/dist/bootstrap-table-locale-all';


require('./bootstrap');
window.Swal = require('sweetalert2');
require('./datepicker')
window.moment = require('moment')
require('moment/locale/es');

require('@fortawesome/fontawesome-free/js/all')
require('tableexport.jquery.plugin/tableExport');
require('bootstrap-table/dist/extensions/export/bootstrap-table-export')

$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"').attr('content')
    }
})

