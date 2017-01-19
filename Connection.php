<?php
//creates connection to host
$link = mysqli_connect("localhost","root","");
//tests connection; reports failure when appropriate
if($link==false){
	die("Error: connection error");
}
//accesses the database; reports failure when appropriate
mysqli_select_db($link,"todolist") or die("error: cannot locate database");
?>