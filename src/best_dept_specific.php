<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 1005px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <?php echo "<h2 class=\"pull-left\">Best in the " . $_GET['dept'] . " Department</h2>"; ?>
                        <!--<a href="create.php" class="btn btn-success pull-right">Add New Student</a>-->
                    </div>
                    <?php
                    // Include config file
                    
                    require_once "config.php";
                    
         /* Calling a PHP Function */
        
                // Attempt select query execution
                    $dep = $_GET['dept'];
                
                    $sql = "SELECT c.CourseId, c.CourseName, c.Department, ROUND(AVG(r.Rating),2) as Avg_ratings, count(*) as ct
                                          FROM Courses c JOIN Reviews r on (c.CourseId = r.CourseId)
                                          WHERE c.Department=\"" . $dep . "\"
                                          GROUP BY c.CourseId
                                          ORDER BY Avg_ratings DESC
                            ";
                    echo "<td>" . $result . "</td>";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Course ID</th>";
                                        echo "<th>Course Name</th>";
                                        echo "<th>Average Rating</th>";
                                        echo "<th>Enrollments</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['CourseId'] . "</td>";
                                        echo "<td>" . $row['CourseName'] . "</td>";
                                        echo "<td>" . $row['Avg_ratings'] . "</td>";
                                        echo "<td>" . $row['ct'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else {
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);

                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>