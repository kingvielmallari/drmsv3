<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link rel="stylesheet" href="../bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../app.css">
</head>
<body>
    
                <h2 class="text-center">User List</h2>

               

                <div class="container-sm">
                <table class="table table-striped " id="userTable">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead> 

                    <tbody>
                        
                    </tbody>


                </table>
                </div>
                
                <p class="fw-bold text-uppercase">dsadsadsadsa</p>
           
              <a href="registrar">Link</a>
            </body>




<script src="../bootstrapv5/js/bootstrap.bundle.min.js"></script>
<script src="fetch.js"></script>
</body>
</html>
