<?php

require 'functions.php';

if (isset($_POST["login"])) {

   $username = $_POST["username"];
   $password = $_POST["password"];

   $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");

   if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row["password"])) {
         header("Location: index.php");
         exit;
      }
   }

   $error = true;
}

?>

<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Sign In Page</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

   <div class="container vh-100 d-flex align-items-center justify-content-center flex-column">
      <div class="row">
         <div class="col">
            <div class="card" style="width: 24rem;">
               <div class="card-body">
                  <form action="" method="post">
                     <div class="mb-3 row d-flex justify-content-center">
                        <label for="" class="col-sm-11 col-form-label fs-2 fw-medium text-center user-select-none">Sign In</label>
                     </div>
                     <div class="mb-3 row d-flex justify-content-center">
                        <div class="col-sm-11">
                           <input type="text" class="form-control user-select-none" name="username" placeholder="Username" required>
                        </div>
                     </div>
                     <div class="mb-3 row d-flex justify-content-center">
                        <div class="col-sm-11">
                           <input type="password" class="form-control user-select-none" name="password" placeholder="Password">
                        </div>
                     </div>
                     <div class="row d-flex justify-content-center">
                        <div class="col-sm-11">
                           <?php if (isset($error)) : ?>
                              <p class="col-sm-12 text-danger fst-italic"> <?= "Username atau Password tidak sesuai"; ?> </p>
                           <?php endif; ?>
                        </div>
                     </div>
                     <div class="mb-5 row d-flex justify-content-center">
                        <div class="col-sm-11">
                           <button type="submit" class="btn btn-primary col-sm-12" name="login">Login</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>