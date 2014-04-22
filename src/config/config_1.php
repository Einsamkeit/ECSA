<?php

/*
 *  Archivo de Configuracion Sistema ECSA
 */

return array(
    // --> Prefix de la aplicacion
    'prefix' => 'ecsa',
    
    // --> Conexion a la base de datos
    'connections' => array(
        'mysql' => array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'ecco',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => 'ecsa_',
        ),
    ),
    
    // Configuracion de las Imagenes
    'image' => array(
        'path'      => 'organizations/',
        'width'     => 300,
        'height'    => 300
    ),
    
    // -> Nombre de la Compania
    'company' => 'Comercializadora Ecco',
    
    // --> Creadores
    'authors' => array(
        'first' =>array( 
            'name'      => 'Cristian',
            'last_name' => 'Moreno D&iacute;az'
        ),
        'second' => array(
            'name'      => 'Edgardo',
            'last_name' => 'Troche Soriano'
        ),
    ),
    
    // Nombre de la Aplicaion
    'app'   => 'Sistema ECSA'
);