<?php
	$name=$_GET['name'];
    @include 'config.php';
	mysqli_query($conn,"delete from `furniture_form` where name ='$name'");
	header('location:dashboard.php');
?>