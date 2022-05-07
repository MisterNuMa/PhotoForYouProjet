<?php
	include('config.php');

	try {
	    $db = new PDO($dsn, $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(Exception $e) {
	    die('Erreur : '.$e->getMessage());
	}
?>