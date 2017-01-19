<?php
require 'C:/wamp64/www/ToDoList/connection.php'
?>
<html>
<center><head><title>To Do List</title></head>
<body>
<form action = "ToDoList.php" method="post">
	<h1>To Do List </h1>
	<center><table border = "3" width = "400" height = "300">
	
	<tr>
	<td align="center"><input type = "submit" name="viewList" value="View List"></td>
	</tr>
	<br>
	
	<tr>
	<td align="center"><input type = "submit" name="addItem" value="Add Item">
						<input type = "name" name="newItem"></td>
	</tr>
	<br>
	
	<tr>
	<td align="center"><input type = "submit" name = "Remove Item" value = "Remove Item"></td>
	</tr>
	
</table></center>
</body>
</html>
<?php

//$printTable = "SELECT * FROM uncompleted_tasks";

if(isset($_POST["addItem"])&&!empty($_POST["addItem"])){
	
	$item = mysqli_real_escape_string($link, $_POST["newItem"]);
	$insertSQL = "INSERT INTO uncompleted_tasks(uncompleted_task)VALUES('$item')";
	if(mysqli_query($link,$insertSQL)){
		echo "Item added successfully\n\n";	
	} else{
		echo "Error: invalid query".mysqli_error($link);
	}
}
/*if(isset($_POST["viewList"])&&!empty($_POST["viewList"])){
	
}*/
?>