<?php
// Include the file to connect to the server (meditation-header.php)
include("meditation-header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>

    <!-- Link to your custom CSS file -->
    <link rel="stylesheet" href="style_userUpdate.css">
</head>
<body>

<div class="center-container">
    <h2>Edit Record:</h2>

    <?php
    // Check if ID is provided and valid
    if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
        $id = $_GET['id'];
    } elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
        $id = $_POST['id'];
    } else {
        echo '<p class="error">This page has been accessed in error.</p>';
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $error = array(); // Initialize an error array

        // Look for a name
        if (empty($_POST['name'])) {
            $error[] = 'You forgot to enter your name.';
        } else {
            $n = mysqli_real_escape_string($connect, trim($_POST['name']));
        }

        // Look for an email
        if (empty($_POST['email'])) {
            $error[] = 'You forgot to enter your email.';
        } else {
            $e = mysqli_real_escape_string($connect, trim($_POST['email']));
        }

        // If no problem occurred
        if (empty($error)) {
            $q = "SELECT id FROM user_form WHERE name = '$n' AND id != $id";

            $result = @mysqli_query($connect, $q); // Run the query

            if (mysqli_num_rows($result) == 0) {
                $q = "UPDATE user_form SET name = '$n', email = '$e' WHERE id = '$id' LIMIT 1";

                $result = @mysqli_query($connect, $q); // Run the query

                if (mysqli_affected_rows($connect) == 1) {
                    echo '<script>alert("The user has been edited"); window.location.href="userList.php";</script>';
                } else {
                    echo '<p class="error">The user has not been edited due to a system error. We apologize for any inconvenience.</p>';
                    echo '<p>' . mysqli_error($connect) . '<br/> query:' . $q . '</p>';
                }
            } else {
                echo '<p class="error">The ID had been registered</p>';
            }
        } else {
            echo '<p class="error">The following error(s) occurred: <br/>';
            foreach ($error as $msg) {
                echo "- " . $msg . "<br>\n";
            }
            echo '<p>Please try again.</p>';
        }
    }

    $q = "SELECT name, email From user_form WHERE id = $id";

    $result = @mysqli_query($connect, $q); // Run the query

    if (mysqli_num_rows($result) == 1) {
        // Get member information
        $row = mysqli_fetch_array($result, MYSQLI_NUM);

        // Create the form
        echo '<form action="userUpdate.php" method="post">
            <p><label class="label" for="name">Name*:</label>
            <input type="text" id="name" name="name" size="30" maxlength="50" value="' . $row[0] . '"></p>

            <p><label class="label" for="email">Email*:</label>
            <input type="text" id="email" name="email" size="30" maxlength="50" value="' . $row[1] . '"></p>

            <p><input id="submit" type="submit" name="submit" value="Update"></p>
            <input type="hidden" name="id" value="' . $id . '"/>
        </form>';
    } else { // If it didn't run
        echo '<p class="error">This page has been accessed in error</p>';
    }

    mysqli_close($connect); // Close the database connection
    ?>
</div>
</body>
</html>
