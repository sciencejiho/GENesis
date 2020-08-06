<html>
<body>
<TITLE>Query results</TITLE>
<H3>Query results</H3>

<?php 
    $host    = "localhost";
    $user    = "cs411genesis_root";
    $pass    = "pZ*DiD?=LsEr";
    $db_name = "cs411genesis_root";
    
    //create connection
    $connection = mysqli_connect($host, $user, $pass, $db_name) or die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
    
    //test if connection failed
    if(mysqli_connect_errno()){
        die("connection failed: "
            . mysqli_connect_error()
            . " (" . mysqli_connect_errno()
            . ")");
    }
    
    //get results from database
    $result = mysqli_query($connection, $_GET["query1"]);
    $all_property = array();  //declare an array for saving property
    
    //die if error
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $_GET["query1"];
        die($message);
    }
    
    //showing property
    echo '<table class="data-table">
            <tr class="data-heading">';  //initialize table tag
    while ($property = mysqli_fetch_field($result)) {
        echo '<td>' . $property->name . '</td>';  //get field name for header
        array_push($all_property, $property->name);  //save those to array
    }
    echo '</tr>'; //end tr tag
    
    //showing all data
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        foreach ($all_property as $item) {
            echo '<td>' . $row[$item] . '</td>'; //get items using property value
        }
        echo '</tr>';
    }
    echo "</table>";
?>

</body>
</html>
