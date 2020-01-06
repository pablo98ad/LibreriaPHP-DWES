//número de registros
var NR;
//tamaño de página
var TP=8;
//página actual
var PA=1;
//número de páginas
var NP;
//registro inicial y final
var RI=0;
var RF=TP;
//trozo
var TROZO;

//*********************************************************************

function llegadaDatos(datos)
{	
	quitarDisabledEnBotones();
	//alert(datos);
	NR=parseInt(datos);
	NP=parseInt(NR/TP);
	
	TROZO=NR%TP;	
	if (TROZO>0){ NP++};
	
	$("#totales").text("Ultima ("+NP+")");
	$("#actual").text("1");
	//$("#1li").addClass('active');
	repinto_botones();
	
	ajaxjquery(RI,RF);
}
//***********************************************************************
function primera()
{
	if (PA>1)
		 {
			  RI=0;
			  RF=TP;
			  $("#actual").text("1");
			  
			  PA=1;
			  quitarActiveEnBotones();
			  $("#1li").addClass('active');
			  ajaxjquery(RI,RF);
		 }	  
}
//***********************************************************************
function ultima()
{
	 if (PA<NP)
		 {
			quitarActiveEnBotones();
			$("#"+NP+"li").addClass('active');
			if (TROZO==0)
			  {
				RI=TP*(NP-1);
			    RF=RI+TP;
			  }
			  else
			  {
			    RI=(NR-TROZO);
				RF=TROZO;
			  }
			
			  PA=NP;
			  
			 ajaxjquery(RI,RF);
		}
}
//***********************************************************************
function siguiente()
{
	if (PA<NP)
		 {
  		    RI=TP*(PA);
			RF=TP;
			PA++;
			quitarActiveEnBotones();
			$("#"+PA+"li").addClass('active');
            ajaxjquery(RI,RF);
		 }
}
//***********************************************************************
function anterior()
{
	if (PA>1)
		 {
			RI=(RI-TP);
			RF=TP;
			PA--;			
			quitarActiveEnBotones();
			$("#"+PA+"li").addClass('active');
            ajaxjquery(RI,RF);
		}
}
//***********************************************************************
function cualquiera(numero)
{	
	if(numero<=NP){
		//si estoy en la pagina 1 y pulso en 1, no hara nada o pag final y pulso en pagina final
		if(PA!=parseInt($("#"+numero).text())){
			PA=parseInt($("#"+numero).text());
			RI=((PA-1) * TP);
			RF=TP;
			quitarActiveEnBotones();
			$("#"+numero+"li").addClass('active');
			ajaxjquery(RI,RF);
		}
	}
}
//***********************************************************************
function quitarDisabledEnBotones(){
	for (var i=0; i<=5; i++){
		$("#"+i+"li").removeClass('disabled');
	}
	$("#primera").removeClass('disabled');
	$("#anterior").removeClass('disabled');
	$("#ultima").removeClass("disabled");
	$("#siguiente").removeClass("disabled");
	
}
function quitarActiveEnBotones(){
	for (var i=0; i<=5; i++){
		$("#"+i+"li").removeClass('active');
	}
	$("#primera").removeClass('active');
	$("#anterior").removeClass('active');
	$("#ultima").removeClass("active");
	$("#siguiente").removeClass("active");
	
}

function ajaxjquery(REGI,REGF)
{
	$("#estrella").css("visibility","visible");
	//$("#articulos").text('No hay articulos');
	//alert(busqueda);
	$("#articulos").load("pintotabla.php",{inicio:REGI, fin: REGF, search: busqueda}, function()
   {
			// oculto estrella
			$("#estrella").css("visibility","hidden");
			// indico la página donde estoy	
			$("#actual").text(PA);	
			// repinto los botones
			repinto_botones();
						
   });
}
//***********************************************************************
function repinto_botones()
{
	var i=0;
	// configuro botones de primera y última página
	

	if (PA==NP)
	{	//estoy en la ultima pagina
		$("#primera").removeClass('disabled');
		$("#anterior").removeClass('disabled');
		$("#ultima").addClass("disabled");
		$("#siguiente").addClass("disabled");
	}	
	else if (PA==1)
	{ //estoy en la primera
		$("#primera").addClass("disabled");
		$("#anterior").addClass("disabled");
		$("#ultima").removeClass('disabled');
		$("#siguiente").removeClass('disabled');
	}else{
		//en otro caso
		$("#primera").removeClass('disabled');
		$("#anterior").removeClass('disabled');
		$("#ultima").removeClass('disabled');
		$("#siguiente").removeClass('disabled');
	}
	//*********************************
	//repinto los números
	if (PA<=3)
	{	
		for (i=(NP+1);i<=5;i++){//para que cuando no haya 5 paginas deshabilite las que sobran ejemplo hay 3 paginas, por lo que la 4 y 5 se deshabilitan
			$("#"+i+"li").addClass("disabled");
		}
		
		for (i=1;i<=5;i++)
		{
			$("#"+i).text(i);
		}
		// paso el foco a la página donde estoy
		//$("#"+PA).focus();
	}
	else if (PA>=(NP-2))
	{
		for (i=1;i<=5;i++)
		{
			$("#"+i).text((NP-5)+i);

		}
		// paso el foco a la página donde estoy
		//$("#"+(5-(NP-PA))).focus();
	}
	else
	{
		for (i=1;i<=5;i++)
		{
			$("#"+i).text((PA-3)+i);
		}
		// paso el foco a la página donde estoy
		$("#"+3).focus();
	}
	
	
	
}