<?php
include("vars.inc.php");

include("pageviews.inc");
include("spy.inc");

$mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);


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

$abfrage_id = $mysqli->query("SELECT dauer_ende FROM stspy WHERE ip = '$ip' AND browser = '$browser'");

$daten = mysql_fetch_array($abfrage_id);

if (($dauer_start - $daten[dauer_ende] - 7200) > 0)
{
  $senden_id = $mysqli->query("INSERT INTO stspy (ip, host, port, browser, cookie_inhalt, evtl_id, ursprung, adresszeile, erweiterte_url, variablen, accept, zeichensatz, sprache, http_status, dauer_start) VALUES ('$ip', '$host', '$port', '$browser', '$cookie_inhalt', '$evtl_id', '$ursprung', '$adresszeile','$erweiterte_url', '$variablen', '$accept', '$zeichensatz', '$sprache', '$http_status','$dauer_start')");
}

$abfrage_id = $mysqli->query("SELECT id,name,topic,datum,beitrag,email,intern FROM stammtisch2 ORDER BY datum DESC");
?>



<html>
<head>
<title>Kuel-Forum</title>
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
<noscript>
<body background="bg_sommer.gif"><font color="#FFFFFF">
</noscript>

<div align="center">
<h2>Kuel-Forum</h2>

<?
$in_pw  = 0;
$in_aus = 0;
?>

<?
if (isset($f_name) || isset($f_email) || isset($f_topic) || isset($f_intern) || isset($f_beitrag))
{
  if ($f_name != "" && $f_topic != "" && $f_beitrag != "")
  {
    if ($f_email == "")
      $f_email = "[none]";
    $senden_id = $mysqli->query("INSERT INTO stammtisch2 (name,email,topic,beitrag,intern) VALUES ('$f_name','$f_email','$f_topic','$f_beitrag','$f_intern')");



    if ($f_intern == "1")
    {
      $abfrage_id = $mysqli->query("SELECT prefix,nick,wl,option_notself FROM stmembers WHERE typ >= 0 && option_mailsend = 1");
      while($datenXX = mysql_fetch_array($abfrage_id))
      {
        if (($f_name != "$datenXX[prefix].$datenXX[nick]") || ($datenXX['option_notself'] != 1))
          mail("$datenXX[wl]", "Neuigkeiten vom Stammtisch", "Neuer Forenbeitrag (Kuelforum) von $f_name:\n\nIntern: Ja\n\n-- $f_topic --\n\n$f_beitrag\n\n\nhttp://www.der-stammtisch.net", "From: Web-Onkel MI5 <Onkel.MI5@der-stammtisch.net>");
      }
      $abfrage_id = $mysqli->query("SELECT prefix,nick,icq,option_notself FROM stmembers WHERE typ >= 0 && option_icqsend = 1");
      while($datenXX = mysql_fetch_array($abfrage_id))
      {
        if (($f_name != "$datenXX[prefix].$datenXX[nick]") || ($datenXX['option_notself'] != 1))
          mail("$datenXX[icq]@pager.icq.com", "Stammtisch", "Neuer Forenbeitrag (Kuelforum)");
      }
    }
    else
    {
      $abfrage_id = $mysqli->query("SELECT prefix,nick,wl,option_notself FROM stmembers WHERE typ >= 0 && option_mailsend = 1");
      while($datenXX = mysql_fetch_array($abfrage_id))
      {
        if (($f_name != "$datenXX[prefix].$datenXX[nick]") || ($datenXX['option_notself'] != 1))
          mail("$datenXX[wl]", "Neuigkeiten vom Stammtisch", "Neuer Forenbeitrag (Kuelforum) von $f_name:\n\n-- $f_topic --\n\n$f_beitrag\n\n\nhttp://www.der-stammtisch.net", "From: Web-Onkel MI5 <Onkel.MI5@der-stammtisch.net>");
      }
      $abfrage_id = $mysqli->query("SELECT prefix,nick,icq,option_notself FROM stmembers WHERE typ >= 0 && option_icqsend = 1");
      while($datenXX = mysql_fetch_array($abfrage_id))
      {
        if (($f_name != "$datenXX[prefix].$datenXX[nick]") || ($datenXX['option_notself'] != 1))
          mail("$datenXX[icq]@pager.icq.com", "Stammtisch", "Neuer Forenbeitrag (Kuelforum)");
      }
    } 

    $ip = getenv("REMOTE_ADDR");
    $browser = getenv("HTTP_USER_AGENT");
    $beitrag = "Forum: ".$f_topic;

    $abfrage_id = $mysqli->query("SELECT user,beitrag FROM stspy WHERE ip = '$ip' AND browser = '$browser'");

    $daten = mysql_fetch_array($abfrage_id);

    if ($daten[user] != "")
    {
      if ($f_name != $daten['user'])
        $f_name = $daten['user']."; ".$f_name;
      if ($daten['beitrag'] != "")
        $beitrag = $daten['beitrag']."; ".$beitrag;
    }

    $senden_id = $mysqli->query("UPDATE stspy SET user = '$f_name', beitrag = '$beitrag' WHERE ip = '$ip' AND browser = '$browser'");


    $abfrage_id = $mysqli->query("SELECT id,name,topic,datum,beitrag,email,intern FROM stammtisch2 ORDER BY datum DESC");

    echo "Eintrag erfolgreich hinzugef&uuml;gt!<br><br><br>";
  }
  else
  {
    echo "Ein nicht-optionaler Eintrag wurde nicht angegeben! Vorgang abgebrochen.<br><br><a href=\"javascript:history.go(-1)\">Zur&uuml;ck</a><br><br><br>";
    $in_aus = 1;
  }
}
?>


