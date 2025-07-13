-- Jobs Table
CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    location VARCHAR(100),
    skills TEXT,
    salary VARCHAR(50),
    deadline DATE,
    status ENUM('Open', 'Closed') DEFAULT 'Open',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Applicants Table
CREATE TABLE applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT,
    full_name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    resume VARCHAR(255),
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (job_id, email),
    FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE
);
