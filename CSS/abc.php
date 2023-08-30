<?php

@include 'connect.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   // $pass = md5($_POST['password']);
   // $cpass = md5($_POST['cpassword']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE name = '$name' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'Người dùng đã tồn tại!';

   }else{

      // if($pass != $cpass){
      //    $error[] = 'Mật khẩu không khớp!';
      // }else{
         $insert = "INSERT INTO user_form(name,password, email,  user_type) VALUES('$name','$pass','$email','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      // }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ĐĂNG KÍ</title>
   <link rel="stylesheet" href="./CSS/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>ĐĂNG KÍ</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      
      <input type="text" name="name" required placeholder="Tên của bạn">
      <input type="password" name="password" required placeholder="Mật khẩu">
      <!-- <input type="password" name="cpassword" required placeholder="Xác nhận mật khẩu"> -->
      <input type="email" name="email" required placeholder="Email của bạn">
      <select name="user_type">
         <option value="user">User</option>
         <option value="admin">Admin</option>
      </select>
      <input type="submit" name="submit" value="ĐĂNG KÍ" class="form-btn">
      <p>Bạn có sẵn sàng để tạo một tài khoản ?<a href="login_form.php">ĐĂNG NHẬP</a></p>
   </form>

</div>

</body>
</html>