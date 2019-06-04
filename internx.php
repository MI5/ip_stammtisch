<?php
include("vars.inc.php");

include("pageviews.inc");
include("spy.inc");

$mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);
?>

<html>
<head>
<title>Alle ermittelten Daten</title>
<link rel="stylesheet" type="text/css" href="styles.css">

<style type="text/css">
td,th		{
		color:#FFFFFF
		}


body		{
		margin: 0px 0px;
		}

td		{
		font-family:Arial,Times New Roman; font-size:8pt;
		}
th		{
		font-family:Arial,Courier; font-size:8pt;
		}

//a:link	{ color:#FFFFFF; text-decoration:none; }
//a:active	{ color:#000000; text-decoration:none; }
//a:visited	{ color:#FFFFFF; text-decoration:none; }

</style>

</head>

<body bgcolor="#336666"><font color="#FFFFFF">

<? if (isset($ident) && isset($sortby) && isset($direction) && isset($mich) && isset($detail) && isset($rows)): ?>

<?
if (isset($aktion))
{
  if ($aktion == "counter_l")
  {
    /* $counterdatei = fopen("counter.txt","r+");
    $counterstand = fgets($counterdatei,10);
    $counterstand = "0000000";
    rewind($counterdatei);
    fputs($counterdatei,$counterstand);
    fclose($counterdatei); 

    echo "Counter wurde zur&uuml;ckgesetzt"; */
    echo "Gesperrt!";
  }

  if ($aktion == "aufrufe_l")
  {

    /* $senden_id = mysql_query("UPDATE stpageviews SET anzahl = 0");
    echo "Seitenaufrufe wurden zur&uuml;ckgesetzt"; */

    echo "Gesperrt!";
  }

  if ($aktion == "ips_l")
  {
    $abfrage_id = mysql_query("SELECT id,ip,datum FROM stspy ORDER BY dauer_ende DESC LIMIT 10,10000");

    while($daten = mysql_fetch_array($abfrage_id))
    {
      if (!stristr("$daten[ip]","x"))
      {
        $ip__ = "$daten[ip]x";
        $senden_id = mysql_query("UPDATE stspy SET ip = '$ip__' where id = $daten[id]");
      }
    }

    echo "IP's wurden maskiert";
  }

  if ($aktion == "eintrag_l")
  {
    $loeschen_id = mysql_query("DELETE FROM stspy WHERE id = '$f_id'");
    echo "ID $f_id gelöscht!";
  }

  if ($aktion == "clipboard_l")
  {
    $senden_id = mysql_query("UPDATE stspy SET clipboard = '[deleted]' WHERE id = '$f_id'");
    echo "Clipboard von ID $f_id geleert!";
  }

  if ($aktion == "user_l")
  {
    $abfrage_id = mysql_query("SELECT user FROM stspy WHERE id = '$f_id'");
    $datenT = mysql_fetch_array($abfrage_id);

    echo "<form action=\"internx.php?ident=$ident&sortby=$sortby&direction=$direction&mich=$mich&detail=$detail&rows=$rows\" method=\"post\">";
    echo "User setzen von ID Nr. $f_id: <input name=\"f_user\" value=\"$datenT[user]\" maxlength=\"30\" size=\"20\">&nbsp;";
    echo "<input type=\"hidden\" name=\"aktion\" value=\"user_l2\">";
    echo "<input type=\"hidden\" name=\"f_id\" value=\"$f_id\">";
    echo "<input type=\"submit\" value=\"Set User\"></form>";
  }

  if ($aktion == "user_l2")
  {
    $senden_id = mysql_query("UPDATE stspy SET user = '$f_user' WHERE id = '$f_id'");
    echo "User von ID $f_id gesetzt!";
  }

}
?>

<div align="center">

<h2>Alle ermittelten Daten</h2>
<h3><u>1) Besucherstatistik</u></h3>

