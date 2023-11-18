
<?php

@include 'meditation-header.php';
session_start();

if (isset($_POST['add_to_bookmark_quotes'])) {
    $library_quotes_name = mysqli_real_escape_string($connect, $_POST['library_quotes_name']);
   $library_quotes_image = mysqli_real_escape_string($connect, $_POST['library_quotes_image']);
   $library_quotes_description = mysqli_real_escape_string($connect, $_POST['library_quotes_description']);
   $user_name = $_SESSION['user_name']; // Get the user's ID from the session

    // Check if the library is already in the user's bookmarks
    $check_existing_query = "SELECT * FROM `bookmark_quotes` WHERE name = '$library_quotes_name' AND image = '$library_quotes_image' AND user_name = '$user_name'";
    $result = mysqli_query($connect, $check_existing_query);

    if (mysqli_num_rows($result) > 0) {
        $message[] = 'Library already added to bookmark';
    } else {
        // Insert the library into the user's bookmarks along with their user_name
        $insert_library_quotes = "INSERT INTO `bookmark_quotes`(name, image, description, user_name) 
                         VALUES('$library_quotes_name', '$library_quotes_image', '$library_quotes_description', '$user_name')";
        mysqli_query($connect, $insert_library_quotes);

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
   <title>Library Quotes</title>
   

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
        <a href="http://localhost/meditation/bookmark_quotes.php">BOOKMARK</a>
            <a href="http://localhost/meditation/index.html">HOME</a>
        </nav>
    </div>
</header>

<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></div>';
    };
}
?>


<?php include 'header.php'; ?>



<div class="containerr">

<section class="library">

   <h1 class="heading">Library Quotes</h1>
   

   <div class="box-container">

      <?php
      
      $select_library_quotes = mysqli_query($connect, "SELECT * FROM `library_quotes`");
      if(mysqli_num_rows($select_library_quotes) > 0){
         while($fetch_library = mysqli_fetch_assoc($select_library_quotes)){
      ?>

      <form action="" method="post">
         <div class="box">
    <div class="image-containerr">
        <img src="uploaded_img/<?php echo $fetch_library['image']; ?>" alt="" class="library-image">
    </div>
    <h1><?php echo $fetch_library['name']; ?></h1>
    <h3><?php echo $fetch_library['description']; ?></h3>
    <input type="hidden" name="library_quotes_name" value="<?php echo $fetch_library['name']; ?>">
    <input type="hidden" name="library_quotes_image" value="<?php echo $fetch_library['image']; ?>">
    <input type="hidden" name="library_quotes_description" value="<?php echo $fetch_library['description']; ?>">
    <input type="submit" class="btn" value="add to bookmark" name="add_to_bookmark_quotes">
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