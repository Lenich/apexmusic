<? foreach ($variable as $key => $var): ?>
<div>
    <h4><?=$var->description?></h4>
    <? if($var->type == "textarea") :?>
    <textarea name="<?=$var->variable?>" style="width: 450px; height: 120px;"><?=$var->value?></textarea>
    <? else:?>
        <input type="<?=$var->type?>" name="<?=$var->variable?>" value="<?=$var->value?>"> 
    <? endif;?>
    
    <i class="icon-hdd save" data-element="<?=$var->variable?>" style="cursor: pointer;"></i> 
    <i class="icon-ok" style="opacity: 0;"></i>
</div>
<? endforeach;?>

<script>
function save_option(elem, callback) {
    var $elem = $("*[name="+elem+"]");
    var variable = elem,
        value = $elem.val();

    $.post("?event=main&action=save", {variable : variable, value: value}, function(response){
        if(response == 1) {
            callback(1);
            
        }
    });
}
$(function(){
    $(".save").click(function() {
        var $this = $(this);
        var elem = $(this).data("element");
        save_option(elem, function(){
            $this.next(".icon-ok").css({opacity: 0.5}).animate({opacity: 0}, 2500);
        });
        
    });
});
</script>