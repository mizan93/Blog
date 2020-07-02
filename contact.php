<?php include 'inc/header.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$firstname = $format->validation($_POST['firstname']);
	$lastname = $format->validation(($_POST['lastname']));
	$email = $format->validation(($_POST['email']));
	$body = $format->validation(($_POST['body']));

	$firstname = mysqli_real_escape_string($db->link, $firstname);
	$lastname = mysqli_real_escape_string($db->link, $lastname);
	$email = mysqli_real_escape_string($db->link, $email);
	$body = mysqli_real_escape_string($db->link, $body);

	$error='';
	if (empty($firstname)) {
		$error='First name must not be empty !';
	} elseif (empty($lastname)) {
		$error = 'Last name must not be empty !';
	}
	 elseif (empty($email)) {
		$error = 'Email field must not be empty !';
	
	 }
	//  elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	// 	$error = 'Invalid email address!';
	//  } 
	elseif (empty($body)) {
		$error = 'Message field must not be empty !';
	}else {
		$query = "INSERT INTO contact (firstname, lastname, email,body)
VALUES ('$firstname', '$lastname', '$email','$body')";
		$data = $db->insert($query);
		if ($data) {
			$msg='Data inserted successfully .';
		} else {
			$msg = 'Data not inserted ! ';

		}	
	}
}
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			
			<?php 
			if (isset($error)) {
				echo "<span style='color:red'>$error</span>";
			}
			if (isset($msg)) {
				echo "<span style='color:green'>$msg</span>";
			}
			?>

			<form action="" method="post">
				<table>
					<tr>
						<td>Your First Name:</td>
						<td>
							<input type="text" name="firstname" placeholder="Enter first name"  />
						</td>
					</tr>
					<tr>
						<td>Your Last Name:</td>
						<td>
							<input type="text" name="lastname" placeholder="Enter Last name"  />
						</td>
					</tr>

					<tr>
						<td>Your Email Address:</td>
						<td>
							<input type="email" name="email" placeholder="Enter Email Address"  />
						</td>
					</tr>
					<tr>
						<td>Your Message:</td>
						<td>
							<textarea name="body"></textarea>
						</td>
					</tr>
					
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit" value="Submit" />
						</td>
					</tr>
				</table>
				<form>
		</div>

	</div>
	
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>