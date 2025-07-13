# 🧑‍💼 Job Application Portal

A full-stack web-based job application system built using **PHP**, **MySQL**, and **JavaScript**. It allows **admins** to post and manage job listings, and **applicants** to view and apply for jobs by uploading their resumes.

---

## 🚀 Features Implemented

### 👤 Admin Panel
- Hardcoded admin login system
- Add, Edit, Delete job listings
- Toggle job status (Open/Closed)
- View applicants for each job
- Download resumes (PDF)
- Export applicant data to CSV
- Applicant count per job (visible in dashboard)

### 🌐 Public Job Listing Page
- Filter jobs by:
  - Location
  - Minimum salary
  - Keyword (title, description, skills)
- View job details
- Pagination for job listings

### 📝 Application Form
- Apply to a job with:
  - Full Name
  - Email (unique per job)
  - Phone
  - Resume Upload (PDF only)
- Prevents duplicate applications (same email + job)
- AJAX-based form submission (no page reload)

---

## 🛠 Tech Stack

- **Backend**: PHP (Native)
- **Database**: MySQL / MariaDB
- **Frontend**: HTML, CSS, JavaScript
- **UI Styling**: Basic (You can use Bootstrap or Tailwind optionally)

---

## 📁 Project Structure

job-portal/
├── admin/
│ ├── login.php
│ ├── dashboard.php
│ ├── add_job.php
│ ├── edit_job.php
│ ├── delete_job.php
│ ├── view_applicants.php
│ ├── export_csv.php
│ └── logout.php
├── applications/
│ ├── apply.php
│ └── submit_application.php
├── public/
│ ├── index.php
│ └── job_detail.php
├── includes/
│ ├── db.php
│ ├── functions.php
├── resumes/
│ └── [Uploaded PDF resumes]
├── .env.php
├── database.sql
└── README.md


---

## 🧪 Setup Instructions

1. **Install XAMPP / LAMP / WAMP**
2. **Import the Database**
   - Open phpMyAdmin
   - Create a DB named `job_portal`
   - Import `database.sql`

3. **Project Setup**
   - Place the project in your `htdocs` or server folder
   - Edit `.env.php` to match your DB credentials:
     ```php
     return [
         'host' => 'localhost',
         'username' => 'root',
         'password' => '',
         'database' => 'job_portal',
     ];
     ```

4. **Launch**
   - Open your browser and go to:  
     `http://localhost/job-portal/public/index.php`
   - Admin Panel:  
     `http://localhost/job-portal/admin/login.php`  
     (Username: `admin`, Password: `admin123`)

---

## 🐛 Known Issues (if any)

- Minimal validation on client side (recommended to enhance)
- File upload path is relative; adjust for deployment
- Admin login is not secure (hardcoded, use sessions only)

---

## 👏 Credits

Created as part of an internship assessment for **Kurators**.
