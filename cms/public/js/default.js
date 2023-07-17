$(document).ready(function () {

    if($('.panel-body').length){
        $('.panel-body').fadeIn(800);
    }

    // tabs
    $('.nav-tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    if($('.selectall').length>0) {
        $('.selectpicker').selectpicker({
            actionsBox:true,
            selectAllText:'Hamısını seçmək',
            deselectAllText:'Seçilmişləri ləğv et',
        });
    }
    $('[data-toggle="tooltip"]').tooltip();

    // menu
    $("#menu").metisMenu();

    if($('.datepicker').length>0) {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            language: 'az',
            orientation: "bottom right",
            todayHighlight:true
        });
    }

    if($('.summernote').length) {
        $('.summernote').summernote({
            tabsize: 2,
            height: 300,
        });
    }

    // slug title
    function onChange($this) {
        var input = $this,
            lang = input.closest('.tab-pane').attr('data-lang'),
            dInput = input.val();
        $.ajax({
            type: "POST",
            url: '/cms/pages/slug/',
            dataType: 'json',
            data: {slug:dInput, lang:lang},
            success: function(data) {
                input.closest('.tab-pane').find('.slug').val(data.text);
            }
        });
    }
    $('.title')
        .change(function(){
            onChange($(this));
        })
        .keyup(function(){
            onChange($(this));
        });
});


