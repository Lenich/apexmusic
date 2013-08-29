<!DOCTYPE>
<html>
<head>
    <link rel="stylesheet" media="screen" href="./assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="./assets/bootstrap/css/bootstrap-responsive.min.css">
    
    <link rel="stylesheet" media="screen" href="./assets/css/main.css">
    <?=$event->getCSS();?>
    
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
    <?=$event->getJS();?>
</head>
<body>
<div id="body-wrapper" class="container">
    <?=$menu->getResult();?>
    <hr>
    <?=$event->getResult();?>
</div>
</body>
</html>