<?
$counterdatei = fopen("counter.txt","r+");
$counterstand = fgets($counterdatei,10);
fclose($counterdatei);
echo "Besucher bisher: $counterstand<br><br>";
?>

<?
if ($rows == 5000)
  echo "<b>";
echo "<a href=\"internx.php?ident=$ident&sortby=dauer_ende&direction=DESC&mich=$mich&detail=$detail&rows=5000\">Alle</a>";
if ($rows == 5000)
  echo "</b>";
echo " - ";

if ($rows == 100)
  echo "<b>";
echo "<a href=\"internx.php?ident=$ident&sortby=dauer_ende&direction=DESC&mich=$mich&detail=$detail&rows=100\">Die letzten 100</a>";
if ($rows == 100)
  echo "</b>";
echo " - ";

if ($rows == 50)
  echo "<b>";
echo "<a href=\"internx.php?ident=$ident&sortby=dauer_ende&direction=DESC&mich=$mich&detail=$detail&rows=50\">Die letzten 50</a>";
if ($rows == 50)
  echo "</b>";
echo " - ";

if ($rows == 20)
  echo "<b>";
echo "<a href=\"internx.php?ident=$ident&sortby=dauer_ende&direction=DESC&mich=$mich&detail=$detail&rows=20\">Die letzten 20</a>";
if ($rows == 20)
  echo "</b>";
echo " - ";

if ($rows == 10)
  echo "<b>";
echo "<a href=\"internx.php?ident=$ident&sortby=dauer_ende&direction=DESC&mich=$mich&detail=$detail&rows=10\">Die letzten 10</a>";
if ($rows == 10)
  echo "</b>";
echo " - ";

if ($rows == 5)
  echo "<b>";
echo "<a href=\"internx.php?ident=$ident&sortby=dauer_ende&direction=DESC&mich=$mich&detail=$detail&rows=5\">Die letzten 5</a><br><br>";
if ($rows == 5)
  echo "</b>";


if ($ident == auto)
  echo "<b>";
echo "<a href=\"internx.php?ident=auto&sortby=dauer_ende&direction=DESC&mich=$mich&detail=$detail&rows=$rows\">Alle</a>";
if ($ident == auto)
  echo "</b>";
echo " - ";

if ($ident == yes)
  echo "<b>";
echo "<a href=\"internx.php?ident=yes&sortby=dauer_ende&direction=DESC&mich=$mich&detail=$detail&rows=$rows\">Nur Identifizierte</a>";
if ($ident == yes)
  echo "</b>";
echo " - ";

if ($ident == no)
  echo "<b>";
echo "<a href=\"internx.php?ident=no&sortby=dauer_ende&direction=DESC&mich=$mich&detail=$detail&rows=$rows\">Nur Unidentifizierte</a><br><br>";
if ($ident == no)
  echo "</b>";



if ($detail == no)
  echo "<b>";
echo "<a href=\"internx.php?ident=$ident&sortby=dauer_ende&direction=DESC&mich=$mich&detail=no&rows=$rows\">Kompaktansicht</a>";
if ($detail == no)
  echo "</b>";
echo " - ";

if ($detail == yes)
  echo "<b>";
echo "<a href=\"internx.php?ident=$ident&sortby=dauer_ende&direction=DESC&mich=$mich&detail=yes&rows=$rows\">Detailansicht</a><br>";
if ($detail == yes)
  echo "</b>";
?>

<form>
<input onclick="javascript:location.reload(true)" type="button" value="Reload"><br><br>
</form>

<table border="2" cellspacing="0" bgcolor=#000059>
<tr>
<?
if ($direction == "DESC")
  $directionx = "ASC";
else
  $directionx = "DESC";

