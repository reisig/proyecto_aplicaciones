<?php

/**
 * Este archivo representa a la clase imagen y contiene las variables y funciones necesarias para manipular dichas variables.
 *
 * @package RepBiologia
 * @since RepBiologia 1.0
*/

class Imagen{
    
    var $ruta; // ruta desde donde se cargara la imagen
    var $rut_alumno; // rut del alumno que subio la imagen
    var $descripcion_breve; // descripcion sobre la imagen subida
    var $tipo_tenido; // teñido utlizado en la muestra de la imagen
    var $preparacion; // define el tipo de preparacion de la muestra de la imagen
    var $aumento; // define el aumento utilizado al tomar 
    var $ruta_dibujo; // ruta desde donde se carga el dibujo asociado a la imagen
    var $fecha; // fecha en que fue subida la imagen al repositorio
    var $ancho; // ancho de la imagen
    var &alto; // alto de la imagen
    
    function __construct( $ruta, $rut_alumno, $descripcion_breve, $tipo_tenido, $preparacion, $aumento, $ruta_dibujo, $fecha)
    {
        $this->ruta = $ruta;
        $this->rut_alumno = $rut_alumno;
        $this->descripcion_breve = $descripcion_breve;
        $this->tipo_tenido = $tipo_tenido;
        $this->preparacion = $preparacion;
        $this->aumento = $aumento;
        $this->ruta_dibujo = $ruta_dibujo;
        $this->fecha = $fecha;
        $foto = getimagesize( $ruta ); // aqui se obtiene la informacion de la imagen
        this->ancho = $foto(0); // se guarda el ancho de la imagen
        this->alto = $foto(1); // se guarda el alto de la imagen
    }
    
    
    // Aqui inician las funciones get, que nos permiten retornar el valor correspondiente a cada variable del objeto Imagen
    function get_ruta()
    {
        return $this->ruta;
    }
    
    function get_rut()
    {
        return $this->rut_alumno;
    }
    
    function get_descripcion()
    {
        return $this->descripcion_breve;
    }
    
    function get_tenido()
    {
        return $this->tipo_tenido;
    }
    
    function get_preparacion()
    {
        return $this->preparacion;
    }
    
    function get_aumento()
    {
        return $this->aumento;
    }
    
    function get_ruta_dibujo()
    {
        return $this->ruta_dibujo;
    }
    
    function get_fecha()
    {
        return $this->fecha;
    }
    
    function get_ancho()
    {
        return $this->ancho;
    }
    
    function get_ancho()
    {
        return $this->alto;
    }
    
    // fin de las funciones get
    
    // Aqui inician las funciones set, en caso de ser necesario modificar alguna de las variables del objeto Imagen por si solos
    
    function set_ruta( $ruta )
    {
        $this->ruta = $ruta;
    }
    
    function set_rut( $rut_alumno )
    {
        $this->rut_alumno = $rut_alumno;
    }
    
    function set_descripcion( $descripcion_breve )
    {
        $this->descripcion_breve = $descripcion_breve;
    }
    
    function set_tenido( $tipo_tenido )
    {
        $this->tipo_tenido = $tipo_tenido;
    }
    
    function set_preparacion( $preparacion )
    {
        $this->preparacion = $preparacion;
    }
    
    function set_aumento( $aumento )
    {
        $this->aumento = $aumento;
    }
    
    function set_ruta_dibujo( $ruta_dibujo )
    {
         $this->ruta_dibujo = $ruta_dibujo;
    }
    
    function set_fecha( $fecha )
    {
        $this->fecha = $fecha;
    }
    
    function set_tamano( $tamano )
    {
        $this->tamano = $tamano;
    }
    
    function set_ancho( $ancho)
    {
        $this->ancho = ancho;
    }
    
    function set_alto( $alto )
    {
        $this->alto = alto;
    }
    
    // fin de las funciones set
}

?>
    