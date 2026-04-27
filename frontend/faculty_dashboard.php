<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'faculty') {
    header("Location: login.php");
    exit();
}

$conn=mysqli_connect("localhost","root","","meeting_scheduler");
$faculty_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>

<head>

<title>Faculty Dashboard</title>

<link rel="stylesheet" href="css/style.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<script>

function toggleNotifications(event)
{
    event.stopPropagation();

    var box=document.getElementById("notifyBox");

    if(box.style.display==="block")
        box.style.display="none";
    else
        box.style.display="block";
}

document.addEventListener("click", function() {
    document.getElementById("notifyBox").style.display = "none";
    document.getElementById("profileDropdown").style.display = "none";
});


function openModal(type, id)
{
    document.getElementById("modalBox").style.display = "block";

    document.getElementById("meeting_id").value = id;
    document.getElementById("action_type").value = type;

    document.getElementById("venueBox").style.display = "none";
    document.getElementById("rescheduleBox").style.display = "none";
    document.getElementById("rejectMessage").style.display = "none"; // (you added earlier)

    
    let btn = document.getElementById("submitBtn");

    if(type == "approve") {
        btn.innerText = "Approve";
        document.getElementById("venueBox").style.display = "block";
    }

    if(type == "reschedule") {
        btn.innerText = "Reschedule";
        document.getElementById("rescheduleBox").style.display = "block";
    }

    if(type == "reject") {
        btn.innerText = "Reject";
        document.getElementById("rejectMessage").style.display = "block";
    }
}

function closeModal()
{
    document.getElementById("modalBox").style.display = "none";
}


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
$res=mysqli_query($conn,"SELECT COUNT(*) as total FROM notifications WHERE user_id='$faculty_id'");
$data=mysqli_fetch_assoc($res);
echo $data['total'];
?>
</span>

<div class="notification-box" id="notifyBox" style="display:none;">

<h4>Notifications</h4>

<?php
$sql="SELECT * FROM notifications WHERE user_id='$faculty_id' ORDER BY id DESC";
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result))
{
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
                <h4><?php echo $_SESSION['name']; ?></h4>
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

<h4>Faculty Panel</h4>

<a href="#"><i class="fa fa-home"></i>Dashboard</a>
<a href="#"><i class="fa fa-clock"></i>Meeting Requests</a>
<a href="#"><i class="fa fa-check"></i>Approved Meetings</a>
<a href="#"><i class="fa fa-times"></i>Rejected Meetings</a>
<a href="#"><i class="fa fa-headset"></i>Helpdesk</a>

</div>

<div class="content">

<h2>Welcome, <?php echo $_SESSION['name']; ?></h2>

<div class="cards">

<div class="card">
<h3>Total Requests</h3>
<div class="stat">
<?php
$res=mysqli_query($conn,"SELECT COUNT(*) as total FROM meetings WHERE faculty_id='$faculty_id'");
$data=mysqli_fetch_assoc($res);
echo $data['total'];
?>
</div>
</div>

<div class="card">
<h3>Pending</h3>
<div class="stat">
<?php
$res=mysqli_query($conn,"SELECT COUNT(*) as total FROM meetings WHERE faculty_id='$faculty_id' AND status='Pending'");
$data=mysqli_fetch_assoc($res);
echo $data['total'];
?>
</div>
</div>

<div class="card">
<h3>Approved</h3>
<div class="stat">
<?php
$res=mysqli_query($conn,"SELECT COUNT(*) as total FROM meetings WHERE faculty_id='$faculty_id' AND status='Approved'");
$data=mysqli_fetch_assoc($res);
echo $data['total'];
?>
</div>
</div>

</div>

<div class="table">

<h3>Meeting Requests</h3>

<table width="100%">

<tr>
<th>Student</th>
<th>Date</th>
<th>Time</th>
<th>Purpose</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
$sql="SELECT m.*, u.name as student_name
FROM meetings m
JOIN users u ON m.student_id = u.id
WHERE m.faculty_id='$faculty_id'
ORDER BY m.id DESC";
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result))
{
echo "<tr>";

echo "<td>".$row['student_name']." (ID: ".$row['student_id'].")</td>";
echo "<td>".$row['meeting_date']."</td>";   
echo "<td>".$row['meeting_time']."</td>";   
echo "<td>".$row['purpose']."</td>";
echo "<td>".$row['status']."</td>";

echo "<td>";

if($row['status']=="Pending")
{
?>
<button class="btn-approve" onclick="openModal('approve', <?php echo $row['id']; ?>)">Approve</button>

<button class="btn-reject" onclick="openModal('reject', <?php echo $row['id']; ?>)">Reject</button>

<button class="btn-reschedule" onclick="openModal('reschedule', <?php echo $row['id']; ?>)">Reschedule</button>
<?php
}
else
{
    echo "-";
}

echo "</td>";
echo "</tr>";
}
?>

</table>

</div>

</div>

</div>

<div id="modalBox" style="display:none; position:fixed; top:30%; left:40%; background:white; padding:20px; border-radius:10px; box-shadow:0 0 10px gray;">

<form action="../backend/update_meeting.php" method="POST">

<input type="hidden" name="meeting_id" id="meeting_id">
<input type="hidden" name="action" id="action_type">

<p id="rejectMessage" style="display:none; font-weight:500; color:#444;">
    Are you sure you want to reject this meeting?
</p>

<div id="venueBox" style="display:none;">
<label>Enter Venue:</label>
<input type="text" name="venue">
</div>

<div id="rescheduleBox" style="display:none;">

<label>New Date:</label>
<input type="date" name="proposed_date">

<label>New Time:</label>
<input type="time" name="proposed_time">

<label>Venue:</label>
<input type="text" name="reschedule_venue" placeholder="Enter Venue">

</div>

<br><br>

<button type="submit" id="submitBtn">Submit</button>
<button type="button" onclick="closeModal()">Cancel</button>

</form>

</div>

</body>
</html>