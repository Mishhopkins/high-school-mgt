-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2024 at 08:42 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(20) NOT NULL,
  `role` varchar(250) NOT NULL,
  `dob` date NOT NULL,
  `hiredate` date NOT NULL,
  `address` varchar(30) NOT NULL,
  `sex` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `phone`, `email`, `role`, `dob`, `hiredate`, `address`, `sex`) VALUES
('ad-123-0', 'Christen Momanyi', '123', '2587416960', 'christine@gmail.com', 'SuperAdmin', '1993-11-20', '2022-07-20', 'p.o. box 20406, sotik', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `teacher_id` varchar(255) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `teacher_id`, `subject_id`, `class_id`, `description`, `file_name`, `file_path`, `created_at`) VALUES
(3, 'te-124-1', 7, 3, 'deadline is Monday next week ', 'assignment_65449c1a6223d.docx', 'C:/xampp/htdocs/school/module/docs/assignment_65449c1a6223d.docx', '2023-11-03 07:07:06');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `student_id` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `subject_id`, `student_id`, `status`, `date`) VALUES
(34, 7, 'st-2023-0023', 1, '2023-10-15 21:00:00'),
(35, 7, 'st-2023-0024', 1, '2023-10-15 21:00:00'),
(36, 7, 'st-2023-0025', 0, '2023-10-15 21:00:00'),
(41, 7, 'st-2023-0021', 1, '2023-10-16 21:00:00'),
(42, 7, 'st-2023-0023', 1, '2023-10-16 21:00:00'),
(43, 7, 'st-2023-0024', 1, '2023-10-16 21:00:00'),
(44, 7, 'st-2023-0025', 1, '2023-10-16 21:00:00'),
(45, 7, 'st-2023-0025', 1, '2023-11-01 21:00:00'),
(46, 7, 'st-2023-0026', 0, '2023-11-01 21:00:00'),
(47, 7, 'st-2023-0032', 0, '2023-11-01 21:00:00'),
(48, 7, 'st-2023-0031', 1, '2023-11-01 21:00:00'),
(49, 7, 'st-2023-0030', 1, '2023-11-01 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `id` int(11) NOT NULL,
  `bed_no` varchar(250) NOT NULL,
  `room_id` int(50) NOT NULL,
  `student_id` varchar(200) NOT NULL,
  `availability` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beds`
--

INSERT INTO `beds` (`id`, `bed_no`, `room_id`, `student_id`, `availability`) VALUES
(1, 'bd01', 6, 'st-2023-0023', 0),
(2, 'bd02', 2, 'st-2023-0024', 0),
(3, 'bd03', 2, 'st-2023-0025', 0),
(4, 'bd04', 2, 'st-2023-0026', 0),
(5, 'bd05', 2, 'st-2023-0028', 0),
(6, 'bd06', 2, 'st-2023-0030', 0),
(7, 'bd07', 2, 'st-2023-0031', 0),
(8, 'bd08', 2, 'st-2023-0032', 0),
(9, 'bd09', 2, 'st-2023-0033', 0),
(10, 'bd10', 2, '', 1),
(11, 'bd11', 2, '', 1),
(12, 'bd12', 2, '', 1),
(13, 'bd13', 2, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(100) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `no_students` int(100) NOT NULL,
  `classT_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_name`, `no_students`, `classT_id`) VALUES
(3, '1blue', 0, 'te-125-1'),
(4, '2blue', 0, 'te-2023-0001');

-- --------------------------------------------------------

--
-- Table structure for table `classteachers`
--

CREATE TABLE `classteachers` (
  `id` int(100) NOT NULL,
  `class_id` int(100) NOT NULL,
  `teacher_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classteachers`
--

INSERT INTO `classteachers` (`id`, `class_id`, `teacher_id`) VALUES
(1, 1, 'te-123-1'),
(2, 2, 'te-126-1'),
(3, 3, 'te-125-1'),
(4, 4, 'te-2023-0001');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `hod_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `hod_id`) VALUES
(1, 'Technicals', 'te-2023-0002'),
(2, 'Humanities', 'te-124-1'),
(3, 'Languages', 'te-125-1'),
(4, 'Mathematics', 'te-126-1'),
(5, 'Biology', 'te-127-1'),
(8, 'Physics', 'te-2023-0001'),
(9, 'Chemistry', 'te-125-1');

-- --------------------------------------------------------

--
-- Table structure for table `exam_marks`
--