if ($detail == "yes")
{
  if ($sortby == "id")
    echo "<th><a href=\"internx.php?ident=$ident&sortby=id&direction=$directionx&mich=$mich&detail=$detail&rows=$rows\">ID</a></th>";
  else
    echo "<th><a href=\"internx.php?ident=$ident&sortby=id&direction=$direction&mich=$mich&detail=$detail&rows=$rows\">ID</a></th>";
  echo "<th>Besucher</th>";
}

if ($sortby == "ip")
  echo "<th><a href=\"internx.php?ident=$ident&sortby=ip&direction=$directionx&mich=$mich&detail=$detail&rows=$rows\">IP</a></th>";
else
  echo "<th><a href=\"internx.php?ident=$ident&sortby=ip&direction=$direction&mich=$mich&detail=$detail&rows=$rows\">IP</a></th>";

if ($sortby == "user")
  echo "<th><a href=\"internx.php?ident=$ident&sortby=user&direction=$directionx&mich=$mich&detail=$detail&rows=$rows\">User</a></th>";
else
  echo "<th><a href=\"internx.php?ident=$ident&sortby=user&direction=$direction&mich=$mich&detail=$detail&rows=$rows\">User</a></th>";

if ($detail == "yes")  
  echo "<th>Beitrag</th>";

if ($sortby == "host")
  echo "<th><a href=\"internx.php?ident=$ident&sortby=host&direction=$directionx&mich=$mich&detail=$detail&rows=$rows\">Provider</a></th>";
else
  echo "<th><a href=\"internx.php?ident=$ident&sortby=host&direction=$direction&mich=$mich&detail=$detail&rows=$rows\">Provider</a></th>";  

echo "<th>OS</th>";
if ($sortby == "browser")
  echo "<th><a href=\"internx.php?ident=$ident&sortby=browser&direction=$directionx&mich=$mich&detail=$detail&rows=$rows\">Browser</a></th>";
else
  echo "<th><a href=\"internx.php?ident=$ident&sortby=browser&direction=$direction&mich=$mich&detail=$detail&rows=$rows\">Browser</a></th>";

if ($sortby == "dauer_start")
  echo "<th><a href=\"internx.php?ident=$ident&sortby=dauer_start&direction=$directionx&mich=$mich&detail=$detail&rows=$rows\">Start</a></th>";
else
  echo "<th><a href=\"internx.php?ident=$ident&sortby=dauer_start&direction=$direction&mich=$mich&detail=$detail&rows=$rows\">Start</a></th>";

echo "<th>Dauer</th>";

if ($sortby == "count")
  echo "<th><a href=\"internx.php?ident=$ident&sortby=count&direction=$directionx&mich=$mich&detail=$detail&rows=$rows\">np</th>";
else
  echo "<th><a href=\"internx.php?ident=$ident&sortby=count&direction=$direction&mich=$mich&detail=$detail&rows=$rows\">np</th>";

if ($sortby == "tilesetcount")
  echo "<th><a href=\"internx.php?ident=$ident&sortby=tilesetcount&direction=$directionx&mich=$mich&detail=$detail&rows=$rows\">nc</th>";
else
  echo "<th><a href=\"internx.php?ident=$ident&sortby=tilesetcount&direction=$direction&mich=$mich&detail=$detail&rows=$rows\">nc</th>";

if ($sortby == "cookie_inhalt")
  echo "<th><a href=\"internx.php?ident=$ident&sortby=cookie_inhalt&direction=$directionx&mich=$mich&detail=$detail&rows=$rows\">Tileset</a></th>";
else
  echo "<th><a href=\"internx.php?ident=$ident&sortby=cookie_inhalt&direction=$direction&mich=$mich&detail=$detail&rows=$rows\">Tileset</a></th>";

  echo "<th>Leiste</th>";
