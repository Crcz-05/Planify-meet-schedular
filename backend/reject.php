<?php

$conn=mysqli_connect("localhost","root","","meeting_scheduler");

$id=$_GET['id'];

$get="SELECT student_id FROM meetings WHERE id='$id'";

$res=mysqli_query($conn,$get);

$row=mysqli_fetch_assoc($res);

$student=$row['student_id'];

$sql="UPDATE meetings SET status='Rejected' WHERE id='$id'";

mysqli_query($conn,$sql);

$msg="Your meeting request was rejected";

mysqli_query($conn,"INSERT INTO notifications(user_id,message) VALUES('$student','$msg')");

header("Location: ../frontend/faculty_dashboard.php");

?>