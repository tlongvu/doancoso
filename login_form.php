<?php

@include 'connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $pass = $_POST['password'];
   // $cpass = md5($_POST['cpassword']);

   $select = " SELECT * FROM user_form WHERE name = '$name' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:Admin.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:index.php');

      }
     
   }else{
      $error[] = ' Tên hoặc mật khẩu không chính xác!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <link rel="stylesheet" href="./CSS/style.css">

</head>
<body>
   
<div class="form-container">
   <form action="" method="post">
      <h3>ĐĂNG NHẬP</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      
      <input type="name" name="name" required placeholder="Tên đăng nhập">
      <input type="password" name="password" required placeholder="Mật khẩu">
      <input type="submit" name="submit" value="ĐĂNG NHẬP" class="form-btn">
      <p>Bạn chưa có tài khoản? <a href="register_form.php">ĐĂNG KÍ</a></p>
   </form>

</div>

</body>
</html>