<?
if (isset($b))
{

  if ($b == 0)
  {
    echo "<div align=\"center\">";
    echo "<form name=\"beitr\" action=\"kuelforum.php\" method=\"post\">";
    echo "<table>";
    echo "<tr>";

    $ip = getenv("REMOTE_ADDR");
    $browser = getenv("HTTP_USER_AGENT");

    $abfrage_id = $mysqli->query("SELECT user FROM stspy WHERE ip = '$ip' AND browser = '$browser'");
    $daten_user = mysql_fetch_array($abfrage_id);

    echo "  <td>Name:</td><td><input name=\"f_name\" value=\"$daten_user[user]\" size=\"30\" maxlength=\"30\"></td>";
    echo "</tr>";
    //echo "  <tr><td>eMail:</td><td><input name=\"f_email\" size=\"30\" maxlength=\"30\"> (Optional)</td></tr>";
    echo "<tr>";
    echo "  <td>Betreff:</td><td><input name=\"f_topic\" size=\"30\" maxlength=\"200\"></td>";
    echo "</tr>";
    //echo "  <tr><td>Clanintern:</td><td><input type=\"checkbox\" value=\"1\" name=\"f_intern\"></td></tr>";
    echo "</table>";
    echo "<textarea name=\"f_beitrag\" rows=\"10\" cols=\"50\" wrap=\"physical\"></textarea><br><br>";
    echo "<input type=\"reset\" value=\"L&ouml;schen\">";
    echo "<input type=\"submit\" value=\"Eintragen\">";
    echo "</form>";
    echo "</div><br><br>";

    ?>
    <script>

    if(document.beitr.f_name.value == "")
    {
      document.beitr.f_name.focus();
    }
    else
    {
      document.beitr.f_topic.focus();
    }
    </script>
    <?

  }
  else
  {
    $abfrage_id = $mysqli->query("SELECT id,name,topic,datum,beitrag,email,intern FROM stammtisch2 WHERE id = $b");
    $daten = mysql_fetch_array($abfrage_id);

    if ($daten['intern'] == 1)
    {
      if (!isset($f_pw))
      {
        $abfrage_id = $mysqli->query("SELECT prefix,nick FROM stmembers WHERE typ >= 1 ORDER BY prefix DESC,nick");

        ?>
        <form name="pw_abfrage" action="kuelforum.php?b=<? echo "$daten[id]"; ?>" method="post">
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

        <?
        /* Login Anfang 1 */

        $ip = getenv("REMOTE_ADDR");
        $time_sub = time();
        $time_sub -= 600;

        $loeschen_id = $mysqli->query("DELETE FROM stonline WHERE lastrequest < '$time_sub'");

        $abfrage_id = $mysqli->query("SELECT id,prefix,nick,pw,lastrequest FROM stonline WHERE ip = '$ip' AND typ >= 1");

        if ($daten_pw_ = mysql_fetch_array($abfrage_id))
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

        /* Login Ende 1 */

      }
      else
      {
        $abfrage_id = $mysqli->query("SELECT id,prefix,nick,name,pw,typ,option_autoli FROM stmembers WHERE typ >= 0 AND nick = '$f_nick' AND pw = '$f_pw'");

        if (($daten_li = mysql_fetch_array($abfrage_id)) && ($f_pw != ""))
        {
          $pw = "critterblasen";

          /* Spionage Anfang */

          $ip = getenv("REMOTE_ADDR");
          $browser = getenv("HTTP_USER_AGENT");

          $abfrage_id = $mysqli->query("SELECT user FROM stspy WHERE ip = '$ip' AND browser = '$browser'");
          $daten_s = mysql_fetch_array($abfrage_id);

          if ($daten_s['user'] == "")
            $senden_id = $mysqli->query("UPDATE stspy SET user = '$daten_li[prefix].$daten_li[nick]' WHERE ip = '$ip' AND browser = '$browser'");

          /* Spionage Ende */
          /* Login Anfang 2 */

          $ip = getenv("REMOTE_ADDR");
          $timex = time();

          $abfrage_id = $mysqli->query("SELECT id FROM stonline WHERE ip = '$ip'");

          if (!($daten_pw_ = mysql_fetch_array($abfrage_id)) && ($daten_li[option_autoli] == 1))
          {
            $senden_id = $mysqli->query("INSERT INTO stonline (prefix,nick,pw,lastrequest,ip,typ) VALUES ('$daten_li[prefix]','$daten_li[nick]','$daten_li[pw]','$timex','$ip','$daten_li[typ]')");
          }

          /* Login Ende 2*/
        }
        else
        {
          echo "Passwort zur&uuml;ckgewiesen!<br><br><a href=\"kuelforum.php\">Weiter</a>";
          $in_pw = 1;
        }
      }
    }
    else
      $pw = "critterblasen";

    if ($pw == "critterblasen")
    {
      $d = (string) $daten[datum];

      if ($daten[intern] == 1)
        echo "<table width=\"70%\"><tr><td><b><img src=\"bilder/schluessel.gif\" width=\"15\" height=\"7\"> $daten[topic]</b></td></tr></table>";
      else
        echo "<table width=\"70%\"><tr><td><b>$daten[topic]</b></td></tr></table>";
      echo "<table cellspacing=\"0\" cellpadding=\"3\" width=\"70%\" border=\"4\">";
      $beitragx = $daten['beitrag'];
      $beitragx = preg_replace("/(\015\012)|(\015)|(\012)/","<br>",$beitragx);

      $beitragx = str_replace("dinkelchen", "onkelchen", $beitragx);
      $beitragx = str_replace("Dinkelchen", "Onkelchen", $beitragx);
      $beitragx = str_replace("DINKELCHEN", "ONKELCHEN", $beitragx);

      echo "<tr><td>$beitragx";
      echo "<br><br><br>Verfasst von ";
      if ($daten[email] == "[none]")
        {echo "$daten[name]";}
      else
        {echo "<a href=\"mailto:$daten[email]\">$daten[name]</a>";}
      echo " am $d[6]$d[7].$d[4]$d[5].$d[0]$d[1]$d[2]$d[3] um $d[8]$d[9]:$d[10]$d[11]";
      echo "</td></tr></table><br>";

      $abfrage_id = $mysqli->query("SELECT id,name,topic,datum,beitrag,email,intern FROM stammtisch2 ORDER BY datum DESC");
    }
  }
}
?>

