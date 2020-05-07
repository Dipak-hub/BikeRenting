<?php
session_start();
$con = mysqli_connect('localhost','root');
if($con){
	echo"";
}else{
	echo " no connection";
}

mysqli_select_db($con, 'smartbikes');

$email= $_POST['email'];
$password = $_POST['password'];
$q = " select * from register where email= '$email' && password = '$password' ";
$result = mysqli_query($con,$q);
$num = mysqli_num_rows($result);
if($num == 1){
	$_SESSION['email'] = $email;
    echo "Success!!";
    header('location:stopwatch.html');
}else{
	$message="username or password is incorrect";
	echo"<script type='text/javascript'>alert('$message');</script>";
	header("refresh:0.5; url=Booking.html");
}
?>
