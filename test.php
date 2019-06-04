<?

include("jpgraph/src/jpgraph.php");
include("jpgraph/src/jpgraph_bar.php");

$data = array(150,280,210,190,250,270,290);


$graph = new Graph(420,300);

$graph->SetScale("textlin");

$barplot = new BarPlot($data);
$graph->Add($barplot);

$barplot->SetColor("red");
$barplot->SetFillColor("orange");

$graph->title->SetFont(FF_FONT1, FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD);

$graph->title->Set("Downloads pro Wochentag");
$graph->xaxis->title->Set("Wochentag");
$graph->yaxis->title->Set("Downloads");

$labels = array("Son","Mon","Die","Mit","Don","Fre","Sam","Son");
$graph->xaxis->SetTickLabels($labels);

$graph->img->SetMargin(40,40,40,60);

$graph->Stroke();


?>