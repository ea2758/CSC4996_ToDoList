<html>
<center><head><title>To Do List</title></head>
<body>
<form action = "ToDoList.php" method="post">
	<h1>To Do List </h1>
	<center><table border = "3" width = "400" height = "300">
	
	<tr>
	<td align="center"><input type = "submit" name="View List" value="View List"></td>
	</tr>
	<br>
	
	<tr>
	<td align="center"><input type = "submit" name="Add Item" value="Add Item">
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
$counter = 1;
$link = mysqli_connect("localhost","root","");
if($link==false){
	die("Error: connection error");
}
mysqli_select_db($link,"ToDoList") or die("error: cannot locate database");

if(isset($_POST['submit'])){
	echo "submit read";
	$item = mysqli_real_escape_string($link, $_POST['newItem']);
	$insertSQL = "INSERT INTO uncompleted_tasks(task_number,uncompleted_task)VALUES('$counter','$item')";
	if(mysqli_query($link,$insertSQL)){
		echo "Item added successfully";
	} else{
		echo "Error: invalid query".mysqli_error($link);
	}
}





?>