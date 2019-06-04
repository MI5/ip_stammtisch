<?php
include("vars.inc.php");

include ("jpgraph/src/jpgraph.php");
include ("jpgraph/src/jpgraph_pie.php");
include ("jpgraph/src/jpgraph_pie3d.php");


$sommer = 0;
$winter = 0;
$brachland = 0;
$wueste = 0;
$no = 0;

$mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

$abfrage_id = $mysqli->query("SELECT id,host,browser,cookie_inhalt,ursprung,dauer_start,dauer_ende FROM stspy ORDER BY dauer_ende DESC LIMIT 5000");
while($datenT = mysql_fetch_array($abfrage_id))
{
  if ($datenT[cookie_inhalt] == "0")
    {$sommer++;}
  elseif ($datenT[cookie_inhalt] == "1")
    {$winter++;}
  elseif ($datenT[cookie_inhalt] == "2")
    {$brachland++;}
  elseif ($datenT[cookie_inhalt] == "3")
    {$wueste++;}
  else
    {$no++;}
}

$mysqli->close();
$data = array($wueste,$brachland,$winter,$sommer,$no);

// Create the Pie Graph.
$graph = new PieGraph(380,200);

// Set A title for the plot
$graph->title->Set("Landschaftstypen - LIVE-Chart");
$graph->title->SetFont(FF_FONT1,FS_BOLD,18);
$graph->title->SetColor("darkblue");
$graph->legend->Pos(0.1,0.2);

// Create 3D pie plot
$p1 = new PiePlot3d($data);
$p1->SetTheme("sand");
$p1->SetCenter(0.28);
$p1->SetSize(80);

// Adjust projection angle
$p1->SetAngle(45);

// As a shortcut you can easily explode one numbered slice with
$p1->ExplodeSlice(4);

// Setup the slice values
$p1->value->SetFont(FF_FONT1,FS_BOLD,11);
$p1->value->SetColor("navy");

$p1->SetLegends(array("Wüste","Brachland","Winter","Sommer","Cookies aus"));
$graph->Add($p1);
$graph->Stroke();

?>