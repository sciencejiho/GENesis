<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$studentid = $firstname = $lastname = $department = $standing = "";
$studentid_err = $firstname_err = $lastname_err = $department_err = $standing_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate student ID
    $input_studentid = trim($_POST["studentid"]);
    if(empty($input_studentid)){
        $studentid_err = "Please enter student ID.";
    //} elseif(!filter_var($input_studentid, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    //    $studentid_err = "Please enter a valid name.";
    } else{
        $studentid = $input_studentid;
    }
    
    // Validate first name
    $input_firstname = trim($_POST["firstname"]);
    if(empty($input_firstname)){
        $firstname_err = "Please enter first name.";     
    } else{
        $firstname = $input_firstname;
    }
    
    // Validate last name
    $input_lastname = trim($_POST["lastname"]);
    if(empty($input_lastname)){
        $lastname_err = "Please enter last name.";     
    } else{
        $lastname = $input_lastname;
    }
    
    // Validate department
    $input_department = trim($_POST["department"]);
    if(empty($input_department)){
        $department_err = "Please enter department.";     
    } else{
        $department = $input_department;
    }
    
    // Validate academic standing
    $input_standing = trim($_POST["standing"]);
    if(empty($input_standing)){
        $standing_err = "Please enter the academic standing.";     
    } elseif(!ctype_digit($input_standing)){
        $standing_err = "Please enter a positive integer value.";
    } else{
        $standing = $input_standing;
    }
    
    // Check input errors before inserting in database
    if(empty($studentid_err) && empty($firstname_err) && empty($lastname_err) && empty($department_err) && empty($standing_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO Students (StudentId, FirstName, LastName, Department, Standing) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_studentid, $param_firstname, $param_lastname, $param_department, $param_standing);
            
            // Set parameters
            $param_studentid = $studentid;
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_department = $department;
            $param_standing = $standing;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: studentinfo.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add student record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($studentid_err)) ? 'has-error' : ''; ?>">
                            <label>Student ID</label>
                            <input type="text" name="studentid" class="form-control" value="<?php echo $studentid; ?>">
                            <span class="help-block"><?php echo $studentid_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                            <label>First Name</label>
                            <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                            <span class="help-block"><?php echo $firstname_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                            <label>Last Name</label>
                            <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                            <span class="help-block"><?php echo $lastname_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($department_err)) ? 'has-error' : ''; ?>">
                            <label>Department</label>
                            <input type="text" name="department" class="form-control" value="<?php echo $department; ?>">
                            <span class="help-block"><?php echo $department_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($standing_err)) ? 'has-error' : ''; ?>">
                            <label>Academic Standing</label>
                            <input type="text" name="standing" class="form-control" value="<?php echo $standing; ?>">
                            <span class="help-block"><?php echo $standing_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="studentinfo.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>