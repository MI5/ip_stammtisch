<?php
include("vars.inc.php");

include("pageviews.inc");
include("spy.inc");
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="scripte.js"></script>
<title>Intern</title>

<script>
switch (document.cookie)
{
  case "0":
  case "2": document.writeln('<style type="text/css">td,th { color:#FFFFFF }</style>');
  break;

  case "1":
  case "3": document.writeln('<style type="text/css">td,th { color:#0000FF }</style>');
  break;
}
</script>

<script>
function open__window(id)
{
  Fenster = open("kuel_img.php?id="+id,"Fenster","width=250,height=250,screenX=20,screenY=20");
}
</script>

</head>

<script>
selectbg();
</script>
<noscript><body background="bg_sommer.gif"><font color="#FFFFFF"></noscript>
<div align="center">

<?
$mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);


$abfrage_id = $mysqli->query("SELECT id,prefix,nick,name,status,since,location,pw,email,wl,format,icq,typ,option_icqshow,option_icqsend,option_mailsend,option_notself,visits,option_kuel,option_autoli FROM stmembers WHERE typ >= 0 AND nick = '$f_nick' AND pw = '$f_pw'");

if (($daten = mysql_fetch_array($abfrage_id)) && ($f_pw != "")): ?>


<?
/* Spionage Anfang */

  $ip = getenv("REMOTE_ADDR");
  $browser = getenv("HTTP_USER_AGENT");

  $abfrage_id = $mysqli->query("SELECT user FROM stspy WHERE ip = '$ip' AND browser = '$browser'");
  $daten_s = mysql_fetch_array($abfrage_id);

  if ($daten_s['user'] == "")
    $senden_id = $mysqli->query("UPDATE stspy SET user = '$daten[prefix].$daten[nick]' WHERE ip = '$ip' AND browser = '$browser'");

/* Spionage Ende */

/* Spionage2 Anfang */

  $abfrage_id = $mysqli->query("SELECT visits FROM stmembers WHERE id = '$daten[id]'");
  $daten_s = mysql_fetch_array($abfrage_id);

  $anzahl = $daten_s['visits'];
  $anzahl++;
  $senden_id = $mysqli->query("UPDATE stmembers SET visits = '$anzahl' WHERE id = '$daten[id]'");
/* Spionage2 Ende */


          /* Login Anfang 2 */

          $ip = getenv("REMOTE_ADDR");
          $timex = time();

          $abfrage_id = $mysqli->query("SELECT id FROM stonline WHERE ip = '$ip'");

          if (!($daten_pw_ = mysql_fetch_array($abfrage_id)) && ($daten['option_autoli'] == 1))
          {
            $senden_id = $mysqli->query("INSERT INTO stonline (prefix,nick,pw,lastrequest,ip,typ) VALUES ('$daten[prefix]','$daten[nick]','$daten[pw]','$timex','$ip','$daten[typ]')");
          }

          /* Login Ende 2*/
