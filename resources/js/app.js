import btable from 'bootstrap-table';
import btable_LOCALE from 'bootstrap-table/dist/bootstrap-table-locale-all';


require('./bootstrap');
window.Swal = require('sweetalert2');
require('./datepicker')
window.moment = require('moment')
require('moment/locale/es');
require('tableexport.jquery.plugin');

require('bootstrap-table/dist/extensions/export/bootstrap-table-export')

require('@fortawesome/fontawesome-free/js/all')

$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"').attr('content')
    }
})

