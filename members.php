<?php
include("vars.inc.php");

include("pageviews.inc");
include("spy.inc");
?>

<html>
<head><title>Mitglieder</title></head>
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="scripte.js"></script>
<script>
function erklaerung(seite,x)
{
  Fenster = open(seite,"Fenster","width=280,height="+x+",screenX=20,screenY=20");
}
</script>

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


<h2>Mitgliederliste</h2>

<table border="0" cellspacing="5" width="100%">
<tr align="left"><th>Nick</th><th>Name</th><th>Status</th><th>Onkel seit</th><th>Ort</th><th>ICQ</th></tr>
<tr align="left"><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th></tr>

<?
$mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

$abfrage_id = $mysqli->query("SELECT prefix,nick,name,status,since,location,email,icq,option_icqshow FROM stmembers WHERE typ >= 1 ORDER BY nick");

while($daten = mysql_fetch_array($abfrage_id))
{
  echo "<tr>";
  echo "<td>$daten[prefix].$daten[nick]";
  echo "</td><td>$daten[name]</td>";
  echo "<td><a href=\"javascript:erklaerung('";

  switch ($daten[status])
  {
    case "Web-Onkel":
      echo "webonkel.php','350";
      break;

    case "Ober-Onkel":
      echo "oberonkel.php','370";
      break;

    case "Präsidenten-O.":
      echo "leaderonkel.php','460";
      break;

    case "Prüf-Onkel":
      echo "pruefonkel.php','370";
      break;

    case "Presse-Onkel":
      echo "presseonkel.php','440";
      break;

    default:
      echo "normaloonkel.php','371";
  }
  echo "')\">$daten[status]</a></td>";
  echo "<td>$daten[since]</td><td>$daten[location]</td>";
  if ($daten[option_icqshow] == 1)
    echo "<td><font size=\"1\">$daten[icq]</font></td>";
  else
    echo "<td><font size=\"1\">N/A</font></td>";
  echo "</tr>";
}
?>

</table>
<br>
<img src="bilder/sw.gif" width="150" height="105">

<br>
<h4>Von uns gegangene Vorfahren <img src="bilder/cry.gif"></h4>
Onkel.Ewald<br>
Onkel.Franz<br>
Tante.Stella<br>
Onkel.Daniel<br>
Tante.Sandra<br>
Onkel.Fuzzy<br>
Onkel.Deddie<br>
Onkel.Scotty<br>
Onkel.Darss<br>
Onkel.Roland<br>

<?
$abfrage_id = $mysqli->query("SELECT prefix,nick FROM stmembers WHERE typ = -1 ORDER BY datum");

while($daten = mysql_fetch_array($abfrage_id))
{
  echo "$daten[prefix].$daten[nick]<br>";
}
?>

<br>
<h4>Onkelanw&auml;rter <img src="bilder/smokin.gif"></h4>

<?
$abfrage_id = $mysqli->query("SELECT prefix,nick FROM stmembers WHERE typ = 0 ORDER BY nick");

while($daten = mysql_fetch_array($abfrage_id))
{
  echo "$daten[prefix].$daten[nick]<br>";
}

$mysqli->close();
?>

</font>
</body>
</html>