?>

  <script>
  function ch(Zahl)
  {
    if (document.forms["einst"].f_option_icqsend.checked == false && document.forms["einst"].f_option_mailsend.checked == false)
    {
      document.forms["einst"].f_option_notself.disabled = true;
    }
    else
    {
      document.forms["einst"].f_option_notself.disabled = false;
    }
  }
  </script>

  <div align="left">

  <? // Wurde etwas aktualisiert?
    echo "<font color=\"#FF0000\"><b>";

    if (($f_action == "F1") && isset($f_prefix) && isset($f_icq) && isset($f_email) && isset($f_wl) && isset($f_id))
    {
      echo "Daten wurden aktualisiert<br><br>";
      if ($f_email != $daten['email'])
      {
        mail("ncc_1701@gmx.de", "Änderungswunsch", "Hallo Matze!\n\n$daten[prefix].$daten[nick] wünscht eine Änderung seiner eMail-Adresse von $daten[email] auf $f_email\n\nhttp://www.kontent.de", "From: Web-Onkel MI5 <Onkel.MI5@der-stammtisch.net>");
        echo "Du hast eine &Auml;nderung an der Stammtisch-eMail-Adresse vorgenommen. Diese muss vom Webmaster pers&ouml;nlich umgestellt werden. ";
        echo "Er wurde bereits per eMail informiert. Trotzdem kann es bis zu 24 Stunden dauern, bis die &Auml;nderung übernommen wird.<br><br>";
      }
      if ($f_wl != $daten['wl'])
      {
        mail("ncc_1701@gmx.de", "Änderungswunsch", "Hallo Matze!\n\n$daten[prefix].$daten[nick] wünscht eine Änderung seiner Weiterleitungs-Adresse von $daten[wl] auf $f_wl\n\nhttp://www.kontent.de", "From: Web-Onkel MI5 <Onkel.MI5@der-stammtisch.net>");
        echo "Du hast eine &Auml;nderung an der Weiterleitungs-eMail-Adresse vorgenommen. Diese muss vom Webmaster pers&ouml;nlich umgestellt werden. ";
        echo "Er wurde bereits per eMail informiert. Trotzdem kann es bis zu 24 Stunden dauern, bis die &Auml;nderung übernommen wird.<br><br>";
      }
      if ($f_icq == "")
      {
        $senden_id = $mysqli->query("UPDATE stmembers SET option_icqshow = 0 WHERE id = $f_id");
        $senden_id = $mysqli->query("UPDATE stmembers SET option_icqsend = 0 WHERE id = $f_id");
      }
      $senden_id = $mysqli->query("UPDATE stmembers SET prefix = '$f_prefix', icq = '$f_icq', email = '$f_email', wl ='$f_wl' WHERE id = $f_id");

      $abfrage_id = $mysqli->query("SELECT id,prefix,nick,name,status,since,location,pw,email,wl,format,icq,typ,option_icqshow,option_icqsend,option_mailsend,option_notself,visits,option_kuel,option_autoli FROM stmembers WHERE id = $f_id");
      $daten = mysql_fetch_array($abfrage_id);
      echo "<br><br>";
    }


    if ($f_action == "F2")
    {
      if ($f_submit == "Jetzt Ausloggen")
      {
        $ip = getenv("REMOTE_ADDR");

        $abfrage_id = $mysqli->query("SELECT id FROM stonline WHERE ip = '$ip'");
        if ($daten_check = mysql_fetch_array($abfrage_id))
        {
          $loeschen_id = $mysqli->query("DELETE FROM stonline WHERE ip = '$ip'");
          echo "Ausgeloggt!<br><br>";
        }
        else
        {
          echo "Ip wurde nicht gefunden! Kein Ausloggen n&ouml;tig.<br><br>";
        }
      }
      else
      {
        echo "Einstellungen wurden aktualisiert<br><br>";

        if ($f_option_icqshow == 1)
        {
          $senden_id = $mysqli->query("UPDATE stmembers SET option_icqshow = '$f_option_icqshow' WHERE id = $f_id");
        }
        else
        {
          $senden_id = $mysqli->query("UPDATE stmembers SET option_icqshow = 0 WHERE id = $f_id");
        }

        if ($f_option_icqsend == 1)
        {
          $senden_id = $mysqli->query("UPDATE stmembers SET option_icqsend = '$f_option_icqsend' WHERE id = $f_id");
        }
        else
        {
          $senden_id = $mysqli->query("UPDATE stmembers SET option_icqsend = 0 WHERE id = $f_id");
        }

        if ($f_option_mailsend == 1)
        {
          $senden_id = $mysqli->query("UPDATE stmembers SET option_mailsend = '$f_option_mailsend' WHERE id = $f_id");
        }
        else
        {
          $senden_id = $mysqli->query("UPDATE stmembers SET option_mailsend = 0 WHERE id = $f_id");
        }

        if ($f_option_notself == 1)
        {
          $senden_id = $mysqli->query("UPDATE stmembers SET option_notself = '$f_option_notself' WHERE id = $f_id");
        }
        else
        {
          $senden_id = $mysqli->query("UPDATE stmembers SET option_notself = 0 WHERE id = $f_id");
        }

        if ($f_option_autoli == 1)
        {
          $senden_id = $mysqli->query("UPDATE stmembers SET option_autoli = '$f_option_autoli' WHERE id = $f_id");
        }
        else
        {
          $senden_id = $mysqli->query("UPDATE stmembers SET option_autoli = 0 WHERE id = $f_id");
          $loeschen_id = $mysqli->query("DELETE FROM stonline WHERE ip = '$ip'");
        }

      }
      $abfrage_id = $mysqli->query("SELECT id,prefix,nick,name,status,since,location,pw,email,wl,format,icq,typ,option_icqshow,option_icqsend,option_mailsend,option_notself,visits,option_kuel,option_autoli FROM stmembers WHERE id = $f_id");
      $daten = mysql_fetch_array($abfrage_id);
      echo "<br><br>";
    }


    if (($f_action == "F2a"))
    {
      if ($f_format == "")
      {
        echo "Die KUEL-Bild-URL sollte grunds&auml;tzlich nicht leer sein!<br><br>";
      }
      else
      {
        echo "Kuel-Daten wurden aktualisiert<br><br>";
        mail("ncc_1701@gmx.de", "Kuel wurde aktualisiert", "Hallo Matze!\n\n$daten[prefix].$daten[nick] hat seine KUEL-Daten geändert. Schau mal lieber ob die URL korrekt ist. Oder will er gar nicht mehr mitspielen?", "From: Web-Onkel MI5 <Onkel.MI5@der-stammtisch.net>");

        if ($f_option_kuel == 1)
        {
          $senden_id = $mysqli->query("UPDATE stmembers SET option_kuel = '$f_option_kuel' WHERE id = $f_id");
        }
        else
        {
          $senden_id = $mysqli->query("UPDATE stmembers SET option_kuel = 0 WHERE id = $f_id");
        }

        $senden_id = $mysqli->query("UPDATE stmembers SET format = '$f_format' WHERE id = $f_id");

        $abfrage_id = $mysqli->query("SELECT id,prefix,nick,name,status,since,location,pw,email,wl,format,icq,typ,option_icqshow,option_icqsend,option_mailsend,option_notself,visits,option_kuel,option_autoli FROM stmembers WHERE id = $f_id");
        $daten = mysql_fetch_array($abfrage_id);
        echo "<br><br>";
      }
    }


    if ($f_action == "F3")
    {
      if ($f_passw1 != $f_passw2)
        { echo "Passwort-wiederholung stimmt nicht mit der ersten Eingabe &uuml;berein!<br><br>"; }
      elseif ($f_passw1 == "")
        { echo "Passwort kann nicht leer sein!<br><br>"; }
      else
      {
        echo "Passwort wurde ge&auml;ndert<br><br>";
        $senden_id = $mysqli->query("UPDATE stmembers SET pw = '$f_passw1' WHERE id = $f_id");
        $f_pw = "$f_passw1";

        // Sicherheits-Ausloggen - Anfang (sonst ist das alte Passwort noch in 'stonline')
        $ip = getenv("REMOTE_ADDR");
        $loeschen_id = $mysqli->query("DELETE FROM stonline WHERE ip = '$ip'");
        echo "Ein Sicherheits-Logout wurde zudem ausgeführt.<br><br>";
        // Sicherheits-Ausloggen - Ende

        $abfrage_id = $mysqli->query("SELECT id,prefix,nick,name,status,since,location,pw,email,wl,format,icq,typ,option_icqshow,option_icqsend,option_mailsend,option_notself,visits,option_kuel,option_autoli FROM stmembers WHERE id = $f_id");
        $daten = mysql_fetch_array($abfrage_id);
      }
      echo "<br><br>";
    }


    if ($f_action == "F4")
    {
        $abfrage_id = $mysqli->query("SELECT id,name,topic,datum,beitrag,email,intern FROM stammtisch WHERE id = '$f_id_beitrag'");
        $daten3 = mysql_fetch_array($abfrage_id);
        echo "&Auml;ndern des Forenbeitrags ";
        if ($daten3['intern'] == 1)
          echo "<img src=\"bilder/schluessel.gif\" width=\"15\" height=\"7\">&nbsp;";
        echo "\"$daten3[topic]\" von $daten3[name]:";

        echo "\n<script>\n";
        echo "function click(Zahl)\n";
        echo "{\n";
        echo "  if (document.forms[0].f_beitrag.value == \"\")\n";
        echo "    document.forms[0].b1.value = \"Beitrag Löschen\"\n";
        echo "  else";
        echo "    document.forms[0].b1.value = \"Änderungen übernehmen\"\n";
        echo "}\n";
        echo "function click2(Zahl)\n";
        echo "{\n";
        echo "  document.forms[0].b1.value = \"Änderungen übernehmen\"\n";
        echo "}\n";
        echo "</script>\n";


        echo "</b></font>";
        echo "<form action=\"intern.php\" method=\"post\">";
        echo "Intern: <input type=\"checkbox\" "; if (($daten3['intern']) == 1) echo "checked "; echo "name=\"f_intern\" value=\"1\"><br>";
        echo "Verfasser: <input name=\"f_name\" size=\"30\" maxlength=\"60\" value=\"$daten3[name]\"><br>";
        echo "Titel: <input name=\"f_topic\" size=\"30\" maxlength=\"200\" value=\"$daten3[topic]\"><br>";
        echo "<textarea onKeyup=\"click(0)\" name=\"f_beitrag\" rows=\"10\" cols=\"50\" wrap=\"physical\">$daten3[beitrag]</textarea>";

        echo "<input type=\"hidden\" name=\"f_nick\" value=\"$f_nick\">";
        echo "<input type=\"hidden\" name=\"f_pw\" value=\"$f_pw\">";
        echo "<input type=\"hidden\" name=\"f_id\" value=\"$daten[id]\">";
        echo "<input type=\"hidden\" name=\"f_action\" value=\"F5\">";
        echo "<input type=\"hidden\" name=\"f_id_beitrag\" value=\"$daten3[id]\">";
        echo "<br><br><input onClick=\"click2(0)\" type=\"reset\" value=\"Zur&uuml;cksetzen\">";
        echo "<input name=\"b1\" type=\"submit\" value=\"&Auml;nderungen &uuml;bernehmen\">";
        echo "</form>";

        echo "<br><br>";
        echo "<font color=\"#FF0000\"><b>";
    }

    if ($f_action == "F4_KUEL")
    {
        $abfrage_id = $mysqli->query("SELECT id,name,topic,datum,beitrag,email FROM stammtisch2 WHERE id = '$f_id_beitrag'");
        $daten3 = mysql_fetch_array($abfrage_id);
        echo "&Auml;ndern des Forenbeitrags ";
        echo "\"$daten3[topic]\" von $daten3[name]:";

        echo "\n<script>\n";
        echo "function click(Zahl)\n";
        echo "{\n";
        echo "  if (document.forms[0].f_beitrag.value == \"\")\n";
        echo "    document.forms[0].b1.value = \"Beitrag Löschen\"\n";
        echo "  else";
        echo "    document.forms[0].b1.value = \"Änderungen übernehmen\"\n";
        echo "}\n";
        echo "function click2(Zahl)\n";
        echo "{\n";
        echo "  document.forms[0].b1.value = \"Änderungen übernehmen\"\n";
        echo "}\n";
        echo "</script>\n";


        echo "</b></font>";
        echo "<form action=\"intern.php\" method=\"post\">";
        echo "Verfasser: <input name=\"f_name\" size=\"30\" maxlength=\"60\" value=\"$daten3[name]\"><br>";
        echo "Titel: <input name=\"f_topic\" size=\"30\" maxlength=\"200\" value=\"$daten3[topic]\"><br>";
        echo "<textarea onKeyup=\"click(0)\" name=\"f_beitrag\" rows=\"10\" cols=\"50\" wrap=\"physical\">$daten3[beitrag]</textarea>";

        echo "<input type=\"hidden\" name=\"f_nick\" value=\"$f_nick\">";
        echo "<input type=\"hidden\" name=\"f_pw\" value=\"$f_pw\">";
        echo "<input type=\"hidden\" name=\"f_id\" value=\"$daten[id]\">";
        echo "<input type=\"hidden\" name=\"f_action\" value=\"F5_KUEL\">";
        echo "<input type=\"hidden\" name=\"f_id_beitrag\" value=\"$daten3[id]\">";
        echo "<br><br><input onClick=\"click2(0)\" type=\"reset\" value=\"Zur&uuml;cksetzen\">";
        echo "<input name=\"b1\" type=\"submit\" value=\"&Auml;nderungen &uuml;bernehmen\">";
        echo "</form>";

        echo "<br><br>";
        echo "<font color=\"#FF0000\"><b>";
    }


    if ($f_action == "F4a")
    {
        $abfrage_id = $mysqli->query("SELECT id,name,topic,datum,beitrag FROM stnews WHERE id = '$f_id_beitrag'");
        $daten3 = mysql_fetch_array($abfrage_id);
        echo "&Auml;ndern der News \"$daten3[topic]\" von $daten3[name]:";

        echo "\n<script>\n";
        echo "function click(Zahl)\n";
        echo "{\n";
        echo "  if (document.forms[0].f_beitrag.value == \"\")\n";
        echo "    document.forms[0].b1.value = \"Beitrag Löschen\"\n";
        echo "  else";
        echo "    document.forms[0].b1.value = \"Änderungen übernehmen\"\n";
        echo "}\n";
        echo "function click2(Zahl)\n";
        echo "{\n";
        echo "  document.forms[0].b1.value = \"Änderungen übernehmen\"\n";
        echo "}\n";
        echo "</script>\n";

        echo "<form action=\"intern.php\" method=\"post\">";
        echo "Verfasser: <input name=\"f_name\" size=\"30\" maxlength=\"60\" value=\"$daten3[name]\"><br>";
        echo "Titel: <input name=\"f_topic\" size=\"30\" maxlength=\"200\" value=\"$daten3[topic]\"><br>";
        echo "<textarea onKeyup=\"click(0)\" name=\"f_beitrag\" rows=\"10\" cols=\"50\" wrap=\"physical\">$daten3[beitrag]</textarea>";

        echo "<input type=\"hidden\" name=\"f_nick\" value=\"$f_nick\">";
        echo "<input type=\"hidden\" name=\"f_pw\" value=\"$f_pw\">";
        echo "<input type=\"hidden\" name=\"f_id\" value=\"$daten[id]\">";
        echo "<input type=\"hidden\" name=\"f_action\" value=\"F5a\">";
        echo "<input type=\"hidden\" name=\"f_id_beitrag\" value=\"$daten3[id]\">";
        echo "<br><br><input onClick=\"click2(0)\" type=\"reset\" value=\"Zur&uuml;cksetzen\">";
        echo "<input name=\"b1\" type=\"submit\" value=\"&Auml;nderungen &uuml;bernehmen\">";
        echo "</form>";

        echo "<br><br>";
    }


    if ($f_action == "F5")
    {
        if ($f_beitrag == "")
        {
          $loeschen_id = $mysqli->query("DELETE FROM stammtisch WHERE id = '$f_id_beitrag'");

          echo "Forenbeitrag wurde gel&ouml;scht!";
        }
        else
        {
          $abfrage_id = $mysqli->query("SELECT datum FROM stammtisch WHERE id = '$f_id_beitrag'");
          $datenT = mysql_fetch_array($abfrage_id);

          $senden_id = $mysqli->query("UPDATE stammtisch SET beitrag = '$f_beitrag',datum = '$datenT[datum]',topic = '$f_topic',intern = '$f_intern',name = '$f_name' WHERE id = $f_id_beitrag");

          echo "Forenbeitrag wurde &uuml;berarbeitet!";
        }

        echo "<br><br>";
    }
    
    
    if ($f_action == "F5_KUEL")
    {
        if ($f_beitrag == "")
        {
          $loeschen_id = $mysqli->query("DELETE FROM stammtisch2 WHERE id = '$f_id_beitrag'");

          echo "Forenbeitrag wurde gel&ouml;scht!";
        }
        else
        {
          $abfrage_id = $mysqli->query("SELECT datum FROM stammtisch2 WHERE id = '$f_id_beitrag'");
          $datenT = mysql_fetch_array($abfrage_id);

          $senden_id = $mysqli->query("UPDATE stammtisch2 SET beitrag = '$f_beitrag',datum = '$datenT[datum]',topic = '$f_topic',name = '$f_name' WHERE id = $f_id_beitrag");

          echo "Forenbeitrag wurde &uuml;berarbeitet!";
        }

        echo "<br><br>";
    }


    if ($f_action == "F5a")
    {
        if ($f_beitrag == "")
        {
          $abfrage_id = $mysqli->query("DELETE FROM stnews WHERE id = '$f_id_beitrag'");

          echo "News wurde gel&ouml;scht!";
        }
        else
        {
          $abfrage_id = $mysqli->query("SELECT datum FROM stnews WHERE id = '$f_id_beitrag'");
          $datenT = mysql_fetch_array($abfrage_id);

          $senden_id = $mysqli->query("UPDATE stnews SET beitrag = '$f_beitrag',datum = '$datenT[datum]',topic = '$f_topic',name = '$f_name' WHERE id = $f_id_beitrag");

          echo "News wurde &uuml;berarbeitet!";
        }

        echo "<br><br>";
    }


    if ($f_action == "F6")
    {
      if ($f_typ == 0)
      {
        $f_status = "";
        $f_prefix_vorher = "Kumpel";
      }

      if (($f_typ_vorher == 0) && ($f_typ > 0))
      {
        echo "Wir haben ein neues Mitglied! <br><br>";
        if ($f_status == "")
          $f_status = "Normalo-Onkel";

        $sinceN = time();
        $sinceS = date("m/Y",$sinceN);

        $senden_id = $mysqli->query("UPDATE stmembers SET status = '$f_status', typ = '$f_typ', prefix = 'Onkel', since = '$sinceS' WHERE id = $f_id_user");

        $abfrage_id = $mysqli->query("SELECT name,wl FROM stmembers WHERE id = $f_id_user");
        $datenTT = mysql_fetch_array($abfrage_id);

        if ($datenTT['wl'] == "")
        {
          echo "Ihm konnte leider keine eMail zugesandt werden, unterrichten Sie bitte UNVERZ&Uuml;GLICH den <a href=\"mailto:onkel.mi5&#64;der-stammtisch.net\">Webmaster</a> von dieser Tatsache.<br><br>";
        }
        else
        {
          $text1 = "Willkommen bei den Onkels $datenTT[name]!\n\nDu bist soeben ein echtes Stammtisch-mitglied geworden. Jedes Stammtisch-mitglied bekennt sich zu folgenden Richtlinien:\n\nhttp://www.der-stammtisch.net/richtlinien.txt\n\nBitte lies sie dir aufmerksam durch und richte dich danach!\n\n";
          $text2 = "Logg dich sobald wie möglich in den internen Bereich ein und triff dort deine persönlichen Einstellungen für die Webseite. Solltest du bisher dein Passwort noch nicht geändert haben, so solltest du es spätestens jetzt machen, damit nur noch du Zugriff auf deine Einstellungen hast.\n\n";
          $text3 = "Außerdem würden wir uns freuen, wenn du alsbald am KUEL teilnimmst.\n\nNochmal Herzlichen Glückwunsch zum Clan-Beitritt!\n\nHast du noch Fragen? Dann antworte auf diese eMail.\n\nWeb-Onkel MI5 & Ober-Onkel Becks";

          echo "Ihm wurde eine eMail zugesandt in dem ihm die Grundlagen des Onkels/Tanten-Daseins erkl&auml;rt werden.<br><br>";
          mail("$datenTT[wl]", "eMail vom Stammtisch", "$text1$text2$text3\n\nhttp://www.der-stammtisch.net", "From: Web-Onkel MI5 <Onkel.MI5@der-stammtisch.net>");
          mail("ncc_1701@gmx.de", "eMail vom Stammtisch", "$text1$text2$text3\n\nhttp://www.der-stammtisch.net", "From: Web-Onkel MI5 <Onkel.MI5@der-stammtisch.net>");
        }
      }
      else
      {
        if ($f_nick_new != "")
        {
          echo "Mitglied wurde aktualisiert<br><br>";
          $senden_id = $mysqli->query("UPDATE stmembers SET status = '$f_status', typ = '$f_typ', prefix = '$f_prefix_vorher', nick = '$f_nick_new' WHERE id = $f_id_user");

          // Sicherheits-Ausloggen - Anfang (falls der eigene Nick geändert wurde)
          $ip = getenv("REMOTE_ADDR");

          $abfrage_id = $mysqli->query("SELECT id FROM stonline WHERE ip = '$ip'");
          if ($daten_check = mysql_fetch_array($abfrage_id))
          {
            $loeschen_id = $mysqli->query("DELETE FROM stonline WHERE ip = '$ip'");
            echo "Ein Sicherheits-Logout wurde zudem ausgeführt.<br><br>";
          }
          // Sicherheits-Ausloggen - Ende

        }
        else
          echo "Irgendwie muss er ja heißen, oder?";
      }

      $abfrage_id = $mysqli->query("SELECT id,prefix,nick,name,status,since,location,pw,email,wl,format,icq,typ,option_icqshow,option_icqsend,option_mailsend,option_notself,visits,option_kuel,option_autoli FROM stmembers WHERE id = $f_id");
      $daten = mysql_fetch_array($abfrage_id);
      echo "<br><br>";
    }


    if ($f_action == "F7")
    {
      if ($f_new_nick != "")
      {
        echo "Es wurde ein neues Probemember hinzugef&uuml;gt.<br><br>";
        if ($f_new_email == "")
        {
          echo "Ihm konnte leider keine eMail zugesandt werden. Bitte weise ihn deshalb pers&ouml;nlich ein. ";
          echo "Teil ihm bitte unter anderem mit, dass sein Passwort \"probe\" lautet.<br><br>";
        }
        else
        {
          echo "Ihm wurde per eMail sein Passwort f&uuml;r den internen Bereich mitgeteilt.<br><br>";
          mail("$f_new_email", "eMail vom Stammtisch", "Hallo $f_new_name!\n\nDu bist soeben Probemember des Stammtisches geworden. Wenn du Fragen dazu hast, dann antworte auf diese automatisch generierte eMail.\n\nDein Passwort für den internen Bereich lautet \"probe\". Am besten änderst du es gleich im internen Bereich der Homepage ab.\n\nhttp://www.der-stammtisch.net", "From: Web-Onkel MI5 <Onkel.MI5@der-stammtisch.net>");
          mail("ncc_1701@gmx.de", "eMail vom Stammtisch", "Hallo $f_new_name!\n\nDu bist soeben Probemember des Stammtisches geworden. Wenn du Fragen dazu hast, dann antworte auf diese automatisch generierte eMail.\n\nDein Passwort für den internen Bereich lautet \"probe\". Am besten änderst du es gleich im internen Bereich der Homepage ab.\n\nhttp://www.der-stammtisch.net", "From: Web-Onkel MI5 <Onkel.MI5@der-stammtisch.net>");
        }
        $senden_id = $mysqli->query("INSERT INTO stmembers (prefix, nick, name, location, wl, pw, typ, option_icqshow, option_icqsend, option_mailsend, option_notself, visits, option_kuel, option_autoli, points) VALUES ('Kumpel','$f_new_nick', '$f_new_name', '$f_new_ort', '$f_new_email', 'probe', 0, 0, 0, 0, 0, 0, 0, 1, 0)");
      }
      else
      {
        echo "Der Nick sollte schon angegeben werden!!<br><br>";
      }


      $abfrage_id = $mysqli->query("SELECT id,prefix,nick,name,status,since,location,pw,email,wl,format,icq,typ,option_icqshow,option_icqsend,option_mailsend,option_notself,visits,option_kuel,option_autoli FROM stmembers WHERE id = $f_id");
      $daten = mysql_fetch_array($abfrage_id);
      echo "<br><br>";
    }


    if ($f_action == "F11")
    {
      echo "Kuelpunkte wurden aktualisiert<br><br>";
      for ($ki=0;$ki<count($f_newPoints);$ki++)
      {
        $newPoints[$ki] = $f_oldPoints[$ki] + $f_newPoints[$ki];
        $senden_id = $mysqli->query("UPDATE stmembers SET points = '$newPoints[$ki]' WHERE id = $f_id_user[$ki]");
      }

      $abfrage_id = $mysqli->query("SELECT id,prefix,nick,name,status,since,location,pw,email,wl,format,icq,typ,option_icqshow,option_icqsend,option_mailsend,option_notself,visits,option_kuel,option_autoli FROM stmembers WHERE id = $f_id");
      $daten = mysql_fetch_array($abfrage_id);
      echo "<br><br>";
    }
    
    if ($f_action == "F12")
    {
      echo "Kueldaten wurden aktualisiert<br><br>";
      $senden_id = $mysqli->query("INSERT INTO stkuel (woche,dax,euro,lotto1,lotto2,lotto3,lotto4,lotto5,lotto6,krieg,wirtschaft,text) VALUES ('$woche','$dax','$euro','$l1','$l2','$l3','$l4','$l5','$l6','$krieg','$wirtschaft','$text')");

      $abfrage_id = $mysqli->query("SELECT id,prefix,nick,name,status,since,location,pw,email,wl,format,icq,typ,option_icqshow,option_icqsend,option_mailsend,option_notself,visits,option_kuel,option_autoli FROM stmembers WHERE id = $f_id");
      $daten = mysql_fetch_array($abfrage_id);
      echo "<br><br>";
    }

    if ($f_action == "F13")
    {

      if((isset($thefile)) && ($thefile_size > 0))
        if ($thefile_size > 500000)
          echo "Die Datei ist über 5 MB groß! Das kann wohl nicht ganz stimmen?!<br><br>Was hast du probiert hochzuladen???";
        else
          if(!copy($thefile,"bilder/kuel.jpg"))
              echo "Upps, es passierte ein Fehler beim Kopieren. Speicherkapazitäten erschöpft?<br>";
          else
            echo "Map erfolgreich hochgeladen.";
      else
        if ($thefile_size == "0")
          echo "Das ist kein gültiger Pfad zu einer Datei!";
        else
          echo "Fehler X100. Wenn diese Fehlermeldung erscheint ist irgendwas schief gelaufen.";

      $abfrage_id = $mysqli->query("SELECT id,prefix,nick,name,status,since,location,pw,email,wl,format,icq,typ,option_icqshow,option_icqsend,option_mailsend,option_notself,visits,option_kuel,option_autoli FROM stmembers WHERE id = $f_id");
      $daten = mysql_fetch_array($abfrage_id);
      echo "<br><br>";
    }

    echo "</b></font>";

    if (!isset($f_action))
    {
      echo "Hallo $daten[name]!<br><br>";
      echo "Hier kannst du s&auml;mtliche pers&ouml;nlichen Einstellungen treffen. Evtl. ge&auml;nderte Einstellungen werden im ";
      echo "Bereich \"Members\" der Webseite sofort &uuml;bernommen, sofern sie dort angezeigt werden.<br><br>";
    }
  ?>

