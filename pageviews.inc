<?php
include("vars.inc.php");

$mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

$pagename = "$_SERVER[PHP_SELF]";

$abfrage_id = $mysqli->query("SELECT anzahl FROM stpageviews WHERE pagename = '$pagename'");

$daten = $abfrage_id->fetch_array();


if (!isset($daten[anzahl]))
{
  $senden_id = $mysqli->query("INSERT INTO stpageviews (pagename,anzahl) VALUES ('$pagename','1')");
}
else
{
  $anzahl = $daten[anzahl];
  $anzahl++;
  $senden_id = $mysqli->query("UPDATE stpageviews SET anzahl = '$anzahl' WHERE pagename = '$pagename'");
}

$mysqli->close();
?>