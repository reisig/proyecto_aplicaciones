<?php
                          /*
                              Script de configuracion de la base de datos MySQL
                              Lleva el host, puerto, usuario, password y nombre de la base de datos

                              Ademas de otras opciones
                          */

                          define('DBHOST', 'localhost');// MySQL host address - localhost is usually fine
                          define('DBUSER', 'root'); // db username
                          define('DBPASS', '1234'); // db password
                          define('DBNAME', 'asdasd'); // nombre de la base de datos creada previamente...

                          define('DEBUG', false);// set to false when done testing

                          define('CHARSET', 'utf8'); // sets the charset of your database for communication
                          define('DBDRIVER', 'mysql');// database driver to use
                          define('DBPORT', '3306'); // database port for connection
                          ?>
                      