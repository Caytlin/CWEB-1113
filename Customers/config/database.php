<?php
	$host = "localhost";
	$dbName = "lindelandcweb1113";
	$userName = "root";
	$password = "";
	try
	{
		$con = new PDO("mysql:host={$host};dbname={$dbName}",$userName, $password);
		#echo "Connection Successful";
	}

	catch (Exception $e)
	{
		echo "Connection Error:". $e -> getMessage();
	}

?>