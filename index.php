

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>
    <link rel="stylesheet" href="bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="app.css">
</head>
<body>
<div class="container d-flex vh-100">
    <div class="row justify-content-center align-self-center w-100">
        <div class="col-md-6">
            <h2 class="text-center">Login User</h2>

            <form id="userForm">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" id="floatingInput"placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
         
             

                
            </form>

            <p id="response" class="text-center mt-3 text-danger"></p>    </div>
    </div>
</div>

<div class="container text-center">
    <div class="row">
        <div class="col">
            First name
        </div>
        <div class="col">
            Middle Name
        </div>
        <div class="col">
            Last Name
        </div>
    </div>
</div>

.



<script src="../bootstrapv5/js/bootstrap.bundle.min.js"></script>
<script src="login/index.js"></script>



</body>
</html>
