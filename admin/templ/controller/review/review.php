<li class="review" data-id="<?=$id?>">
    <div class="thumbnail" align="justify">
        <i class="icon-remove delete remove" onclick="javascript: deleteReview(<?=$id?>);"></i>
        <img src="<?=$image?>" class="review-img" data-id="<?=$image_id?>" title="Выберите изображение" onclick="javascript: Images.open($(this).parents('.review'));">
        <span><h5 contenteditable="true" class="title" data-empty="Нет заголовка.."><?=$title?></h5></span>
        <span contenteditable="true" class="description" data-empty="Нет описания отзыва.."><?=$description?></span>
        <hr style="margin: 4px 0;">
        <input type="button" value="Сохранить" class="btn btn-primary save" data-id="<?=$id?>" onclick="javascript: saveReview(<?=$id?>);">
        <i class="icon-ok descr_ok" style="opacity: 0;"></i>
    </div>
</li>
