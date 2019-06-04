<?PHP
include("vars.inc.php");

$ip = getenv("REMOTE_ADDR");
$browser = getenv("HTTP_USER_AGENT");

$link = mysql_connect($sql_server,$sql_user,$sql_pass);
mysql_select_db($sql_db);

$senden_id = mysql_query("UPDATE stspy SET statusleiste = 'closed' WHERE ip = '$ip' AND browser = '$browser'");

mysql_close($link);
?>

<html>
<head>
<meta name="description" content="Der Stammtisch, ein Warcraft2-Clan">
<meta name="author" content="Matthias Blanquett">
<meta name="generator" content="Microsoft Notepad">
<meta name="keywords" content="War2, Warcraft2, Clan, Onkels, Tanten">
<meta name="date" content="2002-10-20">
<meta name="robots" content="index">
<meta name="robots" content="follow">
<meta HTTP-EQUIV="content-language" content="de">
<meta HTTP-EQUIV="Content-Type" content="text/html; charset=iso-8859-1">
<meta HTTP-EQUIV="Expires" content="0">

<title>Der Stammtisch</title>
<LINK REL="SHORTCUT ICON" HREF="bilder/troll.ico">
</head>



<frameset rows="96,*" border="0">
<frame name="top" src="top.php" frameborder="0" framespacing="0" border="0" scrolling="no" noresize marginwidth="0" marginheight="0">

<? if (isset($center)): ?>
<? echo "<frame name=\"center\" src=\"$center\" frameborder=\"0\" framespacing=\"0\" border=\"0\" scrolling=\"auto\" noresize marginwidth=\"0\" marginheight=\"0\">" ?>
<? else: ?>
<frame name="center" src="center.php" frameborder="0" framespacing="0" border="0" scrolling="auto" noresize marginwidth="0" marginheight="0">
<? endif ?>

</frameset>



<body>
<p><b>Leider unterst&uuml;tzt Ihr Browser keine Frames...</b></p>
</body>
</html>