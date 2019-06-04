<?php
include("vars.inc.php");

include("pageviews.inc");
include("spy.inc");
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="scripte.js"></script>
<title>KUEL-Zug einsenden</title>

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
<div align="center">

<?
$mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

$abfrage_id = mysql_query("SELECT id,prefix,nick,name,status,since,location,pw,email,wl,format,icq,typ,option_icqshow,option_icqsend,option_mailsend,option_notself,visits,option_kuel,option_autoli FROM stmembers WHERE typ >= 0 AND nick = '$f_nick' AND pw = '$f_pw'");

if (($daten = mysql_fetch_array($abfrage_id)) && ($f_pw != "")): ?>


<?
/* Spionage Anfang */

  $ip = getenv("REMOTE_ADDR");
  $browser = getenv("HTTP_USER_AGENT");

  $abfrage_id = mysql_query("SELECT user FROM stspy WHERE ip = '$ip' AND browser = '$browser'");
  $daten_s = mysql_fetch_array($abfrage_id);

  if ($daten_s[user] == "")
    $senden_id = mysql_query("UPDATE stspy SET user = '$daten[prefix].$daten[nick]' WHERE ip = '$ip' AND browser = '$browser'");

/* Spionage Ende */

/* Spionage2 Anfang */

  $abfrage_id = mysql_query("SELECT visits FROM stmembers WHERE id = '$daten[id]'");
  $daten_s = mysql_fetch_array($abfrage_id);

  $anzahl = $daten_s[visits];
  $anzahl++;
  $senden_id = mysql_query("UPDATE stmembers SET visits = '$anzahl' WHERE id = '$daten[id]'");
/* Spionage2 Ende */


          /* Login Anfang 2 */

          $ip = getenv("REMOTE_ADDR");
          $timex = time();

          $abfrage_id = mysql_query("SELECT id FROM stonline WHERE ip = '$ip'");

          if (!($daten_pw_ = mysql_fetch_array($abfrage_id)) && ($daten[option_autoli] == 1))
          {
            $senden_id = mysql_query("INSERT INTO stonline (prefix,nick,pw,lastrequest,ip,typ) VALUES ('$daten[prefix]','$daten[nick]','$daten[pw]','$timex','$ip','$daten[typ]')");
          }

          /* Login Ende 2*/
?>

<div align="center">
Ihr Zug wurde an den Spielleiter gesendet.
<br><br><a href="kuel.php">Zur&uuml;ck</a>
</div>

<?
mail("onkel.xardas@der-stammtisch.net", "KUEL", "$f_nick schreibt:\n$f_zug");
mail("ncc_1701@gmx.de", "KUEL", "$f_nick schreibt:\n$f_zug");
?>

<? else: ?>

  <? if (!isset($f_pw)): ?>

    <?
    $abfrage_id = mysql_query("SELECT prefix,nick FROM stmembers WHERE typ >= 1 && option_kuel = 1 ORDER BY prefix DESC,nick");
    ?>

    <form name="pw_abfrage" action="kuel_send.php" method="post">
    <table border="0" cellspacing="4">
    <tr><td>Member:</td><td>

    <select name="f_nick">
    <?
    while($daten = mysql_fetch_array($abfrage_id))
    {
      echo "<option value=\"$daten[nick]\">$daten[prefix].$daten[nick]</option>";
    }
    ?>
    </select>

    </td></tr>
    <tr><td>Passwort:</td><td><input type="password" name="f_pw" size="20" maxlength="20"></td></tr>
    </table>
    <textarea name="f_zug" rows="10" cols="50" wrap="physical"></textarea><br><br>
    Blick auf <a href="kuel_karte.php" target="_blank">die Karte</a> werfen &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Zug Einsenden">
    </form>

        <? /* Login Anfang 1 */

        $ip = getenv("REMOTE_ADDR");
        $time_sub = time();
        $time_sub -= 600;

        $loeschen_id = mysql_query("DELETE FROM stonline WHERE lastrequest < '$time_sub'");

        $abfrage_id = mysql_query("SELECT id,prefix,nick,pw,lastrequest FROM stonline WHERE ip = '$ip' AND typ >= 0");

        if ($daten_pw_ = mysql_fetch_array($abfrage_id))
        {
          $timex = time();
          $senden_id = mysql_query("UPDATE stonline SET lastrequest = '$timex' WHERE id = '$daten_pw_[id]'");

          echo "\n<script>\n";
          echo "  document.pw_abfrage.f_nick.value = \"$daten_pw_[nick]\";\n";
          echo "  document.pw_abfrage.f_pw.value = \"$daten_pw_[pw]\";\n";
          echo "</script>\n";
        }

        /* Login Ende 1 */ ?>

    <script>
    if(document.pw_abfrage.f_pw.value == "")
    {
      document.pw_abfrage.f_nick.focus();
    }
    else
    {
      document.pw_abfrage.f_zug.focus();
    }
    </script>


    <? else: ?>
    Das Passwort war falsch. Es wurde kein Zug eingesandt.<br><br><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Zur&uuml;ck</a>

  <? endif ?>
<? endif ?>


<? $mysqli->close(); ?>


</div>
</font>
</body>
</html>