<?
if ($daten[typ] != 0)
{
?>
  <form action="intern.php" method="post">
  <h3>I. Daten:</h3>
  <table>
    <tr><td>Name:</td><td><? echo "$daten[name]" ?></td></tr>
    <tr><td>Pr&auml;fix:</td>
    <td>
    <select name="f_prefix">
    <?
    if ($daten[prefix] == "Onkel")
      echo "<option selected>Onkel</option>";
    else
      echo "<option>Onkel</option>";

    if ($daten[prefix] == "Tante")
      echo "<option selected>Tante</option>";
    else
      echo "<option>Tante</option>";

    if ($daten[prefix] == "Opa")
      echo "<option selected>Opa</option>";
    else
      echo "<option>Opa</option>";

    if ($daten[prefix] == "Oma")
      echo "<option selected>Oma</option>";
    else
      echo "<option>Oma</option>";

    if ($daten[prefix] == "Kumpel")
      echo "<option selected>Kumpel</option>";
    else
      echo "<option>Kumpel</option>";
    ?>
    </select>
    </td></tr>
    <tr><td>Nick:</td><td><? echo "$daten[nick]" ?></td></tr>
    <tr><td>Ort:</td><td><? echo "$daten[location]" ?></td></tr>
    <tr><td>Status:</td><td><? echo "$daten[status]" ?></td></tr>
    <tr><td>Eintritt:</td><td><? echo "$daten[since]" ?></td></tr>
    <tr><td>ICQ:</td><td><? echo "<input name=\"f_icq\" maxlength=\"30\" size=\"20\" value=\"$daten[icq]\">" ?></td></tr>
    <tr><td>eMail:</td><td><? echo "<input name=\"f_email\" maxlength=\"30\" size=\"20\" value=\"$daten[email]\">&#64;der-stammtisch.net" ?></td></tr>
    <tr><td>Weiterleitung:</td><td><? echo "<input name=\"f_wl\" maxlength=\"30\" size=\"20\" value=\"$daten[wl]\">" ?></td></tr>
  </table>
  <br>
  <input type="hidden" name="f_nick" value="<? echo "$f_nick"; ?>">
  <input type="hidden" name="f_pw" value="<? echo "$f_pw"; ?>">
  <input type="hidden" name="f_id" value="<? echo "$daten[id]"; ?>">
  <input type="hidden" name="f_action" value="F1">
  <input type="reset" value="Zur&uuml;cksetzen">
  <input type="submit" value="&Auml;nderungen &uuml;bernehmen">
  </form>


  <br><br><br>
  <form name="einst" action="intern.php" method="post">
  <h3>II.A. Allgemeine Einstellungen:</h3>
  <table>
    <tr><td>1) Meine ICQ-Nummer soll im Bereich "Members" angezeigt werden:</td><td><input type="checkbox" name="f_option_icqshow" <? if ($daten[option_icqshow] == 1) {echo "checked";} if ($daten[icq] == "") echo "disabled"; ?> value="1"></td></tr>
    <tr><td>2a) Ich m&ouml;chte bei neuen Foren-Beitr&auml;gen oder News-Meldungen
    <table><tr><td>per ICQ</td><td><input type="checkbox" name="f_option_icqsend" <? if ($daten[option_icqsend] == 1) {echo "checked";} if ($daten[icq] == "") echo "disabled"; ?> value="1" onClick="ch(1)"></td></tr>
    <tr><td>per eMail</td><td><input type="checkbox" name="f_option_mailsend" <? if ($daten[option_mailsend] == 1) {echo "checked";} ?> value="1" onClick="ch(2)"></td></tr></table>
    davon unterrichtet werden.</td><td>&nbsp;</td></tr>
    <tr><td>2b) Es sei denn es handelt sich dabei um einen Beitrag von mir selber:</td><td><input type="checkbox" name="f_option_notself" <? if ($daten[option_notself] == 1) {echo "checked";} if ($daten[option_icqsend] == 0 && $daten[option_mailsend] == 0) echo "disabled"; ?> value="1"></td></tr>
    <tr><td>3a) Automatisches Einloggen soll mit diesem Nick erm&ouml;glicht werden:</td><td><input type="checkbox" name="f_option_autoli" <? if ($daten[option_autoli] == 1) {echo "checked";} ?> value="1"></td></tr>
    <tr><td>3b) <input type="submit" value="Jetzt Ausloggen" name="f_submit"></td><td>&nbsp;</td></tr>
  </table>
  <br>
  <input type="hidden" name="f_nick" value="<? echo "$f_nick"; ?>">
  <input type="hidden" name="f_pw" value="<? echo "$f_pw"; ?>">
  <input type="hidden" name="f_id" value="<? echo "$daten[id]"; ?>">
  <input type="hidden" name="f_action" value="F2">
  <input type="reset" value="Zur&uuml;cksetzen">
  <input type="submit" value="&Auml;nderungen &uuml;bernehmen" name="f_submit">
  </form>

  <br><br><br>
  <form action="intern.php" method="post">
  <h3>II.B. KUEL-Einstellungen:</h3>
  <table>
    <tr><td>Ich nehme am KUEL teil:</td><td><input type="checkbox" name="f_option_kuel" <? if ($daten[option_kuel] == 1) {echo "checked";} ?> value="1"></td></tr>
    <tr><td>Bild-URL:</td><td><? echo "<input name=\"f_format\" maxlength=\"90\" size=\"20\" value=\"$daten[format]\">"; ?></td></tr>
    <tr><td>Bild anschauen:</td><td><?  echo "<a href=\"javascript:open__window('$daten[id]')\">"; ?>show</a></td></tr>
  </table>
  <br>
  <input type="hidden" name="f_nick" value="<? echo "$f_nick"; ?>">
  <input type="hidden" name="f_pw" value="<? echo "$f_pw"; ?>">
  <input type="hidden" name="f_id" value="<? echo "$daten[id]"; ?>">
  <input type="hidden" name="f_action" value="F2a">
  <input type="reset" value="Zur&uuml;cksetzen">
  <input type="submit" value="&Auml;nderungen &uuml;bernehmen">
  </form>