if ($detail == "yes")
{
  echo "<th>Ursprungsseite</th>";
}
echo "<th>Letzte&nbsp;Seite</th>";
echo "<th>Vorletzte&nbsp;Seite</th>";
if ($detail == "yes")
{
  echo "<th>davor</th>";
  echo "<th>davor</th>";
  echo "<th>davor</th>";
  echo "<th>davor</th>";
  echo "<th>davor</th>";
  echo "<th>davor</th>";
  echo "<th>davor</th>";
  echo "<th>davor</th>";
  echo "<th>clipboard</th>";
  echo "<th>Aktion</th>";
  echo "<th>Aktion</th>";
  echo "<th>Aktion</th>";
}
?>

</tr>

<?
if ($ident == "no")
  $abfrage_id = mysql_query("SELECT id,ip,datum,host,browser,cookie_inhalt,ursprung,statusleiste,dauer_start,dauer_ende,zuletzt,user,beitrag,count,tilesetcount,pre1_zuletzt,pre2_zuletzt,pre3_zuletzt,pre4_zuletzt,pre5_zuletzt,pre6_zuletzt,pre7_zuletzt,pre8_zuletzt,pre9_zuletzt,clipboard,besuchernr FROM stspy WHERE user = '' ORDER BY $sortby $direction LIMIT $rows");
elseif ($ident =="yes")
  $abfrage_id = mysql_query("SELECT id,ip,datum,host,browser,cookie_inhalt,ursprung,statusleiste,dauer_start,dauer_ende,zuletzt,user,beitrag,count,tilesetcount,pre1_zuletzt,pre2_zuletzt,pre3_zuletzt,pre4_zuletzt,pre5_zuletzt,pre6_zuletzt,pre7_zuletzt,pre8_zuletzt,pre9_zuletzt,clipboard,besuchernr FROM stspy WHERE user <> '' ORDER BY $sortby $direction LIMIT $rows");
else
  $abfrage_id = mysql_query("SELECT id,ip,datum,host,browser,cookie_inhalt,ursprung,statusleiste,dauer_start,dauer_ende,zuletzt,user,beitrag,count,tilesetcount,pre1_zuletzt,pre2_zuletzt,pre3_zuletzt,pre4_zuletzt,pre5_zuletzt,pre6_zuletzt,pre7_zuletzt,pre8_zuletzt,pre9_zuletzt,clipboard,besuchernr FROM stspy ORDER BY $sortby $direction LIMIT $rows");



