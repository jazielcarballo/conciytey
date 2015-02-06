/* Reloj */
//-------------------------------------------------------------------------//	
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

// ----------------------------------------------------------------------------------------

function DoNav(theUrl)
{
  document.location.href = theUrl;
}

function toggleCheckboxes(container,obj)
{
  $$(container +' input[type=checkbox]').each(function(el){ el.checked = obj.checked; });
}


/* Start Zebra Tables */
var ZebraTables = new Class({
	//initialization
	initialize: function(table_class){

		//add table shading
		$$('table.' + table_class + ' tr').each(function(el,i) {

			//do regular shading
			var _class = i % 2 ? 'even' : 'odd'; el.addClass(_class);

			//do mouseover
			el.addEvent('mouseenter',function() { if(!el.hasClass('highlight')) { el.addClass('mo').removeClass(_class); } });

			//do mouseout
			el.addEvent('mouseleave',function() { if(!el.hasClass('highlight')) { el.removeClass('mo').addClass(_class); } });

		});
	}
});
/*End Zebra tables*/