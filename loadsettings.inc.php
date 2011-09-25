<?php

$result = mysql_query("SELECT * FROM `settings`");
$r = mysql_fetch_array($result);


$password = $r['password'];
$website = $r['website'];
$webtitle = $r['title'];
$description = $r['description'];
$keywords = $r['keywords'];
$maxsizeguest = $r['maxsizeguest'];
$maxsizemember = $r['maxsizemember'];
$watermark = $r['watermark'];


?>


