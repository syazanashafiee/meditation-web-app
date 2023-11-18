<html>
<head>
<title>USER SEARCH</title>
</head>
<body>

<?php

//call file to connect server eleave
include ("MEDITATION-header.php");
?>
<img src="online.png" width="168" height="95" alt="bananabro"/>
<center>
<form action="userFound.php" method="post">

<h1>Search User Record</h1>
<p><label class="label" for="username">User Name:</label>
<input id="username" type="text" name="username" size="30"
maxlength="50" value="<?php if (isset($_POST['username']))
	echo $_POST ['username']; ?>"/></p>

<input id = "submit" type="submit" name="submit" value="search"/></p>
</form>
<center>
</body>
</html>