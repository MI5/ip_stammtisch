<?php
include("vars.inc.php");

$link = mysql_connect($sql_server,$sql_user,$sql_pass);
mysql_select_db($sql_db);

$pagename = "$_SERVER[PHP_SELF]";

$abfrage_id = mysql_query("SELECT anzahl FROM stpageviews WHERE pagename = '$pagename'");

$daten = mysql_fetch_array($abfrage_id);


if (!isset($daten[anzahl]))
{
  $senden_id = mysql_query("INSERT INTO stpageviews (pagename,anzahl) VALUES ('$pagename','1')");
}
else
{
  $anzahl = $daten[anzahl];
  $anzahl++;
  $senden_id = mysql_query("UPDATE stpageviews SET anzahl = '$anzahl' WHERE pagename = '$pagename'");
}

mysql_close($link);
?>