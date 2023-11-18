<!DOCTYPE html>
<html>
<head>
    <title>Search Result</title>
    <link rel="stylesheet" type="text/css" href="style_userFound.css">
</head>
<body>
<?php
// Include the file to connect to the server (meditation-header.php)
include("meditation-header.php");
?>
<br><br><br><br><br><br>
<center>
<h2>Search Result</h2>

<?php
$in = $_POST['name'];
$in = mysqli_real_escape_string($connect, $in);

// Make the query
$q = "SELECT id, name, email, password, user_type
FROM user_form
WHERE name='$in' ORDER BY id";


// Run the query and assign it to the variable $result
$result = @mysqli_query($connect, $q);
if ($result) {
    //Table heading
    echo '<table border="2">
    <tr>
    <td align="center"><strong>ID</strong></td>
    <td align="center"><strong>NAME</strong></td>
    <td align="center"><strong>EMAIL</strong></td>
    <td align="center"><strong>USER TYPE</strong></td>

    </tr>';
    //Fetch and print all the records
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo '<tr>
        <td>' . $row['id'] . '</td>
        <td>' . $row['name'] . '</td>
        <td>' . $row['email'] . '</td>
        <td>' . $row['user_type'] . '</td>


        </tr>';
    }
    //close the table
    echo '</table>';

    //free up the resources
    mysqli_free_result($result);
} else {
    //error message
    echo '<p class="error"> If no record is shown, this is because you had an incorrect or missing entry in the search form.
    <br>Click the back button on the browser and try again.</p>';

    //debugging message
    echo '<p>' . mysqli_error($connect) . '<br><br>Query:' . $q . '</p>';
}
//close the database connection
mysqli_close($connect);

?>
<br><br>
<center>
<a href="userList.php"><button class="adminpage">DONE</button></center>

</div>
</div>
</body>
</html>
