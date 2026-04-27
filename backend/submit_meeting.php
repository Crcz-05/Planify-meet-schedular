<?php
session_start();

$conn = mysqli_connect("localhost","root","","meeting_scheduler");
require 'send_email.php';

$student_id = $_SESSION['user_id'];   
$faculty_id = $_POST['faculty_id'];
// Get faculty email and name
$res = mysqli_query($conn, "SELECT email, name FROM users WHERE id='$faculty_id'");
$faculty = mysqli_fetch_assoc($res);

$faculty_email = $faculty['email'];
$faculty_name = $faculty['name'];
$date = $_POST['meeting_date'];
$time = $_POST['meeting_time'];
$purpose = $_POST['purpose'];

mysqli_query($conn,"INSERT INTO meetings 
(student_id, faculty_id, meeting_date, meeting_time, purpose, status)
VALUES 
('$student_id','$faculty_id','$date','$time','$purpose','Pending')");

// Insert notification for faculty
$message = "New meeting request received";
mysqli_query($conn, "INSERT INTO notifications (user_id, message) 
VALUES ('$faculty_id', '$message')");


// Send email to faculty
$subject = "New Meeting Request";

$body = "
Hello $faculty_name,<br><br>
You have received a new meeting request.<br><br>
<b>Date:</b> $date <br>
<b>Time:</b> $time <br>
<b>Purpose:</b> $purpose <br><br>

Please login to your dashboard to take action.<br><br>

Regards,<br>
Planify
";

sendEmail($faculty_email, $subject, $body);
header("Location: ../frontend/student_dashboard.php");
?>