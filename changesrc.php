<?php
include("vars.inc.php");

include("pageviews.inc");
include("spy.inc");
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<script language="JavaScript" src="scripte.js" type="text/javascript"></script>
</head>

<script language="JavaScript"><!--
selectbg();
//--></script>
<noscript><body background="bg_sommer.gif"><font color="#FFFFFF"></noscript>
<div align="center">

<? if ($key == "allowed434"): ?>

<?
$link = mysql_connect($sql_server,$sql_user,$sql_pass);
mysql_select_db($sql_db);

$abfrage_id = mysql_query("SELECT id,datum,source,changedby FROM stsource WHERE id = 1");
$daten = mysql_fetch_array($abfrage_id);

$d = (string) $daten[datum];
echo "fights.php - Zuletzt ge&auml;ndert von $daten[changedby] am $d[6]$d[7].$d[4]$d[5].$d[0]$d[1]$d[2]$d[3] um $d[8]$d[9]:$d[10]$d[11] Uhr<br>";
echo "<form action=\"changesrc2.php\" method=\"post\">";
echo "<textarea name=\"f_source\" rows=\"25\" cols=\"90\" wrap=\"physical\">$daten[source]</textarea><br><br>";
echo "<div align=\"left\"><br>Ge&auml;ndert von: <input name=\"f_name\" size=\"30\" maxlength=\"30\"></div><br><br>";
echo "<input type=\"reset\" value=\"Zur&uuml;cksetzen\"><input type=\"submit\" value=\"&Auml;ndern\"></form>";

mysql_close($link);
?>

<? else: ?>
Mich so aufzurufen ist nicht m&ouml;glich.
<? endif ?>

</div>
</font>
</body>
</html>