<?php

	/*Cabezera de la guia*/

	function descripcion($titulo,$descripcion){
	
		print "<div id=\"titulo-laboratorio\">";
		print    "<h4 class=\"text text-center\" id=\"titulo-laboratorio\">".$titulo."</h4>";
		print    "<h4 class=\"text text-center\" id=\"descripcion-guia\">".$descripcion."</h4>";
		print  "</div>";
	}
	
	
	/* visualizacion: CREAR o EDITAR : Con funcion activar ||  VER o RESOLVER : Sin funcion activar */

	/*Checkbox para activar la pregunta*/
	
	function activar($id_pregunta){
		
		print 		"<div class=\"checkbox\">";
        print         	"<label>";
        print           	"<input type=\"checkbox\" id=\"activar:".$id_pregunta."\">activar";
        print         	"</label>";
        print 		"</div>";
	}
	
	/*Tipos de preguntas*/
	
    function dibujo($id_pregunta,$modo){   

        print "<div class=\"form-group dibujo\" id=\"".$id_pregunta."\">";
        print     "<label class=\"control-label\">Subir dibujo:";
        print         "<input id=\"dibujo\" name=\"dibujo\" type=\"file\" class=\"file\">";
        print     "</label>";
        print     "<div class=\"form-group\">";
		
		if ($modo == 'CREAR' || $modo == 'EDITAR'){
				activar($id_pregunta);	
		}
		
        print     "</div>";
        print "</div>";
		print "<hr>";
    } 
     
    function foto($id_pregunta,$modo){

        print "<div class=\"form-group foto\" id=\"".$id_pregunta."\">";
        print    "<div class=\"form-group\">";
        print        "<label class=\"control-label\">Subir foto:";
        print          "<input id=\"foto\" class=\"file\" type=\"file\" name=\"foto\">";
        print        "</label>";
        print      "</div>";
        print      "<div class=\"form-group\" id=\"descripcion_fotografia\">";
        print        "<label>Descripción de la fotografía:</label>";
        print        "<div class=\"input-group\">";
        print          "<textarea class=\"form-control\" id=\"descripcion_foto\" rows=\"2\" cols=\"20\" placeholder=\"Ingrese una descripción\"></textarea>";
        print        "</div>";
        print      "</div>";
        print      "<div class=\"form-group\" id=\"preparacion_de\">";
        print        "<label id=\"preparacion\">Preparación de:</label>";
        print        "<div class=\"input-group\">";
        print          "<input type=\"text\" class=\"form-control\" id=\"material\">";
        print        "</div>";
        print      "</div>";
        print      "<div class=\"form-group\" id=\"tincion_usada\">";
        print       "<label>Tinción usada:</label>";
        print       "<div class=\"input-group\">";
        print         "<input type=\"text\" id=\"tinte\" class=\"form-control\">";
        print       "</div>";
        print     "</div>";
        print     "<div id=\"diametro_campo\" class=\"form-group\">";
        print       "<label>Diámetro del campo:</label>";
        print       "<div class=\"input-group\">";
        print         "<input type=\"text\" id=\"diametro\" class=\"form-control\">";
        print         "<span class=\"input-group-addon\">µ</span>";
        print       "</div>";
        print     "</div>";
        print     "<div id=\"aumento_total\" class=\"form-group\">";
        print       "<label>Aumento total:</label>";
        print       "<div class=\"input-group\">";
        print         "<input type=\"text\" id=\"aumento\" class=\"form-control\">";
        print         "<span class=\"input-group-addon\">x</span>";
        print       "</div>";
        print     "</div>";
        print     "<div class=\"form-group\" id=\"autor_foto\">";
        print       "<label>Autor:</label>";
        print       "<div class=\"input-group\">";
        print         "<input type=\"text\" id=\"autor\" class=\"form-control\">";
        print       "</div>";
        print     "</div>";
        print     "<div id=\"fecha_foto\" class=\"form-group\">";
        print       "<label for=\"fecha\">Fecha:</label>";
        print       "<div class=\"input-group\">";
        print         "<input type=\"text\" id=\"fecha\" class=\"form-control\">";
        print       "</div>";
        print     "<br>";
        print     "</div>";

		if ($modo == 'CREAR' || $modo == 'EDITAR'){
				activar($id_pregunta);	
		}
			
        print "</div>";
		print "<hr>";
    }

    function titulo($id_pregunta,$texto_titulo,$modo){

        print "<div class=\"form-group titulo\" id=\"".$id_pregunta."\">";
        print       "<label>".$texto_titulo."</label>";

		if ($modo == 'CREAR' || $modo == 'EDITAR'){
				activar($id_pregunta);	
		}
		
        print "</div>";
		print "<hr>";
    }
      
    function texto($id_pregunta,$texto_pregunta,$modo){

        print "<div class=\"form-group texto\" id=\"".$id_pregunta."\">";
        print  		"<label>".$texto_pregunta."</label>";
        print  		"<div class=\"input-group\">";
        print    		"<input type=\"text\" name=\"respuesta-pregunta\" class=\"form-control\">";
        print  		"</div>";
		
		if ($modo == 'CREAR' || $modo == 'EDITAR'){
				activar($id_pregunta);	
		}	
		
        print "</div>";
		print "<hr>";
    }
	
    function area($id_pregunta,$texto_pregunta,$modo){

        print "<div class=\"form-group area\" id=\"".$id_pregunta."\">";
        print   "<label id=\"texto-pregunta\">".$texto_pregunta."</label>";
        print   "<div class=\"input-group\">";
        print      "<textarea class=\"form-control\" id=\"area-texto\" rows=\"4\" cols=\"50\" placeholder=\"Ingrese sus observaciones aquí\"></textarea>";
        print   "</div>";
		
		if ($modo == 'CREAR' || $modo == 'EDITAR'){
				activar($id_pregunta);	
		}
		
        print "</div>";
		print "<hr>";
    }

	/*Tipo : MULTIPLE*/
	
    function lista($id_pregunta,$texto_pregunta,$opciones,$modo){

        print "<div class=\"form-group lista\" id=\"".$id_pregunta."\">";
        print  		"<label>".$texto_pregunta."</label>";
        print  		"<select class=\"form-control\" id=\"select:".$id_pregunta."\">";
		
					for($i=0; $i<count( $opciones );$i++){
						print "<option value=\"op".$i."\">".$opciones[$i]."</option>";
					}
        
        print 	 	"</select>";
        print  		"<br>";
		
		if ($modo == 'CREAR' || $modo == 'EDITAR'){
				activar($id_pregunta);	
		}	
		
        print "</div>";
		print "<hr>";
    }

    function checkbox($id_pregunta,$texto_pregunta,$opciones,$modo){

        print "<div class=\"form-group checkbox_button\" id=\"".$id_pregunta."\">";
        print  		"<label id=\"texto-pregunta\>".$texto_pregunta."</label>";
		
		for($i=0; $i<count( $opciones );$i++){
			print   "<div class=\"checkbox\">";
			print     	"<label class=\"checkbox\">";                 
			print 			"<input type=\"checkbox\" name=\"sel:".$i."\">".$opciones[$i]."";               
			print     	"</label>";
			print   "</div>";
		}
		
		if ($modo == 'CREAR' || $modo == 'EDITAR'){
				activar($id_pregunta);	
		}	
		
        print "</div>";
		print "<hr>";
    }
     
    function radio($id_pregunta,$texto_pregunta,$opciones,$modo){

        print "<div class=\"form-group radio_button\" id=\"".$id_pregunta."\">";
        print  		"<label id=\"texto-pregunta\">".$texto_pregunta."</label>";
        print   "<br>";   
		
		for($i=0; $i<count($opciones);$i++){

			print "<div class=\"radio\">";
			if($i==0)
			   print "<label><input type=\"radio\" name=\"opciones\" id=\"opciones".$i."\" checked=\"\">".$opciones[$i]."</label>"; 
			else
			  print "<label><input type=\"radio\" name=\"opciones\" id=\"opciones".$i."\">".$opciones[$i]."</label>";  
			
			print "</div>";
		}
		
		if ($modo == 'CREAR' || $modo == 'EDITAR'){
				activar($id_pregunta);	
		}	
		
		print "</div>";
		print "<hr>";
    }
?>