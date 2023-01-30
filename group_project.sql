-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2022 at 10:09 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(10) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminGender` varchar(255) NOT NULL,
  `adminPhoneNo` int(11) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminAddress1` varchar(255) NOT NULL,
  `adminAddress2` varchar(255) DEFAULT NULL,
  `adminCity` varchar(255) NOT NULL,
  `adminState` varchar(255) NOT NULL,
  `adminPostalCode` int(5) NOT NULL,
  `adminCountry` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `adminName`, `adminGender`, `adminPhoneNo`, `adminEmail`, `adminAddress1`, `adminAddress2`, `adminCity`, `adminState`, `adminPostalCode`, `adminCountry`) VALUES
(1, 'Asyraf', '1', 1110048345, 'afifasyraf52@gmail.com', 'Kg Batu 3', '', 'Temoh', 'Perak', 35350, 'Malaysia'),
(2, 'Adib', '1', 1110048346, 'adib@gmail.com', 'Taman Seri', '', 'Kuching', 'Sarawak', 98000, 'Malaysia');

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE `complain` (
  `complainId` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `complainerName` varchar(255) NOT NULL,
  `complainTitle` varchar(255) NOT NULL,
  `complainContent` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`complainId`, `email`, `complainerName`, `complainTitle`, `complainContent`, `date`) VALUES
(1, 'afifasyraf52@gmail.com', 'Muhammad Afif', 'Online Quizzez', 'The site for online quizzes always crashes', '2022-06-08'),
(2, 'afifasyraf52@gmail.com', 'Muhammad Afif', 'Work Overload', 'The due for assignment stacked at the end of semester', '2022-06-09'),
(3, 'acaphilos@gmail.com', 'Muhammad Adib', 'No break', 'The break and holiday are too short.', '2022-06-14'),
(4, 'adib@gmail.com', 'Huawei', 'Halooo', 'The site for online quizzes always crashes', '2022-06-24'),
(5, 'acaphilos@gmail.com', 'Muhammad Afif', 'Haluuu', 'The break and holiday are too short.', '2022-06-10'),
(6, 'afifasyraf52@gmail.com', 'gura', 'No chill', 'I want to rest', '2022-06-25'),
(7, 'muhammad_afif_bi20@iluv.ums.edu.my', 'Asyraf', 'Just want to test', 'Is it okay now?', '2022-06-10'),
(8, 'aqimie@gmail.com', 'Aqimie', 'Repair the lecture hall', 'Thare is water leakage during rain', '2022-06-03');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseId` int(10) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `syllabus` varchar(255) NOT NULL,
  `credits` int(10) NOT NULL,
  `courseFee` decimal(10,2) NOT NULL,
  `courseDesc` varchar(255) NOT NULL,
  `lecturerId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseId`, `courseName`, `syllabus`, `credits`, `courseFee`, `courseDesc`, `lecturerId`) VALUES
(1, 'Software Engineering', 'Web Engineering', 3, '960.00', 'Web engineering', 1),
(2, 'Data Science', 'Data Science', 3, '960.00', 'Data Science', 1),
(3, 'Network Engineering', 'Network Engineering', 3, '960.00', 'Network Engineering', 1);

-- --------------------------------------------------------

--
-- Table structure for table `courseevaluation`
--

CREATE TABLE `courseevaluation` (
  `evaluationId` int(10) NOT NULL,
  `studentId` int(10) NOT NULL,
  `courseId` int(10) NOT NULL,
  `date` date NOT NULL,
  `sectionNo` int(10) NOT NULL,
  `year` int(10) NOT NULL,
  `semester` char(2) NOT NULL,
  `rating` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courseevaluation`
--

INSERT INTO `courseevaluation` (`evaluationId`, `studentId`, `courseId`, `date`, `sectionNo`, `year`, `semester`, `rating`) VALUES
(1, 1, 1, '2022-06-10', 2, 2022, '2', 4),
(2, 1, 2, '2022-06-02', 2, 2022, '2', 5);

-- --------------------------------------------------------

--
-- Table structure for table `enrol`
--

