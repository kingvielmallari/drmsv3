<?php

require_once '../config/db.php';

$classModel = new class_model();

$users = $classModel->getUsers();


foreach ($users as $user) {
    echo '<tr>';
    static $id = 1;
    echo '<td>' . $id++ . '</td>';
    echo '<td>' . htmlspecialchars($user['name']) . '</td>';
    echo '<td>' . htmlspecialchars($user['email']) . '</td>';
    echo '</tr>';
}

?>
