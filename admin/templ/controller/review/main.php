<script>
var typewatch = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  }  
})();    
    
function editable(review_id) {
    var review = $(".review[data-id="+review_id+"]");
    $(".description, .title", review).keyup(set_notext).keyup(function(){
        /*var id = $(this).parents(".review").data("id");
        typewatch(function () {
            saveReview(id);
        }, 1000);*/
    });
    $(".description, .title", review).keypress(set_hastext);
    $(".description, .title", review).each(set_notext);
}   

function set_notext() {
    if($(this).text().length <= 0 || $(this).hasClass("notext")) {
        var empty = $(this).data("empty");
        $(this).addClass("notext").html("<span style='color: gray; opacity: 0.4;' class='notext'>"+empty+"</span>");
    }
}

function set_hastext() {
    if($(this).hasClass("notext")) {
        $(this).removeClass("notext");
        $(".notext",this).remove();
    }
}

var Images = {
    photos: "",
    activeReview: 0,
    
    init: function(photos) {
        this.photos = $(photos);
        
        $(".photo img").click(function() {
            if(Images.activeReview != 0) {
                var photo = {
                    id: $(this).parents(".photo").data("id"),
                    src: $(this).attr("src")
                };
                Images.onChoose(photo);
            }
        });
    },
    open: function(review) {
        this.activeReview = review;
        this.photos.show();
        this.photos.css({"top" : parseInt($("body").scrollTop())+100+"px"});
    },
    close: function() {
        this.photos.hide();
    },
    onChoose: function(photo) {
        if(this.activeReview !== 0) {
            $(".review-img", this.activeReview)
                    .data("id", photo.id)
                    .attr("src", photo.src);
            
            //saveReview(this.activeReview.data("id"));
            this.activeReview = 0;
            this.close();
        }
    }
};

function saveReview(id) {
    var review = $('.review[data-id='+id+']');
    var data = {
        id : id,
        title : $(".title", review).text(),
        description : $(".description", review).text(),
        photo : $(".review-img", review).data("id")
    }
    if(data.title == "Нет заголовка..") data.title = "";
    if(data.description == "Нет описания отзыва..") data.description = "";
    
    $.post("?event=review&action=save", data, function(response) {
        $(".save", review).data("loading-text", "");
        if(response == 1) {
            $(".descr_ok", review).css({"opacity": 1}).animate({"opacity": 0}, 4000);
        } else {
            $(".descr_ok", review).css({"opacity": 1}).text("Пороизошла ошибка!");
        }
    });
}

function addReview() {
    $.get("?event=review&action=add", function(response) {
        response = $.parseJSON(response);
        
        $(".all-reviews ul.thumbnails").append(response.view);
        editable($(".review[data-id="+response.id+"]").data("id"));
        
        $("html, body").animate({ scrollTop: $(document).height() }, 1000);
    });
}

function deleteReview(id) {
    $.get("?event=review&action=delete&id="+id, function(res) {
        if(res == 1) {
            $(".review[data-id="+id+"]").remove();
        } else {
            alert(res);
        }
    });
}

$(function(){
    Images.init(".photos");
    $(".review").each(function(){
        editable($(this).data("id"));
    });
});
</script>
<input type="button" value="Добавить отзыв" class="btn btn-primary" onclick="javascript: addReview();">
<hr>
<div class="all-reviews"><?=$content?></div>
<div class="thumbnail photos" style="min-height: 20px; display: none;">
    <i class="icon-remove close" onclick="javascript: Images.close();"></i>
    <h4>Выберите фото для отзыва:</h4>
    <hr style="margin: 4px 0;">
    <?=$photos?>
</div>