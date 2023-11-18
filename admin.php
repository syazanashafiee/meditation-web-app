<?php

@include 'meditation-header.php';

if(isset($_POST['add_library'])){
   $l_name = $_POST['l_name'];
   $l_image = $_FILES['l_image']['name'];
   $l_image_tmp_name = $_FILES['l_image']['tmp_name'];
   $l_image_folder = 'uploaded_img/'.$l_image;

   $insert_query = mysqli_query($connect, "INSERT INTO `library`(name, image) VALUES('$l_name','$l_image')") or die('query failed');

   if($insert_query){
      move_uploaded_file($l_image_tmp_name, $l_image_folder);
      $message[] = 'library add succesfully';
   }else{
      $message[] = 'could not add the library';
   }
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($connect, "DELETE FROM `library` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:admin.php');
      $message[] = 'library has been deleted';
   }else{
      header('location:admin.php');
      $message[] = 'library could not be deleted';
   };
};

if(isset($_POST['update_library'])){
   $update_l_id = $_POST['update_l_id'];
   $update_l_name = $_POST['update_l_name'];
   $update_l_image = $_FILES['update_l_image']['name'];
   $update_l_image_tmp_name = $_FILES['update_l_image']['tmp_name'];
   $update_l_image_folder = 'uploaded_img/'.$update_l_image;

   $update_query = mysqli_query($connect, "UPDATE `library` SET name = '$update_l_name', image = '$update_l_image' WHERE id = '$update_l_id'");

   if($update_query){
      move_uploaded_file($update_l_image_tmp_name, $update_l_image_folder);
      $message[] = 'library updated succesfully';
      header('location:admin.php');
   }else{
      $message[] = 'library could not be updated';
      header('location:admin.php');
   }

}

?>

<!DOCTYPE html>

<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style_library.css">

</head>
<body>
   
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
   <input type="file" name="l_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <input type="submit" value="add the library" name="add_library" class="btn">
</form>

</section>

<section class="display-product-table">

   <table>

      <thead>
         <th>library image</th>
         <th>library name</th>
         <th>action</th>
      </thead>

      <tbody>
         <?php
         
            $select_library = mysqli_query($connect, "SELECT * FROM `library`");
            if(mysqli_num_rows($select_library) > 0){
               while($row = mysqli_fetch_assoc($select_library)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>
               <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no library added</div>";
            };
         ?>
      </tbody>
   </table>

</section>


<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($connect, "SELECT * FROM `library` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <input type="hidden" name="update_l_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_l_name" value="<?php echo $fetch_edit['name']; ?>">
      <input type="file" class="box" required name="update_l_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update the library" name="update_library" class="btn">
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
<center>
<tr class="table-bottom">
            <td><a href="http://localhost/meditation/index.html" class="option-btn" style="margin-top: 0;">Home</a></td>
   
            
         </tr></center>















<!-- custom js file link  -->
<script src="script_library.js"></script>

</body>
</html>