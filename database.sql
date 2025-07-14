-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2025 at 06:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `job_id`, `full_name`, `email`, `phone`, `resume`, `applied_at`) VALUES
(5, 8, 'Sujan Kumar K', 'mail4sujankumar@gmail.com', '07829079853', '1752492667_webResume (3).pdf', '2025-07-14 11:31:07'),
(6, 9, 'Sujan Kumar K', 'mail4sujankumar@gmail.com', '07829079853', '1752492693_webResume (3).pdf', '2025-07-14 11:31:33'),
(7, 13, 'Sujan Kumar K', 'mail4sujankumar@gmail.com', '07829079853', '1752492712_webResume (3).pdf', '2025-07-14 11:31:52'),
(8, 8, 'Sathwik Kumar K', 'sujan.22cs164@sode-edu.in', '07829079853', '1752492752_webResume (3).pdf', '2025-07-14 11:32:32'),
(9, 8, 'Abhay', 'abhay@gmail.com', '9876543373', '1752492798_swResume (2).pdf', '2025-07-14 11:33:18');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `salary_min` int(11) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `status` enum('Open','Closed') DEFAULT 'Open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `description`, `location`, `skills`, `salary_min`, `deadline`, `status`, `created_at`) VALUES
(8, 'Frontend Web Developer', 'We\'re looking for a creative Frontend Developer to join our team and bring our web interfaces to life. You will work with designers and backend developers to create smooth, interactive user experiences using React.js and modern CSS frameworks.', 'Bengaluru, India', 'HTML, CSS, JavaScript, React.js, UI/UX', 600000, '2025-07-31', 'Open', '2025-07-14 10:39:42'),
(9, 'Backend Developer (Node.js)', 'Join our fast-growing tech startup as a Backend Developer. You’ll be responsible for creating secure, scalable APIs and working with MongoDB and Node.js to build out server-side logic that powers our platform.', 'Remote', 'Node.js, Express, MongoDB, REST APIs', 700000, '2025-08-15', 'Open', '2025-07-14 10:40:19'),
(10, 'Data Analyst', 'We are hiring a detail-oriented Data Analyst to extract insights from large datasets and support business decision-making. You\'ll work with cross-functional teams to analyze trends and report KPIs using Power BI and SQL.', 'Pune, India', 'SQL, Python, Excel, Power BI, Data Visualization', 500000, '2025-08-10', 'Open', '2025-07-14 10:40:51'),
(11, 'DevOps Engineer', 'As a DevOps Engineer, you’ll streamline our deployment pipeline and ensure high availability for our cloud-based systems. Experience with Kubernetes and infrastructure automation is a must.', 'Hyderabad, India', 'Docker, Kubernetes, Jenkins, CI/CD, AWS', 1000000, '2025-08-01', 'Open', '2025-07-14 10:41:57'),
(12, 'Android App Developer', 'We’re hiring a passionate Android Developer to design and build advanced mobile applications. You will work closely with the product team to implement new features and optimize app performance.', 'Mumbai, India', 'Kotlin, Java, Firebase, Android SDK', 650000, '2025-07-28', 'Open', '2025-07-14 10:42:43'),
(13, 'Full Stack Developer (MERN Stack)', 'We\'re seeking a Full Stack Developer proficient in MERN stack to develop dynamic web applications from end to end. You\'ll work on both frontend UI and backend APIs, collaborating in an agile environment.\r\n\r\n', 'Chennai, India', 'MongoDB, Express.js, React.js, Node.js', 800000, '2025-08-20', 'Open', '2025-07-14 10:43:23'),
(14, 'UI/UX Designer', 'We’re looking for a UI/UX Designer to create intuitive user interfaces and user-centered designs. You\'ll participate in user research, prototyping, and collaborate with frontend developers to implement your designs.\r\n\r\n', 'Remote', 'Figma, Adobe XD, Wireframing, User Research', 400000, '2025-08-05', 'Open', '2025-07-14 10:44:19'),
(15, 'Cybersecurity Analyst', 'Protect our infrastructure and data by joining as a Cybersecurity Analyst. You\'ll monitor threats, conduct vulnerability assessments, and implement security protocols across cloud and on-premise systems.\r\n\r\n', 'Delhi NCR', 'Network Security, Firewalls, SIEM, Risk Assessment', 900000, '2025-07-30', 'Open', '2025-07-14 10:44:51'),
(16, 'Machine Learning Engineer', 'Build predictive models and intelligent systems using machine learning. We’re looking for someone who can translate data into insights and deploy models that improve business outcomes.\r\n\r\n', 'Bangalore, India', 'Python, TensorFlow, Scikit-learn, ML Pipelines', 1200000, '2025-08-18', 'Open', '2025-07-14 10:45:49'),
(17, 'Technical Content Writer', 'We need a Technical Content Writer to produce developer-focused articles, documentation, and tutorials. Your work will help users understand and integrate our products better.\r\n\r\n', 'Remote', 'Technical Writing, Markdown, Git, SEO', 350000, '2025-07-27', 'Open', '2025-07-14 10:46:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `job_id` (`job_id`,`email`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
