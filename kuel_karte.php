<?php
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

</head>

<script language="JavaScript"><!--
selectbg();
//--></script>
<noscript><body background="bg_sommer.gif"><font color="#FFFFFF"></noscript>

<div align="center">

<?
/* if (!isset($var1))
  $var1 = 736;
if (!isset($var2))
  $var2 = 496; */

if (!isset($var1))
  $var1 = 900;
if (!isset($var2))
  $var2 = 620;


echo "<img src=\"bilder/kuel.jpg\" width=\"$var1\" height=\"$var2\"><br><br>";


$var1a = $var1 * 4 / 5;
$var2a = $var2 * 4 / 5;

$var1b = $var1 * 5 / 4;
$var2b = $var2 * 5 / 4;

$var1a = round ($var1a,2);
$var2b = round ($var2b,2);
$var1a = round ($var1a,2);
$var2b = round ($var2b,2);

if ($var1a < 150)
{
echo "Out Zoom <a href=\"kuel_karte.php?var1=$var1b&var2=$var2b\">In</a>";
}
else
{
  if ($var1b > 1800)
  {
    echo "<a href=\"kuel_karte.php?var1=$var1a&var2=$var2a\">Out</a> Zoom In";
  }
  else
  {
    echo "<a href=\"kuel_karte.php?var1=$var1a&var2=$var2a\">Out</a> Zoom <a href=\"kuel_karte.php?var1=$var1b&var2=$var2b\">In</a>";
  }
}

?>

<br>
<form>
Drücke evtl. <input onclick="javascript:location.reload(true)" type="button" value="Reload">
um die aktuelle Karte angezeigt zu bekommen.
</form>

</div>
</font>
</body>
</html>
