<?php
include("vars.inc.php");

include("pageviews.inc");
include("spy.inc");
?>

<html>
<head>
<head><title>Details</title></head>
<link rel="stylesheet" type="text/css" href="styles.css">
<script language="JavaScript" src="scripte.js" type="text/javascript"></script>

<script language="JavaScript"><!--
selectbg();
//--></script>
<noscript><body background="bg_sommer.gif"><font color="#FFFFFF"></noscript>
<h2>Details</h2>

<div align="left">
<span style="font-size:10pt;">


<?
$link = mysql_connect($sql_server,$sql_user,$sql_pass);
mysql_select_db($sql_db);
$abfrage_id = mysql_query("SELECT id,datum,we,them,result FROM stfights where id = '$id'");
$daten = mysql_fetch_array($abfrage_id);

$d = (string) $daten[datum];
echo "<b>Austragungsdatum:</b> $d[6]$d[7].$d[4]$d[5].$d[2]$d[3]<br><br>";
echo "<b>Unsere beteiligten Leute:</b><br>$daten[we]<br><br><b>Die Gegner:</b><br>$daten[them]<br><br>";
mysql_close($link);
?>



</span>
</div>
<img src="bilder/waranim.gif" width="98" height="68"><br><br>

<div align="right">
<a href="javascript:self.close()">Fenster schlie&szlig;en</a>
</div>
</font>
</body>
</html>