while($daten = mysql_fetch_array($abfrage_id))
{
  if ($mich == "no")
  {
    if ($ip==$daten[ip] && $browser==$daten[browser])
      continue;
  }

  if ($daten[user] == "")
    $daten[user] = "&nbsp;";
  if ($daten[beitrag] == "")
    $daten[beitrag] = "&nbsp;";
  if ($daten[host] == "")
    $daten[host] = "&nbsp;";
  if ($daten[cookie_inhalt] == "")
    $daten[cookie_inhalt] = "&nbsp;";
  if ($daten[statusleiste] == "")
    $daten[statusleiste] = "&nbsp;";
  if ($daten[count] == "")
    $daten[count] = "&nbsp;";
  if ($daten[tilesetcount] == "")
    $daten[tilesetcount] = "&nbsp;";
  if ($daten[zuletzt] == "")
    $daten[zuletzt] = "&nbsp;";
  if ($daten[pre1_zuletzt] == "")
    $daten[pre1_zuletzt] = "&nbsp;";
  if ($daten[pre2_zuletzt] == "")
    $daten[pre2_zuletzt] = "&nbsp;";
  if ($daten[pre3_zuletzt] == "")
    $daten[pre3_zuletzt] = "&nbsp;";
  if ($daten[pre4_zuletzt] == "")
    $daten[pre4_zuletzt] = "&nbsp;";
  if ($daten[pre5_zuletzt] == "")
    $daten[pre5_zuletzt] = "&nbsp;";
  if ($daten[pre6_zuletzt] == "")
    $daten[pre6_zuletzt] = "&nbsp;";
  if ($daten[pre7_zuletzt] == "")
    $daten[pre7_zuletzt] = "&nbsp;";
  if ($daten[pre8_zuletzt] == "")
    $daten[pre8_zuletzt] = "&nbsp;";
  if ($daten[pre9_zuletzt] == "")
    $daten[pre9_zuletzt] = "&nbsp;";
  if ($daten[ursprung] == "")
    $daten[ursprung] = "&nbsp;";
  if ($daten[clipboard] == "")
    $daten[clipboard] = "&nbsp;";
  if ($daten[browser] == "")
    $daten[browser] = "&nbsp;";
  if ($daten[besuchernr] == "")
    $daten[besuchernr] = "&nbsp;";


  if ($mich == "yes" && $ip==$daten[ip] && $browser==$daten[browser])
  {
    {echo "<tr bgcolor=#990033>";}
  }
  else
  {
    if (time()-$daten[dauer_ende] < 300)
      {echo "<tr bgcolor=#FF0000>";}
    elseif (time()-$daten[dauer_ende] < 1800)
      {echo "<tr bgcolor=#FF5500>";}
    else
      {echo "<tr>";}
  }

  if ($detail == "yes")
  {
    echo "  <td>$daten[id]</td>\n";
    echo "  <td>$daten[besuchernr]</td>\n";
  }
  echo "  <td>$daten[ip]</td>\n";
  echo "  <td>$daten[user]</td>\n";
  if ($detail == "yes")
    echo "  <td>$daten[beitrag]</td>\n";


  //Provider
  if (stristr("$daten[host]","t-dialin"))
    {echo "<td>T-Online</td>";}
  elseif (stristr("$daten[host]",".t-ipconnect.de"))
    {echo "<td>T-IPconnect</td>";}
  elseif (stristr("$daten[host]","mcbone"))
    {echo "<td>Freenet</td>";}
  elseif (stristr("$daten[host]","netcologne.de"))
    {echo "<td>NetCologne</td>";}
  elseif (stristr("$daten[host]","telekom.at"))
    {echo "<td>Telekom Austria</td>";}
  elseif (stristr("$daten[host]","aon.at"))
    {echo "<td>aon.at</td>";}
  elseif (stristr("$daten[host]","aol.com"))
    {echo "<td>AOL</td>";}
  elseif (stristr("$daten[host]","ewetel.net"))
    {echo "<td>EWE TEL</td>";}
  elseif (stristr("$daten[host]","uni-regensburg.de"))
    {echo "<td>Uni Regensburg</td>";}
  elseif (stristr("$daten[host]","dial.bluewin.ch"))
    {echo "<td>bluewin.ch</td>";}
  elseif (stristr("$daten[host]","chello.at"))
    {echo "<td>chello.at</td>";}
  elseif (stristr("$daten[host]","ignite.net"))
    {echo "<td>ignite.net</td>";}
  elseif (stristr("$daten[host]","fwhide.guj.de"))
    {echo "<td>Gruner + Jahr AG</td>";}
  elseif (stristr("$daten[host]","adslplus.ch"))
    {echo "<td>adslplus.ch</td>";}
  elseif (stristr("$daten[host]","arcor-ip.net"))
    {echo "<td>Arcor</td>";}
  elseif (stristr("$daten[host]",".tiscali.de"))
    {echo "<td>Tiscali</td>";}
  elseif (stristr("$daten[host]",".deu.da.uu.net"))
    {echo "<td>UU-Net</td>";}
  elseif (stristr("$daten[host]",".axa-its.axa.de"))
    {echo "<td>AXA AG</td>";}
  elseif (stristr("$daten[host]",".swipnet.se"))
    {echo "<td>swipnet.se</td>";}
  elseif (stristr("$daten[host]","verizon.net"))
    {echo "<td>verizon.net</td>";}
  elseif (stristr("$daten[host]","uc.nombres.ttd.es"))
    {echo "<td>ttd.es</td>";}
  elseif (stristr("$daten[host]","pooles.rima-tde.net"))
    {echo "<td>rima-tde.net</td>";}
  elseif (stristr("$daten[host]","uni-halle.de"))
    {echo "<td>uni-halle.de</td>";}
  elseif (stristr("$daten[host]","telesp.net.br"))
    {echo "<td>telesp.net.br</td>";}
  elseif (stristr("$daten[host]",".googlebot.com"))
    {echo "<td>GoogleBot</td>";}
  else
    {echo "<td>$daten[host]</td>";}

  //OS
  if (stristr("$daten[browser]","Win95; I"))
    {echo "<td>Win&nbsp;ME</td>";}
  elseif (stristr("$daten[browser]","Win95") || stristr("$daten[browser]","Windows 95"))
    {echo "<td>Win&nbsp;95</td>";}
  elseif (stristr("$daten[browser]","Win98") || stristr("$daten[browser]","Windows 98"))
    {echo "<td>Win&nbsp;98</td>";}
  elseif (stristr("$daten[browser]","Windows NT 5.0"))
    {echo "<td>Win&nbsp;2000</td>";}
  elseif (stristr("$daten[browser]","Windows NT 5.1"))
    {echo "<td>Win&nbsp;2000</td>";}
  elseif (stristr("$daten[browser]","Windows 2000"))
    {echo "<td>Win&nbsp;2000</td>";}
  elseif (stristr("$daten[browser]","Windows XP"))
    {echo "<td>Win&nbsp;XP</td>";}
  elseif (stristr("$daten[browser]","Mac_PowerPC"))
    {echo "<td>Mac</td>";}
  elseif (stristr("$daten[browser]","i686-pc-linux-gnu"))
    {echo "<td>Linux</td>";}
  elseif (stristr("$daten[browser]","SunOS 5.7"))
    {echo "<td>SunOS 5.7</td>";}
  elseif (stristr("$daten[browser]","W3C_Validator"))
    {echo "<td>W3C</td>";}
  elseif (stristr("$daten[browser]","W3C_CSS_Validator"))
    {echo "<td>W3C</td>";}
  elseif (stristr("$daten[browser]","Googlebot/2.1"))
    {echo "<td>GoogleBot</td>";}
  elseif (stristr("$daten[browser]","TurnitinBot/1.5"))
    {echo "<td>TurnitinBot</td>";}
  elseif (stristr("$daten[browser]","http://www.WISEnutbot.com"))
    {echo "<td>WISEnutbot</td>";}
  elseif (stristr("$daten[browser]","Firefly/1.0"))
    {echo "<td>Firefly/1.0</td>";}
  else
    {echo "<td>$daten[browser]</td>";}


  //Browser
  if (stristr("$daten[browser]","Opera 6.04"))
    {echo "<td>Opera 6.04</td>";}
  elseif (stristr("$daten[browser]","Opera 5.12"))
    {echo "<td>Opera 5.12</td>";}
  elseif (stristr("$daten[browser]","Opera"))
    {echo "<td>Opera</td>";}
  elseif (stristr("$daten[browser]","Mozilla/4.75"))
    {echo "<td>NS&nbsp;4.75</td>";}
  elseif (stristr("$daten[browser]","Mozilla/4.7"))
    {echo "<td>NS&nbsp;4.7</td>";}
  elseif (stristr("$daten[browser]","Mozilla/4.6"))
    {echo "<td>NS&nbsp;4.6</td>";}
  elseif (stristr("$daten[browser]","MSIE 4.01"))
    {echo "<td>MS IE 4.01</td>";}
  elseif (stristr("$daten[browser]","MSIE 5.0"))
    {echo "<td>MS&nbsp;IE&nbsp;5.0</td>";}
  elseif (stristr("$daten[browser]","MSIE 5.5"))
    {echo "<td>MS&nbsp;IE&nbsp;5.5</td>";}
  elseif (stristr("$daten[browser]","MSIE 5.13"))
    {echo "<td>MS&nbsp;IE&nbsp;5.13</td>";}
  elseif (stristr("$daten[browser]","MSIE 6.0"))
    {echo "<td>MS&nbsp;IE&nbsp;6.0</td>";}
  elseif (stristr("$daten[browser]","Mozilla/5.0"))
    {echo "<td>Mozilla</td>";}
  elseif (stristr("$daten[browser]","Sqworm/2.9.85-BETA"))
    {echo "<td>Sqworm</td>";}
  elseif (stristr("$daten[browser]","W3C_Validator"))
    {echo "<td>W3C</td>";}
  elseif (stristr("$daten[browser]","W3C_CSS_Validator"))
    {echo "<td>W3C</td>";}
  elseif (stristr("$daten[browser]","Googlebot/2.1"))
    {echo "<td>GoogleBot</td>";}
  elseif (stristr("$daten[browser]","TurnitinBot/1.5"))
    {echo "<td>TurnitinBot</td>";}
  elseif (stristr("$daten[browser]","http://www.WISEnutbot.com"))
    {echo "<td>WISEnutbot</td>";}
  else
    {echo "<td>$daten[browser]</td>";}


  $zeit1 = date("d.n",$daten['dauer_start']);
  $zeit2 = date("H:i",$daten['dauer_start']);
  echo "  <td>$zeit1&nbsp;$zeit2</td>\n";

  $dauer = ($daten['dauer_ende']-$daten['dauer_start']+60)/60;
  $dauer = round ($dauer,0);
  if ($dauer < 0)
    echo "  <td align=\"right\">error</td>\n";
  else
    echo "  <td align=\"right\">$dauer&nbsp;M.</td>\n";

  echo "  <td>$daten[count]</td>\n";
  echo "  <td>$daten[tilesetcount]</td>\n";


  //Cookie
  if ($daten['cookie_inhalt'] == "0")
    {echo "<td>Sommer</td>";}
  elseif ($daten['cookie_inhalt'] == "1")
    {echo "<td>Winter</td>";}
  elseif ($daten['cookie_inhalt'] == "2")
    {echo "<td>Brachland</td>";}
  elseif ($daten['cookie_inhalt'] == "3")
    {echo "<td>W&uuml;ste</td>";}
  else
    {echo "<td>no</td>";}

    echo "  <td>$daten[statusleiste]</td>\n";
  if ($detail == "yes")
  {
    echo "  <td>$daten[ursprung]</td>\n";
  }
  echo "  <td>$daten[zuletzt]</td>\n";
  echo "  <td>$daten[pre1_zuletzt]</td>\n";
if ($detail == "yes")
{
  echo "  <td>$daten[pre2_zuletzt]</td>\n";
  echo "  <td>$daten[pre3_zuletzt]</td>\n";
  echo "  <td>$daten[pre4_zuletzt]</td>\n";
  echo "  <td>$daten[pre5_zuletzt]</td>\n";
  echo "  <td>$daten[pre6_zuletzt]</td>\n";
  echo "  <td>$daten[pre7_zuletzt]</td>\n";
  echo "  <td>$daten[pre8_zuletzt]</td>\n";
  echo "  <td>$daten[pre9_zuletzt]</td>\n";
  echo "  <td>$daten[clipboard]</td>\n";

  echo "<td><form action=\"internx.php?ident=$ident&sortby=$sortby&direction=$direction&mich=$mich&detail=$detail&rows=$rows\" method=\"post\">";
  echo "<input type=\"hidden\" name=\"aktion\" value=\"eintrag_l\">";
  echo "<input type=\"hidden\" name=\"f_id\" value=\"$daten[id]\">";
  echo "<input type=\"submit\" value=\"Delete\"></form></td>";

  echo "<td><form action=\"internx.php?ident=$ident&sortby=$sortby&direction=$direction&mich=$mich&detail=$detail&rows=$rows\" method=\"post\">";
  echo "<input type=\"hidden\" name=\"aktion\" value=\"clipboard_l\">";
  echo "<input type=\"hidden\" name=\"f_id\" value=\"$daten[id]\">";
  echo "<input type=\"submit\" value=\"Remove Clipboard\"></form></td>";

  echo "<td><form action=\"internx.php?ident=$ident&sortby=$sortby&direction=$direction&mich=$mich&detail=$detail&rows=$rows\" method=\"post\">";
  echo "<input type=\"hidden\" name=\"aktion\" value=\"user_l\">";
  echo "<input type=\"hidden\" name=\"f_id\" value=\"$daten[id]\">";
  echo "<input type=\"submit\" value=\"Set User\"></form></td>";

}
  echo "</tr>";
}
?>
</table>

