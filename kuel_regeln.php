<?php
include("vars.inc.php");

include("pageviews.inc");
include("spy.inc");
?>

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>Die Kuel-regeln</title>
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="scripte.js"></script>

<script>
switch (document.cookie)
{
  case "0":
  case "2": document.writeln('<style type="text/css">td,th,ol { color:#FFFFFF }</style>');
  break;

  case "1":
  case "3": document.writeln('<style type="text/css">td,th,ol { color:#0000FF }</style>');
  break;
}
</script>

</head>

<script>
selectbg();
</script>
<noscript><body background="bg_sommer.gif"><font color="#FFFFFF"></noscript>

<div align="center">
<img border="0" src="bilder/hl_kuel.gif" width="139" height="55"><br><br>
</div>

<table>
<tr><td>I.</td><td><a href="#chap1">Die Grundregeln</a></td></tr>
<tr><td>II.</td><td><a href="#chap2">Diese Konstellationen bringen Punkte</a></td></tr>
<tr><td>III.</td><td><a href="#chap3">Diese Konstellationen kosten Punkte</a></td></tr>
<tr><td>IV.</td><td><a href="#chap4">Besondere Ereignisse und ihre Bedeutung</a></td></tr>
<tr><td>V.</td><td><a href="#chap5">Definitionen</a></td></tr>
<tr><td>VI.</td><td><a href="#chap6">Siegerehrung</a></td></tr>
</table>

<a name="chap1"><h2>I. Die Grundregeln</h2>
Es gibt 28 Felder. Zur Zählweise: Es wird oben links angefangen zu zählen und dann vertikal nach unten durchnummeriert. Anschließend wird mit der nächsten
Spalte begonnen. (somit z.B. Reykjavík = 1, Lissabon = 4, London = 5 usw.)<br><br>

Jeder Spieler besitzt ein Symbol, mit welchem ihm gehörende Länder markiert werden:<br><br>


<table cellpadding="10">

<?
$mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

$abfrage_id = $mysqli->query("SELECT prefix,nick,format FROM stmembers WHERE typ >= 1 && option_kuel = 1");
while($datenXX = $abfrage_id->fetch_array())
{
  echo "<tr><td><img src=\"$datenXX[format]\"></td><td>$datenXX[prefix].$datenXX[nick]</td></tr>";
}
$mysqli->close();
?>
<!--
<tr><td><img src="bilder/k_becks.gif" width="57" height="90"></td><td>Onkel.Becks</td></tr>
<tr><td><img src="bilder/k_mi5.gif" width="57" height="98"></td><td>Onkel.MI5</td></tr>
<tr><td><img src="bilder/k_arthas.gif" width="118" height="90"></td><td>Onkel.Arthas</td></tr>
<tr><td><img src="bilder/k_erich.gif" width="80" height="88"></td><td>Onkel.Erich</td></tr>
<tr><td><img src="bilder/k_zerius.gif" width="82" height="99"></td><td>Onkel.Zerius</td></tr>
<tr><td><img src="bilder/k_dadga2.gif" width="48" height="48"></td><td>Onkel.Dadga</td></tr>
//-->
</table>


<br><br><br>Außerdem gibt es folgende weitere Symbole: (siehe jeweils Abschnitt IV)<br>


<table cellpadding="10">
<tr><td><img src="bilder/k_feuer.gif" width="80" height="150"></td><td>Verwüstung</td></tr>
<tr><td><img src="bilder/k_war.gif" width="89" height="144"></td><td>Bürgerkrieg</td></tr>
<tr><td><img src="bilder/k_wirtsch.gif" width="282" height="243"></td><td>Wirtschaftl. Kollaps</td></tr>
</table>
<br><br>

Maximal besitzen darf man 10 Felder. Besitzt ein Spieler bereits 10 Felder kann er keinen weiteren Angriff durchführen. Ziel des Spiels ist es möglichst viele Punkte zu erreichen. Wie man diese erreicht, erfährst du in Abschnitt II bzw. auch III.
<br>Mindestens besitzen muss man ein Feld. Das letzte Land eines Spielers kann also nie angegriffen werden, d. h. ein Spieler kann nie vollkommen eliminiert werden.<br><br>
Ein neuer Mitspieler entscheidet sich, um in das Spiel einzusteigen, für ein beliebiges am Rand
befindliches Land. Es muss sich dabei um ein unbesetztes Land handeln. Ist kein Land mehr frei
so muss der Spieler mit den meisten Randländern eines zu Gunsten des Neuankömmlings räumen.<br>
Steigen in einer Runde mehrere Spieler gleichzeitig in das Spiel ein, und entscheiden sie sich
dabei zufällig für das gleiche Land, so wird ein Kampf darum ausgetragen. Der unterlegene Spieler
kann eine Runde später versuchen erneut in das Spiel einzusteigen.<br><br>

