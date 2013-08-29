<!-- The fileinput-button span is used to style the file input field as button -->
<span class="btn btn-success fileinput-button">
    <i class="icon-plus icon-white"></i>
    <span>Загрузить изображение...</span>
    <!-- The file input field used as target for the file upload widget -->
    <input id="fileupload" type="file" name="files[]" multiple>
</span>
<br>
<br>
<!-- The global progress bar -->
<div id="progress" class="progress progress-success progress-striped">
    <div class="bar"></div>
</div>
<div class="alert alert-error" id="message-error" style="display: none;"></div>
<!-- The container for the uploaded files -->
<h3>Загруженные изображения:</h3>
<div id="files" class="files"><?=$content?></div>

<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    
    $('#progress').hide();
    // Change this to the location of your server-side upload handler:
    var url = '?event=photo&action=upload';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                if(file.error) {
                    $("#message-error").show().html("<p>\""+file.name+"\" "+file.error+"</p>");
                } else {
                    $('#files ul.thumbnails').append(file.view);
                }
            });
            $('#progress').slideUp(500);
        },
        progressall: function (e, data) {
            if($('#progress').css("display") != "block")
                $('#progress').slideDown(500);
            
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
      .parent().addClass($.support.fileInput ? undefined : 'disabled');
});

function delete_photo(id) {
    $("#message-error").hide();
    $.get("?event=photo&action=delete&id="+id, function(response){
        if(response == 1) {
            $(".photo[data-id="+id+"]").remove();
        } else {
            if(response == 1451) {
                response = "Невозможно удалить изображение, в связи с тем, что оно используется в слайдере.<br>"+
                           "Для удаления, уберите изображение из слайдера."
            }
            $("#message-error").show().html(response);
            $("body").animate({"scrollTop":0},"slow");
        }
    });
}
</script>