<?
if ($mich == "yes")
  echo "Mich anzeigen:<input type=\"checkbox\" value=\"1\" checked onClick=\"top.location.href = 'internx.php?ident=$ident&sortby=$sortby&direction=$direction&mich=no&detail=$detail&rows=$rows'\">";
else
  echo "Mich anzeigen:<input type=\"checkbox\" value=\"1\" onClick=\"top.location.href = 'internx.php?ident=$ident&sortby=$sortby&direction=$direction&mich=yes&detail=$detail&rows=$rows'\">";
?>

<h3><u>2) Seitenstatistik</u></h3>

<?

$abfrage_id = mysql_query("SELECT id,datum,pagename,anzahl FROM stpageviews");

$i = 0;

while($daten = mysql_fetch_array($abfrage_id))
{

  if ($daten[pagename] != "$_SERVER[PHP_SELF]")
  {
    $i += $daten[anzahl];
  }

}
echo "Seitenaufrufe bisher: $i (ohne internx)<br><br>";

$abfrage_id = mysql_query("SELECT id,datum,pagename,anzahl FROM stpageviews");
?>

<table border="2" cellspacing="0" bgcolor=#000059>
<tr>
<th>Seitenname</th>
<th>Aufrufe</th>
<th>Zuletzt</th>
</tr>