Eine Spielrunde dauert eine Woche. Jede Spielrunde darf jeder Spielteilnehmer einen Zug machen. Er hat dazu von Sonntag 0:00 Uhr bis Donnerstag 24:00 Uhr Zeit. Der Freitag und Samstag sind der Rundenauswertung vorbehalten.<br><br>

Folgende Möglichkeiten hat ein Spieler, wenn er an der Reihe ist:<br><br>
<ol>
<li>Ein unbesetztes Nachbarland einnehmen</li>
<li>Ein besetztes Nachbarland angreifen (Es wird ein Spiel im B.Net zwischen dem Angreifer und dem Landinhaber ausgetragen, Die Karte ist die, welche auf das angegriffene Land gedruckt ist. Folgende Einstellungen gelten dabei: Nur ein Arbeiter, Unfixed Order, High Res. Es sei denn es werden im beiderseitigen Einverständnis andere Einstellungen ausgemacht)</li>
<li>Ein Land verlassen, ohne Verwüstung zu hinterlassen</li>
<li>Ein Land verlassen, und dabei Verwüstung hinterlassen (kostet 10 Punkte)</li>
</ol>
<br>

Sollten in einem Zug mehrere Leute Anspruch auf ein unbesetztes Land erheben, so findet ein
Kampf statt (The Winner takes it all).<br>
Sollten mehrere Leute ein besetztes Land im gleichen Spielzug angreifen wollen,
so wird, sofern es die Map zuläßt, ein FFA (Modus: Nahkampf) darum ausgetragen. Heimliche
Absprachen während eines solchen FFA sind ausdrücklich erlaubt. Sollte die Map dies nicht
ermöglichen, so gilt der folgende Absatz.<br><br>

Es wird die Aktion des Spielers mit der geringsten Punktzahl zuerst ausgeführt (es gibt eine Ausnahme).
Danach die des mit der zweitgeringsten Punktzahl, usw. Bei Punktegleichstand entscheidet die Reihenfolge des
Eintreffens (wer früher einliefert, kommt früher dran).<br><br>
Ein Land kann pro Spielrunde nur einmal angegriffen werden.

<a name="chap2"><h2>II. Diese Konstellationen bringen Punkte</h2>

