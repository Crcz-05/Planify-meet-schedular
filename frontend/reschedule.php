<?php
$id=$_GET['id'];
?>

<!DOCTYPE html>

<html>

<head>

<title>Propose New Time</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="main">

<div class="content">

<h2>Propose New Meeting Time</h2>

<form action="../backend/update_meeting.php" method="POST">

<input type="hidden" name="meeting_id" value="<?php echo $id; ?>">

<label>New Date</label>

<input type="date" name="meeting_date" required>

<label>New Time</label>

<input type="time" name="meeting_time" required>

<label>Message</label>

<textarea name="purpose" placeholder="Reason for change"></textarea>

<button class="btn propose">Update Meeting</button>

</form>

</div>

</div>

</body>

</html>