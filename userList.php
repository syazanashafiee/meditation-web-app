<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User List</title>

   <!-- Link to your custom CSS file -->
   <link rel="stylesheet" href="styleUser.css">
</head>
<body>
<?php
// Include the file to connect to the server (meditation-header.php)
include ("meditation-header.php");
?>
<br><br>
<div style="text-align: center;">
<form action="userFound.php" method="post">

<h1>Search User Record</h1>
<p><label class="label" for="name">User Name:</label>
<input id="name" type="text" name="name" size="10"
maxlength="50" value="<?php if (isset($_POST['name']))
	echo $_POST ['name']; ?>"/></p>

<input id = "submit" type="submit" name="submit" value="search"/></p>
</form>
</div>

<br><br>
<div class="center-container">
<h2>List of Users:</h2>
   
   <?php
   // Make the query
   $q = "SELECT id, name, email, password, user_type FROM user_form ORDER BY id";

   // Run the query and assign it to the variable $result
   $result = @mysqli_query ($connect, $q);
   if($result)
   {
	   
      // Table heading
      echo '<table>
         <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>USER TYPE</th>
            <th>DELETE</th>
            
         </tr>';

      // Fetch and print all the records
      while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
      {
         echo'<tr>
            <td>' .$row['id'].'</td>
            <td>' .$row['name'].'</td>
            <td>' .$row['email'].'</td>
            <td>' .$row['user_type'].'</td>
            
            <td align="center"><a href="userDelete.php?id='.$row['id'].'">Delete</a></td>
         </tr>';
      }
      //close the table
      echo '</table>';

      //free up the resources
      mysqli_free_result($result);
   }
   else
   {
      //error message
      echo '<p class="error">The current user data could not be retrieved. We apologize for any inconvenience.</p>';
      
      //debugging message
      echo '<p>' .mysqli_error ($connect). '<br><br>Query:'.$q.'</p>';
   }

   //close the database connection
   mysqli_close($connect);
   ?>

  </div>
   <div style="text-align: center;">
   <a href="http://localhost/meditation/admin_page.php" class="admin-button">DONE</a></div>
   


</body>
</html>