<?
  if (isset($b))
  {
    if ($b != 0)
    {
      if ($in_pw != 1)
      {
          echo "<a href=\"kuelforum.php?b=0\">Beitrag posten</a><br><br>";
      }
    }
  }
  else
    if ($in_aus != 1)
    {
      echo "<a href=\"kuelforum.php?b=0\">Beitrag posten</a><br><br>";
    }
?>

<table width="80%">
<?
$abfrage_id = $mysqli->query("SELECT id,name,topic,datum,beitrag,email,intern FROM stammtisch2 ORDER BY datum DESC LIMIT 40");
while($daten = mysql_fetch_array($abfrage_id))
{
  $style = "";
  if (isset($b))
    if ($daten['id'] == $b)
      $style = "style=\"color: #C0C0C0\"";


  if ($daten['intern'] == 1)
  {
    echo "<tr>\n  <td width=\"50%\"><img src=\"bilder/schluessel.gif\" width=\"15\" height=\"7\"> ";
    if ($style == "")
      echo "<a href=\"kuelforum.php?b=$daten[id]\">";
    echo "$daten[topic]";
    if ($style == "")
      echo "</a>";
    echo "</td>\n";
  }
  else
  {
    echo "<tr>\n  <td width=\"50%\"><img src=\"bilder/trans.gif\" width=\"15\" height=\"7\">  ";
    if ($style == "")
      echo "<a href=\"kuelforum.php?b=$daten[id]\">";
    echo "$daten[topic]";
    if ($style == "")
      echo "</a>";
    echo "</td>\n";
  }
  echo "  <td>von $daten[name]</td>\n";
  echo "  <td align=\"right\">";
  $d = (string) $daten['datum'];
  echo "$d[6]$d[7].$d[4]$d[5].$d[0]$d[1]$d[2]$d[3]&nbsp;$d[8]$d[9]:$d[10]$d[11]";
  echo "</td>\n</tr>\n";
}
?>
</table>

</div>


</font>
</body>
</html>

<?
$mysqli->close();
?>
