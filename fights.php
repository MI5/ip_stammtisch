<?php
include("vars.inc.php");

include("pageviews.inc");
include("spy.inc");
?>

<html>
<head>
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

<script language="JavaScript"><!--

function details(seite)
{
  Fenster = open(seite,"Fenster","width=280,height=330,screenX=20,screenY=20");
}
//--></script>
</head>

<script language="JavaScript"><!--
selectbg();
//--></script>
<noscript><body background="bg_sommer.gif"><font color="#FFFFFF"></noscript>
<div align="center">

<img src="bilder/hl_fights.gif" width="286" height="60"><br><br>

<img src="bilder/archervsjugg.gif" width ="145" height="104"><br><br>

Bisherige Clanfights
<table border="1" width="500" cellspacing="0">
<tr>
<td width="18%"><b>vs.</b></td><td width="37%"><b>Map</b></td><td width="15%"><b>Modus</b></td><td width="15%"><b>Ausgang</b></td><td width="15%"><b>Beteiligt</b></td>
</tr>

<?
$link = mysql_connect($sql_server,$sql_user,$sql_pass);
mysql_select_db($sql_db);
$abfrage_id = mysql_query("SELECT id,vs,map,modus,result FROM stfights ORDER BY datum");

$gesamt = 0;
$siege = 0;
while($daten = mysql_fetch_array($abfrage_id))
{
  $gesamt++;
  if ($daten[result] == "Sieg")
    $siege++;
  echo "<tr><td>$daten[vs]</td><td>$daten[map]</td><td>$daten[modus]</td><td>$daten[result]</td><td><a href=\"javascript:details('details.php?id=$daten[id]')\">Details</a></td></tr>";
}


$ausgabe = $siege / $gesamt * 100;
$ausgabe = round ($ausgabe,2);
echo "</table><table width=\"444\"><tr><td><div align=\"right\"><br><table><tr><td>";
echo "Siege absolut:</td><td>$siege</td></tr><tr><td>Siege relativ:";
echo "</td><td>$ausgabe%</td></tr></table></div></td></tr></table>";

/*
if (stristr("$browser","MSIE"))
{
  echo "<br>Rechne am besten <a href=\"rechner.php\" target=\"_blank\">selbst</a> nach, ob die Wahrscheinlichkeit richtig ausgerechnet wurde.<br>";
  echo "Der Technik kann man heutzutage ja nicht mehr trauen.";
} */

mysql_close($link);
?>
<br><br>
<a href="fights_meld.php">Meldung machen</a>

</div>
</font>
</body>
</html>