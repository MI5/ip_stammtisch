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
switch (document.cookie)
{
  case "0":
  case "2": document.writeln('<style type="text/css">td,th,ol,ul { color:#FFFFFF }</style>');
  break;

  case "1":
  case "3": document.writeln('<style type="text/css">td,th,ol,ul { color:#0000FF }</style>');
  break;
}

selectbg();
</script>
<noscript><body background="bg_sommer.gif"><font color="#FFFFFF"></noscript>
<div align="center">
<h2>Replays</h2>

<?
$mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);
$abfrage_id = $mysqli->query("SELECT id, datum, uploaded_by, name, size, beschreibung FROM streplays ORDER BY datum");
$mysqli->close();


while($daten = $abfrage_id->fetch_array())
{
  $d = $daten['datum'];
  echo "<table border=\"2\" cellspacing=\"0\" width=\"50%\">";
  echo "<tr><td width=\"60%\"><a href=\"data/replay/$daten[name]\" target=\"_blank\">$daten[name]</a></td><td>Größe: ".round($daten['size']/1024)." KB</td></tr>\n";
  echo "<tr><td colspan=\"2\">$daten[beschreibung]<br><br><font size=\"-2\">Hochgeladen von $daten[uploaded_by] am $d[6]$d[7].$d[4]$d[5].$d[2]$d[3]</font></tr>";
  echo "</table><br>";
}
?>
Zum Speichern: "rechte Maustaste > Ziel speichern unter"

<br><br>
Selbst ein <a href="replays1.php">Replay einliefern</a>

<br><br>
Die Replay-Software gibt es <a href="http://war2bneinsight.webhop.org/" target="_blank">hier</a>.

</div>
</font>
</body>
</html>
