<?php
session_start();
@include 'meditation-header.php';

if (isset($_POST['add_to_bookmark'])) {
    $library_name = $_POST['library_name'];
    $library_video = $_POST['library_video'];
    $library_description = $_POST['library_description'];
    $user_name = $_SESSION['user_name']; // Get the user's ID from the session

    // Check if the library is already in the user's bookmarks
    $check_existing_query = "SELECT * FROM `bookmark` WHERE name = '$library_name' AND video = '$library_video' AND user_name = '$user_name'";
    $result = mysqli_query($connect, $check_existing_query);

    if (mysqli_num_rows($result) > 0) {
        $message[] = 'Library already added to bookmark';
    } else {
        // Insert the library into the user's bookmarks along with their user_name
        $insert_library = "INSERT INTO `bookmark`(name, video, description, user_name) 
                         VALUES('$library_name', '$library_video', '$library_description', '$user_name')";
        mysqli_query($connect, $insert_library);

        $message[] = 'Library added to bookmark successfully';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Library Yoga</title>
   

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
            <a href="http://localhost/meditation/index.html">HOME</a>
      </nav>
	  
	  </div>
	  
	  </header>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>


<?php include 'header.php'; ?>



<div class="container">

<section class="library">

   <h1 class="heading">Library Breath</h1>
   

   <div class="box-container">

      <?php
      
      $select_library = mysqli_query($connect, "SELECT * FROM `library`");
      if(mysqli_num_rows($select_library) > 0){
         while($fetch_library = mysqli_fetch_assoc($select_library)){
      ?>

      <form action="" method="post">
         <div class="box">
            <video controls>
               <source src="uploaded_img/<?php echo $fetch_library['video']; ?>" type="video/mp4">
               Your browser does not support the video tag.
            </video>
            <h1><?php echo $fetch_library['name']; ?></h1>
			 <h4><?php echo $fetch_library['description']; ?></h4>
            <input type="hidden" name="library_name" value="<?php echo $fetch_library['name']; ?>">
            <input type="hidden" name="library_video" value="<?php echo $fetch_library['video']; ?>">
			 <input type="hidden" name="library_description" value="<?php echo $fetch_library['description']; ?>">
            <input type="submit" class="btn" value="add to bookmark" name="add_to_bookmark">
         </div>
		 
      </form>
	 

      <?php
         };
      };
      ?>
	  
	  

   </div>
   

</section>

 
</div>
 
<!-- custom js file link  -->
<script src="script_library.js"></script>

</body>
</html>