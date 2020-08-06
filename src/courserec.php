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
                        <h2 class = "pull-left">Friends' Recommendations</h2>
                        <!--<a href="create.php" class="btn btn-success pull-right">Add New Student</a>-->
                    </div>
                    <?php
                    // Include config file
                    
                    require_once "config.php";
                    
         /* Calling a PHP Function */
        
                // Attempt select query execution
                    $dep = $_GET['query'];
                    $sql = "
                            SELECT u.fr as fr, u.name as name, u.cr as cr
                            FROM
                                    ((SELECT Distinct r2.CourseId as fr, c.CourseName as name, c.Credits as cr
                                    FROM Reviews r JOIN Friends f ON (r.StudentId = f.StudentID) JOIN Reviews r2 ON (r2.StudentId = f.FriendID) JOIN Courses c ON (r2.CourseId = c.CourseId)
                                    WHERE r.StudentId = '$dep' AND r.Rating>=8)
                                    UNION
                                    (SELECT Distinct r.CourseId as fr, c.CourseName as name, c.Credits as cr
                                    FROM Reviews r JOIN Friends f ON (r.StudentId = f.StudentID) JOIN Courses c ON (r.CourseId = c.CourseId)
                                    WHERE f.FriendID = '$dep' AND r.Rating >= 8)) as u
                            WHERE u.fr NOT IN (SELECT CourseId FROM Reviews WHERE StudentId = '$dep')
                            ORDER BY u.fr, u.cr
                            

                            
                    ";
                    echo "<td>" . $result . "</td>";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>CourseID</th>";
                                        echo "<th>CourseName</th>";
                                        echo "<th>Credits</th>";
                                        // echo "<th>Department</th>";
                                        // echo "<th>Academic Standing</th>";
                                        // echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['fr'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['cr'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found. Maybe you do not have friends :( .</em></p>";
                        }
                    } else {
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
                    
                    
                    
                    
 
                    // Close connection
                   

                    ?>
                </div>
            </div>        
        </div>
    </div>
    
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class = "pull-left">Students Also Liked</h2>
                        <!--<a href="create.php" class="btn btn-success pull-right">Add New Student</a>-->
                    </div>
                    <?php
                    // Include config file
                    
                    require_once "config.php";
                    
         /* Calling a PHP Function */
        
                // Attempt select query execution
                    $dep2 = $_GET['query'];
                    $sql2 = "SELECT Distinct r.CourseId , c.CourseName, c.Credits
                             FROM   Reviews r JOIN Courses c ON (c.CourseId = r.CourseId)
                             WHERE  StudentId IN  (SELECT StudentId
                                                    FROM Reviews
                                                    WHERE CourseId IN (SELECT CourseId
                                                                         FROM Reviews
                                                                         WHERE StudentId = '$dep2' AND Rating >= 8 AND CourseId <> 'CS411') AND Rating >= 8)
                                                                         AND r.Rating >= 8 AND r.CourseId NOT IN (SELECT CourseId FROM Reviews WHERE StudentId = '$dep2')
                            ORDER BY r.CourseId, c.Credits
                            
                            

                            
                    ";
                    echo "<td>" . $result2 . "</td>";
                    if($result2 = mysqli_query($link, $sql2)){
                        if(mysqli_num_rows($result2) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>CourseID</th>";
                                        echo "<th>CourseName</th>";
                                        echo "<th>Credits</th>";
                                        // echo "<th>Department</th>";
                                        // echo "<th>Academic Standing</th>";
                                        // echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result2)){
                                    echo "<tr>";
                                        echo "<td>" . $row['CourseId'] . "</td>";
                                        echo "<td>" . $row['CourseName'] . "</td>";
                                        echo "<td>" . $row['Credits'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result2);
                        } else{
                            echo "<p class='lead'><em>No records were found. </em></p>";
                        }
                    } else {
                        echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);
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