<?php
class class_model {
    private string $host = "localhost";
    private string $user = "root";
    private string $pass = "";
    private string $dbname = "practice2";
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

    public function getSpecificStudent($student_id) {
        $sql = "SELECT * FROM students WHERE student_id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
    
        return null;
    }
    

    public function updateStudentData($student_id, $last_name, $first_name, $middle_name, $email, $gender, $program, $year, $section, $status) {
        $sql = "UPDATE students SET last_name = ?, first_name = ?, middle_name = ?, email = ?, gender = ?, program = ?, year = ?, section = ?, status = ? WHERE student_id = ?";
        $stmt = $this->mysqli->prepare($sql);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("ssssssssss", $last_name, $first_name, $middle_name, $email, $gender, $program, $year, $section, $status,$student_id
        );
    
        return $stmt->execute();
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

    public function addRequest($studentId, $studentName, $programSection, $documentRequest, $deliveryOption, $appointmentDate, $appointmentTime, $totalPrice) {
        $sql = "INSERT INTO requests (student_id, student_name, program_section, document_request, delivery_option, appointment_date, appointment_time, total_price) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("sssssssd", $studentId, $studentName, $programSection, $documentRequest, $deliveryOption, $appointmentDate, $appointmentTime, $totalPrice);

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

    // public function loginStaff($username, $password) {
    //     $sql = "SELECT * FROM staff WHERE username = ?";
    //     $stmt = $this->mysqli->prepare($sql);
    //     $stmt->bind_param("s", $username);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $staff = $result->fetch_assoc();

    //     if ($staff && $password === $staff['password']) {
    //         return $staff;
    //     } else {
    //         return false;
    //     }
    // }

    public function loginStaff($username, $password) {
        $stmt = $this->mysqli->prepare("SELECT * FROM staff WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $staff = $result->fetch_assoc();
    
        if ($staff && $password === $staff['password']) {
                    return $staff;
                } else {
                    return false;
                }
    
        return false;
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

    // generate reset tokens to db
    public function cleanupExpiredTokens() {
        $query = "DELETE FROM password_resets WHERE expires_at < NOW()";
        return $this->mysqli->query($query);
    }
    
    public function saveResetToken($email, $token, $created_at, $expires_at) {
        $stmt = $this->mysqli->prepare("INSERT INTO password_resets (email, token, created_at, expires_at) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $token, $created_at, $expires_at);
        return $stmt->execute();
    }
    


    // find token in db
  public function findToken($token) {
    $stmt = $this->mysqli->prepare("
        SELECT * FROM password_resets 
        WHERE token = ? AND expires_at > NOW()
        LIMIT 1
    ");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc(); // returns false if not found
}


    public function findByEmail($email) {
        $stmt = $this->mysqli->prepare("SELECT * FROM students WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc(); // returns false if not found
    }
    
    // public function hasValidToken($email) {
    //     $stmt = $this->mysqli->prepare("SELECT * FROM password_resets WHERE email = ? AND expires_at > NOW() LIMIT 1");
    //     $stmt->bind_param("s", $email);
    //     $stmt->execute();
    //     return $stmt->get_result()->fetch_assoc(); // returns row if valid token exists
    // }
    
    public function deleteToken($token) {
        $stmt = $this->mysqli->prepare("DELETE FROM password_resets WHERE token = ?");
        $stmt->bind_param("s", $token);
        return $stmt->execute();
    }
    
    public function hasValidToken($email) {
        $stmt = $this->mysqli->prepare("SELECT * FROM password_resets WHERE email = ? AND expires_at > NOW() LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc(); // returns row if valid token exists
    }
}