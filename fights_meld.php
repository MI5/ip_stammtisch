<?php
include("vars.inc.php");

include("pageviews.inc");
include("spy.inc");
?>

<html>
<head>
<title>Meldung machen</title>
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="scripte.js"></script>

<script>
switch (document.cookie)
{
  case "0":
  case "2": document.writeln('<style type="text/css">td { color:#FFFFFF }</style>');
  break;

  case "1":
  case "3": document.writeln('<style type="text/css">td { color:#0000FF }</style>');
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


$abfrage_id = $mysqli->query("SELECT id,prefix,nick,name,pw,typ,option_autoli FROM stmembers WHERE typ >= 0 AND nick = '$f_nick' AND pw = '$f_pw'");

if (($daten_li = $abfrage_id->fetch_array()) && ($f_pw != "")):?>

<?
  /* Spionage Anfang */

  $ip = getenv("REMOTE_ADDR");
  $browser = getenv("HTTP_USER_AGENT");

  $abfrage_id = $mysqli->query("SELECT user FROM stspy WHERE ip = '$ip' AND browser = '$browser'");
  $daten_s = $abfrage_id->fetch_array();

  if ($daten_s[user] == "")
    $senden_id = $mysqli->query("UPDATE stspy SET user = '$daten_li[prefix].$daten_li[nick]' WHERE ip = '$ip' AND browser = '$browser'");

  /* Spionage Ende */

          /* Login Anfang 2 */

          $ip = getenv("REMOTE_ADDR");
          $timex = time();

          $abfrage_id = $mysqli->query("SELECT id FROM stonline WHERE ip = '$ip'");

          if (!($daten_pw_ = $abfrage_id->fetch_array()) && ($daten_li[option_autoli] == 1))
          {
            $senden_id = $mysqli->query("INSERT INTO stonline (prefix,nick,pw,lastrequest,ip,typ) VALUES ('$daten_li[prefix]','$daten_li[nick]','$daten_li[pw]','$timex','$ip','$daten_li[typ]')");
          }

          /* Login Ende 2*/

$mysqli->close(); ?>

<div align="left">
Es fehlt ein Eintrag? &Auml;ndere doch einfach den <a href ="changesrc.php?key=allowed434">Quellcode</a> ab!
</div>

<form action="fights_meld2.php" method="post">
<table cellspacing="10">
<tr><td>Beteiligte</td><td>gegn. Clan</td><td>gegn. Beteiligte</td><td>Map</td><td>Modus</td><td>Ausgang</td></tr>
<tr><td>


<?
  $mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

  $abfrage_id = $mysqli->query("SELECT id,prefix,nick FROM stmembers WHERE typ >= 0 ORDER BY prefix DESC,nick");
?>


<select name="f_we[]" multiple size="5">

<?
  while($daten_ch = $abfrage_id->fetch_array())
  {
    if ($daten_ch[id] == "2")
      echo "<option selected value=\"$daten_ch[prefix].$daten_ch[nick]\">$daten_ch[prefix].$daten_ch[nick]</option>\n";
    else
      echo "<option value=\"$daten_ch[prefix].$daten_ch[nick]\">$daten_ch[prefix].$daten_ch[nick]</option>\n";
  }
?>

</select>
</td><td>


<?
$mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

$abfrage_id = $mysqli->query("SELECT id,datum,source,changedby FROM stsource WHERE id = 1");
$daten = $abfrage_id->fetch_array();

echo "$daten[source]";

$mysqli->close();
?>


</td></tr>
<tr><td>Multiple mit Strg</td><td>&nbsp;</td><td>Multiple mit Strg</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>

<br><br>
<input type="reset" value="Zur&uuml;cksetzen">
<input type="submit" value="Eintragen">
</form>

<? else: ?>


  <? if (!isset($f_pw)): ?>

    <?
    $mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

    $abfrage_id = $mysqli->query("SELECT prefix,nick FROM stmembers WHERE typ >= 1 ORDER BY prefix DESC,nick");
    ?>

    <form name="pw_abfrage" action="fights_meld.php" method="post">
    <table border="0" cellspacing="4">
    <tr><td>Member:</td><td>

    <select name="f_nick">
    <?
    while($daten_li = $abfrage_id->fetch_array())
    {
      echo "<option value=\"$daten_li[nick]\">$daten_li[prefix].$daten_li[nick]</option>";
    }
    ?>
    </select>

    </td></tr>
    <tr><td>Passwort:</td><td><input type="password" name="f_pw" size="20" maxlength="20"></td></tr>
    <tr><td>&nbsp;</td><td><input type="submit" value="Einloggen"></td></tr>
    </table>
    </form>

        <? /* Login Anfang 1 */

        $ip = getenv("REMOTE_ADDR");
        $time_sub = time();
        $time_sub -= 600;

        $loeschen_id = $mysqli->query("DELETE FROM stonline WHERE lastrequest < '$time_sub'");

        $abfrage_id = $mysqli->query("SELECT id,prefix,nick,pw,lastrequest FROM stonline WHERE ip = '$ip' AND typ >= 1");

        if ($daten_pw_ = $abfrage_id->fetch_array())
        {
          $timex = time();
          $senden_id = $mysqli->query("UPDATE stonline SET lastrequest = '$timex' WHERE id = '$daten_pw_[id]'");

          echo "<br>Automatisches Einloggen erfolgt<br><br><br>";
          echo "\n<script>\n";
          echo "  document.pw_abfrage.f_nick.value = \"$daten_pw_[nick]\";\n";
          echo "  document.pw_abfrage.f_pw.value = \"$daten_pw_[pw]\";\n";
          echo "  document.pw_abfrage.submit();\n";
          echo "</script>\n";
        }
        else
        {
          echo "<br><br>";
          echo "<font size=\"-2\"><a href=\"pw.php\">Passwort vergessen</a></font><br><br><br>";
        }

        /* Login Ende 1 */ ?>

    <?
    $mysqli->close();
    ?>

  <? else: ?>
  Na, das war wohl nix.<br><br><a href="fights.php">Zur&uuml;ck</a>

  <? endif ?>
<? endif ?>

</div>
</font>
</body>
</html>