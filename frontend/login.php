<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Meeting Scheduler</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f4f6f9;
}

/* background image */
.bg-img {
    position: fixed;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.12;
    z-index: -2;
}

.overlay {
    position: fixed;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.85);
    z-index: -1;
}

.wrapper {
    display: flex;
    width: 800px;
    height: 450px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    overflow: hidden;
    position: relative;
    z-index: 1;
}

/* left panel */
.left-panel {
    width: 45%;
    background: #2f3e5c;
    color: white;
    padding: 40px;
}

.left-panel h2 {
    margin-bottom: 10px;
}

/* right panel */
.right-panel {
    width: 55%;
    padding: 40px;
}

.tabs {
    display: flex;
    margin-bottom: 20px;
}

.tabs div {
    margin-right: 20px;
    cursor: pointer;
    font-weight: 600;
    color: #888;
}

.tabs .active {
    color: #2f3e5c;
    border-bottom: 2px solid #2f3e5c;
}

.input-group {
    position: relative;
    margin-bottom: 15px;
}

.input-group i {
    position: absolute;
    top: 12px;
    left: 10px;
    color: #888;
}

.input-group input,
.input-group select {
    width: 100%;
    padding: 10px 10px 10px 35px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 10px;
    background: #2f3e5c;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.helpdesk {
    margin-top: 15px;
    font-size: 13px;
    color: #666;
}

</style>

<script>
function showTab(tab) {
    document.getElementById("loginForm").style.display = (tab === 'login') ? "block" : "none";
    document.getElementById("registerForm").style.display = (tab === 'register') ? "block" : "none";

    document.getElementById("loginTab").classList.toggle("active", tab === 'login');
    document.getElementById("registerTab").classList.toggle("active", tab === 'register');
}
</script>

</head>

<body>

<!-- background -->

<div class="overlay"></div>

<div class="wrapper">

<div class="left-panel">
<h2>Meeting Scheduler</h2>
<p>Manage meetings between students and faculty efficiently.</p>
</div>

<div class="right-panel">

<div class="tabs">
<div id="loginTab" class="active" onclick="showTab('login')">Login</div>
<div id="registerTab" onclick="showTab('register')">Register</div>
</div>

<!-- LOGIN -->
<form id="loginForm" action="../backend/login.php" method="POST">

<div class="input-group">
<i class="fa fa-envelope"></i>
<input type="email" name="email" placeholder="Email" required>
</div>

<div class="input-group">
<i class="fa fa-lock"></i>
<input type="password" name="password" placeholder="Password" required>
</div>

<button type="submit">Login</button>

</form>

<!-- REGISTER -->
<form id="registerForm" action="../backend/register.php" method="POST" style="display:none;">

<div class="input-group">
<i class="fa fa-user"></i>
<input type="text" name="name" placeholder="Full Name" required>
</div>

<div class="input-group">
<i class="fa fa-envelope"></i>
<input type="email" name="email" placeholder="Email" required>
</div>

<div class="input-group">
<i class="fa fa-lock"></i>
<input type="password" name="password" placeholder="Password" required>
</div>

<div class="input-group">
<i class="fa fa-building"></i>
<input type="text" name="department" placeholder="Department (CSE, IT...)" required>
</div>

<div class="input-group">
<i class="fa fa-user-tag"></i>
<select name="role" required>
<option value="">Select Role</option>
<option value="student">Student</option>
<option value="faculty">Faculty</option>
</select>
</div>

<button type="submit">Register</button>

</form>

<div class="helpdesk">
<i class="fa fa-headset"></i> support@meetingscheduler.com
</div>

</div>

</div>

</body>
</html>