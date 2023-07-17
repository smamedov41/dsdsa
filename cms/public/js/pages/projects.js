$(function(){

    $("#succeeded").sortable({
        opacity: 0.6,
        cursor: 'move',
        update: function () {
            var order = $(this).sortable("serialize") + '&action=updateRecordsListings';
            $.post("/cms/projects/orderphoto", order, function (theResponse) {
                $("#contentRight").html(theResponse);
            });
        }
    });


    $('#file').change(function(){

        $('.form-group .bar').show();
        var f = document.getElementById('file'),
            pb = document.getElementById('pb'),
            pt = document.getElementById('pt');

        app.uploader({
            files:f,
            progressBar: pb,
            progressText: pt,
            processor: '/cms/projects/uploadphoto',
            finished: function(data){
                var uploads = document.getElementById('uploads'),
                    succeeded = document.getElementById('succeeded'),
                    failed = document.getElementById('failed'),
                    linkdelete,
                    anchor,
                    span,
                    img,
                    x;

                if(data.failed.length){
                    failed.innerHTML = '<p><strong>Şəkil aşağıdakı səbəblərə görə yüklənmədi:</strong></p>';
                }
                uploads.textContent = '';
                for(x=0; x < data.succeeded.length; x = x + 1){

                    img = document.createElement('img');
                    img.src = '/upload/Image/projects/' + data.succeeded[x].file;
                    img.height = '100';

                    linkdelete = document.createElement('a');
                    linkdelete.href = '/cms/projects/photodelete/' + data.succeeded[x].id +'/'+ $("#sid").val();
                    linkdelete.className = 'delete';

                    anchor = document.createElement('div');
                    anchor.className= "img ui-sortable-handle";
                    anchor.setAttribute("id", "recordsArray_" + data.succeeded[x].id);
                    anchor.appendChild(img);
                    anchor.appendChild(linkdelete);

                    succeeded.appendChild(anchor);
                }

                for(x=0; x < data.failed.length; x = x + 1){
                    span = document.createElement('span');
                    span.textContent = data.failed[x].name;
                    failed.appendChild(span);
                }

                uploads.appendChild(succeeded);
                uploads.appendChild(failed);

                setTimeout(function(){
                    $('.form-group .bar').hide().find('.bar-fill').css('width', '0');
                }, 2000);
            },
            error: function(){
                //console.log('Not wording');
            }
        });

    });

    $(document).on('click', '.delete', function(event){
        event.preventDefault();
        var thiss = $(this);
        thiss.closest('.img').remove();
        var url = thiss.attr('href');
        $.ajax(url);
    });
});