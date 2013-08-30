<?=$popup->renderPopup();?>
<div id="wrapper">
        <div class="header" id="menu1">
                <div class="left">
                        <!-- <img src="apex_logo.png"> -->
                        <a href="#">Apex Music</a>
                </div>
                <div class="right">
                        <span class="phone">+7 (905) 918-62-98</span>
                        <span class="phone-description">Позвони мне, няша ;D
                                <a href="#">Записаться на сеанс гитаротерапии</a>
                        </span>
                </div>
                <div class="clear"></div>
        </div>
        <div id="menuwrap">
                <div id="mainmenudiv">
                        <ul class="mainmenu nav" id="nav">
                                <li class="current"><a href="#menu1">«Главная»</a></li> <span>♪</span>
                                <li><a href="#menu2">О преподавателе</a></li> <span>♪</span>
                                <li><a href="#menu3">Отзывы</a></li> <span>♪</span>
                                <li><a href="#menu4">Контакты</a></li>
                        </ul>
                </div>
        </div>
        <div class="content">
                <div class="promo-block">
                        <img src="karousel.png">

                        <p>
                                <center>
                                <h4>Вы любите музыку и мечтаете научиться играть?</h4>
                                <h4>Музыка живет в вашем сердце и вы хотите совершенствовать свои навыки?</h4>
                                <h4>Музыка согревает вас и вы хотите узнать как она создается?</h4>
                                <h4>Мы с удовольствием поможем вам воплотить ваши желания в реальность!</h4>
                                </center>
                        </p>

                        <p>
                                В музыкальной студии Общественно-культурного центра Новосибирского Государственного Университета начинается набор учащихся по направлениям:
                                <h5>
                                <ul>
                                <li>- Гитара</li>
                                <li>- Фортепиано</li>
                                <li>- Вокал</li>
                                <li>- Подготовка ребенка к музыкальной школе (общая подготовка и профильный предмет)</li>
                                </ul>
                                </h5>
                        </p>

                        <p>
                                Профессиональный преподаватель расскажет вам о музыке, предложит план занятий для осуществления вашей мечты!
                                Замечательное настроение - неизменный спутник наших уроков!
                                Творческий подход к проведению занятий увлечет вас в живописный мир музыки, полный радостных красок, теплых чувств и незабываемых впечатлений!
                        </p>
                </div>	

                        <div class="separator">
                                <img src="separator2.png">
                        </div>

                <div class="about-block">
                        <h4><a id="menu2" class="perma-anchor"></a>О преподавателе:</h4>
                                <p>
                                        Я светлана, вот майя фото! азазазаз!
                                </p>
                </div>

                        <div class="separator">
                                <img src="separator2.png">
                        </div>

                <div class="promo-block">
                        <h4><a id="menu3" class="perma-anchor"></a>Отзывы</h4>
                        <? foreach ($reviews as $Review) {
                            echo $this->render("main/review", array(
                                "Review" => $Review,
                            ));
                        } ?>
                </div>

                <div class="separator">
                        <img src="separator2.png">
                </div>

                <div class="contacts-block" >
                        <h4><a id="menu4" class="perma-anchor"></a>Контакты</h4>
                                <h5>Телефон:</h5>
                                        +7 (905) 918-62-98 - Софья Александровна<br>
                                <h5>Адрес:</h5>
                                        г. Новосибирск, Академгородок, ул. Пирогова, д. 20, Общественно-культурный центр НГУ
                                <h5>На карте:</h5>
                                <a id="firmsonmap_biglink" href="http://maps.2gis.ru/#/?history=project/novosibirsk/center/83.093571592358,54.849791519363/zoom/17/state/widget/id/141265769422196/firms/141265769422196">Перейти к большой карте</a>
                                <script charset="utf-8" type="text/javascript" src="http://firmsonmap.api.2gis.ru/js/DGWidgetLoader.js"></script>
                                <script charset="utf-8" type="text/javascript">new DGWidgetLoader({"borderColor":"#a3a3a3","width":"900","height":"600","wid":"91ad6500ea24960d85e03cec73c894ea","pos":{"lon":"83.093571592358","lat":"54.849791519363","zoom":"17"},"opt":{"ref":"hidden","card":["name"],"city":"novosibirsk"},"org":[{"id":"141265769422196"}]});</script>
                                <noscript style="color:#c00;font-size:16px;font-weight:bold;">Виджет карты использует JavaScript. Включите его в настройках вашего браузера.</noscript>
                </div>


                <div class="wide-block">
                        <center>2013 © Стасундр, Лёнич, Йакуд</center>
                </div>
<!-- 			fdf -->
        </div>

</div>