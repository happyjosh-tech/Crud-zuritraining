<?php 
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header ("Location: login.php");
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>WELCOME!</title>
	<?php include("header.php"); ?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
</head>
<body style="background: #FF00FF;">
	<p style="font-weight: 800; font-size: 70px; text-align: center; vertical-align: center; position: relative; top: 20px;">Welcome to Zuri-Training</p>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">Courses</h2>
                    <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Course</a>
                </div>
                <?php
	                require"config.php";
	               
	                $sql = "SELECT * FROM course";
	                if($result = mysqli_query($conn, $sql)){
	                    if(mysqli_num_rows($result) > 0){
	                        echo '<table class="table table-bordered table-striped">';
	                            echo "<thead>";
	                                echo "<tr>";
	                                    echo "<th>#</th>";
	                                    echo "<th>Name</th>";
	                                    echo "<th>Action</th>";
	                                echo "</tr>";
	                            echo "</thead>";
	                            echo "<tbody>";
	                            while($row = mysqli_fetch_array($result)){
	                                echo "<tr>";
	                                    echo "<td>" . $row['id'] . "</td>";
	                                    echo "<td>" . $row['name'] . "</td>";
	                                    echo "<td>";
	                                        echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip" style="color:black">View<span class="fa fa-eye"></span></a>';
	                                        echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip" style="color:black">Update<span class="fa fa-pencil"></span></a>';
	                                        echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip" style="color:black">Delete<span class="fa fa-trash"></span></a>';
	                                    echo "</td>";
	                                echo "</tr>";
	                            }
	                            echo "</tbody>";                            
	                        echo "</table>";
	                        mysqli_free_result($result);
	                    } 
	                    else{
	                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
	                    }
	                }
	                else{
	                    echo "Oops! Something went wrong. Please try again later.";
	                }
	                

	                	mysqli_close($conn);
            	?>
            </div>
        </div>        
    </div>
    <a href="logout.php" style="position: relative; left: 550px; top: 20px;"><button type="submit" class="btn btn-primary">SignOut</button></a>
    <?php
    echo '<a href="resetpassword.php?id='.$_SESSION['id'].'" style="position: relative; left: 600px; top: 20px;"><button type="submit" class="btn btn-primary">Reset Password</button></a>';
    ?>
</body>
</html>