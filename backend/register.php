<?php
$conn = mysqli_connect("localhost","root","","meeting_scheduler");

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$role = $_POST['role'];
$department = $_POST['department'];

$check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check) > 0)
{
    echo "Email already exists!";
}
else
{
    mysqli_query($conn,"INSERT INTO users (name,email,password,role,department)
    VALUES ('$name','$email','$hashed_password','$role','$department')");

    header("Location: ../frontend/login.php");
}
?>