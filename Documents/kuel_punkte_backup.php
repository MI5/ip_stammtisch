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
mysql_close($link);
?>
</table>

<br><br>
<img src="bilder/mining.gif" alt="" height="96" width="244">

</div>

<h2>2. Dezemberwoche 2002</h2>
DAX-Kurs: ?<br>
Der Euro zum Dollar: ?<br>
Lottozahlen: ?<br>
<ul>
<li>Es bricht kein Bürgerkrieg aus</li>
<li>Es tritt kein Wirtschaftlicher Kollaps auf.</li>
</ul>
Im Westen gab es ein heftiges Gefecht um Bern. Erich gewinnt und zerstört somit die Nord-Süd
Verbindung von MI5. Dies bedeudet einen herben Rückschlag für die Expansionspläne von MI5.
Becks dehnt sich ungestört im Osten aus.
<br><br><br>


<h2>1. Dezemberwoche 2002</h2>
DAX-Kurs: 3193,67 (Kurs von 19:00 Uhr)<br>
Der Euro zum Dollar: ?<br>
Lottozahlen: 6, 8, 9, 24, 34, 40<br>
<ul>
<li>93 => 23 => In <b>Skopje</b> bricht kein Bürgerkrieg aus (Arthas letztes Land)</li>
<li>Es tritt kein Wirtschaftlicher Kollaps auf.</li>
</ul>
Europa wird Schritt für Schritt in Machtspheren aufgeteilt.
<br><br><br>

<h2>4. Novemberwoche 2002</h2>
DAX-Kurs: 3320,3<br>
Der Euro zum Dollar: 0,9927<br>
Lottozahlen: 7, 9, 10, 11, 43, 47<br>
<ul>
<li>20 => 20 => In <b>Zagreb</b> bricht Bürgerkrieg aus</li>
<li>Es tritt kein Wirtschaftlicher Kollaps auf.</li>
</ul>
Sowohl Arthas und Zerius als auch Becks wollen Sofia haben. Doch nur einer konnte sich
durchsetzen: Der bisher ungeschlagene Becks. Und damit hat Becks sich eine
Nord-Süd-Verbindung geschaffen, mit welcher er richtig viele Punkte bekommt.
<br><br><br>


<h2>3. Novemberwoche 2002</h2>
DAX-Kurs: 3320,9<br>
Der Euro zum Dollar: 1,0024<br>
Lottozahlen: 12, 16, 32, 34, 43,<b><i>44</i></b><br>
<ul>
<li>20 => 20 => In <b>Zagreb</b> bricht Bürgerkrieg aus</li>
<li><b><i>44</i></b>: 16 => In <b>Rom</b> tritt ein Wirtschaftlicher Kollaps auf</li>
</ul>
Es kommt zu einem ersten Kampf! Sowohl Arthas als auch MI5 marschieren in Wien ein und treffen
dort aufeinander. MI5 entscheidet die Schlacht für sich. Arthas muss sich wieder zurückziehen.
Gleichzeitig verliert Arthas ein Land durch Bürgerkrieg. Ihm verbleibt somit nur noch eines!
Alle anderen Spieler expandieren weiterhin fröhlich vor sich hin.
<br><br><br>


<h2>2. Novemberwoche 2002</h2>
DAX-Kurs: 3191,8<br>
Der Euro zum Dollar: 1,0029<br>
Lottozahlen: 3, 7, 13, 14, 24,<b><i>44</i></b><br>
<ul>
<li>91:2:2 = 22,75 => 22 => In <b>Belgrad</b> bricht Bürgerkrieg aus</li>
<li><b><i>44</i></b>: 24 => In <b>Athen</b> tritt ein Wirtschaftlicher Kollaps auf</li>
</ul>
Alle Spieler expandieren. Noch gab es keine Kampfhandlungen. Doch inzwischen berühren sich
schon mehrere Machtspheren. Wer wird es wagen anzugreifen? Zerius hat auch ohne Kampf zu kämpfen.
Er wurde von einem Wirtschaftlichem Kollaps in Athen überrascht und rutscht somit tief ins Minus.
<br><br><br>

<h2>1. Novemberwoche 2002</h2>
DAX-Kurs: 3079,1<br>
Der Euro zum Dollar: 1,0107<br>
Lottozahlen: 1, 24, 27, 32, 38, 43<br>
<ul>
<li>79:2:2 = 19,75 => 19 => In <b>Budapest</b> bricht Bürgerkrieg aus</li>
<li>Es tritt kein Wirtschaftlicher Kollaps auf.</li>
</ul>
MI5 sichert sich die Schweiz ohne Nachbarland, und kassiert so von Anfang an gleich ordentlich
ab. Becks versucht sein Glück im kalten Russland (und das zu dieser Jahreszeit). Erich plant die
Einnahme der "Europäischen Hauptstadt" Brüssel, und probiert diese über Spanien zu erreichen.
Arthas wagt die Eroberung von Kroatien. Wird jedoch gleich mit einem ganz in der Nähe
ausbrechenden Bürgerkrieg konfrontiert. Wird dieser übergreifen? Zerius agiert ganz in der Nähe
und hat sich Bulgarien geschnappt.

<div align="center">
<a href="kuel_karte.php">Zur Karte</a>
</div>
</font>
</body>
</html>
