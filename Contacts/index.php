<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<title>Contacts</title>
	</head>
	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand active" href="../index.php">Home</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li><a href="../Students/index.php">Students</a></li>
						<li><a href="../Customers/index.php">Customers</a></li>
						<li class="active"><a href="Contacts/index.php">Contacts</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<h2>
				<!-- To refresh and get rid of the delete alert I've created a refresh link.-->
				<a href="index.php">Contacts</a>
				<div style='float: right;'>
					<a href="create.php" class="btn btn-primary">Add New Contact</a>
				</div>
				<div>
					<?php
						$action=isset($_GET['action']) ? $_GET['action'] :"";
						if ($action == "deleted")
						{
							echo"<div class='alert alert-success'>Contact deleted successfully.</div>";
						}
					?>
				</div>
			</h2>
			<table class="table">
				<head>
					<tr>
						<th>ID</th>
						<th>Title</th>
						<th>Name</th>
						<th>Email Address</th>
						<th>Phone Number</th>
						<th>Date Created</th>
						<th>Date Modified</th>
						<th>Action</th>
					</tr>
				</head>
				<tbody>
					<?php

						#Include Database Connection
						include"config/database.php";

						$query = "SELECT id, Name, Email, Phone, Title, Created_Date, Modified_Date From contacts ORDER by id ASC";
						
						$stmt = $con -> prepare($query);
						
						$stmt -> execute();

						while ($row = $stmt -> fetch(PDO :: FETCH_ASSOC))
						{
							extract($row);

							echo"<tr>";
								echo"<td>{$id}</td>";
								echo"<td>{$Title}</td>";
								echo"<td>{$Name}</td>";
								echo"<td>{$Email}</td>";
								echo"<td>{$Phone}</td>";
								echo"<td>{$Created_Date}</td>";
								echo"<td>{$Modified_Date}</td>";
								echo"<td>";
									echo"<a href='read.php?id={$id}' class='btn btn-primary btn-sm m-r-1em'>Read</a>";
									echo"<a href = 'update.php?id={$id}' class='btn btn-warning btn-sm'>Edit</a>";
			                    	echo"<a href = '#' onclick ='delete_contact({$id});' class='btn btn-danger btn-sm'>Delete</a>";
		                    	echo"</td>";
							echo"</tr>";
						}
					?>
				</tbody>
			</table>
		</div>
		<script>
			function delete_contact(id)
			{
				var answer = confirm("Are you sure you want to delete this contact?");
				if (answer)
				{
					window.location="delete.php?id="+id;
				}
			}
		</script>
	</body>
</html>