<?php
	require"config.php";
	$new_pass = "";
	if(isset($_POST["id"]) && !empty($_POST["id"])){
	    $id = $_POST["id"];
	    $new_pass = $_POST["new_pass"];
    	$phash = password_hash($new_pass, PASSWORD_DEFAULT);
    	
        $mysqli= $conn->prepare("UPDATE users SET password=? WHERE id=?");
		$mysqli->bind_param('si',$phash,$id);
		$mysqli->execute();
            
        header("location: welcome.php");

   
    }




?>
<!DOCTYPE html>
<html>
<head>
	<title>Password Reset</title>
</head>
<body>
	<style type="text/css">
		body{
			background: #FF00FF;
			color: black;
		}
		.newpassword{
			position: fixed;
			top: 200px;
			left: 40%;
		}
	</style>
	<div class="newpassword">
		<form class="login-form" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>"  method="post">
			<h2 class="form-title">New password</h2>
			<div class="form-group">
				<label>New password</label>
				<input type="password" name="new_pass">
			</div>
			
			<input type="hidden" name="id" value="<?php echo $id; ?>"/>
			<input type="submit" class="btn btn-primary" value="Submit">
            <a href="welcome.php" class="btn btn-secondary ml-2">Cancel</a>
		</form>
	</div>
</body>
</html>