<?php

$conn=mysqli_connect("localhost","root","","meeting_scheduler");

$student_id=$_SESSION['user_id'];

$sql="SELECT users.name, meetings.meeting_date, meetings.meeting_time, meetings.purpose, meetings.status 

FROM meetings

JOIN users ON meetings.faculty_id=users.id

WHERE meetings.student_id='$student_id'

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

echo "</tr>";

}

?>