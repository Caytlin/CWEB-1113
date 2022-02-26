<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>Students</title>
	</head>
	<body>
		<div class="container">
			<h2>
				Basic Table
				<div style='float: right;'>
					<a href="create.php" class="btn btn-primary">Create New</a>
				</div>
				<div>
					<?php
						$action=isset($_GET['action']) ? $_GET['action'] :"";
						if ($action == "deleted")
						{
							echo"<div class='alert alert-success'>Record deleted successfully.</div>";
						}
					?>
				</div>
			</h2>
			<table class="table">
				<head>
					<tr>
						<th>ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Student Email</th>
						<th>Student Phone</th>
						<th>Action</th>
					</tr>
				</head>
				<tbody>
					<?php
						#include database connection
						include"config/database.php";

						#select all data
						$query = "SELECT id, First_Name, Last_Name, Student_Email, Student_Phone From students ORDER by id ASC";
						
						#preparing the statement
						$stmt = $con -> prepare($query);
						$stmt -> execute();

						#$num = $stmt -> rowcount();
						#echo $num;

						while ($row = $stmt -> fetch(PDO :: FETCH_ASSOC))
						{
							extract($row);

							echo"<tr>";
								echo"<td>{$id}</td>";
								echo"<td>{$First_Name}</td>";
								echo"<td>{$Last_Name}</td>";
								echo"<td>{$Student_Email}</td>";
								echo"<td>{$Student_Phone}</td>";
								echo"<td>";
									echo"<a href='read.php?id={$id}' class='btn btn-primary btn-sm m-r-1em'>Read</a>";
									echo"<a href = '#' class='btn btn-warning btn-sm'>Edit</a>";
			                    	echo"<a href = '#' onclick ='delete_student({$id});' class='btn btn-danger btn-sm'>Delete</a>";
		                    	echo"</td>";
							echo"</tr>";
						}
					?>
				</tbody>
			</table>
		</div>
		<script>
			function delete_student(id)
			{
				var answer = confirm("Are you sure you want to delete this record?")
				if (answer)
				{
					window.location="delete.php?id="+id;
				}
			}
		</script>
	</body>
</html>