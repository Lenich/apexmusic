<h3>Выберите изображения для слайдера:</h3>
<div id="images">
<?=$images?>
</div>

<script>
$(function(){
    $(".photo img").click(function(){
        var parent = $(this).parents(".photo");
        var id     = parent.data("id");
        var in_slide = parent.data("slide");
        var display = $(".thumbnail span", parent).css("display")=="none" ? 1 : 0;
      
        $(".thumbnail span", parent).toggle();
        $(".save-btn", parent).show();
        
        if(!in_slide && !display) {
            $(".save-btn", parent).hide();
        }
    });
    
    $(".save_descr").click(function() {
        var parent = $(this).parents(".photo");
        var descr = parent.find("textarea").val(); 
        var id = $(this).data("id");
        
        var in_slide = parent.data("slide");
        var display = $(".thumbnail span", parent).css("display")=="none" ? 0 : 1;
        if(in_slide && display == 1) {
            update(id, descr, parent);
        } else {
            if(in_slide && display == 0) {
                select(id);
                $(".save-btn", parent).hide();
            } 
            if(!in_slide && display == 1) {
                select(id, function() {
                    parent.data("slide", 1);
                    update(id, descr, parent);
                });
            }
        }
        
        
        
        /*if(parent.data("change")) {
            select(id, function(responce) {
                var in_slide = parent.data("slide");
                if(in_slide) {
                    parent.data("slide", 0);
                    parent.data("change", 0).data("save", !parent.data("save"));
                    $(".save-btn", parent).hide();
                } else {
                    update(id, descr, parent);
                }
            });
        } else {
            update(id, descr, parent);
        }*/
        /*
        if(parent.data("change")) {
            $.get("?event=slider&action=select&id="+id, function(responce) {
                if(responce == 0) {
                    parent.data("change", 0);
                    $(".save-btn", parent).hide();
                }
            });
        }
        
        $.post("?event=slider&action=description&id="+id, {description:descr}, function(response) {
            if(response == 1) {
                parent.find(".descr_ok").css({"opacity": 1}).animate({"opacity": 0}, 4000);
            } else {
                parent.find(".descr_ok").css({"opacity": 1}).text("Пороизошла ошибка!");
            }
        });*/
    });
    
    function select(id, callback) {
        $.get("?event=slider&action=select&id="+id, callback);
    }
    
    function update(id, descr, parent) {
        $.post("?event=slider&action=description&id="+id, {description:descr}, function(response) {
            if(response == 1) {
                parent.find(".descr_ok").css({"opacity": 1}).animate({"opacity": 0}, 4000);
            } else {
                parent.find(".descr_ok").css({"opacity": 1}).text("Пороизошла ошибка!");
            }
        });
    }
});
</script>