<?php
include("vars.inc.php");

include ("jpgraph/src/jpgraph.php");
include("jpgraph/src/jpgraph_bar.php");


  $counterdatei = fopen("counter.txt","r+");
  $counterstand = fgets($counterdatei,10);
  fclose($counterdatei);

$opera = 0;
$ns = 0;
$ie = 0;
$mozilla = 0;
$andere = 0;

$mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

$abfrage_id = mysql_query("SELECT id,host,browser,cookie_inhalt,ursprung,statusleiste,dauer_start,dauer_ende FROM stspy ORDER BY dauer_ende DESC LIMIT 5000");
while($datenT = mysql_fetch_array($abfrage_id))
{
  if (stristr("$datenT[browser]","Opera"))
    {$opera++;}
  elseif (stristr("$datenT[browser]","Mozilla/4.75"))
    {$ns++;}
  elseif (stristr("$datenT[browser]","Mozilla/4.7"))
    {$ns++;}
  elseif (stristr("$datenT[browser]","Mozilla/4.6"))
    {$ns++;}
  elseif (stristr("$datenT[browser]","MSIE"))
    {$ie++;}
  elseif (stristr("$datenT[browser]","Mozilla/5.0"))
    {$mozilla++;}
  else
    {$andere++;}
}
mysql_close($link);

$data = array($ie,$ns,$mozilla,$opera,$andere);


$graph = new Graph(420,300,"live3.png");

$graph->SetScale("textlin");

$barplot = new BarPlot($data);
$graph->Add($barplot);

$graph->title->SetFont(FF_FONT1, FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD);

$graph->title->SetFont(FF_FONT1,FS_BOLD,18);

$graph->title->Set("Besucher insgesamt: $counterstand");
$graph->xaxis->title->Set("benutzter Browsertyp");

$labels = array("IE","Netscape","Mozilla","Opera","Andere");
$graph->xaxis->SetTickLabels($labels);

$graph->img->SetMargin(40,40,40,60);

$graph->Stroke();

?>