<?
}
else
{
  echo "Da du noch Probemember bist hast du nur beschr&auml;nkte Konfigurationsm&ouml;glichkeiten im internen Bereich.<br><br>";
  echo "Wenn du wirklich Onkel werden willst, dann bitte ich dich von den <a href=\"richtlinien.txt\" target=\"_blank\">Richtlinien</a> des Clans Kenntnis zu nehmen. ";
  echo "Nur wer nach den dort genannten Prinzipien handelt, kann Stammtisch-Mitglied werden!";
}
?>
  <br><br><br>
  <form action="intern.php" method="post">
  <h3>III. Passwort &auml;ndern:</h3>
  <table>
    <tr><td>Neues Passwort:</td><td><? echo "<input name=\"f_passw1\" maxlength=\"30\" size=\"20\">"; ?></td></tr>
    <tr><td>Wiederholung:</td><td><? echo "<input name=\"f_passw2\" maxlength=\"30\" size=\"20\">"; ?></td></tr>
  </table>
  <br>
  <input type="hidden" name="f_nick" value="<? echo "$f_nick"; ?>">
  <input type="hidden" name="f_pw" value="<? echo "$f_pw"; ?>">
  <input type="hidden" name="f_id" value="<? echo "$daten[id]"; ?>">
  <input type="hidden" name="f_action" value="F3">
  <input type="reset" value="Zur&uuml;cksetzen">
  <input type="submit" value="&Auml;nderungen &uuml;bernehmen">
  </form>


  <br><br><br>
  <h3>IV. Eigene Forenbeitr&auml;ge editieren (jeweils die letzten 10):</h3>
  <h5>Normales Forum</h5>
  <table>
  <?
    $abfrage_id = $mysqli->query("SELECT id,name,topic,datum,beitrag,email,intern FROM stammtisch WHERE name = '$daten[prefix].$daten[nick]' ORDER BY datum DESC LIMIT 10");
    while($daten2 = mysql_fetch_array($abfrage_id))
    {
      echo "<form action=\"intern.php\" method=\"post\"><tr><td width=\"50%\">";
      if ($daten2['intern'] == 1)
        echo "<img src=\"bilder/schluessel.gif\" width=\"15\" height=\"7\">";
      else
        echo "<img src=\"bilder/trans.gif\" width=\"15\" height=\"7\">";
      echo "&nbsp;$daten2[topic]</td>";

      echo "<input type=\"hidden\" name=\"f_nick\" value=\"$f_nick\">";
      echo "<input type=\"hidden\" name=\"f_pw\" value=\"$f_pw\">";
      echo "<input type=\"hidden\" name=\"f_id\" value=\"$daten[id]\">";
      echo "<input type=\"hidden\" name=\"f_action\" value=\"F4\">";
      echo "<input type=\"hidden\" name=\"f_id_beitrag\" value=\"$daten2[id]\">";
      echo "<td><input type=\"submit\" value=\"Edit\"></td></tr></form>";
    }
  ?>
  </table>
  <h5>KUEL-Forum</h5>
  <table>
  <?
    $abfrage_id = $mysqli->query("SELECT id,name,topic,datum,beitrag,email,intern FROM stammtisch2 WHERE name = '$daten[prefix].$daten[nick]' ORDER BY datum DESC LIMIT 10");
    while($daten2 = mysql_fetch_array($abfrage_id))
    {
      echo "<form action=\"intern.php\" method=\"post\"><tr><td width=\"50%\">";
      if ($daten2['intern'] == 1)
        echo "<img src=\"bilder/schluessel.gif\" width=\"15\" height=\"7\">";
      else
        echo "<img src=\"bilder/trans.gif\" width=\"15\" height=\"7\">";
      echo "&nbsp;$daten2[topic]</td>";

      echo "<input type=\"hidden\" name=\"f_nick\" value=\"$f_nick\">";
      echo "<input type=\"hidden\" name=\"f_pw\" value=\"$f_pw\">";
      echo "<input type=\"hidden\" name=\"f_id\" value=\"$daten[id]\">";
      echo "<input type=\"hidden\" name=\"f_action\" value=\"F4_KUEL\">";
      echo "<input type=\"hidden\" name=\"f_id_beitrag\" value=\"$daten2[id]\">";
      echo "<td><input type=\"submit\" value=\"Edit\"></td></tr></form>";
    }
  ?>
  </table>

  <br><br>
  <h3>V. Statistik</h3>
  <?

  $counterdatei = fopen("counter.txt","r+");
  $counterstand = fgets($counterdatei,10);
  fclose($counterdatei);
  echo "Besucher bisher: $counterstand<br><br>";


  $abfrage_id = $mysqli->query("SELECT id,datum,pagename,anzahl FROM stpageviews");
  $i = 0;
  while($datenT = mysql_fetch_array($abfrage_id))
  {
    if ($datenT[pagename] != "/internx.php")
    {
      $i += $datenT[anzahl];
    }
  }
  echo "Seitenaufrufe bisher: $i<br><br>";


  $gesamt = 0;
  $sommer = 0;
  $winter = 0;
  $brachland = 0;
  $wueste = 0;
  $no = 0;

  $active = 0;
  $closed = 0;
  $minimized = 0;
  $no2 = 0;

  $abfrage_id = $mysqli->query("SELECT id,host,browser,cookie_inhalt,ursprung,statusleiste,dauer_start,dauer_ende FROM stspy ORDER BY dauer_ende DESC LIMIT 5000");
  while($datenT = mysql_fetch_array($abfrage_id))
  {
    $gesamt++;
    if ($datenT['cookie_inhalt'] == "0")
      {$sommer++;}
    elseif ($datenT['cookie_inhalt'] == "1")
      {$winter++;}
    elseif ($datenT['cookie_inhalt'] == "2")
      {$brachland++;}
    elseif ($datenT['cookie_inhalt'] == "3")
      {$wueste++;}
    else
      {$no++;}

    if ($datenT['statusleiste'] == "active")
      {$active++;}
    elseif ($datenT['statusleiste'] == "closed")
      {$closed++;}
    elseif ($datenT['statusleiste'] == "minimized")
      {$minimized++;}
    elseif ($datenT['statusleiste'] == "")
      {$no2++;}
  }

  echo "Verwendungsh&auml;ufigkeiten der Landschaftstypen:<br><br>";

  echo "<img src=\"live_chart.php\" align=\"left\" hspace=\"30\" width=\"380\" height=\"200\" alt=\"\">";

  echo "<table border=\"5\" cellspacing=\"0\">";

  $erg = $sommer/$gesamt*100;
  $erg = round($erg,2);
  echo "<tr><td>Sommer:</td><td align=\"right\">$erg %</td></tr>";

  $erg = $no/$gesamt*100;
  $erg = round($erg,2);
  echo "<tr><td>Sommer (Cookies aus):</td><td align=\"right\">$erg %</td></tr>";

  $erg = $winter/$gesamt*100;
  $erg = round($erg,2);
  echo "<tr><td>Winter:</td><td align=\"right\">$erg %</td></tr>";

  $erg = $brachland/$gesamt*100;
  $erg = round($erg,2);
  echo "<tr><td>Brachland:</td><td align=\"right\">$erg %</td></tr>";

  $erg = $wueste/$gesamt*100;
  $erg = round($erg,2);
  echo "<tr><td>W&uuml;ste:</td><td align=\"right\">$erg %</td></tr>";

  echo "</table>";

  echo "<br clear=\"all\"><br><br>Userverhalten in Bezug auf die Statusleiste:<br><br>";

  echo "<img src=\"live_chart2.php\" align=\"left\" hspace=\"30\" width=\"380\" height=\"200\" alt=\"\">";

  echo "<table border=\"5\" cellspacing=\"0\">";

  $erg = ($active+$no2)/$gesamt*100;
  $erg = round($erg,2);
  echo "<tr><td>Aktiviert: </td><td align=\"right\">$erg %</td></tr>";

  $erg = $closed/$gesamt*100;
  $erg = round($erg,2);
  echo "<tr><td>Geschlossen: </td><td align=\"right\">$erg %</td></tr>";

  $erg = $minimized/$gesamt*100;
  $erg = round($erg,2);
  echo "<tr><td>Minimiert: </td><td align=\"right\">$erg %</td></tr>";

  echo "</table>";
  echo "<br clear=\"all\"><br>";


  if ($daten['typ'] >= 2)
  {
    echo "<br>\n<h1>Admin-Funktionen</h1>";
    echo "Admin-Onkels sind zurzeit:<br>";
    $abfrage_id = $mysqli->query("SELECT id,prefix,nick,typ FROM stmembers WHERE typ >= 2");
    while($datenT = mysql_fetch_array($abfrage_id))
    {
      echo "- $datenT[prefix].$datenT[nick]<br>";
    }
    
    echo "<br><br><h3>VI. Alle Forenbeitr&auml;ge editieren (jeweils die letzten 10):</h3>";

    echo "<h5>Normales Forum</h5>";
    $abfrage_id = $mysqli->query("SELECT id,name,topic,datum,beitrag,email,intern FROM stammtisch ORDER BY datum DESC LIMIT 10");
    echo "<table>";
      while($datenT = mysql_fetch_array($abfrage_id))
      {
        echo "<form action=\"intern.php\" method=\"post\"><tr><td width=\"50%\">";
        if ($datenT['intern'] == 1)
          echo "<img src=\"bilder/schluessel.gif\" width=\"15\" height=\"7\">";
        else
          echo "<img src=\"bilder/trans.gif\" width=\"15\" height=\"7\">";
        echo "&nbsp;$datenT[topic]</td><td>von $datenT[name]</td>";

        echo "<input type=\"hidden\" name=\"f_nick\" value=\"$f_nick\">";
        echo "<input type=\"hidden\" name=\"f_pw\" value=\"$f_pw\">";
        echo "<input type=\"hidden\" name=\"f_id\" value=\"$daten[id]\">";
        echo "<input type=\"hidden\" name=\"f_action\" value=\"F4\">";
        echo "<input type=\"hidden\" name=\"f_id_beitrag\" value=\"$datenT[id]\">";
        echo "<td><input type=\"submit\" value=\"Edit\"></td></tr></form>";
      }
    echo "</table>";
    
    echo "<h5>KUEL-Forum</h5>";
    $abfrage_id = $mysqli->query("SELECT id,name,topic,datum,beitrag,email,intern FROM stammtisch2 ORDER BY datum DESC LIMIT 10");
    echo "<table>";
      while($datenT = mysql_fetch_array($abfrage_id))
      {
        echo "<form action=\"intern.php\" method=\"post\"><tr><td width=\"50%\">";
        if ($datenT['intern'] == 1)
          echo "<img src=\"bilder/schluessel.gif\" width=\"15\" height=\"7\">";
        else
          echo "<img src=\"bilder/trans.gif\" width=\"15\" height=\"7\">";
        echo "&nbsp;$datenT[topic]</td><td>von $datenT[name]</td>";

        echo "<input type=\"hidden\" name=\"f_nick\" value=\"$f_nick\">";
        echo "<input type=\"hidden\" name=\"f_pw\" value=\"$f_pw\">";
        echo "<input type=\"hidden\" name=\"f_id\" value=\"$daten[id]\">";
        echo "<input type=\"hidden\" name=\"f_action\" value=\"F4_KUEL\">";
        echo "<input type=\"hidden\" name=\"f_id_beitrag\" value=\"$datenT[id]\">";
        echo "<td><input type=\"submit\" value=\"Edit\"></td></tr></form>";
      }
    echo "</table>";



    echo "<br><br><h3>VII. Alle eingelieferten News editieren (die letzten 10):</h3>";

    $abfrage_id = $mysqli->query("SELECT id,name,topic,datum,beitrag FROM stnews ORDER BY datum DESC LIMIT 10");

    echo "<table>";
      while($datenT = mysql_fetch_array($abfrage_id))
      {
        echo "<form action=\"intern.php\" method=\"post\"><tr><td width=\"50%\">";
        echo "$datenT[topic]</td><td>von $datenT[name]</td>";

        echo "<input type=\"hidden\" name=\"f_nick\" value=\"$f_nick\">";
        echo "<input type=\"hidden\" name=\"f_pw\" value=\"$f_pw\">";
        echo "<input type=\"hidden\" name=\"f_id\" value=\"$daten[id]\">";
        echo "<input type=\"hidden\" name=\"f_action\" value=\"F4a\">";
        echo "<input type=\"hidden\" name=\"f_id_beitrag\" value=\"$datenT[id]\">";
        echo "<td><input type=\"submit\" value=\"Edit\"></td></tr></form>";
      }
    echo "</table>";
  ?>


  <?
  $abfrage_id = $mysqli->query("SELECT id,prefix,nick,name,status,since,location,pw,email,wl,format,icq,typ,option_icqshow,option_icqsend,option_mailsend,option_notself,visits,option_kuel,option_autoli FROM stmembers WHERE typ >= 0");
  ?>

  <br><br>
  <h3>VIII. Stammtischmitglieder verwalten:</h3>
  <table cellpadding="5">
    <tr align="left"><th>Name</th><th>Pr&auml;fix</th><th>Nick</th><th>Status</th><th>Rechte</th><th>&nbsp;</th><th>&nbsp;</th></tr>
    <?
    while($datenT = mysql_fetch_array($abfrage_id))
    {
      echo "<form action=\"intern.php\" method=\"post\"><tr><td>$datenT[name]</td>";
      echo "<td>$datenT[prefix]</td>";
      echo "<td><input name=\"f_nick_new\" maxlength=\"30\" size=\"6\" value=\"$datenT[nick]\"></td>";

      if ($datenT['status'] != "")
      {
        echo "<td><select name=\"f_status\">";
        if ($datenT['status'] == "Ober-Onkel")
          echo "<option selected>Ober-Onkel</option>";
        else
          echo "<option>Ober-Onkel</option>";

        if ($datenT['status'] == "Web-Onkel")
          echo "<option selected>Web-Onkel</option>";
        else
          echo "<option>Web-Onkel</option>";

        if ($datenT['status'] == "Präsidenten-O.")
          echo "<option selected>Präsidenten-O.</option>";
        else
          echo "<option>Präsidenten-O.</option>";

        if ($datenT['status'] == "Prüf-Onkel")
          echo "<option selected>Prüf-Onkel</option>";
        else
          echo "<option>Prüf-Onkel</option>";

        if ($datenT['status'] == "Presse-Onkel")
          echo "<option selected>Presse-Onkel</option>";
        else
          echo "<option>Presse-Onkel</option>";

        if ($datenT['status'] == "Normalo-Onkel")
          echo "<option selected>Normalo-Onkel</option>";
        else
          echo "<option>Normalo-Onkel</option>";
        echo "</select></td>";
      }
      else
      {
        echo "<td>&nbsp;</td>";
      }


      echo "<td><select name=\"f_typ\">";
      if ($datenT['typ'] == "3")
        echo "<option selected value=\"3\">Admin (+Kuel)</option>";
      else
        echo "<option value=\"3\">Admin (+Kuel)</option>";

      if ($datenT['typ'] == "2")
        echo "<option selected value=\"2\">Admin</option>";
      else
        echo "<option value=\"2\">Admin</option>";

      if ($datenT['typ'] == "1")
        echo "<option selected value=\"1\">Normal</option>";
      else
        echo "<option value=\"1\">Normal</option>";

      if ($datenT['typ'] == "0")
        echo "<option selected value=\"0\">Probe</option>";
      else
        echo "<option value=\"0\">Probe</option>";

      echo "<option value=\"-1\">Entlassen!</option>";
      echo "</select></td>";


      echo "<input type=\"hidden\" name=\"f_nick\" value=\"$f_nick\">";
      echo "<input type=\"hidden\" name=\"f_pw\" value=\"$f_pw\">";
      echo "<input type=\"hidden\" name=\"f_id\" value=\"$daten[id]\">";
      echo "<input type=\"hidden\" name=\"f_id_user\" value=\"$datenT[id]\">";
      echo "<input type=\"hidden\" name=\"f_typ_vorher\" value=\"$datenT[typ]\">";
      echo "<input type=\"hidden\" name=\"f_prefix_vorher\" value=\"$datenT[prefix]\">";
      echo "<input type=\"hidden\" name=\"f_action\" value=\"F6\">";
      echo "<td><input type=\"reset\" value=\"Reset\"></td>";
      if (($datenT['typ'] > "1") && ($daten['id'] != $datenT['id']))
        { echo "<td align=\"center\"><img src=\"bilder/schild.gif\" width=\"29\" height=\"26\"></td>";}
      else
        { echo "<td><input type=\"submit\" value=\"&Auml;ndern\"></td>"; }
      echo "</tr></form>";

    }
  ?>

  </table>
  <br>Ein Admin ist stets gegen &Auml;nderungen gesch&uuml;tzt.



  <br><br><br>
  <h3>IX. Probemember hinzuf&uuml;gen:</h3>
  
  <form action="intern.php" method="post">
  <input type="hidden" name="f_nick" value="<? echo "$f_nick"; ?>">
  <input type="hidden" name="f_pw" value="<? echo "$f_pw"; ?>">
  <input type="hidden" name="f_id" value="<? echo "$daten[id]"; ?>">
  <input type="hidden" name="f_action" value="F7">

  <table>
  <tr><td>Nick</td><td>Real Name</td><td>Ort (Bundesland)</td><td>eMail</td></tr>
  <tr>
  <td nowrap>Kumpel.<input name="f_new_nick" maxlength="30" size="12"></td>
  <td><input name="f_new_name" maxlength="30" size="20"></td>
  <td><input name="f_new_ort" maxlength="30" size="20"></td>
  <td><input name="f_new_email" maxlength="30" size="20"></td>
  <td>&nbsp;<input type="submit" value="Hinzuf&uuml;gen"></td>
  </tr>
  </table>
  <br>
  Es ist zwar m&ouml;glich Eintr&auml;ge freizulassen, jedoch sollte dies unbedingt vermieden werden,
  da sonst der Arbeitsaufwand des Web-Onkels unn&ouml;tig erh&ouml;ht wird und der dieser Webseite
  zu Grunde liegende Automatismus ein Defizit erleidet.
  </form>

  <?
  $abfrage_id = $mysqli->query("SELECT id,prefix,nick,name,status,since,location,pw,email,wl,format,icq,typ,option_icqshow,option_icqsend,option_mailsend,option_notself,visits,option_kuel,option_autoli,points FROM stmembers WHERE typ >= 0");
  ?>
  <br><br><br>
  <h3>X. Stammtischmitglieder beobachten:</h3>
  <table border="2" cellspacing="0">
  <tr><th>Member</th><th>eMail</th><th>Weiterleitung</th><th><font size="-2">ID</font></th><th><font size="-2">icqshow</font></th><th><font size="-2">icqsend</font></th><th><font size="-2">mailsend</font></th><th><font size="-2">notself</font></th><th><font size="-2">kuel</font></th><th><font size="-2">Login</font></th><th><font size="-2">Points</font><th><font size="-2">visits intern</font></th></tr>
  <?
  while($datenX = mysql_fetch_array($abfrage_id))
  {
    echo "<tr>";
    echo "<td>$datenX[prefix].$datenX[nick]</td>";
    echo "<td>$datenX[email]</td>";
    echo "<td><font size=\"-2\">$datenX[wl]</font></td>";
    echo "<td align=\"right\">$datenX[id]</td>";
    echo "<td align=\"right\">$datenX[option_icqshow]</td>";
    echo "<td align=\"right\">$datenX[option_icqsend]</td>";
    echo "<td align=\"right\">$datenX[option_mailsend]</td>";
    echo "<td align=\"right\">$datenX[option_notself]</td>";
    echo "<td align=\"right\">$datenX[option_kuel]</td>";
    echo "<td align=\"right\">$datenX[option_autoli]</td>";
    echo "<td align=\"right\">$datenX[points]</td>";
    echo "<td align=\"right\">$datenX[visits]</td>";
    echo "</tr>";
  }
  ?>
  </table>

  <?
  if ($daten['typ'] >= 3)
  {
  ?>
    <br><br>
    <h3>XI. KUEL verwalten:</h3>
    <h4>Schritt 1 - Daten:</h4>
    <form action="intern.php" method="post">
    <input type="hidden" name="f_nick" value="<?=$f_nick?>">
    <input type="hidden" name="f_pw" value="<?=$f_pw?>">
    <input type="hidden" name="f_id" value="<?=$daten[id]?>">
    <input type="hidden" name="f_action" value="F12">

    <?
    // Ermittle Dax -- Anfang
    $dax = '';
    $fp = fsockopen("kurse.exchange.de", 80, &$errno, &$errstr, 30);
    if (!$fp)
    {
      echo "Fehler: $errstr ($errno)";
    }
    else
    {
        fputs($fp, "GET /exchange/de/factsheet_dax_01.html HTTP/1.0\r\n\r\n");
        while (!feof($fp)) {
            $dax .= fgets($fp,128);
        }
        fclose($fp);
    }

    $sub = "/_common/images/arrow_gut.gif";
    $dax = stristr($dax,$sub);
    $sub = "</table>";
    $dax = stristr($dax,$sub);
    $sub = "size=1>";
    $dax = stristr($dax,$sub);
    $sub = ">";
    $dax = stristr($dax,$sub);

    $dax = substr($dax,1,strpos($dax,'&')-1);
    // Ermittle Dax -- Ende

    // Ermittle Euro -- Anfang
    $euro = '';
    $fp = fsockopen("www.dmeuro.com", 80, &$errno, &$errstr, 30);
    if (!$fp)
    {
      echo "Fehler: $errstr ($errno)";
    }
    else
    {
        fputs($fp, "GET /dmwwwangebot/fn/dmo/SH/0/sfn/builddm/brt/2/index.html HTTP/1.0\r\n\r\n");
        while (!feof($fp)) {
            $euro .= fgets($fp,128);
        }
        fclose($fp);
    }

    $sub = "1&nbsp;Euro&nbsp;=&nbsp;";
    $euro = stristr($euro,$sub);
    $euro = substr($euro,24,strpos($euro,'$')-30);
    // Ermittle Euro -- Ende
    $woche = date("W. \K\\r\i\e\g\s\w\o\c\h\e \d\e\s \J\a\h\\r\s Y");
    ?>


    <table>
    <tr><td>Woche:</td><td><input name="woche" value="<?=$woche?>" maxlength="30" size="30"></td></tr>
    <tr><td>Dax:</td><td><input name="dax" value="<?=$dax?>" maxlength="10" size="6" onFocus="this.select()"> (ausgelesen von <a href="http://www.dax.de" target="_blank">www.dax.de</a>)</td></tr>
    <tr><td>Euro:</td><td><input name="euro" value="<?=$euro?>" maxlength="10" size="6" onFocus="this.select()"> (ausgelesen von <a href="http://www.dmeuro.com" target="_blank">www.dmeuro.com</a>)</td></tr>
    </table><br>


    <?
    // Ermittle Lottozahlen -- Anfang
    $lotto = '';
    $fp = fsockopen("www.lotto.de", 80, &$errno, &$errstr, 10);
    if (!$fp)
    {
      echo "Fehler: $errstr ($errno)";
      $mysqli = new mysqli($sql_server,$sql_user,$sql_pass,$sql_db);
    }
    else
    {
        fputs($fp, "GET /content/d/homepage/ HTTP/1.0\r\n\r\n");
        while (!feof($fp)) {
            $lotto .= fgets($fp,128);
        }
        fclose($fp);
    }

    $sub = "Ziehung Samstag";
    $lotto = stristr($lotto,$sub);
    $lottoziehungsdatum = substr($lotto,0,strpos($lotto,':'));

    $lotto = stristr($lotto,'<b>');
    $lottozahlen_str = substr($lotto,3,strpos($lotto,'&middot;')-3);
    $lottozahlen_str = preg_replace("/(\015\012)|(\015)|(\012)|(\040)/","",$lottozahlen_str);
    $lottozahlen = explode(",",$lottozahlen_str);
    // Ermittle Lottozahlen -- Ende
    ?>


    Lottozahlen - <?=$lottoziehungsdatum?>: (ausgelesen von <a href="http://www.lotto.de" target="_blank">www.lotto.de</a>)<br>
    <input name="l1" value="<?=$lottozahlen[0]?>" maxlength="10" size="6" onFocus="this.select()">
    <input name="l2" value="<?=$lottozahlen[1]?>" maxlength="10" size="6" onFocus="this.select()">
    <input name="l3" value="<?=$lottozahlen[2]?>" maxlength="10" size="6" onFocus="this.select()">
    <input name="l4" value="<?=$lottozahlen[3]?>" maxlength="10" size="6" onFocus="this.select()">
    <input name="l5" value="<?=$lottozahlen[4]?>" maxlength="10" size="6" onFocus="this.select()">
    <input name="l6" value="<?=$lottozahlen[5]?>" maxlength="10" size="6" onFocus="this.select()"><br><br>

    <table>
    <tr><td>Bürgerkriegstext:</td><td><input name="krieg" value="z.B.: In Budapest bricht Bürgerkrieg aus" maxlength="100" size="30" onFocus="this.select()"><br></td></tr>
    <tr><td>Wirtschaftstext:</td><td><input name="wirtschaft" value="z.B.: Es tritt kein Wirtschaftlicher Kollaps auf." maxlength="100" size="30" onFocus="this.select()"><br></td></tr>
    <tr><td colspan="2">Allgemeiner Kommentar:</td></tr>
    <tr><td colspan="2"><textarea name="text" rows="10" cols="50" wrap="physical"></textarea></td></tr>
    <tr><td colspan="2"><input type="submit" value="Daten updaten - Schritt 1"></td></tr>
    </table>

    </form>


    <h4>Schritt 2 - Punkte:</h4>
    <table cellpadding="2" border="2" cellspacing="0">
    <tr align="left"><th>Platz</th><th>Nick</th><th>Bild</th><th>Points</th><th>+Points</th><th>&nbsp;</th></tr>
    <?
    $i = 0;
    $abfrage_id = $mysqli->query("SELECT id,prefix,nick,name,status,since,location,pw,email,wl,format,icq,typ,option_icqshow,option_icqsend,option_mailsend,option_notself,visits,option_kuel,option_autoli,points FROM stmembers WHERE typ >= 1 && option_kuel = 1 ORDER BY points DESC,Nick ASC");

    echo "<form action=\"intern.php\" method=\"post\">";
    echo "<input type=\"hidden\" name=\"f_nick\" value=\"$f_nick\">";
    echo "<input type=\"hidden\" name=\"f_pw\" value=\"$f_pw\">";
    echo "<input type=\"hidden\" name=\"f_id\" value=\"$daten[id]\">";
    echo "<input type=\"hidden\" name=\"f_action\" value=\"F11\">";
    while($datenT = mysql_fetch_array($abfrage_id))
    {
      echo "<tr>";
      echo "<td>".++$i."</td>";
      echo "<td>$datenT[prefix].$datenT[nick]</td>";
      echo "<td align=\"right\"><a href=\"javascript:open__window('$datenT[id]')\">show</a></td>";
      echo "<td align=\"right\">$datenT[points]</td>";
      echo "<input type=\"hidden\" name=\"f_id_user[]\" value=\"$datenT[id]\">";
      echo "<input type=\"hidden\" name=\"f_oldPoints[]\" value=\"$datenT[points]\">";
      echo "<td align=\"right\">+&nbsp;<input name=\"f_newPoints[]\" value=\"0\" maxlength=\"6\" size=\"3\" onFocus=\"this.select()\"></td>";
      if (mysql_num_rows($abfrage_id) == $i)
        echo "<td><input type=\"submit\" value=\"Punkte addieren - Schritt 2\"></td>";
      else
        echo "<td>&nbsp;</td>";
      echo "</tr>";
    }
    echo "</form>";
    ?>
    </table>


    <h4>Schritt 3 - Karte:</h4>
    <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <form action="intern.php" method="post">
    <input type="hidden" name="f_nick" value="<?=$f_nick?>">
    <input type="hidden" name="f_pw" value="<?=$f_pw?>">
    <input type="hidden" name="f_id" value="<?=$daten[id]?>">
    <input type="hidden" name="f_action" value="F13">
    Lokaler Pfad zur Kuel-Map: <input name="thefile" type="file">&nbsp;
    <input type="submit" value="Map Senden - Schritt 3">
    </form>



  <?
  }
  ?>


  <br><br><br><br>
  <a href="internx.php?ident=auto&sortby=dauer_ende&direction=DESC&mich=no&detail=no&rows=50" target="_blank">Xtended Intern</a>
  <?

  }
  else {}
  ?>

  </div>