</tr>
<?
while($daten = mysql_fetch_array($abfrage_id))
{
  $d = (string) $daten[datum];
  echo "<tr>";
  echo "  <td>$daten[pagename]</td>\n";
  echo "  <td>$daten[anzahl]</td>\n";
  echo "  <td>$d[8]$d[9].$d[5]$d[6].$d[2]$d[3] um $d[11]$d[12]:$d[14]$d[15]</td>\n";
  echo "</tr>";
}
?>
</table>

<h3><u>3) Aktion durchf&uuml;hren</u></h3>
Achtung! Ein Klick f&uuml;hrt die gew&auml;hlte Aktion sofort aus. Daten gehen unwiderbringlich verloren.
<br><br>

<?
echo "<a href=\"internx.php?ident=$ident&sortby=$sortby&direction=$direction&mich=$mich&detail=$detail&rows=$rows&aktion=counter_l\">Counter zur&uuml;cksetzen ('counter.txt' wird gel&ouml;scht)</a><br><br>";
echo "<a href=\"internx.php?ident=$ident&sortby=$sortby&direction=$direction&mich=$mich&detail=$detail&rows=$rows&aktion=aufrufe_l\">Seitenaufrufe zur&uuml;cksetzen (Alle Werte in der Spalte 'Aufrufe' = 0)</a><br><br>";
echo "<a href=\"internx.php?ident=$ident&sortby=$sortby&direction=$direction&mich=$mich&detail=$detail&rows=$rows&aktion=ips_l\">IP's maskieren (Au&szlig;er die 10 aktuellsten)</a><br><br>";
?>

</div>
<? else: ?>
Mich so aufzurufen ist nicht m&ouml;glich.
<? endif ?>

</font>
</body>
</html>

<?
  mysql_close($link);
?>
