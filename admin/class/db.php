<?php
require_once 'dbconfig.php';
mysql_connect($dbconfig["host"], $dbconfig["user"], $dbconfig["password"]) or die("Could not connect to MySQL!");
mysql_select_db($dbconfig["db"]) or die("Could not connect to database!");
