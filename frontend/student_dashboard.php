<?php
session_start();


if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost","root","","meeting_scheduler");

$student_id = $_SESSION['user_id'];
$name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Dashboard</title>

<link rel="stylesheet" href="css/style.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<script>
function toggleNotifications(event)
{
    event.stopPropagation();
    var box = document.getElementById("notifyBox");
    box.style.display = (box.style.display === "block") ? "none" : "block";
}

document.addEventListener("click", function() {
    document.getElementById("notifyBox").style.display = "none";
    document.getElementById("profileDropdown").style.display = "none";
});

function toggleProfile(event) {
    event.stopPropagation();
    let box = document.getElementById("profileDropdown");
    box.style.display = (box.style.display === "block") ? "none" : "block";
}




</script>

</head>

<body>

<div class="navbar">

<div class="logo">
<img src="assets/geu_logo.png">
Graphic Era Deemed to be University
</div>

<div class="nav-right">

<div class="notification">

<i class="fa fa-bell" onclick="toggleNotifications(event)"></i>

<span class="badge">
<?php
$res = mysqli_query($conn,"SELECT COUNT(*) as total FROM notifications WHERE user_id='$student_id'");
$data = mysqli_fetch_assoc($res);
echo $data['total'];
?>
</span>

<div class="notification-box" id="notifyBox" style="display:none;">
<h4>Notifications</h4>

<?php
$sql = "SELECT * FROM notifications WHERE user_id='$student_id' ORDER BY id DESC";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)) {
    echo "<p>".$row['message']."</p>";
}
?>

</div>

</div>

<div class="profile-box" onclick="toggleProfile(event)">
    <i class="fa fa-user"></i>

   <div class="profile-dropdown" id="profileDropdown">

    <div class="profile-header">
        <i class="fa fa-user-circle"></i>

        <div class="profile-text">
            <h4 style="color:#111827;"><?php echo $_SESSION['name']; ?></h4>
            <small><?php echo $_SESSION['email']; ?></small>
        </div>
    </div>

    
    <div class="profile-details">
        <p><b>Department:</b> <?php echo $_SESSION['department']; ?></p>
        <p><b>Role:</b> <?php echo ucfirst($_SESSION['role']); ?></p>
    </div>

</div>
</div>
<a href="../backend/logout.php" style="margin-left:15px; color:white; text-decoration:none;">
    <i class="fa fa-sign-out-alt"></i> Logout


</a>

</div>

</div>

<div class="main">

<div class="sidebar">

<h4>Student Panel</h4>

<a href="#"><i class="fa fa-home"></i> Dashboard</a>

<a href="request_meeting.php">
<i class="fa fa-calendar-plus"></i> Request Meeting
</a>

<a href="#"><i class="fa fa-clock"></i> My Meetings</a>

<a href="#"><i class="fa fa-bell"></i> Notifications</a>

<a href="#"><i class="fa fa-headset"></i> Helpdesk</a>

</div>

<div class="content">

<h2>Welcome, <?php echo $name; ?></h2>

<div class="cards">

<!-- Upcoming -->
<div class="card">
<h3>Upcoming Meetings</h3>
<div class="stat">
<?php
$res = mysqli_query($conn,"SELECT COUNT(*) as total 
FROM meetings 
WHERE student_id='$student_id' 
AND status='Approved' 
AND meeting_date >= CURDATE()");
$data = mysqli_fetch_assoc($res);
echo $data['total'];
?>
</div>
</div>

<!-- Pending -->
<div class="card">
<h3>Pending Requests</h3>
<div class="stat">
<?php
$res = mysqli_query($conn,"SELECT COUNT(*) as total 
FROM meetings 
WHERE student_id='$student_id' 
AND status='Pending'");
$data = mysqli_fetch_assoc($res);
echo $data['total'];
?>
</div>
</div>

<!-- Completed -->
<div class="card">
<h3>Completed</h3>
<div class="stat">
<?php
$res = mysqli_query($conn,"SELECT COUNT(*) as total 
FROM meetings 
WHERE student_id='$student_id' 
AND status='Approved' 
AND meeting_date < CURDATE()");
$data = mysqli_fetch_assoc($res);
echo $data['total'];
?>
</div>
</div>

</div>

<!-- TABLE -->
<div class="table">

<h3>My Meeting Requests</h3>

<table>

<tr>
<th>Faculty</th>
<th>Date</th>
<th>Time</th>
<th>Purpose</th>
<th>Status</th>
</tr>

<?php
$sql = "SELECT m.*, u.name as faculty_name 
FROM meetings m
JOIN users u ON m.faculty_id = u.id
WHERE m.student_id='$student_id'
ORDER BY m.id DESC";

$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)) {

    $status = strtolower($row['status']);

    echo "<tr>
    <td>".$row['faculty_name']."</td>
    <td>".$row['meeting_date']."</td>
    <td>".$row['meeting_time']."</td>
    <td>".$row['purpose']."</td>
    <td><span class='status $status'>".$row['status']."</span></td>
    </tr>";
}
?>

</table>

</div>

</div>

</div>

</body>
</html>