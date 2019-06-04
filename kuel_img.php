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
</head>

<script>
selectbg();
</script>
<noscript><body background="bg_sommer.gif"><font color="#FFFFFF"></noscript>

<?
if (isset($id))
{
  $mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

  $abfrage_id = $mysqli->query("SELECT prefix,nick,format FROM stmembers WHERE id = '$id'");
  $datenXX = $abfrage_id->fetch_array();
  echo "<img src=\"$datenXX[format]\">";


  if ($expl != "no")
  {
    echo "<font size=\"1\">";
    echo "<br><br>Konventionen:<br>";
    echo "- Höhe: Maximal 90 Pixel<br>";
    echo "- Breite: Maximal 120 Pixel<br>";
    echo "- Das bild muss transparent sein (.gif)<br>";
    echo "- Es darf auch interlaced sein<br>";
    echo "</font>";
  }

  $mysqli->close();
}
else
{
  echo "Mich so aufzurufen ist nicht möglich";
}



?>
</font>
</body>
</html>