CREATE TABLE `exam_marks` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `marks_obtained` float DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_marks`
--

INSERT INTO `exam_marks` (`id`, `student_id`, `exam_id`, `subject_id`, `marks_obtained`, `grade`, `status`, `remarks`, `created_at`) VALUES
(79, 'st-2023-0025', 5, 7, 20, 'N/A', NULL, 'N/A', '2023-11-01 07:42:30'),
(80, 'st-2023-0026', 5, 7, 90, 'A', NULL, 'Excellent', '2023-11-01 07:42:31'),
(81, 'st-2023-0027', 5, 7, 70, 'B', NULL, 'Good', '2023-11-01 07:42:31'),
(82, 'st-2023-0030', 5, 7, 88, 'A', NULL, 'Excellent', '2023-11-01 07:42:32'),
(83, 'st-2023-0031', 5, 7, 56, 'C', NULL, 'Average', '2023-11-01 07:42:32'),
(84, 'st-2023-0032', 5, 7, 65, 'C', NULL, 'Average', '2023-11-01 07:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedule`
--

CREATE TABLE `exam_schedule` (
  `id` int(11) NOT NULL,
  `subjectid` int(11) DEFAULT NULL,
  `facilitatorId` varchar(255) NOT NULL,
  `formId` int(100) NOT NULL,
  `examName` varchar(255) NOT NULL,
  `examStatus` varchar(50) NOT NULL,
  `examDate` date NOT NULL,
  `examTime` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `exam_progress` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_schedule`
--

INSERT INTO `exam_schedule` (`id`, `subjectid`, `facilitatorId`, `formId`, `examName`, `examStatus`, `examDate`, `examTime`, `created_at`, `exam_progress`) VALUES
(5, 7, 'te-2023-0003', 1, 'Bimapenya', 'Joint', '2023-11-02', '08:00:00', '2023-10-21 07:07:35', 0),
(10, 7, 'te-125-1', 1, 'Bimapenya', 'External', '2023-11-03', '05:05:00', '2023-10-31 10:03:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(50) NOT NULL,
  `amount` int(250) NOT NULL,
  `session_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `amount`, `session_id`) VALUES
(1, 50000, 1),
(2, 40000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` int(11) NOT NULL,
  `form` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `form`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(11) NOT NULL,
  `studentid` varchar(20) NOT NULL,
  `grade` varchar(5) NOT NULL,
  `courseid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `studentid`, `grade`, `courseid`) VALUES
(1, 'st-123-1', 'C', '8'),
(2, 'st-123-1', 'F', '4'),
(3, 'st-125-1', 'D+', '1'),
(4, 'st-123-1', 'D+', '1'),
(5, 'st-124-1', 'C+', '1'),
(6, 'st-124-1', 'A+', '1');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `grade` varchar(2) DEFAULT NULL,
  `min_marks` int(11) DEFAULT NULL,
  `max_marks` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `exam_id`, `subject_id`, `grade`, `min_marks`, `max_marks`, `remarks`, `created_at`) VALUES
