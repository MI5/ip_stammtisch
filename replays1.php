<?php
include("vars.inc.php");

include("pageviews.inc");
include("spy.inc");
?>

<html>
<head>
<title>Replay einliefern</title>
<link rel="stylesheet" type="text/css" href="styles.css">
<script language="JavaScript" src="scripte.js" type="text/javascript"></script>

<script language="JavaScript"><!--
switch (document.cookie)
{
  case "0":
  case "2": document.writeln('<style type="text/css">td { color:#FFFFFF }</style>');
  break;

  case "1":
  case "3": document.writeln('<style type="text/css">td { color:#0000FF }</style>');
  break;
}
//--></script>

</head>

<script language="JavaScript"><!--
selectbg();
//--></script>
<noscript><body background="bg_sommer.gif"><font color="#FFFFFF"></noscript>
<div align="center">

<?
$link = mysql_connect($sql_server,$sql_user,$sql_pass);
mysql_select_db($sql_db);


$abfrage_id = mysql_query("SELECT id,prefix,nick,name,pw,typ,option_autoli FROM stmembers WHERE typ >= 0 AND nick = '$f_nick' AND pw = '$f_pw'");

if (($daten_li = mysql_fetch_array($abfrage_id)) && ($f_pw != "")):?>

<?
  /* Spionage Anfang */

  $ip = getenv("REMOTE_ADDR");
  $browser = getenv("HTTP_USER_AGENT");

  $abfrage_id = mysql_query("SELECT user FROM stspy WHERE ip = '$ip' AND browser = '$browser'");
  $daten_s = mysql_fetch_array($abfrage_id);

  if ($daten_s[user] == "")
    $senden_id = mysql_query("UPDATE stspy SET user = '$daten_li[prefix].$daten_li[nick]' WHERE ip = '$ip' AND browser = '$browser'");

  /* Spionage Ende */

          /* Login Anfang 2 */

          $ip = getenv("REMOTE_ADDR");
          $timex = time();

          $abfrage_id = mysql_query("SELECT id FROM stonline WHERE ip = '$ip'");

          if (!($daten_pw_ = mysql_fetch_array($abfrage_id)) && ($daten_li[option_autoli] == 1))
          {
            $senden_id = mysql_query("INSERT INTO stonline (prefix,nick,pw,lastrequest,ip,typ) VALUES ('$daten_li[prefix]','$daten_li[nick]','$daten_li[pw]','$timex','$ip','$daten_li[typ]')");
          }

          /* Login Ende 2*/ ?>




<?

if((isset($thefile)) && ($thefile_size > 0))
{
  $dir = "data/replay/";

  $abfrage_id = mysql_query("SELECT id FROM streplays WHERE name = '$thefile_name'");
  $daten_datei = mysql_fetch_array($abfrage_id);

  if ($daten_datei[id] != "")
  {
    echo "Upps, eine Datei mit diesem Namen existiert bereits in der Datenbank! Bitte benenne deine ";
    echo "Datei um.<br><br>";
  }
  else
    if ($thefile_size > 120000)
    {
      echo "Die Datei ist zu gross! Denk daran, dass auch andere noch Dateien hochladen wollen. ";
      echo "Und Speicherplatz ist nur begrenzt vorhanden. Dateien die größer als 120.000 Bytes ";
      echo "(ca. 120 kb) sind, werden deshalb abgelehnt.<br><br>";
    }
    else
    {
      if(!copy($thefile,$dir.$thefile_name))
      {
        if ($thefile_name != "")
          echo "Upps, es passierte ein Fehler beim Kopieren. Speicherkapazitäten erschöpft?<br><br>";
      }
      else
      {
        $senden_id = mysql_query("INSERT INTO streplays (uploaded_by,name,size,beschreibung) VALUES ('$daten_li[prefix].$daten_li[nick]','$thefile_name','$thefile_size','$f_beschreibung')");
        echo "'$thefile_name' erfolgreich hochgeladen.<br><br>";
      }
    }
}

if ($thefile_size == "0")
  echo "Das ist kein gültiger Pfad zu einer Datei!<br><br>";
?>

<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Datei: <input name="thefile" type="file">
<br><br>Beschreibung:<br>
<textarea name="f_beschreibung" rows="4" cols="40" wrap="physical"></textarea><br><br>
<input type="hidden" name="f_nick" value="<? echo "$f_nick"; ?>">
<input type="hidden" name="f_pw" value="<? echo "$f_pw"; ?>">
<input type="submit" value="Senden">
</form>
<br><br>Verwende bitte einen möglichst aussagekräftigen Dateinamen und Beschreibungstext.

<? mysql_close($link); ?>




<? else: ?>


  <? if (!isset($f_pw)): ?>

    <?
    $link = mysql_connect($sql_server,$sql_user,$sql_pass);
    mysql_select_db($sql_db);

    $abfrage_id = mysql_query("SELECT prefix,nick FROM stmembers WHERE typ >= 1 ORDER BY prefix DESC,nick");
    ?>

    <form name="pw_abfrage" action="replays1.php" method="post">
    <table border="0" cellspacing="4">
    <tr><td>Member:</td><td>

    <select name="f_nick">
    <?
    while($daten_li = mysql_fetch_array($abfrage_id))
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

        $loeschen_id = mysql_query("DELETE FROM stonline WHERE lastrequest < '$time_sub'");

        $abfrage_id = mysql_query("SELECT id,prefix,nick,pw,lastrequest FROM stonline WHERE ip = '$ip' AND typ >= 1");

        if ($daten_pw_ = mysql_fetch_array($abfrage_id))
        {
          $timex = time();
          $senden_id = mysql_query("UPDATE stonline SET lastrequest = '$timex' WHERE id = '$daten_pw_[id]'");

          echo "<br>Automatisches Einloggen erfolgt<br><br><br>";
          echo "\n<script language=\"JavaScript\"><!--\n";
          echo "  document.pw_abfrage.f_nick.value = \"$daten_pw_[nick]\";\n";
          echo "  document.pw_abfrage.f_pw.value = \"$daten_pw_[pw]\";\n";
          echo "  document.pw_abfrage.submit();\n";
          echo "//--></script>\n";
        }
        else
        {
          echo "<br><br>";
          echo "<font size=\"-2\"><a href=\"pw.php\">Passwort vergessen</a></font><br><br><br>";
        }

        /* Login Ende 1 */ ?>

    <?
    mysql_close($link);
    ?>

  <? else: ?>
  Na, das war wohl nix.<br><br><a href="fights.php">Zur&uuml;ck</a>

  <? endif ?>
<? endif ?>

</div>
</font>
</body>
</html>