<div>
    <p>
    Привет, меня зовут <input type='text' name='myName'/>, мне <input type='text' name='myOld'/> лет 
    и я хотел(а) бы записаться на предмет 
    <select name='mySubj'>
        <option disabled selected>Выбрать предмет</option>
        <option name='1'>Гитара</option>
        <option name='2'>Вокал</option>
        <option name='3'>Фортепиано</option>
        <option name='4'>Общая подготовка</option>
      </select>
    </p>
    
    <p>
        Мой телефон для связи: <input type='text' name='myPhone'/>
    </p>
    
    <p>
        Еще я хотел(а) бы оставить небольшое примечание(удобное время для связи и пр.): <br>
        <textarea name='myOther'></textarea>
    </p>
    
    <center>
        <input type='button' value='Записаться' class='signUp' />
    </center>
</div>

<script>
$(function(){
    $(".signUp").click(function(){
        var params = {
            myName: $("input[name=myName]").val(),
            myOld: $("input[name=myOld]").val(),
            mySubj: $("select[name=mySubj]").val(),
            myPhone: $("input[name=myPhone]").val(),
            myOther: $("textarea[name=myOther]").val()
        };
        $.post("?event=main&action=signUp", params, function(res) {
            if(res == 1) {
                alert("Большое спасибо за вашу заявку! В самое ближайшее время мы Вам позвоним!");
            }
            $(".popup, .popup-wraper").hide();
        });  
    });
});
</script>