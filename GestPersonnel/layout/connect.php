<?php 
	$host = 'localhost';
	$user = 'root';
	$pass = '123456';
	$dbname   = 'gestpersonnel';
	$dsn = 'mysql:host='.$host.';dbname='.$dbname;

	// create a pdo intance
	$db = new PDO($dsn,$user,$pass);
	$db->SetAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,	PDO::FETCH_OBJ);
 ?>