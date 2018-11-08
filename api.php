<?php

require 'some_connection.php';
require 'some_sql.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// return an array with the latest premier league results
if (isset($_GET['pl_results'])) {

    $results = $conn->query($sql_pl_results);

    if ($results->num_rows > 0) {

        // creaete a container array
        $results_arr["results"]=array();

    	while($row = $results->fetch_assoc()) {
        	
        	extract($row);

        	$stats_item=array(
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

            array_push($results_arr["results"], $stats_item);
        }

        echo json_encode($results_arr);

    } else {
        echo "no results found";
    }
}
// return an array with titles won 
elseif (isset($_GET['titles'])) {

    $titles = $conn->query($sql_titles);

    if ($titles->num_rows > 0) {

        // create a contaner array
        $titles_arr["titles"]=array();

        while($row = $titles->fetch_assoc()) {
        
        extract($row);

        $title_list=array(
            "id" => $id,
            "title_name" => $title_name, 
            "title_count" => $title_count
        );

        array_push($titles_arr["titles"], $title_list);
    }
    echo json_encode($titles_arr);
    
    } else {
        echo "no results found";
    }
} 

// default response if neither ?pl_results or ?titles
else {
        echo "no results found";
}

$conn->close();
?>



