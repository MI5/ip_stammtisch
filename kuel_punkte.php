<?php
include("vars.inc.php");

include("pageviews.inc");
include("spy.inc");
?>

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>Der KUEL-Punktestand</title>
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="scripte.js"></script>

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

function open__window(id)
{
  Fenster = open("kuel_img.php?id="+id+"&expl=no","Fenster","width=150,height=150,screenX=20,screenY=20");
}
</script>

</head>

<script>
selectbg();
</script>
<noscript><body background="bg_sommer.gif"><font color="#FFFFFF"></noscript>

<div align="center">
<img border="0" src="bilder/hl_kuel.gif" width="139" height="55"><br><br>


<table border="2" cellpadding="4" cellspacing="0">
<tr align="left"><th>Platz</th><th>Spieler</th><th>Bild</th><th>Punkte</th></tr>
<?
$mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

$abfrage_id = mysql_query("SELECT id,prefix,nick,name,points FROM stmembers WHERE typ >= 1 && option_kuel = 1 ORDER BY points DESC,Nick ASC");
$i = 1;
while($datenXX = mysql_fetch_array($abfrage_id))
{
  echo "<tr><td>$i</td><td>$datenXX[prefix].$datenXX[nick]</td><td><a href=\"javascript:open__window('$datenXX[id]')\">show</a></td><td>$datenXX[points]</td></tr>";
  $i++;
}
?>
</table>

<br><br>
<img src="bilder/mining.gif" alt="" height="96" width="244">

</div>
<?
$abfrage_id = mysql_query("SELECT * FROM stkuel ORDER BY id DESC");
$daten = mysql_fetch_array($abfrage_id);

echo "<h2>Wir befinden uns in der $daten[woche]</h2>";
echo "DAX-Kurs: $daten[dax]<br>";
echo "Der Euro zum Dollar: $daten[euro]<br>";
echo "Lottozahlen: $daten[lotto1], $daten[lotto2], $daten[lotto3], $daten[lotto4], $daten[lotto5], $daten[lotto6]<br>";
echo "<ul><li>$daten[krieg]</li>";
echo "<li>$daten[wirtschaft]</li></ul>";
echo "$daten[text]";
?>

<div align="center">
<a href="kuel_karte.php">Zur Karte</a>
</div>
</font>
</body>
</html>
<?
$mysqli->close();
?>
