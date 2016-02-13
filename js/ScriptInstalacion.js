/*

	Script de validacion e insercion de datos para la instalacion de la base de datos





	----------------Eventos----------------

*/

$(document).ready(function(){
	var current_fs, next_fs, previous_fs; //fieldsets o ventanas

	/*
		Evento de clickear en boton Siguiente
		Se encarga de validar para pasar al siguiente paso
	*/
	$(".next").click(function(event){

		//funcion de validacion
		var fv=formValidation(event);

		if(!fv){
			return false;
		}

		//cambios esteticos - mover a la siguiente ventana
		current_fs = $(this).parent();
		next_fs = $(this).parent().next();
		
		//mover la barra de progreso...
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

		//desaparecer la ventana anterior y mostrar la siguiente
		current_fs.hide();
		next_fs.show(); 

	});

	/*
		Evento de clickear en boton anterior
	*/
	$(".previous").click(function(){
		
		current_fs = $(this).parent();
		previous_fs = $(this).parent().prev();
		
		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
		
		current_fs.hide();
		previous_fs.show(); 
	});

	/*
		Evento de clickear en "verificar conexion"

	*/
	$("#checkdb").click(function(event){

		//primero valida los pasos de la ventana 1
		var fv = formValidation(event);

		if(fv){
			var host = document.getElementById('host').value;
			var port = document.getElementById('port').value;
			var dbuser = document.getElementById('dbuser').value;
			var dbpass = document.getElementById('dbpass').value;

			/*
				Envio de formulario por medio de ajax
				Muestra el estado de la conexion en pantalla
			*/

			$.ajax({
				type: 'POST',
				url: 'scripts/bd/mysql_connection.php',
				data:{
					'host':host,
					'port':port,
					'dbuser':dbuser,
					'dbpass':dbpass
				}
			}).done(function(result){
				if(result=="1"){
					alert("Conexion exitosa");
				}else if(result=="0"){
					alert("Conexion fallida");
				}

			});
		}

	});

	/*
		Evento de clickear en el boton "confirmar"
	*/

	$(".submit").click(function(){

		/* 
			asignacion de los inputs
		*/
		var RutAdmin = document.getElementById('adminid').value;
		var NombreAdmin = document.getElementById('nombreadmin').value;
		var ApellidoP = document.getElementById('apaterno').value;
		var ApellidoM = document.getElementById('amaterno').value;
		var Correo = document.getElementById('correo').value;
		var Password = document.getElementById('password').value;
		var CPassword = document.getElementById('cpassword').value;

		/*
			Proceso de validacion		
		*/
		if($.trim(RutAdmin).length==0){
			alert("Debe ingresar un RUT");
			return false;
		}

		if($.trim(NombreAdmin).length==0){
			alert("Debe ingresar un nombre");
			return false;
		}

		if( ($.trim(ApellidoP).length==0) ||  ($.trim(ApellidoM).length==0)){
			alert("Debe ingresar un apellido");
			return false;
		}

		if($.trim(Correo).length==0){
			alert("Debe ingresar un correo electrónico");
			return false;
		}

		if($.trim(Password).length==0){
			alert("Debe ingresar una contraseña");
			return false;
		}else if($.trim(CPassword).length==0){
			alert("Debe repetir la contraseña");
			return false;
		}

		if($.trim(Password)!=$.trim(CPassword)){
			alert("Las contraseñas no coinciden");
			return false;
		}

		/*
			Si llega a este punto es porque todos los datos fueron 
			ingresados correctamente

		*/

		formData(RutAdmin,NombreAdmin,ApellidoP,ApellidoM,Correo,Password);
	});
});

/*
*		----------------Funciones---------------------
*
*
*/


/*
	Funcion de envio del formulario final
	la funcion se llama desde el boton confirmar y
	le entrega los valores de los inputs de la ultima
	ventana (rut, nombre, apaterno... etc.)

*/

