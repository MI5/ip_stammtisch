uses crt;
var I,J,x:shortint;
    pw:string;
begin
  ClrScr;
  Randomize;

  for J := 1 to 5 do
  begin
    pw := '12345678';

    for I := 1 to 8 do
    begin
      x := random(3);

      case x of
        0: pw[I] := chr(random(10)+48);
        1: pw[I] := chr(random(26)+65);
        2: pw[I] := chr(random(26)+97);
      end;
    end;
    writeln(pw);
  end;
end.