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
		
		print "<div class=\"checkbox\">";
        print   "<label><input type=\"checkbox\" id=\"activar:".$id_pregunta."\">activar</label>";
        print "</div>";
	}
	
	/*Botones para la guia, dependiendo del modo de visualizacion*/
	
	function botonesGuia($rut,$idAsignatura,$idGuia,$modo){

		if($modo == 'VER'){
			
			print   "<div class=\"form-group\">";
			print		"<div class=\"row text-center\">";
            print         "<button type=\"button\" class=\"btn btn-primary\" id=\"ver-guia\" onclick =\"volver('".$idAsignatura."','".$rut."')\">Volver</button>";
			print 		"</div>";
			print 	"</div>";
		}
	
		if($modo == 'CREAR' || $modo == 'EDITAR'){
			
			print   "<div class=\"form-group\">";
			print		"<div class=\"row text-center\">";
            print         "<button type=\"button\" class=\"btn btn-primary\" id=\"subir-guia\" onclick =\"subir_preguntas('".$idAsignatura."','".$rut."','".$idGuia."','".$modo."')\">Subir guía</button>";
			print 		"</div>";
			print 	"</div>";
		}
		
		if($modo == 'RESOLVER'){
			
			print   "<div class=\"form-group\">";
			print		"<div class=\"row text-center\">";
            print         "<input type=\"submit\" class=\"btn btn-primary\" id=\"resolver-guia\" value=\"enviarForm.php\">Enviar";
			print 		"</div>";
			print 	"</div>";		
		}
	
	} 
	
	/*Tipos de preguntas*/
	
    function dibujo($id_pregunta,$modo){ 

        print "<div class=\"form-group dibujo\" id=\"".$id_pregunta."\">";
        print     "<label class=\"col-xs-2 control-label\">Subir dibujo:</label>";
        print         "<input id=\"dibujo\" name=\"dibujo\" type=\"file\" class=\"file\">";
        print     "<div class=\"form-group\">";
		
		if ($modo == 'CREAR' || $modo == 'EDITAR'){
				activar($id_pregunta);	
		}
		
        print     "</div>";
        print "</div>";
		print "<hr>";
    } 
     
    function foto($id_pregunta,$modo){
        
        print '<fieldset class="scheduler-border">';
        print    '<legend class="scheduler-border">SUBIR FOTO</legend>';
        print    '<div class="form-group" id="subir-imagen">';
        
        print        '<div class="form-group">';
        print            '<label class="control-label col-xs-2">Elegir imagen:</label>';
        print            '<div class="col-xs-2 input-group">';
        print                '<input id="foto" class="file" type="file" name="foto">';
        print            '</div>';
        print        '</div>';

        print        '<div class="form-group" id="preparacion_de">';
        print            '<label class="control-label col-xs-2" id="preparacion">Preparación de:</label>';
        print            '<div class="col-xs-2 input-group">';
        print                '<input type="text" class="form-control" id="material">';
        print            '</div>';
        print        '</div>';

        print        '<div class="form-group" id="tincion_usada">';
        print            '<label class="control-label col-xs-2">Tinción usada:</label>';
        print            '<div class="col-xs-2 input-group">';
        print                '<input type="text" id="tinte" class="form-control">';
        print            '</div>';
        print        '</div>';

        print        '<div id="diametro_campo" class="form-group">';
        print            '<label class="control-label col-xs-2">Diámetro del campo:</label>';
        print            '<div class="col-xs-2 input-group">';
        print                '<select class="form-control">';
        print                    '<option>0</option>'   ;
        print                    '<option>375</option>' ;
        print                    '<option>150</option>' ;
        print                    '<option>1500</option>';
        print                    '<option>3570</option>';
        print                '</select>';
        print                '<span class="input-group-addon">µ</span>';
        print           '</div>';
        print        '</div>';

        print        '<div id="aumento_total" class="form-group">';
        print            '<label class="control-label col-xs-2">Aumento total:</label>';
        print            '<div class="col-xs-2 input-group">';
        print                '<select class="form-control">';
        print                    '<option>0</option>';
        print                    '<option>4</option>';
        print                    '<option>10</option>';
        print                    '<option>40</option>';
        print                    '<option>100</option>';
        print                '</select>';
        print                '<span class="input-group-addon">x</span>';
        print            '</div>';
        print        '</div>';

        print        '<div class="form-group" id="autor_foto">';
        print            '<label class="control-label col-xs-2">Autor:</label>';
        print            '<div class="col-xs-2 input-group">';
        print                '<input type="text" id="autor" class="form-control">';
        print            '</div>';
        print        '</div>';

        print        '<div id="fecha_foto" class="form-group">';
        print            '<label class="control-label col-xs-2" for="fecha">Fecha:</label>';
        print            '<div class="col-xs-2 input-group">';
        print                '<input type="date" id="fecha" class="form-control">';
        print            '</div>';
        print        '</div>';

        print        '<div class="form-group" id="descripcion_fotografia">';
        print            '<label class="control-label">Descripción de la fotografía:</label>';
        print            '<div class="input-group">';
        print                '<textarea class="form-control" id="descripcion_foto" rows="2" cols="30" placeholder="Ingrese una descripción"></textarea>';
        print            '</div>';
        print        '</div>';

            if ($modo == 'CREAR' || $modo == 'EDITAR'){
                activar($id_pregunta);	
            }
        
        print    '</div>';  
        print '</fieldset>';
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

        print "<div class=\"form-group\" id=\"".$id_pregunta."\">";
        print  		"<label class=\"control-label\">".$texto_pregunta."</label>";
        print       '<div class="col-xs-3 input-group">';
        print  		   "<select class=\"form-control\" id=\"select:".$id_pregunta."\">";
		
                            for($i=0; $i<count( $opciones );$i++){
                                print "<option value=\"op".$i."\">".$opciones[$i]."</option>";
                            }
        print       '</div>';
        print 	 	   "</select>";
		
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
			   print "<label><input type=\"radio\" name=\"opciones".$id_pregunta."\" id=\"opciones".$i."\" checked=\"\">".$opciones[$i]."</label>"; 
			else
			  print "<label><input type=\"radio\" name=\"opciones".$id_pregunta."\" id=\"opciones".$i."\">".$opciones[$i]."</label>";  
			
			print "</div>";
		}
		
		if ($modo == 'CREAR' || $modo == 'EDITAR'){
				activar($id_pregunta);	
		}	
		
		print "</div>";
		print "<hr>";
    }
?>