<? else: ?>

  <? if (!isset($f_pw)): ?>

    <?
    $abfrage_id = $mysqli->query("SELECT prefix,nick FROM stmembers WHERE typ >= 0 ORDER BY prefix DESC,nick");
    ?>

    <form name="pw_abfrage" action="intern.php" method="post">
    <table border="0" cellspacing="4">
    <tr><td>Member:</td><td>

    <select name="f_nick">
    <?
    while($daten = mysql_fetch_array($abfrage_id))
    {
      echo "<option value=\"$daten[nick]\">$daten[prefix].$daten[nick]</option>";
    }
    ?>
    </select>

    </td></tr>
    <tr><td>Passwort:</td><td><input type="password" name="f_pw" size="20" maxlength="20"></td></tr>
    <tr><td>&nbsp;</td><td><input type="submit" value="Einloggen"></td></tr>
    </table>
    </form>

        <? /* Login Anfang 1 */

        $ip = getenv("REMOTE_ADDR");
        $time_sub = time();
        $time_sub -= 600;

        $loeschen_id = $mysqli->query("DELETE FROM stonline WHERE lastrequest < '$time_sub'");

        $abfrage_id = $mysqli->query("SELECT id,prefix,nick,pw,lastrequest FROM stonline WHERE ip = '$ip' AND typ >= 0");

        if ($daten_pw_ = mysql_fetch_array($abfrage_id))
        {
          $timex = time();
          $senden_id = $mysqli->query("UPDATE stonline SET lastrequest = '$timex' WHERE id = '$daten_pw_[id]'");

          echo "<br>Automatisches Einloggen erfolgt<br><br><br>";
          echo "\n<script>\n";
          echo "  document.pw_abfrage.f_nick.value = \"$daten_pw_[nick]\";\n";
          echo "  document.pw_abfrage.f_pw.value = \"$daten_pw_[pw]\";\n";
          echo "  document.pw_abfrage.submit();\n";
          echo "</script>\n";
        }
        else
        {
          echo "<br><br>";
          echo "<font size=\"-2\"><a href=\"pw.php\">Passwort vergessen</a></font><br><br><br>";
        }

        /* Login Ende 1 */ ?>


    <? else: ?>
    Na, das war wohl nix.<br><br><a href="intern.php">Zur&uuml;ck</a>

  <? endif ?>
<? endif ?>


<? $mysqli->close(); ?>


</div>
</font>
</body>
</html>
