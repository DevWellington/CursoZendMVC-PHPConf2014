<?php
/*
 * this is not function :( 
 * 
 * return array(    
    'db' => array(
	    'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=phpconf2014;host=localhost',
        'username' => 'root',
        'password' => ''
    ),
    'service_manager' => array(
	    'factories' => array(
            'DbAdapter' => 'Zend\Db\Adapter\AdapterServiceFactory'
        )
    )  
    
);*/

return array(
    'db' => array(
    	'driver' => 'PDO',
    	'dsn' => 'mysql:dbname=phpconf2014',
    	'username' => 'root',
    	'password' => 'root'
    )    
);