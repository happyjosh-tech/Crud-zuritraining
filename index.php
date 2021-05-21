<?php
	$fullname="";
	$email="";
	$password="";
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		require_once'config.php';
		if(empty($fullname=$_POST['fullname']&& $email=$_POST['email'] && $password=$_POST['password'])){
			echo "<p style=\"color:red;\">couldnt submit an empty form...</p>";
			header("Location:index.php");
			exit();
		}
		else{
			$fullname=$_POST['fullname'];
			$email=$_POST['email'];
			$password=$_POST['password'];
			$phash = password_hash($password, PASSWORD_DEFAULT);

			$mysqli= $conn->prepare("INSERT INTO users (fullname,email,password) VALUES ( ?, ?, ?)");
			$mysqli->bind_param('sss', $fullname, $email, $phash);
			$mysqli->execute();

			header("Location:login.php");
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>REGISTER</title>
	<?php include("header.php"); ?>
</head>
<body>
	<style type="text/css">
		body{
			background: #FF00FF;
			color: black;
		}
		.register{
			position: fixed;
			top: 100px;
			left: 40%;
		}
	</style>
	<div class="register">
		<form method="POST" action="index.php">
			<div class="form-group">
				<label for="fullname">Full Name<span style="color: red;">*</span></label>
				<input type="text" class="form-control" id="fullname" name="fullname" required>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Email address<span style="color: red;">*</span></label>
				<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
			</div>
			<div class="form-group">
				<label for="password">Password<span style="color: red;">*</span></label>
			    <input type="password" class="form-control" id="password" name="password" required>
			</div>
			<button type="submit" class="btn btn-primary">Register</button>
			<p>Already a user? <a href="login.php">Login Here</a></p>
		</form>
	</div>
</body>
</html>