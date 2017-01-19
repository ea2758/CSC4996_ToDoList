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
	<td align="center"><input type = "submit" name="viewList" value="To Do List">
						<input type = "submit" name="viewCompleted" value="Completed Tasks"></td>
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
//Add Item Button
if(isset($_POST["addItem"])&&!empty($_POST["addItem"])){
	
	$item = mysqli_real_escape_string($link, $_POST["newItem"]);
	$insertSQL = "INSERT INTO uncompleted_tasks(uncompleted_task)VALUES('$item')";
	if(mysqli_query($link,$insertSQL)){
		echo "Item added successfully\n\n";	
	} else{
		echo "Error: invalid query".mysqli_error($link);
	}
}
//View To Do List Button
if(isset($_POST["viewList"])&&!empty($_POST["viewList"])){
	$printSQL = "SELECT * FROM uncompleted_tasks";
	$printData = mysqli_query($link,$printSQL);
		
		while($printer = mysqli_fetch_array($printData)){
			echo '<pre>';
			echo $printer['task_number'];
			echo "\t";
			echo $printer['uncompleted_task']; 
			echo "\n";
			echo '</pre>';
		}
}
//View Completed Tasks Button
if(isset($_POST["viewCompleted"])&&!empty($_POST["viewCompleted"])){
	$printSQL = "SELECT * FROM completed_tasks";
	$printData = mysqli_query($link,$printSQL);
		
		while($printer = mysqli_fetch_array($printData)){
			echo '<pre>';
			echo $printer['task_number'];
			echo "\t";
			echo $printer['completed_task']; 
			echo "\n";
			echo '</pre>';
		}
}
//Delete Task Button
if(isset($_POST["completedItem"])&&!empty($_POST["completedItem"])){
	
	$itemDone = mysqli_real_escape_string($link, $_POST["completedItem"]);
	
	
	$insertSQL = "INSERT INTO completed_tasks(completed_task)VALUES('$itemDone')";
	if(mysqli_query($link,$insertSQL)){
		echo "and added to completed list.\n\n";	
	} 
	
	$removeSQL = "DELETE FROM uncompleted_tasks WHERE task_number='$itemDone'";
	if(mysqli_query($link,$removeSQL)){
		echo "Item removed successfully\n\n";	
	} else{
		echo "Error: invalid query".mysqli_error($link);
	}
	
		
}
?>