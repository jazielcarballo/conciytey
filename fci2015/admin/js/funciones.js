//-------------------------------------------------------------------------//
function ValidarEmail(sEmail)
	{
		var splitted = sEmail.match("^(.+)@(.+)$");
		if(splitted == null) return false;
		if(splitted[1] != null )
		{
		  var regexp_user=/^\"?[\w-_\.]*\"?$/;
		  if(splitted[1].match(regexp_user) == null) return false;
		}
		if(splitted[2] != null)
		{
		  var regexp_domain=/^[\w-\.]*\.[A-Za-z]{2,4}$/;
		  if(splitted[2].match(regexp_domain) == null) 
		  {
			var regexp_ip =/^\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\]$/;
			if(splitted[2].match(regexp_ip) == null) return false;
		  }
		  return true;
		}
	return false;
	}
	
function FuncionAjax()
{ 
	var xmlhttp=false; 
	try 
	{ 
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e)
	{ 
		try
		{ 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 
 
	return xmlhttp; 
}	
//-------------------------------------------------------------------------//	
function ValidarTexto()
	{
		if (window.event.keyCode==34 || window.event.keyCode==37 || window.event.keyCode==38 || window.event.keyCode==39 || window.event.keyCode==59 || window.event.keyCode==60 || window.event.keyCode==62)
		{
			event.returnValue = false;
		}
	}
//-------------------------------------------------------------------------//	
function ValidarNumero()
	{
		if(event.keyCode < 48  || event.keyCode > 57 )
		{
			event.returnValue = false;
		}
	}
	
function JSClock()
{
  var fecha=new Date();
  var diames=fecha.getDate();
  var diasemana=fecha.getDay();
  var mes=fecha.getMonth() +1 ;
  var ano=fecha.getFullYear();

  var textosemana = new Array (7); 
  textosemana[0]="Domingo";
  textosemana[1]="Lunes";
  textosemana[2]="Martes";
  textosemana[3]="Miércoles";
  textosemana[4]="Jueves";
  textosemana[5]="Viernes";
  textosemana[6]="Sábado";

  var textomes = new Array (12);
  textomes[1]="Enero";
  textomes[2]="Febrero";
  textomes[3]="Marzo";
  textomes[4]="Abril";
  textomes[5]="Mayo";
  textomes[6]="Junio";
  textomes[7]="Julio";
  textomes[8]="Agosto";
  textomes[9]="Septiembre";
  textomes[10]="Octubre";
  textomes[11]="Noviembre";
  textomes[12]="Diciembre";
  var time = new Date()
  var hour = time.getHours()
  var minute = time.getMinutes()
  var second = time.getSeconds()
  var temp = ((hour > 12) ? hour - 12 : hour)
  temp += ((minute < 10) ? ":0" : ":") + minute
  temp += ((second < 10) ? ":0" : ":") + second
  temp += (hour >= 12) ? " P.M." : " A.M."
  document.getElementById("reloj").innerHTML = textosemana[diasemana] + ", " + diames + " de " + textomes[mes] + " de " + ano +" "+ temp
  id = setTimeout("JSClock()",1000)
}
//-------------------------------------------------------------------------//	


	
