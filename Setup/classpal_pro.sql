-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 16, 2025 at 07:55 PM
-- Server version: 5.7.40-log
-- PHP Version: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classpal_pro`
--

-- --------------------------------------------------------

--
-- Table structure for table `cp_absent`
--

CREATE TABLE `cp_absent` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `subj_id` int(11) DEFAULT NULL,
  `subj_name` varchar(255) DEFAULT NULL,
  `lec_id` int(11) DEFAULT NULL,
  `lec_name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cp_announcements`
--

CREATE TABLE `cp_announcements` (
  `id` int(11) NOT NULL,
  `an_date` date NOT NULL,
  `an_title` varchar(255) NOT NULL,
  `an_des` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_announcements`
--

INSERT INTO `cp_announcements` (`id`, `an_date`, `an_title`, `an_des`) VALUES
(1, '2025-05-21', 'Class Times', 'Class Times are Changed.....'),
(13, '2025-01-27', 'Welcome', 'Welcome To My Commerce Class');

-- --------------------------------------------------------

--
-- Table structure for table `cp_attendance`
--

CREATE TABLE `cp_attendance` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `student_id` int(11) NOT NULL,
  `subj_id` int(11) DEFAULT NULL,
  `att_time` time DEFAULT NULL,
  `lec_id` int(11) DEFAULT NULL,
  `lec_name` varchar(255) DEFAULT NULL,
  `daily_class_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_attendance`
--

