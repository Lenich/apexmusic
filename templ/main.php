<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Apex Music</title>
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="reset.css"> <!-- css reset file -->
	<link rel="stylesheet" type="text/css" href="styles.css">	<!-- main snippets file -->
	<link rel="stylesheet" type="text/css" href="grid.css">	<!-- grids and coloumns file -->

	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Roboto+Condensed:400,700,400italic,300italic,300,700italic|Roboto:400,300,500,700,900,100,100italic,300italic,400italic,500italic,900italic,700italic|Andika|Lobster|PT+Sans+Narrow:400,700|Playfair+Display+SC:400,700italic,700,900italic,900,400italic|Cuprum:400,700italic,700,400italic|Ubuntu+Condensed|Marck+Script|Didact+Gothic&subset=latin,cyrillic,cyrillic-ext' rel='stylesheet' type='text/css'>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
	 <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script type="text/javascript" src="menu.js"></script>
        <script type="text/javascript" src="/assets/js/jquery.scrollTo.js"></script>
        <script type="text/javascript" src="/assets/js/jquery.nav.js"></script>
        
 
        <script>
        $(function(){
            $('#nav').onePageNav({

            });
        });
        </script>
</head>
<body>
	<?=$event->getResult();?>
</body>
</html>