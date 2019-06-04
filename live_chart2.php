<?php
include("vars.inc.php");

include ("jpgraph/src/jpgraph.php");
include ("jpgraph/src/jpgraph_pie.php");
include ("jpgraph/src/jpgraph_pie3d.php");


$active = 0;
$closed = 0;
$minimized = 0;
$no = 0;

$link = mysql_connect($sql_server,$sql_user,$sql_pass);
mysql_select_db($sql_db);

$abfrage_id = mysql_query("SELECT id,host,browser,cookie_inhalt,ursprung,statusleiste,dauer_start,dauer_ende FROM stspy ORDER BY dauer_ende DESC LIMIT 5000");
while($datenT = mysql_fetch_array($abfrage_id))
{
  if ($datenT[statusleiste] == "active")
    {$active++;}
  elseif ($datenT[statusleiste] == "closed")
    {$closed++;}
  elseif ($datenT[statusleiste] == "minimized")
    {$minimized++;}
}
mysql_close($link);

$data = array($minimized,$closed,$active);

// Create the Pie Graph.
$graph = new PieGraph(380,200,"live2.png");

// Set A title for the plot
$graph->title->Set("Statusleiste - LIVE-Chart");
$graph->title->SetFont(FF_FONT1,FS_BOLD,18);
$graph->title->SetColor("darkblue");
$graph->legend->Pos(0.1,0.2);

// Create 3D pie plot
$p1 = new PiePlot3d($data);
$p1->SetTheme("sand");
$p1->SetCenter(0.32);
$p1->SetSize(80);

// Adjust projection angle
$p1->SetAngle(45);

// Setup the slice values
$p1->value->SetFont(FF_FONT1,FS_BOLD,11);
$p1->value->SetColor("navy");

$p1->SetLegends(array("Minimiert","Geschlossen","Aktiviert"));
$graph->Add($p1);
$graph->Stroke();

?>