INSERT INTO `cp_attendance` (`id`, `date`, `student_id`, `subj_id`, `att_time`, `lec_id`, `lec_name`, `daily_class_id`) VALUES
(253, '2025-05-16', 100007, 26, '17:36:28', 8492, 'Maduranga', 1),
(250, '2025-04-19', 100007, 26, '10:56:18', 8492, 'Maduranga', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cp_dailyclasses`
--

CREATE TABLE `cp_dailyclasses` (
  `dc_id` int(11) NOT NULL,
  `dc_class_name` varchar(255) DEFAULT NULL,
  `dc_subj_id` int(11) DEFAULT NULL,
  `dc_lec_id` int(11) DEFAULT NULL,
  `dc_class_time` varchar(255) DEFAULT NULL,
  `dc_lec_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_dailyclasses`
--

INSERT INTO `cp_dailyclasses` (`dc_id`, `dc_class_name`, `dc_subj_id`, `dc_lec_id`, `dc_class_time`, `dc_lec_name`) VALUES
(1, 'English Class', 26, 8492, '10.00AM', 'Maduranga'),
(2, 'Sinhala Class', 25, 887422, '2.00PM', 'Kamal Neshantha');

-- --------------------------------------------------------

--
-- Table structure for table `cp_lecturers`
--

CREATE TABLE `cp_lecturers` (
  `id` int(11) NOT NULL,
  `lec_id` int(11) NOT NULL,
  `lec_regdate` date NOT NULL,
  `lec_name` varchar(255) NOT NULL,
  `lec_address` varchar(255) DEFAULT NULL,
  `lec_sex` varchar(45) DEFAULT NULL,
  `lec_mob` varchar(45) NOT NULL,
  `lec_notes` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_lecturers`
--

INSERT INTO `cp_lecturers` (`id`, `lec_id`, `lec_regdate`, `lec_name`, `lec_address`, `lec_sex`, `lec_mob`, `lec_notes`) VALUES
(16, 8492, '2016-04-21', 'Maduranga', 'Address 2', 'Male', '072545455', 'Note 02'),
(12, 887422, '2016-04-20', 'Kamal Neshantha', '', 'Male', '0775745856', '');

-- --------------------------------------------------------

--
-- Table structure for table `cp_logs`
--

CREATE TABLE `cp_logs` (
  `id` int(11) UNSIGNED NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `logdate` date DEFAULT NULL,
  `logtime` time DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_logs`
--

INSERT INTO `cp_logs` (`id`, `userid`, `username`, `logdate`, `logtime`) VALUES
(246, 2, 'ama', '2025-06-16', '11:06:00'),
(247, 2, 'ama', '2025-06-16', '06:47:00'),
(248, 2, 'ama', '2025-06-16', '07:07:00'),
(249, 2, 'ama', '2025-06-16', '07:38:00'),
(250, 2, 'ama', '2025-06-16', '07:41:00'),
(251, 2, 'ama', '2025-06-16', '07:50:00'),
(252, 2, 'ama', '2025-06-16', '07:52:00'),
(253, 2, 'admin', '2025-06-16', '07:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `cp_notes`
--

CREATE TABLE `cp_notes` (
  `id` int(11) NOT NULL,
  `n_date` date NOT NULL,
  `n_description` text NOT NULL,
  `n_s_date` date NOT NULL,
  `n_e_date` date NOT NULL,
  `n_s_time` time NOT NULL,
  `n_e_time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cp_oldstudents`
--

CREATE TABLE `cp_oldstudents` (
  `stu_ID` int(11) NOT NULL,
  `stu_studentID` int(11) NOT NULL,
  `stu_regdate` date NOT NULL,
  `stu_studentname` varchar(255) NOT NULL,
  `stu_address` varchar(255) NOT NULL,
  `stu_sex` varchar(45) NOT NULL,
  `stu_bday` date NOT NULL,
  `stu_con_home` varchar(255) NOT NULL,
  `stu_con_mobile1` varchar(255) NOT NULL,
  `stu_con_mobile2` varchar(255) NOT NULL,
  `stu_email` varchar(255) NOT NULL,
  `stu_schoolName` varchar(255) NOT NULL,
  `stu_notes` varchar(255) NOT NULL,
  `stu_passGrade` varchar(45) NOT NULL,
  `stu_image_name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cp_payments`
--

CREATE TABLE `cp_payments` (
  `pay_id` int(11) NOT NULL,
  `Pay_stu_studentID` int(11) NOT NULL,
  `pay_student_name` varchar(255) NOT NULL,
  `pay_subj_id` int(11) DEFAULT NULL,
  `pay_subj_Name` varchar(255) DEFAULT NULL,
  `pay_lec_id` int(11) DEFAULT NULL,
  `pay_paymentdate` date DEFAULT NULL,
  `pay_paymentmonth` int(11) DEFAULT NULL,
  `pay_cos_fee` double(10,2) DEFAULT NULL,
  `pay_cos_admi` double(10,2) DEFAULT NULL,
  `pay_cos_total` double(10,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_payments`
--

INSERT INTO `cp_payments` (`pay_id`, `Pay_stu_studentID`, `pay_student_name`, `pay_subj_id`, `pay_subj_Name`, `pay_lec_id`, `pay_paymentdate`, `pay_paymentmonth`, `pay_cos_fee`, `pay_cos_admi`, `pay_cos_total`) VALUES
(1, 0, '01JAN', 0, NULL, 0, '0000-00-00', 202501, 0.00, 0.00, 0.00),
(2, 0, '02FEB', 0, NULL, 0, '0000-00-00', 202502, 0.00, 0.00, 0.00),
(3, 0, '03MAR', 0, NULL, 0, '0000-00-00', 202503, 0.00, 0.00, 0.00),
(4, 0, '04APR', 0, NULL, 0, '0000-00-00', 202504, 0.00, 0.00, 0.00),
(5, 0, '05MAY', 0, NULL, 0, '0000-00-00', 202505, 0.00, 0.00, 0.00),
(6, 0, '06JUN', 0, NULL, 0, '0000-00-00', 202506, 0.00, 0.00, 0.00),
(7, 0, '07JLY', 0, NULL, 0, '0000-00-00', 202507, 0.00, 0.00, 0.00),
(8, 0, '08AUG', 0, NULL, 0, '0000-00-00', 202508, 0.00, 0.00, 0.00),
(9, 0, '09SEP', 0, NULL, 0, '0000-00-00', 202509, 0.00, 0.00, 0.00),
(10, 0, '10OCT', 0, NULL, 0, '0000-00-00', 202510, 0.00, 0.00, 0.00),
(11, 0, '11NOV', 0, NULL, 0, '0000-00-00', 202511, 0.00, 0.00, 0.00),
(12, 0, '12DEC', 0, NULL, 0, '0000-00-00', 202512, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `cp_settings`
--

CREATE TABLE `cp_settings` (
  `setting_id` int(11) NOT NULL,
  `showrecords` int(11) NOT NULL,
  `sms_gway_dcode` varchar(255) NOT NULL,
  `sms_gway_token` varchar(255) NOT NULL,
  `Enable_Disable_Stu_Reg` int(11) NOT NULL,
  `sms_sender` varchar(255) NOT NULL,
  `sms_send_reg` text,
  `sms_send_pay` text,
  `sms_send_atten` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_settings`
--

INSERT INTO `cp_settings` (`setting_id`, `showrecords`, `sms_gway_dcode`, `sms_gway_token`, `Enable_Disable_Stu_Reg`, `sms_sender`, `sms_send_reg`, `sms_send_pay`, `sms_send_atten`) VALUES
(1, 100, '', '', 0, '', NULL, NULL, NULL),
(2, 0, '947777777', '1234', 1, 'ABC Institute', 'Registration Success, Thank you.', 'Thank you for Payment', 'Thank you for Attendance');

-- --------------------------------------------------------

--
-- Table structure for table `cp_students`
--

CREATE TABLE `cp_students` (
  `stu_ID` int(11) NOT NULL,
  `stu_studentID` int(11) UNSIGNED NOT NULL,
  `stu_regdate` date NOT NULL,
  `stu_studentname` varchar(255) NOT NULL,
  `stu_address` varchar(255) DEFAULT NULL,
  `stu_sex` varchar(45) NOT NULL,
  `stu_bday` date DEFAULT NULL,
  `stu_con_home` varchar(255) DEFAULT NULL,
  `stu_con_mobile1` varchar(255) DEFAULT NULL,
  `stu_con_mobile2` varchar(255) DEFAULT NULL,
  `stu_email` varchar(255) DEFAULT NULL,
  `stu_schoolName` varchar(255) DEFAULT NULL,
  `stu_notes` varchar(255) CHARACTER SET big5 DEFAULT NULL,
  `stu_passGrade` varchar(45) DEFAULT NULL,
  `stu_image_name` varchar(255) DEFAULT NULL,
  `stu_accesskey` int(11) DEFAULT NULL,
  `stu_barcode` int(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_students`
--

INSERT INTO `cp_students` (`stu_ID`, `stu_studentID`, `stu_regdate`, `stu_studentname`, `stu_address`, `stu_sex`, `stu_bday`, `stu_con_home`, `stu_con_mobile1`, `stu_con_mobile2`, `stu_email`, `stu_schoolName`, `stu_notes`, `stu_passGrade`, `stu_image_name`, `stu_accesskey`, `stu_barcode`) VALUES
(20, 100007, '2013-04-29', 'Kamal Sathsara', '', 'Female', '0000-00-00', '', '0777777', '', '', '', '', '', 'https://i.postimg.cc/G2dp514L/31.jpg', 1111, 1001);

-- --------------------------------------------------------

--
-- Table structure for table `cp_subjects`
--

CREATE TABLE `cp_subjects` (
  `subj_id` int(11) NOT NULL,
  `subj_name` varchar(255) NOT NULL,
  `subj_classfee` double(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_subjects`
--

INSERT INTO `cp_subjects` (`subj_id`, `subj_name`, `subj_classfee`) VALUES
(26, 'English', 15000.00),
(25, 'Sinhala', 700.00),
(27, 'Accounting', 1500.00);

-- --------------------------------------------------------

--
-- Table structure for table `cp_subj_allo`
--

CREATE TABLE `cp_subj_allo` (
  `sa_id` int(11) NOT NULL,
  `sa_stu_student_id` int(11) NOT NULL,
  `sa_stu_student_Name` varchar(255) DEFAULT NULL,
  `sa_subj_id` int(11) NOT NULL,
  `sa_lec_id` int(11) DEFAULT NULL,
  `sa_subj_fee` double(10,2) NOT NULL,
  `sa_batch_no` varchar(255) NOT NULL,
  `sa_notes` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_subj_allo`
--

INSERT INTO `cp_subj_allo` (`sa_id`, `sa_stu_student_id`, `sa_stu_student_Name`, `sa_subj_id`, `sa_lec_id`, `sa_subj_fee`, `sa_batch_no`, `sa_notes`) VALUES
(208, 100007, 'Kamal Sathsara', 26, 8492, 1000.00, '2025', '');

-- --------------------------------------------------------

--
-- Table structure for table `cp_userpermission`
--

CREATE TABLE `cp_userpermission` (
  `per_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `OnOff` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_userpermission`
--

INSERT INTO `cp_userpermission` (`per_id`, `permission_id`, `uid`, `OnOff`) VALUES
(1, 1111, 2, 1),
(3, 1112, 2, 1),
(45, 1127, 2, 1),
(31, 1113, 2, 1),
(32, 1114, 2, 1),
(33, 1115, 2, 1),
(34, 1116, 2, 1),
(35, 1117, 2, 1),
(36, 1118, 2, 1),
(37, 1119, 2, 1),
(38, 1120, 2, 1),
(39, 1121, 2, 1),
(40, 1122, 2, 1),
(41, 1123, 2, 1),
(42, 1124, 2, 1),
(43, 1125, 2, 1),
(44, 1126, 2, 1),
(63, 1128, 2, 1),
(136, 1129, 2, 1),
(1571, 1135, 2, 1),
(1437, 1132, 2, 1),
(1372, 1130, 2, 1),
(1570, 1134, 2, 1),
(1569, 1133, 2, 1),
(1627, 1992, 2, 1),
(1628, 1993, 2, 1),
(1629, 1994, 2, 1),
(1630, 1995, 2, 1),
(1631, 1996, 2, 1),
(1632, 1997, 2, 1),
(1664, 1998, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cp_users`
--

CREATE TABLE `cp_users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `lec_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_users`
--

INSERT INTO `cp_users` (`id`, `username`, `password`, `firstname`, `lastname`, `lec_id`) VALUES
(2, 'admin', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Admin', 'System', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cp_absent`
--
ALTER TABLE `cp_absent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_announcements`
--
ALTER TABLE `cp_announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_attendance`
--
ALTER TABLE `cp_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_dailyclasses`
--
ALTER TABLE `cp_dailyclasses`
  ADD PRIMARY KEY (`dc_id`);

--
-- Indexes for table `cp_lecturers`
--
ALTER TABLE `cp_lecturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_logs`
--
ALTER TABLE `cp_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_notes`
--
ALTER TABLE `cp_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_oldstudents`
--
ALTER TABLE `cp_oldstudents`
  ADD PRIMARY KEY (`stu_ID`);

--
-- Indexes for table `cp_payments`
--
ALTER TABLE `cp_payments`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `cp_settings`
--
ALTER TABLE `cp_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `cp_students`
--
ALTER TABLE `cp_students`
  ADD PRIMARY KEY (`stu_ID`);

--
-- Indexes for table `cp_subjects`
--
ALTER TABLE `cp_subjects`
  ADD PRIMARY KEY (`subj_id`);

--
-- Indexes for table `cp_subj_allo`
--
ALTER TABLE `cp_subj_allo`
  ADD PRIMARY KEY (`sa_id`);

--
-- Indexes for table `cp_userpermission`
--
ALTER TABLE `cp_userpermission`
  ADD PRIMARY KEY (`per_id`);

--
-- Indexes for table `cp_users`
--
ALTER TABLE `cp_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cp_absent`
--
ALTER TABLE `cp_absent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `cp_announcements`
--
ALTER TABLE `cp_announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cp_attendance`
--
ALTER TABLE `cp_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `cp_dailyclasses`
--
ALTER TABLE `cp_dailyclasses`
  MODIFY `dc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cp_lecturers`
--
ALTER TABLE `cp_lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cp_logs`
--
ALTER TABLE `cp_logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `cp_notes`
--
ALTER TABLE `cp_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cp_settings`
--
ALTER TABLE `cp_settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cp_students`
--
ALTER TABLE `cp_students`
  MODIFY `stu_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=687;

--
-- AUTO_INCREMENT for table `cp_subjects`
--
ALTER TABLE `cp_subjects`
  MODIFY `subj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `cp_subj_allo`
--
ALTER TABLE `cp_subj_allo`
  MODIFY `sa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `cp_userpermission`
--
ALTER TABLE `cp_userpermission`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1973;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
