<?php

$link = mysqli_connect("localhost","root","");
if($link==false){
	die("Error: connection error");
}
mysqli_select_db($link,"todolist") or die("error: cannot locate database");
?>