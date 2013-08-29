<div class="review">
        <img src="<?=$Review->getPhoto()?>">
        <div class="description">
                <h5><?=$Review->getTitle()?></h5>
                
                <? if($Review->getDescription() == $Review->getMinDescription()) :?>
                    <div class='full-description' style='display: block;'>
                        <?=$Review->getDescription()?>
                    </div>
                <? else:?>
                    <?=$Review->getMinDescription()?><span class='full-description'><?=$Review->getDiffDescription()?></span>
                    <span class='min-description'>...</span>
                    

                
                    <a href="#" class="more"><i>↓</i>Развернуть</a>
                    <a href="#" class="min"><i>↑</i>Свернуть</a>
                <? endif;?>
        </div>    
</div>