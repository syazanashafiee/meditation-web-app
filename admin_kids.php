<?php

@include 'meditation-header.php';

if(isset($_POST['add_library_kids'])){
   $l_name = $_POST['l_name'];
   $l_description = $_POST['l_description'];
   $l_video = $_FILES['l_video']['name'];
   $l_video_tmp_name = $_FILES['l_video']['tmp_name'];
   $l_video_folder = 'uploaded_img/'.$l_video;

   $insert_query = mysqli_query($connect, "INSERT INTO `library_kids`(name, video, description) VALUES('$l_name','$l_video', '$l_description')") or die('query failed');

   if($insert_query){
      move_uploaded_file($l_video_tmp_name, $l_video_folder);
      $message[] = 'library add succesfully';
   }else{
      $message[] = 'could not add the library';
   }
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($connect, "DELETE FROM `library_kids` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:admin_kids.php');
      $message[] = 'library has been deleted';
   }else{
      header('location:admin_kids.php');
      $message[] = 'library could not be deleted';
   };
};

if(isset($_POST['update_library_kids'])){
   $update_l_id = $_POST['update_l_id'];
   $update_l_name = $_POST['update_l_name'];
   $update_l_description = $_POST['update_l_description'];
   $update_l_video = $_FILES['update_l_video']['name'];
   $update_l_video_tmp_name = $_FILES['update_l_video']['tmp_name'];
   $update_l_video_folder = 'uploaded_img/'.$update_l_video;

   $update_query = mysqli_query($connect, "UPDATE `library_kids` SET name = '$update_l_name', video = '$update_l_video', description = '$update_l_description' WHERE id = '$update_l_id'");

   if($update_query){
      move_uploaded_file($update_l_video_tmp_name, $update_l_video_folder);
      $message[] = 'library updated succesfully';
      header('location:admin_kids.php');
   }else{
      $message[] = 'library could not be updated';
      header('location:admin_kids.php');
   }

}

?>

<!DOCTYPE html>

<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Kids</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style_library.css">

</head>
<body>

<header class="header">

   <div class="flex">

<img src="images/kk.png" width="60" height="60" alt="meditation"/>
      

      <nav class="navbar">
         
      <a href="http://localhost/meditation/admin_guidedmeditation.php">Guided </a>
                    <a href="http://localhost/meditation/admin_mentalhealth.php">Mental</a>
                    <a href="http://localhost/meditation/admin2.php">Breath</a>
                    <a href="http://localhost/meditation/admin_sleep.php">Sleep</a>
                    <a href="http://localhost/meditation/admin_mindfulness.php">Mindfulness</a>
                    <a href="http://localhost/meditation/admin_yoga.php">Yoga</a>
                    <a href="http://localhost/meditation/admin_silent.php">Silent Retreats</a>
                    <a href="http://localhost/meditation/admin_loving.php">Loving Kindness</a>
                    <a href="http://localhost/meditation/admin_islam.php">Islam </a>
                    <a href="http://localhost/meditation/admin_focus.php">Focus </a>
                    <a href="http://localhost/meditation/admin_kids.php">Kids</a>
                    <a href="http://localhost/meditation/admin_quotes.php">Quotes</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="http://localhost/meditation/admin_page.php">ADMIN</a>
					<a href="http://localhost/meditation/library_kids.php">LIBRARY</a>
          
      </nav>
	  
	  </div>
	  
	  </header>
	  
	  <h1 class="heading">KIDS</h1>
   
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'meditation-header.php'; ?>

<div class="container">

<section>

<form action="" method="post" class="add-library-form" enctype="multipart/form-data">
   <h3>add a new library</h3>
   <input type="text" name="l_name" placeholder="enter the library name" class="box" required>
   <input type="text" name="l_description" placeholder="enter the library description" class="box" required>
   <input type="file" name="l_video" accept="video/mp4, video/webm, video/avi, video/flv" class="box" required>
   <input type="submit" value="add the library" name="add_library_kids" class="btn">
</form>

</section>

<section class="display-product-table">

   <table>

      <thead>
         <th>library video</th>
         <th>library name</th>
		 <th>library description</th>
         <th>action</th>
      </thead>

     <tbody>
   <?php
   $select_library_kids = mysqli_query($connect, "SELECT * FROM `library_kids`");
   if(mysqli_num_rows($select_library_kids) > 0){
      while($row = mysqli_fetch_assoc($select_library_kids)){
   ?>

   <tr>
      <td>
         <video width="320" height="240" controls>
            <source src="uploaded_img/<?php echo $row['video']; ?>" type="video/mp4">
            Your browser does not support the video tag.
         </video>
      </td>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['description']; ?></td> <!-- Add this line to display the description -->
      <td>
         <a href="admin_kids.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this?');">
            <i class="fas fa-trash"></i> Delete
         </a>
         <a href="admin_kids.php?edit=<?php echo $row['id']; ?>" class="option-btn">
            <i class="fas fa-edit"></i> Update
         </a>
      </td>
   </tr>

   <?php
      };
   } else {
      echo "<div class='empty'>No library added</div>";
   }
   ?>
</tbody>

   </table>

</section>


<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($connect, "SELECT * FROM `library_kids` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <video controls width="320" height="240">
          <source src="uploaded_img/<?php echo $fetch_edit['video']; ?>" type="video/mp4">
		   Your browser does not support the video tag.
    </video>
      <input type="hidden" name="update_l_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_l_name" value="<?php echo $fetch_edit['name']; ?>">
	  <input type="text" class="box" required name="update_l_description" value="<?php echo $fetch_edit['description']; ?>">
      <input type="file" class="box" required name="update_l_video" accept="video/mp4, video/webm, video/avi, video/flv">
      <input type="submit" value="update the library" name="update_library_kids" class="btn">
      <input type="reset" value="cancel" id="close-edit" class="option-btn">
  
  </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>


          

</div>
<br><br>
















<!-- custom js file link  -->
<script src="script_library.js"></script>

</body>
</html>