<table cellpadding="2">
<tr align="left"><th>Konstellation</th><th>Anzahl Punkte</th></tr>
<tr><td>pro Staat</td><td>1</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>darüber hinaus ZUSÄTZLICH:</td><td>&nbsp;</td></tr>
<tr><td>7 zusammenhängende Staaten</td><td>7 (Kombination erhält nur einmal pro Runde Punkte)</td></tr>
<tr><td>10 EU-Staaten</td><td>60 (+ Map-Override-Recht)</td></tr>
<tr><td>10 x EU inkl. Brüssel</td><td>100 (+ zusätzlich Map-Einstellungen-Override-Recht)</td></tr>
<tr><td>7 WEU-Staaten</td><td>34 (+ Schutz vor Wirtschaftlichem Kollaps)</td></tr>
<tr><td>8 Nato-Staaten</td><td>40 (+ Verteidigungsbonus)</td></tr>
<tr><td>Moskau und 3 ehemalige WP-Staaten</td><td>20 (+ Schutz vor Bürgerkrieg)</td></tr>
<tr><td>Alle 6 ehemaligen WP-Staaten</td><td>40 (+ Zugvorrecht-Bonus)</td></tr>
<tr><td>Alle 3 Deutschsprachigen</td><td>15 (+ Punktabzug-Schutz)</td></tr>
<tr><td>Verbindung von Westen nach Osten</td><td>33</td></tr>
<tr><td>Verbindung von Norden nach Süden</td><td>22</td></tr>
<tr><td>Die Schweiz ohne Nachbarländer</td><td>14 (+ Devisen-Bonus)</td></tr>
</table>
<br><br>
WP = Warschauer Pakt
<br><br>
Erläuterung zum Map-Override-Recht: Der Spieler darf, wenn er angegriffen wird (nur dann!),
entscheiden auf welcher Map gespielt wird, unabhängig von der auf dem aktuellem Land genannten.
Es muss sich dabei um eine Map handeln, die irgendwo auf der KUEL-Karte verzeichnet ist.<br>
Mit Brüssel darf der Spieler auch noch die Spieleinstellungen in Eigenregie festlegen (d.h. z.B.
resources sowie fixed ja/nein sowie "one peasant" ja/nein sowie den speed.<br><br>

Erläuterung zum Verteidigungsbonus: Unterliegt der Inhaber des Verteidigerbonus in einer beliebigen
auf der KUEL-Karte ausgetragenen Schlacht, so darf er ein Rematch fordern. Erst wenn er dieses auch
verliert, muss er sein Land endgültig abgeben. Handelte es sich dabei um ein Land, das für das Erhalten
des Verteidigungsbonus notwendig war, verliert er natürlich auch diesen.<br><br>

Erläuterung zum Punktabzug-Schutz: Keinerlei der in Abschnitt III erläuterten Konstellationen wirkt sich
noch negativ für den Spieler aus.<br><br>

Erläuterung zum Zugvorrecht-Bonus: Bei der Zugausführung wird man auf jedenfall zuerst berücksichtigt.
Gibt es für die Einnahme eines Landes (besetzt oder auch unbesetzt) in einer Spielrunde mehrere Bewerber,
brauch sich der Spieler auf kein FFA mehr einzulassen. Er bekommt das Land sofort zugesprochen bzw. darf es angreifen.<br><br>

Erläuterung zum Devisen-Bonus: Findet durch den Wirtschaftszusammenbruch eines unbesetzten Landes
eine Versteigerung statt, so gilt das Gebot des Spielers mit dem Devisen-Bonus immer doppelt. Er brauch
dabei jedoch nur seinen tatsächlich im Gebot genannten Betrag zu bezahlen.<br>
Der Devisen-Bonus kann auch für ein Nachbarland der Schweiz genutzt werden. Danach verfällt der
Devisen-bonus jedoch logischerweise.<br><br>

<a name="chap3"><h2>III. Diese Konstellationen kosten Punkte oder wirken sich anderweitig negativ aus</h2>

<table cellpadding="2">
<tr align="left"><th>Konstellation</th><th>Anzahl Punktabzug</th></tr>
<tr><td>Achsenmächte Berlin-Wien-Rom</td><td>-20 (ABER: man darf bis zu 15 Länder besitzen)</td></tr>
<tr><td>Deutschland und Niederlande gleichzeitig</td><td>-6</td></tr>
<tr><td>Jugoslawien und Kroatien gleichzeitig</td><td>-8</td></tr>
<tr><td>Großbritanien und Irland gleichzeitig</td><td>-16</td></tr>
<tr><td>Tschechien und Slowakei gleichzeitig</td><td>-16</td></tr>
<tr><td>Die Schweiz mit Nachbarländern</td><td>-1 pro Nachbarland</td></tr>
</table>

<a name="chap4"><h2>IV. Besondere Ereignisse und ihre Bedeutung</h2>

<tr><td><img src="bilder/k_feuer.gif" width="80" height="150" align="left" vspace="10" hspace="10">Verwüstung: Das mit diesem Symbol markierte Land ist verwüstet. Es kann nicht betreten werden. Die Verwüstung hält drei Spielrunden an. Verwüstet ist ein Land immer dann, wenn ein Spieler dieses verwüstet verläßt.<br><br>
<br clear="all">
<br><br>

<tr><td><img src="bilder/k_war.gif" width="89" height="144" align="left" vspace="10" hspace="10">Bürgerkrieg: Herrscht in einem Land Bürgerkrieg, so ist es nicht mehr regierbar. Sollte ein Spieler ein Land besitzen, in dem gerade Bürgerkrieg ausbricht, verliert er dieses sofort. Möchte ein benachbarter Spieler dieses Land einnehmen, so muss er für 20 Punkte
Söldner anheuern, damit diese dort wieder für Ruhe sorgen und den Bürgerkrieg beenden. Jede Runde bricht in einem anderen Land Bürgerkrieg aus. Mit einer höheren Wahrscheinlichkeit betroffen sind die Oststaaten. Wie folgt wird das Land in dem Bürgerkrieg ausbricht, ermittelt: Es wird der Ganzzahlige Anteil des Wochen-abschlusswertes des
DAX (Deutscher AktienindeX) betrachtet (der letzte Stand des DAX am Freitag, bevor die Börsen schließen). Die letzten beiden Ziffern bezeichnen das Land in dem Bürgerkrieg ausbricht. Sollte die Zahl größer als 28 sein, so wird sie so lange durch zwei geteilt bis sie kleiner oder gleich 28 ist, und sich das Land somit ermitteln läßt,
in dem Bürgerkrieg ausbricht. Sollte beim teilen keine glatte Zahl herauskommen, sondern ein Kommawert so wird dieser abhängig vom an diesem Freitag aktuellen Eurokurs gerundet. Ist der Euro mehr wert als der Dollar so wird abgrundet, ist der Euro weniger wert als der Dollar so wird aufgerundet.
Sollte es sich bei dem Freitag um einen Feiertag handeln, und der Abschlusswert des DAX somit bereits am Donnerstag feststehen, bricht diese Spielrunde kein Bürgerkrieg aus.<br><br>
<br clear="all">

<tr><td><img src="bilder/k_wirtsch.gif" width="282" height="243" align="left">Witschaftlicher Kollaps: Bricht die Wirtschaft eines Landes zusammen, so muss diese über einen längeren Zeitraum hinweg wieder aufgebaut werden. Sollte das Land gerade besetzt sein, so kann sich der Landinhaber seiner Verantwortung NICHT entziehen und das Land
einfach verlassen. Er muss über drei Spielrunden hinweg dem angeschlagenen Land Wiederaufbauhilfen in Höhe von jeweils 20 Punkten zukommen lassen. Ist es unbesetzt so darf jeder Spieler, auch ein nicht benachbarter, ein geheimes Gebot für dieses wirtschaftlich runinierte Land abgeben. Das höchste Gebot gewinnt und der Spieler erhält dieses
Land. Man gewinnt auf diesem Wege somit ein nicht angrenzendes Land ohne Blutvergießen. Von einem Wirtschaftlichen Kollaps sind mit einer höheren Wahrscheinlichkeit die Oststaaten betroffen. Um zu ermitteln ob und in welchem Land es einen wirtschaftlichen Kollaps gibt, wird wie folgt verfahren: Wird beim Samstagslotto eine Schnapszahl (11,22,33,44)
gezogen,so tritt ein wirtschaftlicher Kollaps auf. Man ermittelt in diesem Fall die erste Zahl des Samstagslotto die kleiner ist als 29. Jenes Land ist dann betroffen. Sollte keine gezogene Lottozahl kleiner als 29 sein, so kommt es zu einem Weltwirtschaftszusammenbruch: Jeder Spieler verliert 39/40 seiner angesammelten Punkte.<br><br>
<br clear="all">

Besondere Ereignisse treten immer nur dann ein, wenn in dieser Woche auch tatsächlich ein Zug eingereicht wurde.<br><br>

<a name="chap5"><h2>V. Definitionen</h2>

<h4>EU-Länder</h4>
Belgien, Dänemark, Deutschland, Finnland, Frankreich, Griechenland, Großbritannien, Irland,
Italien, Niederlande, Österreich, Portugal, Schweden, Spanien, (Luxemburg)




<br><br>
<h4>WEU-Länder</h4>
Belgien, Deutschland, Frankreich, Griechenland, Großbritannien,
Italien, Niederlande, Portugal, Spanien, (Luxemburg)


<br><br>
<h4>NATO-Mitgliedstaaten</h4>
Belgien, Dänemark, Deutschland, Frankreich, Griechenland, Großbritannien, Island,
Italien, Niederlande, Norwegen, Polen, Portugal, Spanien, Tschechische Republik, Ungarn
(Kanada, Luxemburg, USA, Türkei)


<br><br>
<h4>Staaten, die ehemals dem Warschauer Pakt angehörten</h4>
Bulgarien, Polen, Sowjetunion, Tschechoslowakei (bei KUEL entsprechen
BEIDE Nachfolgestaaten dieser Definition: Tschechische Republik und Slowakei), Ungarn,
(Albanien, DDR, Rumänien)


<br><br>
<div align="center">
<a href="europa.php" target="_blank">Europas Länder und seine Hauptstädte</a>
</div>

<br><br>
<a name="chap6"><h2>VI. Siegerehrung</h2>
Jeden Monat wird der punktführende Spieler ermittelt. Er bekommt eine Packung Onkelchens zur
weiteren Motivation zugeschickt.<br><br>
<div align="center">
<img src="bilder/onkelchen.gif" width="241" height="396"><br><br>
</div>
Das ist durchaus Ernst gemeint! Ich als Spielleiter musste natürlich bereits eine Packung
Onkelchens kosten, um ihre Qualität zu beurteilen. Und ich muss sagen, sie
schmecken äußerst lecker!  Also strengt euch an, damit ihr als Monatssieger auch eine Packung
zugeschickt bekommt. Wenn ihr es nicht bis dahin aushaltet, dann sind die Onkelchens natürlich
auch in unserem <a href="onlineshop.php">Onleinschob</a> bestellbar!

<br><br><br><br><br>Die Regeln wurden ausgearbeitet von Onkel.MI5.<br>
Diverse Ratschläge stammen von Onkel.Becks.<br>
Diverse Grafiken stammen von K.K..


</font>
</body>
</html>
