<?php
class class_model {
    private string $host = "localhost";
    private string $user = "root";
    private string $pass = "";
    private string $dbname = "practice";
    private mysqli $mysqli;

    public function __construct() {
        $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public function createUser($student_id, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (student_Id, password) VALUES ( ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ss", $student_id, $hashedPassword);

        return $stmt->execute();
    }

    public function getStudents() {
        $sql = "SELECT * FROM students ORDER BY id ASC";
        $result = $this->mysqli->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }



    public function deleteStudent($student_id) {
        $sql = "DELETE FROM students WHERE student_id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $student_id);

       return $stmt->execute();
    }



    public function loginUsers($student_id, $password) {
        $sql = "SELECT * FROM users WHERE student_id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    

    public function addStudent($student_id, $last_name, $first_name, $middle_name, $email, $contact) {
        $sql = "INSERT INTO students (student_id, last_name, first_name, middle_name, email, contact) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ssssss", $student_id, $last_name, $first_name, $middle_name, $email, $contact);

        return $stmt->execute();

    }

    public function isStudentIdExists($student_id) {
        $sql = "SELECT * FROM students WHERE student_id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }
    public function isUserExistsByStudentId($student_id) {
        $sql = "SELECT * FROM users WHERE student_id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

}