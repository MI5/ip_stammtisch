{$M $4000,0,0 }
uses dosext;

var datei:string;
    f:file;
begin
  ChDir('C:\Matthias');
  datei := ParamStr(1);
  if datei <> '' then
  begin
    BuildMakroFile('upload.ftp','ftp2.kontent.de','der-stammtisch.net',
      '99ataRn3','turnier',datei);
    Shell('ftp -n -s:upload.ftp');
    Assign(f,'upload.ftp');
    Erase(f);
  end
  else
    Write('Keine Datei bergeben!');
end.