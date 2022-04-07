<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<style type="text/css">
			.Error {color:red;}
		</style>
		<title>New Contact</title>
	</head>
	<body>
		<!-- Container Start -->
		<div class="container">
			<div class="page-header">
				<h1>Add a New Contact</h1>
			</div>
			<?php

				#include database connection
				include"config/database.php";

				#Defining variables
				$Name = "";
				$NameErr = "";
				$Email = "";
				$EmailErr = "";
				$Phone = "";
				$PhoneErr = "";
				$Title = "";
				$TitleErr = "";

				#Set validation variables
				$isNameValid = false;
				$isEmailValid = false;
				$isPhoneValid = false;
				$isTitleValid = false;

				if ($_SERVER['REQUEST_METHOD']=="POST")
				{ #Start validation process for each entry.

					#Verify Name field is not empty.
					if (empty($_POST['Name']))
					{
						$NameErr = "ERROR: Name is required.";
						$isNameValid = false;
					}
					#Verify Name only contains letters and whitespace.
					else
					{
						$Name = sanitize_input($_POST['Name']);
						if (!preg_match("/^[a-zA-Z-' ]*$/", $Name))
						{
							$NameErr = "ERROR: Only letters and whitespace allowed.";
							$isNameValid = false;
						}
						else
						{
							$isNameValid = true;
						}
					}

					#Verify Email field is not empty.
					if (empty($_POST['Email']))
					{
						$EmailErr = "ERROR: Email is required.";
						$isEmailValid = false;
					}
					#Verify Email format is correct.
					else
					{
						$Email = sanitize_input($_POST['Email']);
						if (!preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$/", $Email))
						{
							$EmailErr = "ERROR: Must enter a valid email. Example: firstname.lastname@domain.com";
							$isEmailValid = false;
						}
						else
						{
							$isEmailValid = true;
						}
					}

					#Verify Phone field is not empty.
					if (empty($_POST['Phone']))
					{
						$PhoneErr = "ERROR: Phone number is required";
						$isPhoneValid = false;
					}
					#Verify phone number format is correct.
					else
					{
						$Phone = sanitize_input($_POST['Phone']);
						if (!preg_match("/^[+]?[1-9][0-9]{9,14}$/", $Phone))
						{
							$PhoneErr = "ERROR: Must enter a valid phone number.";
							$isPhoneValid = false;
						}
						else
						{
							$isPhoneValid = true;
						}
					}

					#Verify Title field is not empty.
					if (empty($_POST['Title']))
					{
						$TitleErr = "ERROR: Title is required.";
						$isTitleValid = false;
					}
					#Verify Title contains the correct characters
					else
					{
						$Title = sanitize_input($_POST['Title']);
						if (!preg_match("/^[a-zA-Z-'. ]*$/", $Title))
						{
							$TitleErr = "ERROR: Please enter a valid title. Example: Mr., Ms., Mrs., Dr., Etc.";
							$isTitleValid = false;
						}
						else
						{
							$isTitleValid = true;
						}
					}

					#Set the correct time zone.
					date_default_timezone_set("America/Chicago");

					#Set the creation time and date.
					$DateCreated = date("Y-m-d h:i:sa");

					#Set the modified time and date.
					$DateModified = date("Y-m-d h:i:sa");

					#Insert into the database
					if ($isNameValid && $isEmailValid && $isPhoneValid && $isTitleValid)
					{
						try
						{
							#Insert the Query
							$query = "INSERT INTO contacts SET Name = :Name, Email = :Email, Phone = :Phone, Title = :Title, Created_Date = :DateCreated, Modified_Date = :DateModified";

							#Prepare for Execution
							$stmt = $con -> prepare($query);

							$Name = htmlspecialchars(strip_tags($_POST['Name']));
							$Email = htmlspecialchars(strip_tags($_POST['Email']));
							$Phone = htmlspecialchars(strip_tags($_POST['Phone']));
							$Title = htmlspecialchars(strip_tags($_POST['Title']));

							#Bind the Parameters
							$stmt -> bindParam(':Name', $Name);
							$stmt -> bindParam(':Email', $Email);
							$stmt -> bindParam(':Phone', $Phone);
							$stmt -> bindParam(':Title', $Title);
							$stmt -> bindParam(':DateCreated', $DateCreated);
							$stmt -> bindParam(':DateModified', $DateModified);

							#Execute the Query
							if ($stmt -> execute())
							{
								echo '<div class="alert alert-success" role="alert"> Contact Added </div>';
							}
							else
							{
								echo '<div class="alert alert-warning" role="alert">ERROR: Contact entry failed. Please verify all data is correct then try again.</div>';
							}
						}
						catch (PDOException $e)
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
						<td>Title</td>
						<td>
							<input type="text" name="Title" class="form-control" value="<?php echo $Title ; ?>">
							<span class="Error"><?php echo $TitleErr ; ?></span>
						</td>
					</tr>
					<tr>
						<td>Name</td>
						<td>
							<input type="text" name="Name" class="form-control" value="<?php echo $Name ; ?>">
							<span class="Error"><?php echo $NameErr ; ?></span>
						</td>
					</tr>
					<tr>
						<td>Email Address</td>
						<td>
							<input type="text" name="Email" class="form-control" value="<?php echo $Email ; ?>">
							<span class="Error"><?php echo $EmailErr ; ?></span>
						</td>
					</tr>
					<tr>
						<td>Phone Number</td>
						<td>
							<input type="text" name="Phone" class="form-control" value="<?php echo $Phone ; ?>">
							<span class="Error"><?php echo $PhoneErr ; ?></span>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" value="Save" name="Submit" class="btn btn-success">
							<a href="index.php" class="btn btn-danger">Home</a>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<!-- Container End -->
	</body>
</html>