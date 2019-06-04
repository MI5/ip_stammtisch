<?php
include("vars.inc.php");

$ip = getenv("REMOTE_ADDR");
$browser = getenv("HTTP_USER_AGENT");
$cookie_inhalt = getenv("HTTP_COOKIE");

$mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

$abfrage_id = $mysqli->query("SELECT cookie_inhalt FROM stspy WHERE ip = '$ip' AND browser = '$browser'");
$daten = $abfrage_id->fetch_array();

if ($cookie_inhalt != $daten[cookie_inhalt])
{

  $senden_id = $mysqli->query("UPDATE stspy SET cookie_inhalt = '$cookie_inhalt' WHERE ip = '$ip' AND browser = '$browser'");



  $abfrage_id = $mysqli->query("SELECT tilesetcount FROM stspy WHERE ip = '$ip' AND browser = '$browser'");
  $daten = $abfrage_id->fetch_array();

  if (!isset($daten[tilesetcount]))
  {
    $senden_id = $mysqli->query("UPDATE stspy SET tilesetcount = '1' WHERE ip = '$ip' AND browser = '$browser'");
  }
  else
  {
    $tilesetcount = $daten[tilesetcount];
    $tilesetcount++;
    $senden_id = $mysqli->query("UPDATE stspy SET tilesetcount = '$tilesetcount' WHERE ip = '$ip' AND browser = '$browser'");
  }
}


$mysqli->close();
?>

<html>
<head>
<title>Der Stammtisch</title>

<script src="scripte.js"></script>

<script>
var pfade = new Array("home","ueberuns","members","joinus","forum","kuel","fights","replays","trickse","shop","intern");
var landscape = "s";

if (document.cookie)
{
  switch(document.cookie)
  {
    case "0": landscape="s"; break;

    case "1": landscape="w"; break;

    case "2": landscape="b"; break;

    case "3": landscape="u"; break;
  }
}


function wechsel(nr)
{
  pfad = document.images[nr].src;

  if(pfad.substr(pfad.length-5,1) == 1) version = 2; else version = 1;
  document.images[nr].src = "bilder/" + landscape + "_" + pfade[nr] + version + ".gif";
}
</script>
</head>


<script>
selectbg();
</script>
<noscript><body background="bg_sommer.gif"><font color="#FFFFFF"></noscript>

<BGSOUND SRC="#" ID="beep" AUTOSTART="TRUE">


<div align="center">
<noscript>
<a href="center.php" target="center"><img src="bilder/s_home1.gif" width="60" height="90" border="0"></a>
<a href="about.php" target="center"><img src="bilder/s_ueberuns1.gif" width="60" height="90" border="0"></a>
<a href="members.php" target="center"><img src="bilder/s_members1.gif" width="60" height="90" border="0"></a>
<a href="joinus.php" target="center"><img src="bilder/s_joinus1.gif" width="60" height="90" border="0"></a>
<a href="forum.php" target="center"><img src="bilder/s_forum1.gif" width="60" height="90" border="0"></a>
<a href="kuel.php" target="center"><img src="bilder/s_kuel1.gif" width="60" height="90" border="0"></a>
<a href="fights.php" target="center"><img src="bilder/s_fights1.gif" width="60" height="90" border="0"></a>
<a href="replays.php" target="center"><img src="bilder/s_replays1.gif" width="60" height="90" border="0"></a>
<a href="trickse.php" target="center"><img src="bilder/s_trickse1.gif" width="60" height="90" border="0"></a>
<a href="onlineshop.php" target="center"><img src="bilder/s_shop1.gif" width="60" height="90" border="0"></a>
<a href="intern.php" target="center"><img src="bilder/s_intern1.gif" width="60" height="90" border="0"></a>
</noscript>

