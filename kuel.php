<?php
include("pageviews.inc");
include("spy.inc");
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="scripte.js"></script>

<script >
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

<div align="center">
<img border="0" src="bilder/hl_kuel.gif" width="139" height="55"><br><br>


<table cellpadding="15">
 <tr>
  <th colspan="5">Kuel, das ist der 'Kampf um Europas L&auml;nder'<br>&nbsp;</th>
 </tr>
 <tr>
  <th><a href="kuel_karte.php">Karte</a></th>
  <th><a href="kuel_punkte.php">Punktestand</a></th>
  <th><a href="kuel_send.php">Zug&nbsp;einsenden</a></th>
  <th><a href="kuel_regeln.php">Regeln</a></th>
  <th><a href="kuelforum.php">Kuelforum</a></th>
 </tr>
</table>
<br><br>

<img src="bilder/sheepline.gif" width="350" height="150">

</div>
</font>
</body>
</html>
