-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 07:00 AM
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
-- Database: `rainy_season_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `eoi_number` int NOT NULL PRIMARY KEY,
  `job_reference_number` varchar(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `address_street` varchar(40) NOT NULL,
  `address_suburb` varchar(40) NOT NULL,
  `address_state` enum('VIC','ACT','NT','NSW','QLD','WA','SA','TAS') NOT NULL,
  `address_postcode` int(11) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `skill_1` tinyint(1) NOT NULL,
  `skill_2` tinyint(1) NOT NULL,
  `skill_3` tinyint(1) NOT NULL,
  `skill_4` tinyint(1) NOT NULL,
  `skill_5` tinyint(1) NOT NULL,
  `other_skills` text NOT NULL,
  `eoi_status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_reference_number` varchar(5) NOT NULL,
  `position` varchar(50) NOT NULL,
  `salary_min` int(11) NOT NULL,
  `salary_max` int(11) NOT NULL,
  `description` text NOT NULL,
  `reports_to` varchar(50) NOT NULL,
  `key_responsbility_1` text NOT NULL,
  `key_responsbility_2` text NOT NULL,
  `key_responsbility_3` text NOT NULL,
  `essential_skills_1` text NOT NULL,
  `essential_skills_2` text NOT NULL,
  `essential_skills_3` text NOT NULL,
  `preferrable_skills_1` text NOT NULL,
  `preferrable_skills_2` text NOT NULL,
  `preferrable_skills_3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_reference_number`, `position`, `salary_min`, `salary_max`, `description`, `reports_to`, `key_responsbility_1`, `key_responsbility_2`, `key_responsbility_3`, `essential_skills_1`, `essential_skills_2`, `essential_skills_3`, `preferrable_skills_1`, `preferrable_skills_2`, `preferrable_skills_3`) VALUES
('RX7FD', 'Cybersecurity Specialist', 150000, 180000, 'Protect Rainy Season\'s network infrastructure and data by designing and implementing robust security systems. The role involves performing comprehensive risk assessments, identifying vulnerabilities, and proactively addressing potential threats before they can be exploited.\r\n\r\nYou will be responsible for developing incident response plans, auditing current systems, and staying up to date with the latest cybersecurity trends and compliance requirements. Regularly evaluate third-party services and software to ensure adherence to security standards. Additionally, you will work closely with development, operations, and compliance teams to integrate security into every stage of the software lifecycle.', 'Chief Information Security Officer (CISO)', 'Design, install, and maintain cybersecurity systems', 'Discuss and implement security measures in collaboration with various IT teams in the company', 'Monitor security warnings and alerts and respond to security threats', 'Minimum 2 years of experience working with cybersecurity measures such as firewalls', 'Rich knowledge of and familiarity with security controls', 'Strong problem-solving skills', 'Good communication skills and willingness to work with other people in a social and team setting', 'Certification such as CISSP, CEH, or CISM', 'Familiarity with Python'),
('SIGC8', 'Software Developer', 120000, 150000, 'Develop and maintain high-quality software solutions for Rainy Season. The role involves working across the full software development lifecycle, from planning and design through to implementation and maintenance.\r\n\r\nYou will be expected to write clean, efficient, and well-documented code that aligns with business goals and user requirements. You will also be responsible for conducting code reviews, writing unit and integration tests, and contributing to technical documentation. The role requires strong attention to detail and a proactive mindset to identify areas of improvement and optimize performance. Working closely with designers, product managers, and IT teams, you will help ensure that software products are scalable, secure, and robust enough to support long-term company growth.', 'Lead Software Engineer', 'Develop, test, and maintain software applications to support company operations', 'Identify and resolve software defects and performance issues', 'Work closely with other teams to integrate software solutions with existing systems', 'Minimum 3 years of experience in software development', 'Strong knowledge of programming languages such as Python, Java, or C++', 'Strong problem-solving skills', 'Good communication skills and willingness to work with other people in a social and team setting', 'Experience with cloud computing platforms such as AWS or Azure', 'Familiarity with Agile development methodologies');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`eoi_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `eoi_number` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
