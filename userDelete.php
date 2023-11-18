<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Record</title>
    
    <!-- Link to your custom CSS file -->
    <link rel="stylesheet" href="style_userDelete.css">
</head>
<body>
<?php
// Include the file to connect to the server (meditation-header.php)
include("meditation-header.php");
?>

<div class="center-container">
   
    
    <?php
    // Look for a valid user id, either through GET or POST
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
    } elseif (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        echo '<p class="error">This page has been accessed in error.</p>';
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['sure'] == 'Yes') { // Delete the record
            // Make the query
            $q = "DELETE FROM user_form WHERE id = $id LIMIT 1";
            $result = @mysqli_query($connect, $q); // Run the query

            if (mysqli_affected_rows($connect) == 1) { // If the record was deleted
                echo '<script>alert("The user has been deleted"); window.location.href="userList.php";</script>';
            } else {
                // Display an error message
                echo '<p class="error">The record could not be deleted, probably because it does not exist or due to a system error.</p>';
                echo '<p>' . mysqli_error($connect) . '<br/> Query: ' . $q . '</p>';
                // Debugging message
            }
        } else {
            echo '<script>alert("The user has NOT been deleted"); window.location.href="userList.php";</script>';
        }
    } else {
        // Display the form for confirmation
        // Retrieve the member's data
        $q = "SELECT name FROM user_form WHERE id = $id";
        $result = @mysqli_query($connect, $q); // Run the query

        if (mysqli_num_rows($result) == 1) {
            // Get the member's information
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
            echo "<h3>Are you sure you want to permanently delete $row[0]?</h3>";
            echo '<form action="userDelete.php" method="post">
            <input id="submit-yes" type="submit" name="sure" value="Yes">
            <input id="submit-no" type="submit" name="sure" value="No">
            <input type="hidden" name="id" value="' . $id . '">
            </form>';
        } else {
            // Display an error message
            echo '<p class="error">This page has been accessed in error.</p>';
            echo '<p>&nbsp;</p>';
        }
    }

    mysqli_close($connect); // Close the database connection
    ?>
</div>
</body>
</html>