(1, 5, 7, 'A', 80, 100, 'Excellent', '2023-11-01 05:34:13'),
(2, 5, 7, 'B', 70, 79, 'Good', '2023-11-01 05:34:13'),
(3, 5, 7, 'C', 50, 69, 'Average', '2023-11-01 05:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `hostelrooms`
--

CREATE TABLE `hostelrooms` (
  `id` int(50) NOT NULL,
  `room_no` int(50) NOT NULL,
  `hostel_id` int(50) NOT NULL,
  `availability` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hostelrooms`
--

INSERT INTO `hostelrooms` (`id`, `room_no`, `hostel_id`, `availability`) VALUES
(1, 1, 5, 1),
(2, 2, 1, 1),
(5, 3, 1, 1),
(6, 1, 5, 1),
(7, 2, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hostels`
--

CREATE TABLE `hostels` (
  `id` int(100) NOT NULL,
  `hostels_name` varchar(100) NOT NULL,
  `availability` int(100) NOT NULL,
  `master_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hostels`
--

INSERT INTO `hostels` (`id`, `hostels_name`, `availability`, `master_id`) VALUES
(1, 'KILIMANJARO', 1, 'te-2023-0004'),
(2, 'RUWENZORI', 1, 'te-2023-0003'),
(4, 'USAMBARA', 1, 'te-126-1'),
(5, 'MENENGAI', 1, 'te-2023-0001');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `fathername` varchar(20) NOT NULL,
  `mothername` varchar(20) NOT NULL,
  `fatherphone` varchar(13) NOT NULL,
  `motherphone` varchar(13) NOT NULL,
  `address` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `password`, `fathername`, `mothername`, `fatherphone`, `motherphone`, `address`) VALUES
('pa-123-1', '123', 'Erica', 'Sophie', '01711000000', '01711000000', '4286  Raoul Wallenberg Place'),
('pa-124-1', '123', 'John', 'Riley', '01724242424', '01924242314', '2549  Simpson Avenue'),
('pt-2023-0020', 'pt-2023-0020', 'kevin Moracha', 'Cathy Moracha', '0123456789', '0718045860', 'PO. Box 801, 20406'),
('pt-2023-0021', 'pt-2023-0021', 'kevin Moracha', 'Cathy Moracha', '+254718045860', '0718045860', 'PO. Box 801, 20406'),
('pt-2023-0023', 'pt-2023-0023', 'kevin Moracha', 'Cathy Moracha', '0456333665', '0123456789', 'PO. Box 801, 20407'),
('pt-2023-0024', 'pt-2023-0024', 'Erica jep', 'Cathy jep', '0456222665', '7898799798', 'PO. Box 801, 20406'),
('pt-2023-0025', 'pt-2023-0025', 'kevin Moracha', 'Cathy Moracha', '+254718045860', '0718045860', 'PO. Box 801, 20406'),
('pt-2023-0026', 'pt-2023-0026', 'Mwangi Mureithi', 'Mureithi Josephine', '0123456789', '0123456700', 'PO. Box 801, 20406'),
('pt-2023-0027', 'pt-2023-0027', 'Dac Ndamwe', 'Sista Ndamwe', '2578912478', '5489456213', 'PO. Box 801, 20412 Mombasa'),
('pt-2023-0028', 'pt-2023-0028', 'Erica jep', 'Sista Ndamwe', '023333022', '0712345678', 'PO. Box 801, 20406'),
('pt-2023-0030', 'pt-2023-0030', 'Ayuko Jairus', 'Ayuko Cynthia', '0456222665', '0456333665', 'PO. Box 801, 20408'),
('pt-2023-0031', 'pt-2023-0031', 'Peter Mueni', 'Mueni Alice', '2445566788', '0234446689', 'PO. Box 801, 20412 Mombasa'),
('pt-2023-0032', 'pt-2023-0032', 'Mishy Hopkins', 'Cathy Hopkins', '0456222665', '566664444', 'PO. Box 801, 20408'),
('pt-2023-0033', 'pt-2023-0033', 'Jeremy Ochieng\'', 'Mary Achieng\'', '0712478965', '0125489756', 'PO. Box 80, 40220, Kisumu');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `student_id` varchar(200) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `student_id`, `session_id`, `amount`, `paid_amount`, `balance`, `status`, `created_at`) VALUES
(1, '0', 1, 50000.00, 20000.00, 30000.00, 'not cleared', '2023-10-13 12:47:44'),
(2, '0', 1, 50000.00, 10000.00, 40000.00, 'not cleared', '2023-10-22 08:24:32'),
(3, '0', 1, 50000.00, 20000.00, 30000.00, 'not cleared', '2023-10-23 11:10:10'),
(4, '0', 1, 50000.00, 10000.00, 40000.00, 'not cleared', '2023-10-23 12:41:11'),
(5, '0', 1, 50000.00, 20000.00, 30000.00, 'not cleared', '2023-10-23 13:03:04'),
(6, 'st-2023-0032', 1, 50000.00, 20000.00, 30000.00, 'not cleared', '2023-10-23 13:27:32'),
(7, 'st-2023-0033', 1, 50000.00, 20000.00, 30000.00, 'not cleared', '2023-12-05 05:51:39');

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` int(11) NOT NULL,
  `payrollno` varchar(200) NOT NULL,
  `Teacher_id` varchar(255) NOT NULL,
  `payname` varchar(255) NOT NULL,
  `payemail` varchar(255) NOT NULL,
  `payphone` varchar(250) NOT NULL,
  `paysalary` double(10,2) NOT NULL,
  `paystatus` varchar(255) NOT NULL,
  `pay_description` longtext DEFAULT NULL,
  `paydategen` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payrolls`
--

INSERT INTO `payrolls` (`id`, `payrollno`, `Teacher_id`, `payname`, `payemail`, `payphone`, `paysalary`, `paystatus`, `pay_description`, `paydategen`) VALUES
(3, 'PQJMZ', 'te-125-1', 'James Rhoades', 'rhoadesj@gmail.com', '3214569874', 21000.00, 'Paid', '   Note: All the financial transactions are legally done as per the institutions laws  ', '2023-09-15 10:22:55'),
(4, 'K5SJM', 'te-124-1', 'Robert Sinde', 'robertj@gmail.com', '8520000010', 36000.00, '', '   Note: All the financial transactions are legally done as per the institutions laws ', '2023-09-21 15:51:37'),
(5, 'XBW17', 'te-124-1', 'Robert Sinde', 'robertj@gmail.com', '8520000010', 36000.00, '', ' mmm', '2023-10-17 07:33:14'),
(6, '2HVCB', 'te-2023-0003', 'Al mishael', 'al@gmail.com', '0456222665', 12500.00, '', ' reccomandable work', '2024-01-22 17:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportid` int(11) NOT NULL,
  `studentid` varchar(20) NOT NULL,
  `teacherid` varchar(20) NOT NULL,
  `message` varchar(500) NOT NULL,
  `courseid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`reportid`, `studentid`, `teacherid`, `message`, `courseid`) VALUES
(1, 'st-123-1', 'te-123-1', 'Good Boy', '790'),
(2, 'st-124-1', 'te-123-1', 'Good boy But not honest.', '790'),
(3, 'st-123-1', 'te-124-1', ' good', '1'),
(4, 'st-124-1', 'te-124-1', ' Good one, keep it up!', '1');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(100) NOT NULL,
  `sessionName` varchar(100) NOT NULL,
  `status` int(100) NOT NULL,
  `year` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `sessionName`, `status`, `year`) VALUES
(1, 'TERM 1', 0, '2023'),
(2, 'TERM 2', 1, '2023'),
(8, 'TERM 3', 0, '2023');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `dob` date NOT NULL,
  `hiredate` date NOT NULL,
  `address` varchar(30) NOT NULL,
  `salary` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `password`, `phone`, `email`, `sex`, `dob`, `hiredate`, `address`, `salary`) VALUES
('sta-123-1', 'Scott', '123', '1597534568', 'scootpel@gmail.com', 'Male', '1980-11-08', '2015-10-15', '2333  Cody Ridge Road', 25000),
('sta-124-1', 'Patrick', '123', '7412531325', 'pforpat@school.com', 'Male', '1990-03-26', '2017-05-12', '321  McDonald Avenue', 19500),
('sta-125-1', 'Aaron', '123', '2587532224', 'aarontay@gmail.com', 'Male', '1992-08-19', '2010-05-29', '4927  Water Street', 31000),
('sta-126-1', 'Peterson', '123', '2574545888', 'peteson@gmail.com', 'Male', '2021-04-01', '2012-05-05', '2950  Parrill Court', 27000);

-- --------------------------------------------------------

--
-- Table structure for table `streams`
--

CREATE TABLE `streams` (
  `id` int(11) NOT NULL,
  `streamName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `streams`
--

INSERT INTO `streams` (`id`, `streamName`) VALUES
(1, 'violet'),
(2, 'blue'),
(3, 'green'),
(4, 'yellow');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(20) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `dob` date NOT NULL,
  `addmissiondate` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `classid` varchar(20) NOT NULL,
  `hostelid` int(100) NOT NULL,
  `bedid` int(100) NOT NULL,
  `feeid` int(100) NOT NULL,
  `sessionid` int(100) NOT NULL,
  `file` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `password`, `phone`, `email`, `sex`, `dob`, `addmissiondate`, `address`, `classid`, `hostelid`, `bedid`, `feeid`, `sessionid`, `file`) VALUES
('st-2023-0025', 'Brenda Cherono', 'mish0025', '0456333665', 'brenda@gmail.com', 'Female', '2023-10-01', '2023-10-23', 'PO. Box 801, 20407', '3', 1, 3, 1, 1, 'studentst-2023-0025pic.jpg'),
('st-2023-0026', 'Bedan Mwangi', 'st-2023-0026', '0712345678', 'bedan@gmail.com', 'Male', '1999-01-01', '2023-10-23', 'PO. Box 801, 20412 Mombasa', '3', 1, 4, 2, 1, 'studentst-2023-0026pic.jpg'),
('st-2023-0027', 'Daina Ayuko', 'st-2023-0027', '215555666', 'daina@gmail.com', 'Female', '2023-10-01', '2023-10-23', 'PO. Box 801, 20406', '3', 1, 0, 0, 1, 'studentst-2023-0027pic.jpg'),
('st-2023-0028', 'Sadik Ndamwe', 'st-2023-0028', '0127856412', 'sadik@gmail.com', 'Male', '2023-10-01', '2023-10-23', 'PO. Box 801, 20408', '4', 1, 5, 3, 1, 'studentst-2023-0028pic.jpg'),
('st-2023-0030', 'Daina Ayuko', 'st-2023-0030', '215555666', 'daina@gmail.com', 'Female', '2023-10-01', '2023-10-23', 'PO. Box 801, 20406', '3', 1, 6, 4, 1, 'studentst-2023-0030pic.jpg'),
('st-2023-0031', 'Alice Peter', 'st-2023-0031', '4577788994', 'alice@gmail.com', 'Female', '2023-10-08', '2023-10-23', 'PO. Box 801, 20408', '3', 1, 7, 5, 1, 'studentst-2023-0031pic.jpg'),
('st-2023-0032', 'Brenda Cherono', 'st-2023-0032', '0456333665', 'brenda@gmail.com', 'Female', '2023-10-01', '2023-10-23', 'PO. Box 801, 20407', '3', 1, 8, 6, 1, 'studentst-2023-0032pic.jpg'),
('st-2023-0033', 'Lydia Achieng Charit', 'st-2023-0033', '0712564586', 'lydiaachieng@gmail.c', 'Female', '2005-01-05', '2023-12-05', 'PO. Box 80, 40220, Kisumu', '3', 1, 9, 7, 1, 'studentst-2023-0033pic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `student_parent`
--

CREATE TABLE `student_parent` (
  `id` int(11) NOT NULL,
  `student_id` varchar(200) DEFAULT NULL,
  `parent_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_parent`
--

INSERT INTO `student_parent` (`id`, `student_id`, `parent_id`) VALUES
(27, 'st-2023-0011', 'pt-2023-0013'),
(28, 'st-2023-0020', 'pt-2023-0020'),
(29, 'st-2023-0021', 'pt-2023-0021'),
(30, 'st-2023-0023', 'pt-2023-0023'),
(31, 'st-2023-0024', 'pt-2023-0024'),
(32, 'st-2023-0025', 'pt-2023-0025'),
(33, 'st-2023-0026', 'pt-2023-0026'),
(34, 'st-2023-0027', 'pt-2023-0027'),
(35, 'st-2023-0028', 'pt-2023-0028'),
(36, 'st-2023-0030', 'pt-2023-0030'),
(37, 'st-2023-0031', 'pt-2023-0031'),
(38, 'st-2023-0032', 'pt-2023-0032'),
(39, 'st-2023-0033', 'pt-2023-0033');

-- --------------------------------------------------------

--
-- Table structure for table `student_subjects`
--

CREATE TABLE `student_subjects` (
  `id` int(11) NOT NULL,
  `studentId` varchar(200) NOT NULL,
  `subjectId` int(11) DEFAULT NULL,
  `is_default` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_subjects`
--

INSERT INTO `student_subjects` (`id`, `studentId`, `subjectId`, `is_default`) VALUES
(28, 'st-2023-0021', 1, 0),
(29, 'st-2023-0021', 3, 0),
(30, 'st-2023-0021', 4, 0),
(31, 'st-2023-0021', 5, 0),
(32, 'st-2023-0021', 6, 0),
(33, 'st-2023-0021', 7, 0),
(34, 'st-2023-0021', 8, 0),
(35, 'st-2023-0021', 12, 0),
(36, 'st-2023-0021', 13, 0),
(37, 'st-2023-0021', 11, 0),
(40, 'st-2023-0023', 1, 0),
(41, 'st-2023-0023', 3, 0),
(42, 'st-2023-0023', 4, 0),
(43, 'st-2023-0023', 5, 0),
(44, 'st-2023-0023', 6, 0),
(45, 'st-2023-0023', 7, 0),
(46, 'st-2023-0023', 8, 0),
(47, 'st-2023-0023', 12, 0),
(48, 'st-2023-0023', 13, 0),
(49, 'st-2023-0023', 10, 0),
(50, 'st-2023-0024', 1, 0),
(51, 'st-2023-0024', 3, 0),
(52, 'st-2023-0024', 4, 0),
(53, 'st-2023-0024', 5, 0),
(54, 'st-2023-0024', 6, 0),
(55, 'st-2023-0024', 7, 0),
(56, 'st-2023-0024', 8, 0),
(57, 'st-2023-0024', 12, 0),
(58, 'st-2023-0024', 13, 0),
(59, 'st-2023-0024', 10, 0),
(60, 'st-2023-0025', 1, 0),
(61, 'st-2023-0025', 3, 0),
(62, 'st-2023-0025', 4, 0),
(63, 'st-2023-0025', 5, 0),
(64, 'st-2023-0025', 6, 0),
(65, 'st-2023-0025', 7, 0),
(66, 'st-2023-0025', 8, 0),
(67, 'st-2023-0025', 12, 0),
(68, 'st-2023-0025', 13, 0),
(69, 'st-2023-0025', 14, 0),
(70, 'st-2023-0026', 1, 0),
(71, 'st-2023-0026', 3, 0),
(72, 'st-2023-0026', 4, 0),
(73, 'st-2023-0026', 5, 0),
(74, 'st-2023-0026', 6, 0),
(75, 'st-2023-0026', 7, 0),
(76, 'st-2023-0026', 8, 0),
(77, 'st-2023-0026', 12, 0),
(78, 'st-2023-0026', 13, 0),
(79, 'st-2023-0026', 11, 0),
(80, 'st-2023-0027', 1, 0),
(81, 'st-2023-0027', 3, 0),
(82, 'st-2023-0027', 4, 0),
(83, 'st-2023-0027', 5, 0),
(84, 'st-2023-0027', 6, 0),
(85, 'st-2023-0027', 7, 0),
(86, 'st-2023-0027', 8, 0),
(87, 'st-2023-0027', 12, 0),
(88, 'st-2023-0027', 13, 0),
(89, 'st-2023-0027', 11, 0),
(90, 'st-2023-0028', 1, 0),
(91, 'st-2023-0028', 3, 0),
(92, 'st-2023-0028', 4, 0),
(93, 'st-2023-0028', 5, 0),
(94, 'st-2023-0028', 6, 0),
(95, 'st-2023-0028', 7, 0),
(96, 'st-2023-0028', 8, 0),
(97, 'st-2023-0028', 12, 0),
(98, 'st-2023-0028', 13, 0),
(99, 'st-2023-0028', 14, 0),
(100, 'st-2023-0030', 1, 0),
(101, 'st-2023-0030', 3, 0),
(102, 'st-2023-0030', 4, 0),
(103, 'st-2023-0030', 5, 0),
(104, 'st-2023-0030', 6, 0),
(105, 'st-2023-0030', 7, 0),
(106, 'st-2023-0030', 8, 0),
(107, 'st-2023-0030', 12, 0),
(108, 'st-2023-0030', 13, 0),
(109, 'st-2023-0030', 10, 0),
(110, 'st-2023-0031', 1, 0),
(111, 'st-2023-0031', 3, 0),
(112, 'st-2023-0031', 4, 0),
(113, 'st-2023-0031', 5, 0),
(114, 'st-2023-0031', 6, 0),
(115, 'st-2023-0031', 7, 0),
(116, 'st-2023-0031', 8, 0),
(117, 'st-2023-0031', 12, 0),
(118, 'st-2023-0031', 13, 0),
(119, 'st-2023-0031', 11, 0),
(120, 'st-2023-0032', 1, 0),
(121, 'st-2023-0032', 3, 0),
(122, 'st-2023-0032', 4, 0),
(123, 'st-2023-0032', 5, 0),
(124, 'st-2023-0032', 6, 0),
(125, 'st-2023-0032', 7, 0),
(126, 'st-2023-0032', 8, 0),
(127, 'st-2023-0032', 12, 0),
(128, 'st-2023-0032', 13, 0),
(129, 'st-2023-0032', 10, 0),
(130, 'st-2023-0033', 1, 0),
(131, 'st-2023-0033', 3, 0),
(132, 'st-2023-0033', 4, 0),
(133, 'st-2023-0033', 5, 0),
(134, 'st-2023-0033', 6, 0),
(135, 'st-2023-0033', 7, 0),
(136, 'st-2023-0033', 8, 0),
(137, 'st-2023-0033', 12, 0),
(138, 'st-2023-0033', 13, 0),
(139, 'st-2023-0033', 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subjectName` varchar(255) NOT NULL,
  `subject_code` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `is_default` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subjectName`, `subject_code`, `department_id`, `is_default`) VALUES
(1, 'BIOLOGY', 'BIO01', 5, 1),
(3, 'KISWAHILI', 'KIS01', 3, 1),
(4, 'ENGLISH', 'ENG01', 3, 1),
(5, 'MATHEMATICS', 'Math01', 4, 1),
(6, 'HISTORY', 'HIS01', 2, 1),
(7, 'C.R.E', 'CRE01', 2, 1),
(8, 'CHEMISTRY', 'CHEM01', 9, 1),
(9, 'AGRICULTURE', 'Agric01', 1, 0),
(10, 'BUSUNESS STUDIES', 'BUS01', 1, 0),
(11, 'FRENCH', 'Fre01', 1, 0),
(12, 'GEOGRAPHY', 'Geo01', 2, 1),
(13, 'PHYISCS', 'Phy01', 8, 1),
(14, 'ART & CRAFT', 'Art01', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(11) NOT NULL,
  `PageType` varchar(255) NOT NULL,
  `PageTitle` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `MobileNumber` varchar(20) NOT NULL,
  `Timing` varchar(100) NOT NULL,
  `PageDescription` text DEFAULT NULL,
  `address` varchar(250) NOT NULL,
  `street` varchar(250) NOT NULL,
  `town` varchar(250) NOT NULL,
  `mission` text NOT NULL,
  `motto` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `Email`, `MobileNumber`, `Timing`, `PageDescription`, `address`, `street`, `town`, `mission`, `motto`, `name`) VALUES
(1, 'contactus', 'Contact Us', 'mishytechs@gmail.com', '254718045860', 'Monday to Friday - 8 AM to 5 PM', 'we nurture young minds and inspire a lifelong love for learning. Located amidst the serene landscapes of Sotik, Bomet County, our provincial school stands as a beacon of educational excellence. With a rich heritage of academic achievements and holistic development, we empower our students to become leaders, innovators, and compassionate individuals.', 'PO. Box 801, 20406', 'Chepilat Street', 'sotik, Bomet', 'Inspiring a Lifelong Love for Learning: Our Storied Journey in the Heart of Sotik, Bomet County. A Provincial School of Excellence, nestled amidst the Tranquil Landscapes. Crafting Academic Achievements and Holistic Development, We Uplift, Empower, and Forge Leaders, Innovators, and Compassionate Souls.\"', 'Empowering Minds, Shaping Futures', 'ST. ANNES HIGH SCHOOL'),
(2, 'aboutus', 'About Us', '', '', '', 'we nurture young minds and inspire a lifelong love for learning. Located amidst the serene landscapes of Sotik, Bomet County, our provincial school stands as a beacon of educational excellence. With a rich heritage of academic achievements and holistic development, we empower our students to become leaders, innovators, and compassionate individuals.', '', '', '', 'Inspiring a Lifelong Love for Learning: Our Storied Journey in the Heart of Sotik, Bomet County. A Provincial School of Excellence, nestled amidst the Tranquil Landscapes. Crafting Academic Achievements and Holistic Development, We Uplift, Empower, and Forge Leaders, Innovators, and Compassionate Souls.\"', 'Empowering Minds, Shaping Futures', 'ST. ANNES HIGH SCHOOL');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` varchar(30) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `dob` date NOT NULL,
  `hiredate` date NOT NULL,
  `salary` double NOT NULL,
  `sessionid` int(100) NOT NULL,
  `file` varchar(250) NOT NULL,
  `department` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `password`, `phone`, `email`, `address`, `sex`, `dob`, `hiredate`, `salary`, `sessionid`, `file`, `department`) VALUES
('te-124-1', 'Robert Sinde', '125', '8520000010', 'robertj@gmail.com', '1022  Neuport Lane', 'Male', '1995-12-18', '2023-09-08', 36000, 1, 'teacher-te-124-1pic.jpg', 2),
('te-125-1', 'James Rhoades', '258', '3214569874', 'rhoadesj@gmail.com', '3464  Straford Park', 'Male', '1998-06-26', '2023-10-02', 21000, 1, 'teacher-te-125-1pic.jpg', 3),
('te-126-1', 'Maria', '258', '9103674540', 'mariahill@gmail.com', '833  Fulton Street', 'Female', '1996-04-06', '2019-12-24', 39000, 0, '', 4),
('te-127-1', 'Darlene', '123', '1379696969', 'darleeene@gmail.com', '2131  Glory Road', 'Female', '1994-12-25', '2017-05-25', 41000, 0, '', 5),
('te-2023-0001', 'Nanthan Nyakundi', 'te-2023-0001', '+254718045811', 'nyakundi@gmail.com', 'PO. Box 801, 20406', 'Male', '2023-08-27', '2023-09-07', 20000, 1, 'teacher-te-2023-0001pic.jpg', 9),
('te-2023-0002', 'Skion Binyanya', 'te-2023-0002', '0456222665', 'skion@gmail.com', 'PO. Box 801, 20408', 'Male', '2023-08-29', '2023-09-07', 12500, 1, 'teacher-te-2023-0002pic.jpg', 1),
('te-2023-0003', 'Al mishael', 'te-2023-0003', '0456222665', 'al@gmail.com', 'PO. Box 801, 20406', 'Male', '2023-08-27', '2023-09-11', 12500, 1, 'teacher-te-2023-0003pic.jpg', 3),
('te-2023-0004', 'Agastus nyaanga', 'te-2023-0004', '0123456789', 'agausta@gmail.com', 'PO. Box 801, 20406', 'Male', '1993-09-13', '2023-09-13', 20000, 1, 'teacher-te-2023-0004pic.jpg', 8);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subjects`
--

CREATE TABLE `teacher_subjects` (
  `id` int(11) NOT NULL,
  `teacher_id` varchar(200) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `date_assigned` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_subjects`
--

INSERT INTO `teacher_subjects` (`id`, `teacher_id`, `subject_id`, `class_id`, `date_assigned`) VALUES
(7, 'te-124-1', 6, 3, '2023-10-02'),
(8, 'te-124-1', 7, 3, '2023-10-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `usertype` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `password`, `usertype`) VALUES
('ad-123-0', '123', 'admin'),
('ad-123-1', '123', 'admin'),
('ad-123-2', '123', 'admin'),
('ad-123-3', '123', 'admin'),
('pa-123-1', '123', 'parent'),
('pa-124-1', '123', 'parent'),
('pt-2023-0011', 'pt-2023-0011', 'parent'),
('pt-2023-0013', 'pt-2023-0011', 'parent'),
('pt-2023-0020', 'pt-2023-0020', 'parent'),
('pt-2023-0021', 'pt-2023-0021', 'parent'),
('pt-2023-0023', 'pt-2023-0023', 'parent'),
('pt-2023-0024', 'pt-2023-0024', 'parent'),
('pt-2023-0025', 'pt-2023-0025', 'parent'),
('pt-2023-0026', 'pt-2023-0026', 'parent'),
('pt-2023-0027', 'pt-2023-0027', 'parent'),
('pt-2023-0028', 'pt-2023-0028', 'parent'),
('pt-2023-0030', 'pt-2023-0030', 'parent'),
('pt-2023-0031', 'pt-2023-0031', 'parent'),
('pt-2023-0032', 'pt-2023-0032', 'parent'),
('pt-2023-0033', 'pt-2023-0033', 'parent'),
('st-2023-0025', 'mish0025', 'student'),
('st-2023-0026', 'st-2023-0026', 'student'),
('st-2023-0028', 'st-2023-0028', 'student'),
('st-2023-0030', 'st-2023-0030', 'student'),
('st-2023-0031', 'st-2023-0031', 'student'),
('st-2023-0032', 'st-2023-0032', 'student'),
('st-2023-0033', 'st-2023-0033', 'student'),
('sta-123-1', '123', 'staff'),
('sta-124-1', '123', 'staff'),
('sta-125-1', '123', 'staff'),
('sta-126-1', '123', 'staff'),
('te-124-1', '125', 'teacher'),
('te-125-1', '258', 'teacher'),
('te-126-1', '258', 'teacher'),
('te-127-1', '123', 'teacher'),
('te-2023-0001', 'te-2023-0001', 'teacher'),
('te-2023-0002', 'te-2023-0002', 'teacher'),
('te-2023-0003', 'te-2023-0003', 'teacher'),
('te-2023-0004', 'te-2023-0004', 'teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classT_id` (`classT_id`);

--
-- Indexes for table `classteachers`
--
ALTER TABLE `classteachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `hod_id` (`hod_id`);

--
-- Indexes for table `exam_marks`
--
ALTER TABLE `exam_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostelrooms`
--
ALTER TABLE `hostelrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostels`
--
ALTER TABLE `hostels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`reportid`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `streams`
--
ALTER TABLE `streams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `student_parent`
--
ALTER TABLE `student_parent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_subjects`
--
ALTER TABLE `student_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `is_default` (`is_default`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `userid` (`userid`),
  ADD KEY `userid_2` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `beds`
--
ALTER TABLE `beds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `classteachers`
--
ALTER TABLE `classteachers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `exam_marks`
--
ALTER TABLE `exam_marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hostelrooms`
--
ALTER TABLE `hostelrooms`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hostels`
--
ALTER TABLE `hostels`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `streams`
--
ALTER TABLE `streams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_parent`
--
ALTER TABLE `student_parent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `student_subjects`
--
ALTER TABLE `student_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
