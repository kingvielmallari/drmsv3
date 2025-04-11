<?php
class class_model {
    private string $host = "localhost";
    private string $user = "root";
    private string $pass = "";
    private string $dbname = "practice";
    private mysqli $mysqli;




    public function __construct()
    {
        $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }


    }

    public function getUserByEmail($email) {
        $stmt = $this->mysqli->prepare("SELECT * FROM students WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?: null;
    }
   

    public function updateUserPassword($student_id, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE students SET password = ? WHERE student_id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ss", $hashedPassword, $student_id);

        return $stmt->execute();
    }

    public function getStudents() {
        $sql = "SELECT * FROM students ORDER BY id ASC";
        $result = $this->mysqli->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getStudentByEmail($email) {
        $sql = "SELECT * FROM students WHERE email = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

  


    public function deleteStudent($student_id) {
        $sql = "DELETE FROM students WHERE student_id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $student_id);

       return $stmt->execute();
    }

    
    public function deleteDocument($id) {
        $sql = "DELETE FROM documents WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);

       return $stmt->execute();
    }

    public function insertSelectedItem($item_name) {
        if (is_array($item_name)) {
            $item_name = implode(", ", $item_name); // Convert array to string if necessary
        }
        $sql = "INSERT INTO requests (name) VALUES (?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $item_name);

        return $stmt->execute();
    }


    public function loginUsers($student_id, $password) {
        $sql = "SELECT * FROM students WHERE student_id = ?";
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
        $sql = "SELECT password FROM students WHERE student_id = ? AND password IS NOT NULL";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    public function getDocuments() {
        $sql = "SELECT * FROM documents";
        $result = $this->mysqli->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getFees() {
        $sql = "SELECT * FROM fees";
        $result = $this->mysqli->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }



}