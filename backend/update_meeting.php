<?php
session_start();
$conn = mysqli_connect("localhost","root","","meeting_scheduler");
require 'send_email.php';

$meeting_id = $_POST['meeting_id'];
$action = $_POST['action'];
// Get student email and name
$res = mysqli_query($conn, "SELECT u.email, u.name 
FROM meetings m
JOIN users u ON m.student_id = u.id
WHERE m.id='$meeting_id'");

$student = mysqli_fetch_assoc($res);

if(!$student){
    die("Student not found");
}

$student_email = $student['email'];
$student_name = $student['name'];

if($action == "approve")
{
    $venue = $_POST['venue'];

    mysqli_query($conn,"UPDATE meetings 
    SET status='Approved', venue='$venue' 
    WHERE id='$meeting_id'");

    mysqli_query($conn,"INSERT INTO notifications (user_id,message)
    SELECT student_id, CONCAT('Meeting approved. Venue: ', '$venue')
    FROM meetings WHERE id='$meeting_id'");

    $subject = "Meeting Approved - Planify";

$body = "
Hello $student_name,<br><br>
Your meeting request has been <b>approved</b>.<br><br>

<b>Venue:</b> $venue <br><br>

Please check your dashboard for details.<br><br>

Regards,<br>
Planify
";

sendEmail($student_email, $subject, $body);
}

else if($action == "reject")
{
    mysqli_query($conn,"UPDATE meetings 
    SET status='Rejected' 
    WHERE id='$meeting_id'");

    mysqli_query($conn,"INSERT INTO notifications (user_id,message)
    SELECT student_id, 'Meeting rejected by faculty'
    FROM meetings WHERE id='$meeting_id'");

    $subject = "Meeting Rejected";

$body = "
Hello $student_name,<br><br>
Your meeting request has been <b>rejected</b>.<br><br>

Please contact faculty for more details.<br><br>

Regards,<br>
Planify
";

sendEmail($student_email, $subject, $body);
}

else if($action == "reschedule")
{
    $date = $_POST['proposed_date'];
    $time = $_POST['proposed_time'];
    $venue = $_POST['reschedule_venue'];

    mysqli_query($conn,"UPDATE meetings 
    SET proposed_date='$date', 
        proposed_time='$time',
        venue='$venue',
        status='Rescheduled'
    WHERE id='$meeting_id'");

    mysqli_query($conn,"INSERT INTO notifications (user_id,message)
    SELECT student_id, CONCAT('New time & venue suggested: ', '$date $time at $venue')
    FROM meetings WHERE id='$meeting_id'");

    $subject = "Meeting Rescheduled";

$body = "
Hello $student_name,<br><br>
Your meeting has been <b>rescheduled</b>.<br><br>

<b>New Date:</b> $date <br>
<b>New Time:</b> $time <br>
<b>Venue:</b> $venue <br><br>



Regards,<br>
Planify
";

sendEmail($student_email, $subject, $body);
}

header("Location: ../frontend/faculty_dashboard.php");
?>