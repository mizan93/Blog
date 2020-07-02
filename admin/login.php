<?php include '../lib/session.php';
Session::checkLogin();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/format.php'; ?>
<?php
$db = new Database();
$format = new Format();

?>
<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
	<div class="container">

		<section id="content">
			<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$username1 = $format->validation($_POST['username']);
				$password1 = $format->validation(md5($_POST['password']));

				$username = mysqli_real_escape_string($db->link, $username1);
				$password = mysqli_real_escape_string($db->link, $password1);
				$query = "SELECT * FROM user_tbl WHERE username='$username' AND password='$password' ";
				$result = $db->select($query);

				if ($result == true) {
					$value = mysqli_fetch_array($result);
					$row = mysqli_num_rows($result);
					if ($row > 0) {
						Session::set("login", true);
						Session::set("username", $value['username']);
						Session::set("userId", $value['id']);
						Session::set("userRole", $value['role']);
						header("Location:index.php");
					} else {
						echo " <span style='color:red;font-size:18px;'>No result found !!.</span>";
					}
				} else {
					echo " <span style='color:red;font-size:18px;'>Username or password not matched !!.</span>";
				}
			}
			?>
			<form action="login.php" method="post">
				<h1>Admin Login</h1>
				<div>
					<input type="text" placeholder="Username" required="" name="username" />
				</div>
				<div>
					<input type="password" placeholder="Password" required="" name="password" />
				</div>
				<div>
					<input type="submit" name="login" value="Login" />
				</div>
			</form><!-- form -->
			<div class="button">
				<a href="forgetpassword.php">Forget Password</a>
			</div><!-- button -->
			<div class="button">
				<a href="#">Training with live project</a>
			</div><!-- button -->
		</section><!-- content -->
	</div><!-- container -->
</body>

</html>