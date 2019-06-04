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

<? if (isset($f_name) || isset($f_source)): ?>

<?
  if ($f_name != "" && $f_source != "")
  {
    $mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

    $senden_id = mysql_query("UPDATE stsource SET source = '$f_source', changedby = '$f_name' WHERE id = 1");

    mail("ncc_1701@gmx.de", "eMail vom Stammtisch", "Source geändert!", "From: Web-Onkel MI5 <Onkel.MI5@der-stammtisch.net>");
    mail("29620640@pager.icq.com", "Stammtisch-News", "Source 1 geändert!");

    $ip = getenv("REMOTE_ADDR");
    $browser = getenv("HTTP_USER_AGENT");
    $beitrag = "Source: 1";

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

    $mysqli->close();
    echo "Quellcode erfolgreich ge&auml;ndert!<br><br><a href=\"fights_meld.php?pw=critterblasen\">Fight melden</a>";
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