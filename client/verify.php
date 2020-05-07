<?php
session_start();
$con = mysqli_connect('localhost','root');
if($con){
	echo"";
}else{
	echo " no connection";
}

mysqli_select_db($con, 'smartbikes');
$value = $_POST['otp'];
$sql = "SELECT otp FROM `value` WHERE id=1";
$result = mysqli_query($con,$sql);
$num = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
if($num == 1){

if($row["otp"]==$value)
{
     $delete=1;
    if($delete==1)
    {
        $finish="DELETE FROM `value` WHERE id=1";
        $result = mysqli_query($con,$finish);
       echo "Logged Out Successfully";
       $_SESSION["json"]=1;
    }
}
else{
    echo "otp not matched";
}
}
else
{
    echo "otp not matched";
}
?>