<?php
require 'C:/wamp64/www/ToDoList/connection.php'
?>
<html>
<center><head><title>To Do List</title></head>
<body>
<form action = "ToDoList.php" method="post">
	<h1>To Do List </h1>
	<center><table border = "3" width = "400" height = "250">
	
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
	<td align="center"><input type = "submit" name = "Remove Item" value = "Remove Item">
						<input type = "name" name="completedItem"></td>
	</tr>
	
</table></center>
</body>
</html>
<?php

if(isset($_POST["addItem"])&&!empty($_POST["addItem"])){
	
	$item = mysqli_real_escape_string($link, $_POST["newItem"]);
	$insertSQL = "INSERT INTO uncompleted_tasks(uncompleted_task)VALUES('$item')";
	if(mysqli_query($link,$insertSQL)){
		echo "Item added successfully\n\n";	
	} else{
		echo "Error: invalid query".mysqli_error($link);
	}
}
if(isset($_POST["viewList"])&&!empty($_POST["viewList"])){
	$printSQL = "SELECT * FROM uncompleted_tasks";
	$printData = mysqli_query($link,$printSQL);
		
		while($printer = mysqli_fetch_array($printData)){
			echo $printer['task_number'];
			echo "      ";
			echo $printer['uncompleted_task']; 
			echo "\n";
		}
		}
if(isset($_POST["completedItem"])&&!empty($_POST["completedItem"])){
	
	$itemDone = mysqli_real_escape_string($link, $_POST["completedItem"]);
	$removeSQL = "DELETE FROM uncompleted_tasks WHERE task_number='$itemDone'";
	if(mysqli_query($link,$removeSQL)){
		echo "Item removed successfully\n\n";	
	} else{
		echo "Error: invalid query".mysqli_error($link);
	}
	
		
}
?>