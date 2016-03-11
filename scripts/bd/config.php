<?php
                          /*
                              Script de configuracion de la base de datos MySQL
                              Lleva el host, puerto, usuario, password y nombre de la base de datos

                              Ademas de otras opciones
                          */

                          define('DBHOST', 'localhost');// MySQL host address - localhost is usually fine
                          define('DBUSER', 'root'); // db username
                          define('DBPASS', '1234'); // db password
                          define('DBNAME', 'BDD'); // nombre de la base de datos creada previamente...

                          define('DEBUG', false);// set to false when done testing

                          define('CHARSET', 'utf8'); // sets the charset of your database for communication
                          define('DBDRIVER', 'mysql');// database driver to use
                          define('DBPORT', '3306'); // database port for connection

                          //definicion de las tablas
                          define('ASIGNATURA', 'Asignatura');
                          define('CONTENIDO', 'Contenido');
                          define('GUIA', 'Guia');
                          define('PREGUNTA', 'Pregunta');
                          define('REPOSITORIO', 'Repositorio');
                          define('RESPUESTA', 'SeleccionMultiple');
                          define('USUARIO', 'Usuario');
                          define('USUARIOASIGNATURA', 'UsuarioAsignatura');
                          ?>
                      