<?php

class connection {
	
	function connect()
	{
		try {
			$pdo = new PDO("mysql:host=localhost;dbname=sim", 'root', '');
			//set PDO error mode to exception
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $pdo;
			
		} catch (PDOException $e) {
			echo "Connection Failed: " . $e->getMessage();
		}
	}
}
