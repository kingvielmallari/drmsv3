<?php include('components/header.php')

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="app.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  
</head>
<body>
<div class="container d-flex vh-100">
<div class="row justify-content-center align-self-center w-100">
<div class="col-md-6">
<h2 class="text-center">Create New DRMS Account</h2>
<p class="text-center text-muted">Make sure that your Student ID is registered in our school database to be able to create account.</p>
<form id="userForm">
    <div class="form-floating mb-3">
        <input type="text" class="form-control text-uppercase" name="student_id" id="student_id" placeholder="floatingStudentID" required oninput="this.value = this.value.toUpperCase();">
        <label for="floatingStudentID">Student ID</label>
    </div>
    <div class="form-floating mb-3 position-relative">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        <label for="password">Password</label>
        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword" style="cursor: pointer;"></i>
    </div>    
    <div class="form-floating mb-3">
        <input type="password" class="form-control" name="confirm_password" id="floatingConfirmPassword" placeholder="Confirm Password" required>
        <label for="floatingConfirmPassword">Confirm Password</label>
    </div>
    <p id="passwordError" class="text-danger text-center"></p>
    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </div>
</form>
<p id="response" class="text-center mt-3 "></p>
</div>
</div>
</div>
</div>


<script src="./login/add.js"></script>
</body>
</html>
