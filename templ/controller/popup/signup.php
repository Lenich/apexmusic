<div class='popup-wraper'></div>
<div class='popup'>
    <div style="position: absolute; margin-left: 500px; margin-top: -15px;font-size: 14px;">
        <a href="" onclick="$('.popup, .popup-wraper').hide(); return false;">Закрыть</a>
    </div>
    <h2><?=$title?></h2>
    <div><?=$body?></div>
</div>
<script>
$('.popup, .popup-wraper').hide();
</script>