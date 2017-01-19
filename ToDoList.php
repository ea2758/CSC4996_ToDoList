<?php
//Username: Root  
//Host: localhost

//path for directory - must be changed if running locally
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
						<input type = "submit" name="viewCompleted" value="Completed Tasks">
						<input type = "submit" name="clearAll" value="Clear Lists"></td>
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
/***********************************************
Add Item Button
-Reads input from a text field adjacent to the 
button. This input is then inserted into the table
containing uncompleted tasks. 
-Executes when the button is clicked
**********************************************/
if(isset($_POST["addItem"])&&!empty($_POST["addItem"])){
	//gets data from input field
	$item = mysqli_real_escape_string($link, $_POST["newItem"]);
	//query for inserting data into uncompleted_tasks table
	$insertSQL = "INSERT INTO uncompleted_tasks(uncompleted_task)VALUES('$item')";
	//executes query/outputs success
	if(mysqli_query($link,$insertSQL)){
		echo "Item added successfully";	
	} else{
		echo "Error: invalid query".mysqli_error($link);
	}
}
/***********************************************
View To Do List Button
-Prints the contents of the uncompleted task table 
in the form of: task_number		task 
-Executes when the button is clicked
***********************************************/
if(isset($_POST["viewList"])&&!empty($_POST["viewList"])){
	//query to print contents of uncompleted task table
	$printSQL = "SELECT * FROM uncompleted_tasks";
	//execution of print query
	$printData = mysqli_query($link,$printSQL);
		//loops through table to print each row's contents
		while($printer = mysqli_fetch_array($printData)){
			//allows text formatting (\t, \n, etc.)
			echo '<pre>';
			echo $printer['task_number'];
			echo "\t";
			echo $printer['uncompleted_task']; 
			echo "\n";
			echo '</pre>';
		}
}
/***********************************************
View Completed Tasks Button
-Prints the contents of the completed task table
in the form of: task_number		task
-Executes when the button is clicked
***********************************************/
if(isset($_POST["viewCompleted"])&&!empty($_POST["viewCompleted"])){
	//query to print contents of the table
	$printSQL = "SELECT * FROM completed_tasks";
	//execution of query
	$printData = mysqli_query($link,$printSQL);
		//loop to print each row
		while($printer = mysqli_fetch_array($printData)){
			echo '<pre>';
			echo $printer['task_number'];
			echo "\t";
			echo $printer['completed_task']; 
			echo "\n";
			echo '</pre>';
		}
}
/***********************************************
Delete Task Button
-Reads input data from the text field adjacent to 
the button.
-This input data represents the task number of the
element to be removed.
-The element is first copied into the completed_tasks
table, then it is deleted from the original table 
***********************************************/
if(isset($_POST["completedItem"])&&!empty($_POST["completedItem"])){
	//get value from input field (task_number of element to be removed)
	$itemDone = mysqli_real_escape_string($link, $_POST["completedItem"]);
	//query to get the value of the element itself
	$itemDoneSQL = mysqli_query($link,"SELECT uncompleted_task FROM uncompleted_tasks
	WHERE task_number='$itemDone'");
	//executing the query to store the value in a variable
	$itemDoneValue = mysqli_fetch_array($itemDoneSQL);
	//query to copy the value stored into the completed_tasks table
	$insertSQL = "INSERT INTO completed_tasks(completed_task)VALUES('$itemDoneValue[uncompleted_task]')";
	//execution of the query to copy this value 
	if(mysqli_query($link,$insertSQL)){
		
	} 
	//query to delete the value from the original table
	$removeSQL = "DELETE FROM uncompleted_tasks WHERE task_number='$itemDone'";
	//execution of the query/output success
	if(mysqli_query($link,$removeSQL)){
		echo "Item removed successfully and added to completed list.";	
	} else{
		echo "Error: invalid query".mysqli_error($link);
	}
	
		
}
/***********************************************
Reset All Tables
-Uses several queries to remove all existing data
from both tables.
-It then resets the AUTO_INCREMENT feature for 
both tables
***********************************************/
if(isset($_POST["clearAll"])&&!empty($_POST["clearAll"])){
	echo "All stored data has been cleared.";
	//queries to delete all rows in uncompleted_tasks and completed_tasks
	$wipeTableSQL = "DELETE FROM `uncompleted_tasks`";
	$wipeTable2SQL = "DELETE FROM `completed_tasks`";
	//queries to reset auto_increment
	$resetIncrementSQL = "ALTER TABLE `uncompleted_tasks` AUTO_INCREMENT=1";
	$resetIncrement2SQL = "ALTER TABLE `completed_tasks` AUTO_INCREMENT=1";
	//query execution
	mysqli_query($link,$wipeTableSQL);
	mysqli_query($link,$wipeTable2SQL);
	mysqli_query($link,$resetIncrementSQL);
	mysqli_query($link,$resetIncrement2SQL);



}
?>