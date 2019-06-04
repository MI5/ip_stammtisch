<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">

<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">

<?php
include("vars.inc.php");

$counterdatei = fopen("counter.txt","r+");
$counterstand = fgets($counterdatei,10);
$counterstand++;
rewind($counterdatei);
fputs($counterdatei,$counterstand);
fclose($counterdatei);


$ip = getenv("REMOTE_ADDR");
$host = getenv("REMOTE_HOST");
$port = getenv("REMOTE_PORT");
$browser = getenv("HTTP_USER_AGENT");
$cookie_inhalt = getenv("HTTP_COOKIE");
$evtl_id = getenv("REMOTE_IDENT");
$ursprung = getenv("HTTP_REFERER");
$adresszeile = getenv("HTTP_HOST");
$erweiterte_url = getenv("PATH_INFO");
$variablen = getenv("QUERY_STRING");
$accept = getenv("HTTP_ACCEPT");
$zeichensatz = getenv("HTTP_ACCEPT_CHARSET");
$sprache = getenv("HTTP_ACCEPT_LANGUAGE");
$http_status  = getenv("HTTP_CONNECTION");
$dauer_start = time();

$link = mysql_connect($sql_server,$sql_user,$sql_pass);
mysql_select_db($sql_db);

$abfrage_id = mysql_query("SELECT dauer_ende FROM stspy WHERE ip = '$ip' AND browser = '$browser'");

$daten = mysql_fetch_array($abfrage_id);

if (($dauer_start - $daten[dauer_ende] - 7200) > 0)
{
  $senden_id = mysql_query("INSERT INTO stspy (ip, host, port, browser, cookie_inhalt, evtl_id, ursprung, adresszeile, erweiterte_url, variablen, accept, zeichensatz, sprache, http_status, dauer_start, besuchernr) VALUES ('$ip', '$host', '$port', '$browser', '$cookie_inhalt', '$evtl_id', '$ursprung', '$adresszeile','$erweiterte_url', '$variablen', '$accept', '$zeichensatz', '$sprache', '$http_status','$dauer_start','$counterstand')");
}

mysql_close($link);

?>

<?
if ($counterstand == 1000)
{
  echo "\n<script language=\"JavaScript\">\n";
  echo "<!--\n";
  echo "  Fenster = open(\"1000.php\",\"Gewinn\",\"width=600,height=500,scrollbars=yes,status=yes,screenX=20,screenY=20\");\n";
  echo "//-->\n";
  echo "</script>\n";
}
?>

<?php
include("pageviews.inc");
include("spy.inc");
?>

<script language="JavaScript" type="text/javascript">
<!--
  if (!document.cookie)
  {
    var expdate = new Date();
    expdate.setTime(expdate.getTime()+(60*24*60*60*1000));
    document.cookie = escape(0) + "; expires="+expdate.toGMTString();
  }
//-->
</script>

<META NAME="allow-search" content="YES">
<META NAME="searchtitle"  content="www.der-stammtisch.net [Die Seite des Warcraft2-Clans Der Stammtisch]">
<META NAME="keywords" CONTENT="Warcraft2 wc2 war2 warcraft onkels tanten opas omas stammtisch clan clanfight">
<META NAME="description" CONTENT="www.der-stammtisch.net">
<META NAME="page-type" CONTENT="www.der-stammtisch.net">
<META NAME="revisit-after" CONTENT="14 days">
<META NAME="ROBOTS" CONTENT="index, follow">
<META NAME="audience" CONTENT="All">
<META NAME="content-language" CONTENT="de">
<META NAME="author" content="webmaster_removeSpamProtection_@ der-stammtisch.net">
<META NAME="abstract" CONTENT="www.der-stammtisch.net">
<title>Der Stammtisch</title>
<link rel="stylesheet" type="text/css" href="styles.css">
<meta http-equiv="refresh" content="0; URL=start.php">

</head>
<body>

<!--
<div align="center">
<a href="start.php"><img src="bilder/welcome.gif" width="630" height="382" border="0" alt=""></a>
</div>
//-->

</body>
</html>
