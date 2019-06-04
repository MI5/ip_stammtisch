var bg = "0";

function selectbg()
{
  if (document.cookie)
    bg = document.cookie;

  switch(bg)
  {
    case 0:
    case "0=":
    case "0": {document.write('<body background="bg_sommer.gif"><font color="#FFFFFF">'); }
    break;

    case 1:
    case "1=":
    case "1": {document.write('<body background="bg_winter.gif"><font color="#0000FF">'); }
    break;

    case 2:
    case "2=":
    case "2": {document.write('<body background="bg_brachland.gif"><font color="#FFFFFF">'); }
    break;

    case 3:
    case "3=":
    case "3": {document.write('<body background="bg_wueste.gif"><font color="#0000FF">'); }
    break;
  }
}
