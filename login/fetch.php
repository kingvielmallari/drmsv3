<?php

require_once '../config/db.php';  // Database connection

$classModel = new class_model();
$students = $classModel->getStudents();  // Fetch all students

foreach ($students as $student) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($student['student_id']) . '</td>';
    echo '<td>' . htmlspecialchars($student['first_name'] . ' ' . $student['middle_name'] . ' ' . $student['last_name']) . '</td>';
    echo '<td>' . htmlspecialchars($student['email']) . '</td>';
    echo '<td>' . htmlspecialchars($student['contact']) . '</td>';

    // Correct the PHP code inside the data-id attribute
    echo '<td>
            <button class="btn btn-danger btn-sm deleteBtn" data-id="' . htmlspecialchars($student['id']) . '">
                <i class="fas fa-trash">' . htmlspecialchars($student['id']) . '</i>
            </button>
          </td>';
    echo '</tr>';
}
?>