CREATE TABLE `enrol` (
  `enrolId` int(10) NOT NULL,
  `studentId` int(10) NOT NULL,
  `subjectCode` varchar(10) NOT NULL,
  `enrolDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrol`
--

INSERT INTO `enrol` (`enrolId`, `studentId`, `subjectCode`, `enrolDate`) VALUES
(1, 1, 'KK101', '2022-06-27 23:50:12'),
(2, 1, 'KK102', '2022-06-28 13:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `lectId` int(10) NOT NULL,
  `lectName` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `subjectCode` varchar(10) NOT NULL,
  `subjectName` varchar(255) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `examDate` date NOT NULL,
  `examTime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lectId`, `lectName`, `department`, `subjectCode`, `subjectName`, `venue`, `examDate`, `examTime`) VALUES
(1, 'Izzat', 'FKI', 'KK101', 'Web Engineering', 'Kota Kinabalu', '2022-06-01', '2022-06-01'),
(2, 'Aqimie', 'FKI', 'KK102', 'Data Structure', 'Sabah', '2022-06-01', '2022-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `loginadmin`
--

CREATE TABLE `loginadmin` (
  `loginAdminId` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adminId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginadmin`
--

INSERT INTO `loginadmin` (`loginAdminId`, `email`, `password`, `adminId`) VALUES
(1, 'afifasyraf52@gmail.com', '2e186f27bbbbdd5ceb8af1dfa92a4bb4e1857b1f', 1),
(2, 'adib@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2);

-- --------------------------------------------------------

--
-- Table structure for table `loginstudent`
--

CREATE TABLE `loginstudent` (
  `loginStdId` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `studentId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginstudent`
--

INSERT INTO `loginstudent` (`loginStdId`, `email`, `password`, `studentId`) VALUES
(1, 'afifasyraf52@gmail.com', '2e186f27bbbbdd5ceb8af1dfa92a4bb4e1857b1f', 1);

-- --------------------------------------------------------

--
-- Table structure for table `residentialapplication`
--

CREATE TABLE `residentialapplication` (
  `applicationId` int(10) NOT NULL,
  `session` int(10) NOT NULL,
  `semester` int(10) NOT NULL,
  `date` date NOT NULL,
  `collegeRequest` varchar(255) NOT NULL,
  `stdId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `residentialapplication`
--

INSERT INTO `residentialapplication` (`applicationId`, `session`, `semester`, `date`, `collegeRequest`, `stdId`) VALUES
(1, 1, 1, '2022-06-25', 'KKTM', 1),
(2, 1, 1, '2022-06-25', 'KKTM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stdId` int(10) NOT NULL,
  `stdName` varchar(255) NOT NULL,
  `stdGender` varchar(255) NOT NULL,
  `stdProgram` varchar(255) NOT NULL,
  `stdCurrentYear` int(10) NOT NULL,
  `stdPhoneNo` int(11) NOT NULL,
  `stdEmail` varchar(255) NOT NULL,
  `stdAddress1` varchar(255) NOT NULL,
  `stdAddress2` varchar(255) DEFAULT NULL,
  `stdCity` varchar(255) NOT NULL,
  `stdState` varchar(255) NOT NULL,
  `stdPostalCode` int(5) NOT NULL,
  `stdCountry` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stdId`, `stdName`, `stdGender`, `stdProgram`, `stdCurrentYear`, `stdPhoneNo`, `stdEmail`, `stdAddress1`, `stdAddress2`, `stdCity`, `stdState`, `stdPostalCode`, `stdCountry`) VALUES
(1, 'Muhammad Afif', '1', 'HC00', 2020, 1110048345, 'acaphilos@gmail.com', 'Kg Papan Luncur', '', 'Ipoh', 'Perak', 35000, 'Malaysia');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjectCode` varchar(10) NOT NULL,
  `subjectName` varchar(255) NOT NULL,
  `creditHours` int(10) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `examDate` date NOT NULL,
  `examDay` date NOT NULL,
  `examTime` date NOT NULL,
  `startTime` date NOT NULL,
  `endTime` date NOT NULL,
  `event` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectCode`, `subjectName`, `creditHours`, `venue`, `examDate`, `examDay`, `examTime`, `startTime`, `endTime`, `event`) VALUES
('KK101', 'Web Engineering', 2, 'Sabah', '2022-06-01', '2022-06-01', '2022-06-01', '2022-06-01', '2022-06-01', NULL),
('KK102', 'Data Structure', 2, 'Sabah', '2022-06-02', '2022-06-02', '2022-06-03', '2022-06-03', '2022-06-16', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `complain`
--
ALTER TABLE `complain`
  ADD PRIMARY KEY (`complainId`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseId`),
  ADD KEY `course_cons_1` (`lecturerId`);

--
-- Indexes for table `courseevaluation`
--
ALTER TABLE `courseevaluation`
  ADD PRIMARY KEY (`evaluationId`),
  ADD KEY `evaluation_cons_1` (`studentId`),
  ADD KEY `evaluation_cons_2` (`courseId`);

--
-- Indexes for table `enrol`
--
ALTER TABLE `enrol`
  ADD PRIMARY KEY (`enrolId`),
  ADD KEY `enrol_cons_1` (`studentId`),
  ADD KEY `enrol_cons_2` (`subjectCode`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lectId`),
  ADD KEY `lecturer_cons_1` (`subjectCode`);

--
-- Indexes for table `loginadmin`
--
ALTER TABLE `loginadmin`
  ADD PRIMARY KEY (`loginAdminId`),
  ADD KEY `loginAdmin_cons_1` (`adminId`);

--
-- Indexes for table `loginstudent`
--
ALTER TABLE `loginstudent`
  ADD PRIMARY KEY (`loginStdId`),
  ADD KEY `loginStudent_cons_1` (`studentId`);

--
-- Indexes for table `residentialapplication`
--
ALTER TABLE `residentialapplication`
  ADD PRIMARY KEY (`applicationId`),
  ADD KEY `resident_cons_1` (`stdId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stdId`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjectCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `complainId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courseevaluation`
--
ALTER TABLE `courseevaluation`
  MODIFY `evaluationId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrol`
--
ALTER TABLE `enrol`
  MODIFY `enrolId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loginadmin`
--
ALTER TABLE `loginadmin`
  MODIFY `loginAdminId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loginstudent`
--
ALTER TABLE `loginstudent`
  MODIFY `loginStdId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `residentialapplication`
--
ALTER TABLE `residentialapplication`
  MODIFY `applicationId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_cons_1` FOREIGN KEY (`lecturerId`) REFERENCES `lecturer` (`lectId`);

--
-- Constraints for table `courseevaluation`
--
ALTER TABLE `courseevaluation`
  ADD CONSTRAINT `evaluation_cons_1` FOREIGN KEY (`studentId`) REFERENCES `student` (`stdId`),
  ADD CONSTRAINT `evaluation_cons_2` FOREIGN KEY (`courseId`) REFERENCES `course` (`courseId`);

--
-- Constraints for table `enrol`
--
ALTER TABLE `enrol`
  ADD CONSTRAINT `enrol_cons_1` FOREIGN KEY (`studentId`) REFERENCES `student` (`stdId`),
  ADD CONSTRAINT `enrol_cons_2` FOREIGN KEY (`subjectCode`) REFERENCES `subject` (`subjectCode`);

--
-- Constraints for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD CONSTRAINT `lecturer_cons_1` FOREIGN KEY (`subjectCode`) REFERENCES `subject` (`subjectCode`);

--
-- Constraints for table `loginadmin`
--
ALTER TABLE `loginadmin`
  ADD CONSTRAINT `loginAdmin_cons_1` FOREIGN KEY (`adminId`) REFERENCES `admin` (`adminId`);

--
-- Constraints for table `loginstudent`
--
ALTER TABLE `loginstudent`
  ADD CONSTRAINT `loginStudent_cons_1` FOREIGN KEY (`studentId`) REFERENCES `student` (`stdId`);

--
-- Constraints for table `residentialapplication`
--
ALTER TABLE `residentialapplication`
  ADD CONSTRAINT `resident_cons_1` FOREIGN KEY (`stdId`) REFERENCES `student` (`stdId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
