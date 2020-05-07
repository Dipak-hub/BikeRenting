<?php
$name = $_POST['Name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

//Database Connection
$conn = new mysqli('localhost', 'root', '', 'smartbikes');
if($conn-> connect_error){
    die('Connection Failed:'.$conn->connect_error);

}
else{
    if($password==$password2)
    {
        $stmt = $conn->prepare("INSERT INTO `register`( `Name`, `email`, `contact`, `password`, `password2`) Values (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $name, $email, $contact, $password, $password2);
        $stmt->execute();
        echo("Welcome to the Smartbikes, Your Registration is successfull");
        $stmt->close();
        $conn->close();
    }
    else
    {
        echo("Passwords did not matched");
    }
}

?>