<!-- onMouseOver="document.all.beep.src=\'sheep.wav\'" -->
<script>
switch(landscape)
{
  case "s":
document.writeln('<a href="center.php" target="center" onMouseOver="wechsel(0)" onMouseOut="wechsel(0)"><img src="bilder/s_home1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="about.php" target="center" onMouseOver="wechsel(1)" onMouseOut="wechsel(1)"><img src="bilder/s_ueberuns1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="members.php" target="center" onMouseOver="wechsel(2)" onMouseOut="wechsel(2)"><img src="bilder/s_members1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="joinus.php" target="center" onMouseOver="wechsel(3)" onMouseOut="wechsel(3)"><img src="bilder/s_joinus1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="forum.php" target="center" onMouseOver="wechsel(4)" onMouseOut="wechsel(4)"><img src="bilder/s_forum1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="kuel.php" target="center" onMouseOver="wechsel(5)" onMouseOut="wechsel(5)"><img src="bilder/s_kuel1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="fights.php" target="center" onMouseOver="wechsel(6)" onMouseOut="wechsel(6)"><img src="bilder/s_fights1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="replays.php" target="center" onMouseOver="wechsel(7)" onMouseOut="wechsel(7)"><img src="bilder/s_replays1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="trickse.php" target="center" onMouseOver="wechsel(8)" onMouseOut="wechsel(8)"><img src="bilder/s_trickse1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="onlineshop.php" target="center" onMouseOver="wechsel(9)" onMouseOut="wechsel(9)"><img src="bilder/s_shop1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="intern.php" target="center" onMouseOver="wechsel(10)" onMouseOut="wechsel(10)"><img src="bilder/s_intern1.gif" width="60" height="90" border="0"></a>');
  break;

  case "w":
document.writeln('<a href="center.php" target="center" onMouseOver="wechsel(0)" onMouseOut="wechsel(0)"><img src="bilder/w_home1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="about.php" target="center" onMouseOver="wechsel(1)" onMouseOut="wechsel(1)"><img src="bilder/w_ueberuns1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="members.php" target="center" onMouseOver="wechsel(2)" onMouseOut="wechsel(2)"><img src="bilder/w_members1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="joinus.php" target="center" onMouseOver="wechsel(3)" onMouseOut="wechsel(3)"><img src="bilder/w_joinus1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="forum.php" target="center" onMouseOver="wechsel(4)" onMouseOut="wechsel(4)"><img src="bilder/w_forum1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="kuel.php" target="center" onMouseOver="wechsel(5)" onMouseOut="wechsel(5)"><img src="bilder/w_kuel1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="fights.php" target="center" onMouseOver="wechsel(6)" onMouseOut="wechsel(6)"><img src="bilder/w_fights1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="replays.php" target="center" onMouseOver="wechsel(7)" onMouseOut="wechsel(7)"><img src="bilder/w_replays1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="trickse.php" target="center" onMouseOver="wechsel(8)" onMouseOut="wechsel(8)"><img src="bilder/w_trickse1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="onlineshop.php" target="center" onMouseOver="wechsel(9)" onMouseOut="wechsel(9)"><img src="bilder/w_shop1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="intern.php" target="center" onMouseOver="wechsel(10)" onMouseOut="wechsel(10)"><img src="bilder/w_intern1.gif" width="60" height="90" border="0"></a>');
  break;

  case "b":
document.writeln('<a href="center.php" target="center" onMouseOver="wechsel(0)" onMouseOut="wechsel(0)"><img src="bilder/b_home1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="about.php" target="center" onMouseOver="wechsel(1)" onMouseOut="wechsel(1)"><img src="bilder/b_ueberuns1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="members.php" target="center" onMouseOver="wechsel(2)" onMouseOut="wechsel(2)"><img src="bilder/b_members1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="joinus.php" target="center" onMouseOver="wechsel(3)" onMouseOut="wechsel(3)"><img src="bilder/b_joinus1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="forum.php" target="center" onMouseOver="wechsel(4)" onMouseOut="wechsel(4)"><img src="bilder/b_forum1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="kuel.php" target="center" onMouseOver="wechsel(5)" onMouseOut="wechsel(5)"><img src="bilder/b_kuel1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="fights.php" target="center" onMouseOver="wechsel(6)" onMouseOut="wechsel(6)"><img src="bilder/b_fights1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="replays.php" target="center" onMouseOver="wechsel(7)" onMouseOut="wechsel(7)"><img src="bilder/b_replays1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="trickse.php" target="center" onMouseOver="wechsel(8)" onMouseOut="wechsel(8)"><img src="bilder/b_trickse1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="onlineshop.php" target="center" onMouseOver="wechsel(9)" onMouseOut="wechsel(9)"><img src="bilder/b_shop1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="intern.php" target="center" onMouseOver="wechsel(10)" onMouseOut="wechsel(10)"><img src="bilder/b_intern1.gif" width="60" height="90" border="0"></a>');
  break;

  case "u":
document.writeln('<a href="center.php" target="center" onMouseOver="wechsel(0)" onMouseOut="wechsel(0)"><img src="bilder/u_home1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="about.php" target="center" onMouseOver="wechsel(1)" onMouseOut="wechsel(1)"><img src="bilder/u_ueberuns1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="members.php" target="center" onMouseOver="wechsel(2)" onMouseOut="wechsel(2)"><img src="bilder/u_members1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="joinus.php" target="center" onMouseOver="wechsel(3)" onMouseOut="wechsel(3)"><img src="bilder/u_joinus1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="forum.php" target="center" onMouseOver="wechsel(4)" onMouseOut="wechsel(4)"><img src="bilder/u_forum1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="kuel.php" target="center" onMouseOver="wechsel(5)" onMouseOut="wechsel(5)"><img src="bilder/u_kuel1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="fights.php" target="center" onMouseOver="wechsel(6)" onMouseOut="wechsel(6)"><img src="bilder/u_fights1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="replays.php" target="center" onMouseOver="wechsel(7)" onMouseOut="wechsel(7)"><img src="bilder/u_replays1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="trickse.php" target="center" onMouseOver="wechsel(8)" onMouseOut="wechsel(8)"><img src="bilder/u_trickse1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="onlineshop.php" target="center" onMouseOver="wechsel(9)" onMouseOut="wechsel(9)"><img src="bilder/u_shop1.gif" width="60" height="90" border="0"></a>');
document.writeln('<a href="intern.php" target="center" onMouseOver="wechsel(10)" onMouseOut="wechsel(10)"><img src="bilder/u_intern1.gif" width="60" height="90" border="0"></a>');
  break;
}

</script>


</font>
</div>
</body>
</html>