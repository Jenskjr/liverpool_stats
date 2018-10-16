<?php

require 'some_connection.php';
require 'some_sql.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = $conn->query($sql);

if ($result->num_rows > 0) {

	$products_arr=array();
    $results_arr["results"]=array();

	while($row = $result->fetch_assoc()) {
    	
    	extract($row);

    	$product_item=array(
            "id" => $id,
            "year" => $year, 
            "position" => $position, 
            "games" => $games,
            "points" => $points, 
            "won" => $won, 
            "draws" => $draws, 
            "lost" => $lost, 
            "goal_diff" => $goal_diff
        );

        array_push($results_arr["results"], $product_item);
    }

    echo json_encode($results_arr);


} else {
    echo "0 results";
}

$conn->close();
?>



