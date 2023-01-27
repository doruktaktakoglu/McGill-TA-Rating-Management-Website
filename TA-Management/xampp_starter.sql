-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 20, 2022 at 06:07 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xampp_starter`
--

-- --------------------------------------------------------

--
-- Table structure for table `Course`
--

CREATE TABLE `Course` (
  `courseName` varchar(256) NOT NULL,
  `courseDesc` varchar(256) NOT NULL,
  `term` varchar(8) NOT NULL,
  `year` varchar(4) NOT NULL,
  `courseNumber` varchar(8) NOT NULL,
  `courseInstructor` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Course`
--

INSERT INTO `Course` (`courseName`, `courseDesc`, `term`, `year`, `courseNumber`, `courseInstructor`) VALUES
('Principles of Web Development', 'The course discusses the major principles, algorithms, languages and technologies that underlie web development. Students receive practical hands-on experience through a project.', 'Fall', '2022', 'COMP 250', 'joseph@comp307.com'),
('Introduction to Computer Science', 'The course discusses the major principles, algorithms, languages and technologies that underlie web development. Students receive practical hands-on experience through a project.', 'Winter', '2019', 'COMP 250', 'joseph@comp307.com'),
('Honours Project in Computer Science and Biology', 'One-semester research project applying computational approaches to a biological problem. The project is (co)-supervised by a professor in Computer Science and/or Biology or related fields.', 'Winter', '2023', 'COMP 402', 'mathieu@comp307.com');

-- --------------------------------------------------------

--
-- Table structure for table `Course_Quota`
--

