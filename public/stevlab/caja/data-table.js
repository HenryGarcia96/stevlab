$(function() {
    'use strict';
  
    $(function() {
      $('#dataTableCajas').DataTable({
        scrollX: true,
        "order" : [[0, 'desc']],
        rowReorder: {
          selector: 'td:nth-child(2)'
        },
        // responsive: true,
        "aLengthMenu": [
          [10, 30, 50, -1],
          [10, 30, 50, "All"]
        ],
        "iDisplayLength": 10,
        "language": {
          search: ""
        }
      });
      $('#dataTableCajas').each(function() {
        var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line form control
        var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
        search_input.attr('placeholder', 'Search');
        search_input.removeClass('form-control-sm');
        // LENGTH - Inline-Form control
        var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
        length_sel.removeClass('form-control-sm');
      });
    });

    $(function() {
      $('#dataTablePagos').DataTable({
        scrollX: true,
        "order" : [[0, 'desc']],
        rowReorder: {
          selector: 'td:nth-child(2)'
        },
        // responsive: true,
        "aLengthMenu": [
          [10, 30, 50, -1],
          [10, 30, 50, "All"]
        ],
        "iDisplayLength": 10,
        "language": {
          search: ""
        }
      });
      $('#dataTablePagos').each(function() {
        var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line form control
        var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
        search_input.attr('placeholder', 'Search');
        search_input.removeClass('form-control-sm');
        // LENGTH - Inline-Form control
        var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
        length_sel.removeClass('form-control-sm');
      });
    });
  
});