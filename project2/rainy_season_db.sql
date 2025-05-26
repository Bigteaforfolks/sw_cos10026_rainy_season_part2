-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 11:01 AM
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
  `eoi_number` int(11) NOT NULL,
  `job_reference_number` varchar(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `date_of_birth` varchar(10) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `address_street` varchar(40) NOT NULL,
  `address_suburb` varchar(40) NOT NULL,
  `address_state` enum('VIC','ACT','NT','NSW','QLD','WA','SA','TAS') NOT NULL,
  `address_postcode` varchar(4) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `skill_wireshark` tinyint(1) NOT NULL,
  `skill_csharp` tinyint(1) NOT NULL,
  `skill_jira` tinyint(1) NOT NULL,
  `skill_github` tinyint(1) NOT NULL,
  `skill_scriptkiddie` tinyint(1) NOT NULL,
  `other_skills` text NOT NULL,
  `eoi_status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`eoi_number`, `job_reference_number`, `first_name`, `last_name`, `date_of_birth`, `gender`, `address_street`, `address_suburb`, `address_state`, `address_postcode`, `email_address`, `phone_number`, `skill_wireshark`, `skill_csharp`, `skill_jira`, `skill_github`, `skill_scriptkiddie`, `other_skills`, `eoi_status`) VALUES
(1, 'RX7FD', 'Astra', 'Yao', '31/01/1999', 'female', '564 Sixth St.', 'New Eridu', 'VIC', '3001', 'astrayao@starsoflyra.com', '0444044044', 1, 1, 1, 0, 0, '', 'Final'),
(2, 'SIGC8', 'Mao', 'Mao', '21/10/1995', 'female', '888 Kaou St.', 'Country of Li', 'NSW', '1222', 'maomao@apothecary.com', '0777077077', 1, 1, 0, 0, 1, '', 'Current'),
(3, 'RX7FD', 'Gregory', 'House', '15/05/1959', 'male', '267-274 Princeton Rd.', 'Plainsboro', 'QLD', '4972', 'ghouse@ppth.net', '0927628044', 1, 0, 1, 1, 1, 'The medicine drug', 'New'),
(4, 'SIGC8', 'Mizuki', 'Akiyama', '27/08/2003', 'other', '229 Dogenzaka Rd.', 'Shibuya', 'TAS', '7634', 'amia@nc25ji.com', '0382087124', 0, 1, 1, 1, 0, 'Video editing', 'New');

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
  `key_responsibility_1` text NOT NULL,
  `key_responsibility_2` text NOT NULL,
  `key_responsibility_3` text NOT NULL,
  `essential_skills_1` text NOT NULL,
  `essential_skills_2` text NOT NULL,
  `essential_skills_3` text NOT NULL,
  `preferable_skills_1` text NOT NULL,
  `preferable_skills_2` text NOT NULL,
  `preferable_skills_3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_reference_number`, `position`, `salary_min`, `salary_max`, `description`, `reports_to`, `key_responsibility_1`, `key_responsibility_2`, `key_responsibility_3`, `essential_skills_1`, `essential_skills_2`, `essential_skills_3`, `preferable_skills_1`, `preferable_skills_2`, `preferable_skills_3`) VALUES
('RX7FD', 'Cybersecurity Specialist', 150000, 180000, 'Protect Rainy Season\'s network infrastructure and data by designing and implementing robust security systems. The role involves performing comprehensive risk assessments, identifying vulnerabilities, and proactively addressing potential threats before they can be exploited.\r\n\r\nYou will be responsible for developing incident response plans, auditing current systems, and staying up to date with the latest cybersecurity trends and compliance requirements. Regularly evaluate third-party services and software to ensure adherence to security standards. Additionally, you will work closely with development, operations, and compliance teams to integrate security into every stage of the software lifecycle.', 'Chief Information Security Officer (CISO)', 'Design, install, and maintain cybersecurity systems', 'Discuss and implement security measures in collaboration with various IT teams in the company', 'Monitor security warnings and alerts and respond to security threats', 'Minimum 2 years of experience working with cybersecurity measures such as firewalls', 'Rich knowledge of and familiarity with security controls', 'Strong problem-solving skills', 'Good communication skills and willingness to work with other people in a social and team setting', 'Certification such as CISSP, CEH, or CISM', 'Familiarity with Python'),
('SIGC8', 'Software Developer', 120000, 150000, 'Develop and maintain high-quality software solutions for Rainy Season. The role involves working across the full software development lifecycle, from planning and design through to implementation and maintenance.\r\n\r\nYou will be expected to write clean, efficient, and well-documented code that aligns with business goals and user requirements. You will also be responsible for conducting code reviews, writing unit and integration tests, and contributing to technical documentation. The role requires strong attention to detail and a proactive mindset to identify areas of improvement and optimize performance. Working closely with designers, product managers, and IT teams, you will help ensure that software products are scalable, secure, and robust enough to support long-term company growth.', 'Lead Software Engineer', 'Develop, test, and maintain software applications to support company operations', 'Identify and resolve software defects and performance issues', 'Work closely with other teams to integrate software solutions with existing systems', 'Minimum 3 years of experience in software development', 'Strong knowledge of programming languages such as Python, Java, or C++', 'Strong problem-solving skills', 'Good communication skills and willingness to work with other people in a social and team setting', 'Experience with cloud computing platforms such as AWS or Azure', 'Familiarity with Agile development methodologies');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$6ckgGLeNs6huhCb/2/bVl.NcF7zvC./k8IfwRa1AiZPmQT8FGhJ9O'),
(2, 'admin2', '$2y$10$4mJiC0b.xGWIJ99zHeOe9e./.WXCl6yLwCsAEwDtMPE92UMJAUXqW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`eoi_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `eoi_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
