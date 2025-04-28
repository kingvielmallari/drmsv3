<?php

require_once '../config/db.php'; // Include your class

$cm = new class_model(); // Create an instance of your class


$result = $cm->getCertifications(); // Call the method to get toggles 


if($result){
    echo json_encode($result); // Return the result as JSON
}