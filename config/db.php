<?php
class class_model {
    private string $host = "localhost";
    private string $user = "root";
    private string $pass = "";
    private string $dbname = "practice";
    private mysqli $mysqli;

    // Constructor - Establish MySQLi connection
    public function __construct() {
        $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    // CREATE: Insert new record
    public function createUser($student_id, $name,  $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (student_Id, name, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ssss", $student_id, $name, $email, $hashedPassword);

        return $stmt->execute();
    }

    // READ: Get all users
    public function getUsers() {
        $sql = "SELECT * FROM users";
        $result = $this->mysqli->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // READ: Get user by student ID
    public function getUserByStudentId(string $student_id) {
        $sql = "SELECT * FROM users WHERE student_Id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
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


    // READ: Get user by IDks
    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    // UPDATE: Update user details
    public function updateUser($id, $name, $email) {
        $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ssi", $name, $email, $id);

        return $stmt->execute();
    }

    // DELETE: Remove user
    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}
?>