function formData(rut,nombre,apaterno,amaterno,correo,pass) { 

	/*
		Asignacion de los valores de ventanas anteriores
	*/
	var host = document.getElementById('host').value;
	var port = document.getElementById('port').value;
	var dbuser = document.getElementById('dbuser').value;
	var dbpass = document.getElementById('dbpass').value;
	var dbname = document.getElementById('dbname').value;
	var dbprefix = document.getElementById('dbprefix').value;

	/*
		Ultimo paso de validacion
	*/

	if($.trim(dbprefix).length == 0){
	    	dbprefix = "";
	}

	/*
		Post al script "insert.php", el cual se encarga de 
		crear la base de datos con los valores entregados aqui

	*/
	
	$.ajax({
		type: 'POST',
		url: 'scripts/instalacion/insert.php',
		data:{
			'host':host,
			'port':port,
			'dbuser':dbuser,
			'dbpass':dbpass,
			'dbname':dbname,
			'dbprefix':dbprefix,
			'rut':rut,
			'nombre':nombre,
			'apaterno':apaterno,
			'amaterno':amaterno,
			'correo':correo,
			'pass':pass
		}
	}).done(function(result){
				if(result=="1"){
					alert("Base de datos y administrador creados exitosamente");
					//window.location = "galeria...";
				}else if(result=="0"){
					alert("Hubo un error con la creacion de la base de datos");
				}

	});
	//window.location = "scripts/instalacion/insert.php";

  /*  var serializedValues = jQuery("#FormInstalacion").serialize();
	var form_data = {
        action: 'ajax_data',
        type: 'post',
        data: serializedValues,
    };
    jQuery.post('instalacion/insert.php', form_data, function(response) {
		alert(response);
    });
	return serializedValues;*/
}


/*
	Funcion de validacion de las primeras 2 ventanas

*/

function formValidation(e){
	/*
	*  VALIDACION CONEXION
	*
	*/

	/*
		El id se obtiene a partir del boton clickeado
		el primer boton es b1,
		el segundo b2... 
	*/
	var id = e.target.id;

	/*
		Dos tipos de entrada: boton "siguiente" o "verificar conexion"
	*/
	if(id=="b1" || id =="checkdb"){
		var host=document.getElementById('host').value;
		//var regexhost = /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/;  
		//var vhost=regexhost.test(host);
		if ($.trim(host).length == 0 /*|| vhost==false*/) {
			alert('El host ingresado no es válido');
			return false;
		}

		var puerto = document.getElementById('port').value;
	    var regexpuerto = /^([0-9]{1,4}|[1-5][0-9]{4}|6[0-4][0-9]{3}|65[0-4][0-9]{2}|655[0-2][0-9]|6553[0-5])$/;
	    var vpuerto = regexpuerto.test(puerto);

	    if($.trim(puerto).length == 0 || vpuerto==false){
	    	alert('El puerto ingresado no es válido !');
			return false;
    	}

	    var dbuser = document.getElementById('dbuser').value;
	    if($.trim(dbuser).length == 0){
	    	alert('Debe ingresar un nombre de usuario');
	    	return false;
	    }


	    var dbpassword = document.getElementById('dbpass').value;
	    if($.trim(dbpassword).length < 4){
	    	alert('Debe ingresar una contraseña válida');
	    	return false;
	    }else{
	    	return true;
	    }

    }

    /*
    *
    * VALIDACION CREACION BASE DE DATOS
    *
    */
	if(id == "b2"){
	    var dbname = document.getElementById('dbname').value;
	    var regex = /^[A-Za-z0-9_$]+$/;
	    var vdbname = regex.test(dbname);
	    if ($.trim(dbname).length == 0 || vdbname == false){
	    	alert('Debe ingresar un nombre válido para la base de datos');
	    	return false;
	    }

	    var dbprefix = document.getElementById('dbprefix').value;
	    var vdbprefix = regex.test(dbprefix);
	    if($.trim(dbprefix).length != 0){
	    	if(vdbprefix == false){
	    		alert('El prefijo ingresado no es válido');
	    		return false;
	    	}
	    }
	    return true;
	}
}

