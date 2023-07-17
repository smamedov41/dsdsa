$(document).ready(function () {
    var _dataTable = $('#dataTables'),
        _url = _dataTable.attr('data-url'),
        _token = _dataTable.attr('data-token');

    /***********************************************************************************
     * DataTable
     */
    var _defaults = {
        "oLanguage": {"sUrl": "/cms/langs/datatable_az.txt"},
        "deferRender": true,
        columnDefs: [
            { targets: 'no-sort', orderable: false }
        ]
    };

    if($('.table-ordering').length>0){
        var _ordering = {
            "rowReorder": true,
            columnDefs: [
                { targets: 0, visible: false },
                { targets: 'no-sort', orderable: false }
            ]
        };
        _defaults = $.extend( {}, _defaults, _ordering );
    }

    if($('.table-nodefaultorder').length>0){
        var _ordering = {
            order: [],
        };
        _defaults = $.extend( {}, _defaults, _ordering );
    }

    if($('.table-nopaging').length>0){
        var _nopaging = {
            "paging": false
        };
        _defaults = $.extend( {}, _defaults, _nopaging );
    }

    var table = _dataTable.DataTable(_defaults);

    table.on('row-reorder', function (e, diff, edit) {
        var page = table.page.info();
        var arr = [];
        for (var i = 0, ien = diff.length; i < ien; i++) {
            var rowData = table.row(diff[i].node).data();
            arr[rowData[1]] = (page.page*page.length) + diff[i].newPosition + 1;
        }
        //console.log(arr)
        // $('.row.bg-title').html(result);

        $.ajax({
            type: "POST",
            url: _url + '/ordering/'+_token,
            data: {arr: arr}
        });
    });
    /**
     * COMMENT END
     ************************************************************************************/

});


