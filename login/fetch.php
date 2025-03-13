<?php

require_once '../db.php';

$classModel = new class_model();

$users = $classModel->getUsers();


foreach ($users as $user) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($user['id']) . '</td>';
    echo '<td>' . htmlspecialchars($user['name']) . '</td>';
    echo '<td>' . htmlspecialchars($user['email']) . '</td>';
    echo '</tr>';
}

?>
