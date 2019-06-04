<html>
<head>
<script src="scripte.js"></script>

<script>
var z = document.cookie;

function neueFramesLaden()
{
  parent.frames[0].location.href=parent.frames[0].document.URL;
  parent.frames[1].location.href=parent.frames[1].document.URL;
}


function ls(Zahl)
{
  if (Zahl != z)
  {
    z = Zahl;

    var expdate = new Date();
    expdate.setTime(expdate.getTime()+(60*24*60*60*1000));
    document.cookie = escape(Zahl) + "; expires="+expdate.toGMTString();

    neueFramesLaden();
  }
}

function help()
{
  alert("Wenn Sie sich definitiv für einen Landschaftstyp entschieden haben, können sie den Auswahl-Frame hier schließen. Wahlweise auch nur minimieren.");
}

function mini()
{
  top.location.href = "start_mi.php?center="+parent.frames[1].document.URL;
}

function exit()
{
  top.location.href = "start_cl.php?center="+parent.frames[1].document.URL;
}
</script>


</head>
<body bgcolor="#AAAAAA">

<script>
<!--
if (document.cookie)
{
  document.writeln('<table width="100%" cellspacing="0" cellpadding="0"><tr valign="top"><td><form>');

  if (document.cookie == 0)
    document.writeln('<input type=radio name="landscape" checked value="0" onClick="ls(0)"> Sommer');
  else
    document.writeln('<input type=radio name="landscape" value="0" onClick="ls(0)"> Sommer');

  if (document.cookie == 1)
    document.writeln('<input type=radio name="landscape" checked value="1" onClick="ls(1)"> Winter');
  else
    document.writeln('<input type=radio name="landscape" value="1" onClick="ls(1)"> Winter');

  if (document.cookie == 2)
    document.writeln('<input type=radio name="landscape" checked value="2" onClick="ls(2)"> Brachland');
  else
    document.writeln('<input type=radio name="landscape" value="2" onClick="ls(2)"> Brachland');

  if (document.cookie == 3)
    document.writeln('<input type=radio name="landscape" checked value="3" onClick="ls(3)"> W&uuml;ste');
  else
    document.writeln('<input type=radio name="landscape" value="3" onClick="ls(3)"> W&uuml;ste');

  document.writeln('</form></td><td align="right"><a href="javascript:help()"><img src="bilder/help.gif" width="16" height="14" border="0"></a>&nbsp;<a href="javascript:mini()"><img src="bilder/mini.gif" width="16" height="14" border="0"></a>&nbsp;<a href="javascript:exit()"><img src="bilder/exit.gif" width="16" height="14" border="0"></a></td></tr></table>');
}
else
{
  document.writeln('<table width="100%" cellspacing="0" cellpadding="0"><tr valign="top"><td>Mit aktivierten Cookies k&ouml;nnten sie hier den Landschaftstyp &auml;ndern</td>');
  document.writeln('<td align="right"><a href="javascript:help()"><img src="bilder/help.gif" width="16" height="14" border="0"></a>&nbsp;<a href="javascript:mini()"><img src="bilder/mini.gif" width="16" height="14" border="0"></a>&nbsp;<a href="javascript:exit()"><img src="bilder/exit.gif" width="16" height="14" border="0"></a></td></tr></table>');
}


//-->
</script>
<noscript>
Mit aktiviertem Javascript k&ouml;nnten sie hier den Landschaftstyp &auml;ndern
</noscript>


</body>
</html>