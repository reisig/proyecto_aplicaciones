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
            print         "<input type=\"submit\" class=\"btn btn-primary\" id=\"resolver-guia\" value=\"Enviar respuestas\">";
			print 		"</div>";
			print 	"</div>";		
		}
	
	}
	
	/*Informacion para subir las respuestas*/
	
	function infoGuia($rut,$idAsignatura,$idGuia){
		
		print '<input type="hidden" name="rut" value="'.$rut.'">';
		print '<input type="hidden" name="asignatura" value="'.$idAsignatura.'">';
		print '<input type="hidden" name="guia" value="'.$idGuia.'">';
	}
	
	/*Tipos de preguntas*/
	
    function dibujo($id_pregunta,$modo){ 

        print '<div class="form-group dibujo" id="'.$id_pregunta.'">';
        print     "<label class=\"col-xs-2 control-label\">Subir dibujo:</label>";
		print		  '<input type="hidden" name="MAX_FILE_SIZE" value="2000000">';
        print         '<input id="dibujo" name="DIBUJO-'.$id_pregunta.'" type="file">';
        print     '<div class="form-group">';
		
		if ($modo == 'CREAR' || $modo == 'EDITAR'){
				activar($id_pregunta);	
		}
		
        print     '</div>';
		print	  '<input type="hidden" name="PREGUNTAS['.$id_pregunta.']" value="DIBUJO">';
        print '</div>';
		print '<hr>';
    } 
     
    function foto($id_pregunta,$modo){
        
        print '<fieldset class="scheduler-border">';
        print    '<legend class="scheduler-border">SUBIR FOTO</legend>';
        print    '<div class="form-group" id="subir-imagen">';
        
        print        '<div class="form-group">';
        print            '<label class="control-label col-xs-2">Elegir imagen:</label>';
        print            '<div class="col-xs-2 input-group">';
		print 				 '<input type="hidden" name="MAX_FILE_SIZE" value="2000000">';
        print                '<input id="foto" type="file" name="FOTO-'.$id_pregunta.'">';
        print            '</div>';
        print        '</div>';

		print        '<div class="form-group" id="preparacion_de">';
        print            '<label class="control-label col-xs-2" id="preparacion">Preparación de:</label>';
        print            '<div class="col-xs-2 input-group">';
        print                '<input type="text" class="form-control" id="material" name="FOTO-'.$id_pregunta.'[preparacion]">';
        print            '</div>';
        print        '</div>';

        print        '<div class="form-group" id="tincion_usada">';
        print            '<label class="control-label col-xs-2">Tinción usada:</label>';
        print            '<div class="col-xs-2 input-group">';
        print                '<input type="text" id="tinte" class="form-control" name="FOTO-'.$id_pregunta.'[tinte]">';
        print            '</div>';
        print        '</div>';

        print        '<div id="diametro_campo" class="form-group">';
        print            '<label class="control-label col-xs-2">Diámetro del campo:</label>';
        print            '<div class="col-xs-2 input-group">';
        print                '<select class="form-control" name="FOTO-'.$id_pregunta.'[diamentro]">';
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
        print                '<select class="form-control" name="FOTO-'.$id_pregunta.'[aumento]">';
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
        print                '<input type="text" id="autor" class="form-control" name="FOTO-'.$id_pregunta.'[autor]">';
        print            '</div>';
        print        '</div>';
		
        print        '<div class="form-group" id="descripcion_fotografia">';
        print            '<label class="control-label">Descripción de la fotografía:</label>';
        print            '<div class="input-group">';
        print                '<textarea class="form-control" id="descripcion_foto" rows="2" cols="30" placeholder="Ingrese una descripción" name="FOTO-'.$id_pregunta.'[descripcion]"></textarea>';
        print            '</div>';
        print        '</div>';

        if ($modo == 'CREAR' || $modo == 'EDITAR'){
                activar($id_pregunta);	
        }
        
        print    '</div>';  
		print	 '<input type="hidden" name="PREGUNTAS['.$id_pregunta.']" value="FOTO">';
        print '</fieldset>';
    }

    function titulo($id_pregunta,$texto_titulo,$modo){

        print "<div class=\"form-group titulo\" id=\"".$id_pregunta."\">";
        print       "<label>".$texto_titulo."</label>";

		if ($modo == 'CREAR' || $modo == 'EDITAR'){
				activar($id_pregunta);	
		}
		
		print	 '<input type="hidden" name="PREGUNTAS['.$id_pregunta.']" value="TITULO">';
        print "</div>";
		print "<hr>";
    }
      
    function texto($id_pregunta,$texto_pregunta,$modo){

        print "<div class=\"form-group texto\" id=\"".$id_pregunta."\">";
        print  		"<label>".$texto_pregunta."</label>";
        print  		"<div class=\"input-group\">";
        print    		"<input type=\"text\" name=\"TEXTO[".$id_pregunta."]\" class=\"form-control\">";
        print  		"</div>";
		
		if ($modo == 'CREAR' || $modo == 'EDITAR'){
				activar($id_pregunta);	
		}	
		
		print	 '<input type="hidden" name="PREGUNTAS['.$id_pregunta.']" value="TEXTO">';
        print "</div>";
		print "<hr>";
    }
   
    function area($id_pregunta,$texto_pregunta,$modo){

        print "<div class=\"form-group area\" id=\"".$id_pregunta."\">";
        print   "<label id=\"texto-pregunta\">".$texto_pregunta."</label>";
        print   "<div class=\"input-group\">";
        print      "<textarea class=\"form-control\" name=\"AREA[".$id_pregunta."]\" id=\"area-texto\" rows=\"4\" cols=\"50\" placeholder=\"Ingrese sus observaciones aquí\"></textarea>";
        print   "</div>";
		
		if ($modo == 'CREAR' || $modo == 'EDITAR'){
				activar($id_pregunta);	
		}
		
		print	 '<input type="hidden" name="PREGUNTAS['.$id_pregunta.']" value="AREA">';
        print "</div>";
		print "<hr>";
    }

	/*Tipo : MULTIPLE*/
	
    function lista($id_pregunta,$texto_pregunta,$opciones,$modo){

        print "<div class=\"form-group\" id=\"".$id_pregunta."\">";
        print  		"<label class=\"control-label\">".$texto_pregunta."</label>";
        print       '<div class="col-xs-3 input-group">';
        print  		   "<select class=\"form-control\" name=\"LISTA[".$id_pregunta."]\" id=\"select:".$id_pregunta."\">";
		
                            for($i=0; $i<count( $opciones );$i++){
                                print "<option>".$opciones[$i]."</option>";
                            }
							
        print       '</div>';
        print 	 	   "</select>";
		
		if ($modo == 'CREAR' || $modo == 'EDITAR'){
				activar($id_pregunta);	
		}	
		
		print	 '<input type="hidden" name="PREGUNTAS['.$id_pregunta.']" value="LISTA">';
        print "</div>";
		print "<hr>";
    }

    function checkbox($id_pregunta,$texto_pregunta,$opciones,$modo){

        print "<div class=\"form-group checkbox_button\" id=\"".$id_pregunta."\">";
        print  		"<label id=\"texto-pregunta\>".$texto_pregunta."</label>";
		
		for($i=0; $i<count( $opciones );$i++){
			print   "<div class=\"checkbox\">";
			print     	"<label class=\"checkbox\">";                 
			print 			"<input type=\"checkbox\" name=\"CHECKBOX-".$id_pregunta."[]\">".$opciones[$i]."";               
			print     	"</label>";
			print   "</div>";
		}
		
		if ($modo == 'CREAR' || $modo == 'EDITAR'){
				activar($id_pregunta);	
		}	
		
		print	 '<input type="hidden" name="PREGUNTAS['.$id_pregunta.']" value="CHECKBOX">';
        print "</div>";
		print "<hr>";
    }
     
    function radio($id_pregunta,$texto_pregunta,$opciones,$modo){

        print "<div class=\"form-group radio_button\" id=\"".$id_pregunta."\">";
        print  		"<label id=\"texto-pregunta\">".$texto_pregunta."</label>";
        print "<br>";   
		
		for($i=0; $i<count($opciones);$i++){

			print "<div class=\"radio\">";
			if($i==0)
			   print "<label><input type=\"radio\" name=\"RADIO[".$id_pregunta."]\" id=\"opciones".$i."\" value=\"".$opciones[$i]."\" checked>".$opciones[$i]."</label>"; 
			else
			  print "<label><input type=\"radio\" name=\"RADIO[".$id_pregunta."]\" id=\"opciones".$i."\" value=\"".$opciones[$i]."\">".$opciones[$i]."</label>";  
			
			print "</div>";
		}
		
		if ($modo == 'CREAR' || $modo == 'EDITAR'){
				activar($id_pregunta);	
		}	
		
		print	 '<input type="hidden" name="PREGUNTAS['.$id_pregunta.']" value="RADIO">';
		print "</div>";
		print "<hr>";
    }
?>