<?php

@include 'meditation-header.php';
session_start();
 
 
if(isset($_GET['remove'])){ 
   $remove_id = $_GET['remove']; 
   mysqli_query($connect, "DELETE FROM bookmark WHERE id = '$remove_id'"); 
   header('location:bookmark.php'); 
}; 
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bookmark Breath</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style_library.css">

</head>
<body>

<header class="header">

   <div class="flex">

<img src="images/kk.png" width="60" height="60" alt="meditation"/>
      <a href="#" class="logo">TranquilMind</a>

      <nav class="navbar">
	  
	 <a href="http://localhost/meditation/bookmark.php">BOOKMARK</a>
      <a href="http://localhost/meditation/bookmark_quotes.php">BOOKMARK QUOTES</a>
            <a href="http://localhost/meditation/index.html">HOME</a>
		 
      </nav>
	  
	  </div>
	  
	  </header>

<?php include 'header.php'; ?>

<div class="container">

<section class="library-bookmark">

   <h1 class="heading">Bookmark <?php echo $_SESSION['user_name']; ?></h1>

   <table>

      <thead>
         <th>video</th>
         <th>name</th>
		 <th>description</th>
         <th>action</th>
      </thead>

      <tbody>

         <?php 
         
         

// Retrieve and display bookmarks of the currently logged-in user
$select_bookmark = mysqli_query($connect, "SELECT * FROM `bookmark` WHERE user_name = '" . $_SESSION['user_name'] . "'");

// Loop through and display the bookmarks
if (mysqli_num_rows($select_bookmark) > 0) {
    while ($fetch_bookmark = mysqli_fetch_assoc($select_bookmark)) {
         ?>

         <tr>
            <td>
               <video controls>
                  <source src="uploaded_img/<?php echo $fetch_bookmark['video']; ?>" type="video/mp4">
                  Your browser does not support the video tag.
               </video>
            </td>
            <td><?php echo $fetch_bookmark['name']; ?></td>
<td><?php echo $fetch_bookmark['description']; ?></td>
            <td><a href="bookmark.php?remove=<?php echo $fetch_bookmark['id']; ?>" onclick="return confirm('delete video from bookmark?')" class="delete-btn"> <i class="fas fa-trash"></i> DELETE</a></td>
         </tr>
         <?php
            
            };
         };
         ?>
       

      </tbody>

   </table>



</section>

</div>
   
<!-- custom js file link  -->
<script src="script_library.js"></script>

</body>
</html>