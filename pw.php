<?php
include("vars.inc.php");

include("pageviews.inc");
include("spy.inc");
?>

<html>
<head>
<head><title>Passwort vergessen</title></head>
<link rel="stylesheet" type="text/css" href="styles.css">
<script language="JavaScript" src="scripte.js" type="text/javascript"></script>
</head>

<script language="JavaScript"><!--
selectbg();
//--></script>
<noscript><body background="bg_sommer.gif"><font color="#FFFFFF"></noscript>


<h2>Passwortanforderung</h2>

<? if (isset($f_nick) && isset($f_email)): ?>
<?
$link = mysql_connect($sql_server,$sql_user,$sql_pass);
mysql_select_db($sql_db);

$abfrage_id = mysql_query("SELECT name,pw FROM stmembers WHERE typ >= 0 AND nick = '$f_nick' AND wl = '$f_email'");

if (($daten = mysql_fetch_array($abfrage_id)) && ($f_email != ""))
{
  mail("$f_email", "eMail vom Stammtisch", "Hallo $daten[name]!\n\nDu hast das Passwort für den internen Bereich der Stammtisch-Webseite angefordert\n\nDein Passwort lautet \"$daten[pw]\".\n\nOnkel.MI5\n\nhttp://www.der-stammtisch.net", "From: Web-Onkel MI5 <Onkel.MI5@der-stammtisch.net>");
  echo "Identifikation Erfolgreich! An die angegebene Adresse wurde eine eMail mit dem Passwort versandt.";
}
else
{
  echo "Identifikation nicht erfolgreich!";
}

mysql_close($link);


/* <br><br><br><a href="intern.php">Zur&uuml;ck</a> */ ?>
<? else: ?>

<?

$link = mysql_connect($sql_server,$sql_user,$sql_pass);
mysql_select_db($sql_db);

$abfrage_id = mysql_query("SELECT prefix,nick,email FROM stmembers WHERE typ >= 0 ORDER BY prefix DESC,nick");

echo "<form action=\"pw.php\" method=\"post\">Ich bin <select name=\"f_nick\">";
while($daten = mysql_fetch_array($abfrage_id))
{
  echo "<option value=\"$daten[nick]\">$daten[prefix].$daten[nick]</option>";
}
echo "</select><br><br>Zur Identifikation gib deine Weiterleitungs-eMail-Adresse an: <input name=\"f_email\" size=\"30\" maxlength=\"30\">";
echo "<br><br><input type=\"submit\" value=\"Passwort Anfordern\"></form>";

mysql_close($link);
?>

<? endif ?>

</font>
</body>
</html>