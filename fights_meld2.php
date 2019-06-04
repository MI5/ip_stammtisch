<?php
include("vars.inc.php");

include("pageviews.inc");
include("spy.inc");
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="scripte.js"></script>
</head>

<script>
selectbg();
</script>
<noscript><body background="bg_sommer.gif"><font color="#FFFFFF"></noscript>
<div align="center">

<? if (isset($f_we) || isset($f_vs) || isset($f_them) || isset($f_map) || isset($f_modus) || isset($f_result)): ?>

<?
  if ($f_we != "" && $f_vs != "" && $f_them != "" && $f_map != "" && $f_modus != "" && $f_result != "")
  {
    $mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);

    $count = count($f_we);
    $f_x1 = "$f_we[0]";

    for ($i=1; $i<$count; $i++)
    {
      $f_x1 = "$f_x1, $f_we[$i]";
    }

    $count = count($f_them);
    $f_x2 = "$f_them[0]";

    for ($i=1; $i<$count; $i++)
    {
      $f_x2 = "$f_x2, $f_them[$i]";
    }


    $senden_id = mysql_query("INSERT INTO stfights (vs,map,modus,result,we,them) VALUES ('$f_vs','$f_map','$f_modus','$f_result','$f_x1','$f_x2')");
    mysql_close($link);
    echo "Tabelle erfolgreich erg&auml;nzt!<br><br><a href=\"fights.php\">Fights</a>";
  }
?>

<? else: ?>
Mich so aufzurufen ist nicht m&ouml;glich.
<? endif ?>

</div>
</font>
</body>
</html>