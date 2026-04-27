<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost","root","","meeting_scheduler");
?>

<!DOCTYPE html>
<html>
<head>
<title>Request Meeting</title>

<link rel="stylesheet" href="css/style.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body>

<div class="navbar">
<div class="logo">
<img src="assets/geu_logo.png">
 Meeting Scheduler
</div>

<div class="nav-right">
<i class="fa fa-bell"></i>
<i class="fa fa-user"></i>
</div>
</div>

<div class="main">

<div class="sidebar">

<h4>Student Panel</h4>

<a href="student_dashboard.php">
<i class="fa fa-home"></i>
Dashboard
</a>

<a href="#">
<i class="fa fa-calendar-plus"></i>
Request Meeting
</a>

<a href="#">
<i class="fa fa-clock"></i>
My Meetings
</a>

<a href="#">
<i class="fa fa-bell"></i>
Notifications
</a>

<a href="#">
<i class="fa fa-headset"></i>
Helpdesk
</a>

</div>

<div class="content">

<h2>Request Meeting</h2>

<div class="table">

<h3>Book Appointment</h3>

<form action="../backend/submit_meeting.php" method="POST">


<label>Select Faculty</label>

<select name="faculty_id" required>

<?php
$res = mysqli_query($conn,"SELECT * FROM users WHERE role='faculty'");
while($row = mysqli_fetch_assoc($res))
{
    echo "<option value='".$row['id']."'>".$row['name']."</option>";
}
?>

</select>

<br><br>

<label>Select Date</label>
<input type="date" name="meeting_date" required>

<br><br>

<label>Select Time</label>
<input type="time" name="meeting_time" required>

<br><br>

<label>Reason</label>
<textarea rows="4" name="purpose" placeholder="Enter meeting purpose" required></textarea>

<br><br>

<button class="btn propose">Send Request</button>

</form>

</div>

</div>

</div>

</body>
</html>