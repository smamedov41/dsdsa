$(document).ready(function () {

    var _noDataTable = $('#nestable'),
        _urlAction = _noDataTable.attr('data-url'),
        _tokenAction = _noDataTable.attr('data-token');

    /***********************************************************************************
     * change status
     */
    $(document).on('click', '.toggle-group label, .toggle-handle', function(e){
        e.preventDefault();

        var _this = $(this),
            _parent = _this.closest('.toggle'),
            _id = _this.closest('li').attr('data-id'),
            _li = _this.closest('li'),
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
                    _li.attr('data-sort', _status);
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
            _id = $(this).closest('li').attr('data-id');

        _deleteModal.attr('data-id', _id).modal('show');
    });

    $(document).on('click', '#btnYes',  function (e) {
        e.preventDefault();

        var _deleteModal = $('#deleteModal'),
            _id = _deleteModal.attr('data-id');

        $.ajax({
            type: "GET",
            url: _urlAction + '/deleteitem/' + _id + '/' + _tokenAction,
        }).done(function(){
            $('li[data-id=' + _id + ']').remove();
        });

        _deleteModal.modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });
    /**
     * COMMENT END
     ************************************************************************************/

    /***********************************************************************************
     * menu ordering and change parent
     */
    var updateOutput = function(e) {
        var list = e.length ? e : $(e.target);
        if(window.JSON) {
            var data = JSON.stringify(list.nestable('serialize'));//, null, 2));
            //var data = list.nestable('serialize');//, null, 2));
            //console.log(JSON.parse(data))
            $.ajax({
                type: "POST",
                url: '/cms/pages/ordering',
                dataType: 'json',
                data: {ordering:data}
            });
        }
    };
    $('#nestable').nestable().on('change', updateOutput);

    $('#nestable-menu').on('click', function(e) {
        e.preventDefault();

        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });

    /**
     * COMMENT END
     ************************************************************************************/

});


