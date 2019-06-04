<?php
include("vars.inc.php");

include("pageviews.inc");
include("spy.inc");
?>

<html>
<head>

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">

<link rel="stylesheet" type="text/css" href="styles.css">
<script src="scripte.js"></script>
<title>Sie sind der 1000. Besucher dieser Webseite!</title>

<script>
switch (document.cookie)
{
  case "0":
  case "2": document.writeln('<style type="text/css">td,th { color:#FFFFFF }</style>');
  break;

  case "1":
  case "3": document.writeln('<style type="text/css">td,th { color:#0000FF }</style>');
  break;
}
</script>
</head>

<script>
selectbg();
</script>
<noscript><body background="bg_sommer.gif"><font color="#FFFFFF"></noscript>

<?
$mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

$abfrage_id = mysql_query("SELECT id,prefix,nick,name,status,since,location,pw,email,wl,format,icq,typ,option_icqshow,option_icqsend,option_mailsend,option_notself,visits,option_kuel,option_autoli FROM stmembers WHERE typ >= 0 AND nick = '$f_nick' AND pw = '$f_pw'");

if (isset($f_name)): ?>

<div align="center">
Herzlichen Glückwunsch. Sie erhalten ihre Onkelchens umgehend zugesandt.
</div>

<?
mail("ncc_1701@gmx.de", "1000. Besucher", "$f_name\n$f_strasse\n$f_ort\n\n$f_kommentar");
?>

<? else: ?>

    <?
    $abfrage_id = mysql_query("SELECT prefix,nick FROM stmembers WHERE typ >= 1 && option_kuel = 1 ORDER BY prefix DESC,nick");
    ?>
    Sie sind der 1000. Besucher auf der Webseite des Stammtisches! Dies ist kein Scherz!
    Überprüfen sie in den <a href="stats.php" target="_blank">Stats</a>, dass sie tatsächlich der 1000. Besucher
    sind.<br>
    Anläßlich dieses besonderen Ereignisses erhalten sie von uns eine Packung Onkelchens aus
    unserem <a href="onlineshop.php" target="_blank">Sortiment</a> zugesandt.<br>
    Man hört ja oft von so einem Quatsch im Internet, dass man irgendwo gewonnen hätte, aber hier
    ist es wirklich Realität! Der Stammtisch verbürgt sich dafür!<br>
    Sollten sie uns nicht vertrauen, klicken sie diese Seite einfach weg. Sie wird dann erst
    wieder zum 10.000 Besucher aktiv werden, ansonsten hinterlassen sie ihre Adresse und sie
    erhalten ihr Präsent umgehend zugesandt!<br><br>
    Nach dem Versand werden ihre Angaben garantiert gelöscht!<br><br>

    Beachten sie: Dieses Formular kann nur ein einziges mal benutzt werden! Überprüfen sie
    deswegen ihre Angaben sorgfältig.
    <div align="center">
    <form name="pw_abfrage" action="1000.php" method="post">
    <table border="0" cellspacing="4">
    <tr><td>Name:</td><td><input name="f_name" size="20" maxlength="80"></td></tr>
    <tr><td>Strasse:</td><td><input name="f_strasse" size="20" maxlength="80"></td></tr>
    <tr><td>PLZ + Ort:</td><td><input name="f_ort" size="20" maxlength="80"></td></tr>
    </table>
    <br>Kommentar zum Gewinn:<br>
    <textarea name="f_kommentar" rows="6" cols="30" wrap="physical"></textarea><br><br>
    <input type="submit" value="Abschicken">
    </form>


    <script>
    document.pw_abfrage.f_name.focus();
    </script>

<? endif ?>


<? $mysqli->close(); ?>


</div>
</font>
</body>
</html>