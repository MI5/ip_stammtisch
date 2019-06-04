<?PHP
include("vars.inc.php");

$ip = getenv("REMOTE_ADDR");
$browser = getenv("HTTP_USER_AGENT");
$dauer_ende = time();


$link = mysql_connect($sql_server,$sql_user,$sql_pass);
mysql_select_db($sql_db);

$abfrage_id = mysql_query("SELECT zuletzt,pre1_zuletzt,pre2_zuletzt,pre3_zuletzt,pre4_zuletzt,pre5_zuletzt,pre6_zuletzt,pre7_zuletzt,pre8_zuletzt,pre9_zuletzt,pre10_zuletzt,pre11_zuletzt,pre12_zuletzt,pre13_zuletzt,pre14_zuletzt,pre15_zuletzt,pre16_zuletzt,pre17_zuletzt,pre18_zuletzt FROM stspy WHERE ip = '$ip' AND browser = '$browser'");
$daten = mysql_fetch_array($abfrage_id);


$pre19_zuletzt = $daten[pre18_zuletzt];
$pre18_zuletzt = $daten[pre17_zuletzt];
$pre17_zuletzt = $daten[pre16_zuletzt];
$pre16_zuletzt = $daten[pre15_zuletzt];
$pre15_zuletzt = $daten[pre14_zuletzt];
$pre14_zuletzt = $daten[pre13_zuletzt];
$pre13_zuletzt = $daten[pre12_zuletzt];
$pre12_zuletzt = $daten[pre11_zuletzt];
$pre11_zuletzt = $daten[pre10_zuletzt];
$pre10_zuletzt = $daten[pre9_zuletzt];
$pre9_zuletzt = $daten[pre8_zuletzt];
$pre8_zuletzt = $daten[pre7_zuletzt];
$pre7_zuletzt = $daten[pre6_zuletzt];
$pre6_zuletzt = $daten[pre5_zuletzt];
$pre5_zuletzt = $daten[pre4_zuletzt];
$pre4_zuletzt = $daten[pre3_zuletzt];
$pre3_zuletzt = $daten[pre2_zuletzt];
$pre2_zuletzt = $daten[pre1_zuletzt];
$pre1_zuletzt = $daten[zuletzt];
$zuletzt = "$_SERVER[PHP_SELF]";


$senden_id = mysql_query("UPDATE stspy SET dauer_ende = '$dauer_ende', zuletzt = '$zuletzt', pre1_zuletzt = '$pre1_zuletzt',  pre2_zuletzt = '$pre2_zuletzt',  pre3_zuletzt = '$pre3_zuletzt',  pre4_zuletzt = '$pre4_zuletzt',  pre5_zuletzt = '$pre5_zuletzt',  pre6_zuletzt = '$pre6_zuletzt',  pre7_zuletzt = '$pre7_zuletzt',  pre8_zuletzt = '$pre8_zuletzt', pre9_zuletzt = '$pre9_zuletzt', pre10_zuletzt = '$pre10_zuletzt', pre11_zuletzt = '$pre11_zuletzt', pre12_zuletzt = '$pre12_zuletzt', pre13_zuletzt = '$pre13_zuletzt', pre14_zuletzt = '$pre14_zuletzt', pre15_zuletzt = '$pre15_zuletzt', pre16_zuletzt = '$pre16_zuletzt', pre17_zuletzt = '$pre17_zuletzt', pre18_zuletzt = '$pre18_zuletzt', pre19_zuletzt = '$pre19_zuletzt' WHERE ip = '$ip' AND browser = '$browser'");


$abfrage_id = mysql_query("SELECT count FROM stspy WHERE ip = '$ip' AND browser = '$browser'");
$daten = mysql_fetch_array($abfrage_id);

if (!isset($daten[count]))
{
  $senden_id = mysql_query("UPDATE stspy SET count = '1' WHERE ip = '$ip' AND browser = '$browser'");
}
else
{
  $count = $daten[count];
  $count++;
  $senden_id = mysql_query("UPDATE stspy SET count = '$count' WHERE ip = '$ip' AND browser = '$browser'");
}

mysql_close($link);
?>