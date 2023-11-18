<?php

@include 'meditation-header.php';
session_start();
 $user_name = $_SESSION['user_name']; // Get the username from the session

 
if(isset($_GET['remove'])){ 
   $remove_id = $_GET['remove']; 
   mysqli_query($connect, "DELETE FROM bookmark_quotes WHERE id = '$remove_id'"); 
   header('location:bookmark_quotes.php'); 
}; 
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bookmark Quotes</title>

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

<section class="library_quotes-bookmark_quotes">

   <h1 class="heading">Bookmark Quotes <?php echo $_SESSION['user_name']; ?></h1>

   <table>

   
      <thead>
         
         <th>image</th>
         <th>name</th>
		 <th>description</th>
         <th>action</th>
      </thead>

      <tbody>

         <?php 
         
         $select_bookmark_quotes = mysqli_query($connect, "SELECT * FROM `bookmark_quotes` WHERE user_name = '$user_name'");

       
         if(mysqli_num_rows($select_bookmark_quotes) > 0){
            while($fetch_bookmark_quotes = mysqli_fetch_assoc($select_bookmark_quotes)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $fetch_bookmark_quotes['image']; ?>" width="320" height="240" alt=""></td>
            <td><?php echo $fetch_bookmark_quotes['name']; ?></td>
			<td><?php echo $fetch_bookmark_quotes['description']; ?></td>

            <td><a href="bookmark_quotes.php?remove=<?php echo $fetch_bookmark_quotes['id']; ?>" onclick="return confirm('delete video from bookmark?')" class="delete-btn"> <i class="fas fa-trash"></i> DELETE</a></td>
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