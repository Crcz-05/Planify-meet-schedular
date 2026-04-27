<?php
session_start();

$conn = mysqli_connect("localhost","root","","meeting_scheduler");

$email = $_POST['email'];
$password = $_POST['password'];

// Get user by email only
$result = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($result) == 1)
{
    $user = mysqli_fetch_assoc($result);

    // Verify hashed password
    if(password_verify($password, $user['password']))
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['department'] = $user['department'];
        $_SESSION['email'] = $user['email'];

        if($user['role'] == 'student')
            header("Location: ../frontend/student_dashboard.php");
        else
            header("Location: ../frontend/faculty_dashboard.php");
    }
    else
    {
        echo "Invalid password!";
    }
}
else
{
    echo "User not found!";
}
?>