CREATE TABLE `Course_Quota` (
  `term_year` varchar(30) NOT NULL,
  `course_num` varchar(30) NOT NULL,
  `course_type` varchar(30) NOT NULL,
  `course_name` varchar(250) NOT NULL,
  `instructor_name` varchar(30) NOT NULL,
  `course_enrollement_num` varchar(5) NOT NULL,
  `ta_quota` varchar(5) NOT NULL,
  `flagged` varchar(5) NOT NULL,
  `ratio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Course_Quota`
--

INSERT INTO `Course_Quota` (`term_year`, `course_num`, `course_type`, `course_name`, `instructor_name`, `course_enrollement_num`, `ta_quota`, `flagged`, `ratio`) VALUES
('Fall 2022', 'COMP 250', '3 credits', 'Introduction to Computer Science', 'Joseph Vybihal', '250', '20', 'true', 13),
('Winter 2022', 'ARTH 333', '3 credits', 'Early Modern', 'art arty', '100', '35', 'true', 3),
('Winter 2022', 'COMP 250', '3 credits', 'Intro to Programming', 'Jonathan Campbell', '250', '20', 'true', 13),
('Winter 2022', 'COMP 303', '3 credits', 'Software Design', 'Martin Robillard', '250', '20', 'true', 13),
('Winter 2022', 'COMP 308', '1 credit', 'Computer Systems Lab', 'YES', '93', '3', 'false', 31),
('Winter 2022', 'ENVR 421', '3 credits', 'Montreal: Environmental History and Sustainability', 'Gwynn', '15', '15', 'true', 1),
('Winter 2022', 'GEOG 315', '3 credits', 'Urban Transportation Geography', 'Kevin Manaugh', '50', '25', 'true', 2),
('Winter 2022', 'MATH 122', '3 credits', 'Calculus for Management', 'Gabriel Duchesne', '392', '40', 'true', 10),
('Winter 2022', 'PHIL 200', '3 credits', 'Introduction to Philosophy', 'Emily Carson', '300', '20', 'true', 15),
('Winter 2022', 'RELG 355', '3 credits', 'Religion and the Arts', 'no one', '36', '36', 'true', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ed_stats`
--

CREATE TABLE `ed_stats` (
  `course_num` varchar(200) NOT NULL,
  `term_year` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `role` varchar(30) NOT NULL,
  `tutorial` varchar(200) NOT NULL,
  `sis_id` varchar(30) NOT NULL,
  `questions` varchar(30) NOT NULL,
  `posts` varchar(30) NOT NULL,
  `announcements` varchar(30) NOT NULL,
  `comments` varchar(30) NOT NULL,
  `answers` varchar(30) NOT NULL,
  `accepted_answers` varchar(30) NOT NULL,
  `hearts` varchar(30) NOT NULL,
  `endorsements` varchar(30) NOT NULL,
  `declines` varchar(30) NOT NULL,
  `declines_given` varchar(30) NOT NULL,
  `days_active` varchar(30) NOT NULL,
  `last_active` varchar(200) NOT NULL,
  `enrolled` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ed_stats`
--

INSERT INTO `ed_stats` (`course_num`, `term_year`, `name`, `email`, `role`, `tutorial`, `sis_id`, `questions`, `posts`, `announcements`, `comments`, `answers`, `accepted_answers`, `hearts`, `endorsements`, `declines`, `declines_given`, `days_active`, `last_active`, `enrolled`) VALUES
('COMP 250', 'Fall 2019', 'Joseph Vybihal', 'joseph.vybihal@mcgill.ca', 'admin', '', 'McG_3718', '248', '0', '0', '5', '28', '96', '87', '33', '0', '0', '0', '29', 'Fri, 09 Dec 2022 08:47:57 AEDT'),
('COMP 250', 'Fall 2022', 'Joseph Vybihal', 'joseph.vybihal@mcgill.ca', 'admin', '', 'McG_3718', '248', '0', '0', '5', '28', '96', '87', '33', '0', '0', '0', '29', 'Fri, 09 Dec 2022 08:47:57 AEDT'),
('COMP 250', 'Fall 2019', 'Joseph Vybihal', 'joseph.vybihal@mcgill.ca', 'admin', '', 'McG_3718', '248', '0', '0', '5', '28', '96', '87', '33', '0', '0', '0', '29', 'Fri, 09 Dec 2022 08:47:57 AEDT'),
('COMP 250', 'Fall 2022', 'Joseph Vybihal', 'joseph.vybihal@mcgill.ca', 'admin', '', 'McG_3718', '248', '0', '0', '5', '28', '96', '87', '33', '0', '0', '0', '29', 'Fri, 09 Dec 2022 08:47:57 AEDT'),
('COMP 250', 'Fall 2019', 'Joseph Vybihal', 'joseph.vybihal@mcgill.ca', 'admin', '', 'McG_3718', '248', '0', '0', '5', '28', '96', '87', '33', '0', '0', '0', '29', 'Fri, 09 Dec 2022 08:47:57 AEDT'),
('COMP 250', 'Fall 2022', 'Joseph Vybihal', 'joseph.vybihal@mcgill.ca', 'admin', '', 'McG_3718', '248', '0', '0', '5', '28', '96', '87', '33', '0', '0', '0', '29', 'Fri, 09 Dec 2022 08:47:57 AEDT');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `course` varchar(40) NOT NULL,
  `term` varchar(30) NOT NULL,
  `year` varchar(4) NOT NULL,
  `user` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `tag` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`course`, `term`, `year`, `user`, `time`, `message`, `tag`) VALUES
('COMP 250', 'Fall', '2022', 'hamdan.khan@mcgill.ca', '12/14/2022 5:58:35 PM', 'Hi everybody!', 'Chat'),
('COMP 250', 'Fall', '2022', 'saad.shahbaz@mcgill.ca', '12/15/2022 12:46:11 PM', 'Hello Everyone!', 'Announcement');

-- --------------------------------------------------------

--
-- Table structure for table `OfficeHours`
--

CREATE TABLE `OfficeHours` (
  `email` varchar(40) NOT NULL,
  `course` varchar(40) NOT NULL,
  `term` varchar(30) NOT NULL,
  `year` varchar(4) NOT NULL,
  `day` varchar(10) NOT NULL,
  `start_time` varchar(100) NOT NULL,
  `end_time` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `responsibilities` varchar(500) NOT NULL,
  `position` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `OfficeHours`
--

INSERT INTO `OfficeHours` (`email`, `course`, `term`, `year`, `day`, `start_time`, `end_time`, `location`, `responsibilities`, `position`) VALUES
('joseph@comp307.com', 'COMP 250', 'Fall', '2022', 'Monday', '10:00AM', '11:00AM', 'Zoom', 'OH', 'professor'),
('saad.shahbaz@mcgill.ca', 'COMP 250', 'Fall', '2022', 'Monday', '12:00 PM', '1:00 PM', 'Zoom', 'Lab', 'ta'),
('saumya.verma@mcgill.ca', 'COMP 250', 'Fall', '2022', 'Wednesday', '12:00 PM', '1:00 PM', 'Zoom', 'Office Hours', 'ta');

-- --------------------------------------------------------

--
-- Table structure for table `Professor`
--

CREATE TABLE `Professor` (
  `professor` varchar(40) NOT NULL,
  `faculty` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  `course` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Professor`
--

INSERT INTO `Professor` (`professor`, `faculty`, `department`, `course`) VALUES
('joseph@comp307.com', 'Science', 'Computer Science', 'COMP 250'),
('mathieu@comp307.com', 'Science', 'Computer Science', 'COMP 402');

-- --------------------------------------------------------

--
-- Table structure for table `Prof_Info`
--

CREATE TABLE `Prof_Info` (
  `email` varchar(40) NOT NULL,
  `faculty` varchar(40) NOT NULL,
  `department` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Student_Course`
--

CREATE TABLE `Student_Course` (
  `studentId` varchar(40) NOT NULL,
  `courseId` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Student_Course`
--

INSERT INTO `Student_Course` (`studentId`, `courseId`) VALUES
('saad.shahbaz@mcgill.ca', 'COMP 250'),
('ibrahim.naveed@mcgill.ca', 'COMP 250');

-- --------------------------------------------------------

--
-- Table structure for table `TA`
--

CREATE TABLE `TA` (
  `email` varchar(40) NOT NULL,
  `student_id` varchar(30) NOT NULL,
  `assigned_hours` varchar(4) NOT NULL,
  `ta_name` varchar(100) NOT NULL,
  `course` varchar(30) NOT NULL,
  `term` varchar(30) NOT NULL,
  `years` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `TA`
--

INSERT INTO `TA` (`email`, `student_id`, `assigned_hours`, `ta_name`, `course`, `term`, `years`) VALUES
('saad.shahbaz@mcgill.ca', '260845253', '90', 'Saad Shahbaz', 'COMP 250', 'Fall', '2022'),
('saumya.verma@mcgill.ca', '260845259', '180', 'Saumyaa Verma', 'Comp 250', 'Fall', '2022'),
('sym.piracha@mcgill.ca', '260845256', '90', 'Sym Piracha', 'COMP 250', 'Fall', '2022'),
('zahra.hussain@mcgill.ca', '260845254', '90', 'Zahra Hussain', 'COMP 250', 'Fall', '2022');

-- --------------------------------------------------------

--
-- Table structure for table `TA_COHORT`
--

CREATE TABLE `TA_COHORT` (
  `term_year` varchar(30) NOT NULL,
  `ta_name` varchar(100) NOT NULL,
  `student_id` varchar(40) NOT NULL,
  `legal_name` varchar(100) NOT NULL,
  `email` varchar(40) NOT NULL,
  `grad_ugrad` varchar(20) NOT NULL,
  `supervisor_name` varchar(100) NOT NULL,
  `priority` varchar(3) NOT NULL,
  `hours_allocated` varchar(4) NOT NULL,
  `date_applied` varchar(40) NOT NULL,
  `location_assigned` varchar(40) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `course_applied` varchar(100) NOT NULL,
  `open_to_other_courses` varchar(3) NOT NULL,
  `Notes` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `TA_COHORT`
--

INSERT INTO `TA_COHORT` (`term_year`, `ta_name`, `student_id`, `legal_name`, `email`, `grad_ugrad`, `supervisor_name`, `priority`, `hours_allocated`, `date_applied`, `location_assigned`, `phone`, `degree`, `course_applied`, `open_to_other_courses`, `Notes`) VALUES
('Winter 2022', 'Ann', '839298344', 'Ann Mickey', 'Ann.Micky@mail', 'grad', 'sunny', 'no', '180', '10/31/21', 'Montreal', '8348395594', 'Philosophy', 'PHIL 101', 'no', ''),
('Winter 2022', 'Chloe', '883822838', 'Chloe Vincent', 'Chloe.Vincent@mail', 'ugrad', 'grant', 'no', '180', '10/28/21', 'Montreal', '9589038656', 'Math', 'MATH 122', 'no', 'really wants to teach'),
('Winter 2022', 'Ella', '749322733', 'Ella Scarf', 'Ella.Scarf@mail', 'ugrad', 'poppy', 'no', '90', '10/27/21', 'Montreal', '7382651874', 'Computer Science', 'COMP 308', 'yes', ''),
('Winter 2022', 'Harry', '647333829', 'Harry Notebook', 'Harry.Notebook@mail', 'grad', 'lisa', 'no', '180', '10/30/21', 'Montreal', '1833248950', 'Religion', 'RELG 355', 'no', ''),
('Winter 2022', 'Joseph', '473227888', 'Joseph Drawer', 'Joseph.Drawer@mail', 'grad', 'ron', 'no', '180', '10/29/21', 'Montreal', '8373785984', 'Geography', 'GEOG 315', 'no', ''),
('Winter 2022', 'Julia', '639322665', 'Julia Bottle', 'Julia.Bottle@mail', 'ugrad', 'ruth', 'yes', '90', '10/25/21', 'Montreal', '8950932367', 'Art History', 'ARTH 333', 'yes', ''),
('Winter 2022', 'Maddie', '857622594', 'Maddie Mirror', 'Maddie.Mirror@mail', 'ugrad', 'bernard', 'yes', '90', '10/26/21', 'Montreal', '9039351234', 'Environment', 'ENVR 421', 'yes', ''),
('Winter 2022', 'Bob', '157322936', 'Robert Bunny', 'Robert.bunny@mcgill', 'grad', 'gwynn', 'yes', '90', '10/24/21', 'Montreal', '6873651223', 'Computer Science', 'COMP 202, COMP 303', 'yes', ''),
('Winter 2022', 'Saad', '260845253', 'Saad Shahbaz', 'saad.shahbaz@mcgill.ca', 'grad', 'gwynn', 'yes', '90', '10/24/21', 'Montreal', '6873651223', 'Computer Science', 'COMP 202, COMP 303', 'yes', '');

-- --------------------------------------------------------

--
-- Table structure for table `TA_PERFORMANCE_LOG`
--

CREATE TABLE `TA_PERFORMANCE_LOG` (
  `ta_email` varchar(30) NOT NULL,
  `term_year` varchar(30) NOT NULL,
  `course_num` varchar(30) NOT NULL,
  `ta_name` varchar(100) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `time_stamp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `TA_PERFORMANCE_LOG`
--

INSERT INTO `TA_PERFORMANCE_LOG` (`ta_email`, `term_year`, `course_num`, `ta_name`, `comment`, `time_stamp`) VALUES
('saad.shahbaz@mcgill.ca', 'Fall 2022', 'COMP 250', 'Saad Shahbaz', 'Checked alls assignments within deadline!', '2022-12-07 20:55:47'),
('saad.shahbaz@mcgill.ca', 'Fall 2022', 'COMP 250', 'Saad Shahbaz', 'Works Really Hard!', '2022-12-08 10:04:28'),
('saad.shahbaz@mcgill.ca', 'Fall 2022', 'COMP 250', 'Saad Shahbaz', 'Good TA!', '2022-12-11 23:40:16'),
('saad.shahbaz@mcgill.ca', 'Fall 2022', 'COMP 250', 'Saad Shahbaz', 'Saad is very hard working and I would love to have him in my class again!', '2022-12-14 04:31:44'),
('saumya.verma@mcgill.ca', 'Fall 2022', 'COMP 250', 'Saumyaa Verma', 'Saumyaa has submitted grades on time', '2022-12-14 04:38:55'),
('saumya.verma@mcgill.ca', 'Fall 2022', 'COMP 250', 'Saumyaa Verma', 'Attended all Office hours', '2022-12-14 04:39:02'),
('sym.piracha@mcgill.ca', 'Fall 2022', 'COMP 250', 'Sym Piracha', 'Very knowledgable and good response', '2022-12-14 04:40:24'),
('saad.shahbaz@mcgill.ca', 'Fall 2022', 'COMP 250', 'Saad Shahbaz', 'Saad has been an amazing TA, and I would love to have him next semester as well!', '2022-12-14 04:43:51'),
('zahra.hussain@mcgill.ca', 'Fall 2022', 'COMP 250', 'Zahra Hussain', 'Lacks basic compsci knowledge! Wouldn\'t want again!', '2022-12-14 04:47:23'),
('saad.shahbaz@mcgill.ca', 'Fall 2022', 'COMP 250', 'Saad Shahbaz', 'Good TA!', '2022-12-14 23:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `TA_Ratings`
--

CREATE TABLE `TA_Ratings` (
  `student_email` varchar(40) NOT NULL,
  `ta_email` varchar(30) NOT NULL,
  `rating` int(1) NOT NULL,
  `Notes` varchar(500) NOT NULL,
  `course` varchar(40) NOT NULL,
  `term` varchar(30) NOT NULL,
  `years` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `TA_Ratings`
--

INSERT INTO `TA_Ratings` (`student_email`, `ta_email`, `rating`, `Notes`, `course`, `term`, `years`) VALUES
('ali.malik@mcgill.ca', 'saad.shahbaz@mcgill.ca', 5, 'Saad has been very helpful, and I would love it if he could be my TA in COMP 251! I\'m really looking forward to learning from him again.', 'COMP 250', 'Fall', '2022'),
('hamdan.khan@mcgill.ca', 'saad.shahbaz@mcgill.ca', 5, 'Good TA!', 'COMP 250', 'Fall', '2022'),
('saad.shahbaz@mail.mcgill.ca', 'zahra.hussain@mcgill.ca', 1, 'Good TA!', 'COMP 250', 'Fall', '2022'),
('sym.piracha@mcgill.ca', 'saad.shahbaz@mcgill.ca', 5, 'I hope he is my TA in all the classes!', 'COMP 250', 'Fall', '2022'),
('zahra.hussain@mcgill.ca', 'saad.shahbaz@mcgill.ca', 5, 'Was not helpful', 'COMP 250', 'Fall', '2022');

-- --------------------------------------------------------

--
-- Table structure for table `TA_WISHLIST`
--

CREATE TABLE `TA_WISHLIST` (
  `ta_email` varchar(30) NOT NULL,
  `term_year` varchar(30) NOT NULL,
  `course_num` varchar(30) NOT NULL,
  `prof_name` varchar(100) NOT NULL,
  `ta_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `TA_WISHLIST`
--

INSERT INTO `TA_WISHLIST` (`ta_email`, `term_year`, `course_num`, `prof_name`, `ta_name`) VALUES
('saad.shahbaz@mcgill.ca', 'Fall 2022', 'COMP 250', 'Hamdan Khan ', 'Saad Shahbaz'),
('saad.shahbaz@mcgill.ca', 'Fall 2022', 'COMP 250', 'Joseph Vybihal', 'Saad Shahbaz'),
('saad.shahbaz@mcgill.ca', 'Fall 2022', 'COMP 250', 'Saad Shahbaz', 'Saad Shahbaz'),
('zahra.hussain@mcgill.ca', 'Fall 2022', 'COMP 250', 'Saad Shahbaz', 'Zahra Hussain');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `studentId` varchar(10) DEFAULT NULL,
  `username` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`firstName`, `lastName`, `email`, `password`, `createdAt`, `updatedAt`, `studentId`, `username`) VALUES
('Ali Murtaza', 'Malik', 'ali.malik@mcgill.ca', '$2y$10$BeRmXpghgI4W.4Ojow1.p.ONz04hf1dYVLqsH9ScI2fsAXpd8GG3C', '2022-12-08 13:17:42', '2022-12-08 13:19:08', '260845298', 'ali.malik'),
('Avinash', 'Bhat', 'avi@comp307.com', '$2y$10$iqQA5ffMBUaBn0weeSM8.eKbEwhyGPOqV.DxKL.Ox2A1cq.0QfpuW', '2022-10-11 04:42:50', '2022-12-14 02:51:42', '260876456', NULL),
('Doruk', 'Can', 'doruk@mcgill.ca', '$2y$10$paS3gzcHk/IYfzyRaKqEk.rxUFIg1EaxY8cYczt3cUqVmcazSSivG', '2022-12-10 06:39:25', '2022-12-14 02:51:20', '260845768', 'doruk.can'),
('Hamdan', 'Khan ', 'hamdan.khan@mcgill.ca', '$2y$10$EfZ.53AVNJr1PFEV/OAZk./bKyoyTEJi9bRPPNLlVdOGGKPG9qPkO', '2022-12-14 22:56:57', '2022-12-14 22:56:57', '260845251', 'hamdan.khan'),
('Ibrahim', 'Naveed', 'ibrahim.naveed@mcgill.ca', '$2y$10$.OXAfiIQ7h/8sTCxwCpLHu0tVzNi61LO1MCGBpHOkW4SjAaanOpL2', '2022-12-14 22:49:38', '2022-12-14 22:49:38', '260845251', 'ibrahim.naveed'),
('Jane', 'Doe', 'jane@comp307.com', '$2y$10$Jq/Ab6L6yPpGbPmyt5tC1e5uO81fP4YBLAow4LHPRgVtLjU8rcK7C', '2022-10-13 18:09:22', '2022-10-13 18:09:22', NULL, NULL),
('John', 'Doe', 'john@comp307.com', '$2y$10$jAGY.QSoQwIoTH13LWUaKu3LdCoYOG2zey0pz4qJNtTdaF3G4Elqy', '2022-10-09 16:46:43', '2022-10-09 16:46:43', NULL, NULL),
('Joseph', 'Vybihal', 'joseph@comp307.com', '$2y$10$Sw5w3wR5EEM4nQdFxcAFVutnGkHoLlyhv54MvSnn0BpvMX70XKtL6', '2022-10-13 14:36:07', '2022-12-14 21:14:28', NULL, NULL),
('Mathieu', 'Blanchette', 'mathieu@comp307.com', '$2y$10$5HxIGFEmYO6OyG7IOgjlmuCRofwLTG2Ah9DtiEdGetHD.rZZN0Xbq', '2022-10-13 18:09:22', '2022-10-13 18:09:22', NULL, NULL),
('Saad', 'Shahbaz', 'saad.shahbaz@mcgill.ca', '$2y$10$Sw5w3wR5EEM4nQdFxcAFVutnGkHoLlyhv54MvSnn0BpvMX70XKtL6', '2022-12-14 02:01:41', '2022-12-14 02:01:41', '260845253', 'saad.shahbaz'),
('Saumyaa', 'Verma', 'saumya.verma@mcgill.ca', '$2y$10$4WChTJyN.gsIXJfTEX02JeosHMKIBlUhTqnjUzULy.zTAIuaak7.a', '2022-12-14 01:40:51', '2022-12-14 01:40:51', '260845259', 'saumya.verma'),
('Sym', 'Piracha', 'sym.piracha@mcgill.ca', '$2y$10$5aicsVN7CiRJsKBCGaVhruQoUmR6p7oJMMJLnJrBe6c8dmQzFSXom', '2022-12-14 06:37:13', '2022-12-14 06:37:13', '260845256', 'sym.piracha'),
('Tamasha', 'Khan', 'tamasha.khan@gmail.com', '$2y$10$MxKN5e6JM0k973RE.MX0dev96TS0DcEQe0qW56VKKiwkXCvupZptC', '2022-12-20 02:26:42', '2022-12-20 02:26:42', '', 'tamasha.khan'),
('Zahra', 'Hussain', 'zahra.hussain@mcgill.ca', '$2y$10$Yibh0ujkpUrPtCCSS2DWGOZ3YfkFzWHuhbCZif3FIDTw/8st8eD62', '2022-12-04 10:48:16', '2022-12-04 10:48:16', '260845254', 'zahra.hussain');

-- --------------------------------------------------------

--
-- Table structure for table `UserType`
--

CREATE TABLE `UserType` (
  `idx` int(11) NOT NULL,
  `userType` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `UserType`
--

INSERT INTO `UserType` (`idx`, `userType`) VALUES
(1, 'student'),
(2, 'professor'),
(3, 'ta'),
(4, 'admin'),
(5, 'sysop');

-- --------------------------------------------------------

--
-- Table structure for table `USER_ACCESS`
--

CREATE TABLE `USER_ACCESS` (
  `email` varchar(40) NOT NULL,
  `userTypeId` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `USER_ACCESS`
--

INSERT INTO `USER_ACCESS` (`email`, `userTypeId`) VALUES
('ali.malik@mcgill.ca', '2'),
('saadshahbaz561@gmail.com', '3'),
('tamasha.khan@gmail.com', '2');

-- --------------------------------------------------------

--
-- Table structure for table `User_UserType`
--

CREATE TABLE `User_UserType` (
  `userId` varchar(40) NOT NULL,
  `userTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `User_UserType`
--

INSERT INTO `User_UserType` (`userId`, `userTypeId`) VALUES
('ali.malik@mcgill.ca', 1),
('avi@comp307.com', 5),
('doruk@mcgill.ca', 2),
('hamdan.khan@mcgill.ca', 1),
('hamdan.khan@mcgill.ca', 2),
('hamdan.khan@mcgill.ca', 3),
('hamdan.khan@mcgill.ca', 4),
('hamdan.khan@mcgill.ca', 5),
('ibrahim.naveed@mcgill.ca', 1),
('ibrahim.naveed@mcgill.ca', 2),
('ibrahim.naveed@mcgill.ca', 3),
('ibrahim.naveed@mcgill.ca', 4),
('ibrahim.naveed@mcgill.ca', 5),
('jane@comp307.com', 1),
('jane@comp307.com', 3),
('john@comp307.com', 5),
('joseph@comp307.com', 2),
('mathieu@comp307.com', 2),
('mathieu@comp307.com', 4),
('mathieu@comp307.com', 5),
('saad.shahbaz@mcgill.ca', 2),
('saad.shahbaz@mcgill.ca', 3),
('saad.shahbaz@mcgill.ca', 4),
('saad.shahbaz@mcgill.ca', 5),
('saumya.verma@mcgill.ca', 1),
('saumya.verma@mcgill.ca', 3),
('sym.piracha@mcgill.ca', 3),
('tamasha.khan@gmail.com', 2),
('zahra.hussain@mcgill.ca', 3),
('zahra.hussain@mcgill.ca', 4);

--
-- Indexes for dumped tables
--

INSERT INTO Prof_Info (email, faculty, department) VALUES ('joseph@comp307.com', 'Science', 'Computer Science');

INSERT INTO Prof_Info (email, faculty, department) VALUES ('mathieu@comp307.com', 'Science', 'Computer Science');
--
-- Indexes for table `Course`
--
ALTER TABLE `Course`
  ADD PRIMARY KEY (`courseNumber`,`term`,`year`),
  ADD KEY `CourseInstructor_ForeignKey` (`courseInstructor`);

--
-- Indexes for table `Course_Quota`
--
ALTER TABLE `Course_Quota`
  ADD PRIMARY KEY (`term_year`,`course_num`,`course_type`,`course_name`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`course`,`term`,`year`,`user`,`time`);

--
-- Indexes for table `OfficeHours`
--
ALTER TABLE `OfficeHours`
  ADD PRIMARY KEY (`email`,`course`,`term`,`year`,`day`,`start_time`,`end_time`),
  ADD KEY `OfficeHours_Course_ForeignKey` (`course`);

--
-- Indexes for table `Professor`
--
ALTER TABLE `Professor`
  ADD PRIMARY KEY (`professor`, `course`),
  ADD KEY `CourseNumber_ForeignKey` (`course`);

--
-- Indexes for table `Prof_Info`
--
ALTER TABLE `Prof_Info`
  ADD PRIMARY KEY (`email`,`faculty`,`department`);

--
-- Indexes for table `Student_Course`
--
ALTER TABLE `Student_Course`
  ADD KEY `Student_ForeignKey` (`studentId`),
  ADD KEY `Course_ForeignKey` (`courseId`);

--
-- Indexes for table `TA`
--
ALTER TABLE `TA`
  ADD PRIMARY KEY (`email`,`course`,`term`,`years`),
  ADD KEY `CourseNumber_ForeignKey` (`course`);

--
-- Indexes for table `TA_COHORT`
--
ALTER TABLE `TA_COHORT`
  ADD PRIMARY KEY (`email`,`student_id`,`term_year`);

--
-- Indexes for table `TA_PERFORMANCE_LOG`
--
ALTER TABLE `TA_PERFORMANCE_LOG`
  ADD PRIMARY KEY (`time_stamp`);

--
-- Indexes for table `TA_Ratings`
--
ALTER TABLE `TA_Ratings`
  ADD PRIMARY KEY (`student_email`,`ta_email`,`course`,`term`,`years`);

--
-- Indexes for table `TA_WISHLIST`
--
ALTER TABLE `TA_WISHLIST`
  ADD PRIMARY KEY (`ta_email`,`term_year`,`course_num`,`prof_name`,`ta_name`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`email`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `UserType`
--
ALTER TABLE `UserType`
  ADD PRIMARY KEY (`idx`),
  ADD KEY `idx` (`idx`);

--
-- Indexes for table `USER_ACCESS`
--
ALTER TABLE `USER_ACCESS`
  ADD PRIMARY KEY (`email`,`userTypeId`);

--
-- Indexes for table `User_UserType`
--
ALTER TABLE `User_UserType`
  ADD PRIMARY KEY (`userId`,`userTypeId`),
  ADD KEY `User_ForeignKey` (`userId`),
  ADD KEY `UserType_ForeignKey` (`userTypeId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Course`
--
ALTER TABLE `Course`
  ADD CONSTRAINT `CourseInstructor_ForeignKey` FOREIGN KEY (`courseInstructor`) REFERENCES `User` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`course`,`term`,`year`) REFERENCES `Course` (`courseNumber`, `term`, `year`);

--
-- Constraints for table `OfficeHours`
--
ALTER TABLE `OfficeHours`
  ADD CONSTRAINT `OfficeHours_Course_ForeignKey` FOREIGN KEY (`course`) REFERENCES `Course` (`courseNumber`) ON UPDATE CASCADE,
  ADD CONSTRAINT `OfficeHours_ForeignKey` FOREIGN KEY (`email`) REFERENCES `User` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `Professor`
--
ALTER TABLE `Professor`
  ADD CONSTRAINT `CourseNumber_ForeignKey` FOREIGN KEY (`course`) REFERENCES `Course` (`courseNumber`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ProfName_ForeignKey` FOREIGN KEY (`professor`) REFERENCES `User` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `Student_Course`
--
ALTER TABLE `Student_Course`
  ADD CONSTRAINT `Course_ForeignKey` FOREIGN KEY (`courseId`) REFERENCES `Course` (`courseNumber`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Student_ForeignKey` FOREIGN KEY (`studentId`) REFERENCES `User` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `TA`
--
ALTER TABLE `TA`
  ADD CONSTRAINT `TAemail_ForeignKey` FOREIGN KEY (`email`) REFERENCES `User` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `User_UserType`
--
ALTER TABLE `User_UserType`
  ADD CONSTRAINT `UserType_ForeignKey` FOREIGN KEY (`userTypeId`) REFERENCES `UserType` (`idx`) ON UPDATE CASCADE,
  ADD CONSTRAINT `User_ForeignKey` FOREIGN KEY (`userId`) REFERENCES `User` (`email`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
