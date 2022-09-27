-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2022 at 05:56 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u532861242_timev2`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `user_acc_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `att_id` int(100) NOT NULL,
  `user_acc_id` int(11) NOT NULL,
  `company` varchar(200) DEFAULT NULL,
  `date_in` varchar(50) NOT NULL,
  `time_in` varchar(50) NOT NULL,
  `date_out` varchar(50) DEFAULT NULL,
  `time_out` varchar(50) DEFAULT NULL,
  `hrs_today` double DEFAULT NULL,
  `hrs_left` int(11) DEFAULT NULL,
  `hrs_added` double DEFAULT NULL,
  `remark_time_in` varchar(50) NOT NULL,
  `remark` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_status`
--

CREATE TABLE `attendance_status` (
  `id` int(11) NOT NULL,
  `user_acc_id` int(11) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `attend_status` int(11) NOT NULL,
  `date_closed` datetime NOT NULL,
  `date_opened` datetime NOT NULL,
  `date_closed_opened` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attended_webinar`
--

CREATE TABLE `attended_webinar` (
  `attend_web_id` int(11) NOT NULL,
  `attended_webinar_id` int(11) NOT NULL,
  `parti_user_acc_id` int(11) NOT NULL,
  `mode_of_payment` varchar(100) NOT NULL,
  `screenshot` varchar(1000) NOT NULL,
  `status_payment` varchar(100) NOT NULL,
  `date_applied` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hours_added`
--

CREATE TABLE `hours_added` (
  `hours_added_id` int(11) NOT NULL,
  `user_acc_id` int(11) NOT NULL,
  `hours_added` int(11) NOT NULL,
  `deduction_penalty_reason` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `deducted_penalty_by` int(11) NOT NULL,
  `deducted_penalty` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `intern_applicant_logs`
--

CREATE TABLE `intern_applicant_logs` (
  `log_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `staff_id` int(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `intern_info`
--

CREATE TABLE `intern_info` (
  `intern_info_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `app_id` varchar(12) NOT NULL,
  `street` varchar(100) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `birthdate` varchar(50) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `civil_status` varchar(50) NOT NULL,
  `school` varchar(100) NOT NULL,
  `company` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `intern_status` varchar(50) NOT NULL,
  `startdate` varchar(50) NOT NULL,
  `required_hours` varchar(50) NOT NULL,
  `added_hours` int(11) DEFAULT NULL,
  `gdrive_link` varchar(1000) NOT NULL,
  `estimated_end_date` varchar(50) NOT NULL,
  `start_shift` varchar(50) NOT NULL,
  `end_shift` varchar(50) NOT NULL,
  `schedule` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `intern_leave`
--

CREATE TABLE `intern_leave` (
  `leave_id` int(11) NOT NULL,
  `user_acc_id` int(11) NOT NULL,
  `reason_leave` varchar(3000) NOT NULL,
  `leave_from` varchar(50) NOT NULL,
  `leave_to` varchar(50) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `leave_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `intern_report`
--

CREATE TABLE `intern_report` (
  `report_id` int(11) NOT NULL,
  `ticket_no` varchar(100) NOT NULL,
  `user_acc_id` int(11) NOT NULL,
  `report_subject` varchar(300) NOT NULL,
  `report_details` varchar(1000) NOT NULL,
  `gdrive_link` varchar(1000) NOT NULL,
  `report_status` varchar(50) NOT NULL,
  `date_reported` varchar(50) NOT NULL,
  `date_fixed` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `overtime_attendance`
--

CREATE TABLE `overtime_attendance` (
  `id` int(11) NOT NULL,
  `user_acc_id` int(11) NOT NULL,
  `company` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_in` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_in` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_out` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_out` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hrs_added` double DEFAULT NULL,
  `remarks` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(100) NOT NULL,
  `user_acc_id` int(11) NOT NULL,
  `task_name` varchar(100) NOT NULL,
  `date_assigned` varchar(50) NOT NULL,
  `date_submitted` varchar(50) NOT NULL,
  `file_formats` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `gdrive_link` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reported_intern`
--

CREATE TABLE `reported_intern` (
  `id` int(11) NOT NULL,
  `user_acc_id` int(11) NOT NULL,
  `reported_by` int(11) NOT NULL,
  `reason` varchar(500) NOT NULL,
  `report_count` int(11) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requested_intern_status`
--

CREATE TABLE `requested_intern_status` (
  `requested_id` int(11) NOT NULL,
  `user_acc_id` int(11) NOT NULL,
  `requested_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_requested` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_decline_by` int(11) DEFAULT NULL,
  `date_approved_decline` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resetpasswords`
--

CREATE TABLE `resetpasswords` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `smtp_gmail_guide`
--

CREATE TABLE `smtp_gmail_guide` (
  `smtp_id` int(11) NOT NULL,
  `smtp_gmail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_random` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_info`
--

CREATE TABLE `staff_info` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `company` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `activity` varchar(100) DEFAULT NULL,
  `team_handled` varchar(300) DEFAULT NULL,
  `staff_position` varchar(100) DEFAULT NULL,
  `date_registered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(11) NOT NULL,
  `leader_id` int(11) NOT NULL,
  `co_leader_id` int(11) NOT NULL,
  `team_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `memb_id` int(11) NOT NULL,
  `team_name_id` int(11) NOT NULL,
  `user_acc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `team_project`
--

CREATE TABLE `team_project` (
  `team_project_id` int(11) NOT NULL,
  `user_acc_id` int(11) NOT NULL,
  `task_name` varchar(100) NOT NULL,
  `date_assigned` varchar(50) NOT NULL,
  `date_submitted` varchar(50) NOT NULL,
  `file_formats` varchar(50) NOT NULL,
  `team_name1` int(100) NOT NULL,
  `gdrive_link` varchar(1000) NOT NULL,
  `status` varchar(50) NOT NULL,
  `check_by` varchar(100) DEFAULT NULL,
  `date_checked` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `university_documents`
--

CREATE TABLE `university_documents` (
  `document_id` int(100) NOT NULL,
  `user_acc_id` int(11) NOT NULL,
  `document_title` varchar(50) NOT NULL,
  `file_format` varchar(50) NOT NULL,
  `date_submitted` varchar(50) NOT NULL,
  `deadline` varchar(50) NOT NULL,
  `gdrive_link` varchar(1000) NOT NULL,
  `coordinator_name` varchar(50) NOT NULL,
  `coordinator_email` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `signed_by` varchar(50) NOT NULL,
  `date_signed` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_acc`
--

CREATE TABLE `user_acc` (
  `user_acc_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `shift` varchar(11) DEFAULT NULL,
  `position` varchar(100) NOT NULL,
  `permission` varchar(11) NOT NULL,
  `password_updated` date DEFAULT NULL,
  `report_date` date DEFAULT NULL,
  `view_date` date DEFAULT NULL,
  `last_login` bigint(20) NOT NULL,
  `time_login` timestamp NULL DEFAULT NULL,
  `date_registered` varchar(100) DEFAULT NULL,
  `profile_pic` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_acc`
--

INSERT INTO `user_acc` (`user_acc_id`, `firstname`, `lastname`, `middle_name`, `username`, `passwd`, `usertype`, `shift`, `position`, `permission`, `password_updated`, `report_date`, `view_date`, `last_login`, `time_login`, `date_registered`, `profile_pic`) VALUES
(1, 'Attendance', 'Admin ', 'Tracker', 'admin0101@gmail.com', '9fa28ee10dd991e9a14202134f71b1da', 'Admin', '', '0', '1', '2022-04-20', NULL, NULL, 1662696664, '2022-09-09 03:54:24', NULL, 'upload8469admin.jpg'),
(2, 'Attendance', 'Staff', 'Tracker', 'staff0101@gmail.com', '1a7afecb1883281ac2524bb1dd76e108', 'Staff', '', '0', '1', NULL, NULL, NULL, 1654495970, '2022-06-06 13:56:10', NULL, 'upload23217staff.png');

-- --------------------------------------------------------

--
-- Table structure for table `webinar`
--

CREATE TABLE `webinar` (
  `webinar_id` int(11) NOT NULL,
  `user_acc_id` int(11) NOT NULL,
  `title_name` varchar(255) NOT NULL,
  `webinar_desc` varchar(3000) NOT NULL,
  `meeting_link` varchar(1000) NOT NULL,
  `speaker` varchar(255) NOT NULL,
  `meeting_date` varchar(50) NOT NULL,
  `meeting_time` varchar(50) NOT NULL,
  `registration_fee` varchar(1000) NOT NULL,
  `date_posted` varchar(50) NOT NULL,
  `web_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `weekly_report`
--

CREATE TABLE `weekly_report` (
  `weekly_report_id` int(11) NOT NULL,
  `user_acc_id` int(11) NOT NULL,
  `weekly_no` varchar(100) NOT NULL,
  `date_submitted` varchar(50) NOT NULL,
  `report_status` varchar(50) NOT NULL,
  `team_name1` int(100) NOT NULL,
  `gdrive_link` varchar(1000) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `signed_by` varchar(50) DEFAULT NULL,
  `date_signed` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_acc_id` (`user_acc_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`att_id`),
  ADD KEY `user_acc_id` (`user_acc_id`);

--
-- Indexes for table `attendance_status`
--
ALTER TABLE `attendance_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_acc_id` (`user_acc_id`);

--
-- Indexes for table `attended_webinar`
--
ALTER TABLE `attended_webinar`
  ADD PRIMARY KEY (`attend_web_id`),
  ADD KEY `webinar` (`attended_webinar_id`);

--
-- Indexes for table `hours_added`
--
ALTER TABLE `hours_added`
  ADD PRIMARY KEY (`hours_added_id`),
  ADD KEY `user_acc_id` (`user_acc_id`),
  ADD KEY `deducted_penalty_by` (`deducted_penalty_by`);

--
-- Indexes for table `intern_applicant_logs`
--
ALTER TABLE `intern_applicant_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `intern_info`
--
ALTER TABLE `intern_info`
  ADD PRIMARY KEY (`intern_info_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `intern_leave`
--
ALTER TABLE `intern_leave`
  ADD PRIMARY KEY (`leave_id`),
  ADD KEY `leave_user` (`user_acc_id`);

--
-- Indexes for table `intern_report`
--
ALTER TABLE `intern_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `report_user` (`user_acc_id`);

--
-- Indexes for table `overtime_attendance`
--
ALTER TABLE `overtime_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_acc_id` (`user_acc_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `project_intern` (`user_acc_id`);

--
-- Indexes for table `reported_intern`
--
ALTER TABLE `reported_intern`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_acc_id` (`user_acc_id`),
  ADD KEY `reported_by` (`reported_by`);

--
-- Indexes for table `requested_intern_status`
--
ALTER TABLE `requested_intern_status`
  ADD PRIMARY KEY (`requested_id`),
  ADD KEY `user_acc_id` (`user_acc_id`);

--
-- Indexes for table `resetpasswords`
--
ALTER TABLE `resetpasswords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smtp_gmail_guide`
--
ALTER TABLE `smtp_gmail_guide`
  ADD PRIMARY KEY (`smtp_id`);

--
-- Indexes for table `staff_info`
--
ALTER TABLE `staff_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_acc_id` (`username`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `leader` (`leader_id`),
  ADD KEY `co_leader` (`co_leader_id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`memb_id`),
  ADD UNIQUE KEY `user_acc_id` (`user_acc_id`),
  ADD KEY `team_name_id` (`team_name_id`),
  ADD KEY `members` (`user_acc_id`);

--
-- Indexes for table `team_project`
--
ALTER TABLE `team_project`
  ADD PRIMARY KEY (`team_project_id`),
  ADD KEY `team_project` (`user_acc_id`),
  ADD KEY `team_name` (`team_name1`);

--
-- Indexes for table `university_documents`
--
ALTER TABLE `university_documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `user_acc_id` (`user_acc_id`);

--
-- Indexes for table `user_acc`
--
ALTER TABLE `user_acc`
  ADD PRIMARY KEY (`user_acc_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `webinar`
--
ALTER TABLE `webinar`
  ADD PRIMARY KEY (`webinar_id`),
  ADD KEY `user_acc_id` (`user_acc_id`);

--
-- Indexes for table `weekly_report`
--
ALTER TABLE `weekly_report`
  ADD PRIMARY KEY (`weekly_report_id`),
  ADD KEY `weekly_report` (`user_acc_id`),
  ADD KEY `team_name12` (`team_name1`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `att_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_status`
--
ALTER TABLE `attendance_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `attended_webinar`
--
ALTER TABLE `attended_webinar`
  MODIFY `attend_web_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hours_added`
--
ALTER TABLE `hours_added`
  MODIFY `hours_added_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intern_applicant_logs`
--
ALTER TABLE `intern_applicant_logs`
  MODIFY `log_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intern_info`
--
ALTER TABLE `intern_info`
  MODIFY `intern_info_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intern_leave`
--
ALTER TABLE `intern_leave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intern_report`
--
ALTER TABLE `intern_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `overtime_attendance`
--
ALTER TABLE `overtime_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reported_intern`
--
ALTER TABLE `reported_intern`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `requested_intern_status`
--
ALTER TABLE `requested_intern_status`
  MODIFY `requested_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resetpasswords`
--
ALTER TABLE `resetpasswords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `smtp_gmail_guide`
--
ALTER TABLE `smtp_gmail_guide`
  MODIFY `smtp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `staff_info`
--
ALTER TABLE `staff_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `memb_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_project`
--
ALTER TABLE `team_project`
  MODIFY `team_project_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `university_documents`
--
ALTER TABLE `university_documents`
  MODIFY `document_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_acc`
--
ALTER TABLE `user_acc`
  MODIFY `user_acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2138;

--
-- AUTO_INCREMENT for table `webinar`
--
ALTER TABLE `webinar`
  MODIFY `webinar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `weekly_report`
--
ALTER TABLE `weekly_report`
  MODIFY `weekly_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance_status`
--
ALTER TABLE `attendance_status`
  ADD CONSTRAINT `attend_status_user_id` FOREIGN KEY (`user_acc_id`) REFERENCES `user_acc` (`user_acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attended_webinar`
--
ALTER TABLE `attended_webinar`
  ADD CONSTRAINT `webinar` FOREIGN KEY (`attended_webinar_id`) REFERENCES `webinar` (`webinar_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `intern_info`
--
ALTER TABLE `intern_info`
  ADD CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `user_acc` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `intern_leave`
--
ALTER TABLE `intern_leave`
  ADD CONSTRAINT `leave_user` FOREIGN KEY (`user_acc_id`) REFERENCES `user_acc` (`user_acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `intern_report`
--
ALTER TABLE `intern_report`
  ADD CONSTRAINT `report_user` FOREIGN KEY (`user_acc_id`) REFERENCES `user_acc` (`user_acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_intern` FOREIGN KEY (`user_acc_id`) REFERENCES `user_acc` (`user_acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requested_intern_status`
--
ALTER TABLE `requested_intern_status`
  ADD CONSTRAINT `requesting_change_status` FOREIGN KEY (`user_acc_id`) REFERENCES `user_acc` (`user_acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `team_members`
--
ALTER TABLE `team_members`
  ADD CONSTRAINT `members` FOREIGN KEY (`team_name_id`) REFERENCES `team` (`team_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `team_project`
--
ALTER TABLE `team_project`
  ADD CONSTRAINT `team_name` FOREIGN KEY (`team_name1`) REFERENCES `team` (`team_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `team_project` FOREIGN KEY (`user_acc_id`) REFERENCES `user_acc` (`user_acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `webinar`
--
ALTER TABLE `webinar`
  ADD CONSTRAINT `as` FOREIGN KEY (`user_acc_id`) REFERENCES `user_acc` (`user_acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `weekly_report`
--
ALTER TABLE `weekly_report`
  ADD CONSTRAINT `team_name12` FOREIGN KEY (`team_name1`) REFERENCES `team` (`team_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `weekly_report` FOREIGN KEY (`user_acc_id`) REFERENCES `user_acc` (`user_acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
