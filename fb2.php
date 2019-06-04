<html>
<head>
</head>

<div align="center">

<? if (isset($f1)): ?>

<?
  echo "Danke für deine Teilnahme! Dir wird gleich mitgeteilt werden, ob du als Stammtisch-mitglied in Frage kommst, oder nicht.";
  $inhalt = "1: $f1\n2: $f2\n3: $f3\n4: $f4\n5: $f5\n6: $f6\n7: $f7\n8: $f8\n9: $f9\n10: $f10\n11: $f11\n12: $f12\n13: $f13\n14: $f14\n15: $f15\n16: $f16\n17: $f17\n18: $f18\n";

  mail("ncc_1701@gmx.de", "Test-Auswertung", "$inhalt");
?>

<? else: ?>
Mich so aufzurufen ist nicht m&ouml;glich.
<? endif ?>

</div>
</font>
</body>
</html>