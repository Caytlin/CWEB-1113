<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<style type="text/css">
			.Error {color:red;}
		</style>
		<title>PDO: Create a Record</title>
	</head>
	<body>
		<!-- Container Start -->
		<div class="container">
			<div class="page-header">
				<h1>Create New Student Record</h1>
			</div>
			<?php

				#include database connection
				include"config/database.php";

				$Fname = "";
				$fnameErr = "";
				$Lname = "";
				$lnameErr = "";
				$Email = "";
				$emailErr = "";
				$Phone = "";
				$phoneErr = "";
				$isFnameValid = false;
				$isLnameValid = false;
				$isEmailValid = false;
				$isPhoneValid = false;

				if ($_SERVER['REQUEST_METHOD']=="POST") {
					#Validate empty or less than 6 characters
					if (empty($_POST['fname']))
					{
						$fnameErr="First Name is required";
						$isFnameValid = false;
					}
					else
					{
						#Check if name only contains letters and whitespace.
						$Fname=sanitize_input($_POST['fname']);
						if (!preg_match("/^[a-zA-Z-' ]*$/", $Fname))
						{
							$fnameErr="Only letters and whitespace allowed";
							$isFnameValid = false;
						}
						else
						{
							$isFnameValid = true;
						}
					}

					#Validate Last Name
					if (empty($_POST['lname'])) {
						$lnameErr="Last name is required";
						$isLnameValid = false;
					}
					else
					{
						#Check if name only contains letters and whitespace.
						$Lname=sanitize_input($_POST['lname']);
						if (!preg_match("/^[a-zA-Z-' ]*$/", $Lname)) {
							$lnameErr="Only letters and whitespace allowed";
							$isLnameValid = false;
						}
						else
						{
							$isLnameValid = true;
						}
					}
					
					#Validate email
					if (empty($_POST['email'])) {
						$emailErr="email is required";
						$isEmailValid = false;
					}
					else
					{
						$Email=sanitize_input($_POST['email']);
						if (!preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$/", $Email)){
							$emailErr="Must enter a valid email. Example: firstname.lastname@domain.com";
							$isEmailValid = false;
						}
						else {
							$isEmailValid = true;
						}
					}

					#Validate phone number
					if (empty($_POST['phone'])) {
						$phoneErr="Phone number is required";
						$isPhoneValid = false;
					}
					else
					{
						$Phone=sanitize_input($_POST['phone']);
						if (!preg_match("/^[+]?[1-9][0-9]{9,14}$/", $Phone)) {
							$phoneErr="Must enter a valid phone number.";
							$isPhoneValid = false;
						}
						else
						{
							$isPhoneValid = true;
						}
					}

					if ($isFnameValid && $isLnameValid && $isEmailValid && $isPhoneValid)
					{
						try
						{
							#Insert Query
							$query= "INSERT INTO students SET First_Name=:fname, Last_Name=:lname, Student_Email=:email, Student_Phone=:phone";

							#Prepare query for execution
							$stmt = $con -> prepare($query);

							$Fname = htmlspecialchars(strip_tags($_POST['fname']));
							$Lname = htmlspecialchars(strip_tags($_POST['lname']));
							$Email = htmlspecialchars(strip_tags($_POST['email']));
							$Phone = htmlspecialchars(strip_tags($_POST['phone']));

							#Bind parameters
							$stmt -> bindParam(':fname',$Fname);
							$stmt -> bindParam(':lname',$Lname);
							$stmt -> bindParam(':email',$Email);
							$stmt -> bindParam(':phone',$Phone);

							#Execute query

							if ($stmt -> execute())
							{
								Echo '<div class="alert alert-success" role="alert"> Entry Successful </div>';
							}
							else
							{
								echo '<div class="alert alert-warning" role="alert">Entry failed. Please verify data is correct and resubmit.</div>';
							}
						}
						catch(PDOException $e)
						{
							echo "ERROR: ".$e -> getMessage();
						}
					}
				}

				function sanitize_input ($data)
				{
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;
				}
			?>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				<table class="table table-hover table-responsive table-bordered">
					<tr>
						<td>First Name</td>
						<td>
							<input type="text" name="fname" class="form-control" value="<?php echo $Fname ;?>">
							<span class="Error"><?php echo $fnameErr ;?> </span>
						</td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td>
							<input type="text" name="lname" class="form-control" value="<?php echo $Lname ;?>">
							<span class="Error"><?php echo $lnameErr ;?> </span>
						</td>
					</tr>
					<tr>
						<td>Student Email</td>
						<td>
							<input type="text" name="email" class="form-control" value="<?php echo $Email ;?>">
							<span class="Error"><?php echo $emailErr ;?> </span>
						</td>
					</tr>
					<tr>
						<td>Student Phone</td>
						<td>
							<input type="text" name="phone" class="form-control" value="<?php echo $Phone ;?>">
							<span class="Error"><?php echo $phoneErr ;?> </span>
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="Save" name="Submit" class="btn btn-primary"> <a href="index.php" class="btn btn-danger">Home</a></td>
					</tr>
				</table>
			</form>
		</div>
		<!-- Container End -->
	</body>
</html>