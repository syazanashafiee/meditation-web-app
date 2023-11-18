<?php

@include 'meditation-header.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style_logreg.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>hi, <span>admin</span></h3>
      <h1>welcome <span><?php echo $_SESSION['admin_name'] ?></span></h1>
      <p>this is an admin page</p>
     
      <a href="http://localhost/meditation/admin_guidedmeditation.php" class="btn">admin library</a>
      <a href="http://localhost/meditation/userList.php" class="btn">list name</a>
      <a href="http://localhost/meditation/noindex.html" class="btn">logout</a>
   </div>

</div>

</body>
</html>