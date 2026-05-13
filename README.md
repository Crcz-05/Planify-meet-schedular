📅 Meeting Scheduling System
A modern web-based Meeting Scheduling System developed to simplify and structure the communication process between students and faculty members for booking meetings through mutual agreement and approval workflows.
The system eliminates confusion caused by WhatsApp chats, emails, and phone calls by providing a centralized platform where users can request, approve, reject, reschedule, and confirm meetings efficiently.

🚀 Features
👤 User Authentication


Secure Login System


Role-Based Access (Student / Faculty)


Session Management



🎓 Student Module


Send Meeting Requests


Select Faculty & Department


Add Purpose of Meeting


View Meeting Status


Accept/Reject Proposed Time


Receive Email Notifications



👨‍🏫 Faculty Module


View Incoming Requests


Approve Meeting Requests


Reject Requests


Propose Alternate Time Slots


Receive Instant Email Notifications



🔄 Dual Approval Workflow
A meeting is finalized only when both student and faculty confirm availability.
Workflow:
Student Sends Request        ↓Faculty Reviews Request        ↓Approve / Reject / Propose New Time        ↓Student Confirms or Rejects        ↓Meeting Confirmed

📧 Email Notification System
The system automatically sends email notifications during important actions:
📩 Notifications Sent To Faculty


When a new meeting request is submitted


📩 Notifications Sent To Student


When faculty approves request


When faculty rejects request


When faculty proposes new meeting time


When meeting gets confirmed



🔔 Additional Functionalities


Real-time Meeting Status Tracking


Meeting Rescheduling


Dynamic Dashboards


Responsive UI Design


Status Indicators:


Pending


Approved


Rejected


Proposed


Confirmed





🛠️ Tech Stack
🌐 Frontend


HTML5


CSS3


JavaScript


⚙️ Backend


PHP


🗄️ Database


MySQL


💻 Development Environment


VS Code


XAMPP Server


phpMyAdmin



📂 Project Structure
meeting-scheduling-system/
│
├── frontend/
│   ├── css/
│   │   └── style.css
│   │
│   ├── js/
│   │   ├── login.js
│   │   ├── student_dashboard.js
│   │   ├── faculty_dashboard.js
│   │   └── meeting_request.js
│   │
│   ├── login.html
│   ├── student_dashboard.html
│   ├── faculty_dashboard.html
│   └── meeting_request.html
│
├── backend/
│   ├── db.php
│   ├── login.php
│   ├── create_meeting.php
│   ├── fetch_meetings.php
│   └── update_meeting.php
│
└── README.md

🗄️ Database Design
Users Table
idnameemailpasswordroledepartment
Meetings Table
idstudent_namefaculty_namedepartmentmeeting_timepurposefaculty_statusstudent_confirmed

⚡ API Endpoints
API FileFunctionlogin.phpUser Authenticationcreate_meeting.phpCreate New Meetingfetch_meetings.phpRetrieve Meetingsupdate_meeting.phpUpdate Meeting Status

🎯 Project Objectives


Simplify meeting coordination


Reduce communication confusion


Ensure mutual availability confirmation


Provide structured workflow


Maintain meeting history records


Improve scheduling efficiency



🔮 Future Enhancements


Google Calendar Integration


AI-based Time Suggestions


Real-time Notifications using WebSockets


OTP Authentication


Mobile Application Support


Timetable Conflict Detection


Video Meeting Integration


📌 Conclusion
The Meeting Scheduling System provides a centralized and structured solution for handling meeting appointments between students and faculty. By introducing approval workflows, dynamic notifications, and dual confirmation mechanisms, the system improves communication efficiency and minimizes scheduling conflicts.

⭐ Developed Using


VS Code


XAMPP


PHP


MySQL


HTML/CSS/JavaScript

