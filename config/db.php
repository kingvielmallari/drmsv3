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

    public function updateRequest($request_id, $date_releasing, $processing_officer, $status) {
        $sql = "UPDATE requests SET date_releasing = ?, processing_officer = ?, status = ? WHERE request_id = ?";
        $stmt = $this->mysqli->prepare($sql);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("ssss", $date_releasing, $processing_officer, $status, $request_id);

        return $stmt->execute();
    }

    public function getUserByEmail($email) {
        $stmt = $this->mysqli->prepare("SELECT * FROM students WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?: null;
    }
   

    public function updateUserPassword($input, $confirm_password) {
        $hashedPassword = password_hash($confirm_password, PASSWORD_DEFAULT);

        $sql = "UPDATE students SET password = ? WHERE student_id = ? OR email = ?";
        $stmt = $this->mysqli->prepare($sql);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("sss", $hashedPassword, $input, $input);

        return $stmt->execute();
    }

    public function getDocumentById($document_id){
        $sql ="SELECT * FROM documents WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $document_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createUser($last_name, $first_name, $middle_name, $email, $year_graduated, $last_year_attended, $status, $password, $gender) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
        $sql = "INSERT INTO students (last_name, first_name, middle_name, year_graduated, last_year_attended, status, password, email, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("sssssssss", $last_name, $first_name, $middle_name, $year_graduated, $last_year_attended, $status, $hashedPassword, $email, $gender);

        return $stmt->execute();
    }

    public function getStudents() {
        $sql = "SELECT * FROM students ORDER BY id ASC";
        $result = $this->mysqli->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllRequests() {
        $sql = "SELECT * FROM requests ORDER BY id ASC";
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

    public function doesRequestIdExist($requestId) {
        $query = "SELECT COUNT(*) as count FROM requests WHERE request_id = ?";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("s", $requestId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'] > 0;
    }

    public function getSpecificRequest($student_id) {
        $sql = "SELECT * FROM requests WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $student_id);
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
 

   
    
    public function createDocument($code, $name, $price, $is_available, $eta) {
        $sql = "INSERT INTO documents (code, name, price, is_available, eta) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("ssdss", $code, $name, $price, $is_available, $eta);
        return $stmt->execute();
    }
    

    public function getStudentIdByEmail($email) {
        $stmt = $this->mysqli->prepare("SELECT student_id FROM students WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($studentId);
        $stmt->fetch();
        $stmt->close();

        return $studentId ?: null;
    }


    public function deleteStudent($student_id) {
        $sql = "DELETE FROM students WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $student_id);

       return $stmt->execute();
    }

    public function deleteDocument($deleteDocumentId) {
        $sql = "DELETE FROM documents WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("i", $deleteDocumentId);
        return $stmt->execute();
    }

    public function deleteRequest($deleteRequest) {
        $sql = "DELETE FROM requests WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("i", $deleteRequest);
        return $stmt->execute();
    }


    public function addRequest($requestId, $studentId, $studentName, $email, $programSection, $documentsArray, $deliveryOption, $appointmentDate, $appointmentTime, $totalPrice) {
        if (is_array($documentsArray)) {
            $documentsArray = implode(", ", $documentsArray); // Convert array to string if necessary
        }
        $sql = "INSERT INTO requests (request_id, student_id, student_name, email, program_section, document_request, delivery_option, appointment_date, appointment_time, total_price) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("sssssssssd", $requestId, $studentId, $studentName, $email, $programSection, $documentsArray, $deliveryOption, $appointmentDate, $appointmentTime, $totalPrice);

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
    }
    
    

    public function loginUsers($input, $password) {
        $stmt = $this->mysqli->prepare("SELECT * FROM students WHERE student_id = ? OR email = ? LIMIT 1");
        $stmt->bind_param("ss", $input, $input);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                return $row; // login success
            }
        }

        return false; // login failed
    }

    public function getRequestRecords($email) {
        $sql = "SELECT * FROM requests WHERE email = ? ORDER BY created_at DESC";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getRequestRecordsStaff() {
        $sql = "SELECT * FROM requests ORDER BY created_at DESC";
        $result = $this->mysqli->query($sql);
        return $result;
    }



   

    public function getrequestdetails($id) {
        $sql = "SELECT * FROM requests WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
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

    public function getRequest($student_id) {
        $sql = "SELECT * FROM requests WHERE student_id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

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