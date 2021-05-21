<?php
require"config.php";
 
$name = "";

 
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST["name"];
    if(empty($name)){
        $msg = "Please enter a Coursename.";
    } 
    else{
        $name = $name;
    }
    
    if(empty($msg)){
        $mysqli= $conn->prepare("INSERT INTO course (name) VALUES (?)");
        $mysqli->bind_param('s', $name);
        $mysqli->execute();

        header("Location:welcome.php");
    }
    
    mysqli_close($conn);

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create</title>
<?php
require"header.php"


    ?>
</head>
<body style="background-color: #FF00FF">
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Course</h2>
                    <p>Please fill this form and submit to add Course record.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($msg)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $msg;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="welcome.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>