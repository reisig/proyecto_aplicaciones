<?php

  $host     = $_POST['host'];
  $port     = $_POST['port'];
  $dbuser   = $_POST['dbuser'];
  $dbpass   = $_POST['dbpass'];

	$dbname   = $_POST['dbname'];
	$dbprefix = $_POST['dbprefix'];

	$rut      = $_POST['rut'];
	$nombre   = $_POST['nombre'];
	$apaterno = $_POST['apaterno'];
	$amaterno = $_POST['amaterno'];
	$correo   = $_POST['correo'];
	$pass     = $_POST['pass'];

  $TablaAsignatura  = $dbprefix."Asignatura";
  $TablaContenido = $dbprefix."Contenido";
  $TablaGuia = $dbprefix."Guia";
  $TablaPregunta = $dbprefix."Pregunta";
  $TablaRepositorio = $dbprefix."Repositorio";
  $TablaRespuesta = $dbprefix."Respuesta";
  $TablaSeleccMulti = $dbprefix."SeleccionMultiple";
  $TablaUsuario = $dbprefix."Usuario";
  $TablaUsuarioAsignatura = $dbprefix."UsuarioAsignatura";

  //drop SQL
  $drop = "DROP TABLE IF EXISTS ";

  try{
    /*

      No se usa la conexion de "dbc.php", porque se asume que en este paso no existe aun

    */
    $con = new PDO("mysql:host=".$host.";port=".$port, $dbuser, $dbpass);


    /*
      Primero se borra la base de datos si existe...
    */
    $dropDB = "DROP DATABASE IF EXISTS ".$dbname;

    /*if(*/  $con->query($dropDB); /*){
      echo "Se eliminó la base de datos ".$dbname." anterior...\n";
    }else{
      echo "No se encontro una base de datos con el nombre ".$dbname."\n";
    }*/

    /*
      Se crea la base de datos
    */
    $creaDB = "CREATE DATABASE IF NOT EXISTS ".$dbname; 

    if($con->query($creaDB)){
      //echo "Base de datos ".$dbname." creada\n";

      /*

        Comprueba si puede acceder a la BD

      */
      $usarDB = "USE ".$dbname; 
      if($con->query($usarDB)){

          $con->query($drop.$TablaAsignatura);
          $con->query($drop.$TablaContenido);
          $con->query($drop.$TablaGuia);
          $con->query($drop.$TablaPregunta);
          $con->query($drop.$TablaRepositorio);
          $con->query($drop.$TablaRespuesta);
          $con->query($drop.$TablaSeleccMulti);
          $con->query($drop.$TablaUsuario);
          $con->query($drop.$TablaUsuarioAsignatura);

          /*
          *
          *   Consultas utilizadas para crear las tablas 
          *
          */
          
          
          $creaAsignatura = "CREATE TABLE ".$TablaAsignatura.
                            "(
                                  Id int(11),
                                  NombreAsignatura varchar(50),
                                  RutProfesorACargo varchar(20),
                                  PRIMARY KEY (Id)
                            )";
          


          $creaContenido = "CREATE TABLE ".$TablaContenido.
                            "(
                            	IdGuia int(11),
                                IdPregunta int(11),
                                Respuesta varchar(500),
                                PRIMARY KEY (IdGuia, IdPregunta)
                            )";

          $creaGuia = "CREATE TABLE ".$TablaGuia.
                      "(
                          Id int(11),
                          Titulo varchar(50),
                          Descripcion varchar(500),
                          Fecha date,
                          IdAsignatura int(11),
                          Estado varchar(11),
                          PRIMARY KEY (Id)
                      )";

          $creaPregunta = "CREATE TABLE ".$TablaPregunta.
                          "(
                              Id int(11),
                              Enunciado varchar(100),
                              TipoRespuesta varchar(50),
                              PRIMARY KEY (Id)
                          )";

          $creaRepositorio = "CREATE TABLE ".$TablaRepositorio.
                              "(
                                  Id MEDIUMINT NOT NULL AUTO_INCREMENT,
                                  RutAlumno varchar(20),
                                  Ruta varchar(200),
                                  DescripcionBreve varchar(600),
                                  TipoTenido varchar(20),
                                  Preparacion varchar(20),
                                  Diametro int(11),
                                  Aumento int(11),
                                  Fecha date,
                                  RutaDibujo varchar(200),
                                  PRIMARY KEY (Id)
                              )";

          $creaRespuesta = "CREATE TABLE ".$TablaRespuesta.
                           "(
                              IdPregunta int(11),
                              IdGuia int(11),
                              Respuesta varchar(500),
                              Fecha date,
                              RutUsuario varchar(20)
                            )";

          $creaSeleccMulti = "CREATE TABLE ".$TablaSeleccMulti.
                              "(
                                  IdPregunta int(11),
                                  ValorAlternativa varchar(50),
                                  Tipo varchar(10)
                                )";

          $creaUsuario = "CREATE TABLE ".$TablaUsuario.
                          "(
                              Nombre varchar(50),
                              ApellidoP varchar(50),
                              ApellidoM varchar(50),
                              Rut varchar(20),
                              Correo varchar(50),
                              Password varchar(100),
                              TipoUsuario varchar(20),
                              PRIMARY KEY (Rut)
                            )";
          
          $creaUsuarioAsignatura = "CREATE TABLE ".$TablaUsuarioAsignatura.
                          "(
                              RutUsuario varchar(20) not null,
	                          IdAsignatura int(11),
                            )";
                            
          
          //crear tablas
         if( !$con->query($creaAsignatura) ) { /*echo "Tabla ".$TablaAsignatura." creada.\n";*/ echo "0";}    
         if( !$con->query($creaContenido) ) { /*echo "Tabla ".$TablaContenido. " creada.\n";*/ echo "0";}
         if( !$con->query($creaGuia) ){ /*echo "Tabla ".$TablaGuia." creada.\n";*/ echo "0";}
         if( !$con->query($creaUsuario)){ /*echo "Tabla ".$TablaUsuario." creada.\n";*/ echo "0";}
         if( !$con->query($creaSeleccMulti)){ /*echo "Tabla ".$TablaSeleccMulti." creada.\n";*/ echo "0";}
         if( !$con->query($creaRespuesta)){ /*echo "Tabla ".$TablaRespuesta." creada.\n";*/ echo "0";}
         if( !$con->query($creaRepositorio)){ /*echo "Tabla ".$TablaRepositorio." creada.\n";*/ echo "0";}
         if( !$con->query($creaPregunta)){ /*echo "Tabla ".$TablaPregunta." creada.\n";*/ echo "0";}
         if( !$con->query($creaUsuarioAsignatura)){ /*echo "Tabla ".$TablaUsuarioAsignatura." creada.\n";*/ echo "0";}

        $alterTable = "ALTER TABLE ";


        /*

          Creacion de claves foraneas 

        */
        
        if(!$con->query($alterTable.$TablaAsignatura." ADD CONSTRAINT fk_".$TablaAsignatura."_1 FOREIGN KEY 
                                                    (RutProfesorACargo) REFERENCES ".$TablaUsuario. "(Rut) 
                                                    ON DELETE NO ACTION ON UPDATE NO ACTION")){
          //echo "alter asignatura\n";
          echo "0";
        }
        
          
        if(!$con->query($alterTable.$TablaContenido." ADD CONSTRAINT fk_".$TablaContenido."_1 FOREIGN KEY 
                                                    (IdGuia) REFERENCES ".$TablaGuia."(Id)
                                                    ON DELETE NO ACTION ON UPDATE NO ACTION")){
          //echo "alter contenido 1\n";
          echo "0";
        }

        if(!$con->query($alterTable.$TablaContenido." ADD CONSTRAINT fk_".$TablaContenido."_2 FOREIGN KEY
                                                    (IdPregunta) REFERENCES ".$TablaPregunta."(Id)")){
          //echo "alter contenido 2\n";
          echo "0";
        }
          
        if(!$con->query($alterTable.$TablaGuia." ADD CONSTRAINT fk_".$TablaGuia."_1 FOREIGN KEY 
                                                (IdAsignatura) REFERENCES ".$TablaAsignatura."(Id)")){

          //echo "alter guia\n";
          echo "0";
        }
          
        /*
        if(!$con->query($alterTable.$TablaPregunta." ADD CONSTRAINT fk_".$TablaPregunta."_1 FOREIGN KEY 
                                                (IdGuia) REFERENCES ".$TablaGuia."(Id)")){

          //echo "alter guia\n";
          echo "0";
        }*/
        
        if(!$con->query($alterTable.$TablaRepositorio. " ADD CONSTRAINT fk_".$TablaRepositorio."_1 FOREIGN KEY
                                                        (RutAlumno) REFERENCES ".$TablaUsuario."(Rut)")){

          //echo "alter Repositorio\n";
          echo "0";
        }

        if(!$con->query($alterTable.$TablaRespuesta. " ADD CONSTRAINT fk_".$TablaRespuesta."_1 FOREIGN KEY
                                                      (IdGuia) REFERENCES ".$TablaGuia."(Id)")){
          //echo "alter respuesta 1\n";
          echo "0";
        }

        if(!$con->query($alterTable.$TablaRespuesta. " ADD CONSTRAINT fk_".$TablaRespuesta."_2 FOREIGN KEY
                                                      (IdPregunta) REFERENCES ".$TablaPregunta."(Id)")){
          //echo "alter respuesta 2\n";
          echo "0";
        }

        if(!$con->query($alterTable.$TablaRespuesta." ADD CONSTRAINT fk_".$TablaRespuesta."_3 FOREIGN KEY
                                                      (RutUsuario) REFERENCES ".$TablaUsuario."(Rut)")){
          //echo "alter respuesta 3\n";
          echo "0";
        }

        if(!$con->query($alterTable.$TablaSeleccMulti." ADD CONSTRAINT fk_".$TablaSeleccMulti."_1 FOREIGN KEY
                                                      (IdPregunta) REFERENCES ".$TablaPregunta."(Id)")){
          //echo "alter SeleccionMultiple\n";
          echo "0";
        }

          
        if(!$con->query($alterTable.$TablaUsuario. " ADD CONSTRAINT fk_".$TablaUsuario."_1 FOREIGN KEY
                                                    (IdAsignatura) REFERENCES ".$TablaAsignatura."(Id)")){
          //echo "alter usuario\n";
          echo "0";
        }

        if(!$con->query($alterTable.$TablaUsuarioAsignatura. " ADD CONSTRAINT fk_".$TablaUsuarioAsignatura."_1 FOREIGN KEY
                                                    (RutUsuario) REFERENCES ".$TablaUsuario."(Rut)")){
          //echo "alter usuario\n";
          echo "0";
        }
        
        if(!$con->query($alterTable.$TablaUsuarioAsignatura. " ADD CONSTRAINT fk_".$TablaUsuarioAsignatura."_2 FOREIGN KEY
                                                    (IdAsignatura) REFERENCES ".$TablaAsignatura."(Id)")){
          //echo "alter usuario\n";
          echo "0";
        }
        /*

          Creacion e insercion en la base de datos de la cuenta de administrador

        */

        //encriptacion de contraseña
        //requiere PHP 5.6 y algunas configuraciones en php.ini

        /*$cost = 10;
        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
        $salt = sprintf("$2a$%02d$", $cost) . $salt;
        $passwordHash = crypt($pass, $salt);*/

        /*        
          //comprobar pass con hash
        if(hash_equals($passwordHash, crypt($pass, $passwordHash))){
          //MATCH!
        }
        */

        //consulta de insercion
        $admin = "INSERT INTO ".$TablaUsuario." (Rut, Nombre, ApellidoP, ApellidoM, Correo, TipoUsuario, Password ) 
                    VALUES ('".$rut."', '".$nombre."', '".$apaterno."', '".$amaterno."', '".$correo."', 'administrador', '".$pass."')";


        //comprueba si se ejecuto la consulta con exito
        if($con->query($admin)){
          //echo "administrador creado\n";

          /*

            Creacion de script: config.php

          */

          //ubicacion del archivo config: /usr/share/nginx/html/proyecto_aplicaciones/scripts/bd/config.php
          $dir = realpath(__DIR__."/..");
          $configFile = fopen($dir."/bd/config.php", "w") or die (print_r(error_get_last(),true));

        //comprueba si se puede escribir al archivo..
          //requiere que el usuario www-data tenga permisos...
          // ejecutar sudo chgrp -R www-data html (estando en la carpeta /usr/share/nginx/)
         if(is_writeable($dir."/bd/config.php")){

              $txt = "<?php
                          /*
                              Script de configuracion de la base de datos MySQL
                              Lleva el host, puerto, usuario, password y nombre de la base de datos

                              Ademas de otras opciones
                          */

                          define('DBHOST', '".$host."');// MySQL host address - localhost is usually fine
                          define('DBUSER', '".$dbuser."'); // db username
                          define('DBPASS', '".$dbpass."'); // db password
                          define('DBNAME', '".$dbname."'); // nombre de la base de datos creada previamente...

                          define('DEBUG', false);// set to false when done testing

                          define('CHARSET', 'utf8'); // sets the charset of your database for communication
                          define('DBDRIVER', 'mysql');// database driver to use
                          define('DBPORT', '".$port."'); // database port for connection
                          ?>
                      ";

                      fwrite($configFile, $txt);
                      fclose($configFile);

                      //Se escribio correctamente en el archivo...
                      echo "1";
          }else{
              //echo "No se puede escribir en el archivo\n";
              echo "0";
          }

        }else{
          //echo "no se pudo crear el administrador\n";
          echo "0";
        }

        }else{
          //echo "error al acceder a la BD\n"; 
          echo "0";
        }

    }else{
      //echo "No se pudo crear la base de datos ".$dbname."\n";
      echo "0";
    }


  }catch(PDOException $e){
    //echo "error de conexion: ".$e->getMessage()."\n";
    echo "0";
  }
?>
