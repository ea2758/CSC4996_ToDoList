<?php

$link = mysqli_connect("localhost","root","");
if($link==false){
	die("Error: connection error");
}
mysqli_select_db($link,"ToDoList") or die("error: cannot locate database");
?>