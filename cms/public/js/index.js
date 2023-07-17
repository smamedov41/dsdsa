$(document).ready(function () {

    var _noDataTable = $('.table'),
        _urlAction = _noDataTable.attr('data-url'),
        _tokenAction = _noDataTable.attr('data-token');

    /***********************************************************************************
     * Filter form
     */
    $(document).on('change', '#ticket-filter', function(){
        var _this = $(this);
        _this.closest('form').submit();
    });
    /**
     * COMMENT END
     ************************************************************************************/

    /***********************************************************************************
     * change status
     */
    $(document).on('click', '.toggle-group label, .toggle-handle', function(e){
        e.preventDefault();

        var _this = $(this),
            _parent = _this.closest('.toggle'),
            _id = _this.closest('tr').attr('data-id'),
            _td = _this.closest('td'),
            _status = 1;

        if(_parent.is('.off')) {
            _status = 2;
        } else {
            _status = 1;
        }


        $.ajax({
            type: "POST",
            url: _urlAction + '/changestatus/' + _id + '/' + _tokenAction,
            data: {status: _status},
            success: function(data) {
                if(data == '1') {
                    _td.attr('data-sort', _status);

                    if(typeof table !== 'undefined'){
                        table.row(_this.closest('tr')).invalidate().draw(false);
                    }
                }
            }
        });
    });
    /**
     * COMMENT END
     ************************************************************************************/


    /***********************************************************************************
     * delete confirm
     */
    $(document).on('click', '.confirm-delete',  function (e) {
        e.preventDefault();

        var _deleteModal = $('#deleteModal'),
            _id = $(this).closest('tr').attr('data-id');

        _deleteModal.attr('data-id', _id).modal('show');
    });

    $(document).on('click', '#btnYes',  function (e) {
        e.preventDefault();

        var _deleteModal = $('#deleteModal'),
            _id = _deleteModal.attr('data-id');

        $.ajax({
            type: "GET",
            url: _urlAction + '/deleteitem/' + _id + '/' + _tokenAction,
        });

        _deleteModal.modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();

        $row = $('tr[data-id=' + _id + ']');

        if(typeof table !== 'undefined'){
            table.row( $row.closest('tr') ).remove().draw();
        } else {
            $row.remove();
        }
    });
    /**
     * COMMENT END
     ************************************************************************************/
});


