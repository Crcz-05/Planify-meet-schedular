<?php

$conn=mysqli_connect("localhost","root","","meeting_scheduler");

$faculty_id=$_SESSION['user_id'];

$sql="SELECT users.name, meetings.id, meetings.meeting_date, meetings.meeting_time, meetings.purpose, meetings.status

FROM meetings

JOIN users ON meetings.student_id=users.id

WHERE meetings.faculty_id='$faculty_id'

ORDER BY meetings.id DESC";

$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result))
{

$status=$row['status'];

$color="pending";

if($status=="Approved")
$color="approved";

if($status=="Rejected")
$color="rejected";

if($status=="Rescheduled")
$color="rescheduled";

echo "<tr>";

echo "<td>".$row['name']."</td>";

echo "<td>".$row['meeting_date']."</td>";

echo "<td>".$row['meeting_time']."</td>";

echo "<td>".$row['purpose']."</td>";

echo "<td><span class='status $color'>".$status."</span></td>";

echo "<td>

<a href='../backend/approve.php?id=".$row['id']."' class='btn approve'>Approve</a>

<a href='../backend/reject.php?id=".$row['id']."' class='btn reject'>Reject</a>

<a href='../frontend/reschedule.php?id=".$row['id']."' class='btn propose'>Propose Time</a>

</td>";

echo "</tr>";

}

?>