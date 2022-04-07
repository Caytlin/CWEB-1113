<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>DELETE STUDENT RECORD</title>
	</head>
	<body>
		<?php
			#Include database connection
			include"config/database.php";

			$id=isset($_GET['id']) ? $_GET['id'] : die("ERROR: ID not found.");
			#echo $id;

			#Delete Query
			$query = "DELETE FROM students WHERE id=?";
			$stmt = $con -> prepare($query);
			$stmt -> bindParam(1,$id);
			$stmt -> execute();

			if ($stmt -> execute()) {
				header("Location: index.php?action=deleted");
			}
			else
			{
				die("ERROR: Unable to delete the record.");
			}

		?>
	</body>
</html>