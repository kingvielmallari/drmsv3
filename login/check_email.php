<?php
require_once '../models/class_model.php';

$classModel = new class_model();
$users = $classModel->checkEmailExists($email);

echo json_encode($users); // Return data as JSON for frontend use
?>
