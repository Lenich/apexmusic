<li class="photo" data-id="<?=$id?>" data-change="0" data-slide="<?=$in_slides?>">
    <div class="thumbnail">
        <span style="position: absolute; <?=!$in_slides ?"display:none;":""?>">
            <i class="icon-ok icon-white"></i>
        </span>
        <img src="<?=$image?>" alt="260x180" style="cursor: pointer;">
        <span style="<?=!$in_slides ?"display:none;":""?>">
            <lable><h5>Описание слайда:</h5></lable>
            <textarea style="width: 98%; max-width: 520px; height: 126px; max-height: 126px;"><?=$description?></textarea>
        </span>
        
        <span class="save-btn" style="<?=!$in_slides ? "display:none;":""?>">
            <hr style="margin: 4px 0;">
            <input type="button" value="Применить" class="btn btn-primary save_descr" data-id="<?=$id?>">
            <i class="icon-ok descr_ok" style="opacity: 0;"></i>
        </span>
    </div>
</li>