<?php
include("vars.inc.php");

include("pageviews.inc");
include("spy.inc");
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="scripte.js"></script>
</head>

<script>
selectbg();
</script>
<noscript><body background="bg_sommer.gif"><font color="#FFFFFF"></noscript>
<div align="center">

<? if (isset($f_name) || isset($f_topic) || isset($f_beitrag)): ?>

<?
  if ($f_name != "" && $f_topic != "" && $f_beitrag != "")
  {
    $mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

    $senden_id = mysql_query("INSERT INTO stnews (name,topic,beitrag) VALUES ('$f_name','$f_topic','$f_beitrag')");


    $abfrage_id = mysql_query("SELECT prefix,nick,wl,option_notself FROM stmembers WHERE typ >= 0 && option_mailsend = 1");
    while($datenXX = mysql_fetch_array($abfrage_id))
    {
      if (($f_name != "$datenXX[prefix].$datenXX[nick]") || ($datenXX[option_notself] != 1))
        mail("$datenXX[wl]", "Neuigkeiten vom Stammtisch", "Neue News eingeliefert von $f_name:\n\n-- $f_topic --\n\n$f_beitrag\n\n\nhttp://www.der-stammtisch.net", "From: Web-Onkel MI5 <Onkel.MI5@der-stammtisch.net>");
    }
    $abfrage_id = mysql_query("SELECT prefix,nick,icq,option_notself FROM stmembers WHERE typ >= 0 && option_icqsend = 1");
    while($datenXX = mysql_fetch_array($abfrage_id))
    {
      if (($f_name != "$datenXX[prefix].$datenXX[nick]") || ($datenXX[option_notself] != 1))
        mail("$datenXX[icq]@pager.icq.com", "Stammtisch", "Neue News eingeliefert");
    }


    $ip = getenv("REMOTE_ADDR");
    $browser = getenv("HTTP_USER_AGENT");
    $beitrag = "News: ".$f_topic;

    $abfrage_id = mysql_query("SELECT user,beitrag FROM stspy WHERE ip = '$ip' AND browser = '$browser'");

    $daten = mysql_fetch_array($abfrage_id);

    if ($daten[user] != "")
    {
      if ($f_name != $daten[user])
        $f_name = $daten[user]."; ".$f_name;
      if ($daten[beitrag] != "")
        $beitrag = $daten[beitrag]."; ".$beitrag;
    }

    $senden_id = mysql_query("UPDATE stspy SET user = '$f_name', beitrag = '$beitrag' WHERE ip = '$ip' AND browser = '$browser'");

    mysql_close($link);
    echo "News erfolgreich eingeliefert!<br><br><a href=\"center.php\">Home</a>";
  }
  else
  {
    echo "Irgendwas ist schief gelaufen. Hast du alle Felder ausgef&uuml;llt?<br><br><a href=\"javascript:history.go(-1)\">Zur&uuml;ck</a>";
  }
?>

<? else: ?>
Mich so aufzurufen ist nicht m&ouml;glich.
<? endif ?>

</div>
</font>
</body>
</html>