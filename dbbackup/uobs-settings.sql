-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2018 at 11:21 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uobs-settings`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `job_app_equ_qual`
--
CREATE TABLE `job_app_equ_qual` (
`app_id` int(11)
,`name` varchar(50)
,`is_eligible` enum('yes','no','','')
,`reason` text
,`obt_marks` int(11)
,`total_marks` int(11)
,`obt_gpa` decimal(10,2)
,`total_gpa` decimal(10,2)
,`percentage` decimal(10,2)
,`division` enum('1st','2nd','3rd','')
,`equivalent_to` enum('ssc','hssc','bachelor','master','mphil','phd','nil')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_admin_departments`
--
CREATE TABLE `kiusc_admin_departments` (
`id` int(11)
,`name` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_admissions`
--
CREATE TABLE `kiusc_admissions` (
`id` int(11)
,`title` varchar(100)
,`detail` text
,`advertisement_date` date
,`last_date` date
,`year` year(4)
,`active` int(11)
,`approval_id` int(11)
,`sem_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_admi_applicants`
--
CREATE TABLE `kiusc_admi_applicants` (
`id` int(11)
,`application_no` varchar(50)
,`name` varchar(100)
,`fname` varchar(100)
,`guardian_name` varchar(100)
,`dob` date
,`cnic` varchar(20)
,`postal_address` varchar(100)
,`permanent_address` varchar(100)
,`district_id` int(11)
,`tehsil_id` int(11)
,`village` varchar(100)
,`father_occupation` varchar(100)
,`guardian_occupation` varchar(100)
,`father_phone` varchar(20)
,`guardian_phone` varchar(20)
,`email` varchar(50)
,`cell_no` varchar(20)
,`gender` varchar(20)
,`priority1` int(11)
,`prefer_p1` int(11)
,`priority2` int(11)
,`prefer_p2` int(11)
,`priority3` int(11)
,`prefer_p3` int(11)
,`priority4` int(11)
,`prefer_p4` int(11)
,`is_eligible_p1` int(11)
,`is_eligible_p2` int(11)
,`is_eligible_p3` int(11)
,`is_eligible_p4` int(11)
,`picture` varchar(200)
,`remarks` varchar(300)
,`admission_id` int(11)
,`hafiz` int(11)
,`sports` int(11)
,`special_person` int(11)
,`army` int(11)
,`is_gb_domicile` int(11)
,`level` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_admi_app_merit`
--
CREATE TABLE `kiusc_admi_app_merit` (
`id` int(11)
,`app_id` int(11)
,`merit_id` int(11)
,`score` decimal(10,2)
,`status` varchar(100)
,`priority_no` int(11)
,`challan_no` varchar(100)
,`amount` decimal(10,2)
,`submit_date` date
,`paid` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_admi_criteria`
--
CREATE TABLE `kiusc_admi_criteria` (
`id` int(11)
,`level` varchar(50)
,`ssc` int(11)
,`hssc` int(11)
,`bachelor` int(11)
,`master` int(11)
,`prefer` int(11)
,`admission_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_admi_merit_list`
--
CREATE TABLE `kiusc_admi_merit_list` (
`id` int(11)
,`prog_id` int(11)
,`description` varchar(200)
,`display_date` date
,`last_date` date
,`admission_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_admi_prov_merit`
--
CREATE TABLE `kiusc_admi_prov_merit` (
`id` int(11)
,`app_id` int(11)
,`prog_id` int(11)
,`score` decimal(10,2)
,`status` varchar(100)
,`priority_no` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_admi_qualifications`
--
CREATE TABLE `kiusc_admi_qualifications` (
`id` int(11)
,`app_id` int(11)
,`degree_id` int(11)
,`year` year(4)
,`division` varchar(20)
,`obt_marks` decimal(10,2)
,`total_marks` decimal(10,2)
,`obt_gpa` decimal(10,2)
,`total_gpa` decimal(10,2)
,`major_subjects` varchar(100)
,`board` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_admi_quota`
--
CREATE TABLE `kiusc_admi_quota` (
`id` int(11)
,`prog_id` int(11)
,`no_of_seats` int(11)
,`out_of_gb_per` int(11)
,`gb_per` int(11)
,`admission_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_admi_score`
--
CREATE TABLE `kiusc_admi_score` (
`id` int(11)
,`app_id` int(11)
,`score` decimal(10,2)
,`prog_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_approvals`
--
CREATE TABLE `kiusc_approvals` (
`id` int(11)
,`attachment` varchar(500)
,`title` varchar(100)
,`date` date
,`type` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_attendance_students`
--
CREATE TABLE `kiusc_attendance_students` (
`id` int(11)
,`std_id` int(11)
,`lecture_id` int(11)
,`status` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_banks`
--
CREATE TABLE `kiusc_banks` (
`id` int(11)
,`bank_name` varchar(100)
,`account_no` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_bank_cheqs`
--
CREATE TABLE `kiusc_bank_cheqs` (
`id` int(11)
,`chq_book_id` int(11)
,`chq_no` int(20)
,`status` enum('Active','Issued','Cancelled')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_bank_cheq_books`
--
CREATE TABLE `kiusc_bank_cheq_books` (
`id` int(11)
,`bank_id` int(11)
,`chq_prefix` varchar(100)
,`chq_no_from` int(20)
,`chq_no_to` int(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_blocks`
--
CREATE TABLE `kiusc_blocks` (
`id` int(11)
,`block_name` varchar(50)
,`block_number` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_coffer_sp`
--
CREATE TABLE `kiusc_coffer_sp` (
`id` int(11)
,`prog_id` int(11)
,`sem_id` int(11)
,`course_id` int(11)
,`fac_id` int(11)
,`eva_cat_id` int(11)
,`sp_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_contributions`
--
CREATE TABLE `kiusc_contributions` (
`id` int(11)
,`name` varchar(100)
,`designation` varchar(50)
,`description` text
,`picture` varchar(200)
,`priority` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_correction_token`
--
CREATE TABLE `kiusc_correction_token` (
`token_no` int(11)
,`reg_no` varchar(100)
,`c_offer_id` int(11)
,`is_used` int(11)
,`user_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_courses`
--
CREATE TABLE `kiusc_courses` (
`id` int(11)
,`name` varchar(200)
,`prog_name` varchar(100)
,`dept_id` int(11)
,`pre_req1` int(11)
,`pre_req2` int(11)
,`pre_req3` int(11)
,`cr_hours` int(11)
,`course_code` varchar(20)
,`course_abbreviation` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_course_offered`
--
CREATE TABLE `kiusc_course_offered` (
`id` int(11)
,`prog_id` int(11)
,`sem_id` int(11)
,`course_id` int(11)
,`fac_id` int(11)
,`eva_cat_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_course_offered_detail`
--
CREATE TABLE `kiusc_course_offered_detail` (
`id` int(11)
,`c_offer_id` int(11)
,`description` text
,`outcomes` text
,`readings` text
,`requirements` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_course_reg`
--
CREATE TABLE `kiusc_course_reg` (
`id` int(11)
,`student_id` int(11)
,`sem_id` int(11)
,`c_offered1_id` int(11)
,`c_offered2_id` int(11)
,`c_offered3_id` int(11)
,`c_offered4_id` int(11)
,`c_offered5_id` int(11)
,`c_offered6_id` int(11)
,`c_offered7_id` int(11)
,`c_offered8_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_datesheet`
--
CREATE TABLE `kiusc_datesheet` (
`id` int(11)
,`sem_id` int(11)
,`c_offer_id` int(11)
,`room_id` int(11)
,`fac_id` int(11)
,`date` date
,`start` time
,`end` time
,`merge_offer_id` int(11)
,`exam` enum('Mid Term','Final Term')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_degrees`
--
CREATE TABLE `kiusc_degrees` (
`id` int(11)
,`degree_title` varchar(200)
,`d_level_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_degree_levels`
--
CREATE TABLE `kiusc_degree_levels` (
`id` int(11)
,`level` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_degree_titles`
--
CREATE TABLE `kiusc_degree_titles` (
`id` int(11)
,`degree_title` varchar(200)
,`no_of_sem` int(11)
,`req_cr_hours` int(11)
,`level` enum('BS','Master','PhD')
,`years` enum('16 Years','18 Years','PhD','')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_departments`
--
CREATE TABLE `kiusc_departments` (
`id` int(11)
,`name` varchar(100)
,`group` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_designations`
--
CREATE TABLE `kiusc_designations` (
`id` int(11)
,`designation` varchar(100)
,`type` enum('Faculty','Admin','Supporting','')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_districts`
--
CREATE TABLE `kiusc_districts` (
`id` int(11)
,`name` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_employees`
--
CREATE TABLE `kiusc_employees` (
`id` int(11)
,`user_id` int(11)
,`name` varchar(100)
,`fname` varchar(100)
,`cnic` varchar(15)
,`permanent_address` varchar(300)
,`cur_address` varchar(300)
,`cell_no1` varchar(20)
,`cell_no2` varchar(20)
,`email` varchar(50)
,`date_of_joining` date
,`emp_type` enum('Permanent','Tenured','Contract','Visiting','Daily Wages')
,`pay_scale` int(11)
,`scale_type` enum('BPS','TTS','Nil')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_emp_designation`
--
CREATE TABLE `kiusc_emp_designation` (
`id` int(11)
,`emp_id` int(11)
,`designation_id` int(11)
,`start_date` date
,`end_date` date
,`acc_department_id` int(11)
,`adm_department_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_evaluation`
--
CREATE TABLE `kiusc_evaluation` (
`id` int(11)
,`description` varchar(300)
,`start_date` date
,`end_date` date
,`sem_id` int(11)
,`enable_std` int(11)
,`active` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_evaluationcategory`
--
CREATE TABLE `kiusc_evaluationcategory` (
`id` int(11)
,`qa` int(11)
,`practical` int(11)
,`mid_term` int(11)
,`final_term` int(11)
,`thesis` int(11)
,`non_credit` int(11)
,`active` tinyint(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_eval_questions`
--
CREATE TABLE `kiusc_eval_questions` (
`id` int(11)
,`eval_id` int(11)
,`question` text
,`positive` int(11)
,`cat_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_eval_ques_category`
--
CREATE TABLE `kiusc_eval_ques_category` (
`id` int(11)
,`name` varchar(300)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_eval_std`
--
CREATE TABLE `kiusc_eval_std` (
`id` int(11)
,`eval_id` int(11)
,`question_id` int(11)
,`c_offer_id` int(11)
,`ans` varchar(300)
,`std_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_fee_challan`
--
CREATE TABLE `kiusc_fee_challan` (
`id` int(11)
,`std_fee_id` int(11)
,`std_gen_fee_id` int(11)
,`challan_no` varchar(50)
,`total_amount` decimal(10,2)
,`received_date` date
,`received_amount` decimal(10,2)
,`paid` int(11)
,`last_date` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_fee_challan_student`
--
CREATE TABLE `kiusc_fee_challan_student` (
`id` int(11)
,`std_fee_id` int(11)
,`challan_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_fee_refunds`
--
CREATE TABLE `kiusc_fee_refunds` (
`id` int(11)
,`fee_std_sem_detail_id` int(11)
,`fee_std_gen_id` int(11)
,`payment_id` int(11)
,`refund_date` date
,`amount` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_fee_scholarship`
--
CREATE TABLE `kiusc_fee_scholarship` (
`id` int(11)
,`std_fee_id` int(11)
,`std_id` int(11)
,`agency_id` int(11)
,`amount` decimal(10,2)
,`received_date` date
,`payment_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_fee_semester_setting`
--
CREATE TABLE `kiusc_fee_semester_setting` (
`id` int(11)
,`fee_id` int(11)
,`prog_id` int(11)
,`sem_id` int(11)
,`amount` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_fee_student_general`
--
CREATE TABLE `kiusc_fee_student_general` (
`id` int(11)
,`std_id` int(11)
,`semester_fee_id` int(11)
,`amount` decimal(10,2)
,`type` enum('Readmission','Freeze','Course Repeat','Improvement','Others')
,`ref_table_id` int(11)
,`description` varchar(200)
,`refunded` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_fee_student_sem`
--
CREATE TABLE `kiusc_fee_student_sem` (
`id` int(11)
,`std_id` int(11)
,`prog_id` int(11)
,`sem_id` int(11)
,`t_amount` decimal(10,2)
,`description` varchar(200)
,`fee_date` date
,`last_date1` date
,`fine_date1` decimal(10,2)
,`last_date2` date
,`fine_date2` decimal(10,2)
,`last_date3` date
,`is_semester` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_fee_student_sem_detail`
--
CREATE TABLE `kiusc_fee_student_sem_detail` (
`id` int(11)
,`fee_std_sem_id` int(11)
,`sem_fee_id` int(11)
,`par_name` varchar(100)
,`amount` decimal(10,2)
,`refunded` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_fee_type`
--
CREATE TABLE `kiusc_fee_type` (
`id` int(11)
,`description` varchar(100)
,`type` varchar(100)
,`refundable` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_freeze`
--
CREATE TABLE `kiusc_freeze` (
`id` int(11)
,`stud_id` int(11)
,`start_sem_id` int(11)
,`no_of_sem` int(11)
,`from_prog_id` int(11)
,`to_prog_id` int(11)
,`freeze_date` date
,`freeze_approval_id` int(11)
,`unfreeze_date` date
,`unfreeze_approval_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_gpa_qp`
--
CREATE TABLE `kiusc_gpa_qp` (
`id` int(11)
,`cr_hrs` int(11)
,`marks` int(11)
,`gp` decimal(12,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_gpa_requirement`
--
CREATE TABLE `kiusc_gpa_requirement` (
`id` int(11)
,`degree_title_id` int(11)
,`semesterGPA` decimal(10,2)
,`upto_semester_no` int(11)
,`semester1` decimal(10,2)
,`semester2` decimal(10,2)
,`semester3` decimal(10,2)
,`semester4` decimal(10,2)
,`semester5` decimal(10,2)
,`semester6` decimal(10,2)
,`semester7` decimal(10,2)
,`semester8` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_grace_marks`
--
CREATE TABLE `kiusc_grace_marks` (
`id` int(11)
,`stud_id` int(11)
,`result_id` int(11)
,`old_marks` int(11)
,`grace_mark` int(11)
,`approval_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_grade_points`
--
CREATE TABLE `kiusc_grade_points` (
`id` int(11)
,`obt_marks` decimal(20,2)
,`grade` varchar(10)
,`gp` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_jobs`
--
CREATE TABLE `kiusc_jobs` (
`id` int(11)
,`post` varchar(200)
,`date_of_advertisement` date
,`last_date` date
,`description` text
,`conditions` text
,`criteria_id` int(11)
,`approval_id` int(11)
,`active` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_job_applicants`
--
CREATE TABLE `kiusc_job_applicants` (
`id` int(11)
,`applicant_no` varchar(50)
,`name` varchar(50)
,`fname` varchar(50)
,`dob` date
,`cnic` varchar(50)
,`cell_no` varchar(50)
,`email` varchar(50)
,`postal_address` varchar(100)
,`district_id` int(11)
,`tehsil_id` int(11)
,`village` varchar(100)
,`remarks` text
,`is_eligible` enum('yes','no','','')
,`reason` text
,`picture` varchar(300)
,`interview` decimal(10,2)
,`test_marks` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_job_app_map`
--
CREATE TABLE `kiusc_job_app_map` (
`id` int(11)
,`applicant_id` int(11)
,`job_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_job_criteria`
--
CREATE TABLE `kiusc_job_criteria` (
`id` int(11)
,`description` varchar(100)
,`ssc` int(11)
,`hssc` int(11)
,`bachelor` int(11)
,`master` int(11)
,`mphil` int(11)
,`phd` int(11)
,`experience` int(11)
,`max_exp` int(11)
,`distinction` int(11)
,`max_dist` int(11)
,`publication` int(11)
,`max_publ` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_job_distinctions`
--
CREATE TABLE `kiusc_job_distinctions` (
`id` int(11)
,`title` varchar(100)
,`description` text
,`applicant_id` int(11)
,`countable` enum('yes','no','','')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_job_experiences`
--
CREATE TABLE `kiusc_job_experiences` (
`id` int(11)
,`job_title` varchar(100)
,`organization` varchar(100)
,`exp_from` date
,`exp_to` date
,`month` decimal(10,2)
,`countable` enum('yes','no','','')
,`years` decimal(10,1)
,`applicant_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_job_gpa_rang`
--
CREATE TABLE `kiusc_job_gpa_rang` (
`id` int(11)
,`gpa1` decimal(10,2)
,`gpa2` decimal(10,2)
,`per1` decimal(10,2)
,`per2` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_job_publications`
--
CREATE TABLE `kiusc_job_publications` (
`id` int(11)
,`title` varchar(200)
,`journal` varchar(200)
,`impact_factor` decimal(10,2)
,`applicant_id` int(11)
,`countable` enum('yes','no','','')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_job_qualifications`
--
CREATE TABLE `kiusc_job_qualifications` (
`id` int(11)
,`degree_id` int(11)
,`applicant_id` int(11)
,`institute` varchar(100)
,`year` year(4)
,`obt_marks` int(11)
,`total_marks` int(11)
,`obt_gpa` decimal(10,2)
,`total_gpa` decimal(10,2)
,`percentage` decimal(10,2)
,`division` enum('1st','2nd','3rd','')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_job_qual_equi`
--
CREATE TABLE `kiusc_job_qual_equi` (
`id` int(11)
,`qualification_id` int(11)
,`equivalent_to` enum('ssc','hssc','bachelor','master','mphil','phd','nil')
,`applicant_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_job_result`
--
CREATE TABLE `kiusc_job_result` (
`app_id` int(11)
,`name` varchar(100)
,`scc_total` decimal(10,2)
,`scc_obt` decimal(10,2)
,`scc_per` decimal(10,2)
,`scc_points` decimal(10,2)
,`hssc_total` decimal(10,2)
,`hssc_obt` decimal(10,2)
,`hssc_per` decimal(10,2)
,`hssc_points` decimal(10,2)
,`bachelor_total` decimal(10,2)
,`bachelor_obt` decimal(10,2)
,`bachelor_per` decimal(10,2)
,`bachelor_points` decimal(10,2)
,`master_total` decimal(10,2)
,`master_obt` decimal(10,2)
,`master_per` decimal(10,2)
,`master_points` decimal(10,2)
,`mphile_per` decimal(10,2)
,`mphil_points` decimal(10,2)
,`phd_points` decimal(10,2)
,`publications` decimal(10,2)
,`experience` decimal(10,2)
,`total_accademics` decimal(10,2)
,`total_test` decimal(10,2)
,`total_interview` decimal(10,2)
,`g_total` decimal(10,2)
,`remarks` varchar(300)
,`accd_weightage` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_job_skills`
--
CREATE TABLE `kiusc_job_skills` (
`id` int(11)
,`skill_title` varchar(100)
,`description` text
,`applicant_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_lectures`
--
CREATE TABLE `kiusc_lectures` (
`id` int(11)
,`c_offer_id` int(11)
,`date` date
,`period_id` int(11)
,`noLecture` tinyint(4)
,`noLectureReason` varchar(300)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_merged_courses`
--
CREATE TABLE `kiusc_merged_courses` (
`id` int(11)
,`cf_id_1` int(11)
,`cf_id_2` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_notice_board`
--
CREATE TABLE `kiusc_notice_board` (
`id` int(11)
,`dep_id` int(11)
,`prog_id` int(11)
,`stud_id` int(11)
,`msg_date` date
,`exp_date` date
,`title` varchar(200)
,`detail` text
,`user_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_payments`
--
CREATE TABLE `kiusc_payments` (
`id` int(11)
,`chq_id` int(11)
,`date` date
,`amount` decimal(10,2)
,`paid` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_programs`
--
CREATE TABLE `kiusc_programs` (
`id` int(11)
,`dep_id` int(11)
,`name` varchar(100)
,`group` varchar(10)
,`session` int(11)
,`session_name` varchar(20)
,`degree_title_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_prog_sem`
--
CREATE TABLE `kiusc_prog_sem` (
`id` int(11)
,`prog_id` int(11)
,`sem_id` int(11)
,`sem_no` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_readmission`
--
CREATE TABLE `kiusc_readmission` (
`id` int(11)
,`old_stud_id` int(11)
,`new_stud_id` int(11)
,`approval_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_reservation`
--
CREATE TABLE `kiusc_reservation` (
`id` int(11)
,`sem_id` int(11)
,`c_offer_id` int(11)
,`room_id` int(11)
,`start` time
,`end` time
,`day` enum('Monday','Tuesday','Wenesday','Thursday','Friday','Saturday','Sunday')
,`date` date
,`status` enum('Pending','Approved','Reject')
,`cnic` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_results`
--
CREATE TABLE `kiusc_results` (
`id` int(11)
,`stud_id` int(11)
,`sem_id` int(11)
,`c_offer_id` int(11)
,`mid_term` decimal(10,2)
,`assignments` decimal(10,2)
,`final_term` decimal(10,2)
,`total` decimal(10,2)
,`quality_points` decimal(10,2)
,`practical` decimal(10,2)
,`repeat_cf_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_result_cancel`
--
CREATE TABLE `kiusc_result_cancel` (
`id` int(11)
,`stud_id` int(11)
,`reason` varchar(200)
,`approval_id` int(11)
,`cancel_date` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_result_entry`
--
CREATE TABLE `kiusc_result_entry` (
`cf_id` int(11)
,`course_id` int(11)
,`user_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_result_log`
--
CREATE TABLE `kiusc_result_log` (
`id` int(11)
,`r_id` int(11)
,`user_id` int(11)
,`approval_id` int(11)
,`date` varchar(20)
,`mid_term` decimal(10,2)
,`assignments` decimal(10,2)
,`final_term` decimal(10,2)
,`total` decimal(10,2)
,`practical` decimal(10,2)
,`quality_points` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_rooms`
--
CREATE TABLE `kiusc_rooms` (
`id` int(11)
,`room_number` varchar(20)
,`room_capacity` varchar(20)
,`block_id` int(11)
,`roomtype_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_room_program`
--
CREATE TABLE `kiusc_room_program` (
`id` int(11)
,`prog_id` int(11)
,`room_id` int(11)
,`sem_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_room_type`
--
CREATE TABLE `kiusc_room_type` (
`id` int(11)
,`roomtype_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_scholarship_agencies`
--
CREATE TABLE `kiusc_scholarship_agencies` (
`id` int(11)
,`name` varchar(100)
,`contact_no` varchar(50)
,`email` varchar(50)
,`remarks` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_security_refunds`
--
CREATE TABLE `kiusc_security_refunds` (
`id` int(11)
,`std_id` int(11)
,`fee_sem_detail_id` int(11)
,`description` varchar(100)
,`payment_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_semesters`
--
CREATE TABLE `kiusc_semesters` (
`id` int(11)
,`sem_name` varchar(100)
,`start_date` date
,`mid_term_date` date
,`final_term_date` date
,`final_term_end_date` date
,`course_offer` int(11)
,`course_reg` tinyint(1)
,`mid_term` tinyint(1)
,`final_term` tinyint(1)
,`active` tinyint(4)
,`result_declare` int(11)
,`result_date` date
,`is_current` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_specialization`
--
CREATE TABLE `kiusc_specialization` (
`id` int(11)
,`dept_id` int(11)
,`name` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_specialization_courses`
--
CREATE TABLE `kiusc_specialization_courses` (
`id` int(11)
,`c_offer_id` int(11)
,`sp_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_specialization_prog`
--
CREATE TABLE `kiusc_specialization_prog` (
`id` int(11)
,`prog_id` int(11)
,`sp_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_std_clearance`
--
CREATE TABLE `kiusc_std_clearance` (
`id` int(11)
,`stud_id` int(11)
,`dep_user_id` int(11)
,`dep_clearance` int(11)
,`lib_user_id` int(11)
,`lib_clearance` int(11)
,`acct_user_id` int(11)
,`acct_clearance` int(11)
,`exam_user_id` int(11)
,`exam_clearance` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_std_documents`
--
CREATE TABLE `kiusc_std_documents` (
`id` int(11)
,`stud_id` int(11)
,`marksheets` int(11)
,`domicile` int(11)
,`migration` int(11)
,`cnic` int(11)
,`affidavit` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_std_status`
--
CREATE TABLE `kiusc_std_status` (
`id` int(11)
,`stud_id` int(11)
,`sem_id` int(11)
,`status` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_students`
--
CREATE TABLE `kiusc_students` (
`id` int(11)
,`prog_id` int(11)
,`department_id` int(11)
,`application_no` varchar(12)
,`reg_no` varchar(25)
,`name` varchar(100)
,`fname` varchar(100)
,`dob` varchar(25)
,`cnic` varchar(25)
,`cell` varchar(12)
,`permanent_address` varchar(255)
,`gender` varchar(12)
,`remarks` varchar(25)
,`email` varchar(200)
,`recipt_no` int(11)
,`amount` decimal(10,2)
,`date` date
,`district_id` int(11)
,`tehsil_id` int(11)
,`village` varchar(255)
,`postal_address` varchar(255)
,`guardian_name` varchar(100)
,`father_occupation` varchar(100)
,`guardian_occupation` varchar(100)
,`father_phone` varchar(20)
,`guardian_phone` varchar(20)
,`picture` varchar(255)
,`is_readmit` varchar(20)
,`is_result_cancel` varchar(20)
,`specialization_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_st_qualification`
--
CREATE TABLE `kiusc_st_qualification` (
`id` int(11)
,`stud_id` int(11)
,`degree_id` int(11)
,`institute` varchar(200)
,`year` varchar(50)
,`division` varchar(20)
,`total_marks` int(11)
,`obtained_marks` int(11)
,`total_gpa` decimal(10,2)
,`gpa` decimal(10,2)
,`major_subjects` varchar(255)
,`board` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_tehsils`
--
CREATE TABLE `kiusc_tehsils` (
`id` int(11)
,`name` varchar(100)
,`district_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_tel_categories`
--
CREATE TABLE `kiusc_tel_categories` (
`id` int(11)
,`name` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_tel_directory`
--
CREATE TABLE `kiusc_tel_directory` (
`id` int(11)
,`name` varchar(100)
,`phone_no` varchar(100)
,`fax` varchar(100)
,`extension` varchar(100)
,`email` varchar(100)
,`cell_no` varchar(100)
,`address` varchar(100)
,`designation` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_tel_directory_cat`
--
CREATE TABLE `kiusc_tel_directory_cat` (
`id` int(11)
,`cat_id` int(11)
,`directory_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_thesis`
--
CREATE TABLE `kiusc_thesis` (
`id` int(11)
,`std_id` int(11)
,`result_id` int(11)
,`thesis_title` text
,`supervisor_id` int(11)
,`external` varchar(200)
,`coordinator` varchar(200)
,`kiu_representative` varchar(200)
,`dean` varchar(200)
,`exam_date` date
,`grade` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_timetable`
--
CREATE TABLE `kiusc_timetable` (
`id` int(11)
,`sem_id` int(11)
,`c_offer_id` int(11)
,`room_id` int(11)
,`fac_id` int(11)
,`start` time
,`end` time
,`day` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')
,`period` float
,`start_date` date
,`end_date` date
,`is_changed` int(11)
,`merge_offer_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_timetable_setting`
--
CREATE TABLE `kiusc_timetable_setting` (
`id` int(11)
,`start_time` time
,`end_time` time
,`prog_id` int(11)
,`friday_break_start` time
,`friday_break_end` time
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kiusc_transcripts`
--
CREATE TABLE `kiusc_transcripts` (
`id` int(11)
,`bank_id` int(11)
,`chalan_no` varchar(100)
,`fee_date` date
,`reg_no` varchar(100)
,`issuance_date` date
,`sheet_no` varchar(100)
,`user_id` int(11)
,`type` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `lms_add_quiz_marks`
--
CREATE TABLE `lms_add_quiz_marks` (
`id` int(11)
,`std_id` int(11)
,`quiz_id` int(11)
,`obtain_marks` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `lms_create_assignment`
--
CREATE TABLE `lms_create_assignment` (
`assi_id` int(11)
,`syl_id` int(11)
,`title` varchar(255)
,`description` text
,`post_date` date
,`attachment` text
,`due_date` date
,`total_marks` int(11)
,`course_ofr_id` int(11)
,`include_final` tinyint(1)
,`published` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `lms_create_quiz`
--
CREATE TABLE `lms_create_quiz` (
`quiz_id` int(11)
,`syl_id` int(11)
,`create_date` date
,`start_time` time
,`end_time` time
,`course_ofr_id` int(11)
,`total_marks` int(11)
,`published` tinyint(1)
,`questions` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `lms_holidays`
--
CREATE TABLE `lms_holidays` (
`h_id` int(11)
,`k_id` int(11)
,`n_id` int(11)
,`is_id` int(11)
,`days` int(11)
,`start` int(11)
,`show_student` tinyint(4)
,`year_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `lms_islamic_calander`
--
CREATE TABLE `lms_islamic_calander` (
`id` int(11)
,`hijri_year` varchar(50)
,`hijri_month` varchar(100)
,`date` date
,`set(yes/no)` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `lms_islamic_events`
--
CREATE TABLE `lms_islamic_events` (
`id` int(11)
,`month` int(11)
,`day` int(100)
,`event_name` varchar(200)
,`remarks` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `lms_kiu_events`
--
CREATE TABLE `lms_kiu_events` (
`id` int(11)
,`date_from` date
,`date_to` date
,`eve_id` int(11)
,`remarks` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `lms_kiu_event_name`
--
CREATE TABLE `lms_kiu_event_name` (
`id` int(11)
,`event_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `lms_lecture_note`
--
CREATE TABLE `lms_lecture_note` (
`lec_id` int(11)
,`syl_id` int(11)
,`lec_file` varchar(200)
,`lec_cofr_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `lms_national_events`
--
CREATE TABLE `lms_national_events` (
`id` int(11)
,`n_month` int(11)
,`day` int(11)
,`event_name` varchar(200)
,`remarks` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `lms_personal_event`
--
CREATE TABLE `lms_personal_event` (
`p_id` int(11)
,`fac_id` int(11)
,`event_name` varchar(100)
,`date` date
,`remarks` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `lms_return_assignment`
--
CREATE TABLE `lms_return_assignment` (
`return_id` int(11)
,`sub_assi_id` int(11)
,`return_file` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `lms_submitte_assignment`
--
CREATE TABLE `lms_submitte_assignment` (
`sub_assi_id` int(11)
,`std_id` int(11)
,`assi_id` int(11)
,`remarks` text
,`submission_date` date
,`marks` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `lms_submitte_file`
--
CREATE TABLE `lms_submitte_file` (
`f_id` int(11)
,`sub_assi_id` int(11)
,`sub_file` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `lms_syllabus`
--
CREATE TABLE `lms_syllabus` (
`syl_id` int(11)
,`lecture_id` int(11)
,`lecture` varchar(300)
,`topic` text
,`reading` text
,`cofr_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `lms_visiting_bill`
--
CREATE TABLE `lms_visiting_bill` (
`id` int(11)
,`c_offer_id` int(11)
,`last_lecture_date` date
,`generate_date` date
,`t_amount` decimal(10,2)
,`paid` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_assets`
--

CREATE TABLE `s04cf_assets` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set parent.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `level` int(10) UNSIGNED NOT NULL COMMENT 'The cached level in the nested tree.',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The unique name for the asset.\n',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The descriptive title for the asset.',
  `rules` varchar(5120) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'JSON encoded access control.'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_assets`
--

INSERT INTO `s04cf_assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES
(1, 0, 0, 197, 0, 'root.1', 'Root Asset', '{"core.login.site":{"6":1,"2":1},"core.login.admin":{"6":1},"core.login.offline":{"6":1},"core.admin":{"8":1},"core.manage":{"7":1},"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}'),
(2, 1, 1, 2, 1, 'com_admin', 'com_admin', '{}'),
(3, 1, 3, 6, 1, 'com_banners', 'com_banners', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(4, 1, 7, 8, 1, 'com_cache', 'com_cache', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(5, 1, 9, 10, 1, 'com_checkin', 'com_checkin', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(6, 1, 11, 12, 1, 'com_config', 'com_config', '{}'),
(7, 1, 13, 16, 1, 'com_contact', 'com_contact', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(8, 1, 17, 100, 1, 'com_content', 'com_content', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(9, 1, 101, 102, 1, 'com_cpanel', 'com_cpanel', '{}'),
(10, 1, 103, 104, 1, 'com_installer', 'com_installer', '{"core.admin":[],"core.manage":{"7":0},"core.delete":{"7":0},"core.edit.state":{"7":0}}'),
(11, 1, 105, 106, 1, 'com_languages', 'com_languages', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(12, 1, 107, 108, 1, 'com_login', 'com_login', '{}'),
(13, 1, 109, 110, 1, 'com_mailto', 'com_mailto', '{}'),
(14, 1, 111, 112, 1, 'com_massmail', 'com_massmail', '{}'),
(15, 1, 113, 114, 1, 'com_media', 'com_media', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":{"5":1}}'),
(16, 1, 115, 118, 1, 'com_menus', 'com_menus', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(17, 1, 119, 120, 1, 'com_messages', 'com_messages', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(18, 1, 121, 162, 1, 'com_modules', 'com_modules', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(19, 1, 163, 166, 1, 'com_newsfeeds', 'com_newsfeeds', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(20, 1, 167, 168, 1, 'com_plugins', 'com_plugins', '{"core.admin":{"7":1},"core.manage":[],"core.edit":[],"core.edit.state":[]}'),
(21, 1, 169, 170, 1, 'com_redirect', 'com_redirect', '{"core.admin":{"7":1},"core.manage":[]}'),
(22, 1, 171, 172, 1, 'com_search', 'com_search', '{"core.admin":{"7":1},"core.manage":{"6":1}}'),
(23, 1, 173, 174, 1, 'com_templates', 'com_templates', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(24, 1, 175, 178, 1, 'com_users', 'com_users', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(25, 1, 179, 182, 1, 'com_weblinks', 'com_weblinks', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(26, 1, 183, 184, 1, 'com_wrapper', 'com_wrapper', '{}'),
(27, 8, 18, 99, 2, 'com_content.category.2', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(28, 3, 4, 5, 2, 'com_banners.category.3', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(29, 7, 14, 15, 2, 'com_contact.category.4', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(30, 19, 164, 165, 2, 'com_newsfeeds.category.5', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(31, 25, 180, 181, 2, 'com_weblinks.category.6', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(32, 24, 176, 177, 1, 'com_users.category.7', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(33, 1, 185, 186, 1, 'com_finder', 'com_finder', '{"core.admin":{"7":1},"core.manage":{"6":1}}'),
(34, 1, 187, 188, 1, 'com_joomlaupdate', 'com_joomlaupdate', '{"core.admin":[],"core.manage":[],"core.delete":[],"core.edit.state":[]}'),
(35, 1, 189, 190, 1, 'com_tags', 'com_tags', '{"core.admin":[],"core.manage":[],"core.manage":[],"core.delete":[],"core.edit.state":[]}'),
(36, 1, 191, 192, 1, 'com_contenthistory', 'com_contenthistory', '{}'),
(37, 1, 193, 194, 1, 'com_ajax', 'com_ajax', '{}'),
(38, 1, 195, 196, 1, 'com_postinstall', 'com_postinstall', '{}'),
(39, 18, 122, 123, 2, 'com_modules.module.1', 'Main Menu', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(40, 18, 124, 125, 2, 'com_modules.module.2', 'Login', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(41, 18, 126, 127, 2, 'com_modules.module.3', 'Popular Articles', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(42, 18, 128, 129, 2, 'com_modules.module.4', 'Recently Added Articles', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(43, 18, 130, 131, 2, 'com_modules.module.8', 'Toolbar', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(44, 18, 132, 133, 2, 'com_modules.module.9', 'Quick Icons', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(45, 18, 134, 135, 2, 'com_modules.module.10', 'Logged-in Users', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(46, 18, 136, 137, 2, 'com_modules.module.12', 'Admin Menu', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(47, 18, 138, 139, 2, 'com_modules.module.13', 'Admin Submenu', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(48, 18, 140, 141, 2, 'com_modules.module.14', 'User Status', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(49, 18, 142, 143, 2, 'com_modules.module.15', 'Title', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(50, 18, 144, 145, 2, 'com_modules.module.16', 'Login Form', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(51, 18, 146, 147, 2, 'com_modules.module.17', 'Breadcrumbs', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(52, 18, 148, 149, 2, 'com_modules.module.79', 'Multilanguage status', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(53, 18, 150, 151, 2, 'com_modules.module.86', 'Joomla Version', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(54, 18, 152, 153, 2, 'com_modules.module.87', 'Course Registration', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(177, 27, 97, 98, 3, 'com_content.article.118', 'View Directory', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(56, 18, 154, 155, 2, 'com_modules.module.88', 'Students', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(70, 27, 19, 20, 3, 'com_content.article.15', 'Department', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(71, 27, 21, 22, 3, 'com_content.article.16', 'Program', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(72, 27, 23, 24, 3, 'com_content.article.17', 'Semester', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(74, 27, 25, 26, 3, 'com_content.article.19', 'District', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(75, 27, 27, 28, 3, 'com_content.article.20', 'Tehsil', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(76, 27, 29, 30, 3, 'com_content.article.21', 'Degrees', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(79, 27, 31, 32, 3, 'com_content.article.24', 'User Permissions', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(96, 27, 33, 34, 3, 'com_content.article.41', 'Add Applicants', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(97, 27, 35, 36, 3, 'com_content.article.42', 'Applicant Evaluation', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(98, 27, 37, 38, 3, 'com_content.article.43', 'Merit List', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(104, 18, 156, 157, 2, 'com_modules.module.89', 'Side Menu', '{"core.delete":[],"core.edit":[],"core.edit.state":[],"module.edit.frontend":[]}'),
(106, 18, 158, 159, 2, 'com_modules.module.90', 'Footer Note', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"module.edit.frontend":[]}'),
(111, 27, 39, 40, 3, 'com_content.article.54', 'Create Evaluation', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(112, 27, 41, 42, 3, 'com_content.article.55', 'Evaluation Questions', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(113, 27, 43, 44, 3, 'com_content.article.56', 'Check Evaluation List', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(114, 27, 45, 46, 3, 'com_content.article.57', 'Evaluation Summary', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(115, 27, 47, 48, 3, 'com_content.article.58', 'Evaluation Teacher Report', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(123, 27, 49, 50, 3, 'com_content.article.66', 'Ldap Student Group', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(124, 27, 51, 52, 3, 'com_content.article.67', 'Ldap Create Faculty Account', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(126, 27, 53, 54, 3, 'com_content.article.69', 'User Activation', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(127, 16, 116, 117, 2, 'com_menus.menu.7', 'Hidden Menu', '{}'),
(129, 27, 55, 56, 3, 'com_content.article.71', 'Faculty List', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(130, 27, 57, 58, 3, 'com_content.article.72', 'Faculty Edit Record', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(132, 27, 59, 60, 3, 'com_content.article.74', 'Block Setting', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(133, 27, 61, 62, 3, 'com_content.article.75', 'Room Type', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(134, 27, 63, 64, 3, 'com_content.article.76', 'Rooms', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(135, 27, 65, 66, 3, 'com_content.article.77', 'Room Allocation', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(136, 27, 67, 68, 3, 'com_content.article.78', 'Time Setting', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(138, 27, 69, 70, 3, 'com_content.article.80', 'Auto Generate', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(139, 27, 71, 72, 3, 'com_content.article.81', 'Manual Time Table', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(140, 27, 73, 74, 3, 'com_content.article.82', 'Change Time Table', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(141, 27, 75, 76, 3, 'com_content.article.83', 'Swap Periods', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(145, 27, 77, 78, 3, 'com_content.article.87', 'Unassigned Periods', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(152, 27, 79, 80, 3, 'com_content.article.94', 'Add Code Contributions', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(154, 27, 81, 82, 3, 'com_content.article.96', 'Empty Time Table', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(156, 27, 83, 84, 3, 'com_content.article.98', 'Islamic Calendar Setting', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(157, 27, 85, 86, 3, 'com_content.article.99', 'Add Events', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(158, 27, 87, 88, 3, 'com_content.article.100', 'Add Holidays', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(161, 27, 89, 90, 3, 'com_content.article.103', 'Empty Timetable Date', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(162, 27, 91, 92, 3, 'com_content.article.104', 'Manual Datesheet', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(172, 27, 93, 94, 3, 'com_content.article.114', 'Telephone Category', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(173, 27, 95, 96, 3, 'com_content.article.115', 'Add Contact', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(176, 18, 160, 161, 2, 'com_modules.module.91', 'Header', '{"core.delete":[],"core.edit":[],"core.edit.state":[],"module.edit.frontend":[]}');

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_associations`
--

CREATE TABLE `s04cf_associations` (
  `id` int(11) NOT NULL COMMENT 'A reference to the associated item.',
  `context` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The context of the associated item.',
  `key` char(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The key for the association computed from an md5 on associated ids.'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_banners`
--

CREATE TABLE `s04cf_banners` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `clickurl` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `custombannercode` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sticky` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `params` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `own_prefix` tinyint(1) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reset` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `version` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_banner_clients`
--

CREATE TABLE `s04cf_banner_clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `extrainfo` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `metakey` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `own_prefix` tinyint(4) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_banner_tracks`
--

CREATE TABLE `s04cf_banner_tracks` (
  `track_date` datetime NOT NULL,
  `track_type` int(10) UNSIGNED NOT NULL,
  `banner_id` int(10) UNSIGNED NOT NULL,
  `count` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_categories`
--

CREATE TABLE `s04cf_categories` (
  `id` int(11) NOT NULL,
  `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `level` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `path` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `extension` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `params` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadesc` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The meta description for the page.',
  `metakey` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The meta keywords for the page.',
  `metadata` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'JSON encoded metadata properties.',
  `created_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_categories`
--

INSERT INTO `s04cf_categories` (`id`, `asset_id`, `parent_id`, `lft`, `rgt`, `level`, `path`, `extension`, `title`, `alias`, `note`, `description`, `published`, `checked_out`, `checked_out_time`, `access`, `params`, `metadesc`, `metakey`, `metadata`, `created_user_id`, `created_time`, `modified_user_id`, `modified_time`, `hits`, `language`, `version`) VALUES
(1, 0, 0, 0, 13, 0, '', 'system', 'ROOT', 'root', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{}', '', '', '{}', 42, '2011-01-01 00:00:01', 0, '0000-00-00 00:00:00', 0, '*', 1),
(2, 27, 1, 1, 2, 1, 'uncategorised', 'com_content', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '0000-00-00 00:00:00', 0, '*', 1),
(3, 28, 1, 3, 4, 1, 'uncategorised', 'com_banners', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '0000-00-00 00:00:00', 0, '*', 1),
(4, 29, 1, 5, 6, 1, 'uncategorised', 'com_contact', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '0000-00-00 00:00:00', 0, '*', 1),
(5, 30, 1, 7, 8, 1, 'uncategorised', 'com_newsfeeds', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '0000-00-00 00:00:00', 0, '*', 1),
(6, 31, 1, 9, 10, 1, 'uncategorised', 'com_weblinks', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '0000-00-00 00:00:00', 0, '*', 1),
(7, 32, 1, 11, 12, 1, 'uncategorised', 'com_users', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 42, '2011-01-01 00:00:01', 0, '0000-00-00 00:00:00', 0, '*', 1);

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_contact_details`
--

CREATE TABLE `s04cf_contact_details` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `con_position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` mediumtext COLLATE utf8mb4_unicode_ci,
  `suburb` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `misc` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_con` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `webpage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sortname1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sortname2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sortname3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `metakey` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadesc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadata` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `xreference` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `version` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_content`
--

CREATE TABLE `s04cf_content` (
  `id` int(10) UNSIGNED NOT NULL,
  `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `introtext` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `fulltext` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `urls` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribs` varchar(5120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadesc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `access` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `metadata` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The language code for the article.',
  `xreference` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'A reference to enable linkages to external data sets.'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_content`
--

INSERT INTO `s04cf_content` (`id`, `asset_id`, `title`, `alias`, `introtext`, `fulltext`, `state`, `catid`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `images`, `urls`, `attribs`, `version`, `ordering`, `metakey`, `metadesc`, `access`, `hits`, `metadata`, `featured`, `language`, `xreference`) VALUES
(118, 177, 'View Directory', 'view-directory', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/telephone_directory/list_directory.php";</p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2018-01-23 11:03:40', 245, '', '2018-01-23 11:03:40', 0, 0, '0000-00-00 00:00:00', '2018-01-23 11:03:40', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 0, '', '', 2, 6, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(15, 70, 'Department', 'department', '<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{source}</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">&lt;?php</p>\r\n<p>include"newfiles/admin/department/department.php";</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">?&gt;</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{/source}</p>', '', 1, 2, '2016-05-11 06:34:05', 245, '', '2016-05-12 07:39:12', 245, 0, '0000-00-00 00:00:00', '2016-05-11 06:34:05', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 6, 39, '', '', 1, 370, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(16, 71, 'Program', 'program', '<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{source}</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">&lt;?php</p>\r\n<p style="font-size: 12.16px; line-height: 15.808px;">include"newfiles/admin/program/program.php";</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">?&gt;</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{/source}</p>', '', 1, 2, '2016-05-13 07:07:35', 245, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-05-13 07:07:35', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 38, '', '', 1, 87, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(17, 72, 'Semester', 'semester', '<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{source}</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">&lt;?php</p>\r\n<p style="font-size: 12.16px; line-height: 15.808px;">include"newfiles/admin/semester/semester.php";</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">?&gt;</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{/source}</p>', '', 1, 2, '2016-05-13 12:09:02', 245, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-05-13 12:09:02', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 37, '', '', 1, 192, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(19, 74, 'District', 'district', '<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{source}</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">&lt;?php</p>\r\n<p style="font-size: 12.16px; line-height: 15.808px;">include"newfiles/admin/district/district.php";</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">?&gt;</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{/source}</p>', '', 1, 2, '2016-05-18 04:51:12', 245, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-05-18 04:51:12', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 36, '', '', 1, 46, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(20, 75, 'Tehsil', 'tehsil', '<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{source}</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">&lt;?php</p>\r\n<p style="font-size: 12.16px; line-height: 15.808px;">include"newfiles/admin/tehsil/tehsil.php";</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">?&gt;</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{/source}</p>', '', 1, 2, '2016-05-18 04:51:34', 245, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-05-18 04:51:34', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 35, '', '', 1, 53, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(21, 76, 'Degrees', 'degrees', '<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{source}</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">&lt;?php</p>\r\n<p style="font-size: 12.16px; line-height: 15.808px;">include"newfiles/admin/degree/degree.php";</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">?&gt;</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{/source}</p>', '', 1, 2, '2016-05-18 05:55:08', 245, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-05-18 05:55:08', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 34, '', '', 1, 83, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(24, 79, 'User Permissions', 'user-permissions', '<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{source}</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">&lt;?php</p>\r\n<p style="font-size: 12.16px; line-height: 15.808px;">include"newfiles/admin/permission/user_permissions.php";</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">?&gt;</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{/source}</p>', '', 1, 2, '2016-05-30 05:58:51', 245, '', '2016-05-30 05:59:37', 245, 0, '0000-00-00 00:00:00', '2016-05-30 05:58:51', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 2, 33, '', '', 1, 484, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(41, 96, 'Add Applicants', 'add-applicants', '<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{source}</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">&lt;?php</p>\r\n<p style="font-size: 12.16px; line-height: 15.808px;">include"newfiles/jobs/add_applicant.php";</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">?&gt;</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{/source}</p>', '', 1, 2, '2016-07-27 10:46:03', 245, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-07-27 10:46:03', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 32, '', '', 1, 263, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(42, 97, 'Applicant Evaluation', 'applicant-evaluation', '<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{source}</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">&lt;?php</p>\r\n<p style="font-size: 12.16px; line-height: 15.808px;">include"newfiles/jobs/evaluation.php";</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">?&gt;</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{/source}</p>', '', 1, 2, '2016-07-27 10:46:23', 245, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-07-27 10:46:23', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 31, '', '', 1, 632, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(43, 98, 'Merit List', 'merit-list', '<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{source}</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">&lt;?php</p>\r\n<p style="font-size: 12.16px; line-height: 15.808px;">include"newfiles/jobs/merit/merit_list.php";</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">?&gt;</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{/source}</p>', '', 1, 2, '2016-07-29 09:13:34', 245, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-07-29 09:13:34', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 30, '', '', 1, 312, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(54, 111, 'Create Evaluation', 'create-evaluation', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/evaluation/create_evaluation/evaluation.php";</p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2016-11-10 08:37:15', 245, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-11-10 08:37:15', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 29, '', '', 1, 33, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(55, 112, 'Evaluation Questions', 'evaluation-questions', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/evaluation/questions.php";</p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2016-11-10 08:37:30', 245, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-11-10 08:37:30', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 28, '', '', 1, 72, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(56, 113, 'Check Evaluation List', 'check-evaluation-list', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/evaluation/check_eval_list.php";</p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2016-11-14 05:54:04', 245, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-11-14 05:54:04', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 27, '', '', 1, 1049, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(57, 114, 'Evaluation Summary', 'evaluation-summary', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/evaluation/summary/eval_summary.php";</p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2016-11-16 06:41:50', 245, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-11-16 06:41:50', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 26, '', '', 1, 64, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(58, 115, 'Evaluation Teacher Report', 'evaluation-teacher-report', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/evaluation/teacher_report/report.php";</p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2016-11-18 11:47:08', 245, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-11-18 11:47:08', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 25, '', '', 1, 336, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(66, 123, 'Ldap Student Group', 'ldap-student-group', '<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{source}</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">&lt;?php</p>\r\n<p style="font-size: 12.16px; line-height: 15.808px;">include"newfiles/ldap/student/create_group_account.php";</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">?&gt;</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{/source}</p>', '', 1, 2, '2017-01-06 10:14:32', 245, '', '2017-01-06 10:14:32', 0, 0, '0000-00-00 00:00:00', '2017-01-06 10:14:32', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 24, '', '', 1, 2225, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(67, 124, 'Ldap Create Faculty Account', 'ldap-create-faculty-account', '<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{source}</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">&lt;?php</p>\r\n<p style="font-size: 12.16px; line-height: 15.808px;">include"newfiles/ldap/faculty/create_faculty_account.php";</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">?&gt;</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{/source}</p>', '', 1, 2, '2017-01-11 06:41:12', 245, '', '2017-01-11 06:41:12', 0, 0, '0000-00-00 00:00:00', '2017-01-11 06:41:12', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 23, '', '', 1, 53, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(69, 126, 'User Activation', 'user-activation', '<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{source}</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">&lt;?php</p>\r\n<p style="font-size: 12.16px; line-height: 15.808px;">include"newfiles/ldap/faculty/user_activation.php";</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">?&gt;</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{/source}</p>', '', 1, 2, '2017-01-11 06:51:26', 245, '', '2017-01-11 06:51:26', 0, 0, '0000-00-00 00:00:00', '2017-01-11 06:51:26', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 22, '', '', 1, 84, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(71, 129, 'Faculty List', 'faculty-list', '<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{source}</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">&lt;?php</p>\r\n<p style="font-size: 12.16px; line-height: 15.808px;">include"newfiles/ldap/faculty/faculty_list.php";</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">?&gt;</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{/source}</p>', '', 1, 2, '2017-01-18 11:00:40', 245, '', '2017-01-18 11:00:40', 0, 0, '0000-00-00 00:00:00', '2017-01-18 11:00:40', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 21, '', '', 1, 82, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(72, 130, 'Faculty Edit Record', 'faculty-edit-record', '<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{source}</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">&lt;?php</p>\r\n<p style="font-size: 12.16px; line-height: 15.808px;">include"newfiles/ldap/faculty/faculty_edit_record.php";</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">?&gt;</p>\r\n<p style="font-size: 12.1599998474121px; line-height: 15.8079996109009px;">{/source}</p>', '', 1, 2, '2017-01-19 11:14:36', 245, '', '2017-01-19 11:19:15', 245, 0, '0000-00-00 00:00:00', '2017-01-19 11:14:36', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 2, 20, '', '', 1, 85, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(74, 132, 'Block Setting', 'block-setting', '<p>{source}</p>\r\n<p>&lt;?php</p>\r\n<p>include "newfiles/timeTable/blocks.php"; </p>\r\n<p>?&gt;</p>\r\n<p> </p>\r\n<p><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-02-14 08:25:14', 245, '', '2017-02-14 08:25:54', 245, 0, '0000-00-00 00:00:00', '2017-02-14 08:25:14', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 2, 19, '', '', 1, 23, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(75, 133, 'Room Type', 'room-type', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/timeTable/room_type.php"; </p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"> </p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-02-14 08:26:12', 245, '', '2017-02-14 08:26:24', 245, 0, '0000-00-00 00:00:00', '2017-02-14 08:26:12', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 2, 18, '', '', 1, 15, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(76, 134, 'Rooms', 'rooms', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/timeTable/rooms.php"; </p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"> </p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-02-14 08:26:35', 245, '', '2017-02-14 08:26:35', 0, 0, '0000-00-00 00:00:00', '2017-02-14 08:26:35', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 17, '', '', 1, 24, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(77, 135, 'Room Allocation', 'room-allocation', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/timeTable/rooms_allocation.php"; </p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"> </p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-02-14 08:27:01', 245, '', '2017-02-15 06:33:43', 245, 0, '0000-00-00 00:00:00', '2017-02-14 08:27:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 2, 16, '', '', 1, 319, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(78, 136, 'Time Setting', 'time-setting', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/timeTable/timetable_setting.php"; </p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"> </p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-02-15 06:34:13', 245, '', '2017-02-15 06:34:13', 0, 0, '0000-00-00 00:00:00', '2017-02-15 06:34:13', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 15, '', '', 1, 92, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(80, 138, 'Auto Generate', 'auto-generate', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/timeTable/auto_generation_tt.php"; </p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"> </p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-02-15 08:53:20', 245, '', '2017-02-24 10:17:07', 245, 0, '0000-00-00 00:00:00', '2017-02-15 08:53:20', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 3, 14, '', '', 2, 186, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(81, 139, 'Manual Time Table', 'manual-time-table', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/timeTable/manual_timetable.php"; </p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-02-15 09:35:00', 245, '', '2017-02-15 09:48:45', 245, 0, '0000-00-00 00:00:00', '2017-02-15 09:35:00', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 2, 13, '', '', 2, 1268, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(82, 140, 'Change Time Table', 'change-time-table', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/timeTable/change_timetable.php"; </p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-02-15 09:49:10', 245, '', '2017-02-15 10:16:54', 245, 0, '0000-00-00 00:00:00', '2017-02-15 09:49:10', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 2, 12, '', '', 2, 350, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(83, 141, 'Swap Periods', 'swap-periods', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/timeTable/swap_timetable.php"; </p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-02-15 10:17:35', 245, '', '2017-02-15 11:32:26', 245, 0, '0000-00-00 00:00:00', '2017-02-15 10:17:35', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 3, 11, '', '', 2, 197, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(87, 145, 'Unassigned Periods', 'unassigned-periods', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/timeTable/un_assigned_periods.php"; </p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-02-17 06:08:28', 245, '', '2017-02-20 08:02:21', 245, 0, '0000-00-00 00:00:00', '2017-02-17 06:08:28', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 2, 10, '', '', 2, 228, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', '');
INSERT INTO `s04cf_content` (`id`, `asset_id`, `title`, `alias`, `introtext`, `fulltext`, `state`, `catid`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `images`, `urls`, `attribs`, `version`, `ordering`, `metakey`, `metadesc`, `access`, `hits`, `metadata`, `featured`, `language`, `xreference`) VALUES
(94, 152, 'Add Code Contributions', 'add-code-contributions', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/code_contributions/contributions.php"; </p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-02-22 13:19:07', 245, '', '2017-02-22 13:19:07', 0, 0, '0000-00-00 00:00:00', '2017-02-22 13:19:07', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 9, '', '', 2, 84, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(96, 154, 'Empty Time Table', 'empty-time-table', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/timeTable/empty_timetable.php"; </p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"> </p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-02-24 10:17:50', 245, '', '2017-02-24 10:17:50', 0, 0, '0000-00-00 00:00:00', '2017-02-24 10:17:50', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 8, '', '', 2, 25, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(98, 156, 'Islamic Calendar Setting', 'islamic-calendar-setting', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/event/lms_islamic_calandar.php"; </p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-03-08 07:50:03', 245, '', '2017-03-08 11:28:12', 245, 0, '0000-00-00 00:00:00', '2017-03-08 07:50:03', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 2, 7, '', '', 2, 83, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(99, 157, 'Add Events', 'add-events', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/event/lms_add_events.php"; </p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-03-08 11:28:35', 245, '', '2017-03-08 11:28:35', 0, 0, '0000-00-00 00:00:00', '2017-03-08 11:28:35', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 6, '', '', 2, 409, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(100, 158, 'Add Holidays', 'add-holidays', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/event/lms_add_holidays.php"; </p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-03-08 11:37:00', 245, '', '2017-03-08 11:37:00', 0, 0, '0000-00-00 00:00:00', '2017-03-08 11:37:00', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 5, '', '', 2, 74, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(103, 161, 'Empty Timetable Date', 'empty-timetable-date', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/timeTable/empty_timetable_date.php"; </p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-03-13 13:07:03', 245, '', '2017-03-13 13:07:03', 0, 0, '0000-00-00 00:00:00', '2017-03-13 13:07:03', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 4, '', '', 1, 12, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(104, 162, 'Manual Datesheet', 'manual-datesheet', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/timeTable/manual_datesheet.php"; </p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-04-07 09:02:41', 245, '', '2017-04-07 09:02:41', 0, 0, '0000-00-00 00:00:00', '2017-04-07 09:02:41', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 1, 3, '', '', 2, 1633, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(114, 172, 'Telephone Category', 'telephone-category', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/telephone_directory/category/category.php";</p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-07-08 11:44:43', 245, '', '2017-07-12 09:27:49', 245, 0, '0000-00-00 00:00:00', '2017-07-08 11:44:43', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 2, 2, '', '', 2, 20, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(115, 173, 'Add Contact', 'add-contact', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;">&lt;?php</p>\r\n<p style="font-size: 12.16px;">include "newfiles/telephone_directory/add_contact.php";</p>\r\n<p style="font-size: 12.16px;">?&gt;</p>\r\n<p style="font-size: 12.16px;"><span style="font-size: 12.16px;">{/source}</span></p>', '', 1, 2, '2017-07-12 09:28:32', 245, '', '2017-07-13 08:15:32', 245, 0, '0000-00-00 00:00:00', '2017-07-12 09:28:32', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","extra-class":""}', 2, 1, '', '', 2, 24, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', '');

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_contentitem_tag_map`
--

CREATE TABLE `s04cf_contentitem_tag_map` (
  `type_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `core_content_id` int(10) UNSIGNED NOT NULL COMMENT 'PK from the core content table',
  `content_item_id` int(11) NOT NULL COMMENT 'PK from the content type table',
  `tag_id` int(10) UNSIGNED NOT NULL COMMENT 'PK from the tag table',
  `tag_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Date of most recent save for this tag-item',
  `type_id` mediumint(8) NOT NULL COMMENT 'PK from the content_type table'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Maps items from content tables to tags';

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_content_frontpage`
--

CREATE TABLE `s04cf_content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_content_rating`
--

CREATE TABLE `s04cf_content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `rating_count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lastip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_content_types`
--

CREATE TABLE `s04cf_content_types` (
  `type_id` int(10) UNSIGNED NOT NULL,
  `type_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `type_alias` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `table` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `rules` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_mappings` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `router` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content_history_options` varchar(5120) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'JSON string for com_contenthistory options'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_content_types`
--

INSERT INTO `s04cf_content_types` (`type_id`, `type_title`, `type_alias`, `table`, `rules`, `field_mappings`, `router`, `content_history_options`) VALUES
(1, 'Article', 'com_content.article', '{"special":{"dbtable":"#__content","key":"id","type":"Content","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"state","core_alias":"alias","core_created_time":"created","core_modified_time":"modified","core_body":"introtext", "core_hits":"hits","core_publish_up":"publish_up","core_publish_down":"publish_down","core_access":"access", "core_params":"attribs", "core_featured":"featured", "core_metadata":"metadata", "core_language":"language", "core_images":"images", "core_urls":"urls", "core_version":"version", "core_ordering":"ordering", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"catid", "core_xreference":"xreference", "asset_id":"asset_id"}, "special":{"fulltext":"fulltext"}}', 'ContentHelperRoute::getArticleRoute', '{"formFile":"administrator\\/components\\/com_content\\/models\\/forms\\/article.xml", "hideFields":["asset_id","checked_out","checked_out_time","version"],"ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time", "version", "hits"],"convertToInt":["publish_up", "publish_down", "featured", "ordering"],"displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"} ]}'),
(2, 'Weblink', 'com_weblinks.weblink', '{"special":{"dbtable":"#__weblinks","key":"id","type":"Weblink","prefix":"WeblinksTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"state","core_alias":"alias","core_created_time":"created","core_modified_time":"modified","core_body":"description", "core_hits":"hits","core_publish_up":"publish_up","core_publish_down":"publish_down","core_access":"access", "core_params":"params", "core_featured":"featured", "core_metadata":"metadata", "core_language":"language", "core_images":"images", "core_urls":"urls", "core_version":"version", "core_ordering":"ordering", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"catid", "core_xreference":"xreference", "asset_id":"null"}, "special":{}}', 'WeblinksHelperRoute::getWeblinkRoute', '{"formFile":"administrator\\/components\\/com_weblinks\\/models\\/forms\\/weblink.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","featured","images"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time", "version", "hits"], "convertToInt":["publish_up", "publish_down", "featured", "ordering"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"} ]}'),
(3, 'Contact', 'com_contact.contact', '{"special":{"dbtable":"#__contact_details","key":"id","type":"Contact","prefix":"ContactTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"name","core_state":"published","core_alias":"alias","core_created_time":"created","core_modified_time":"modified","core_body":"address", "core_hits":"hits","core_publish_up":"publish_up","core_publish_down":"publish_down","core_access":"access", "core_params":"params", "core_featured":"featured", "core_metadata":"metadata", "core_language":"language", "core_images":"image", "core_urls":"webpage", "core_version":"version", "core_ordering":"ordering", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"catid", "core_xreference":"xreference", "asset_id":"null"}, "special":{"con_position":"con_position","suburb":"suburb","state":"state","country":"country","postcode":"postcode","telephone":"telephone","fax":"fax","misc":"misc","email_to":"email_to","default_con":"default_con","user_id":"user_id","mobile":"mobile","sortname1":"sortname1","sortname2":"sortname2","sortname3":"sortname3"}}', 'ContactHelperRoute::getContactRoute', '{"formFile":"administrator\\/components\\/com_contact\\/models\\/forms\\/contact.xml","hideFields":["default_con","checked_out","checked_out_time","version","xreference"],"ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time", "version", "hits"],"convertToInt":["publish_up", "publish_down", "featured", "ordering"], "displayLookup":[ {"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"} ] }'),
(4, 'Newsfeed', 'com_newsfeeds.newsfeed', '{"special":{"dbtable":"#__newsfeeds","key":"id","type":"Newsfeed","prefix":"NewsfeedsTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"name","core_state":"published","core_alias":"alias","core_created_time":"created","core_modified_time":"modified","core_body":"description", "core_hits":"hits","core_publish_up":"publish_up","core_publish_down":"publish_down","core_access":"access", "core_params":"params", "core_featured":"featured", "core_metadata":"metadata", "core_language":"language", "core_images":"images", "core_urls":"link", "core_version":"version", "core_ordering":"ordering", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"catid", "core_xreference":"xreference", "asset_id":"null"}, "special":{"numarticles":"numarticles","cache_time":"cache_time","rtl":"rtl"}}', 'NewsfeedsHelperRoute::getNewsfeedRoute', '{"formFile":"administrator\\/components\\/com_newsfeeds\\/models\\/forms\\/newsfeed.xml","hideFields":["asset_id","checked_out","checked_out_time","version"],"ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time", "version", "hits"],"convertToInt":["publish_up", "publish_down", "featured", "ordering"],"displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"} ]}'),
(5, 'User', 'com_users.user', '{"special":{"dbtable":"#__users","key":"id","type":"User","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"name","core_state":"null","core_alias":"username","core_created_time":"registerdate","core_modified_time":"lastvisitDate","core_body":"null", "core_hits":"null","core_publish_up":"null","core_publish_down":"null","access":"null", "core_params":"params", "core_featured":"null", "core_metadata":"null", "core_language":"null", "core_images":"null", "core_urls":"null", "core_version":"null", "core_ordering":"null", "core_metakey":"null", "core_metadesc":"null", "core_catid":"null", "core_xreference":"null", "asset_id":"null"}, "special":{}}', 'UsersHelperRoute::getUserRoute', ''),
(6, 'Article Category', 'com_content.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', 'ContentHelperRoute::getCategoryRoute', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}'),
(7, 'Contact Category', 'com_contact.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', 'ContactHelperRoute::getCategoryRoute', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}'),
(8, 'Newsfeeds Category', 'com_newsfeeds.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', 'NewsfeedsHelperRoute::getCategoryRoute', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}'),
(9, 'Weblinks Category', 'com_weblinks.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', 'WeblinksHelperRoute::getCategoryRoute', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}'),
(10, 'Tag', 'com_tags.tag', '{"special":{"dbtable":"#__tags","key":"tag_id","type":"Tag","prefix":"TagsTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"featured", "core_metadata":"metadata", "core_language":"language", "core_images":"images", "core_urls":"urls", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"null", "core_xreference":"null", "asset_id":"null"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path"}}', 'TagsHelperRoute::getTagRoute', '{"formFile":"administrator\\/components\\/com_tags\\/models\\/forms\\/tag.xml", "hideFields":["checked_out","checked_out_time","version", "lft", "rgt", "level", "path", "urls", "publish_up", "publish_down"],"ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}, {"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"}, {"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}'),
(11, 'Banner', 'com_banners.banner', '{"special":{"dbtable":"#__banners","key":"id","type":"Banner","prefix":"BannersTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"name","core_state":"published","core_alias":"alias","core_created_time":"created","core_modified_time":"modified","core_body":"description", "core_hits":"null","core_publish_up":"publish_up","core_publish_down":"publish_down","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"images", "core_urls":"link", "core_version":"version", "core_ordering":"ordering", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"catid", "core_xreference":"null", "asset_id":"null"}, "special":{"imptotal":"imptotal", "impmade":"impmade", "clicks":"clicks", "clickurl":"clickurl", "custombannercode":"custombannercode", "cid":"cid", "purchase_type":"purchase_type", "track_impressions":"track_impressions", "track_clicks":"track_clicks"}}', '', '{"formFile":"administrator\\/components\\/com_banners\\/models\\/forms\\/banner.xml", "hideFields":["checked_out","checked_out_time","version", "reset"],"ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time", "version", "imptotal", "impmade", "reset"], "convertToInt":["publish_up", "publish_down", "ordering"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}, {"sourceColumn":"cid","targetTable":"#__banner_clients","targetColumn":"id","displayColumn":"name"}, {"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"} ]}'),
(12, 'Banners Category', 'com_banners.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special": {"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', '', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}'),
(13, 'Banner Client', 'com_banners.client', '{"special":{"dbtable":"#__banner_clients","key":"id","type":"Client","prefix":"BannersTable"}}', '', '', '', '{"formFile":"administrator\\/components\\/com_banners\\/models\\/forms\\/client.xml", "hideFields":["checked_out","checked_out_time"], "ignoreChanges":["checked_out", "checked_out_time"], "convertToInt":[], "displayLookup":[]}'),
(14, 'User Notes', 'com_users.note', '{"special":{"dbtable":"#__user_notes","key":"id","type":"Note","prefix":"UsersTable"}}', '', '', '', '{"formFile":"administrator\\/components\\/com_users\\/models\\/forms\\/note.xml", "hideFields":["checked_out","checked_out_time", "publish_up", "publish_down"],"ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"],"displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}, {"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}, {"sourceColumn":"user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}, {"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}'),
(15, 'User Notes Category', 'com_users.category', '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}', '', '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}', '', '{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", "hideFields":["checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}, {"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}');

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_core_log_searches`
--

CREATE TABLE `s04cf_core_log_searches` (
  `search_term` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_extensions`
--

CREATE TABLE `s04cf_extensions` (
  `extension_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `element` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folder` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` tinyint(3) NOT NULL,
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  `access` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `protected` tinyint(3) NOT NULL DEFAULT '0',
  `manifest_cache` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `params` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_data` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `system_data` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_extensions`
--

INSERT INTO `s04cf_extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(1, 'com_mailto', 'component', 'com_mailto', '', 0, 1, 1, 1, '{"name":"com_mailto","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_MAILTO_XML_DESCRIPTION","group":"","filename":"mailto"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(2, 'com_wrapper', 'component', 'com_wrapper', '', 0, 1, 1, 1, '{"name":"com_wrapper","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_WRAPPER_XML_DESCRIPTION","group":"","filename":"wrapper"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(3, 'com_admin', 'component', 'com_admin', '', 1, 1, 1, 1, '{"name":"com_admin","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_ADMIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(4, 'com_banners', 'component', 'com_banners', '', 1, 1, 1, 0, '{"name":"com_banners","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_BANNERS_XML_DESCRIPTION","group":"","filename":"banners"}', '{"purchase_type":"3","track_impressions":"0","track_clicks":"0","metakey_prefix":"","save_history":"1","history_limit":10}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(5, 'com_cache', 'component', 'com_cache', '', 1, 1, 1, 1, '{"name":"com_cache","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CACHE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(6, 'com_categories', 'component', 'com_categories', '', 1, 1, 1, 1, '{"name":"com_categories","type":"component","creationDate":"December 2007","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CATEGORIES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(7, 'com_checkin', 'component', 'com_checkin', '', 1, 1, 1, 1, '{"name":"com_checkin","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CHECKIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(8, 'com_contact', 'component', 'com_contact', '', 1, 1, 1, 0, '{"name":"com_contact","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CONTACT_XML_DESCRIPTION","group":"","filename":"contact"}', '{"show_contact_category":"hide","save_history":"1","history_limit":10,"show_contact_list":"0","presentation_style":"sliders","show_name":"1","show_position":"1","show_email":"0","show_street_address":"1","show_suburb":"1","show_state":"1","show_postcode":"1","show_country":"1","show_telephone":"1","show_mobile":"1","show_fax":"1","show_webpage":"1","show_misc":"1","show_image":"1","image":"","allow_vcard":"0","show_articles":"0","show_profile":"0","show_links":"0","linka_name":"","linkb_name":"","linkc_name":"","linkd_name":"","linke_name":"","contact_icons":"0","icon_address":"","icon_email":"","icon_telephone":"","icon_mobile":"","icon_fax":"","icon_misc":"","show_headings":"1","show_position_headings":"1","show_email_headings":"0","show_telephone_headings":"1","show_mobile_headings":"0","show_fax_headings":"0","allow_vcard_headings":"0","show_suburb_headings":"1","show_state_headings":"1","show_country_headings":"1","show_email_form":"1","show_email_copy":"1","banned_email":"","banned_subject":"","banned_text":"","validate_session":"1","custom_reply":"0","redirect":"","show_category_crumb":"0","metakey":"","metadesc":"","robots":"","author":"","rights":"","xreference":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(9, 'com_cpanel', 'component', 'com_cpanel', '', 1, 1, 1, 1, '{"name":"com_cpanel","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CPANEL_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10, 'com_installer', 'component', 'com_installer', '', 1, 1, 1, 1, '{"name":"com_installer","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_INSTALLER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(11, 'com_languages', 'component', 'com_languages', '', 1, 1, 1, 1, '{"name":"com_languages","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_LANGUAGES_XML_DESCRIPTION","group":""}', '{"administrator":"en-GB","site":"en-GB"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(12, 'com_login', 'component', 'com_login', '', 1, 1, 1, 1, '{"name":"com_login","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(13, 'com_media', 'component', 'com_media', '', 1, 1, 0, 1, '{"name":"com_media","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_MEDIA_XML_DESCRIPTION","group":"","filename":"media"}', '{"upload_extensions":"bmp,csv,doc,gif,ico,jpg,jpeg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,GIF,ICO,JPG,JPEG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS","upload_maxsize":"10","file_path":"images","image_path":"images","restrict_uploads":"1","allowed_media_usergroup":"3","check_mime":"1","image_extensions":"bmp,gif,jpg,png","ignore_extensions":"","upload_mime":"image\\/jpeg,image\\/gif,image\\/png,image\\/bmp,application\\/x-shockwave-flash,application\\/msword,application\\/excel,application\\/pdf,application\\/powerpoint,text\\/plain,application\\/x-zip","upload_mime_illegal":"text\\/html"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(14, 'com_menus', 'component', 'com_menus', '', 1, 1, 1, 1, '{"name":"com_menus","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_MENUS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(15, 'com_messages', 'component', 'com_messages', '', 1, 1, 1, 1, '{"name":"com_messages","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_MESSAGES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(16, 'com_modules', 'component', 'com_modules', '', 1, 1, 1, 1, '{"name":"com_modules","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_MODULES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(17, 'com_newsfeeds', 'component', 'com_newsfeeds', '', 1, 1, 1, 0, '{"name":"com_newsfeeds","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_NEWSFEEDS_XML_DESCRIPTION","group":"","filename":"newsfeeds"}', '{"newsfeed_layout":"_:default","save_history":"1","history_limit":5,"show_feed_image":"1","show_feed_description":"1","show_item_description":"1","feed_character_count":"0","feed_display_order":"des","float_first":"right","float_second":"right","show_tags":"1","category_layout":"_:default","show_category_title":"1","show_description":"1","show_description_image":"1","maxLevel":"-1","show_empty_categories":"0","show_subcat_desc":"1","show_cat_items":"1","show_cat_tags":"1","show_base_description":"1","maxLevelcat":"-1","show_empty_categories_cat":"0","show_subcat_desc_cat":"1","show_cat_items_cat":"1","filter_field":"1","show_pagination_limit":"1","show_headings":"1","show_articles":"0","show_link":"1","show_pagination":"1","show_pagination_results":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(18, 'com_plugins', 'component', 'com_plugins', '', 1, 1, 1, 1, '{"name":"com_plugins","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_PLUGINS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(19, 'com_search', 'component', 'com_search', '', 1, 1, 1, 0, '{"name":"com_search","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_SEARCH_XML_DESCRIPTION","group":"","filename":"search"}', '{"enabled":"0","show_date":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(20, 'com_templates', 'component', 'com_templates', '', 1, 1, 1, 1, '{"name":"com_templates","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_TEMPLATES_XML_DESCRIPTION","group":""}', '{"template_positions_display":"1","upload_limit":"2","image_formats":"gif,bmp,jpg,jpeg,png","source_formats":"txt,less,ini,xml,js,php,css","font_formats":"woff,ttf,otf","compressed_formats":"zip"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(21, 'com_weblinks', 'component', 'com_weblinks', '', 1, 1, 1, 0, '{"name":"com_weblinks","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_WEBLINKS_XML_DESCRIPTION","group":""}', '{"target":"0","save_history":"1","history_limit":5,"count_clicks":"1","icons":1,"link_icons":"","float_first":"right","float_second":"right","show_tags":"1","category_layout":"_:default","show_category_title":"1","show_description":"1","show_description_image":"1","maxLevel":"-1","show_empty_categories":"0","show_subcat_desc":"1","show_cat_num_links":"1","show_cat_tags":"1","show_base_description":"1","maxLevelcat":"-1","show_empty_categories_cat":"0","show_subcat_desc_cat":"1","show_cat_num_links_cat":"1","filter_field":"1","show_pagination_limit":"1","show_headings":"0","show_link_description":"1","show_link_hits":"1","show_pagination":"2","show_pagination_results":"1","show_feed_link":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(22, 'com_content', 'component', 'com_content', '', 1, 1, 0, 1, '{"name":"com_content","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CONTENT_XML_DESCRIPTION","group":"","filename":"content"}', '{"article_layout":"_:default","show_title":"0","link_titles":"0","show_intro":"0","info_block_position":"0","info_block_show_title":"1","show_category":"0","link_category":"0","show_parent_category":"0","link_parent_category":"0","show_author":"0","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_vote":"0","show_readmore":"0","show_readmore_title":"0","readmore_limit":"100","show_tags":"0","show_icons":"0","show_print_icon":"0","show_email_icon":"0","show_hits":"0","show_noauth":"0","urls_position":"0","show_publishing_options":"1","show_article_options":"1","save_history":"1","history_limit":10,"show_urls_images_frontend":"0","show_urls_images_backend":"1","targeta":0,"targetb":0,"targetc":0,"float_intro":"left","float_fulltext":"left","category_layout":"_:blog","show_category_heading_title_text":"1","show_category_title":"0","show_description":"0","show_description_image":"0","maxLevel":"1","show_empty_categories":"0","show_no_articles":"1","show_subcat_desc":"1","show_cat_num_articles":"0","show_cat_tags":"1","show_base_description":"1","maxLevelcat":"-1","show_empty_categories_cat":"0","show_subcat_desc_cat":"1","show_cat_num_articles_cat":"1","num_leading_articles":"1","num_intro_articles":"4","num_columns":"2","num_links":"4","multi_column_order":"0","show_subcategory_content":"0","show_pagination_limit":"1","filter_field":"hide","show_headings":"1","list_show_date":"0","date_format":"","list_show_hits":"1","list_show_author":"1","orderby_pri":"order","orderby_sec":"rdate","order_date":"published","show_pagination":"2","show_pagination_results":"1","show_featured":"show","show_feed_link":"1","feed_summary":"0","feed_show_readmore":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(23, 'com_config', 'component', 'com_config', '', 1, 1, 0, 1, '{"name":"com_config","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CONFIG_XML_DESCRIPTION","group":""}', '{"filters":{"1":{"filter_type":"NH","filter_tags":"","filter_attributes":""},"15":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"17":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"9":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"6":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"7":{"filter_type":"NONE","filter_tags":"","filter_attributes":""},"16":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"18":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"2":{"filter_type":"NH","filter_tags":"","filter_attributes":""},"61":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"58":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"54":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"3":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"4":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"5":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"52":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"57":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"26":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"28":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"27":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"24":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"23":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"29":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"31":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"32":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"30":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"35":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"53":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"11":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"55":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"46":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"10":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"56":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"48":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"50":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"49":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"59":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"60":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"14":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"41":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"37":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"42":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"43":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"40":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"45":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"39":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"33":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"38":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"19":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"20":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"21":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"22":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"51":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"44":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"47":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"8":{"filter_type":"NONE","filter_tags":"","filter_attributes":""}}}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(24, 'com_redirect', 'component', 'com_redirect', '', 1, 1, 0, 1, '{"name":"com_redirect","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_REDIRECT_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(25, 'com_users', 'component', 'com_users', '', 1, 1, 0, 1, '{"name":"com_users","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_USERS_XML_DESCRIPTION","group":"","filename":"users"}', '{"allowUserRegistration":"0","new_usertype":"2","guest_usergroup":"9","sendpassword":"1","useractivation":"2","mail_to_admin":"0","captcha":"","frontend_userparams":"1","site_language":"0","change_login_name":"0","reset_count":"10","reset_time":"1","minimum_length":"4","minimum_integers":"0","minimum_symbols":"0","minimum_uppercase":"0","save_history":"1","history_limit":5,"mailSubjectPrefix":"","mailBodySuffix":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(27, 'com_finder', 'component', 'com_finder', '', 1, 1, 0, 0, '{"name":"com_finder","type":"component","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_FINDER_XML_DESCRIPTION","group":"","filename":"finder"}', '{"show_description":"1","description_length":255,"allow_empty_query":"0","show_url":"1","show_advanced":"1","expand_advanced":"0","show_date_filters":"0","highlight_terms":"1","opensearch_name":"","opensearch_description":"","batch_size":"50","memory_table_limit":30000,"title_multiplier":"1.7","text_multiplier":"0.7","meta_multiplier":"1.2","path_multiplier":"2.0","misc_multiplier":"0.3","stemmer":"snowball"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(28, 'com_joomlaupdate', 'component', 'com_joomlaupdate', '', 1, 1, 0, 1, '{"name":"com_joomlaupdate","type":"component","creationDate":"February 2012","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.6.2","description":"COM_JOOMLAUPDATE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(29, 'com_tags', 'component', 'com_tags', '', 1, 1, 1, 1, '{"name":"com_tags","type":"component","creationDate":"December 2013","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.1.0","description":"COM_TAGS_XML_DESCRIPTION","group":"","filename":"tags"}', '{"tag_layout":"_:default","save_history":"1","history_limit":5,"show_tag_title":"0","tag_list_show_tag_image":"0","tag_list_show_tag_description":"0","tag_list_image":"","show_tag_num_items":"0","tag_list_orderby":"title","tag_list_orderby_direction":"ASC","show_headings":"0","tag_list_show_date":"0","tag_list_show_item_image":"0","tag_list_show_item_description":"0","tag_list_item_maximum_characters":0,"return_any_or_all":"1","include_children":"0","maximum":200,"tag_list_language_filter":"all","tags_layout":"_:default","all_tags_orderby":"title","all_tags_orderby_direction":"ASC","all_tags_show_tag_image":"0","all_tags_show_tag_descripion":"0","all_tags_tag_maximum_characters":20,"all_tags_show_tag_hits":"0","filter_field":"1","show_pagination_limit":"1","show_pagination":"2","show_pagination_results":"1","tag_field_ajax_mode":"1","show_feed_link":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(30, 'com_contenthistory', 'component', 'com_contenthistory', '', 1, 1, 1, 0, '{"name":"com_contenthistory","type":"component","creationDate":"May 2013","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.0","description":"COM_CONTENTHISTORY_XML_DESCRIPTION","group":"","filename":"contenthistory"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(31, 'com_ajax', 'component', 'com_ajax', '', 1, 1, 1, 1, '{"name":"com_ajax","type":"component","creationDate":"August 2013","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.0","description":"COM_AJAX_XML_DESCRIPTION","group":"","filename":"ajax"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(32, 'com_postinstall', 'component', 'com_postinstall', '', 1, 1, 1, 1, '{"name":"com_postinstall","type":"component","creationDate":"September 2013","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.0","description":"COM_POSTINSTALL_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(453, 'plg_editors-xtd_module', 'plugin', 'module', 'editors-xtd', 0, 1, 1, 0, '{"name":"plg_editors-xtd_module","type":"plugin","creationDate":"October 2015","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.5.0","description":"PLG_MODULE_XML_DESCRIPTION","group":"","filename":"module"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(452, 'plg_system_updatenotification', 'plugin', 'updatenotification', 'system', 0, 1, 1, 0, '{"name":"plg_system_updatenotification","type":"plugin","creationDate":"May 2015","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.5.0","description":"PLG_SYSTEM_UPDATENOTIFICATION_XML_DESCRIPTION","group":"","filename":"updatenotification"}', '{"lastrun":1516704890}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(454, 'plg_system_stats', 'plugin', 'stats', 'system', 0, 1, 1, 0, '{"name":"plg_system_stats","type":"plugin","creationDate":"November 2013","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.5.0","description":"PLG_SYSTEM_STATS_XML_DESCRIPTION","group":"","filename":"stats"}', '{"mode":3,"lastrun":"","unique_id":"2c8a8ecd3821fb5ed3b7bad55933d65517ace8b0","interval":12}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(802, 'English (en-GB) Language Pack', 'package', 'pkg_en-GB', '', 0, 1, 1, 1, '{"name":"English (en-GB) Language Pack","type":"package","creationDate":"December 2016","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.6.5.1","description":"en-GB language pack","group":"","filename":"pkg_en-GB"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(455, 'plg_installer_packageinstaller', 'plugin', 'packageinstaller', 'installer', 0, 1, 1, 1, '{"name":"plg_installer_packageinstaller","type":"plugin","creationDate":"May 2016","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.6.0","description":"PLG_INSTALLER_PACKAGEINSTALLER_PLUGIN_XML_DESCRIPTION","group":"","filename":"packageinstaller"}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(456, 'PLG_INSTALLER_FOLDERINSTALLER', 'plugin', 'folderinstaller', 'installer', 0, 1, 1, 1, '{"name":"PLG_INSTALLER_FOLDERINSTALLER","type":"plugin","creationDate":"May 2016","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.6.0","description":"PLG_INSTALLER_FOLDERINSTALLER_PLUGIN_XML_DESCRIPTION","group":"","filename":"folderinstaller"}', '', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(457, 'PLG_INSTALLER_URLINSTALLER', 'plugin', 'urlinstaller', 'installer', 0, 1, 1, 1, '{"name":"PLG_INSTALLER_URLINSTALLER","type":"plugin","creationDate":"May 2016","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.6.0","description":"PLG_INSTALLER_URLINSTALLER_PLUGIN_XML_DESCRIPTION","group":"","filename":"urlinstaller"}', '', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(102, 'LIB_PHPUTF8', 'library', 'phputf8', '', 0, 1, 1, 1, '{"name":"LIB_PHPUTF8","type":"library","creationDate":"2006","author":"Harry Fuecks","copyright":"Copyright various authors","authorEmail":"hfuecks@gmail.com","authorUrl":"http:\\/\\/sourceforge.net\\/projects\\/phputf8","version":"0.5","description":"LIB_PHPUTF8_XML_DESCRIPTION","group":"","filename":"phputf8"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(103, 'LIB_JOOMLA', 'library', 'joomla', '', 0, 1, 1, 1, '{"name":"LIB_JOOMLA","type":"library","creationDate":"2008","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"https:\\/\\/www.joomla.org","version":"13.1","description":"LIB_JOOMLA_XML_DESCRIPTION","group":"","filename":"joomla"}', '{"mediaversion":"b07291de63ef687ca68141dc4d7744f3"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(104, 'LIB_IDNA', 'library', 'idna_convert', '', 0, 1, 1, 1, '{"name":"LIB_IDNA","type":"library","creationDate":"2004","author":"phlyLabs","copyright":"2004-2011 phlyLabs Berlin, http:\\/\\/phlylabs.de","authorEmail":"phlymail@phlylabs.de","authorUrl":"http:\\/\\/phlylabs.de","version":"0.8.0","description":"LIB_IDNA_XML_DESCRIPTION","group":"","filename":"idna_convert"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(105, 'FOF', 'library', 'fof', '', 0, 1, 1, 1, '{"name":"FOF","type":"library","creationDate":"2015-04-22 13:15:32","author":"Nicholas K. Dionysopoulos \\/ Akeeba Ltd","copyright":"(C)2011-2015 Nicholas K. Dionysopoulos","authorEmail":"nicholas@akeebabackup.com","authorUrl":"https:\\/\\/www.akeebabackup.com","version":"2.4.3","description":"LIB_FOF_XML_DESCRIPTION","group":"","filename":"fof"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(106, 'LIB_PHPASS', 'library', 'phpass', '', 0, 1, 1, 1, '{"name":"LIB_PHPASS","type":"library","creationDate":"2004-2006","author":"Solar Designer","copyright":"","authorEmail":"solar@openwall.com","authorUrl":"http:\\/\\/www.openwall.com\\/phpass\\/","version":"0.3","description":"LIB_PHPASS_XML_DESCRIPTION","group":"","filename":"phpass"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(200, 'mod_articles_archive', 'module', 'mod_articles_archive', '', 0, 1, 1, 0, '{"name":"mod_articles_archive","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_ARTICLES_ARCHIVE_XML_DESCRIPTION","group":"","filename":"mod_articles_archive"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(201, 'mod_articles_latest', 'module', 'mod_articles_latest', '', 0, 1, 1, 0, '{"name":"mod_articles_latest","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_LATEST_NEWS_XML_DESCRIPTION","group":"","filename":"mod_articles_latest"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(202, 'mod_articles_popular', 'module', 'mod_articles_popular', '', 0, 1, 1, 0, '{"name":"mod_articles_popular","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_POPULAR_XML_DESCRIPTION","group":"","filename":"mod_articles_popular"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(203, 'mod_banners', 'module', 'mod_banners', '', 0, 1, 1, 0, '{"name":"mod_banners","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_BANNERS_XML_DESCRIPTION","group":"","filename":"mod_banners"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(204, 'mod_breadcrumbs', 'module', 'mod_breadcrumbs', '', 0, 1, 1, 1, '{"name":"mod_breadcrumbs","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_BREADCRUMBS_XML_DESCRIPTION","group":"","filename":"mod_breadcrumbs"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(205, 'mod_custom', 'module', 'mod_custom', '', 0, 1, 1, 1, '{"name":"mod_custom","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_CUSTOM_XML_DESCRIPTION","group":"","filename":"mod_custom"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(206, 'mod_feed', 'module', 'mod_feed', '', 0, 1, 1, 0, '{"name":"mod_feed","type":"module","creationDate":"July 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_FEED_XML_DESCRIPTION","group":"","filename":"mod_feed"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(207, 'mod_footer', 'module', 'mod_footer', '', 0, 1, 1, 0, '{"name":"mod_footer","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_FOOTER_XML_DESCRIPTION","group":"","filename":"mod_footer"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(208, 'mod_login', 'module', 'mod_login', '', 0, 1, 1, 1, '{"name":"mod_login","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_LOGIN_XML_DESCRIPTION","group":"","filename":"mod_login"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(209, 'mod_menu', 'module', 'mod_menu', '', 0, 1, 1, 1, '{"name":"mod_menu","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_MENU_XML_DESCRIPTION","group":"","filename":"mod_menu"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(210, 'mod_articles_news', 'module', 'mod_articles_news', '', 0, 1, 1, 0, '{"name":"mod_articles_news","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_ARTICLES_NEWS_XML_DESCRIPTION","group":"","filename":"mod_articles_news"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(211, 'mod_random_image', 'module', 'mod_random_image', '', 0, 1, 1, 0, '{"name":"mod_random_image","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_RANDOM_IMAGE_XML_DESCRIPTION","group":"","filename":"mod_random_image"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(212, 'mod_related_items', 'module', 'mod_related_items', '', 0, 1, 1, 0, '{"name":"mod_related_items","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_RELATED_XML_DESCRIPTION","group":"","filename":"mod_related_items"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(213, 'mod_search', 'module', 'mod_search', '', 0, 1, 1, 0, '{"name":"mod_search","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_SEARCH_XML_DESCRIPTION","group":"","filename":"mod_search"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(214, 'mod_stats', 'module', 'mod_stats', '', 0, 1, 1, 0, '{"name":"mod_stats","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_STATS_XML_DESCRIPTION","group":"","filename":"mod_stats"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(215, 'mod_syndicate', 'module', 'mod_syndicate', '', 0, 1, 1, 1, '{"name":"mod_syndicate","type":"module","creationDate":"May 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_SYNDICATE_XML_DESCRIPTION","group":"","filename":"mod_syndicate"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(216, 'mod_users_latest', 'module', 'mod_users_latest', '', 0, 1, 1, 0, '{"name":"mod_users_latest","type":"module","creationDate":"December 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_USERS_LATEST_XML_DESCRIPTION","group":"","filename":"mod_users_latest"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(217, 'mod_weblinks', 'module', 'mod_weblinks', '', 0, 1, 1, 0, '{"name":"mod_weblinks","type":"module","creationDate":"July 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_WEBLINKS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(218, 'mod_whosonline', 'module', 'mod_whosonline', '', 0, 1, 1, 0, '{"name":"mod_whosonline","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_WHOSONLINE_XML_DESCRIPTION","group":"","filename":"mod_whosonline"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(219, 'mod_wrapper', 'module', 'mod_wrapper', '', 0, 1, 1, 0, '{"name":"mod_wrapper","type":"module","creationDate":"October 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_WRAPPER_XML_DESCRIPTION","group":"","filename":"mod_wrapper"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(220, 'mod_articles_category', 'module', 'mod_articles_category', '', 0, 1, 1, 0, '{"name":"mod_articles_category","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_ARTICLES_CATEGORY_XML_DESCRIPTION","group":"","filename":"mod_articles_category"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(221, 'mod_articles_categories', 'module', 'mod_articles_categories', '', 0, 1, 1, 0, '{"name":"mod_articles_categories","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_ARTICLES_CATEGORIES_XML_DESCRIPTION","group":"","filename":"mod_articles_categories"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(222, 'mod_languages', 'module', 'mod_languages', '', 0, 1, 1, 1, '{"name":"mod_languages","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.5.0","description":"MOD_LANGUAGES_XML_DESCRIPTION","group":"","filename":"mod_languages"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(223, 'mod_finder', 'module', 'mod_finder', '', 0, 1, 0, 0, '{"name":"mod_finder","type":"module","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_FINDER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(300, 'mod_custom', 'module', 'mod_custom', '', 1, 1, 1, 1, '{"name":"mod_custom","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_CUSTOM_XML_DESCRIPTION","group":"","filename":"mod_custom"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(301, 'mod_feed', 'module', 'mod_feed', '', 1, 1, 1, 0, '{"name":"mod_feed","type":"module","creationDate":"July 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_FEED_XML_DESCRIPTION","group":"","filename":"mod_feed"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(302, 'mod_latest', 'module', 'mod_latest', '', 1, 1, 1, 0, '{"name":"mod_latest","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_LATEST_XML_DESCRIPTION","group":"","filename":"mod_latest"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(303, 'mod_logged', 'module', 'mod_logged', '', 1, 1, 1, 0, '{"name":"mod_logged","type":"module","creationDate":"January 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_LOGGED_XML_DESCRIPTION","group":"","filename":"mod_logged"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(304, 'mod_login', 'module', 'mod_login', '', 1, 1, 1, 1, '{"name":"mod_login","type":"module","creationDate":"March 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_LOGIN_XML_DESCRIPTION","group":"","filename":"mod_login"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(305, 'mod_menu', 'module', 'mod_menu', '', 1, 1, 1, 0, '{"name":"mod_menu","type":"module","creationDate":"March 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_MENU_XML_DESCRIPTION","group":"","filename":"mod_menu"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(307, 'mod_popular', 'module', 'mod_popular', '', 1, 1, 1, 0, '{"name":"mod_popular","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_POPULAR_XML_DESCRIPTION","group":"","filename":"mod_popular"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(308, 'mod_quickicon', 'module', 'mod_quickicon', '', 1, 1, 1, 1, '{"name":"mod_quickicon","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_QUICKICON_XML_DESCRIPTION","group":"","filename":"mod_quickicon"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(309, 'mod_status', 'module', 'mod_status', '', 1, 1, 1, 0, '{"name":"mod_status","type":"module","creationDate":"Feb 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_STATUS_XML_DESCRIPTION","group":"","filename":"mod_status"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(310, 'mod_submenu', 'module', 'mod_submenu', '', 1, 1, 1, 0, '{"name":"mod_submenu","type":"module","creationDate":"Feb 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_SUBMENU_XML_DESCRIPTION","group":"","filename":"mod_submenu"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(311, 'mod_title', 'module', 'mod_title', '', 1, 1, 1, 0, '{"name":"mod_title","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_TITLE_XML_DESCRIPTION","group":"","filename":"mod_title"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(312, 'mod_toolbar', 'module', 'mod_toolbar', '', 1, 1, 1, 1, '{"name":"mod_toolbar","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_TOOLBAR_XML_DESCRIPTION","group":"","filename":"mod_toolbar"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(313, 'mod_multilangstatus', 'module', 'mod_multilangstatus', '', 1, 1, 1, 0, '{"name":"mod_multilangstatus","type":"module","creationDate":"September 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_MULTILANGSTATUS_XML_DESCRIPTION","group":"","filename":"mod_multilangstatus"}', '{"cache":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(314, 'mod_version', 'module', 'mod_version', '', 1, 1, 1, 0, '{"name":"mod_version","type":"module","creationDate":"January 2012","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_VERSION_XML_DESCRIPTION","group":""}', '{"format":"short","product":"1","cache":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(315, 'mod_stats_admin', 'module', 'mod_stats_admin', '', 1, 1, 1, 0, '{"name":"mod_stats_admin","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"MOD_STATS_XML_DESCRIPTION","group":"","filename":"mod_stats_admin"}', '{"serverinfo":"0","siteinfo":"0","counter":"0","increase":"0","cache":"1","cache_time":"900","cachemode":"static"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(316, 'mod_tags_popular', 'module', 'mod_tags_popular', '', 0, 1, 1, 0, '{"name":"mod_tags_popular","type":"module","creationDate":"January 2013","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.1.0","description":"MOD_TAGS_POPULAR_XML_DESCRIPTION","group":"","filename":"mod_tags_popular"}', '{"maximum":"5","timeframe":"alltime","owncache":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(317, 'mod_tags_similar', 'module', 'mod_tags_similar', '', 0, 1, 1, 0, '{"name":"mod_tags_similar","type":"module","creationDate":"January 2013","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.1.0","description":"MOD_TAGS_SIMILAR_XML_DESCRIPTION","group":"","filename":"mod_tags_similar"}', '{"maximum":"5","matchtype":"any","owncache":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(400, 'plg_authentication_gmail', 'plugin', 'gmail', 'authentication', 0, 0, 1, 0, '{"name":"plg_authentication_gmail","type":"plugin","creationDate":"February 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_GMAIL_XML_DESCRIPTION","group":"","filename":"gmail"}', '{"applysuffix":"0","suffix":"","verifypeer":"1","user_blacklist":""}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(401, 'plg_authentication_joomla', 'plugin', 'joomla', 'authentication', 0, 1, 1, 1, '{"name":"plg_authentication_joomla","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_AUTH_JOOMLA_XML_DESCRIPTION","group":"","filename":"joomla"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `s04cf_extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(402, 'plg_authentication_ldap', 'plugin', 'ldap', 'authentication', 0, 0, 1, 0, '{"name":"plg_authentication_ldap","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_LDAP_XML_DESCRIPTION","group":"","filename":"ldap"}', '{"host":"localhost","port":"389","use_ldapV3":"1","negotiate_tls":"0","no_referrals":"0","auth_method":"search","base_dn":"dc=kiuskd,dc=com","search_string":"sAMAccountName=[search]","users_dn":"","username":"kiuskd\\\\guestsc1","password":"12345","ldap_fullname":"displayName","ldap_email":"mail","ldap_uid":"sAMAccountName"}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(403, 'plg_content_contact', 'plugin', 'contact', 'content', 0, 1, 1, 0, '{"name":"plg_content_contact","type":"plugin","creationDate":"January 2014","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.2","description":"PLG_CONTENT_CONTACT_XML_DESCRIPTION","group":"","filename":"contact"}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(404, 'plg_content_emailcloak', 'plugin', 'emailcloak', 'content', 0, 0, 1, 0, '{"name":"plg_content_emailcloak","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CONTENT_EMAILCLOAK_XML_DESCRIPTION","group":"","filename":"emailcloak"}', '{"mode":"1"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(406, 'plg_content_loadmodule', 'plugin', 'loadmodule', 'content', 0, 1, 1, 0, '{"name":"plg_content_loadmodule","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_LOADMODULE_XML_DESCRIPTION","group":"","filename":"loadmodule"}', '{"style":"xhtml"}', '', '', 0, '2011-09-18 15:22:50', 0, 0),
(407, 'plg_content_pagebreak', 'plugin', 'pagebreak', 'content', 0, 1, 1, 0, '{"name":"plg_content_pagebreak","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CONTENT_PAGEBREAK_XML_DESCRIPTION","group":"","filename":"pagebreak"}', '{"title":"1","multipage_toc":"1","showall":"1"}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(408, 'plg_content_pagenavigation', 'plugin', 'pagenavigation', 'content', 0, 1, 1, 0, '{"name":"plg_content_pagenavigation","type":"plugin","creationDate":"January 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_PAGENAVIGATION_XML_DESCRIPTION","group":"","filename":"pagenavigation"}', '{"position":"1"}', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(409, 'plg_content_vote', 'plugin', 'vote', 'content', 0, 1, 1, 0, '{"name":"plg_content_vote","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_VOTE_XML_DESCRIPTION","group":"","filename":"vote"}', '', '', '', 0, '0000-00-00 00:00:00', 6, 0),
(410, 'plg_editors_codemirror', 'plugin', 'codemirror', 'editors', 0, 1, 1, 1, '{"name":"plg_editors_codemirror","type":"plugin","creationDate":"28 March 2011","author":"Marijn Haverbeke","copyright":"Copyright (C) 2014 by Marijn Haverbeke <marijnh@gmail.com> and others","authorEmail":"marijnh@gmail.com","authorUrl":"http:\\/\\/codemirror.net\\/","version":"5.18.0","description":"PLG_CODEMIRROR_XML_DESCRIPTION","group":"","filename":"codemirror"}', '{"lineNumbers":"1","lineWrapping":"1","matchTags":"1","matchBrackets":"1","marker-gutter":"1","autoCloseTags":"1","autoCloseBrackets":"1","autoFocus":"1","theme":"default","tabmode":"indent"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(411, 'plg_editors_none', 'plugin', 'none', 'editors', 0, 1, 1, 1, '{"name":"plg_editors_none","type":"plugin","creationDate":"September 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_NONE_XML_DESCRIPTION","group":"","filename":"none"}', '', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(412, 'plg_editors_tinymce', 'plugin', 'tinymce', 'editors', 0, 1, 1, 0, '{"name":"plg_editors_tinymce","type":"plugin","creationDate":"2005-2016","author":"Ephox Corporation","copyright":"Ephox Corporation","authorEmail":"N\\/A","authorUrl":"http:\\/\\/www.tinymce.com","version":"4.4.3","description":"PLG_TINY_XML_DESCRIPTION","group":"","filename":"tinymce"}', '{"skin":"0","skin_admin":"0","mode":"1","mobile":"0","drag_drop":"1","path":"","entity_encoding":"raw","lang_mode":"1","lang_code":"en","text_direction":"ltr","content_css":"1","content_css_custom":"","relative_urls":"1","newlines":"0","use_config_textfilters":"0","invalid_elements":"script,applet,iframe","valid_elements":"","extended_elements":"","html_height":"550","html_width":"750","resizing":"1","resize_horizontal":"1","element_path":"1","fonts":"1","paste":"1","searchreplace":"1","insertdate":"1","colors":"1","table":"1","smilies":"1","hr":"1","link":"1","media":"1","print":"1","directionality":"1","fullscreen":"1","alignment":"1","visualchars":"1","visualblocks":"1","nonbreaking":"1","template":"1","blockquote":"1","wordcount":"1","image_advtab":"1","code_sample":"1","advlist":"1","autosave":"1","contextmenu":"1","inlinepopups":"1","custom_plugin":"","custom_button":""}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(413, 'plg_editors-xtd_article', 'plugin', 'article', 'editors-xtd', 0, 1, 1, 0, '{"name":"plg_editors-xtd_article","type":"plugin","creationDate":"October 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_ARTICLE_XML_DESCRIPTION","group":"","filename":"article"}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(414, 'plg_editors-xtd_image', 'plugin', 'image', 'editors-xtd', 0, 1, 1, 0, '{"name":"plg_editors-xtd_image","type":"plugin","creationDate":"August 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_IMAGE_XML_DESCRIPTION","group":"","filename":"image"}', '', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(415, 'plg_editors-xtd_pagebreak', 'plugin', 'pagebreak', 'editors-xtd', 0, 1, 1, 0, '{"name":"plg_editors-xtd_pagebreak","type":"plugin","creationDate":"August 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_EDITORSXTD_PAGEBREAK_XML_DESCRIPTION","group":"","filename":"pagebreak"}', '', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(416, 'plg_editors-xtd_readmore', 'plugin', 'readmore', 'editors-xtd', 0, 1, 1, 0, '{"name":"plg_editors-xtd_readmore","type":"plugin","creationDate":"March 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_READMORE_XML_DESCRIPTION","group":"","filename":"readmore"}', '', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(417, 'plg_search_categories', 'plugin', 'categories', 'search', 0, 1, 1, 0, '{"name":"plg_search_categories","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEARCH_CATEGORIES_XML_DESCRIPTION","group":"","filename":"categories"}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(418, 'plg_search_contacts', 'plugin', 'contacts', 'search', 0, 1, 1, 0, '{"name":"plg_search_contacts","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEARCH_CONTACTS_XML_DESCRIPTION","group":"","filename":"contacts"}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(419, 'plg_search_content', 'plugin', 'content', 'search', 0, 1, 1, 0, '{"name":"plg_search_content","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEARCH_CONTENT_XML_DESCRIPTION","group":"","filename":"content"}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(420, 'plg_search_newsfeeds', 'plugin', 'newsfeeds', 'search', 0, 1, 1, 0, '{"name":"plg_search_newsfeeds","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEARCH_NEWSFEEDS_XML_DESCRIPTION","group":"","filename":"newsfeeds"}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(421, 'plg_search_weblinks', 'plugin', 'weblinks', 'search', 0, 1, 1, 0, '{"name":"plg_search_weblinks","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEARCH_WEBLINKS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(422, 'plg_system_languagefilter', 'plugin', 'languagefilter', 'system', 0, 0, 1, 1, '{"name":"plg_system_languagefilter","type":"plugin","creationDate":"July 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SYSTEM_LANGUAGEFILTER_XML_DESCRIPTION","group":"","filename":"languagefilter"}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(423, 'plg_system_p3p', 'plugin', 'p3p', 'system', 0, 1, 1, 0, '{"name":"plg_system_p3p","type":"plugin","creationDate":"September 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_P3P_XML_DESCRIPTION","group":"","filename":"p3p"}', '{"headers":"NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM"}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(424, 'plg_system_cache', 'plugin', 'cache', 'system', 0, 0, 1, 1, '{"name":"plg_system_cache","type":"plugin","creationDate":"February 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CACHE_XML_DESCRIPTION","group":"","filename":"cache"}', '{"browsercache":"0","cachetime":"15"}', '', '', 0, '0000-00-00 00:00:00', 9, 0),
(425, 'plg_system_debug', 'plugin', 'debug', 'system', 0, 1, 1, 0, '{"name":"plg_system_debug","type":"plugin","creationDate":"December 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_DEBUG_XML_DESCRIPTION","group":"","filename":"debug"}', '{"profile":"1","queries":"1","memory":"1","language_files":"1","language_strings":"1","strip-first":"1","strip-prefix":"","strip-suffix":""}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(426, 'plg_system_log', 'plugin', 'log', 'system', 0, 1, 1, 1, '{"name":"plg_system_log","type":"plugin","creationDate":"April 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_LOG_XML_DESCRIPTION","group":"","filename":"log"}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(427, 'plg_system_redirect', 'plugin', 'redirect', 'system', 0, 0, 1, 1, '{"name":"plg_system_redirect","type":"plugin","creationDate":"April 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SYSTEM_REDIRECT_XML_DESCRIPTION","group":"","filename":"redirect"}', '', '', '', 0, '0000-00-00 00:00:00', 6, 0),
(428, 'plg_system_remember', 'plugin', 'remember', 'system', 0, 1, 1, 1, '{"name":"plg_system_remember","type":"plugin","creationDate":"April 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_REMEMBER_XML_DESCRIPTION","group":"","filename":"remember"}', '', '', '', 0, '0000-00-00 00:00:00', 7, 0),
(429, 'plg_system_sef', 'plugin', 'sef', 'system', 0, 1, 1, 0, '{"name":"plg_system_sef","type":"plugin","creationDate":"December 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEF_XML_DESCRIPTION","group":"","filename":"sef"}', '', '', '', 0, '0000-00-00 00:00:00', 8, 0),
(430, 'plg_system_logout', 'plugin', 'logout', 'system', 0, 1, 1, 1, '{"name":"plg_system_logout","type":"plugin","creationDate":"April 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SYSTEM_LOGOUT_XML_DESCRIPTION","group":"","filename":"logout"}', '', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(431, 'plg_user_contactcreator', 'plugin', 'contactcreator', 'user', 0, 0, 1, 0, '{"name":"plg_user_contactcreator","type":"plugin","creationDate":"August 2009","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CONTACTCREATOR_XML_DESCRIPTION","group":"","filename":"contactcreator"}', '{"autowebpage":"","category":"34","autopublish":"0"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(432, 'plg_user_joomla', 'plugin', 'joomla', 'user', 0, 1, 1, 0, '{"name":"plg_user_joomla","type":"plugin","creationDate":"December 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_USER_JOOMLA_XML_DESCRIPTION","group":"","filename":"joomla"}', '{"strong_passwords":"1","autoregister":"1"}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(433, 'plg_user_profile', 'plugin', 'profile', 'user', 0, 0, 1, 0, '{"name":"plg_user_profile","type":"plugin","creationDate":"January 2008","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_USER_PROFILE_XML_DESCRIPTION","group":"","filename":"profile"}', '{"register-require_address1":"1","register-require_address2":"1","register-require_city":"1","register-require_region":"1","register-require_country":"1","register-require_postal_code":"1","register-require_phone":"1","register-require_website":"1","register-require_favoritebook":"1","register-require_aboutme":"1","register-require_tos":"1","register-require_dob":"1","profile-require_address1":"1","profile-require_address2":"1","profile-require_city":"1","profile-require_region":"1","profile-require_country":"1","profile-require_postal_code":"1","profile-require_phone":"1","profile-require_website":"1","profile-require_favoritebook":"1","profile-require_aboutme":"1","profile-require_tos":"1","profile-require_dob":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(434, 'plg_extension_joomla', 'plugin', 'joomla', 'extension', 0, 1, 1, 1, '{"name":"plg_extension_joomla","type":"plugin","creationDate":"May 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_EXTENSION_JOOMLA_XML_DESCRIPTION","group":"","filename":"joomla"}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(435, 'plg_content_joomla', 'plugin', 'joomla', 'content', 0, 1, 1, 0, '{"name":"plg_content_joomla","type":"plugin","creationDate":"November 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CONTENT_JOOMLA_XML_DESCRIPTION","group":"","filename":"joomla"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(436, 'plg_system_languagecode', 'plugin', 'languagecode', 'system', 0, 0, 1, 0, '{"name":"plg_system_languagecode","type":"plugin","creationDate":"November 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SYSTEM_LANGUAGECODE_XML_DESCRIPTION","group":"","filename":"languagecode"}', '', '', '', 0, '0000-00-00 00:00:00', 10, 0),
(437, 'plg_quickicon_joomlaupdate', 'plugin', 'joomlaupdate', 'quickicon', 0, 1, 1, 1, '{"name":"plg_quickicon_joomlaupdate","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_QUICKICON_JOOMLAUPDATE_XML_DESCRIPTION","group":"","filename":"joomlaupdate"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(438, 'plg_quickicon_extensionupdate', 'plugin', 'extensionupdate', 'quickicon', 0, 1, 1, 1, '{"name":"plg_quickicon_extensionupdate","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_QUICKICON_EXTENSIONUPDATE_XML_DESCRIPTION","group":"","filename":"extensionupdate"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(439, 'plg_captcha_recaptcha', 'plugin', 'recaptcha', 'captcha', 0, 0, 1, 0, '{"name":"plg_captcha_recaptcha","type":"plugin","creationDate":"December 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.4.0","description":"PLG_CAPTCHA_RECAPTCHA_XML_DESCRIPTION","group":"","filename":"recaptcha"}', '{"public_key":"","private_key":"","theme":"clean"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(440, 'plg_system_highlight', 'plugin', 'highlight', 'system', 0, 1, 1, 0, '{"name":"plg_system_highlight","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SYSTEM_HIGHLIGHT_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 7, 0),
(441, 'plg_content_finder', 'plugin', 'finder', 'content', 0, 0, 1, 0, '{"name":"plg_content_finder","type":"plugin","creationDate":"December 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_CONTENT_FINDER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(442, 'plg_finder_categories', 'plugin', 'categories', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_categories","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_CATEGORIES_XML_DESCRIPTION","group":"","filename":"categories"}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(443, 'plg_finder_contacts', 'plugin', 'contacts', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_contacts","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_CONTACTS_XML_DESCRIPTION","group":"","filename":"contacts"}', '', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(444, 'plg_finder_content', 'plugin', 'content', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_content","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_CONTENT_XML_DESCRIPTION","group":"","filename":"content"}', '', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(445, 'plg_finder_newsfeeds', 'plugin', 'newsfeeds', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_newsfeeds","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_NEWSFEEDS_XML_DESCRIPTION","group":"","filename":"newsfeeds"}', '', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(446, 'plg_finder_weblinks', 'plugin', 'weblinks', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_weblinks","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_WEBLINKS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(447, 'plg_finder_tags', 'plugin', 'tags', 'finder', 0, 1, 1, 0, '{"name":"plg_finder_tags","type":"plugin","creationDate":"February 2013","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_FINDER_TAGS_XML_DESCRIPTION","group":"","filename":"tags"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(448, 'plg_twofactorauth_totp', 'plugin', 'totp', 'twofactorauth', 0, 0, 1, 0, '{"name":"plg_twofactorauth_totp","type":"plugin","creationDate":"August 2013","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.0","description":"PLG_TWOFACTORAUTH_TOTP_XML_DESCRIPTION","group":"","filename":"totp"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(449, 'plg_authentication_cookie', 'plugin', 'cookie', 'authentication', 0, 1, 1, 0, '{"name":"plg_authentication_cookie","type":"plugin","creationDate":"July 2013","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_AUTH_COOKIE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(450, 'plg_twofactorauth_yubikey', 'plugin', 'yubikey', 'twofactorauth', 0, 0, 1, 0, '{"name":"plg_twofactorauth_yubikey","type":"plugin","creationDate":"September 2013","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.2.0","description":"PLG_TWOFACTORAUTH_YUBIKEY_XML_DESCRIPTION","group":"","filename":"yubikey"}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(451, 'plg_search_tags', 'plugin', 'tags', 'search', 0, 1, 1, 0, '{"name":"plg_search_tags","type":"plugin","creationDate":"March 2014","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"PLG_SEARCH_TAGS_XML_DESCRIPTION","group":"","filename":"tags"}', '{"search_limit":"50","show_tagged_items":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(503, 'beez3', 'template', 'beez3', '', 0, 1, 1, 0, '{"name":"beez3","type":"template","creationDate":"25 November 2009","author":"Angie Radtke","copyright":"Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.","authorEmail":"a.radtke@derauftritt.de","authorUrl":"http:\\/\\/www.der-auftritt.de","version":"3.1.0","description":"TPL_BEEZ3_XML_DESCRIPTION","group":"","filename":"templateDetails"}', '{"wrapperSmall":"53","wrapperLarge":"72","sitetitle":"","sitedescription":"","navposition":"center","templatecolor":"nature"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(504, 'hathor', 'template', 'hathor', '', 1, 1, 1, 0, '{"name":"hathor","type":"template","creationDate":"May 2010","author":"Andrea Tarr","copyright":"Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"","version":"3.0.0","description":"TPL_HATHOR_XML_DESCRIPTION","group":"","filename":"templateDetails"}', '{"showSiteName":"0","colourChoice":"0","boldText":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(506, 'protostar', 'template', 'protostar', '', 0, 1, 1, 0, '{"name":"protostar","type":"template","creationDate":"4\\/30\\/2012","author":"Kyle Ledbetter","copyright":"Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"","version":"1.0","description":"TPL_PROTOSTAR_XML_DESCRIPTION","group":"","filename":"templateDetails"}', '{"templateColor":"","logoFile":"","googleFont":"1","googleFontName":"Open+Sans","fluidContainer":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(507, 'isis', 'template', 'isis', '', 1, 1, 1, 0, '{"name":"isis","type":"template","creationDate":"3\\/30\\/2012","author":"Kyle Ledbetter","copyright":"Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"","version":"1.0","description":"TPL_ISIS_XML_DESCRIPTION","group":"","filename":"templateDetails"}', '{"templateColor":"","logoFile":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(600, 'English (en-GB)', 'language', 'en-GB', '', 0, 1, 1, 1, '{"name":"English (en-GB)","type":"language","creationDate":"December 2016","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.6.5","description":"en-GB site language","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(601, 'English (en-GB)', 'language', 'en-GB', '', 1, 1, 1, 1, '{"name":"English (en-GB)","type":"language","creationDate":"December 2016","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.6.5","description":"en-GB administrator language","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(700, 'files_joomla', 'file', 'joomla', '', 0, 1, 1, 1, '{"name":"files_joomla","type":"file","creationDate":"December 2016","author":"Joomla! Project","copyright":"(C) 2005 - 2016 Open Source Matters. All rights reserved","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.6.5","description":"FILES_JOOMLA_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10000, 'PLG_SYSTEM_NNFRAMEWORK', 'plugin', 'nnframework', 'system', 0, 1, 1, 0, '{"name":"PLG_SYSTEM_NNFRAMEWORK","type":"plugin","creationDate":"January 2015","author":"NoNumber (Peter van Westen)","copyright":"Copyright \\u00a9 2015 NoNumber All Rights Reserved","authorEmail":"peter@nonumber.nl","authorUrl":"http:\\/\\/www.nonumber.nl","version":"15.1.1","description":"PLG_SYSTEM_NNFRAMEWORK_DESC","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10001, 'PLG_SYSTEM_SOURCERER', 'plugin', 'sourcerer', 'system', 0, 1, 1, 0, '{"name":"PLG_SYSTEM_SOURCERER","type":"plugin","creationDate":"January 2015","author":"NoNumber (Peter van Westen)","copyright":"Copyright \\u00a9 2015 NoNumber All Rights Reserved","authorEmail":"peter@nonumber.nl","authorUrl":"http:\\/\\/www.nonumber.nl","version":"4.4.8FREE","description":"PLG_SYSTEM_SOURCERER_DESC","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10002, 'PLG_EDITORS-XTD_SOURCERER', 'plugin', 'sourcerer', 'editors-xtd', 0, 1, 1, 0, '{"name":"PLG_EDITORS-XTD_SOURCERER","type":"plugin","creationDate":"January 2015","author":"NoNumber (Peter van Westen)","copyright":"Copyright \\u00a9 2015 NoNumber All Rights Reserved","authorEmail":"peter@nonumber.nl","authorUrl":"http:\\/\\/www.nonumber.nl","version":"4.4.8FREE","description":"PLG_EDITORS-XTD_SOURCERER_DESC","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10003, 'T3 Framework', 'plugin', 't3', 'system', 0, 1, 1, 0, '{"name":"T3 Framework","type":"plugin","creationDate":"July 01, 2015","author":"JoomlArt.com","copyright":"Copyright (C) 2005 - 2015 Open Source Matters. All rights reserved.","authorEmail":"info@joomlart.com","authorUrl":"http:\\/\\/www.t3-framework.org","version":"2.4.9","description":"\\n\\t\\n\\t<div align=\\"center\\">\\n\\t\\t<div class=\\"alert alert-success\\" style=\\"background-color:#DFF0D8;border-color:#D6E9C6;color: #468847;padding: 1px 0;\\">\\n\\t\\t\\t\\t<a href=\\"http:\\/\\/t3-framework.org\\/\\"><img src=\\"http:\\/\\/joomlart.s3.amazonaws.com\\/images\\/jat3v3-documents\\/message-installation\\/logo.png\\" alt=\\"some_text\\" width=\\"300\\" height=\\"99\\"><\\/a>\\n\\t\\t\\t\\t<h4><a href=\\"http:\\/\\/t3-framework.org\\/\\" title=\\"\\">Home<\\/a> | <a href=\\"http:\\/\\/demo.t3-framework.org\\/\\" title=\\"\\">Demo<\\/a> | <a href=\\"http:\\/\\/t3-framework.org\\/documentation\\" title=\\"\\">Document<\\/a> | <a href=\\"https:\\/\\/github.com\\/t3framework\\/t3\\/blob\\/master\\/CHANGELOG.md\\" title=\\"\\">Changelog<\\/a><\\/h4>\\n\\t\\t<p> <\\/p>\\n\\t\\t<p>Copyright 2004 - 2015 <a href=''http:\\/\\/www.joomlart.com\\/'' title=''Visit Joomlart.com!''>JoomlArt.com<\\/a>.<\\/p>\\n\\t\\t<\\/div>\\n     <style>table.adminform{width: 100%;}<\\/style>\\n\\t <\\/div>\\n\\t\\t\\n\\t","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10004, 'purity_III', 'template', 'purity_iii', '', 0, 1, 1, 0, '{"name":"purity_III","type":"template","creationDate":"July 2015","author":"JoomlArt.com","copyright":"Copyright (C), J.O.O.M Solutions Co., Ltd. All Rights Reserved.","authorEmail":"webmaster@joomlart.com","authorUrl":"http:\\/\\/www.t3-framework.org","version":"1.1.5","description":"\\n\\t\\t\\n\\t\\t<div align=\\"center\\">\\n\\t\\t\\t<div class=\\"alert alert-success\\" style=\\"background-color:#DFF0D8;border-color:#D6E9C6;color: #468847;padding: 1px 0;\\">\\n\\t\\t\\t\\t<h2>Purity III Template references<\\/h2>\\n\\t\\t\\t\\t<h4><a href=\\"http:\\/\\/joomla-templates.joomlart.com\\/purity_iii\\/\\" title=\\"Purity III Template demo\\">Live Demo<\\/a> | <a href=\\"http:\\/\\/www.joomlart.com\\/documentation\\/joomla-templates\\/purity-iii\\" title=\\"purity iii template documentation\\">Documentation<\\/a> | <a href=\\"http:\\/\\/www.joomlart.com\\/forums\\/forumdisplay.php?542-Purity-III\\" title=\\"purity iii forum\\">Forum<\\/a> | <a href=\\"http:\\/\\/www.joomlart.com\\/joomla\\/templates\\/purity-iii\\" title=\\"Purity III template more info\\">More Info<\\/a><\\/h4>\\n\\t\\t\\t\\t<p> <\\/p>\\n\\t\\t\\t\\t<span style=\\"color:#FF0000\\">Note: Purity III requires T3 plugin to be installed and enabled.<\\/span>\\n\\t\\t\\t\\t<p> <\\/p>\\n\\t\\t\\t\\t<p>Copyright 2004 - 2015 <a href=''http:\\/\\/www.joomlart.com\\/'' title=''Visit Joomlart.com!''>JoomlArt.com<\\/a>.<\\/p>\\n\\t\\t\\t<\\/div>\\n\\t\\t\\t<style>table.adminform{width: 100%;}<\\/style>\\n\\t\\t<\\/div>\\n\\t\\t\\n\\t","group":""}', '{"tpl_article_info_datetime_format":"d M Y"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10005, 'Menu Accordeon CK', 'module', 'mod_accordeonck', '', 0, 1, 0, 0, '{"name":"Menu Accordeon CK","type":"module","creationDate":"octobre 2011","author":"C\\u00e9dric KEIFLIN","copyright":"C\\u00e9dric KEIFLIN","authorEmail":"ced1870@gmail.com","authorUrl":"http:\\/\\/www.joomlack.fr","version":"2.0.19","description":"MOD_ACCORDEONCK_DESC","group":""}', '{"startLevel":"1","endLevel":"0","imgalignement":"none","imagerollprefix":"_hover","imageactiveprefix":"_active","cache":"1","cache_time":"900","cachemode":"itemid","eventtype":"click","eventtarget":"link","fadetransition":"false","mooduration":"500","mootransition":"linear","defaultopenedid":"","activeeffect":"0","usestyles":"1","theme":"simple","useplusminusimages":"1","imageplus":"modules\\/mod_accordeonck\\/assets\\/plus.png","imageminus":"modules\\/mod_accordeonck\\/assets\\/minus.png","imageposition":"right","menuusemargin":"1","menumargin":"0","menupadding":"5","menuusebackground":"1","menubgcolor1":"#f0f0f0","menuusegradient":"1","menubgcolor2":"#e3e3e3","menuuseroundedcorners":"1","menuroundedcornerstl":"5","menuroundedcornerstr":"5","menuroundedcornersbr":"5","menuroundedcornersbl":"5","menuuseshadow":"1","menushadowcolor":"#444444","menushadowblur":"3","menushadowspread":"0","menushadowoffsetx":"0","menushadowoffsety":"0","menushadowinset":"0","menuuseborders":"1","menubordercolor":"#efefef","menuborderwidth":"1","level1linkusefont":"1","level1linkfontsize":"12px","level1linkfontcolor":"","level1linkfontcolorhover":"","level1linkdescfontsize":"10px","level1linkdescfontcolor":"","level1linkusemargin":"1","level1linkmargin":"0","level1linkpadding":"0","level1linkusebackground":"1","level1linkbgcolor1":"","level1linkusegradient":"1","level1linkbgcolor2":"","level1linkuseroundedcorners":"1","level1linkroundedcornerstl":"0","level1linkroundedcornerstr":"0","level1linkroundedcornersbr":"0","level1linkroundedcornersbl":"0","level1linkuseshadow":"1","level1linkshadowcolor":"","level1linkshadowblur":"0","level1linkshadowspread":"0","level1linkshadowoffsetx":"0","level1linkshadowoffsety":"0","level1linkshadowinset":"0","level1linkuseborders":"1","level1linkbordercolor":"","level1linkborderwidth":"1","level2linkusefont":"1","level2linkfontsize":"12px","level2linkfontcolor":"","level2linkfontcolorhover":"","level2linkdescfontsize":"10px","level2linkdescfontcolor":"","level2linkusemargin":"1","level2linkmargin":"0","level2linkpadding":"0","level2linkusebackground":"1","level2linkbgcolor1":"","level2linkusegradient":"1","level2linkbgcolor2":"","level2linkuseroundedcorners":"1","level2linkroundedcornerstl":"0","level2linkroundedcornerstr":"0","level2linkroundedcornersbr":"0","level2linkroundedcornersbl":"0","level2linkuseshadow":"1","level2linkshadowcolor":"","level2linkshadowblur":"0","level2linkshadowspread":"0","level2linkshadowoffsetx":"0","level2linkshadowoffsety":"0","level2linkshadowinset":"0","level2linkuseborders":"1","level2linkbordercolor":"","level2linkborderwidth":"1","level3linkusefont":"1","level3linkfontsize":"12px","level3linkfontcolor":"","level3linkfontcolorhover":"","level3linkdescfontsize":"10px","level3linkdescfontcolor":"","level3linkusemargin":"1","level3linkmargin":"0","level3linkpadding":"0","level3linkusebackground":"1","level3linkbgcolor1":"","level3linkusegradient":"1","level3linkbgcolor2":"","level3linkuseroundedcorners":"1","level3linkroundedcornerstl":"0","level3linkroundedcornerstr":"0","level3linkroundedcornersbr":"0","level3linkroundedcornersbl":"0","level3linkuseshadow":"1","level3linkshadowcolor":"","level3linkshadowblur":"0","level3linkshadowspread":"0","level3linkshadowoffsetx":"0","level3linkshadowoffsety":"0","level3linkshadowinset":"0","level3linkuseborders":"1","level3linkbordercolor":"","level3linkborderwidth":"1","thirdparty":"none","hikashopitemid":"0","usehikashopimages":"0","usehikashopsuffix":"0","hikashopimagesuffix":"_mini","hikashopcategoryroot":"0","hikashopcategorydepth":"0","usevmimages":"0","usevmsuffix":"0","vmimagesuffix":"_mini","vmcategoryroot":"0","vmcategorydepth":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(801, 'weblinks', 'package', 'pkg_weblinks', '', 0, 1, 1, 0, '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_filters`
--

CREATE TABLE `s04cf_finder_filters` (
  `filter_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_by_alias` varchar(255) NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `map_count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` mediumtext NOT NULL,
  `params` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_links`
--

CREATE TABLE `s04cf_finder_links` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `title` varchar(400) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `indexdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `md5sum` varchar(32) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `state` int(5) DEFAULT '1',
  `access` int(5) DEFAULT '0',
  `language` varchar(8) NOT NULL,
  `publish_start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `list_price` double UNSIGNED NOT NULL DEFAULT '0',
  `sale_price` double UNSIGNED NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL,
  `object` mediumblob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_links_terms0`
--

CREATE TABLE `s04cf_finder_links_terms0` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_links_terms1`
--

CREATE TABLE `s04cf_finder_links_terms1` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_links_terms2`
--

CREATE TABLE `s04cf_finder_links_terms2` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_links_terms3`
--

CREATE TABLE `s04cf_finder_links_terms3` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_links_terms4`
--

CREATE TABLE `s04cf_finder_links_terms4` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_links_terms5`
--

CREATE TABLE `s04cf_finder_links_terms5` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_links_terms6`
--

CREATE TABLE `s04cf_finder_links_terms6` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_links_terms7`
--

CREATE TABLE `s04cf_finder_links_terms7` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_links_terms8`
--

CREATE TABLE `s04cf_finder_links_terms8` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_links_terms9`
--

CREATE TABLE `s04cf_finder_links_terms9` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_links_termsa`
--

CREATE TABLE `s04cf_finder_links_termsa` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_links_termsb`
--

CREATE TABLE `s04cf_finder_links_termsb` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_links_termsc`
--

CREATE TABLE `s04cf_finder_links_termsc` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_links_termsd`
--

CREATE TABLE `s04cf_finder_links_termsd` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_links_termse`
--

CREATE TABLE `s04cf_finder_links_termse` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_links_termsf`
--

CREATE TABLE `s04cf_finder_links_termsf` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `weight` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_taxonomy`
--

CREATE TABLE `s04cf_finder_taxonomy` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `state` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `access` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ordering` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `s04cf_finder_taxonomy`
--

INSERT INTO `s04cf_finder_taxonomy` (`id`, `parent_id`, `title`, `state`, `access`, `ordering`) VALUES
(1, 0, 'ROOT', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_taxonomy_map`
--

CREATE TABLE `s04cf_finder_taxonomy_map` (
  `link_id` int(10) UNSIGNED NOT NULL,
  `node_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_terms`
--

CREATE TABLE `s04cf_finder_terms` (
  `term_id` int(10) UNSIGNED NOT NULL,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `phrase` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `weight` float UNSIGNED NOT NULL DEFAULT '0',
  `soundex` varchar(75) NOT NULL,
  `links` int(10) NOT NULL DEFAULT '0',
  `language` char(3) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_terms_common`
--

CREATE TABLE `s04cf_finder_terms_common` (
  `term` varchar(75) NOT NULL,
  `language` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `s04cf_finder_terms_common`
--

INSERT INTO `s04cf_finder_terms_common` (`term`, `language`) VALUES
('a', 'en'),
('about', 'en'),
('after', 'en'),
('ago', 'en'),
('all', 'en'),
('am', 'en'),
('an', 'en'),
('and', 'en'),
('ani', 'en'),
('any', 'en'),
('are', 'en'),
('aren''t', 'en'),
('as', 'en'),
('at', 'en'),
('be', 'en'),
('but', 'en'),
('by', 'en'),
('for', 'en'),
('from', 'en'),
('get', 'en'),
('go', 'en'),
('how', 'en'),
('if', 'en'),
('in', 'en'),
('into', 'en'),
('is', 'en'),
('isn''t', 'en'),
('it', 'en'),
('its', 'en'),
('me', 'en'),
('more', 'en'),
('most', 'en'),
('must', 'en'),
('my', 'en'),
('new', 'en'),
('no', 'en'),
('none', 'en'),
('not', 'en'),
('noth', 'en'),
('nothing', 'en'),
('of', 'en'),
('off', 'en'),
('often', 'en'),
('old', 'en'),
('on', 'en'),
('onc', 'en'),
('once', 'en'),
('onli', 'en'),
('only', 'en'),
('or', 'en'),
('other', 'en'),
('our', 'en'),
('ours', 'en'),
('out', 'en'),
('over', 'en'),
('page', 'en'),
('she', 'en'),
('should', 'en'),
('small', 'en'),
('so', 'en'),
('some', 'en'),
('than', 'en'),
('thank', 'en'),
('that', 'en'),
('the', 'en'),
('their', 'en'),
('theirs', 'en'),
('them', 'en'),
('then', 'en'),
('there', 'en'),
('these', 'en'),
('they', 'en'),
('this', 'en'),
('those', 'en'),
('thus', 'en'),
('time', 'en'),
('times', 'en'),
('to', 'en'),
('too', 'en'),
('true', 'en'),
('under', 'en'),
('until', 'en'),
('up', 'en'),
('upon', 'en'),
('use', 'en'),
('user', 'en'),
('users', 'en'),
('veri', 'en'),
('version', 'en'),
('very', 'en'),
('via', 'en'),
('want', 'en'),
('was', 'en'),
('way', 'en'),
('were', 'en'),
('what', 'en'),
('when', 'en'),
('where', 'en'),
('whi', 'en'),
('which', 'en'),
('who', 'en'),
('whom', 'en'),
('whose', 'en'),
('why', 'en'),
('wide', 'en'),
('will', 'en'),
('with', 'en'),
('within', 'en'),
('without', 'en'),
('would', 'en'),
('yes', 'en'),
('yet', 'en'),
('you', 'en'),
('your', 'en'),
('yours', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_tokens`
--

CREATE TABLE `s04cf_finder_tokens` (
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `phrase` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `weight` float UNSIGNED NOT NULL DEFAULT '1',
  `context` tinyint(1) UNSIGNED NOT NULL DEFAULT '2',
  `language` char(3) NOT NULL DEFAULT ''
) ENGINE=MEMORY DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_tokens_aggregate`
--

CREATE TABLE `s04cf_finder_tokens_aggregate` (
  `term_id` int(10) UNSIGNED NOT NULL,
  `map_suffix` char(1) NOT NULL,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `phrase` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `term_weight` float UNSIGNED NOT NULL,
  `context` tinyint(1) UNSIGNED NOT NULL DEFAULT '2',
  `context_weight` float UNSIGNED NOT NULL,
  `total_weight` float UNSIGNED NOT NULL,
  `language` char(3) NOT NULL DEFAULT ''
) ENGINE=MEMORY DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_finder_types`
--

CREATE TABLE `s04cf_finder_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `mime` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_languages`
--

CREATE TABLE `s04cf_languages` (
  `lang_id` int(11) UNSIGNED NOT NULL,
  `asset_id` int(11) NOT NULL,
  `lang_code` char(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_native` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sef` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metakey` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadesc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sitename` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `published` int(11) NOT NULL DEFAULT '0',
  `access` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_languages`
--

INSERT INTO `s04cf_languages` (`lang_id`, `asset_id`, `lang_code`, `title`, `title_native`, `sef`, `image`, `description`, `metakey`, `metadesc`, `sitename`, `published`, `access`, `ordering`) VALUES
(1, 0, 'en-GB', 'English (UK)', 'English (UK)', 'en', 'en', '', '', '', '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_menu`
--

CREATE TABLE `s04cf_menu` (
  `id` int(11) NOT NULL,
  `menutype` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The type of menu this item belongs to. FK to #__menu_types.menutype',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The display title of the menu item.',
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'The SEF alias of the menu item.',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `path` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The computed path of the menu item based on the alias field.',
  `link` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The actually link the menu item refers to.',
  `type` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The type of link: Component, URL, Alias, Separator',
  `published` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The published state of the menu link.',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'The parent menu item in the menu tree.',
  `level` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'The relative level in the tree.',
  `component_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'FK to #__extensions.id',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'FK to #__users.id',
  `checked_out_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'The time the menu item was checked out.',
  `browserNav` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The click behaviour of the link.',
  `access` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'The access level required to view the menu item.',
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The image of the menu item.',
  `template_style_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `params` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'JSON encoded data for the menu item.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `home` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Indicates if this menu item is the home or default page.',
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `client_id` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_menu`
--

INSERT INTO `s04cf_menu` (`id`, `menutype`, `title`, `alias`, `note`, `path`, `link`, `type`, `published`, `parent_id`, `level`, `component_id`, `checked_out`, `checked_out_time`, `browserNav`, `access`, `img`, `template_style_id`, `params`, `lft`, `rgt`, `home`, `language`, `client_id`) VALUES
(1, '', 'Menu_Item_Root', 'root', '', '', '', '', 1, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 0, '', 0, '', 0, 471, 0, '*', 0),
(2, 'menu', 'com_banners', 'Banners', '', 'Banners', 'index.php?option=com_banners', 'component', 0, 1, 1, 4, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners', 0, '', 1, 10, 0, '*', 1),
(3, 'menu', 'com_banners', 'Banners', '', 'Banners/Banners', 'index.php?option=com_banners', 'component', 0, 2, 2, 4, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners', 0, '', 2, 3, 0, '*', 1),
(4, 'menu', 'com_banners_categories', 'Categories', '', 'Banners/Categories', 'index.php?option=com_categories&extension=com_banners', 'component', 0, 2, 2, 6, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-cat', 0, '', 4, 5, 0, '*', 1),
(5, 'menu', 'com_banners_clients', 'Clients', '', 'Banners/Clients', 'index.php?option=com_banners&view=clients', 'component', 0, 2, 2, 4, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-clients', 0, '', 6, 7, 0, '*', 1),
(6, 'menu', 'com_banners_tracks', 'Tracks', '', 'Banners/Tracks', 'index.php?option=com_banners&view=tracks', 'component', 0, 2, 2, 4, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-tracks', 0, '', 8, 9, 0, '*', 1),
(7, 'menu', 'com_contact', 'Contacts', '', 'Contacts', 'index.php?option=com_contact', 'component', 0, 1, 1, 8, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact', 0, '', 279, 284, 0, '*', 1),
(8, 'menu', 'com_contact_contacts', 'Contacts', '', 'Contacts/Contacts', 'index.php?option=com_contact', 'component', 0, 7, 2, 8, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact', 0, '', 280, 281, 0, '*', 1),
(9, 'menu', 'com_contact_categories', 'Categories', '', 'Contacts/Categories', 'index.php?option=com_categories&extension=com_contact', 'component', 0, 7, 2, 6, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact-cat', 0, '', 282, 283, 0, '*', 1),
(10, 'menu', 'com_messages', 'Messaging', '', 'Messaging', 'index.php?option=com_messages', 'component', 0, 1, 1, 15, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages', 0, '', 285, 288, 0, '*', 1),
(11, 'menu', 'com_messages_add', 'New Private Message', '', 'Messaging/New Private Message', 'index.php?option=com_messages&task=message.add', 'component', 0, 10, 2, 15, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages-add', 0, '', 286, 287, 0, '*', 1),
(13, 'menu', 'com_newsfeeds', 'News Feeds', '', 'News Feeds', 'index.php?option=com_newsfeeds', 'component', 0, 1, 1, 17, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds', 0, '', 289, 294, 0, '*', 1),
(14, 'menu', 'com_newsfeeds_feeds', 'Feeds', '', 'News Feeds/Feeds', 'index.php?option=com_newsfeeds', 'component', 0, 13, 2, 17, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds', 0, '', 290, 291, 0, '*', 1),
(15, 'menu', 'com_newsfeeds_categories', 'Categories', '', 'News Feeds/Categories', 'index.php?option=com_categories&extension=com_newsfeeds', 'component', 0, 13, 2, 6, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds-cat', 0, '', 292, 293, 0, '*', 1),
(16, 'menu', 'com_redirect', 'Redirect', '', 'Redirect', 'index.php?option=com_redirect', 'component', 0, 1, 1, 24, 0, '0000-00-00 00:00:00', 0, 0, 'class:redirect', 0, '', 295, 296, 0, '*', 1),
(17, 'menu', 'com_search', 'Basic Search', '', 'Basic Search', 'index.php?option=com_search', 'component', 0, 1, 1, 19, 0, '0000-00-00 00:00:00', 0, 0, 'class:search', 0, '', 297, 298, 0, '*', 1),
(18, 'menu', 'com_weblinks', 'Weblinks', '', 'Weblinks', 'index.php?option=com_weblinks', 'component', 0, 1, 1, 21, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks', 0, '', 299, 304, 0, '*', 1),
(19, 'menu', 'com_weblinks_links', 'Links', '', 'Weblinks/Links', 'index.php?option=com_weblinks', 'component', 0, 18, 2, 21, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks', 0, '', 300, 301, 0, '*', 1),
(20, 'menu', 'com_weblinks_categories', 'Categories', '', 'Weblinks/Categories', 'index.php?option=com_categories&extension=com_weblinks', 'component', 0, 18, 2, 6, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks-cat', 0, '', 302, 303, 0, '*', 1),
(21, 'menu', 'com_finder', 'Smart Search', '', 'Smart Search', 'index.php?option=com_finder', 'component', 0, 1, 1, 27, 0, '0000-00-00 00:00:00', 0, 0, 'class:finder', 0, '', 305, 306, 0, '*', 1),
(22, 'menu', 'com_joomlaupdate', 'Joomla! Update', '', 'Joomla! Update', 'index.php?option=com_joomlaupdate', 'component', 1, 1, 1, 28, 0, '0000-00-00 00:00:00', 0, 0, 'class:joomlaupdate', 0, '', 307, 308, 0, '*', 1),
(23, 'main', 'com_tags', 'Tags', '', 'Tags', 'index.php?option=com_tags', 'component', 0, 1, 1, 29, 0, '0000-00-00 00:00:00', 0, 1, 'class:tags', 0, '', 309, 310, 0, '', 1),
(24, 'main', 'com_postinstall', 'Post-installation messages', '', 'Post-installation messages', 'index.php?option=com_postinstall', 'component', 0, 1, 1, 32, 0, '0000-00-00 00:00:00', 0, 1, 'class:postinstall', 0, '', 311, 312, 0, '*', 1),
(101, 'mainmenu', 'Home', 'home', '', 'home', 'index.php?option=com_content&view=featured', 'component', 1, 1, 1, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 9, '{"featured_categories":[""],"layout_type":"blog","num_leading_articles":"1","num_intro_articles":"3","num_columns":"3","num_links":"0","multi_column_order":"1","orderby_pri":"","orderby_sec":"front","order_date":"","show_pagination":"2","show_pagination_results":"1","show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_readmore":"","show_readmore_title":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","show_feed_link":"1","feed_summary":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":1,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 313, 314, 1, '*', 0),
(106, 'mainmenu', 'Change Password', 'change-password', '', 'change-password', 'index.php?option=com_users&view=reset', 'component', 1, 1, 1, 25, 0, '0000-00-00 00:00:00', 0, 2, '', 9, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 323, 324, 0, '*', 0),
(112, 'top-menu', 'Course Result', 'course-result', '', 'faculty/course-result', 'index.php?option=com_content&view=article&id=6', 'component', 1, 177, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 158, 159, 0, '*', 0),
(113, 'top-menu', 'User', 'user', '', 'common/user', '', 'heading', 1, 304, 2, 0, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 442, 449, 0, '*', 0),
(114, 'top-menu', 'Change Profile', '2015-07-31-08-10-31', '', 'common/user/2015-07-31-08-10-31', 'index.php?option=com_content&view=article&id=70', 'component', 1, 113, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 443, 444, 0, '*', 0),
(383, 'sidebar', 'Telephone Directory', 'telephone-directory', '', 'telephone-directory/telephone-directory', 'index.php?option=com_content&view=article&id=118', 'component', 1, 375, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 406, 407, 0, '*', 0),
(382, 'sidebar', 'Add Holiday', 'add-holiday', '', 'calendar-setting/add-holiday', 'index.php?option=com_content&view=article&id=100', 'component', 1, 379, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 398, 399, 0, '*', 0),
(119, 'top-menu', 'Add Course', 'add-course', '', 'hod/course/add-course', 'index.php?option=com_content&view=article&id=1', 'component', 1, 188, 3, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 119, 120, 0, '*', 0),
(120, 'top-menu', 'Course Offered', 'course-offered', '', 'hod/course/course-offered', 'index.php?option=com_content&view=article&id=3', 'component', 1, 188, 3, 22, 0, '0000-00-00 00:00:00', 0, 9, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 121, 122, 0, '*', 0),
(121, 'top-menu', 'Course Registration', 'course-registration', '', 'hod/course/course-registration', 'index.php?option=com_content&view=article&id=4', 'component', 1, 188, 3, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 123, 124, 0, '*', 0),
(122, 'top-menu', 'Student Record', 'student-record', '', 'admission/enrolled-students/student-record', 'index.php?option=com_content&view=article&id=2', 'component', 1, 257, 3, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 87, 88, 0, '*', 0),
(123, 'top-menu', 'Student List', 'student-list', '', 'admission/enrolled-students/student-list', 'index.php?option=com_content&view=article&id=5', 'component', 1, 257, 3, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 89, 90, 0, '*', 0),
(381, 'sidebar', 'Add Events', 'add-events', '', 'calendar-setting/add-events', 'index.php?option=com_content&view=article&id=99', 'component', 1, 379, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 396, 397, 0, '*', 0),
(126, 'top-menu', 'Logout', '2015-08-07-11-26-42', '', 'common/user/2015-08-07-11-26-42', 'index.php?option=com_user&task=logout', 'url', 1, 113, 3, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"masthead-title":"","masthead-slogan":""}', 445, 446, 0, '*', 0),
(128, 'top-menu', 'Update All GPA', 'update-all-gpa', '', 'cms-admin/update-all-gpa', 'index.php?option=com_content&view=article&id=12', 'component', 0, 172, 2, 22, 0, '0000-00-00 00:00:00', 0, 9, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 198, 199, 0, '*', 0),
(131, 'top-menu', 'Course Registration Lists', 'course-registration-lists', '', 'hod/course/course-registration-lists', 'index.php?option=com_content&view=article&id=13', 'component', 1, 188, 3, 22, 0, '0000-00-00 00:00:00', 0, 9, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 125, 126, 0, '*', 0),
(134, 'top-menu', 'Department', 'department', '', 'cms-setting/department', 'index.php?option=com_content&view=article&id=15', 'component', 1, 173, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 12, 13, 0, '*', 0),
(135, 'top-menu', 'Program', 'program', '', 'cms-setting/program', 'index.php?option=com_content&view=article&id=16', 'component', 1, 173, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 14, 15, 0, '*', 0),
(136, 'top-menu', 'Semester', 'semester', '', 'cms-setting/semester', 'index.php?option=com_content&view=article&id=17', 'component', 1, 173, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 16, 17, 0, '*', 0),
(137, 'top-menu', 'Edit Student', 'edit-student', '', 'admission/enrolled-students/edit-student', 'index.php?option=com_content&view=article&id=18', 'component', 1, 257, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 91, 92, 0, '*', 0),
(138, 'top-menu', 'District', 'district', '', 'cms-setting/district', 'index.php?option=com_content&view=article&id=19', 'component', 1, 173, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 18, 19, 0, '*', 0),
(139, 'top-menu', 'Tehsil', 'tehsil', '', 'cms-setting/tehsil', 'index.php?option=com_content&view=article&id=20', 'component', 1, 173, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 20, 21, 0, '*', 0),
(140, 'top-menu', 'Degree', 'degree', '', 'cms-setting/degree', 'index.php?option=com_content&view=article&id=21', 'component', 1, 173, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 22, 23, 0, '*', 0),
(141, 'top-menu', 'Freeze', 'freeze', '', 'cms-admin/exams/freeze', 'index.php?option=com_content&view=article&id=22', 'component', 1, 288, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"0","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 235, 236, 0, '*', 0),
(142, 'top-menu', 'Unfreeze', 'unfreeze', '', 'cms-admin/exams/unfreeze', 'index.php?option=com_content&view=article&id=23', 'component', 1, 288, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"0","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 237, 238, 0, '*', 0),
(143, 'top-menu', 'User Permissions', 'user-permissions', '', 'cms-admin/ldap-create-account/user-permissions', 'index.php?option=com_content&view=article&id=24', 'component', 1, 280, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"0","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 223, 224, 0, '*', 0),
(144, 'top-menu', 'Access to Result Entry ', 'result-entry', '', 'cms-admin/exams/result-entry', 'index.php?option=com_content&view=article&id=25', 'component', 1, 288, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"0","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 239, 240, 0, '*', 0),
(145, 'top-menu', 'Result Cancellation', 'result-cancellation', '', 'cms-admin/exams/result-cancellation', 'index.php?option=com_content&view=article&id=26', 'component', 1, 288, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"0","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 233, 234, 0, '*', 0),
(146, 'top-menu', 'Readmission', 'readmission', '', 'cms-admin/exams/readmission', 'index.php?option=com_content&view=article&id=27', 'component', 1, 288, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"0","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 227, 228, 0, '*', 0),
(147, 'top-menu', 'Program Result', 'program-result-test', '', 'exam/program-result-test', 'index.php?option=com_content&view=article&id=28', 'component', 1, 174, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 42, 43, 0, '*', 0),
(148, 'top-menu', 'Drop Student', 'drop-student', '', 'cms-admin/exams/drop-student', 'index.php?option=com_content&view=article&id=29', 'component', 1, 288, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"0","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 229, 230, 0, '*', 0),
(149, 'top-menu', 'Improvement', 'improvement', '', 'cms-admin/exams/improvement', 'index.php?option=com_content&view=article&id=30', 'component', 1, 288, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"0","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 231, 232, 0, '*', 0),
(150, 'top-menu', 'Provisional Transcript', 'prov-transcript', '', 'exam/prov-transcript', 'index.php?option=com_content&view=article&id=31', 'component', 1, 174, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 46, 47, 0, '*', 0),
(151, 'top-menu', 'Result Change Request', 'generate-token', '', 'hod/result/generate-token', 'index.php?option=com_content&view=article&id=32', 'component', 1, 189, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 129, 130, 0, '*', 0),
(152, 'top-menu', 'Change Result', 'change-result', '', 'exam/change-result', 'index.php?option=com_content&view=article&id=11', 'component', 1, 174, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 44, 45, 0, '*', 0),
(153, 'top-menu', 'Student Notice Board', 'notice', '', 'cms-admin/notice', 'index.php?option=com_content&view=article&id=33', 'component', 1, 172, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 200, 201, 0, '*', 0),
(154, 'top-menu', 'Department Specializations', 'create-specialization', '', 'hod/specialization/create-specialization', 'index.php?option=com_content&view=article&id=34', 'component', 1, 190, 3, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 137, 138, 0, '*', 0),
(155, 'top-menu', 'Student Specialization', 'student-specialization', '', 'hod/specialization/student-specialization', 'index.php?option=com_content&view=article&id=35', 'component', 1, 190, 3, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 141, 142, 0, '*', 0),
(156, 'top-menu', 'Program Specializations', 'program-specialization', '', 'hod/specialization/program-specialization', 'index.php?option=com_content&view=article&id=36', 'component', 1, 190, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 139, 140, 0, '*', 0),
(157, 'top-menu', 'Grace Mark', 'grace-mark', '', 'cms-admin/exams/grace-mark', 'index.php?option=com_content&view=article&id=37', 'component', 1, 288, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"0","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 241, 242, 0, '*', 0),
(158, 'top-menu', 'View Student Result', 'student-result', '', 'exam/student-result', 'index.php?option=com_content&view=article&id=38', 'component', 1, 174, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 50, 51, 0, '*', 0),
(159, 'top-menu', 'Student Clearance', 'student-clearance', '', 'hod/student-clearance', 'index.php?option=com_content&view=article&id=39', 'component', 1, 176, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 110, 111, 0, '*', 0),
(160, 'top-menu', 'Final Transcript', 'final-transcript', '', 'exam/final-transcript', 'index.php?option=com_content&view=article&id=40', 'component', 1, 174, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 48, 49, 0, '*', 0),
(380, 'sidebar', 'Islamic Calendar', 'islamic-calendar', '', 'calendar-setting/islamic-calendar', 'index.php?option=com_content&view=article&id=98', 'component', 1, 379, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 394, 395, 0, '*', 0),
(162, 'top-menu', 'Add Applicant', 'add-applicant', '', 'hr/add-applicant', 'index.php?option=com_content&view=article&id=41', 'component', 1, 178, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 190, 191, 0, '*', 0),
(163, 'top-menu', 'Applicant Evaluation', 'applicant-evaluation', '', 'hr/applicant-evaluation', 'index.php?option=com_content&view=article&id=42', 'component', 1, 178, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 192, 193, 0, '*', 0),
(164, 'top-menu', 'Merit List', 'merit-list', '', 'hr/merit-list', 'index.php?option=com_content&view=article&id=43', 'component', 1, 178, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 194, 195, 0, '*', 0),
(165, 'top-menu', 'Thesis Evaluation', 'thesis-evaluation', '', 'hod/thesis-evaluation', 'index.php?option=com_content&view=article&id=44', 'component', 1, 176, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 112, 113, 0, '*', 0),
(379, 'sidebar', 'Calendar Setting', 'calendar-setting', '', 'calendar-setting', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 393, 400, 0, '*', 0),
(168, 'top-menu', 'Fee Type', 'fee-type', '', 'finance/fee-type', 'index.php?option=com_content&view=article&id=45', 'component', 1, 179, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 66, 67, 0, '*', 0);
INSERT INTO `s04cf_menu` (`id`, `menutype`, `title`, `alias`, `note`, `path`, `link`, `type`, `published`, `parent_id`, `level`, `component_id`, `checked_out`, `checked_out_time`, `browserNav`, `access`, `img`, `template_style_id`, `params`, `lft`, `rgt`, `home`, `language`, `client_id`) VALUES
(169, 'top-menu', 'Semester Fee Setting', 'semester-fee', '', 'finance/semester-fee', 'index.php?option=com_content&view=article&id=46', 'component', 1, 179, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 68, 69, 0, '*', 0),
(170, 'top-menu', 'Generate Semester Fee', 'student-semester-fee', '', 'finance/student-semester-fee', 'index.php?option=com_content&view=article&id=47', 'component', 1, 179, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 74, 75, 0, '*', 0),
(171, 'top-menu', 'Attendance', 'attendance', '', 'faculty/attendance', 'index.php?option=com_content&view=article&id=48', 'component', 1, 177, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 160, 161, 0, '*', 0),
(172, 'top-menu', 'CMS-Admin', 'cms-admin', '', 'cms-admin', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 10, '', 0, '{"masthead-title":"","masthead-slogan":""}', 197, 278, 0, '*', 0),
(173, 'top-menu', 'CMS-Setting', 'cms-setting', '', 'cms-setting', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 11, '', 0, '{"masthead-title":"","masthead-slogan":""}', 11, 40, 0, '*', 0),
(174, 'top-menu', 'Exam', 'exam', '', 'exam', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 12, '', 0, '{"masthead-title":"","masthead-slogan":""}', 41, 64, 0, '*', 0),
(175, 'top-menu', 'Admission', 'admission', '', 'admission', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 13, '', 0, '{"masthead-title":"","masthead-slogan":""}', 85, 108, 0, '*', 0),
(176, 'top-menu', 'HoD', 'hod', '', 'hod', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 15, '', 0, '{"masthead-title":"","masthead-slogan":""}', 109, 156, 0, '*', 0),
(177, 'top-menu', 'Faculty', 'faculty', '', 'faculty', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 16, '', 0, '{"masthead-title":"","masthead-slogan":""}', 157, 188, 0, '*', 0),
(178, 'top-menu', 'HR', 'hr', '', 'hr', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 17, '', 0, '{"masthead-title":"","masthead-slogan":""}', 189, 196, 0, '*', 0),
(179, 'top-menu', 'Finance', 'finance', '', 'finance', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 14, '', 0, '{"masthead-title":"","masthead-slogan":""}', 65, 84, 0, '*', 0),
(180, 'top-menu', 'View Student Result', 'view-student-result', '', 'cms-admin/exams/view-student-result', 'index.php?option=com_content&view=article&id=38', 'component', 1, 288, 3, 22, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"0","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 243, 244, 0, '*', 0),
(181, 'top-menu', 'Student Notice Board', 'student-notice-board', '', 'exam/student-notice-board', 'index.php?option=com_content&view=article&id=33', 'component', 1, 174, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 52, 53, 0, '*', 0),
(182, 'top-menu', 'Student Notice Board', 'student-notice-board', '', 'admission/enrolled-students/student-notice-board', 'index.php?option=com_content&view=article&id=33', 'component', 1, 257, 3, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 93, 94, 0, '*', 0),
(183, 'top-menu', 'Student List', 'student-list', '', 'hod/student-list', 'index.php?option=com_content&view=article&id=5', 'component', 1, 176, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 114, 115, 0, '*', 0),
(184, 'top-menu', 'Program Result', 'program-result', '', 'hod/result/program-result', 'index.php?option=com_content&view=article&id=28', 'component', 1, 189, 3, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 131, 132, 0, '*', 0),
(185, 'top-menu', 'View Student Result', 'view-student-result', '', 'hod/result/view-student-result', 'index.php?option=com_content&view=article&id=38', 'component', 1, 189, 3, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 133, 134, 0, '*', 0),
(186, 'top-menu', 'Student Notice Board', 'student-notice-board', '', 'hod/student-notice-board', 'index.php?option=com_content&view=article&id=33', 'component', 1, 176, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 116, 117, 0, '*', 0),
(187, 'top-menu', 'Student Notice Board', 'student-notice-board', '', 'faculty/student-notice-board', 'index.php?option=com_content&view=article&id=33', 'component', 1, 177, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 162, 163, 0, '*', 0),
(188, 'top-menu', 'Course', 'course', '', 'hod/course', '', 'heading', 1, 176, 2, 0, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"masthead-title":"","masthead-slogan":""}', 118, 127, 0, '*', 0),
(189, 'top-menu', 'Result', 'result', '', 'hod/result', '', 'heading', 1, 176, 2, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"masthead-title":"","masthead-slogan":""}', 128, 135, 0, '*', 0),
(190, 'top-menu', 'Specialization', 'specialization', '', 'hod/specialization', '', 'heading', 1, 176, 2, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"masthead-title":"","masthead-slogan":""}', 136, 143, 0, '*', 0),
(194, 'sidebar', 'CMS-Setting', 'cms-setting-2', '', 'cms-setting-2', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"masthead-title":"","masthead-slogan":""}', 337, 350, 0, '*', 0),
(195, 'sidebar', 'Department', 'department', '', 'cms-setting-2/department', 'index.php?option=com_content&view=article&id=15', 'component', 1, 194, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 338, 339, 0, '*', 0),
(196, 'sidebar', 'Program', 'program', '', 'cms-setting-2/program', 'index.php?option=com_content&view=article&id=16', 'component', 1, 194, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 340, 341, 0, '*', 0),
(197, 'sidebar', 'Semester', 'semester', '', 'cms-setting-2/semester', 'index.php?option=com_content&view=article&id=17', 'component', 1, 194, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 342, 343, 0, '*', 0),
(198, 'sidebar', 'District', 'district', '', 'cms-setting-2/district', 'index.php?option=com_content&view=article&id=19', 'component', 1, 194, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 344, 345, 0, '*', 0),
(199, 'sidebar', 'Tehsil', 'tehsil', '', 'cms-setting-2/tehsil', 'index.php?option=com_content&view=article&id=20', 'component', 1, 194, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 346, 347, 0, '*', 0),
(200, 'sidebar', 'Degree', 'degree', '', 'cms-setting-2/degree', 'index.php?option=com_content&view=article&id=21', 'component', 1, 194, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 348, 349, 0, '*', 0),
(239, 'sidebar', 'HR', 'hr-2', '', 'hr-2', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"masthead-title":"","masthead-slogan":""}', 425, 432, 0, '*', 0),
(240, 'sidebar', 'Add Applicant', 'add-applicant', '', 'hr-2/add-applicant', 'index.php?option=com_content&view=article&id=41', 'component', 1, 239, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 426, 427, 0, '*', 0),
(241, 'sidebar', 'Applicant Evaluation', 'applicant-evaluation', '', 'hr-2/applicant-evaluation', 'index.php?option=com_content&view=article&id=42', 'component', 1, 239, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 428, 429, 0, '*', 0),
(242, 'sidebar', 'Merit List', 'merit-list', '', 'hr-2/merit-list', 'index.php?option=com_content&view=article&id=43', 'component', 1, 239, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 430, 431, 0, '*', 0),
(256, 'top-menu', 'Fee Challan', 'fee-challan', '', 'finance/fee-challan', 'index.php?option=com_content&view=article&id=49', 'component', 1, 179, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 78, 79, 0, '*', 0),
(257, 'top-menu', 'Enrolled Students', 'enrolled-students', '', 'admission/enrolled-students', '', 'heading', 1, 175, 2, 0, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"masthead-title":"","masthead-slogan":""}', 86, 95, 0, '*', 0),
(258, 'top-menu', 'New Admissions', 'new-admissions', '', 'admission/new-admissions', '', 'heading', 1, 175, 2, 0, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"masthead-title":"","masthead-slogan":""}', 96, 105, 0, '*', 0),
(261, 'top-menu', 'Attendance Sheet', 'attendance-sheet', '', 'exam/attendance-sheet', 'index.php?option=com_content&view=article&id=50', 'component', 1, 174, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 54, 55, 0, '*', 0),
(262, 'top-menu', 'Add Applicant', 'add-applicant', '', 'admission/new-admissions/add-applicant', 'index.php?option=com_content&view=article&id=51', 'component', 1, 258, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 97, 98, 0, '*', 0),
(264, 'top-menu', 'Provisional Merit', 'provisional-merit', '', 'admission/new-admissions/provisional-merit', 'index.php?option=com_content&view=article&id=52', 'component', 1, 258, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 99, 100, 0, '*', 0),
(266, 'top-menu', 'Program Result Detail', 'program-result-detail', '', 'exam/program-result-detail', 'index.php?option=com_content&view=article&id=53', 'component', 1, 174, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 56, 57, 0, '*', 0),
(267, 'top-menu', 'Teacher Evaluation', 'teacher-evaluation', '', 'cms-admin/teacher-evaluation', '', 'heading', 1, 172, 2, 0, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"masthead-title":"","masthead-slogan":""}', 202, 213, 0, '*', 0),
(268, 'top-menu', 'Create Evaluation', 'create-evaluation', '', 'cms-admin/teacher-evaluation/create-evaluation', 'index.php?option=com_content&view=article&id=54', 'component', 1, 267, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 203, 204, 0, '*', 0),
(269, 'top-menu', 'Evaluation Questions', 'evaluation-questions', '', 'cms-admin/teacher-evaluation/evaluation-questions', 'index.php?option=com_content&view=article&id=55', 'component', 1, 267, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 205, 206, 0, '*', 0),
(270, 'top-menu', 'Check Evaluation List', 'check-evaluation-list', '', 'cms-admin/teacher-evaluation/check-evaluation-list', 'index.php?option=com_content&view=article&id=56', 'component', 1, 267, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 207, 208, 0, '*', 0),
(271, 'top-menu', 'Evaluation Summary', 'evaluation-summary', '', 'cms-admin/teacher-evaluation/evaluation-summary', 'index.php?option=com_content&view=article&id=57', 'component', 1, 267, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 209, 210, 0, '*', 0),
(272, 'top-menu', 'Teacher Report', 'teacher-report', '', 'cms-admin/teacher-evaluation/teacher-report', 'index.php?option=com_content&view=article&id=58', 'component', 1, 267, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 211, 212, 0, '*', 0),
(273, 'top-menu', 'Applicant List', 'applicant-list', '', 'admission/new-admissions/applicant-list', 'index.php?option=com_content&view=article&id=59', 'component', 1, 258, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 101, 102, 0, '*', 0),
(274, 'top-menu', 'Admission Fee Setting', 'admission-fee-setting', '', 'finance/admission-fee-setting', 'index.php?option=com_content&view=article&id=60', 'component', 1, 179, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 72, 73, 0, '*', 0),
(275, 'top-menu', 'General Fee Setting', 'general-fee-setting', '', 'finance/general-fee-setting', 'index.php?option=com_content&view=article&id=61', 'component', 1, 179, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 70, 71, 0, '*', 0),
(276, 'top-menu', 'Generate Admission Fee', 'generate-admission-fee', '', 'finance/generate-admission-fee', 'index.php?option=com_content&view=article&id=62', 'component', 1, 179, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 76, 77, 0, '*', 0),
(277, 'top-menu', 'Character Certificate', 'character-certificate', '', 'exam/character-certificate', 'index.php?option=com_content&view=article&id=63', 'component', 1, 174, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 58, 59, 0, '*', 0),
(279, 'top-menu', 'Appeal Case', 'appeal-case', '', 'admission/new-admissions/appeal-case', 'index.php?option=com_content&view=article&id=65', 'component', 1, 258, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, '', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 103, 104, 0, '*', 0),
(280, 'top-menu', 'Ldap Create Account', 'ldap-create-account', '', 'cms-admin/ldap-create-account', '', 'heading', 1, 172, 2, 0, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 214, 225, 0, '*', 0),
(281, 'top-menu', 'Student Group', 'student-group', '', 'cms-admin/ldap-create-account/student-group', 'index.php?option=com_content&view=article&id=66', 'component', 1, 280, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 215, 216, 0, '*', 0),
(282, 'top-menu', 'Faculty Account', 'faculty-account', '', 'cms-admin/ldap-create-account/faculty-account', 'index.php?option=com_content&view=article&id=67', 'component', 1, 280, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 217, 218, 0, '*', 0),
(283, 'top-menu', 'User Activation', 'user-activation', '', 'cms-admin/ldap-create-account/user-activation', 'index.php?option=com_content&view=article&id=69', 'component', 1, 280, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 219, 220, 0, '*', 0),
(284, 'hidden-menu', 'Forget Password', 'forget-password', '', 'forget-password', 'index.php?option=com_content&view=article&id=68', 'component', 1, 1, 1, 22, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 437, 438, 0, '*', 0),
(285, 'top-menu', 'Faculty List', 'faculty-list', '', 'cms-admin/ldap-create-account/faculty-list', 'index.php?option=com_content&view=article&id=71', 'component', 1, 280, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 221, 222, 0, '*', 0),
(286, 'hidden-menu', 'Faculty Edit Record', 'faculty-edit-record', '', 'faculty-edit-record', 'index.php?option=com_content&view=article&id=72', 'component', 1, 1, 1, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 439, 440, 0, '*', 0),
(287, 'top-menu', 'Change Password', 'change-password', '', 'common/user/change-password', 'index.php?option=com_content&view=article&id=73', 'component', 1, 113, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 447, 448, 0, '*', 0),
(288, 'top-menu', 'Exams', 'exams', '', 'cms-admin/exams', '', 'heading', 1, 172, 2, 0, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 226, 245, 0, '*', 0),
(289, 'top-menu', 'Time Table', 'time-table', '', 'cms-admin/time-table', '', 'heading', 1, 172, 2, 0, 0, '0000-00-00 00:00:00', 0, 10, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 246, 275, 0, '*', 0),
(290, 'top-menu', 'Block Setting', 'block-setting', '', 'cms-admin/time-table/block-setting', 'index.php?option=com_content&view=article&id=74', 'component', 1, 289, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 247, 248, 0, '*', 0),
(291, 'top-menu', 'Room Type', 'room-type', '', 'cms-admin/time-table/room-type', 'index.php?option=com_content&view=article&id=75', 'component', 1, 289, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 249, 250, 0, '*', 0),
(292, 'top-menu', 'Rooms', 'rooms', '', 'cms-admin/time-table/rooms', 'index.php?option=com_content&view=article&id=76', 'component', 1, 289, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 251, 252, 0, '*', 0),
(293, 'top-menu', 'Room Allocation', 'room-allocation', '', 'cms-admin/time-table/room-allocation', 'index.php?option=com_content&view=article&id=77', 'component', 1, 289, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 253, 254, 0, '*', 0),
(294, 'top-menu', 'Time Setting', 'time-setting', '', 'cms-admin/time-table/time-setting', 'index.php?option=com_content&view=article&id=78', 'component', 1, 289, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 255, 256, 0, '*', 0),
(295, 'top-menu', 'Time Table', 'time-table', '', 'hod/time-table', 'index.php?option=com_content&view=article', 'heading', 1, 176, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 144, 155, 0, '*', 0);
INSERT INTO `s04cf_menu` (`id`, `menutype`, `title`, `alias`, `note`, `path`, `link`, `type`, `published`, `parent_id`, `level`, `component_id`, `checked_out`, `checked_out_time`, `browserNav`, `access`, `img`, `template_style_id`, `params`, `lft`, `rgt`, `home`, `language`, `client_id`) VALUES
(296, 'top-menu', 'Add Periods', 'add-periods', '', 'hod/time-table/add-periods', 'index.php?option=com_content&view=article&id=79', 'component', 1, 295, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 145, 146, 0, '*', 0),
(297, 'top-menu', 'Auto Generate', 'auto-generate', '', 'cms-admin/time-table/auto-generate', 'index.php?option=com_content&view=article&id=80', 'component', 1, 289, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 257, 258, 0, '*', 0),
(298, 'top-menu', 'Manual Entry', 'manual-entry', '', 'cms-admin/time-table/manual-entry', 'index.php?option=com_content&view=article&id=81', 'component', 1, 289, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 259, 260, 0, '*', 0),
(299, 'top-menu', 'Manual Entry', 'manual-entry', '', 'hod/time-table/manual-entry', 'index.php?option=com_content&view=article&id=81', 'component', 1, 295, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 147, 148, 0, '*', 0),
(300, 'top-menu', 'Change Period', 'change-period', '', 'cms-admin/time-table/change-period', 'index.php?option=com_content&view=article&id=82', 'component', 1, 289, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 261, 262, 0, '*', 0),
(301, 'top-menu', 'Change Period', 'change-period', '', 'hod/time-table/change-period', 'index.php?option=com_content&view=article&id=82', 'component', 1, 295, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 149, 150, 0, '*', 0),
(302, 'top-menu', 'Swap Periods', 'swap-periods', '', 'hod/time-table/swap-periods', 'index.php?option=com_content&view=article&id=83', 'component', 1, 295, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 151, 152, 0, '*', 0),
(303, 'top-menu', 'Swap Periods', 'swap-periods', '', 'cms-admin/time-table/swap-periods', 'index.php?option=com_content&view=article&id=83', 'component', 1, 289, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 263, 264, 0, '*', 0),
(304, 'top-menu', 'Common', 'common', '', 'common', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 441, 468, 0, '*', 0),
(305, 'top-menu', 'View Time Table', 'view-time-table', '', 'common/view-time-table', 'index.php?option=com_content&view=article', 'heading', 1, 304, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 450, 459, 0, '*', 0),
(306, 'top-menu', 'Program Wise', 'program-wise', '', 'common/view-time-table/program-wise', 'index.php?option=com_content&view=article&id=84', 'component', 1, 305, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 451, 452, 0, '*', 0),
(307, 'top-menu', 'Faculty Wise', 'faculty-wise', '', 'common/view-time-table/faculty-wise', 'index.php?option=com_content&view=article&id=85', 'component', 1, 305, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 453, 454, 0, '*', 0),
(308, 'top-menu', 'Room Wise', 'room-wise', '', 'common/view-time-table/room-wise', 'index.php?option=com_content&view=article&id=86', 'component', 1, 305, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 455, 456, 0, '*', 0),
(309, 'top-menu', 'Unassigned Periods', 'unassigned-periods', '', 'hod/time-table/unassigned-periods', 'index.php?option=com_content&view=article&id=87', 'component', 1, 295, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 153, 154, 0, '*', 0),
(310, 'top-menu', 'Unassigned Periods', 'unassigned-periods', '', 'cms-admin/time-table/unassigned-periods', 'index.php?option=com_content&view=article&id=87', 'component', 1, 289, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 265, 266, 0, '*', 0),
(311, 'top-menu', 'Current Courses', 'current-courses', '', 'faculty/current-courses', '', 'heading', 1, 177, 2, 0, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 164, 183, 0, '*', 0),
(312, 'top-menu', 'Previous Courses', 'previous-courses', '', 'faculty/previous-courses', '', 'heading', 1, 177, 2, 0, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 184, 185, 0, '*', 0),
(313, 'top-menu', 'Syllabus', 'syllabus', '', 'faculty/current-courses/syllabus', 'index.php?option=com_content&view=article&id=88', 'component', 1, 311, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 165, 166, 0, '*', 0),
(314, 'top-menu', 'Lecture Notes', 'lecture-notes', '', 'faculty/current-courses/lecture-notes', 'index.php?option=com_content&view=article&id=89', 'component', 1, 311, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 167, 168, 0, '*', 0),
(315, 'top-menu', 'Create Assignment', 'create-assignment', '', 'faculty/current-courses/create-assignment', 'index.php?option=com_content&view=article&id=90', 'component', 1, 311, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 169, 170, 0, '*', 0),
(316, 'top-menu', 'Check Assignments', 'check-assignments', '', 'faculty/current-courses/check-assignments', 'index.php?option=com_content&view=article&id=91', 'component', 1, 311, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 171, 172, 0, '*', 0),
(317, 'top-menu', 'Create Quiz', 'create-quize', '', 'faculty/current-courses/create-quize', 'index.php?option=com_content&view=article&id=92', 'component', 1, 311, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 173, 174, 0, '*', 0),
(318, 'top-menu', 'Quiz Marks', 'quiz-marks', '', 'faculty/current-courses/quiz-marks', 'index.php?option=com_content&view=article&id=93', 'component', 1, 311, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 175, 176, 0, '*', 0),
(319, 'top-menu', 'Add Contributions', 'add-contributions', '', 'cms-admin/add-contributions', 'index.php?option=com_content&view=article&id=94', 'component', 1, 172, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 276, 277, 0, '*', 0),
(320, 'top-menu', 'Project Contributions', 'project-contributions', '', 'common/project-contributions', 'index.php?option=com_content&view=article&id=95', 'component', 1, 304, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 460, 461, 0, '*', 0),
(321, 'top-menu', 'Empty Timetable', 'empty-timetable', '', 'cms-admin/time-table/empty-timetable', 'index.php?option=com_content&view=article&id=96', 'component', 1, 289, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 267, 268, 0, '*', 0),
(322, 'top-menu', 'Day Wise', 'day-wise', '', 'common/view-time-table/day-wise', 'index.php?option=com_content&view=article&id=97', 'component', 1, 305, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 457, 458, 0, '*', 0),
(323, 'top-menu', 'Calendar Setting', 'calendar-setting', '', 'cms-setting/calendar-setting', 'index.php?Itemid=', 'heading', 1, 173, 2, 0, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 24, 31, 0, '*', 0),
(324, 'top-menu', 'Islamic Calendar', 'islamic-calendar', '', 'cms-setting/calendar-setting/islamic-calendar', 'index.php?option=com_content&view=article&id=98', 'component', 1, 323, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 25, 26, 0, '*', 0),
(325, 'top-menu', 'Add Events', 'add-events', '', 'cms-setting/calendar-setting/add-events', 'index.php?option=com_content&view=article&id=99', 'component', 1, 323, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 27, 28, 0, '*', 0),
(326, 'top-menu', 'Add Holiday', 'add-holiday', '', 'cms-setting/calendar-setting/add-holiday', 'index.php?option=com_content&view=article&id=100', 'component', 1, 323, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 29, 30, 0, '*', 0),
(327, 'top-menu', 'Calendar', 'calendar', '', 'common/calendar', 'index.php?option=com_content&view=article&id=101', 'component', 1, 304, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 462, 463, 0, '*', 0),
(328, 'top-menu', 'Add Personal Event', 'add-personal-event', '', 'common/add-personal-event', 'index.php?option=com_content&view=article&id=102', 'component', 1, 304, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 464, 465, 0, '*', 0),
(329, 'top-menu', 'Empty Timetable Date', 'empty-timetable-date', '', 'cms-admin/time-table/empty-timetable-date', 'index.php?option=com_content&view=article&id=103', 'component', 1, 289, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 269, 270, 0, '*', 0),
(330, 'top-menu', 'Manual Datesheet', 'manual-datesheet', '', 'cms-admin/time-table/manual-datesheet', 'index.php?option=com_content&view=article&id=104', 'component', 1, 289, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 271, 272, 0, '*', 0),
(331, 'top-menu', 'Show Datesheet', 'show-datesheet', '', 'cms-admin/time-table/show-datesheet', 'index.php?option=com_content&view=article&id=105', 'component', 1, 289, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 273, 274, 0, '*', 0),
(332, 'top-menu', 'Bonafied Certificate', 'bonafied-certificate', '', 'exam/bonafied-certificate', 'index.php?option=com_content&view=article&id=106', 'component', 1, 174, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 60, 61, 0, '*', 0),
(333, 'top-menu', 'Aggregate Marks', 'aggregate-marks', '', 'faculty/current-courses/aggregate-marks', 'index.php?option=com_content&view=article&id=107', 'component', 1, 311, 3, 22, 0, '0000-00-00 00:00:00', 0, 16, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 177, 178, 0, '*', 0),
(334, 'top-menu', 'Paper Template', 'paper-template', '', 'faculty/paper-template', 'index.php?option=com_content&view=article&id=108', 'component', 1, 177, 2, 22, 0, '0000-00-00 00:00:00', 0, 16, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 186, 187, 0, '*', 0),
(335, 'top-menu', 'Visiting Bill', 'visiting-bill', '', 'faculty/current-courses/visiting-bill', 'index.php?option=com_content&view=article&id=109', 'component', 1, 311, 3, 22, 0, '0000-00-00 00:00:00', 0, 16, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 179, 180, 0, '*', 0),
(336, 'top-menu', 'View Date Sheet', 'view-date-sheet', '', 'common/view-date-sheet', 'index.php?option=com_content&view=article&id=105', 'component', 1, 304, 2, 22, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 466, 467, 0, '*', 0),
(337, 'top-menu', 'Extra Period', 'extra-period', '', 'faculty/current-courses/extra-period', 'index.php?option=com_content&view=article&id=110', 'component', 1, 311, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 181, 182, 0, '*', 0),
(338, 'top-menu', 'Library Clearance', 'library-clearance', '', 'admission/library-clearance', 'index.php?option=com_content&view=article&id=111', 'component', 1, 175, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 106, 107, 0, '*', 0),
(339, 'top-menu', 'Accounts Clearance', 'accounts-clearance', '', 'finance/accounts-clearance', 'index.php?option=com_content&view=article&id=112', 'component', 1, 179, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 80, 81, 0, '*', 0),
(340, 'top-menu', 'Exams Clearance', 'exams-clearance', '', 'exam/exams-clearance', 'index.php?option=com_content&view=article&id=113', 'component', 1, 174, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 62, 63, 0, '*', 0),
(341, 'top-menu', 'Telephone Directory', 'telephone-directory', '', 'cms-setting/telephone-directory', '', 'heading', 1, 173, 2, 0, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 32, 39, 0, '*', 0),
(342, 'top-menu', 'Category', 'category', '', 'cms-setting/telephone-directory/category', 'index.php?option=com_content&view=article&id=114', 'component', 1, 341, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 33, 34, 0, '*', 0),
(343, 'top-menu', 'Add Contact', 'add-contact', '', 'cms-setting/telephone-directory/add-contact', 'index.php?option=com_content&view=article&id=115', 'component', 1, 341, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 35, 36, 0, '*', 0),
(344, 'top-menu', 'View Directory', 'view-directory', '', 'cms-setting/telephone-directory/view-directory', 'index.php?option=com_content&view=article&id=116', 'component', 1, 341, 3, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 37, 38, 0, '*', 0),
(345, 'top-menu', 'Generate General Fee', 'generate-general-fee', '', 'finance/generate-general-fee', 'index.php?option=com_content&view=article&id=117', 'component', 1, 179, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 82, 83, 0, '*', 0),
(346, 'sidebar', 'UOBS-CMS', 'uobs-cms', '', 'uobs-cms', '../uobs-cms', 'url', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu-anchor_rel":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 469, 470, 0, '*', 0),
(347, 'sidebar', 'text seprator', 'text-seprator', '', 'text-seprator', '', 'separator', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 13, ' ', 0, '{"menu-anchor_css":"","menu_image":"images\\/text-seprator.png","menu_text":0,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 435, 436, 0, '*', 0),
(348, 'sidebar', 'Teacher Evaluation', 'teacher-evaluation', '', 'teacher-evaluation', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 409, 420, 0, '*', 0),
(349, 'sidebar', 'Create Evaluation', 'create-evaluation', '', 'teacher-evaluation/create-evaluation', 'index.php?option=com_content&view=article&id=54', 'component', 1, 348, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 410, 411, 0, '*', 0),
(350, 'sidebar', 'Evaluation Questions', 'evaluation-questions', '', 'teacher-evaluation/evaluation-questions', 'index.php?option=com_content&view=article&id=55', 'component', 1, 348, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 412, 413, 0, '*', 0),
(351, 'sidebar', 'Check Evaluation List', 'check-evaluation-list', '', 'teacher-evaluation/check-evaluation-list', 'index.php?option=com_content&view=article&id=56', 'component', 1, 348, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 414, 415, 0, '*', 0),
(352, 'sidebar', 'Evaluation Summary', 'evaluation-summary', '', 'teacher-evaluation/evaluation-summary', 'index.php?option=com_content&view=article&id=57', 'component', 1, 348, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 416, 417, 0, '*', 0);
INSERT INTO `s04cf_menu` (`id`, `menutype`, `title`, `alias`, `note`, `path`, `link`, `type`, `published`, `parent_id`, `level`, `component_id`, `checked_out`, `checked_out_time`, `browserNav`, `access`, `img`, `template_style_id`, `params`, `lft`, `rgt`, `home`, `language`, `client_id`) VALUES
(353, 'sidebar', 'Teacher Report', 'teacher-report', '', 'teacher-evaluation/teacher-report', 'index.php?option=com_content&view=article&id=58', 'component', 1, 348, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 418, 419, 0, '*', 0),
(354, 'sidebar', 'Ldap Accounts', 'ldap-accounts', '', 'ldap-accounts', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 351, 362, 0, '*', 0),
(355, 'sidebar', 'Student Group', 'student-group', '', 'ldap-accounts/student-group', 'index.php?option=com_content&view=article&id=66', 'component', 1, 354, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 352, 353, 0, '*', 0),
(356, 'sidebar', 'Faculty Account', 'faculty-account', '', 'ldap-accounts/faculty-account', 'index.php?option=com_content&view=article&id=67', 'component', 1, 354, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 354, 355, 0, '*', 0),
(357, 'sidebar', 'Faculty List', 'faculty-list', '', 'ldap-accounts/faculty-list', 'index.php?option=com_content&view=article&id=71', 'component', 1, 354, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 356, 357, 0, '*', 0),
(358, 'sidebar', 'User Activation', 'user-activation', '', 'ldap-accounts/user-activation', 'index.php?option=com_content&view=article&id=69', 'component', 1, 354, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 358, 359, 0, '*', 0),
(359, 'sidebar', 'User Permissions', 'user-permissions', '', 'ldap-accounts/user-permissions', 'index.php?option=com_content&view=article&id=24', 'component', 1, 354, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 360, 361, 0, '*', 0),
(360, 'sidebar', 'Time Table', 'time-table', '', 'time-table', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 363, 388, 0, '*', 0),
(361, 'sidebar', 'Block Setting', 'block-setting', '', 'time-table/block-setting', 'index.php?option=com_content&view=article&id=74', 'component', 1, 360, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 364, 365, 0, '*', 0),
(362, 'sidebar', 'Room Type', 'room-type', '', 'time-table/room-type', 'index.php?option=com_content&view=article&id=75', 'component', 1, 360, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 366, 367, 0, '*', 0),
(363, 'sidebar', 'Rooms', 'rooms', '', 'time-table/rooms', 'index.php?option=com_content&view=article&id=76', 'component', 1, 360, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 368, 369, 0, '*', 0),
(364, 'sidebar', 'Room Allocation', 'room-allocation', '', 'time-table/room-allocation', 'index.php?option=com_content&view=article&id=77', 'component', 1, 360, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 370, 371, 0, '*', 0),
(365, 'sidebar', 'Time Setting', 'time-setting', '', 'time-table/time-setting', 'index.php?option=com_content&view=article&id=78', 'component', 1, 360, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 372, 373, 0, '*', 0),
(366, 'sidebar', 'Auto Generate', 'auto-generate', '', 'time-table/auto-generate', 'index.php?option=com_content&view=article&id=80', 'component', 1, 360, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 374, 375, 0, '*', 0),
(367, 'sidebar', 'Manual Entry', 'manual-entry', '', 'time-table/manual-entry', 'index.php?option=com_content&view=article&id=81', 'component', 1, 360, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 376, 377, 0, '*', 0),
(368, 'sidebar', 'Change Period', 'change-period', '', 'time-table/change-period', 'index.php?option=com_content&view=article&id=82', 'component', 1, 360, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 378, 379, 0, '*', 0),
(369, 'sidebar', 'Swap Periods', 'swap-periods', '', 'time-table/swap-periods', 'index.php?option=com_content&view=article&id=83', 'component', 1, 360, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 380, 381, 0, '*', 0),
(370, 'sidebar', 'Unassigned Periods', 'unassigned-periods', '', 'time-table/unassigned-periods', 'index.php?option=com_content&view=article&id=87', 'component', 1, 360, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 382, 383, 0, '*', 0),
(371, 'sidebar', 'Empty Timetable', 'empty-timetable', '', 'time-table/empty-timetable', 'index.php?option=com_content&view=article&id=96', 'component', 1, 360, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 384, 385, 0, '*', 0),
(372, 'sidebar', 'Empty Timetable Date', 'empty-timetable-date', '', 'time-table/empty-timetable-date', 'index.php?option=com_content&view=article&id=103', 'component', 1, 360, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 386, 387, 0, '*', 0),
(373, 'sidebar', 'Date Sheet', 'date-sheet', '', 'date-sheet', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 389, 392, 0, '*', 0),
(374, 'sidebar', 'Manual Datesheet', 'manual-datesheet', '', 'date-sheet/manual-datesheet', 'index.php?option=com_content&view=article&id=104', 'component', 1, 373, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 390, 391, 0, '*', 0),
(375, 'sidebar', 'Telephone Directory', 'telephone-directory', '', 'telephone-directory', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"masthead-title":"","masthead-slogan":""}', 401, 408, 0, '*', 0),
(376, 'sidebar', 'Categories', 'categories', '', 'telephone-directory/categories', 'index.php?option=com_content&view=article&id=114', 'component', 1, 375, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 402, 403, 0, '*', 0),
(377, 'sidebar', 'Add Contact', 'add-contact', '', 'telephone-directory/add-contact', 'index.php?option=com_content&view=article&id=115', 'component', 1, 375, 2, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 404, 405, 0, '*', 0),
(378, 'sidebar', 'Add Contributions', 'add-contributions', '', 'add-contributions', 'index.php?option=com_content&view=article&id=94', 'component', 1, 1, 1, 22, 0, '0000-00-00 00:00:00', 0, 2, ' ', 0, '{"show_title":"","link_titles":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_tags":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"menu_show":1,"page_title":"","show_page_heading":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0,"masthead-title":"","masthead-slogan":""}', 433, 434, 0, '*', 0);

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_menu_types`
--

CREATE TABLE `s04cf_menu_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `asset_id` int(11) NOT NULL,
  `menutype` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(48) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_menu_types`
--

INSERT INTO `s04cf_menu_types` (`id`, `asset_id`, `menutype`, `title`, `description`) VALUES
(1, 0, 'mainmenu', 'Main Menu', 'The main menu for the site'),
(4, 0, 'top-menu', 'Top Menu', ''),
(6, 0, 'sidebar', 'Side Bar', ''),
(7, 127, 'hidden-menu', 'Hidden Menu', 'For hidden Links');

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_messages`
--

CREATE TABLE `s04cf_messages` (
  `message_id` int(10) UNSIGNED NOT NULL,
  `user_id_from` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_id_to` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `folder_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `message` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_messages`
--

INSERT INTO `s04cf_messages` (`message_id`, `user_id_from`, `user_id_to`, `folder_id`, `date_time`, `state`, `priority`, `subject`, `message`) VALUES
(1, 245, 246, 0, '2016-06-25 05:53:54', 0, 0, 'asa', '<p>ASa</p>'),
(2, 245, 246, 0, '2016-06-25 05:58:08', 0, 0, 'AS', '<p>ASSAD</p>'),
(3, 245, 246, 0, '2016-06-25 05:59:56', 0, 0, 'aaasdssdsds', '<p>asasasa</p>'),
(4, 245, 246, 0, '2016-06-25 06:27:06', 0, 0, 'aa', '<p>aa</p>'),
(5, 245, 246, 0, '2016-06-25 06:28:12', 0, 0, 'ssss', '<p>sadsd</p>'),
(6, 245, 246, 0, '2016-06-25 06:29:37', 0, 0, 'hh', '<p>bb</p>'),
(7, 245, 246, 0, '2016-06-25 06:50:36', 0, 0, 'sss', '<p>sss</p>'),
(8, 245, 246, 0, '2016-06-25 07:02:24', 0, 0, 'dd', '<p>dd</p>'),
(9, 245, 246, 0, '2016-06-25 07:49:27', 0, 0, 'SS', '<p>SS</p>'),
(10, 245, 246, 0, '2016-06-25 07:50:25', 0, 0, 'SS', '<p>ASAS</p>'),
(11, 245, 246, 0, '2016-06-25 10:05:18', 0, 0, 'test', '<p>dsd</p>'),
(12, 245, 246, 0, '2016-06-25 10:14:22', 0, 0, 'test', '<p>sds</p>'),
(13, 245, 246, 0, '2016-06-25 10:29:22', 0, 0, 'dsddd', '<p>dd</p>'),
(14, 245, 246, 0, '2016-06-25 10:31:58', 0, 0, 'ffff', '<p>fff</p>'),
(15, 245, 246, 0, '2016-06-25 10:35:35', 0, 0, 'mm', '<p>kk</p>');

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_messages_cfg`
--

CREATE TABLE `s04cf_messages_cfg` (
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `cfg_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_modules`
--

CREATE TABLE `s04cf_modules` (
  `id` int(11) NOT NULL,
  `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `params` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_modules`
--

INSERT INTO `s04cf_modules` (`id`, `asset_id`, `title`, `note`, `content`, `ordering`, `position`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `published`, `module`, `access`, `showtitle`, `params`, `client_id`, `language`) VALUES
(1, 39, 'Main Menu', '', '', 1, 'position-4', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_menu', 1, 1, '{"menutype":"mainmenu","base":"","startLevel":"1","endLevel":"0","showAllChildren":"0","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"_menu","cache":"1","cache_time":"900","cachemode":"itemid","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(2, 40, 'Login', '', '', 1, 'login', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_login', 1, 1, '', 1, '*'),
(3, 41, 'Popular Articles', '', '', 3, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_popular', 3, 1, '{"count":"5","catid":"","user_id":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(4, 42, 'Recently Added Articles', '', '', 4, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_latest', 3, 1, '{"count":"5","ordering":"c_dsc","catid":"","user_id":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(8, 43, 'Toolbar', '', '', 1, 'toolbar', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_toolbar', 3, 1, '', 1, '*'),
(9, 44, 'Quick Icons', '', '', 1, 'icon', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_quickicon', 3, 1, '', 1, '*'),
(10, 45, 'Logged-in Users', '', '', 2, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_logged', 3, 1, '{"count":"5","name":"1","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(12, 46, 'Admin Menu', '', '', 1, 'menu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 3, 1, '{"layout":"","moduleclass_sfx":"","shownew":"1","showhelp":"1","cache":"0"}', 1, '*'),
(13, 47, 'Admin Submenu', '', '', 1, 'submenu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_submenu', 3, 1, '', 1, '*'),
(14, 48, 'User Status', '', '', 2, 'status', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_status', 3, 1, '', 1, '*'),
(15, 49, 'Title', '', '', 1, 'title', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_title', 3, 1, '', 1, '*'),
(16, 50, 'Login Form', '', '', 1, 'sidebar-2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_login', 1, 1, '{"pretext":"","posttext":"","login":"","logout":"","greeting":"1","name":"0","usesecure":"0","usetext":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(17, 51, 'Breadcrumbs', '', '', 1, 'position-1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_breadcrumbs', 1, 0, '{"showHere":"1","showHome":"1","homeText":"","showLast":"1","separator":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(79, 52, 'Multilanguage status', '', '', 1, 'status', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_multilangstatus', 3, 1, '{"layout":"_:default","moduleclass_sfx":"","cache":"0"}', 1, '*'),
(86, 53, 'Joomla Version', '', '', 1, 'footer', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_version', 3, 1, '{"format":"short","product":"1","layout":"_:default","moduleclass_sfx":"","cache":"0"}', 1, '*'),
(91, 176, 'Header', '', '<p style="font-size: 12.16px;">{source}</p>\r\n<p style="font-size: 12.16px;"> </p>\r\n<p style="font-size: 12.16px;">&lt;style&gt;</p>\r\n<p style="font-size: 12.16px;">.header-name:hover{</p>\r\n<p style="font-size: 12.16px;">    color:goldenrod;</p>\r\n<p style="font-size: 12.16px;">}</p>\r\n<p style="font-size: 12.16px;">&lt;/style&gt;</p>\r\n<p style="font-size: 12.16px;"> </p>\r\n<p style="font-size: 12.16px;">&lt;div  style="background: darkgreen; color: white; padding: 10px;" align="center"&gt;</p>\r\n<p style="font-size: 12.16px;">&lt;h3 class="header-name"&gt;UOBS-Settings&lt;/h3&gt;</p>\r\n<p style="font-size: 12.16px;">&lt;/div&gt;</p>\r\n<p style="font-size: 12.16px;"> </p>\r\n<p style="font-size: 12.16px;">{/source}</p>', 1, 'position-13', 245, '2018-01-23 11:30:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"0","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(89, 104, 'Side Menu', '', '', 1, 'sidebar-1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_accordeonck', 2, 0, '{"menutype":"sidebar","base":"","startLevel":"1","endLevel":"0","imgalignement":"none","imagerollprefix":"_hover","imageactiveprefix":"_active","tag_id":"","class_sfx":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid","eventtype":"click","eventtarget":"link","fadetransition":"false","mooduration":"500","mootransition":"linear","defaultopenedid":"","activeeffect":"0","usestyles":"1","theme":"simple","useplusminusimages":"1","imageplus":"modules\\/mod_accordeonck\\/assets\\/plus.png","imageminus":"modules\\/mod_accordeonck\\/assets\\/minus.png","imageposition":"right","menuusemargin":"1","menumargin":"0","menupadding":"5","menuusebackground":"1","menubgcolor1":"#9f7b50","menuusegradient":"0","menubgcolor2":"#e3e3e3","menuuseroundedcorners":"1","menuroundedcornerstl":"5","menuroundedcornerstr":"5","menuroundedcornersbr":"5","menuroundedcornersbl":"5","menuuseshadow":"1","menushadowcolor":"#444444","menushadowblur":"3","menushadowspread":"0","menushadowoffsetx":"0","menushadowoffsety":"0","menushadowinset":"0","menuuseborders":"1","menubordercolor":"#efefef","menuborderwidth":"1","level1linkusefont":"1","level1linkfontsize":"14px","level1linkfontcolor":"","level1linkfontcolorhover":"","level1linkdescfontsize":"10px","level1linkdescfontcolor":"","level1linkusemargin":"1","level1linkmargin":"0","level1linkpadding":"0","level1linkusebackground":"1","level1linkbgcolor1":"","level1linkusegradient":"1","level1linkbgcolor2":"","level1linkuseroundedcorners":"1","level1linkroundedcornerstl":"0","level1linkroundedcornerstr":"0","level1linkroundedcornersbr":"0","level1linkroundedcornersbl":"0","level1linkuseshadow":"1","level1linkshadowcolor":"","level1linkshadowblur":"0","level1linkshadowspread":"0","level1linkshadowoffsetx":"0","level1linkshadowoffsety":"0","level1linkshadowinset":"0","level1linkuseborders":"1","level1linkbordercolor":"","level1linkborderwidth":"1","level2linkusefont":"1","level2linkfontsize":"12px","level2linkfontcolor":"","level2linkfontcolorhover":"","level2linkdescfontsize":"10px","level2linkdescfontcolor":"","level2linkusemargin":"1","level2linkmargin":"0","level2linkpadding":"0","level2linkusebackground":"1","level2linkbgcolor1":"","level2linkusegradient":"1","level2linkbgcolor2":"","level2linkuseroundedcorners":"1","level2linkroundedcornerstl":"0","level2linkroundedcornerstr":"0","level2linkroundedcornersbr":"0","level2linkroundedcornersbl":"0","level2linkuseshadow":"1","level2linkshadowcolor":"","level2linkshadowblur":"0","level2linkshadowspread":"0","level2linkshadowoffsetx":"0","level2linkshadowoffsety":"0","level2linkshadowinset":"0","level2linkuseborders":"1","level2linkbordercolor":"","level2linkborderwidth":"1","level3linkusefont":"1","level3linkfontsize":"12px","level3linkfontcolor":"","level3linkfontcolorhover":"","level3linkdescfontsize":"10px","level3linkdescfontcolor":"","level3linkusemargin":"1","level3linkmargin":"0","level3linkpadding":"0","level3linkusebackground":"1","level3linkbgcolor1":"","level3linkusegradient":"1","level3linkbgcolor2":"","level3linkuseroundedcorners":"1","level3linkroundedcornerstl":"0","level3linkroundedcornerstr":"0","level3linkroundedcornersbr":"0","level3linkroundedcornersbl":"0","level3linkuseshadow":"1","level3linkshadowcolor":"","level3linkshadowblur":"0","level3linkshadowspread":"0","level3linkshadowoffsetx":"0","level3linkshadowoffsety":"0","level3linkshadowinset":"0","level3linkuseborders":"1","level3linkbordercolor":"","level3linkborderwidth":"1","thirdparty":"none","usehikashopimages":"0","usehikashopsuffix":"0","hikashopimagesuffix":"_mini","hikashopcategoryroot":"0","hikashopcategorydepth":"0","usevmimages":"0","usevmsuffix":"0","vmimagesuffix":"_mini","vmcategoryroot":"0","vmcategorydepth":"0","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*'),
(90, 106, 'Footer Note', '', '<h3><strong style="color: green;">University of Baltistan, Skardu</strong></h3>', 1, 'footer', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"0","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static","module_tag":"div","bootstrap_size":"0","header_tag":"h3","header_class":"","style":"0"}', 0, '*');

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_modules_menu`
--

CREATE TABLE `s04cf_modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_modules_menu`
--

INSERT INTO `s04cf_modules_menu` (`moduleid`, `menuid`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(12, 0),
(13, 0),
(14, 0),
(15, 0),
(16, 101),
(17, 0),
(79, 0),
(86, 0),
(87, 0),
(88, 0),
(89, 0),
(90, 0),
(91, 0);

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_newsfeeds`
--

CREATE TABLE `s04cf_newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `link` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `cache_time` int(10) UNSIGNED NOT NULL DEFAULT '3600',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  `access` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `params` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `metakey` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadesc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadata` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `xreference` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `images` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_overrider`
--

CREATE TABLE `s04cf_overrider` (
  `id` int(10) NOT NULL COMMENT 'Primary Key',
  `constant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `string` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_postinstall_messages`
--

CREATE TABLE `s04cf_postinstall_messages` (
  `postinstall_message_id` bigint(20) UNSIGNED NOT NULL,
  `extension_id` bigint(20) NOT NULL DEFAULT '700' COMMENT 'FK to #__extensions',
  `title_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Lang key for the title',
  `description_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Lang key for description',
  `action_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `language_extension` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'com_postinstall' COMMENT 'Extension holding lang keys',
  `language_client_id` tinyint(3) NOT NULL DEFAULT '1',
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'link' COMMENT 'Message type - message, link, action',
  `action_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'RAD URI to the PHP file containing action method',
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'Action method name or URL',
  `condition_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'RAD URI to file holding display condition method',
  `condition_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Display condition method, must return boolean',
  `version_introduced` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '3.2.0' COMMENT 'Version when this message was introduced',
  `enabled` tinyint(3) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_postinstall_messages`
--

INSERT INTO `s04cf_postinstall_messages` (`postinstall_message_id`, `extension_id`, `title_key`, `description_key`, `action_key`, `language_extension`, `language_client_id`, `type`, `action_file`, `action`, `condition_file`, `condition_method`, `version_introduced`, `enabled`) VALUES
(1, 700, 'PLG_TWOFACTORAUTH_TOTP_POSTINSTALL_TITLE', 'PLG_TWOFACTORAUTH_TOTP_POSTINSTALL_BODY', 'PLG_TWOFACTORAUTH_TOTP_POSTINSTALL_ACTION', 'plg_twofactorauth_totp', 1, 'action', 'site://plugins/twofactorauth/totp/postinstall/actions.php', 'twofactorauth_postinstall_action', 'site://plugins/twofactorauth/totp/postinstall/actions.php', 'twofactorauth_postinstall_condition', '3.2.0', 1),
(2, 700, 'COM_CPANEL_MSG_EACCELERATOR_TITLE', 'COM_CPANEL_MSG_EACCELERATOR_BODY', 'COM_CPANEL_MSG_EACCELERATOR_BUTTON', 'com_cpanel', 1, 'action', 'admin://components/com_admin/postinstall/eaccelerator.php', 'admin_postinstall_eaccelerator_action', 'admin://components/com_admin/postinstall/eaccelerator.php', 'admin_postinstall_eaccelerator_condition', '3.2.0', 1),
(3, 700, 'COM_CPANEL_WELCOME_BEGINNERS_TITLE', 'COM_CPANEL_WELCOME_BEGINNERS_MESSAGE', '', 'com_cpanel', 1, 'message', '', '', '', '', '3.2.0', 1),
(4, 700, 'COM_CPANEL_MSG_PHPVERSION_TITLE', 'COM_CPANEL_MSG_PHPVERSION_BODY', '', 'com_cpanel', 1, 'message', '', '', 'admin://components/com_admin/postinstall/phpversion.php', 'admin_postinstall_phpversion_condition', '3.2.2', 1),
(5, 700, 'COM_CPANEL_MSG_HTACCESS_TITLE', 'COM_CPANEL_MSG_HTACCESS_BODY', '', 'com_cpanel', 1, 'message', '', '', 'admin://components/com_admin/postinstall/htaccess.php', 'admin_postinstall_htaccess_condition', '3.4.0', 1),
(6, 700, 'COM_CPANEL_MSG_ROBOTS_TITLE', 'COM_CPANEL_MSG_ROBOTS_BODY', '', 'com_cpanel', 1, 'message', '', '', '', '', '3.3.0', 1),
(7, 700, 'COM_CPANEL_MSG_LANGUAGEACCESS340_TITLE', 'COM_CPANEL_MSG_LANGUAGEACCESS340_BODY', '', 'com_cpanel', 1, 'message', '', '', 'admin://components/com_admin/postinstall/languageaccess340.php', 'admin_postinstall_languageaccess340_condition', '3.4.1', 1),
(8, 700, 'COM_CPANEL_MSG_STATS_COLLECTION_TITLE', 'COM_CPANEL_MSG_STATS_COLLECTION_BODY', '', 'com_cpanel', 1, 'message', '', '', 'admin://components/com_admin/postinstall/statscollection.php', 'admin_postinstall_statscollection_condition', '3.5.0', 1),
(9, 700, 'PLG_SYSTEM_UPDATENOTIFICATION_POSTINSTALL_UPDATECACHETIME', 'PLG_SYSTEM_UPDATENOTIFICATION_POSTINSTALL_UPDATECACHETIME_BODY', 'PLG_SYSTEM_UPDATENOTIFICATION_POSTINSTALL_UPDATECACHETIME_ACTION', 'plg_system_updatenotification', 1, 'action', 'site://plugins/system/updatenotification/postinstall/updatecachetime.php', 'updatecachetime_postinstall_action', 'site://plugins/system/updatenotification/postinstall/updatecachetime.php', 'updatecachetime_postinstall_condition', '3.6.3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_redirect_links`
--

CREATE TABLE `s04cf_redirect_links` (
  `id` int(10) UNSIGNED NOT NULL,
  `old_url` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_url` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referer` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `published` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `header` smallint(3) NOT NULL DEFAULT '301'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_schemas`
--

CREATE TABLE `s04cf_schemas` (
  `extension_id` int(11) NOT NULL,
  `version_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_schemas`
--

INSERT INTO `s04cf_schemas` (`extension_id`, `version_id`) VALUES
(700, '3.6.3-2016-08-16');

-- --------------------------------------------------------

--
-- Stand-in structure for view `s04cf_session`
--
CREATE TABLE `s04cf_session` (
`session_id` varchar(191)
,`client_id` tinyint(3) unsigned
,`guest` tinyint(4) unsigned
,`time` varchar(14)
,`data` longtext
,`userid` int(11)
,`username` varchar(150)
);

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_tags`
--

CREATE TABLE `s04cf_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `level` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `path` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `params` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadesc` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The meta description for the page.',
  `metakey` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The meta keywords for the page.',
  `metadata` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'JSON encoded metadata properties.',
  `created_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `modified_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `urls` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_tags`
--

INSERT INTO `s04cf_tags` (`id`, `parent_id`, `lft`, `rgt`, `level`, `path`, `title`, `alias`, `note`, `description`, `published`, `checked_out`, `checked_out_time`, `access`, `params`, `metadesc`, `metakey`, `metadata`, `created_user_id`, `created_time`, `created_by_alias`, `modified_user_id`, `modified_time`, `images`, `urls`, `hits`, `language`, `version`, `publish_up`, `publish_down`) VALUES
(1, 0, 0, 1, 0, '', 'ROOT', 'root', '', '', 1, 0, '0000-00-00 00:00:00', 1, '', '', '', '', 0, '2011-01-01 00:00:01', '', 0, '0000-00-00 00:00:00', '', '', 0, '*', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_template_styles`
--

CREATE TABLE `s04cf_template_styles` (
  `id` int(10) UNSIGNED NOT NULL,
  `template` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `client_id` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `home` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `params` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_template_styles`
--

INSERT INTO `s04cf_template_styles` (`id`, `template`, `client_id`, `home`, `title`, `params`) VALUES
(4, 'beez3', 0, '0', 'Beez3 - Default', '{"wrapperSmall":"53","wrapperLarge":"72","logo":"images\\/joomla_black.gif","sitetitle":"Joomla!","sitedescription":"Open Source Content Management","navposition":"left","templatecolor":"personal","html5":"0"}'),
(5, 'hathor', 1, '0', 'Hathor - Default', '{"showSiteName":"0","colourChoice":"","boldText":"0"}'),
(7, 'protostar', 0, '0', 'protostar - Default', '{"templateColor":"","logoFile":"","googleFont":"1","googleFontName":"Open+Sans","fluidContainer":"0"}'),
(8, 'isis', 1, '1', 'isis - Default', '{"templateColor":"","logoFile":""}'),
(9, 'purity_iii', 0, '1', 'purity_III - Default', '{"tpl_article_info_datetime_format":"d M Y","t3_template":"1","devmode":"0","themermode":"1","legacy_css":"0","responsive":"1","non_responsive_width":"970px","build_rtl":"0","t3-assets":"t3-assets","t3-rmvlogo":"0","minify":"0","minify_js":"0","minify_js_tool":"jsmin","minify_exclude":"","link_titles":"","theme":"","logotype":"text","sitename":"KIU-SIS","slogan":"","logoimage":"images\\/logo.gif","enable_logoimage_sm":"0","logoimage_sm":"","mainlayout":"corporate","sublayout":"","mm_type":"sidebar","navigation_trigger":"hover","navigation_type":"megamenu","navigation_animation":"zoom","navigation_animation_duration":"400","mm_config":"{\\"top-menu\\":[]}","navigation_collapse_enable":"1","addon_offcanvas_enable":"1","addon_offcanvas_effect":"off-canvas-effect-4","snippet_open_head":"","snippet_close_head":"","snippet_open_body":"<style>\\r\\nbody{\\r\\nmargin-top: -20px;\\r\\npadding: 0px;\\r\\n}\\r\\n#t3-mainnav\\r\\n{\\r\\n     display:none;\\r\\n}\\r\\n.corporate .slideshow\\r\\n{\\r\\n     padding: 0px;\\r\\n     border: 0px solid;\\r\\n}\\r\\n<\\/style>","snippet_close_body":"","snippet_debug":"0","mm_config_needupdate":""}');

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_ucm_base`
--

CREATE TABLE `s04cf_ucm_base` (
  `ucm_id` int(10) UNSIGNED NOT NULL,
  `ucm_item_id` int(10) NOT NULL,
  `ucm_type_id` int(11) NOT NULL,
  `ucm_language_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_ucm_content`
--

CREATE TABLE `s04cf_ucm_content` (
  `core_content_id` int(10) UNSIGNED NOT NULL,
  `core_type_alias` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'FK to the content types table',
  `core_title` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `core_alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `core_body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `core_state` tinyint(1) NOT NULL DEFAULT '0',
  `core_checked_out_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `core_checked_out_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `core_access` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `core_params` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `core_featured` tinyint(4) UNSIGNED NOT NULL DEFAULT '0',
  `core_metadata` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'JSON encoded metadata properties.',
  `core_created_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `core_created_by_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `core_created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `core_modified_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Most recent user that modified',
  `core_modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `core_language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `core_publish_up` datetime NOT NULL,
  `core_publish_down` datetime NOT NULL,
  `core_content_item_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID from the individual type table',
  `asset_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'FK to the #__assets table.',
  `core_images` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `core_urls` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `core_hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `core_version` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `core_ordering` int(11) NOT NULL DEFAULT '0',
  `core_metakey` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `core_metadesc` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `core_catid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `core_xreference` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `core_type_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Contains core content data in name spaced fields';

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_ucm_history`
--

CREATE TABLE `s04cf_ucm_history` (
  `version_id` int(10) UNSIGNED NOT NULL,
  `ucm_item_id` int(10) UNSIGNED NOT NULL,
  `ucm_type_id` int(10) UNSIGNED NOT NULL,
  `version_note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Optional version name',
  `save_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `character_count` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Number of characters in this version.',
  `sha1_hash` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'SHA1 hash of the version_data column.',
  `version_data` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'json-encoded string of version data',
  `keep_forever` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=auto delete; 1=keep'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_ucm_history`
--

INSERT INTO `s04cf_ucm_history` (`version_id`, `ucm_item_id`, `ucm_type_id`, `version_note`, `save_date`, `editor_user_id`, `character_count`, `sha1_hash`, `version_data`, `keep_forever`) VALUES
(48, 15, 1, '', '2016-05-11 06:34:05', 245, 2265, 'da3261722baa572f177a1a9a403c7faf1493be9a', '{"id":15,"asset_id":70,"title":"Department","alias":"department","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">\\u00a0include(\\"newfiles\\/admin\\/department.php\\");<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">start();<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-05-11 06:34:05","created_by":"245","created_by_alias":"","modified":"","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2016-05-11 06:34:05","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(49, 15, 1, '', '2016-05-12 05:18:25', 245, 2309, '8e216a77d9bb9a5aa7929f97039965de7b8a6ae7', '{"id":15,"asset_id":"70","title":"Department","alias":"department","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">\\u00a0include(\\"newfiles\\/admin\\/department.php\\");<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">\\/\\/start();<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-05-11 06:34:05","created_by":"245","created_by_alias":"","modified":"2016-05-12 05:18:25","modified_by":"245","checked_out":"245","checked_out_time":"2016-05-12 05:16:42","publish_up":"2016-05-11 06:34:05","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":2,"ordering":"0","metakey":"","metadesc":"","access":"1","hits":"124","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(50, 15, 1, '', '2016-05-12 05:24:54', 245, 3106, '4f93b9fd51bca896fb7652b33b08ea394d4ef027', '{"id":15,"asset_id":"70","title":"Department","alias":"department","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p>echo''&lt;form \\u00a0name=\\"xxxx\\" action=\\"\\" \\u00a0method=\\"post\\"&gt;<\\/p>\\r\\n<p>&lt;table&gt;<\\/p>\\r\\n<p>&lt;tr&gt;<\\/p>\\r\\n<p>&lt;td&gt; Department Name : &lt;\\/td&gt;<\\/p>\\r\\n<p>\\u00a0 \\u00a0  &lt;td&gt; &lt;input type=\\"text\\" name=\\"name\\" value=\\"isset($dep[0][\\"name\\"]) ? $dep[0][\\"name\\"] : \\"\\" ?&gt;\\" \\/&gt; &lt;\\/td&gt;<\\/p>\\r\\n<p>&lt;td&gt; Group : &lt;\\/td&gt;<\\/p>\\r\\n<p>\\u00a0 \\u00a0  &lt;td&gt; &lt;input type=\\"text\\" name=\\"group\\" value=\\"isset($dep[0][\\"group\\"]) ? $dep[0][\\"group\\"] : \\"\\" ?&gt;\\" \\/&gt; &lt;\\/td&gt;<\\/p>\\r\\n<p>\\u00a0 \\u00a0 \\u00a0 \\u00a0\\u00a0<\\/p>\\r\\n<p>\\u00a0 \\u00a0 \\u00a0 \\u00a0 &lt;input type=\\"hidden\\" name=\\"id\\" value=\\"&lt;?php echo isset($dep[0][\\"id\\"]) ? $dep[0][\\"id\\"] : \\"\\" ?&gt;\\" \\/&gt;<\\/p>\\r\\n<p>\\u00a0 \\u00a0 \\u00a0 \\u00a0 &lt;td&gt; &lt;input type=\\"submit\\" value=\\"Save\\" \\/&gt; &lt;\\/td&gt;<\\/p>\\r\\n<p>&lt;\\/tr&gt;\\u00a0<\\/p>\\r\\n<p>&lt;\\/table&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;\\/form&gt;'';<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-05-11 06:34:05","created_by":"245","created_by_alias":"","modified":"2016-05-12 05:24:54","modified_by":"245","checked_out":"245","checked_out_time":"2016-05-12 05:24:12","publish_up":"2016-05-11 06:34:05","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":3,"ordering":"0","metakey":"","metadesc":"","access":"1","hits":"129","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(51, 15, 1, '', '2016-05-12 05:26:00', 245, 2875, '6e2cd1e93d0163303eaab2444a15f2974b16e5a2', '{"id":15,"asset_id":"70","title":"Department","alias":"department","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p>echo''&lt;form \\u00a0name=\\"xxxx\\" action=\\"\\" \\u00a0method=\\"post\\"&gt;<\\/p>\\r\\n<p>&lt;table&gt;<\\/p>\\r\\n<p>&lt;tr&gt;<\\/p>\\r\\n<p>&lt;td&gt; Department Name : &lt;\\/td&gt;<\\/p>\\r\\n<p>\\u00a0 \\u00a0 &lt;td&gt; &lt;input type=\\"text\\" name=\\"name\\" value=\\"aa\\" \\/&gt; &lt;\\/td&gt;<\\/p>\\r\\n<p>&lt;td&gt; Group : &lt;\\/td&gt;<\\/p>\\r\\n<p>\\u00a0 \\u00a0 &lt;td&gt; &lt;input type=\\"text\\" name=\\"group\\" value=\\"vv\\" \\/&gt; &lt;\\/td&gt;<\\/p>\\r\\n<p>\\u00a0 \\u00a0 \\u00a0 \\u00a0\\u00a0<\\/p>\\r\\n<p>\\u00a0 \\u00a0 \\u00a0 \\u00a0\\u00a0<\\/p>\\r\\n<p>\\u00a0 \\u00a0 \\u00a0 \\u00a0 &lt;td&gt; &lt;input type=\\"submit\\" value=\\"Save\\" \\/&gt; &lt;\\/td&gt;<\\/p>\\r\\n<p>&lt;\\/tr&gt;\\u00a0<\\/p>\\r\\n<p>&lt;\\/table&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;\\/form&gt;'';<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-05-11 06:34:05","created_by":"245","created_by_alias":"","modified":"2016-05-12 05:26:00","modified_by":"245","checked_out":"245","checked_out_time":"2016-05-12 05:24:54","publish_up":"2016-05-11 06:34:05","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":4,"ordering":"0","metakey":"","metadesc":"","access":"1","hits":"129","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(52, 15, 1, '', '2016-05-12 05:28:15', 245, 2129, 'a8b5cc1fb5604887610a153799276318f97b84c4', '{"id":15,"asset_id":"70","title":"Department","alias":"department","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p>include\\"newfiles\\/admin\\/department.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-05-11 06:34:05","created_by":"245","created_by_alias":"","modified":"2016-05-12 05:28:15","modified_by":"245","checked_out":"245","checked_out_time":"2016-05-12 05:26:00","publish_up":"2016-05-11 06:34:05","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":5,"ordering":"0","metakey":"","metadesc":"","access":"1","hits":"133","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(53, 15, 1, '', '2016-05-12 07:39:12', 245, 2141, '0c74ce7e36b3c0feabdc9c8a85e4dd48ed92c423', '{"id":15,"asset_id":"70","title":"Department","alias":"department","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p>include\\"newfiles\\/admin\\/department\\/department.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-05-11 06:34:05","created_by":"245","created_by_alias":"","modified":"2016-05-12 07:39:12","modified_by":"245","checked_out":"245","checked_out_time":"2016-05-12 07:38:57","publish_up":"2016-05-11 06:34:05","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":6,"ordering":"0","metakey":"","metadesc":"","access":"1","hits":"158","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(54, 16, 1, '', '2016-05-13 07:07:35', 245, 2142, 'ed244bb18b21aa2b74c8e969f1bdbaac9834e70e', '{"id":16,"asset_id":71,"title":"Program","alias":"program","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px; line-height: 15.808px;\\">include\\"newfiles\\/admin\\/program\\/program.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-05-13 07:07:35","created_by":"245","created_by_alias":"","modified":"","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2016-05-13 07:07:35","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(55, 17, 1, '', '2016-05-13 12:09:02', 245, 2146, 'b5b54127dc4f0625cb21b9f89c801949cd565719', '{"id":17,"asset_id":72,"title":"Semester","alias":"semester","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px; line-height: 15.808px;\\">include\\"newfiles\\/admin\\/semester\\/semester.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-05-13 12:09:02","created_by":"245","created_by_alias":"","modified":"","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2016-05-13 12:09:02","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(57, 19, 1, '', '2016-05-18 04:51:12', 245, 2146, '44579caa9f94664a97ff7d4dfe335a46a0ab192d', '{"id":19,"asset_id":74,"title":"District","alias":"district","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px; line-height: 15.808px;\\">include\\"newfiles\\/admin\\/district\\/district.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-05-18 04:51:12","created_by":"245","created_by_alias":"","modified":"","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2016-05-18 04:51:12","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(58, 20, 1, '', '2016-05-18 04:51:34', 245, 2138, '0190302d893a7e27b20b5a98423bef89a9c68c73', '{"id":20,"asset_id":75,"title":"Tehsil","alias":"tehsil","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px; line-height: 15.808px;\\">include\\"newfiles\\/admin\\/tehsil\\/tehsil.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-05-18 04:51:34","created_by":"245","created_by_alias":"","modified":"","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2016-05-18 04:51:34","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(59, 21, 1, '', '2016-05-18 05:55:08', 245, 2140, 'd2bf45a1715525c9a9af550e439c660bdbf33b75', '{"id":21,"asset_id":76,"title":"Degrees","alias":"degrees","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px; line-height: 15.808px;\\">include\\"newfiles\\/admin\\/degree\\/degree.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-05-18 05:55:08","created_by":"245","created_by_alias":"","modified":"","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2016-05-18 05:55:08","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(63, 24, 1, '', '2016-05-30 05:58:51', 245, 1675, '3b08ee2b1981ebacb0655b6f6e07c7c53508234b', '{"id":24,"asset_id":79,"title":"User Permissions","alias":"user-permissions","introtext":"","fulltext":"","state":1,"catid":"2","created":"2016-05-30 05:58:51","created_by":"245","created_by_alias":"","modified":"","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2016-05-30 05:58:51","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(64, 24, 1, '', '2016-05-30 05:59:37', 245, 2210, 'd94371a0ebd4c2c279f14e1e1f3bd2d126f002d9', '{"id":24,"asset_id":"79","title":"User Permissions","alias":"user-permissions","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px; line-height: 15.808px;\\">include\\"newfiles\\/admin\\/permission\\/user_permissions.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-05-30 05:58:51","created_by":"245","created_by_alias":"","modified":"2016-05-30 05:59:37","modified_by":"245","checked_out":"245","checked_out_time":"2016-05-30 05:59:23","publish_up":"2016-05-30 05:58:51","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":2,"ordering":"0","metakey":"","metadesc":"","access":"1","hits":"0","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(95, 41, 1, '', '2016-07-27 10:46:03', 245, 2152, '5d371b2e41093431b745b44e1a4b10d85357b237', '{"id":41,"asset_id":96,"title":"Add Applicants","alias":"add-applicants","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px; line-height: 15.808px;\\">include\\"newfiles\\/jobs\\/add_applicant.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-07-27 10:46:03","created_by":"245","created_by_alias":"","modified":"","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2016-07-27 10:46:03","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(96, 42, 1, '', '2016-07-27 10:46:23', 245, 2161, 'dae703d6af08e7eee5c666069e75cdd1636cde72', '{"id":42,"asset_id":97,"title":"Applicant Evaluation","alias":"applicant-evaluation","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px; line-height: 15.808px;\\">include\\"newfiles\\/jobs\\/evaluation.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-07-27 10:46:23","created_by":"245","created_by_alias":"","modified":"","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2016-07-27 10:46:23","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(97, 43, 1, '', '2016-07-29 09:13:34', 245, 2148, '017929c60d7924270a1114e109a10bf8539a405d', '{"id":43,"asset_id":98,"title":"Merit List","alias":"merit-list","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px; line-height: 15.808px;\\">include\\"newfiles\\/jobs\\/merit\\/merit_list.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-07-29 09:13:34","created_by":"245","created_by_alias":"","modified":"","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2016-07-29 09:13:34","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(109, 54, 1, '', '2016-11-10 08:37:15', 245, 2027, '4f0a87616f970a8dd5c30705a60e50e90d3d5bae', '{"id":54,"asset_id":111,"title":"Create Evaluation","alias":"create-evaluation","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/evaluation\\/create_evaluation\\/evaluation.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-11-10 08:37:15","created_by":"245","created_by_alias":"","modified":"","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2016-11-10 08:37:15","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(110, 55, 1, '', '2016-11-10 08:37:30', 245, 2013, 'e62f9bb1512edc2e645c5106a8452e88d3a7ab61', '{"id":55,"asset_id":112,"title":"Evaluation Questions","alias":"evaluation-questions","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/evaluation\\/questions.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-11-10 08:37:30","created_by":"245","created_by_alias":"","modified":"","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2016-11-10 08:37:30","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(111, 56, 1, '', '2016-11-14 05:54:04', 245, 2021, 'd86a1f1965754bd2ba052edbdecff7bd25594385', '{"id":56,"asset_id":113,"title":"Check Evaluation List","alias":"check-evaluation-list","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/evaluation\\/check_eval_list.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-11-14 05:54:04","created_by":"245","created_by_alias":"","modified":"","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2016-11-14 05:54:04","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0);
INSERT INTO `s04cf_ucm_history` (`version_id`, `ucm_item_id`, `ucm_type_id`, `version_note`, `save_date`, `editor_user_id`, `character_count`, `sha1_hash`, `version_data`, `keep_forever`) VALUES
(112, 57, 1, '', '2016-11-16 06:41:50', 245, 2021, '986402081093a39704e06fae0bfa3401c6e16a72', '{"id":57,"asset_id":114,"title":"Evaluation Summary","alias":"evaluation-summary","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/evaluation\\/summary\\/eval_summary.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-11-16 06:41:50","created_by":"245","created_by_alias":"","modified":"","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2016-11-16 06:41:50","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(113, 58, 1, '', '2016-11-18 11:47:08', 245, 2036, '62f854318cf337fbc34b70fcaed1b92fd19b2006', '{"id":58,"asset_id":115,"title":"Evaluation Teacher Report","alias":"evaluation-teacher-report","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/evaluation\\/teacher_report\\/report.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2016-11-18 11:47:08","created_by":"245","created_by_alias":"","modified":"","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2016-11-18 11:47:08","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(180, 118, 1, '', '2018-01-23 11:03:40', 245, 2066, '26bcd386e0b8b44b14b0492f7be926d5733ca5b1', '{"id":118,"asset_id":177,"title":"View Directory","alias":"view-directory","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/telephone_directory\\/list_directory.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2018-01-23 11:03:40","created_by":"245","created_by_alias":"","modified":"2018-01-23 11:03:40","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2018-01-23 11:03:40","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"2","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(123, 66, 1, '', '2017-01-06 10:14:32', 245, 2227, '9acf7e2b56b0582daea5508acf5de578b346ba93', '{"id":66,"asset_id":123,"title":"Ldap Student Group","alias":"ldap-student-group","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px; line-height: 15.808px;\\">include\\"newfiles\\/ldap\\/student\\/create_group_account.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-01-06 10:14:32","created_by":"245","created_by_alias":"","modified":"2017-01-06 10:14:32","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-01-06 10:14:32","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(124, 67, 1, '', '2017-01-11 06:41:12', 245, 2247, '6d4a3e1d7adb01096758c06cb8af78e45d0eac96', '{"id":67,"asset_id":124,"title":"Ldap Create Faculty Account","alias":"ldap-create-faculty-account","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px; line-height: 15.808px;\\">include\\"newfiles\\/ldap\\/faculty\\/create_faculty_account.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-01-11 06:41:12","created_by":"245","created_by_alias":"","modified":"2017-01-11 06:41:12","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-01-11 06:41:12","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(126, 69, 1, '', '2017-01-11 06:51:26', 245, 2216, '1fc34790b0892433ecedbd159857bb729c3cf264', '{"id":69,"asset_id":126,"title":"User Activation","alias":"user-activation","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px; line-height: 15.808px;\\">include\\"newfiles\\/ldap\\/faculty\\/user_activation.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-01-11 06:51:26","created_by":"245","created_by_alias":"","modified":"2017-01-11 06:51:26","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-01-11 06:51:26","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(128, 71, 1, '', '2017-01-18 11:00:40', 245, 2207, '61580a3d9103c9550e8c6d2ea4549ed150a80f54', '{"id":71,"asset_id":129,"title":"Faculty List","alias":"faculty-list","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px; line-height: 15.808px;\\">include\\"newfiles\\/ldap\\/faculty\\/faculty_list.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-01-18 11:00:40","created_by":"245","created_by_alias":"","modified":"2017-01-18 11:00:40","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-01-18 11:00:40","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(129, 72, 1, '', '2017-01-19 11:14:36', 245, 2221, '1e733786e91f4c6d7a107e3df75316f5626ecc1d', '{"id":72,"asset_id":130,"title":"Faculty Edit Record","alias":"faculty-edit-record","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px; line-height: 15.808px;\\">include\\"newfiles\\/ldap\\/faculty\\/edit_recored.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-01-19 11:14:36","created_by":"245","created_by_alias":"","modified":"2017-01-19 11:14:36","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-01-19 11:14:36","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(130, 72, 1, '', '2017-01-19 11:19:15', 245, 2247, 'c6c3c81d7101e8b15d18fb60a19690ea69b7ef02', '{"id":72,"asset_id":"130","title":"Faculty Edit Record","alias":"faculty-edit-record","introtext":"<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px; line-height: 15.808px;\\">include\\"newfiles\\/ldap\\/faculty\\/faculty_edit_record.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.1599998474121px; line-height: 15.8079996109009px;\\">{\\/source}<\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-01-19 11:14:36","created_by":"245","created_by_alias":"","modified":"2017-01-19 11:19:15","modified_by":"245","checked_out":"245","checked_out_time":"2017-01-19 11:19:10","publish_up":"2017-01-19 11:14:36","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":2,"ordering":"0","metakey":"","metadesc":"","access":"1","hits":"0","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(133, 74, 1, '', '2017-02-14 08:25:14', 245, 1919, '0969483f5514d5cdd82ae1491cda932cead8ec9d', '{"id":74,"asset_id":132,"title":"Block Setting","alias":"block-setting","introtext":"<p>{source}<\\/p>\\r\\n<p>&lt;?php<\\/p>\\r\\n<p>include \\"newfiles\\/timeTable\\/blocks.php\\";\\u00a0<\\/p>\\r\\n<p>?&gt;<\\/p>\\r\\n<p>\\u00a0<\\/p>\\r\\n<p><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-02-14 08:25:14","created_by":"245","created_by_alias":"","modified":"2017-02-14 08:25:14","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-02-14 08:25:14","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(134, 75, 1, '', '2017-02-14 08:26:12', 245, 2094, '684294b87bd1715069d0d7d5d41edb4463931fd9', '{"id":75,"asset_id":133,"title":"Room Type","alias":"room-type","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/timeTable\\/room_type.php\\";\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-02-14 08:26:12","created_by":"245","created_by_alias":"","modified":"2017-02-14 08:26:12","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-02-14 08:26:12","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(135, 76, 1, '', '2017-02-14 08:26:35', 245, 2082, '99e6e5dde746347d3e1c429310eaa85103874e83', '{"id":76,"asset_id":134,"title":"Rooms","alias":"rooms","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/timeTable\\/rooms.php\\";\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-02-14 08:26:35","created_by":"245","created_by_alias":"","modified":"2017-02-14 08:26:35","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-02-14 08:26:35","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(136, 77, 1, '', '2017-02-14 08:27:01', 245, 2113, '7474258f840953dd654ace14ff805e2e4d7aa65c', '{"id":77,"asset_id":135,"title":"Room Allocation","alias":"room-allocation","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/timeTable\\/rooms_allocation.php\\";\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-02-14 08:27:01","created_by":"245","created_by_alias":"","modified":"2017-02-14 08:27:01","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-02-14 08:27:01","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(137, 78, 1, '', '2017-02-15 06:34:13', 245, 2108, 'b900e33633383e8ad6cb02624a7ea867326aff53', '{"id":78,"asset_id":136,"title":"Time Setting","alias":"time-setting","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/timeTable\\/timetable_setting.php\\";\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-02-15 06:34:13","created_by":"245","created_by_alias":"","modified":"2017-02-15 06:34:13","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-02-15 06:34:13","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(139, 80, 1, '', '2017-02-15 08:53:20', 245, 2111, '67cc7f312013c09945014284a5d6191aa6c5ae24', '{"id":80,"asset_id":138,"title":"Auto Generate","alias":"auto-generate","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/timeTable\\/auto_generation_tt.php\\";\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-02-15 08:53:20","created_by":"245","created_by_alias":"","modified":"2017-02-15 08:53:20","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-02-15 08:53:20","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"2","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(140, 81, 1, '', '2017-02-15 09:35:00', 245, 2069, 'f3366f37895484699140d9ff7cb1bfed1c7aa765', '{"id":81,"asset_id":139,"title":"Manual Time Table","alias":"manual-time-table","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/timeTable\\/manual_timetable.php\\";\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-02-15 09:35:00","created_by":"245","created_by_alias":"","modified":"2017-02-15 09:35:00","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-02-15 09:35:00","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"2","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(141, 82, 1, '', '2017-02-15 09:49:10', 245, 2069, 'ed6faa56aa29c57ef9b4378900a840c93e4f18a1', '{"id":82,"asset_id":140,"title":"Change Time Table","alias":"change-time-table","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/timeTable\\/change_timetable.php\\";\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-02-15 09:49:10","created_by":"245","created_by_alias":"","modified":"2017-02-15 09:49:10","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-02-15 09:49:10","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"2","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(142, 83, 1, '', '2017-02-15 10:17:35', 245, 2057, 'de456ded4af5b70747d65c693a11c423a083397d', '{"id":83,"asset_id":141,"title":"Swap Periods","alias":"swap-periods","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/timeTable\\/swap_timetable.php\\";\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-02-15 10:17:35","created_by":"245","created_by_alias":"","modified":"2017-02-15 10:17:35","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-02-15 10:17:35","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"2","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(146, 87, 1, '', '2017-02-17 06:08:28', 245, 2074, '7716101bdb63605d00a1ee9f5a05b6596997280a', '{"id":87,"asset_id":145,"title":"Unassigned Periods","alias":"unassigned-periods","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/timeTable\\/un_assigned_periods.php\\";\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-02-17 06:08:28","created_by":"245","created_by_alias":"","modified":"2017-02-17 06:08:28","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-02-17 06:08:28","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"2","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(153, 94, 1, '', '2017-02-22 13:19:07', 245, 2085, '15df64284d3e80df850e10374b0791ffa36fb7f0', '{"id":94,"asset_id":152,"title":"Add Code Contributions","alias":"add-code-contributions","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/code_contributions\\/contributions.php\\";\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-02-22 13:19:07","created_by":"245","created_by_alias":"","modified":"2017-02-22 13:19:07","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-02-22 13:19:07","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"2","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0);
INSERT INTO `s04cf_ucm_history` (`version_id`, `ucm_item_id`, `ucm_type_id`, `version_note`, `save_date`, `editor_user_id`, `character_count`, `sha1_hash`, `version_data`, `keep_forever`) VALUES
(156, 80, 1, '', '2017-02-24 10:17:07', 245, 2132, 'fac47367cc4e9c9a2e7bb93c20bc37344aa18b1f', '{"id":80,"asset_id":"138","title":"Auto Generate","alias":"auto-generate","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/timeTable\\/auto_generation_tt.php\\";\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-02-15 08:53:20","created_by":"245","created_by_alias":"","modified":"2017-02-24 10:17:07","modified_by":"245","checked_out":"245","checked_out_time":"2017-02-24 10:17:00","publish_up":"2017-02-15 08:53:20","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":3,"ordering":"15","metakey":"","metadesc":"","access":"2","hits":"66","metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(157, 96, 1, '', '2017-02-24 10:17:50', 245, 2114, '5cdcb65df2b63191bbc6abc04440a641d50d5095', '{"id":96,"asset_id":154,"title":"Empty Time Table","alias":"empty-time-table","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/timeTable\\/empty_timetable.php\\";\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-02-24 10:17:50","created_by":"245","created_by_alias":"","modified":"2017-02-24 10:17:50","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-02-24 10:17:50","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"2","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(159, 98, 1, '', '2017-03-08 07:50:03', 245, 2083, '578452bcd4b5a0d035d1aa1c82de386dff297676', '{"id":98,"asset_id":156,"title":"Islamic Calendar Setting","alias":"islamic-calendar-setting","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/event\\/lms_islamic_calandar.php\\";\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-03-08 07:50:03","created_by":"245","created_by_alias":"","modified":"2017-03-08 07:50:03","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-03-08 07:50:03","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"2","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(160, 99, 1, '', '2017-03-08 11:28:35', 245, 2049, '45f7a5213b2ea6c6ab0e5df251fce33f431249be', '{"id":99,"asset_id":157,"title":"Add Events","alias":"add-events","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/event\\/lms_add_events.php\\";\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-03-08 11:28:35","created_by":"245","created_by_alias":"","modified":"2017-03-08 11:28:35","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-03-08 11:28:35","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"2","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(161, 100, 1, '', '2017-03-08 11:37:00', 245, 2056, '83d438c5d09aaa5b05132cd45b55bcc64cb05f0f', '{"id":100,"asset_id":158,"title":"Add Holidays","alias":"add-holidays","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/event\\/lms_add_holidays.php\\";\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-03-08 11:37:00","created_by":"245","created_by_alias":"","modified":"2017-03-08 11:37:00","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-03-08 11:37:00","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"2","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(164, 103, 1, '', '2017-03-13 13:07:03', 245, 2080, '301563979e4e891938d545b37746c978a83f8175', '{"id":103,"asset_id":161,"title":"Empty Timetable Date","alias":"empty-timetable-date","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/timeTable\\/empty_timetable_date.php\\";\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-03-13 13:07:03","created_by":"245","created_by_alias":"","modified":"2017-03-13 13:07:03","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-03-13 13:07:03","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"1","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(165, 104, 1, '', '2017-04-07 09:02:41', 245, 2068, 'b346db45a46c37aa021158a820ba3e9a57f4718c', '{"id":104,"asset_id":162,"title":"Manual Datesheet","alias":"manual-datesheet","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/timeTable\\/manual_datesheet.php\\";\\u00a0<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-04-07 09:02:41","created_by":"245","created_by_alias":"","modified":"2017-04-07 09:02:41","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-04-07 09:02:41","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"2","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(176, 114, 1, '', '2017-07-08 11:44:43', 245, 2078, '086bf9f1eacf253652f81871fba556c68e5720ce', '{"id":114,"asset_id":172,"title":"Telephone Category","alias":"telephone-category","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/telephone_directory\\/category\\/category.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-07-08 11:44:43","created_by":"245","created_by_alias":"","modified":"2017-07-08 11:44:43","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-07-08 11:44:43","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"2","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0),
(177, 115, 1, '', '2017-07-12 09:28:32', 245, 2057, '9db66a996d65389964b185927958e3af00398de9', '{"id":115,"asset_id":173,"title":"Add Contact","alias":"add-contact","introtext":"<p style=\\"font-size: 12.16px;\\">{source}<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">&lt;?php<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">include \\"newfiles\\/telephone_directory\\/add_contact.php\\";<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\">?&gt;<\\/p>\\r\\n<p style=\\"font-size: 12.16px;\\"><span style=\\"font-size: 12.16px;\\">{\\/source}<\\/span><\\/p>","fulltext":"","state":1,"catid":"2","created":"2017-07-12 09:28:32","created_by":"245","created_by_alias":"","modified":"2017-07-12 09:28:32","modified_by":null,"checked_out":null,"checked_out_time":null,"publish_up":"2017-07-12 09:28:32","publish_down":"0000-00-00 00:00:00","images":"{\\"image_intro\\":\\"\\",\\"float_intro\\":\\"\\",\\"image_intro_alt\\":\\"\\",\\"image_intro_caption\\":\\"\\",\\"image_fulltext\\":\\"\\",\\"float_fulltext\\":\\"\\",\\"image_fulltext_alt\\":\\"\\",\\"image_fulltext_caption\\":\\"\\"}","urls":"{\\"urla\\":false,\\"urlatext\\":\\"\\",\\"targeta\\":\\"\\",\\"urlb\\":false,\\"urlbtext\\":\\"\\",\\"targetb\\":\\"\\",\\"urlc\\":false,\\"urlctext\\":\\"\\",\\"targetc\\":\\"\\"}","attribs":"{\\"show_title\\":\\"\\",\\"link_titles\\":\\"\\",\\"show_tags\\":\\"\\",\\"show_intro\\":\\"\\",\\"info_block_position\\":\\"\\",\\"info_block_show_title\\":\\"\\",\\"show_category\\":\\"\\",\\"link_category\\":\\"\\",\\"show_parent_category\\":\\"\\",\\"link_parent_category\\":\\"\\",\\"show_author\\":\\"\\",\\"link_author\\":\\"\\",\\"show_create_date\\":\\"\\",\\"show_modify_date\\":\\"\\",\\"show_publish_date\\":\\"\\",\\"show_item_navigation\\":\\"\\",\\"show_icons\\":\\"\\",\\"show_print_icon\\":\\"\\",\\"show_email_icon\\":\\"\\",\\"show_vote\\":\\"\\",\\"show_hits\\":\\"\\",\\"show_noauth\\":\\"\\",\\"urls_position\\":\\"\\",\\"alternative_readmore\\":\\"\\",\\"article_layout\\":\\"\\",\\"show_publishing_options\\":\\"\\",\\"show_article_options\\":\\"\\",\\"show_urls_images_backend\\":\\"\\",\\"show_urls_images_frontend\\":\\"\\",\\"extra-class\\":\\"\\"}","version":1,"ordering":null,"metakey":"","metadesc":"","access":"2","hits":null,"metadata":"{\\"robots\\":\\"\\",\\"author\\":\\"\\",\\"rights\\":\\"\\",\\"xreference\\":\\"\\"}","featured":"0","language":"*","xreference":""}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_updates`
--

CREATE TABLE `s04cf_updates` (
  `update_id` int(11) NOT NULL,
  `update_site_id` int(11) DEFAULT '0',
  `extension_id` int(11) DEFAULT '0',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `element` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `folder` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `client_id` tinyint(3) DEFAULT '0',
  `version` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `data` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailsurl` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `infourl` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_query` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Available Updates';

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_update_sites`
--

CREATE TABLE `s04cf_update_sites` (
  `update_site_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `location` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` int(11) DEFAULT '0',
  `last_check_timestamp` bigint(20) DEFAULT '0',
  `extra_query` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Update Sites';

--
-- Dumping data for table `s04cf_update_sites`
--

INSERT INTO `s04cf_update_sites` (`update_site_id`, `name`, `type`, `location`, `enabled`, `last_check_timestamp`, `extra_query`) VALUES
(1, 'Joomla! Core', 'collection', 'https://update.joomla.org/core/list.xml', 1, 1516707007, ''),
(2, 'Joomla! Extension Directory', 'collection', 'https://update.joomla.org/jed/list.xml', 0, 0, ''),
(3, 'Accredited Joomla! Translations', 'collection', 'https://update.joomla.org/language/translationlist_3.xml', 0, 0, ''),
(4, 'Joomla! Update Component Update Site', 'extension', 'https://update.joomla.org/core/extensions/com_joomlaupdate.xml', 0, 0, ''),
(5, 'NoNumber Sourcerer', 'extension', 'http://download.nonumber.nl/updates.php?e=sourcerer&type=.zip', 0, 0, ''),
(6, '', 'collection', 'http://update.joomlart.com/service/tracking/list.xml', 0, 0, ''),
(7, 'Accordeon Menu CK Update', 'extension', 'http://update.joomlack.fr/mod_accordeonck_update.xml', 0, 0, ''),
(8, 'Weblinks Update Site', 'extension', 'https://raw.githubusercontent.com/joomla-extensions/weblinks/master/manifest.xml', 1, 1516707020, '');

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_update_sites_extensions`
--

CREATE TABLE `s04cf_update_sites_extensions` (
  `update_site_id` int(11) NOT NULL DEFAULT '0',
  `extension_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Links extensions to update sites';

--
-- Dumping data for table `s04cf_update_sites_extensions`
--

INSERT INTO `s04cf_update_sites_extensions` (`update_site_id`, `extension_id`) VALUES
(1, 700),
(2, 700),
(3, 802),
(4, 28),
(6, 10003),
(6, 10004),
(7, 10005),
(8, 801);

-- --------------------------------------------------------

--
-- Stand-in structure for view `s04cf_usergroups`
--
CREATE TABLE `s04cf_usergroups` (
`id` int(10) unsigned
,`parent_id` int(10) unsigned
,`lft` int(11)
,`rgt` int(11)
,`title` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `s04cf_users`
--
CREATE TABLE `s04cf_users` (
`id` int(11)
,`name` varchar(400)
,`username` varchar(150)
,`email` varchar(100)
,`password` varchar(100)
,`block` tinyint(4)
,`sendEmail` tinyint(4)
,`registerDate` datetime
,`lastvisitDate` datetime
,`activation` varchar(100)
,`params` mediumtext
,`lastResetTime` datetime
,`resetCount` int(11)
,`otpKey` varchar(1000)
,`otep` varchar(1000)
,`requireReset` tinyint(4)
);

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_user_keys`
--

CREATE TABLE `s04cf_user_keys` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `series` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invalid` tinyint(4) NOT NULL,
  `time` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uastring` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_user_keys`
--

INSERT INTO `s04cf_user_keys` (`id`, `user_id`, `token`, `series`, `invalid`, `time`, `uastring`) VALUES
(112, 'safeer', '$2y$10$gnWMDIGJssjHiNqNNS74pe0SFXlUwsP2J5YO0CnxnKX3xoHBkfhhi', '2TJwpTaheZoH3aN8E7sW', 0, '1504767389', 'joomla_remember_me_a7c48eb2befa708cba41b88abc082c7b'),
(114, 'shujaat.ali', '$2y$10$p1CvRttJVv1de.VejHrADOnZ9uij24Uh6ZnPFbQMBz3UuSZmzmxSO', '1YO778bTvmFznCWPLMl5', 0, '1505025728', 'joomla_remember_me_685286ccdde4ed93865a02c0e3e4f3a6'),
(115, 'safeer', '$2y$10$T78RaGrAKuig7253jKW/heY9xjRr7x/v8La3TfJieM5OhiBDGPEwW', 'xy63MD0ksJ9aauw4WL1O', 0, '1505111922', 'joomla_remember_me_e0dc633dea538c9b09ee8215732424a5'),
(116, 'ammarah', '$2y$10$mX.THc1jpWIkKwglTBver.IMbaHDSX32hxb9sxkBGkgZ6YMoievYa', 'qM7rdPoNpsyVy0sznLp0', 0, '1505205432', 'joomla_remember_me_3d4c8175450ba49a919004c3cea6fb30'),
(117, 'shujaat.ali', '$2y$10$Am0AlHBK.zfzQBKFhU/fveOmNZMQZbvN0VYJKZQXXL.eOi1fLZXQi', 'jR2O4hSJyGQfWW8L9xhF', 0, '1505212639', 'joomla_remember_me_6de54b4d4732b1d086d92a015182dec8'),
(109, 'ibrahim', '$2y$10$9v2ir0W60eeeHBRKlF10k.bRz1zf8IHqWQaF85aoTE9/bt30kg84u', 'ZTk6Y3eLgvDlaq1vJICm', 0, '1503295306', 'joomla_remember_me_e0dc633dea538c9b09ee8215732424a5'),
(121, 'imtiaz', '$2y$10$7Y0xQZ74roJZ6SPYi0aczurDXEWLn.ISlCr3i3p2xzW0j/WvkmIpC', 'PHGah10IlW4STCXALTux', 0, '1505728190', 'joomla_remember_me_8ab9efbde1d0ad3f7517f2bc856a85fd'),
(113, 'shujaat.ali', '$2y$10$iF1OvRzR5G8mcUX.LaiCQeSHEfA/lRjijYSwsftGxjwyA.L/IEENm', '9qsTTFFegbnbHOoCwHDV', 0, '1504951449', 'joomla_remember_me_29b9ec9298111ccaf5ba9dfef83206f5'),
(110, 'Ashraf', '$2y$10$vHaMqYJoZU4Em0t9kaqOdOo8R/PruobHeOdbZsSQrAdMgEz7jlSVO', 'bnovMriJGYg6HxEdZz5f', 0, '1504347397', 'joomla_remember_me_9512130a81d60cbefb117268f7fc2aae'),
(106, 'zakir.hussain', '$2y$10$4UqyNCe4B0jt10BgigsqV.auaPb1Mxqi.6g0OpmWxoFf5DFTZPGxu', '2xx8RDCNqegewh4WoS10', 0, '1501918873', 'joomla_remember_me_6de54b4d4732b1d086d92a015182dec8');

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_user_notes`
--

CREATE TABLE `s04cf_user_notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `catid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `body` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) UNSIGNED NOT NULL,
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `review_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_user_profiles`
--

CREATE TABLE `s04cf_user_profiles` (
  `user_id` int(11) NOT NULL,
  `profile_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Simple user profile storage table';

-- --------------------------------------------------------

--
-- Stand-in structure for view `s04cf_user_usergroup_map`
--
CREATE TABLE `s04cf_user_usergroup_map` (
`user_id` int(10) unsigned
,`group_id` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_utf8_conversion`
--

CREATE TABLE `s04cf_utf8_conversion` (
  `converted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s04cf_utf8_conversion`
--

INSERT INTO `s04cf_utf8_conversion` (`converted`) VALUES
(2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `s04cf_viewlevels`
--
CREATE TABLE `s04cf_viewlevels` (
`id` int(10) unsigned
,`title` varchar(100)
,`ordering` int(11)
,`rules` varchar(5120)
);

-- --------------------------------------------------------

--
-- Table structure for table `s04cf_weblinks`
--

CREATE TABLE `s04cf_weblinks` (
  `id` int(10) UNSIGNED NOT NULL,
  `catid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `language` char(7) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Set if link is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `version` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `images` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure for view `job_app_equ_qual`
--
DROP TABLE IF EXISTS `job_app_equ_qual`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `job_app_equ_qual`  AS  select `job_app_equ_qual`.`app_id` AS `app_id`,`job_app_equ_qual`.`name` AS `name`,`job_app_equ_qual`.`is_eligible` AS `is_eligible`,`job_app_equ_qual`.`reason` AS `reason`,`job_app_equ_qual`.`obt_marks` AS `obt_marks`,`job_app_equ_qual`.`total_marks` AS `total_marks`,`job_app_equ_qual`.`obt_gpa` AS `obt_gpa`,`job_app_equ_qual`.`total_gpa` AS `total_gpa`,`job_app_equ_qual`.`percentage` AS `percentage`,`job_app_equ_qual`.`division` AS `division`,`job_app_equ_qual`.`equivalent_to` AS `equivalent_to` from `uobs-db`.`job_app_equ_qual` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_admin_departments`
--
DROP TABLE IF EXISTS `kiusc_admin_departments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_admin_departments`  AS  select `uobs-db`.`kiusc_admin_departments`.`id` AS `id`,`uobs-db`.`kiusc_admin_departments`.`name` AS `name` from `uobs-db`.`kiusc_admin_departments` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_admissions`
--
DROP TABLE IF EXISTS `kiusc_admissions`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_admissions`  AS  select `uobs-db`.`kiusc_admissions`.`id` AS `id`,`uobs-db`.`kiusc_admissions`.`title` AS `title`,`uobs-db`.`kiusc_admissions`.`detail` AS `detail`,`uobs-db`.`kiusc_admissions`.`advertisement_date` AS `advertisement_date`,`uobs-db`.`kiusc_admissions`.`last_date` AS `last_date`,`uobs-db`.`kiusc_admissions`.`year` AS `year`,`uobs-db`.`kiusc_admissions`.`active` AS `active`,`uobs-db`.`kiusc_admissions`.`approval_id` AS `approval_id`,`uobs-db`.`kiusc_admissions`.`sem_id` AS `sem_id` from `uobs-db`.`kiusc_admissions` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_admi_applicants`
--
DROP TABLE IF EXISTS `kiusc_admi_applicants`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_admi_applicants`  AS  select `uobs-db`.`kiusc_admi_applicants`.`id` AS `id`,`uobs-db`.`kiusc_admi_applicants`.`application_no` AS `application_no`,`uobs-db`.`kiusc_admi_applicants`.`name` AS `name`,`uobs-db`.`kiusc_admi_applicants`.`fname` AS `fname`,`uobs-db`.`kiusc_admi_applicants`.`guardian_name` AS `guardian_name`,`uobs-db`.`kiusc_admi_applicants`.`dob` AS `dob`,`uobs-db`.`kiusc_admi_applicants`.`cnic` AS `cnic`,`uobs-db`.`kiusc_admi_applicants`.`postal_address` AS `postal_address`,`uobs-db`.`kiusc_admi_applicants`.`permanent_address` AS `permanent_address`,`uobs-db`.`kiusc_admi_applicants`.`district_id` AS `district_id`,`uobs-db`.`kiusc_admi_applicants`.`tehsil_id` AS `tehsil_id`,`uobs-db`.`kiusc_admi_applicants`.`village` AS `village`,`uobs-db`.`kiusc_admi_applicants`.`father_occupation` AS `father_occupation`,`uobs-db`.`kiusc_admi_applicants`.`guardian_occupation` AS `guardian_occupation`,`uobs-db`.`kiusc_admi_applicants`.`father_phone` AS `father_phone`,`uobs-db`.`kiusc_admi_applicants`.`guardian_phone` AS `guardian_phone`,`uobs-db`.`kiusc_admi_applicants`.`email` AS `email`,`uobs-db`.`kiusc_admi_applicants`.`cell_no` AS `cell_no`,`uobs-db`.`kiusc_admi_applicants`.`gender` AS `gender`,`uobs-db`.`kiusc_admi_applicants`.`priority1` AS `priority1`,`uobs-db`.`kiusc_admi_applicants`.`prefer_p1` AS `prefer_p1`,`uobs-db`.`kiusc_admi_applicants`.`priority2` AS `priority2`,`uobs-db`.`kiusc_admi_applicants`.`prefer_p2` AS `prefer_p2`,`uobs-db`.`kiusc_admi_applicants`.`priority3` AS `priority3`,`uobs-db`.`kiusc_admi_applicants`.`prefer_p3` AS `prefer_p3`,`uobs-db`.`kiusc_admi_applicants`.`priority4` AS `priority4`,`uobs-db`.`kiusc_admi_applicants`.`prefer_p4` AS `prefer_p4`,`uobs-db`.`kiusc_admi_applicants`.`is_eligible_p1` AS `is_eligible_p1`,`uobs-db`.`kiusc_admi_applicants`.`is_eligible_p2` AS `is_eligible_p2`,`uobs-db`.`kiusc_admi_applicants`.`is_eligible_p3` AS `is_eligible_p3`,`uobs-db`.`kiusc_admi_applicants`.`is_eligible_p4` AS `is_eligible_p4`,`uobs-db`.`kiusc_admi_applicants`.`picture` AS `picture`,`uobs-db`.`kiusc_admi_applicants`.`remarks` AS `remarks`,`uobs-db`.`kiusc_admi_applicants`.`admission_id` AS `admission_id`,`uobs-db`.`kiusc_admi_applicants`.`hafiz` AS `hafiz`,`uobs-db`.`kiusc_admi_applicants`.`sports` AS `sports`,`uobs-db`.`kiusc_admi_applicants`.`special_person` AS `special_person`,`uobs-db`.`kiusc_admi_applicants`.`army` AS `army`,`uobs-db`.`kiusc_admi_applicants`.`is_gb_domicile` AS `is_gb_domicile`,`uobs-db`.`kiusc_admi_applicants`.`level` AS `level` from `uobs-db`.`kiusc_admi_applicants` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_admi_app_merit`
--
DROP TABLE IF EXISTS `kiusc_admi_app_merit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_admi_app_merit`  AS  select `uobs-db`.`kiusc_admi_app_merit`.`id` AS `id`,`uobs-db`.`kiusc_admi_app_merit`.`app_id` AS `app_id`,`uobs-db`.`kiusc_admi_app_merit`.`merit_id` AS `merit_id`,`uobs-db`.`kiusc_admi_app_merit`.`score` AS `score`,`uobs-db`.`kiusc_admi_app_merit`.`status` AS `status`,`uobs-db`.`kiusc_admi_app_merit`.`priority_no` AS `priority_no`,`uobs-db`.`kiusc_admi_app_merit`.`challan_no` AS `challan_no`,`uobs-db`.`kiusc_admi_app_merit`.`amount` AS `amount`,`uobs-db`.`kiusc_admi_app_merit`.`submit_date` AS `submit_date`,`uobs-db`.`kiusc_admi_app_merit`.`paid` AS `paid` from `uobs-db`.`kiusc_admi_app_merit` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_admi_criteria`
--
DROP TABLE IF EXISTS `kiusc_admi_criteria`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_admi_criteria`  AS  select `uobs-db`.`kiusc_admi_criteria`.`id` AS `id`,`uobs-db`.`kiusc_admi_criteria`.`level` AS `level`,`uobs-db`.`kiusc_admi_criteria`.`ssc` AS `ssc`,`uobs-db`.`kiusc_admi_criteria`.`hssc` AS `hssc`,`uobs-db`.`kiusc_admi_criteria`.`bachelor` AS `bachelor`,`uobs-db`.`kiusc_admi_criteria`.`master` AS `master`,`uobs-db`.`kiusc_admi_criteria`.`prefer` AS `prefer`,`uobs-db`.`kiusc_admi_criteria`.`admission_id` AS `admission_id` from `uobs-db`.`kiusc_admi_criteria` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_admi_merit_list`
--
DROP TABLE IF EXISTS `kiusc_admi_merit_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_admi_merit_list`  AS  select `uobs-db`.`kiusc_admi_merit_list`.`id` AS `id`,`uobs-db`.`kiusc_admi_merit_list`.`prog_id` AS `prog_id`,`uobs-db`.`kiusc_admi_merit_list`.`description` AS `description`,`uobs-db`.`kiusc_admi_merit_list`.`display_date` AS `display_date`,`uobs-db`.`kiusc_admi_merit_list`.`last_date` AS `last_date`,`uobs-db`.`kiusc_admi_merit_list`.`admission_id` AS `admission_id` from `uobs-db`.`kiusc_admi_merit_list` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_admi_prov_merit`
--
DROP TABLE IF EXISTS `kiusc_admi_prov_merit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_admi_prov_merit`  AS  select `uobs-db`.`kiusc_admi_prov_merit`.`id` AS `id`,`uobs-db`.`kiusc_admi_prov_merit`.`app_id` AS `app_id`,`uobs-db`.`kiusc_admi_prov_merit`.`prog_id` AS `prog_id`,`uobs-db`.`kiusc_admi_prov_merit`.`score` AS `score`,`uobs-db`.`kiusc_admi_prov_merit`.`status` AS `status`,`uobs-db`.`kiusc_admi_prov_merit`.`priority_no` AS `priority_no` from `uobs-db`.`kiusc_admi_prov_merit` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_admi_qualifications`
--
DROP TABLE IF EXISTS `kiusc_admi_qualifications`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_admi_qualifications`  AS  select `uobs-db`.`kiusc_admi_qualifications`.`id` AS `id`,`uobs-db`.`kiusc_admi_qualifications`.`app_id` AS `app_id`,`uobs-db`.`kiusc_admi_qualifications`.`degree_id` AS `degree_id`,`uobs-db`.`kiusc_admi_qualifications`.`year` AS `year`,`uobs-db`.`kiusc_admi_qualifications`.`division` AS `division`,`uobs-db`.`kiusc_admi_qualifications`.`obt_marks` AS `obt_marks`,`uobs-db`.`kiusc_admi_qualifications`.`total_marks` AS `total_marks`,`uobs-db`.`kiusc_admi_qualifications`.`obt_gpa` AS `obt_gpa`,`uobs-db`.`kiusc_admi_qualifications`.`total_gpa` AS `total_gpa`,`uobs-db`.`kiusc_admi_qualifications`.`major_subjects` AS `major_subjects`,`uobs-db`.`kiusc_admi_qualifications`.`board` AS `board` from `uobs-db`.`kiusc_admi_qualifications` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_admi_quota`
--
DROP TABLE IF EXISTS `kiusc_admi_quota`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_admi_quota`  AS  select `uobs-db`.`kiusc_admi_quota`.`id` AS `id`,`uobs-db`.`kiusc_admi_quota`.`prog_id` AS `prog_id`,`uobs-db`.`kiusc_admi_quota`.`no_of_seats` AS `no_of_seats`,`uobs-db`.`kiusc_admi_quota`.`out_of_gb_per` AS `out_of_gb_per`,`uobs-db`.`kiusc_admi_quota`.`gb_per` AS `gb_per`,`uobs-db`.`kiusc_admi_quota`.`admission_id` AS `admission_id` from `uobs-db`.`kiusc_admi_quota` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_admi_score`
--
DROP TABLE IF EXISTS `kiusc_admi_score`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_admi_score`  AS  select `uobs-db`.`kiusc_admi_score`.`id` AS `id`,`uobs-db`.`kiusc_admi_score`.`app_id` AS `app_id`,`uobs-db`.`kiusc_admi_score`.`score` AS `score`,`uobs-db`.`kiusc_admi_score`.`prog_id` AS `prog_id` from `uobs-db`.`kiusc_admi_score` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_approvals`
--
DROP TABLE IF EXISTS `kiusc_approvals`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_approvals`  AS  select `uobs-db`.`kiusc_approvals`.`id` AS `id`,`uobs-db`.`kiusc_approvals`.`attachment` AS `attachment`,`uobs-db`.`kiusc_approvals`.`title` AS `title`,`uobs-db`.`kiusc_approvals`.`date` AS `date`,`uobs-db`.`kiusc_approvals`.`type` AS `type` from `uobs-db`.`kiusc_approvals` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_attendance_students`
--
DROP TABLE IF EXISTS `kiusc_attendance_students`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_attendance_students`  AS  select `uobs-db`.`kiusc_attendance_students`.`id` AS `id`,`uobs-db`.`kiusc_attendance_students`.`std_id` AS `std_id`,`uobs-db`.`kiusc_attendance_students`.`lecture_id` AS `lecture_id`,`uobs-db`.`kiusc_attendance_students`.`status` AS `status` from `uobs-db`.`kiusc_attendance_students` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_banks`
--
DROP TABLE IF EXISTS `kiusc_banks`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_banks`  AS  select `uobs-db`.`kiusc_banks`.`id` AS `id`,`uobs-db`.`kiusc_banks`.`bank_name` AS `bank_name`,`uobs-db`.`kiusc_banks`.`account_no` AS `account_no` from `uobs-db`.`kiusc_banks` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_bank_cheqs`
--
DROP TABLE IF EXISTS `kiusc_bank_cheqs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_bank_cheqs`  AS  select `uobs-db`.`kiusc_bank_cheqs`.`id` AS `id`,`uobs-db`.`kiusc_bank_cheqs`.`chq_book_id` AS `chq_book_id`,`uobs-db`.`kiusc_bank_cheqs`.`chq_no` AS `chq_no`,`uobs-db`.`kiusc_bank_cheqs`.`status` AS `status` from `uobs-db`.`kiusc_bank_cheqs` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_bank_cheq_books`
--
DROP TABLE IF EXISTS `kiusc_bank_cheq_books`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_bank_cheq_books`  AS  select `uobs-db`.`kiusc_bank_cheq_books`.`id` AS `id`,`uobs-db`.`kiusc_bank_cheq_books`.`bank_id` AS `bank_id`,`uobs-db`.`kiusc_bank_cheq_books`.`chq_prefix` AS `chq_prefix`,`uobs-db`.`kiusc_bank_cheq_books`.`chq_no_from` AS `chq_no_from`,`uobs-db`.`kiusc_bank_cheq_books`.`chq_no_to` AS `chq_no_to` from `uobs-db`.`kiusc_bank_cheq_books` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_blocks`
--
DROP TABLE IF EXISTS `kiusc_blocks`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_blocks`  AS  select `uobs-db`.`kiusc_blocks`.`id` AS `id`,`uobs-db`.`kiusc_blocks`.`block_name` AS `block_name`,`uobs-db`.`kiusc_blocks`.`block_number` AS `block_number` from `uobs-db`.`kiusc_blocks` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_coffer_sp`
--
DROP TABLE IF EXISTS `kiusc_coffer_sp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_coffer_sp`  AS  select `kiusc_coffer_sp`.`id` AS `id`,`kiusc_coffer_sp`.`prog_id` AS `prog_id`,`kiusc_coffer_sp`.`sem_id` AS `sem_id`,`kiusc_coffer_sp`.`course_id` AS `course_id`,`kiusc_coffer_sp`.`fac_id` AS `fac_id`,`kiusc_coffer_sp`.`eva_cat_id` AS `eva_cat_id`,`kiusc_coffer_sp`.`sp_id` AS `sp_id` from `uobs-db`.`kiusc_coffer_sp` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_contributions`
--
DROP TABLE IF EXISTS `kiusc_contributions`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_contributions`  AS  select `uobs-db`.`kiusc_contributions`.`id` AS `id`,`uobs-db`.`kiusc_contributions`.`name` AS `name`,`uobs-db`.`kiusc_contributions`.`designation` AS `designation`,`uobs-db`.`kiusc_contributions`.`description` AS `description`,`uobs-db`.`kiusc_contributions`.`picture` AS `picture`,`uobs-db`.`kiusc_contributions`.`priority` AS `priority` from `uobs-db`.`kiusc_contributions` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_correction_token`
--
DROP TABLE IF EXISTS `kiusc_correction_token`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_correction_token`  AS  select `uobs-db`.`kiusc_correction_token`.`token_no` AS `token_no`,`uobs-db`.`kiusc_correction_token`.`reg_no` AS `reg_no`,`uobs-db`.`kiusc_correction_token`.`c_offer_id` AS `c_offer_id`,`uobs-db`.`kiusc_correction_token`.`is_used` AS `is_used`,`uobs-db`.`kiusc_correction_token`.`user_id` AS `user_id` from `uobs-db`.`kiusc_correction_token` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_courses`
--
DROP TABLE IF EXISTS `kiusc_courses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_courses`  AS  select `uobs-db`.`kiusc_courses`.`id` AS `id`,`uobs-db`.`kiusc_courses`.`name` AS `name`,`uobs-db`.`kiusc_courses`.`prog_name` AS `prog_name`,`uobs-db`.`kiusc_courses`.`dept_id` AS `dept_id`,`uobs-db`.`kiusc_courses`.`pre_req1` AS `pre_req1`,`uobs-db`.`kiusc_courses`.`pre_req2` AS `pre_req2`,`uobs-db`.`kiusc_courses`.`pre_req3` AS `pre_req3`,`uobs-db`.`kiusc_courses`.`cr_hours` AS `cr_hours`,`uobs-db`.`kiusc_courses`.`course_code` AS `course_code`,`uobs-db`.`kiusc_courses`.`course_abbreviation` AS `course_abbreviation` from `uobs-db`.`kiusc_courses` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_course_offered`
--
DROP TABLE IF EXISTS `kiusc_course_offered`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_course_offered`  AS  select `uobs-db`.`kiusc_course_offered`.`id` AS `id`,`uobs-db`.`kiusc_course_offered`.`prog_id` AS `prog_id`,`uobs-db`.`kiusc_course_offered`.`sem_id` AS `sem_id`,`uobs-db`.`kiusc_course_offered`.`course_id` AS `course_id`,`uobs-db`.`kiusc_course_offered`.`fac_id` AS `fac_id`,`uobs-db`.`kiusc_course_offered`.`eva_cat_id` AS `eva_cat_id` from `uobs-db`.`kiusc_course_offered` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_course_offered_detail`
--
DROP TABLE IF EXISTS `kiusc_course_offered_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_course_offered_detail`  AS  select `uobs-db`.`kiusc_course_offered_detail`.`id` AS `id`,`uobs-db`.`kiusc_course_offered_detail`.`c_offer_id` AS `c_offer_id`,`uobs-db`.`kiusc_course_offered_detail`.`description` AS `description`,`uobs-db`.`kiusc_course_offered_detail`.`outcomes` AS `outcomes`,`uobs-db`.`kiusc_course_offered_detail`.`readings` AS `readings`,`uobs-db`.`kiusc_course_offered_detail`.`requirements` AS `requirements` from `uobs-db`.`kiusc_course_offered_detail` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_course_reg`
--
DROP TABLE IF EXISTS `kiusc_course_reg`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_course_reg`  AS  select `uobs-db`.`kiusc_course_reg`.`id` AS `id`,`uobs-db`.`kiusc_course_reg`.`student_id` AS `student_id`,`uobs-db`.`kiusc_course_reg`.`sem_id` AS `sem_id`,`uobs-db`.`kiusc_course_reg`.`c_offered1_id` AS `c_offered1_id`,`uobs-db`.`kiusc_course_reg`.`c_offered2_id` AS `c_offered2_id`,`uobs-db`.`kiusc_course_reg`.`c_offered3_id` AS `c_offered3_id`,`uobs-db`.`kiusc_course_reg`.`c_offered4_id` AS `c_offered4_id`,`uobs-db`.`kiusc_course_reg`.`c_offered5_id` AS `c_offered5_id`,`uobs-db`.`kiusc_course_reg`.`c_offered6_id` AS `c_offered6_id`,`uobs-db`.`kiusc_course_reg`.`c_offered7_id` AS `c_offered7_id`,`uobs-db`.`kiusc_course_reg`.`c_offered8_id` AS `c_offered8_id` from `uobs-db`.`kiusc_course_reg` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_datesheet`
--
DROP TABLE IF EXISTS `kiusc_datesheet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_datesheet`  AS  select `uobs-db`.`kiusc_datesheet`.`id` AS `id`,`uobs-db`.`kiusc_datesheet`.`sem_id` AS `sem_id`,`uobs-db`.`kiusc_datesheet`.`c_offer_id` AS `c_offer_id`,`uobs-db`.`kiusc_datesheet`.`room_id` AS `room_id`,`uobs-db`.`kiusc_datesheet`.`fac_id` AS `fac_id`,`uobs-db`.`kiusc_datesheet`.`date` AS `date`,`uobs-db`.`kiusc_datesheet`.`start` AS `start`,`uobs-db`.`kiusc_datesheet`.`end` AS `end`,`uobs-db`.`kiusc_datesheet`.`merge_offer_id` AS `merge_offer_id`,`uobs-db`.`kiusc_datesheet`.`exam` AS `exam` from `uobs-db`.`kiusc_datesheet` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_degrees`
--
DROP TABLE IF EXISTS `kiusc_degrees`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_degrees`  AS  select `uobs-db`.`kiusc_degrees`.`id` AS `id`,`uobs-db`.`kiusc_degrees`.`degree_title` AS `degree_title`,`uobs-db`.`kiusc_degrees`.`d_level_id` AS `d_level_id` from `uobs-db`.`kiusc_degrees` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_degree_levels`
--
DROP TABLE IF EXISTS `kiusc_degree_levels`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_degree_levels`  AS  select `uobs-db`.`kiusc_degree_levels`.`id` AS `id`,`uobs-db`.`kiusc_degree_levels`.`level` AS `level` from `uobs-db`.`kiusc_degree_levels` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_degree_titles`
--
DROP TABLE IF EXISTS `kiusc_degree_titles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_degree_titles`  AS  select `uobs-db`.`kiusc_degree_titles`.`id` AS `id`,`uobs-db`.`kiusc_degree_titles`.`degree_title` AS `degree_title`,`uobs-db`.`kiusc_degree_titles`.`no_of_sem` AS `no_of_sem`,`uobs-db`.`kiusc_degree_titles`.`req_cr_hours` AS `req_cr_hours`,`uobs-db`.`kiusc_degree_titles`.`level` AS `level`,`uobs-db`.`kiusc_degree_titles`.`years` AS `years` from `uobs-db`.`kiusc_degree_titles` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_departments`
--
DROP TABLE IF EXISTS `kiusc_departments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_departments`  AS  select `uobs-db`.`kiusc_departments`.`id` AS `id`,`uobs-db`.`kiusc_departments`.`name` AS `name`,`uobs-db`.`kiusc_departments`.`group` AS `group` from `uobs-db`.`kiusc_departments` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_designations`
--
DROP TABLE IF EXISTS `kiusc_designations`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_designations`  AS  select `uobs-db`.`kiusc_designations`.`id` AS `id`,`uobs-db`.`kiusc_designations`.`designation` AS `designation`,`uobs-db`.`kiusc_designations`.`type` AS `type` from `uobs-db`.`kiusc_designations` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_districts`
--
DROP TABLE IF EXISTS `kiusc_districts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_districts`  AS  select `uobs-db`.`kiusc_districts`.`id` AS `id`,`uobs-db`.`kiusc_districts`.`name` AS `name` from `uobs-db`.`kiusc_districts` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_employees`
--
DROP TABLE IF EXISTS `kiusc_employees`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_employees`  AS  select `uobs-db`.`kiusc_employees`.`id` AS `id`,`uobs-db`.`kiusc_employees`.`user_id` AS `user_id`,`uobs-db`.`kiusc_employees`.`name` AS `name`,`uobs-db`.`kiusc_employees`.`fname` AS `fname`,`uobs-db`.`kiusc_employees`.`cnic` AS `cnic`,`uobs-db`.`kiusc_employees`.`permanent_address` AS `permanent_address`,`uobs-db`.`kiusc_employees`.`cur_address` AS `cur_address`,`uobs-db`.`kiusc_employees`.`cell_no1` AS `cell_no1`,`uobs-db`.`kiusc_employees`.`cell_no2` AS `cell_no2`,`uobs-db`.`kiusc_employees`.`email` AS `email`,`uobs-db`.`kiusc_employees`.`date_of_joining` AS `date_of_joining`,`uobs-db`.`kiusc_employees`.`emp_type` AS `emp_type`,`uobs-db`.`kiusc_employees`.`pay_scale` AS `pay_scale`,`uobs-db`.`kiusc_employees`.`scale_type` AS `scale_type` from `uobs-db`.`kiusc_employees` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_emp_designation`
--
DROP TABLE IF EXISTS `kiusc_emp_designation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_emp_designation`  AS  select `uobs-db`.`kiusc_emp_designation`.`id` AS `id`,`uobs-db`.`kiusc_emp_designation`.`emp_id` AS `emp_id`,`uobs-db`.`kiusc_emp_designation`.`designation_id` AS `designation_id`,`uobs-db`.`kiusc_emp_designation`.`start_date` AS `start_date`,`uobs-db`.`kiusc_emp_designation`.`end_date` AS `end_date`,`uobs-db`.`kiusc_emp_designation`.`acc_department_id` AS `acc_department_id`,`uobs-db`.`kiusc_emp_designation`.`adm_department_id` AS `adm_department_id` from `uobs-db`.`kiusc_emp_designation` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_evaluation`
--
DROP TABLE IF EXISTS `kiusc_evaluation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_evaluation`  AS  select `uobs-db`.`kiusc_evaluation`.`id` AS `id`,`uobs-db`.`kiusc_evaluation`.`description` AS `description`,`uobs-db`.`kiusc_evaluation`.`start_date` AS `start_date`,`uobs-db`.`kiusc_evaluation`.`end_date` AS `end_date`,`uobs-db`.`kiusc_evaluation`.`sem_id` AS `sem_id`,`uobs-db`.`kiusc_evaluation`.`enable_std` AS `enable_std`,`uobs-db`.`kiusc_evaluation`.`active` AS `active` from `uobs-db`.`kiusc_evaluation` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_evaluationcategory`
--
DROP TABLE IF EXISTS `kiusc_evaluationcategory`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_evaluationcategory`  AS  select `uobs-db`.`kiusc_evaluationcategory`.`id` AS `id`,`uobs-db`.`kiusc_evaluationcategory`.`qa` AS `qa`,`uobs-db`.`kiusc_evaluationcategory`.`practical` AS `practical`,`uobs-db`.`kiusc_evaluationcategory`.`mid_term` AS `mid_term`,`uobs-db`.`kiusc_evaluationcategory`.`final_term` AS `final_term`,`uobs-db`.`kiusc_evaluationcategory`.`thesis` AS `thesis`,`uobs-db`.`kiusc_evaluationcategory`.`non_credit` AS `non_credit`,`uobs-db`.`kiusc_evaluationcategory`.`active` AS `active` from `uobs-db`.`kiusc_evaluationcategory` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_eval_questions`
--
DROP TABLE IF EXISTS `kiusc_eval_questions`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_eval_questions`  AS  select `uobs-db`.`kiusc_eval_questions`.`id` AS `id`,`uobs-db`.`kiusc_eval_questions`.`eval_id` AS `eval_id`,`uobs-db`.`kiusc_eval_questions`.`question` AS `question`,`uobs-db`.`kiusc_eval_questions`.`positive` AS `positive`,`uobs-db`.`kiusc_eval_questions`.`cat_id` AS `cat_id` from `uobs-db`.`kiusc_eval_questions` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_eval_ques_category`
--
DROP TABLE IF EXISTS `kiusc_eval_ques_category`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_eval_ques_category`  AS  select `uobs-db`.`kiusc_eval_ques_category`.`id` AS `id`,`uobs-db`.`kiusc_eval_ques_category`.`name` AS `name` from `uobs-db`.`kiusc_eval_ques_category` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_eval_std`
--
DROP TABLE IF EXISTS `kiusc_eval_std`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_eval_std`  AS  select `uobs-db`.`kiusc_eval_std`.`id` AS `id`,`uobs-db`.`kiusc_eval_std`.`eval_id` AS `eval_id`,`uobs-db`.`kiusc_eval_std`.`question_id` AS `question_id`,`uobs-db`.`kiusc_eval_std`.`c_offer_id` AS `c_offer_id`,`uobs-db`.`kiusc_eval_std`.`ans` AS `ans`,`uobs-db`.`kiusc_eval_std`.`std_id` AS `std_id` from `uobs-db`.`kiusc_eval_std` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_fee_challan`
--
DROP TABLE IF EXISTS `kiusc_fee_challan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_fee_challan`  AS  select `uobs-db`.`kiusc_fee_challan`.`id` AS `id`,`uobs-db`.`kiusc_fee_challan`.`std_fee_id` AS `std_fee_id`,`uobs-db`.`kiusc_fee_challan`.`std_gen_fee_id` AS `std_gen_fee_id`,`uobs-db`.`kiusc_fee_challan`.`challan_no` AS `challan_no`,`uobs-db`.`kiusc_fee_challan`.`total_amount` AS `total_amount`,`uobs-db`.`kiusc_fee_challan`.`received_date` AS `received_date`,`uobs-db`.`kiusc_fee_challan`.`received_amount` AS `received_amount`,`uobs-db`.`kiusc_fee_challan`.`paid` AS `paid`,`uobs-db`.`kiusc_fee_challan`.`last_date` AS `last_date` from `uobs-db`.`kiusc_fee_challan` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_fee_challan_student`
--
DROP TABLE IF EXISTS `kiusc_fee_challan_student`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_fee_challan_student`  AS  select `uobs-db`.`kiusc_fee_challan_student`.`id` AS `id`,`uobs-db`.`kiusc_fee_challan_student`.`std_fee_id` AS `std_fee_id`,`uobs-db`.`kiusc_fee_challan_student`.`challan_id` AS `challan_id` from `uobs-db`.`kiusc_fee_challan_student` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_fee_refunds`
--
DROP TABLE IF EXISTS `kiusc_fee_refunds`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_fee_refunds`  AS  select `uobs-db`.`kiusc_fee_refunds`.`id` AS `id`,`uobs-db`.`kiusc_fee_refunds`.`fee_std_sem_detail_id` AS `fee_std_sem_detail_id`,`uobs-db`.`kiusc_fee_refunds`.`fee_std_gen_id` AS `fee_std_gen_id`,`uobs-db`.`kiusc_fee_refunds`.`payment_id` AS `payment_id`,`uobs-db`.`kiusc_fee_refunds`.`refund_date` AS `refund_date`,`uobs-db`.`kiusc_fee_refunds`.`amount` AS `amount` from `uobs-db`.`kiusc_fee_refunds` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_fee_scholarship`
--
DROP TABLE IF EXISTS `kiusc_fee_scholarship`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_fee_scholarship`  AS  select `uobs-db`.`kiusc_fee_scholarship`.`id` AS `id`,`uobs-db`.`kiusc_fee_scholarship`.`std_fee_id` AS `std_fee_id`,`uobs-db`.`kiusc_fee_scholarship`.`std_id` AS `std_id`,`uobs-db`.`kiusc_fee_scholarship`.`agency_id` AS `agency_id`,`uobs-db`.`kiusc_fee_scholarship`.`amount` AS `amount`,`uobs-db`.`kiusc_fee_scholarship`.`received_date` AS `received_date`,`uobs-db`.`kiusc_fee_scholarship`.`payment_id` AS `payment_id` from `uobs-db`.`kiusc_fee_scholarship` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_fee_semester_setting`
--
DROP TABLE IF EXISTS `kiusc_fee_semester_setting`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_fee_semester_setting`  AS  select `uobs-db`.`kiusc_fee_semester_setting`.`id` AS `id`,`uobs-db`.`kiusc_fee_semester_setting`.`fee_id` AS `fee_id`,`uobs-db`.`kiusc_fee_semester_setting`.`prog_id` AS `prog_id`,`uobs-db`.`kiusc_fee_semester_setting`.`sem_id` AS `sem_id`,`uobs-db`.`kiusc_fee_semester_setting`.`amount` AS `amount` from `uobs-db`.`kiusc_fee_semester_setting` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_fee_student_general`
--
DROP TABLE IF EXISTS `kiusc_fee_student_general`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_fee_student_general`  AS  select `uobs-db`.`kiusc_fee_student_general`.`id` AS `id`,`uobs-db`.`kiusc_fee_student_general`.`std_id` AS `std_id`,`uobs-db`.`kiusc_fee_student_general`.`semester_fee_id` AS `semester_fee_id`,`uobs-db`.`kiusc_fee_student_general`.`amount` AS `amount`,`uobs-db`.`kiusc_fee_student_general`.`type` AS `type`,`uobs-db`.`kiusc_fee_student_general`.`ref_table_id` AS `ref_table_id`,`uobs-db`.`kiusc_fee_student_general`.`description` AS `description`,`uobs-db`.`kiusc_fee_student_general`.`refunded` AS `refunded` from `uobs-db`.`kiusc_fee_student_general` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_fee_student_sem`
--
DROP TABLE IF EXISTS `kiusc_fee_student_sem`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_fee_student_sem`  AS  select `uobs-db`.`kiusc_fee_student_sem`.`id` AS `id`,`uobs-db`.`kiusc_fee_student_sem`.`std_id` AS `std_id`,`uobs-db`.`kiusc_fee_student_sem`.`prog_id` AS `prog_id`,`uobs-db`.`kiusc_fee_student_sem`.`sem_id` AS `sem_id`,`uobs-db`.`kiusc_fee_student_sem`.`t_amount` AS `t_amount`,`uobs-db`.`kiusc_fee_student_sem`.`description` AS `description`,`uobs-db`.`kiusc_fee_student_sem`.`fee_date` AS `fee_date`,`uobs-db`.`kiusc_fee_student_sem`.`last_date1` AS `last_date1`,`uobs-db`.`kiusc_fee_student_sem`.`fine_date1` AS `fine_date1`,`uobs-db`.`kiusc_fee_student_sem`.`last_date2` AS `last_date2`,`uobs-db`.`kiusc_fee_student_sem`.`fine_date2` AS `fine_date2`,`uobs-db`.`kiusc_fee_student_sem`.`last_date3` AS `last_date3`,`uobs-db`.`kiusc_fee_student_sem`.`is_semester` AS `is_semester` from `uobs-db`.`kiusc_fee_student_sem` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_fee_student_sem_detail`
--
DROP TABLE IF EXISTS `kiusc_fee_student_sem_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_fee_student_sem_detail`  AS  select `uobs-db`.`kiusc_fee_student_sem_detail`.`id` AS `id`,`uobs-db`.`kiusc_fee_student_sem_detail`.`fee_std_sem_id` AS `fee_std_sem_id`,`uobs-db`.`kiusc_fee_student_sem_detail`.`sem_fee_id` AS `sem_fee_id`,`uobs-db`.`kiusc_fee_student_sem_detail`.`par_name` AS `par_name`,`uobs-db`.`kiusc_fee_student_sem_detail`.`amount` AS `amount`,`uobs-db`.`kiusc_fee_student_sem_detail`.`refunded` AS `refunded` from `uobs-db`.`kiusc_fee_student_sem_detail` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_fee_type`
--
DROP TABLE IF EXISTS `kiusc_fee_type`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_fee_type`  AS  select `uobs-db`.`kiusc_fee_type`.`id` AS `id`,`uobs-db`.`kiusc_fee_type`.`description` AS `description`,`uobs-db`.`kiusc_fee_type`.`type` AS `type`,`uobs-db`.`kiusc_fee_type`.`refundable` AS `refundable` from `uobs-db`.`kiusc_fee_type` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_freeze`
--
DROP TABLE IF EXISTS `kiusc_freeze`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_freeze`  AS  select `uobs-db`.`kiusc_freeze`.`id` AS `id`,`uobs-db`.`kiusc_freeze`.`stud_id` AS `stud_id`,`uobs-db`.`kiusc_freeze`.`start_sem_id` AS `start_sem_id`,`uobs-db`.`kiusc_freeze`.`no_of_sem` AS `no_of_sem`,`uobs-db`.`kiusc_freeze`.`from_prog_id` AS `from_prog_id`,`uobs-db`.`kiusc_freeze`.`to_prog_id` AS `to_prog_id`,`uobs-db`.`kiusc_freeze`.`freeze_date` AS `freeze_date`,`uobs-db`.`kiusc_freeze`.`freeze_approval_id` AS `freeze_approval_id`,`uobs-db`.`kiusc_freeze`.`unfreeze_date` AS `unfreeze_date`,`uobs-db`.`kiusc_freeze`.`unfreeze_approval_id` AS `unfreeze_approval_id` from `uobs-db`.`kiusc_freeze` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_gpa_qp`
--
DROP TABLE IF EXISTS `kiusc_gpa_qp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_gpa_qp`  AS  select `uobs-db`.`kiusc_gpa_qp`.`id` AS `id`,`uobs-db`.`kiusc_gpa_qp`.`cr_hrs` AS `cr_hrs`,`uobs-db`.`kiusc_gpa_qp`.`marks` AS `marks`,`uobs-db`.`kiusc_gpa_qp`.`gp` AS `gp` from `uobs-db`.`kiusc_gpa_qp` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_gpa_requirement`
--
DROP TABLE IF EXISTS `kiusc_gpa_requirement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_gpa_requirement`  AS  select `uobs-db`.`kiusc_gpa_requirement`.`id` AS `id`,`uobs-db`.`kiusc_gpa_requirement`.`degree_title_id` AS `degree_title_id`,`uobs-db`.`kiusc_gpa_requirement`.`semesterGPA` AS `semesterGPA`,`uobs-db`.`kiusc_gpa_requirement`.`upto_semester_no` AS `upto_semester_no`,`uobs-db`.`kiusc_gpa_requirement`.`semester1` AS `semester1`,`uobs-db`.`kiusc_gpa_requirement`.`semester2` AS `semester2`,`uobs-db`.`kiusc_gpa_requirement`.`semester3` AS `semester3`,`uobs-db`.`kiusc_gpa_requirement`.`semester4` AS `semester4`,`uobs-db`.`kiusc_gpa_requirement`.`semester5` AS `semester5`,`uobs-db`.`kiusc_gpa_requirement`.`semester6` AS `semester6`,`uobs-db`.`kiusc_gpa_requirement`.`semester7` AS `semester7`,`uobs-db`.`kiusc_gpa_requirement`.`semester8` AS `semester8` from `uobs-db`.`kiusc_gpa_requirement` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_grace_marks`
--
DROP TABLE IF EXISTS `kiusc_grace_marks`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_grace_marks`  AS  select `uobs-db`.`kiusc_grace_marks`.`id` AS `id`,`uobs-db`.`kiusc_grace_marks`.`stud_id` AS `stud_id`,`uobs-db`.`kiusc_grace_marks`.`result_id` AS `result_id`,`uobs-db`.`kiusc_grace_marks`.`old_marks` AS `old_marks`,`uobs-db`.`kiusc_grace_marks`.`grace_mark` AS `grace_mark`,`uobs-db`.`kiusc_grace_marks`.`approval_id` AS `approval_id` from `uobs-db`.`kiusc_grace_marks` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_grade_points`
--
DROP TABLE IF EXISTS `kiusc_grade_points`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_grade_points`  AS  select `uobs-db`.`kiusc_grade_points`.`id` AS `id`,`uobs-db`.`kiusc_grade_points`.`obt_marks` AS `obt_marks`,`uobs-db`.`kiusc_grade_points`.`grade` AS `grade`,`uobs-db`.`kiusc_grade_points`.`gp` AS `gp` from `uobs-db`.`kiusc_grade_points` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_jobs`
--
DROP TABLE IF EXISTS `kiusc_jobs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_jobs`  AS  select `uobs-db`.`kiusc_jobs`.`id` AS `id`,`uobs-db`.`kiusc_jobs`.`post` AS `post`,`uobs-db`.`kiusc_jobs`.`date_of_advertisement` AS `date_of_advertisement`,`uobs-db`.`kiusc_jobs`.`last_date` AS `last_date`,`uobs-db`.`kiusc_jobs`.`description` AS `description`,`uobs-db`.`kiusc_jobs`.`conditions` AS `conditions`,`uobs-db`.`kiusc_jobs`.`criteria_id` AS `criteria_id`,`uobs-db`.`kiusc_jobs`.`approval_id` AS `approval_id`,`uobs-db`.`kiusc_jobs`.`active` AS `active` from `uobs-db`.`kiusc_jobs` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_job_applicants`
--
DROP TABLE IF EXISTS `kiusc_job_applicants`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_job_applicants`  AS  select `uobs-db`.`kiusc_job_applicants`.`id` AS `id`,`uobs-db`.`kiusc_job_applicants`.`applicant_no` AS `applicant_no`,`uobs-db`.`kiusc_job_applicants`.`name` AS `name`,`uobs-db`.`kiusc_job_applicants`.`fname` AS `fname`,`uobs-db`.`kiusc_job_applicants`.`dob` AS `dob`,`uobs-db`.`kiusc_job_applicants`.`cnic` AS `cnic`,`uobs-db`.`kiusc_job_applicants`.`cell_no` AS `cell_no`,`uobs-db`.`kiusc_job_applicants`.`email` AS `email`,`uobs-db`.`kiusc_job_applicants`.`postal_address` AS `postal_address`,`uobs-db`.`kiusc_job_applicants`.`district_id` AS `district_id`,`uobs-db`.`kiusc_job_applicants`.`tehsil_id` AS `tehsil_id`,`uobs-db`.`kiusc_job_applicants`.`village` AS `village`,`uobs-db`.`kiusc_job_applicants`.`remarks` AS `remarks`,`uobs-db`.`kiusc_job_applicants`.`is_eligible` AS `is_eligible`,`uobs-db`.`kiusc_job_applicants`.`reason` AS `reason`,`uobs-db`.`kiusc_job_applicants`.`picture` AS `picture`,`uobs-db`.`kiusc_job_applicants`.`interview` AS `interview`,`uobs-db`.`kiusc_job_applicants`.`test_marks` AS `test_marks` from `uobs-db`.`kiusc_job_applicants` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_job_app_map`
--
DROP TABLE IF EXISTS `kiusc_job_app_map`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_job_app_map`  AS  select `uobs-db`.`kiusc_job_app_map`.`id` AS `id`,`uobs-db`.`kiusc_job_app_map`.`applicant_id` AS `applicant_id`,`uobs-db`.`kiusc_job_app_map`.`job_id` AS `job_id` from `uobs-db`.`kiusc_job_app_map` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_job_criteria`
--
DROP TABLE IF EXISTS `kiusc_job_criteria`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_job_criteria`  AS  select `uobs-db`.`kiusc_job_criteria`.`id` AS `id`,`uobs-db`.`kiusc_job_criteria`.`description` AS `description`,`uobs-db`.`kiusc_job_criteria`.`ssc` AS `ssc`,`uobs-db`.`kiusc_job_criteria`.`hssc` AS `hssc`,`uobs-db`.`kiusc_job_criteria`.`bachelor` AS `bachelor`,`uobs-db`.`kiusc_job_criteria`.`master` AS `master`,`uobs-db`.`kiusc_job_criteria`.`mphil` AS `mphil`,`uobs-db`.`kiusc_job_criteria`.`phd` AS `phd`,`uobs-db`.`kiusc_job_criteria`.`experience` AS `experience`,`uobs-db`.`kiusc_job_criteria`.`max_exp` AS `max_exp`,`uobs-db`.`kiusc_job_criteria`.`distinction` AS `distinction`,`uobs-db`.`kiusc_job_criteria`.`max_dist` AS `max_dist`,`uobs-db`.`kiusc_job_criteria`.`publication` AS `publication`,`uobs-db`.`kiusc_job_criteria`.`max_publ` AS `max_publ` from `uobs-db`.`kiusc_job_criteria` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_job_distinctions`
--
DROP TABLE IF EXISTS `kiusc_job_distinctions`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_job_distinctions`  AS  select `uobs-db`.`kiusc_job_distinctions`.`id` AS `id`,`uobs-db`.`kiusc_job_distinctions`.`title` AS `title`,`uobs-db`.`kiusc_job_distinctions`.`description` AS `description`,`uobs-db`.`kiusc_job_distinctions`.`applicant_id` AS `applicant_id`,`uobs-db`.`kiusc_job_distinctions`.`countable` AS `countable` from `uobs-db`.`kiusc_job_distinctions` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_job_experiences`
--
DROP TABLE IF EXISTS `kiusc_job_experiences`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_job_experiences`  AS  select `uobs-db`.`kiusc_job_experiences`.`id` AS `id`,`uobs-db`.`kiusc_job_experiences`.`job_title` AS `job_title`,`uobs-db`.`kiusc_job_experiences`.`organization` AS `organization`,`uobs-db`.`kiusc_job_experiences`.`exp_from` AS `exp_from`,`uobs-db`.`kiusc_job_experiences`.`exp_to` AS `exp_to`,`uobs-db`.`kiusc_job_experiences`.`month` AS `month`,`uobs-db`.`kiusc_job_experiences`.`countable` AS `countable`,`uobs-db`.`kiusc_job_experiences`.`years` AS `years`,`uobs-db`.`kiusc_job_experiences`.`applicant_id` AS `applicant_id` from `uobs-db`.`kiusc_job_experiences` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_job_gpa_rang`
--
DROP TABLE IF EXISTS `kiusc_job_gpa_rang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_job_gpa_rang`  AS  select `uobs-db`.`kiusc_job_gpa_rang`.`id` AS `id`,`uobs-db`.`kiusc_job_gpa_rang`.`gpa1` AS `gpa1`,`uobs-db`.`kiusc_job_gpa_rang`.`gpa2` AS `gpa2`,`uobs-db`.`kiusc_job_gpa_rang`.`per1` AS `per1`,`uobs-db`.`kiusc_job_gpa_rang`.`per2` AS `per2` from `uobs-db`.`kiusc_job_gpa_rang` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_job_publications`
--
DROP TABLE IF EXISTS `kiusc_job_publications`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_job_publications`  AS  select `uobs-db`.`kiusc_job_publications`.`id` AS `id`,`uobs-db`.`kiusc_job_publications`.`title` AS `title`,`uobs-db`.`kiusc_job_publications`.`journal` AS `journal`,`uobs-db`.`kiusc_job_publications`.`impact_factor` AS `impact_factor`,`uobs-db`.`kiusc_job_publications`.`applicant_id` AS `applicant_id`,`uobs-db`.`kiusc_job_publications`.`countable` AS `countable` from `uobs-db`.`kiusc_job_publications` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_job_qualifications`
--
DROP TABLE IF EXISTS `kiusc_job_qualifications`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_job_qualifications`  AS  select `uobs-db`.`kiusc_job_qualifications`.`id` AS `id`,`uobs-db`.`kiusc_job_qualifications`.`degree_id` AS `degree_id`,`uobs-db`.`kiusc_job_qualifications`.`applicant_id` AS `applicant_id`,`uobs-db`.`kiusc_job_qualifications`.`institute` AS `institute`,`uobs-db`.`kiusc_job_qualifications`.`year` AS `year`,`uobs-db`.`kiusc_job_qualifications`.`obt_marks` AS `obt_marks`,`uobs-db`.`kiusc_job_qualifications`.`total_marks` AS `total_marks`,`uobs-db`.`kiusc_job_qualifications`.`obt_gpa` AS `obt_gpa`,`uobs-db`.`kiusc_job_qualifications`.`total_gpa` AS `total_gpa`,`uobs-db`.`kiusc_job_qualifications`.`percentage` AS `percentage`,`uobs-db`.`kiusc_job_qualifications`.`division` AS `division` from `uobs-db`.`kiusc_job_qualifications` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_job_qual_equi`
--
DROP TABLE IF EXISTS `kiusc_job_qual_equi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_job_qual_equi`  AS  select `uobs-db`.`kiusc_job_qual_equi`.`id` AS `id`,`uobs-db`.`kiusc_job_qual_equi`.`qualification_id` AS `qualification_id`,`uobs-db`.`kiusc_job_qual_equi`.`equivalent_to` AS `equivalent_to`,`uobs-db`.`kiusc_job_qual_equi`.`applicant_id` AS `applicant_id` from `uobs-db`.`kiusc_job_qual_equi` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_job_result`
--
DROP TABLE IF EXISTS `kiusc_job_result`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_job_result`  AS  select `uobs-db`.`kiusc_job_result`.`app_id` AS `app_id`,`uobs-db`.`kiusc_job_result`.`name` AS `name`,`uobs-db`.`kiusc_job_result`.`scc_total` AS `scc_total`,`uobs-db`.`kiusc_job_result`.`scc_obt` AS `scc_obt`,`uobs-db`.`kiusc_job_result`.`scc_per` AS `scc_per`,`uobs-db`.`kiusc_job_result`.`scc_points` AS `scc_points`,`uobs-db`.`kiusc_job_result`.`hssc_total` AS `hssc_total`,`uobs-db`.`kiusc_job_result`.`hssc_obt` AS `hssc_obt`,`uobs-db`.`kiusc_job_result`.`hssc_per` AS `hssc_per`,`uobs-db`.`kiusc_job_result`.`hssc_points` AS `hssc_points`,`uobs-db`.`kiusc_job_result`.`bachelor_total` AS `bachelor_total`,`uobs-db`.`kiusc_job_result`.`bachelor_obt` AS `bachelor_obt`,`uobs-db`.`kiusc_job_result`.`bachelor_per` AS `bachelor_per`,`uobs-db`.`kiusc_job_result`.`bachelor_points` AS `bachelor_points`,`uobs-db`.`kiusc_job_result`.`master_total` AS `master_total`,`uobs-db`.`kiusc_job_result`.`master_obt` AS `master_obt`,`uobs-db`.`kiusc_job_result`.`master_per` AS `master_per`,`uobs-db`.`kiusc_job_result`.`master_points` AS `master_points`,`uobs-db`.`kiusc_job_result`.`mphile_per` AS `mphile_per`,`uobs-db`.`kiusc_job_result`.`mphil_points` AS `mphil_points`,`uobs-db`.`kiusc_job_result`.`phd_points` AS `phd_points`,`uobs-db`.`kiusc_job_result`.`publications` AS `publications`,`uobs-db`.`kiusc_job_result`.`experience` AS `experience`,`uobs-db`.`kiusc_job_result`.`total_accademics` AS `total_accademics`,`uobs-db`.`kiusc_job_result`.`total_test` AS `total_test`,`uobs-db`.`kiusc_job_result`.`total_interview` AS `total_interview`,`uobs-db`.`kiusc_job_result`.`g_total` AS `g_total`,`uobs-db`.`kiusc_job_result`.`remarks` AS `remarks`,`uobs-db`.`kiusc_job_result`.`accd_weightage` AS `accd_weightage` from `uobs-db`.`kiusc_job_result` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_job_skills`
--
DROP TABLE IF EXISTS `kiusc_job_skills`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_job_skills`  AS  select `uobs-db`.`kiusc_job_skills`.`id` AS `id`,`uobs-db`.`kiusc_job_skills`.`skill_title` AS `skill_title`,`uobs-db`.`kiusc_job_skills`.`description` AS `description`,`uobs-db`.`kiusc_job_skills`.`applicant_id` AS `applicant_id` from `uobs-db`.`kiusc_job_skills` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_lectures`
--
DROP TABLE IF EXISTS `kiusc_lectures`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_lectures`  AS  select `uobs-db`.`kiusc_lectures`.`id` AS `id`,`uobs-db`.`kiusc_lectures`.`c_offer_id` AS `c_offer_id`,`uobs-db`.`kiusc_lectures`.`date` AS `date`,`uobs-db`.`kiusc_lectures`.`period_id` AS `period_id`,`uobs-db`.`kiusc_lectures`.`noLecture` AS `noLecture`,`uobs-db`.`kiusc_lectures`.`noLectureReason` AS `noLectureReason` from `uobs-db`.`kiusc_lectures` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_merged_courses`
--
DROP TABLE IF EXISTS `kiusc_merged_courses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_merged_courses`  AS  select `uobs-db`.`kiusc_merged_courses`.`id` AS `id`,`uobs-db`.`kiusc_merged_courses`.`cf_id_1` AS `cf_id_1`,`uobs-db`.`kiusc_merged_courses`.`cf_id_2` AS `cf_id_2` from `uobs-db`.`kiusc_merged_courses` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_notice_board`
--
DROP TABLE IF EXISTS `kiusc_notice_board`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_notice_board`  AS  select `uobs-db`.`kiusc_notice_board`.`id` AS `id`,`uobs-db`.`kiusc_notice_board`.`dep_id` AS `dep_id`,`uobs-db`.`kiusc_notice_board`.`prog_id` AS `prog_id`,`uobs-db`.`kiusc_notice_board`.`stud_id` AS `stud_id`,`uobs-db`.`kiusc_notice_board`.`msg_date` AS `msg_date`,`uobs-db`.`kiusc_notice_board`.`exp_date` AS `exp_date`,`uobs-db`.`kiusc_notice_board`.`title` AS `title`,`uobs-db`.`kiusc_notice_board`.`detail` AS `detail`,`uobs-db`.`kiusc_notice_board`.`user_id` AS `user_id` from `uobs-db`.`kiusc_notice_board` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_payments`
--
DROP TABLE IF EXISTS `kiusc_payments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_payments`  AS  select `uobs-db`.`kiusc_payments`.`id` AS `id`,`uobs-db`.`kiusc_payments`.`chq_id` AS `chq_id`,`uobs-db`.`kiusc_payments`.`date` AS `date`,`uobs-db`.`kiusc_payments`.`amount` AS `amount`,`uobs-db`.`kiusc_payments`.`paid` AS `paid` from `uobs-db`.`kiusc_payments` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_programs`
--
DROP TABLE IF EXISTS `kiusc_programs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_programs`  AS  select `uobs-db`.`kiusc_programs`.`id` AS `id`,`uobs-db`.`kiusc_programs`.`dep_id` AS `dep_id`,`uobs-db`.`kiusc_programs`.`name` AS `name`,`uobs-db`.`kiusc_programs`.`group` AS `group`,`uobs-db`.`kiusc_programs`.`session` AS `session`,`uobs-db`.`kiusc_programs`.`session_name` AS `session_name`,`uobs-db`.`kiusc_programs`.`degree_title_id` AS `degree_title_id` from `uobs-db`.`kiusc_programs` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_prog_sem`
--
DROP TABLE IF EXISTS `kiusc_prog_sem`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_prog_sem`  AS  select `uobs-db`.`kiusc_prog_sem`.`id` AS `id`,`uobs-db`.`kiusc_prog_sem`.`prog_id` AS `prog_id`,`uobs-db`.`kiusc_prog_sem`.`sem_id` AS `sem_id`,`uobs-db`.`kiusc_prog_sem`.`sem_no` AS `sem_no` from `uobs-db`.`kiusc_prog_sem` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_readmission`
--
DROP TABLE IF EXISTS `kiusc_readmission`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_readmission`  AS  select `uobs-db`.`kiusc_readmission`.`id` AS `id`,`uobs-db`.`kiusc_readmission`.`old_stud_id` AS `old_stud_id`,`uobs-db`.`kiusc_readmission`.`new_stud_id` AS `new_stud_id`,`uobs-db`.`kiusc_readmission`.`approval_id` AS `approval_id` from `uobs-db`.`kiusc_readmission` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_reservation`
--
DROP TABLE IF EXISTS `kiusc_reservation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_reservation`  AS  select `uobs-db`.`kiusc_reservation`.`id` AS `id`,`uobs-db`.`kiusc_reservation`.`sem_id` AS `sem_id`,`uobs-db`.`kiusc_reservation`.`c_offer_id` AS `c_offer_id`,`uobs-db`.`kiusc_reservation`.`room_id` AS `room_id`,`uobs-db`.`kiusc_reservation`.`start` AS `start`,`uobs-db`.`kiusc_reservation`.`end` AS `end`,`uobs-db`.`kiusc_reservation`.`day` AS `day`,`uobs-db`.`kiusc_reservation`.`date` AS `date`,`uobs-db`.`kiusc_reservation`.`status` AS `status`,`uobs-db`.`kiusc_reservation`.`cnic` AS `cnic` from `uobs-db`.`kiusc_reservation` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_results`
--
DROP TABLE IF EXISTS `kiusc_results`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_results`  AS  select `uobs-db`.`kiusc_results`.`id` AS `id`,`uobs-db`.`kiusc_results`.`stud_id` AS `stud_id`,`uobs-db`.`kiusc_results`.`sem_id` AS `sem_id`,`uobs-db`.`kiusc_results`.`c_offer_id` AS `c_offer_id`,`uobs-db`.`kiusc_results`.`mid_term` AS `mid_term`,`uobs-db`.`kiusc_results`.`assignments` AS `assignments`,`uobs-db`.`kiusc_results`.`final_term` AS `final_term`,`uobs-db`.`kiusc_results`.`total` AS `total`,`uobs-db`.`kiusc_results`.`quality_points` AS `quality_points`,`uobs-db`.`kiusc_results`.`practical` AS `practical`,`uobs-db`.`kiusc_results`.`repeat_cf_id` AS `repeat_cf_id` from `uobs-db`.`kiusc_results` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_result_cancel`
--
DROP TABLE IF EXISTS `kiusc_result_cancel`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_result_cancel`  AS  select `uobs-db`.`kiusc_result_cancel`.`id` AS `id`,`uobs-db`.`kiusc_result_cancel`.`stud_id` AS `stud_id`,`uobs-db`.`kiusc_result_cancel`.`reason` AS `reason`,`uobs-db`.`kiusc_result_cancel`.`approval_id` AS `approval_id`,`uobs-db`.`kiusc_result_cancel`.`cancel_date` AS `cancel_date` from `uobs-db`.`kiusc_result_cancel` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_result_entry`
--
DROP TABLE IF EXISTS `kiusc_result_entry`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_result_entry`  AS  select `uobs-db`.`kiusc_result_entry`.`cf_id` AS `cf_id`,`uobs-db`.`kiusc_result_entry`.`course_id` AS `course_id`,`uobs-db`.`kiusc_result_entry`.`user_id` AS `user_id` from `uobs-db`.`kiusc_result_entry` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_result_log`
--
DROP TABLE IF EXISTS `kiusc_result_log`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_result_log`  AS  select `uobs-db`.`kiusc_result_log`.`id` AS `id`,`uobs-db`.`kiusc_result_log`.`r_id` AS `r_id`,`uobs-db`.`kiusc_result_log`.`user_id` AS `user_id`,`uobs-db`.`kiusc_result_log`.`approval_id` AS `approval_id`,`uobs-db`.`kiusc_result_log`.`date` AS `date`,`uobs-db`.`kiusc_result_log`.`mid_term` AS `mid_term`,`uobs-db`.`kiusc_result_log`.`assignments` AS `assignments`,`uobs-db`.`kiusc_result_log`.`final_term` AS `final_term`,`uobs-db`.`kiusc_result_log`.`total` AS `total`,`uobs-db`.`kiusc_result_log`.`practical` AS `practical`,`uobs-db`.`kiusc_result_log`.`quality_points` AS `quality_points` from `uobs-db`.`kiusc_result_log` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_rooms`
--
DROP TABLE IF EXISTS `kiusc_rooms`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_rooms`  AS  select `uobs-db`.`kiusc_rooms`.`id` AS `id`,`uobs-db`.`kiusc_rooms`.`room_number` AS `room_number`,`uobs-db`.`kiusc_rooms`.`room_capacity` AS `room_capacity`,`uobs-db`.`kiusc_rooms`.`block_id` AS `block_id`,`uobs-db`.`kiusc_rooms`.`roomtype_id` AS `roomtype_id` from `uobs-db`.`kiusc_rooms` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_room_program`
--
DROP TABLE IF EXISTS `kiusc_room_program`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_room_program`  AS  select `uobs-db`.`kiusc_room_program`.`id` AS `id`,`uobs-db`.`kiusc_room_program`.`prog_id` AS `prog_id`,`uobs-db`.`kiusc_room_program`.`room_id` AS `room_id`,`uobs-db`.`kiusc_room_program`.`sem_id` AS `sem_id` from `uobs-db`.`kiusc_room_program` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_room_type`
--
DROP TABLE IF EXISTS `kiusc_room_type`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_room_type`  AS  select `uobs-db`.`kiusc_room_type`.`id` AS `id`,`uobs-db`.`kiusc_room_type`.`roomtype_name` AS `roomtype_name` from `uobs-db`.`kiusc_room_type` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_scholarship_agencies`
--
DROP TABLE IF EXISTS `kiusc_scholarship_agencies`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_scholarship_agencies`  AS  select `uobs-db`.`kiusc_scholarship_agencies`.`id` AS `id`,`uobs-db`.`kiusc_scholarship_agencies`.`name` AS `name`,`uobs-db`.`kiusc_scholarship_agencies`.`contact_no` AS `contact_no`,`uobs-db`.`kiusc_scholarship_agencies`.`email` AS `email`,`uobs-db`.`kiusc_scholarship_agencies`.`remarks` AS `remarks` from `uobs-db`.`kiusc_scholarship_agencies` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_security_refunds`
--
DROP TABLE IF EXISTS `kiusc_security_refunds`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_security_refunds`  AS  select `uobs-db`.`kiusc_security_refunds`.`id` AS `id`,`uobs-db`.`kiusc_security_refunds`.`std_id` AS `std_id`,`uobs-db`.`kiusc_security_refunds`.`fee_sem_detail_id` AS `fee_sem_detail_id`,`uobs-db`.`kiusc_security_refunds`.`description` AS `description`,`uobs-db`.`kiusc_security_refunds`.`payment_id` AS `payment_id` from `uobs-db`.`kiusc_security_refunds` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_semesters`
--
DROP TABLE IF EXISTS `kiusc_semesters`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_semesters`  AS  select `uobs-db`.`kiusc_semesters`.`id` AS `id`,`uobs-db`.`kiusc_semesters`.`sem_name` AS `sem_name`,`uobs-db`.`kiusc_semesters`.`start_date` AS `start_date`,`uobs-db`.`kiusc_semesters`.`mid_term_date` AS `mid_term_date`,`uobs-db`.`kiusc_semesters`.`final_term_date` AS `final_term_date`,`uobs-db`.`kiusc_semesters`.`final_term_end_date` AS `final_term_end_date`,`uobs-db`.`kiusc_semesters`.`course_offer` AS `course_offer`,`uobs-db`.`kiusc_semesters`.`course_reg` AS `course_reg`,`uobs-db`.`kiusc_semesters`.`mid_term` AS `mid_term`,`uobs-db`.`kiusc_semesters`.`final_term` AS `final_term`,`uobs-db`.`kiusc_semesters`.`active` AS `active`,`uobs-db`.`kiusc_semesters`.`result_declare` AS `result_declare`,`uobs-db`.`kiusc_semesters`.`result_date` AS `result_date`,`uobs-db`.`kiusc_semesters`.`is_current` AS `is_current` from `uobs-db`.`kiusc_semesters` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_specialization`
--
DROP TABLE IF EXISTS `kiusc_specialization`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_specialization`  AS  select `uobs-db`.`kiusc_specialization`.`id` AS `id`,`uobs-db`.`kiusc_specialization`.`dept_id` AS `dept_id`,`uobs-db`.`kiusc_specialization`.`name` AS `name` from `uobs-db`.`kiusc_specialization` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_specialization_courses`
--
DROP TABLE IF EXISTS `kiusc_specialization_courses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_specialization_courses`  AS  select `uobs-db`.`kiusc_specialization_courses`.`id` AS `id`,`uobs-db`.`kiusc_specialization_courses`.`c_offer_id` AS `c_offer_id`,`uobs-db`.`kiusc_specialization_courses`.`sp_id` AS `sp_id` from `uobs-db`.`kiusc_specialization_courses` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_specialization_prog`
--
DROP TABLE IF EXISTS `kiusc_specialization_prog`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_specialization_prog`  AS  select `uobs-db`.`kiusc_specialization_prog`.`id` AS `id`,`uobs-db`.`kiusc_specialization_prog`.`prog_id` AS `prog_id`,`uobs-db`.`kiusc_specialization_prog`.`sp_id` AS `sp_id` from `uobs-db`.`kiusc_specialization_prog` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_std_clearance`
--
DROP TABLE IF EXISTS `kiusc_std_clearance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_std_clearance`  AS  select `uobs-db`.`kiusc_std_clearance`.`id` AS `id`,`uobs-db`.`kiusc_std_clearance`.`stud_id` AS `stud_id`,`uobs-db`.`kiusc_std_clearance`.`dep_user_id` AS `dep_user_id`,`uobs-db`.`kiusc_std_clearance`.`dep_clearance` AS `dep_clearance`,`uobs-db`.`kiusc_std_clearance`.`lib_user_id` AS `lib_user_id`,`uobs-db`.`kiusc_std_clearance`.`lib_clearance` AS `lib_clearance`,`uobs-db`.`kiusc_std_clearance`.`acct_user_id` AS `acct_user_id`,`uobs-db`.`kiusc_std_clearance`.`acct_clearance` AS `acct_clearance`,`uobs-db`.`kiusc_std_clearance`.`exam_user_id` AS `exam_user_id`,`uobs-db`.`kiusc_std_clearance`.`exam_clearance` AS `exam_clearance` from `uobs-db`.`kiusc_std_clearance` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_std_documents`
--
DROP TABLE IF EXISTS `kiusc_std_documents`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_std_documents`  AS  select `uobs-db`.`kiusc_std_documents`.`id` AS `id`,`uobs-db`.`kiusc_std_documents`.`stud_id` AS `stud_id`,`uobs-db`.`kiusc_std_documents`.`marksheets` AS `marksheets`,`uobs-db`.`kiusc_std_documents`.`domicile` AS `domicile`,`uobs-db`.`kiusc_std_documents`.`migration` AS `migration`,`uobs-db`.`kiusc_std_documents`.`cnic` AS `cnic`,`uobs-db`.`kiusc_std_documents`.`affidavit` AS `affidavit` from `uobs-db`.`kiusc_std_documents` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_std_status`
--
DROP TABLE IF EXISTS `kiusc_std_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_std_status`  AS  select `uobs-db`.`kiusc_std_status`.`id` AS `id`,`uobs-db`.`kiusc_std_status`.`stud_id` AS `stud_id`,`uobs-db`.`kiusc_std_status`.`sem_id` AS `sem_id`,`uobs-db`.`kiusc_std_status`.`status` AS `status` from `uobs-db`.`kiusc_std_status` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_students`
--
DROP TABLE IF EXISTS `kiusc_students`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_students`  AS  select `uobs-db`.`kiusc_students`.`id` AS `id`,`uobs-db`.`kiusc_students`.`prog_id` AS `prog_id`,`uobs-db`.`kiusc_students`.`department_id` AS `department_id`,`uobs-db`.`kiusc_students`.`application_no` AS `application_no`,`uobs-db`.`kiusc_students`.`reg_no` AS `reg_no`,`uobs-db`.`kiusc_students`.`name` AS `name`,`uobs-db`.`kiusc_students`.`fname` AS `fname`,`uobs-db`.`kiusc_students`.`dob` AS `dob`,`uobs-db`.`kiusc_students`.`cnic` AS `cnic`,`uobs-db`.`kiusc_students`.`cell` AS `cell`,`uobs-db`.`kiusc_students`.`permanent_address` AS `permanent_address`,`uobs-db`.`kiusc_students`.`gender` AS `gender`,`uobs-db`.`kiusc_students`.`remarks` AS `remarks`,`uobs-db`.`kiusc_students`.`email` AS `email`,`uobs-db`.`kiusc_students`.`recipt_no` AS `recipt_no`,`uobs-db`.`kiusc_students`.`amount` AS `amount`,`uobs-db`.`kiusc_students`.`date` AS `date`,`uobs-db`.`kiusc_students`.`district_id` AS `district_id`,`uobs-db`.`kiusc_students`.`tehsil_id` AS `tehsil_id`,`uobs-db`.`kiusc_students`.`village` AS `village`,`uobs-db`.`kiusc_students`.`postal_address` AS `postal_address`,`uobs-db`.`kiusc_students`.`guardian_name` AS `guardian_name`,`uobs-db`.`kiusc_students`.`father_occupation` AS `father_occupation`,`uobs-db`.`kiusc_students`.`guardian_occupation` AS `guardian_occupation`,`uobs-db`.`kiusc_students`.`father_phone` AS `father_phone`,`uobs-db`.`kiusc_students`.`guardian_phone` AS `guardian_phone`,`uobs-db`.`kiusc_students`.`picture` AS `picture`,`uobs-db`.`kiusc_students`.`is_readmit` AS `is_readmit`,`uobs-db`.`kiusc_students`.`is_result_cancel` AS `is_result_cancel`,`uobs-db`.`kiusc_students`.`specialization_id` AS `specialization_id` from `uobs-db`.`kiusc_students` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_st_qualification`
--
DROP TABLE IF EXISTS `kiusc_st_qualification`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_st_qualification`  AS  select `uobs-db`.`kiusc_st_qualification`.`id` AS `id`,`uobs-db`.`kiusc_st_qualification`.`stud_id` AS `stud_id`,`uobs-db`.`kiusc_st_qualification`.`degree_id` AS `degree_id`,`uobs-db`.`kiusc_st_qualification`.`institute` AS `institute`,`uobs-db`.`kiusc_st_qualification`.`year` AS `year`,`uobs-db`.`kiusc_st_qualification`.`division` AS `division`,`uobs-db`.`kiusc_st_qualification`.`total_marks` AS `total_marks`,`uobs-db`.`kiusc_st_qualification`.`obtained_marks` AS `obtained_marks`,`uobs-db`.`kiusc_st_qualification`.`total_gpa` AS `total_gpa`,`uobs-db`.`kiusc_st_qualification`.`gpa` AS `gpa`,`uobs-db`.`kiusc_st_qualification`.`major_subjects` AS `major_subjects`,`uobs-db`.`kiusc_st_qualification`.`board` AS `board` from `uobs-db`.`kiusc_st_qualification` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_tehsils`
--
DROP TABLE IF EXISTS `kiusc_tehsils`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_tehsils`  AS  select `uobs-db`.`kiusc_tehsils`.`id` AS `id`,`uobs-db`.`kiusc_tehsils`.`name` AS `name`,`uobs-db`.`kiusc_tehsils`.`district_id` AS `district_id` from `uobs-db`.`kiusc_tehsils` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_tel_categories`
--
DROP TABLE IF EXISTS `kiusc_tel_categories`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_tel_categories`  AS  select `uobs-db`.`kiusc_tel_categories`.`id` AS `id`,`uobs-db`.`kiusc_tel_categories`.`name` AS `name` from `uobs-db`.`kiusc_tel_categories` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_tel_directory`
--
DROP TABLE IF EXISTS `kiusc_tel_directory`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_tel_directory`  AS  select `uobs-db`.`kiusc_tel_directory`.`id` AS `id`,`uobs-db`.`kiusc_tel_directory`.`name` AS `name`,`uobs-db`.`kiusc_tel_directory`.`phone_no` AS `phone_no`,`uobs-db`.`kiusc_tel_directory`.`fax` AS `fax`,`uobs-db`.`kiusc_tel_directory`.`extension` AS `extension`,`uobs-db`.`kiusc_tel_directory`.`email` AS `email`,`uobs-db`.`kiusc_tel_directory`.`cell_no` AS `cell_no`,`uobs-db`.`kiusc_tel_directory`.`address` AS `address`,`uobs-db`.`kiusc_tel_directory`.`designation` AS `designation` from `uobs-db`.`kiusc_tel_directory` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_tel_directory_cat`
--
DROP TABLE IF EXISTS `kiusc_tel_directory_cat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_tel_directory_cat`  AS  select `uobs-db`.`kiusc_tel_directory_cat`.`id` AS `id`,`uobs-db`.`kiusc_tel_directory_cat`.`cat_id` AS `cat_id`,`uobs-db`.`kiusc_tel_directory_cat`.`directory_id` AS `directory_id` from `uobs-db`.`kiusc_tel_directory_cat` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_thesis`
--
DROP TABLE IF EXISTS `kiusc_thesis`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_thesis`  AS  select `uobs-db`.`kiusc_thesis`.`id` AS `id`,`uobs-db`.`kiusc_thesis`.`std_id` AS `std_id`,`uobs-db`.`kiusc_thesis`.`result_id` AS `result_id`,`uobs-db`.`kiusc_thesis`.`thesis_title` AS `thesis_title`,`uobs-db`.`kiusc_thesis`.`supervisor_id` AS `supervisor_id`,`uobs-db`.`kiusc_thesis`.`external` AS `external`,`uobs-db`.`kiusc_thesis`.`coordinator` AS `coordinator`,`uobs-db`.`kiusc_thesis`.`kiu_representative` AS `kiu_representative`,`uobs-db`.`kiusc_thesis`.`dean` AS `dean`,`uobs-db`.`kiusc_thesis`.`exam_date` AS `exam_date`,`uobs-db`.`kiusc_thesis`.`grade` AS `grade` from `uobs-db`.`kiusc_thesis` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_timetable`
--
DROP TABLE IF EXISTS `kiusc_timetable`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_timetable`  AS  select `uobs-db`.`kiusc_timetable`.`id` AS `id`,`uobs-db`.`kiusc_timetable`.`sem_id` AS `sem_id`,`uobs-db`.`kiusc_timetable`.`c_offer_id` AS `c_offer_id`,`uobs-db`.`kiusc_timetable`.`room_id` AS `room_id`,`uobs-db`.`kiusc_timetable`.`fac_id` AS `fac_id`,`uobs-db`.`kiusc_timetable`.`start` AS `start`,`uobs-db`.`kiusc_timetable`.`end` AS `end`,`uobs-db`.`kiusc_timetable`.`day` AS `day`,`uobs-db`.`kiusc_timetable`.`period` AS `period`,`uobs-db`.`kiusc_timetable`.`start_date` AS `start_date`,`uobs-db`.`kiusc_timetable`.`end_date` AS `end_date`,`uobs-db`.`kiusc_timetable`.`is_changed` AS `is_changed`,`uobs-db`.`kiusc_timetable`.`merge_offer_id` AS `merge_offer_id` from `uobs-db`.`kiusc_timetable` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_timetable_setting`
--
DROP TABLE IF EXISTS `kiusc_timetable_setting`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_timetable_setting`  AS  select `uobs-db`.`kiusc_timetable_setting`.`id` AS `id`,`uobs-db`.`kiusc_timetable_setting`.`start_time` AS `start_time`,`uobs-db`.`kiusc_timetable_setting`.`end_time` AS `end_time`,`uobs-db`.`kiusc_timetable_setting`.`prog_id` AS `prog_id`,`uobs-db`.`kiusc_timetable_setting`.`friday_break_start` AS `friday_break_start`,`uobs-db`.`kiusc_timetable_setting`.`friday_break_end` AS `friday_break_end` from `uobs-db`.`kiusc_timetable_setting` ;

-- --------------------------------------------------------

--
-- Structure for view `kiusc_transcripts`
--
DROP TABLE IF EXISTS `kiusc_transcripts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiusc_transcripts`  AS  select `uobs-db`.`kiusc_transcripts`.`id` AS `id`,`uobs-db`.`kiusc_transcripts`.`bank_id` AS `bank_id`,`uobs-db`.`kiusc_transcripts`.`chalan_no` AS `chalan_no`,`uobs-db`.`kiusc_transcripts`.`fee_date` AS `fee_date`,`uobs-db`.`kiusc_transcripts`.`reg_no` AS `reg_no`,`uobs-db`.`kiusc_transcripts`.`issuance_date` AS `issuance_date`,`uobs-db`.`kiusc_transcripts`.`sheet_no` AS `sheet_no`,`uobs-db`.`kiusc_transcripts`.`user_id` AS `user_id`,`uobs-db`.`kiusc_transcripts`.`type` AS `type` from `uobs-db`.`kiusc_transcripts` ;

-- --------------------------------------------------------

--
-- Structure for view `lms_add_quiz_marks`
--
DROP TABLE IF EXISTS `lms_add_quiz_marks`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lms_add_quiz_marks`  AS  select `uobs-db`.`lms_add_quiz_marks`.`id` AS `id`,`uobs-db`.`lms_add_quiz_marks`.`std_id` AS `std_id`,`uobs-db`.`lms_add_quiz_marks`.`quiz_id` AS `quiz_id`,`uobs-db`.`lms_add_quiz_marks`.`obtain_marks` AS `obtain_marks` from `uobs-db`.`lms_add_quiz_marks` ;

-- --------------------------------------------------------

--
-- Structure for view `lms_create_assignment`
--
DROP TABLE IF EXISTS `lms_create_assignment`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lms_create_assignment`  AS  select `uobs-db`.`lms_create_assignment`.`assi_id` AS `assi_id`,`uobs-db`.`lms_create_assignment`.`syl_id` AS `syl_id`,`uobs-db`.`lms_create_assignment`.`title` AS `title`,`uobs-db`.`lms_create_assignment`.`description` AS `description`,`uobs-db`.`lms_create_assignment`.`post_date` AS `post_date`,`uobs-db`.`lms_create_assignment`.`attachment` AS `attachment`,`uobs-db`.`lms_create_assignment`.`due_date` AS `due_date`,`uobs-db`.`lms_create_assignment`.`total_marks` AS `total_marks`,`uobs-db`.`lms_create_assignment`.`course_ofr_id` AS `course_ofr_id`,`uobs-db`.`lms_create_assignment`.`include_final` AS `include_final`,`uobs-db`.`lms_create_assignment`.`published` AS `published` from `uobs-db`.`lms_create_assignment` ;

-- --------------------------------------------------------

--
-- Structure for view `lms_create_quiz`
--
DROP TABLE IF EXISTS `lms_create_quiz`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lms_create_quiz`  AS  select `uobs-db`.`lms_create_quiz`.`quiz_id` AS `quiz_id`,`uobs-db`.`lms_create_quiz`.`syl_id` AS `syl_id`,`uobs-db`.`lms_create_quiz`.`create_date` AS `create_date`,`uobs-db`.`lms_create_quiz`.`start_time` AS `start_time`,`uobs-db`.`lms_create_quiz`.`end_time` AS `end_time`,`uobs-db`.`lms_create_quiz`.`course_ofr_id` AS `course_ofr_id`,`uobs-db`.`lms_create_quiz`.`total_marks` AS `total_marks`,`uobs-db`.`lms_create_quiz`.`published` AS `published`,`uobs-db`.`lms_create_quiz`.`questions` AS `questions` from `uobs-db`.`lms_create_quiz` ;

-- --------------------------------------------------------

--
-- Structure for view `lms_holidays`
--
DROP TABLE IF EXISTS `lms_holidays`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lms_holidays`  AS  select `uobs-db`.`lms_holidays`.`h_id` AS `h_id`,`uobs-db`.`lms_holidays`.`k_id` AS `k_id`,`uobs-db`.`lms_holidays`.`n_id` AS `n_id`,`uobs-db`.`lms_holidays`.`is_id` AS `is_id`,`uobs-db`.`lms_holidays`.`days` AS `days`,`uobs-db`.`lms_holidays`.`start` AS `start`,`uobs-db`.`lms_holidays`.`show_student` AS `show_student`,`uobs-db`.`lms_holidays`.`year_id` AS `year_id` from `uobs-db`.`lms_holidays` ;

-- --------------------------------------------------------

--
-- Structure for view `lms_islamic_calander`
--
DROP TABLE IF EXISTS `lms_islamic_calander`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lms_islamic_calander`  AS  select `uobs-db`.`lms_islamic_calander`.`id` AS `id`,`uobs-db`.`lms_islamic_calander`.`hijri_year` AS `hijri_year`,`uobs-db`.`lms_islamic_calander`.`hijri_month` AS `hijri_month`,`uobs-db`.`lms_islamic_calander`.`date` AS `date`,`uobs-db`.`lms_islamic_calander`.`set(yes/no)` AS `set(yes/no)` from `uobs-db`.`lms_islamic_calander` ;

-- --------------------------------------------------------

--
-- Structure for view `lms_islamic_events`
--
DROP TABLE IF EXISTS `lms_islamic_events`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lms_islamic_events`  AS  select `uobs-db`.`lms_islamic_events`.`id` AS `id`,`uobs-db`.`lms_islamic_events`.`month` AS `month`,`uobs-db`.`lms_islamic_events`.`day` AS `day`,`uobs-db`.`lms_islamic_events`.`event_name` AS `event_name`,`uobs-db`.`lms_islamic_events`.`remarks` AS `remarks` from `uobs-db`.`lms_islamic_events` ;

-- --------------------------------------------------------

--
-- Structure for view `lms_kiu_events`
--
DROP TABLE IF EXISTS `lms_kiu_events`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lms_kiu_events`  AS  select `uobs-db`.`lms_kiu_events`.`id` AS `id`,`uobs-db`.`lms_kiu_events`.`date_from` AS `date_from`,`uobs-db`.`lms_kiu_events`.`date_to` AS `date_to`,`uobs-db`.`lms_kiu_events`.`eve_id` AS `eve_id`,`uobs-db`.`lms_kiu_events`.`remarks` AS `remarks` from `uobs-db`.`lms_kiu_events` ;

-- --------------------------------------------------------

--
-- Structure for view `lms_kiu_event_name`
--
DROP TABLE IF EXISTS `lms_kiu_event_name`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lms_kiu_event_name`  AS  select `uobs-db`.`lms_kiu_event_name`.`id` AS `id`,`uobs-db`.`lms_kiu_event_name`.`event_name` AS `event_name` from `uobs-db`.`lms_kiu_event_name` ;

-- --------------------------------------------------------

--
-- Structure for view `lms_lecture_note`
--
DROP TABLE IF EXISTS `lms_lecture_note`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lms_lecture_note`  AS  select `uobs-db`.`lms_lecture_note`.`lec_id` AS `lec_id`,`uobs-db`.`lms_lecture_note`.`syl_id` AS `syl_id`,`uobs-db`.`lms_lecture_note`.`lec_file` AS `lec_file`,`uobs-db`.`lms_lecture_note`.`lec_cofr_id` AS `lec_cofr_id` from `uobs-db`.`lms_lecture_note` ;

-- --------------------------------------------------------

--
-- Structure for view `lms_national_events`
--
DROP TABLE IF EXISTS `lms_national_events`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lms_national_events`  AS  select `uobs-db`.`lms_national_events`.`id` AS `id`,`uobs-db`.`lms_national_events`.`n_month` AS `n_month`,`uobs-db`.`lms_national_events`.`day` AS `day`,`uobs-db`.`lms_national_events`.`event_name` AS `event_name`,`uobs-db`.`lms_national_events`.`remarks` AS `remarks` from `uobs-db`.`lms_national_events` ;

-- --------------------------------------------------------

--
-- Structure for view `lms_personal_event`
--
DROP TABLE IF EXISTS `lms_personal_event`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lms_personal_event`  AS  select `uobs-db`.`lms_personal_event`.`p_id` AS `p_id`,`uobs-db`.`lms_personal_event`.`fac_id` AS `fac_id`,`uobs-db`.`lms_personal_event`.`event_name` AS `event_name`,`uobs-db`.`lms_personal_event`.`date` AS `date`,`uobs-db`.`lms_personal_event`.`remarks` AS `remarks` from `uobs-db`.`lms_personal_event` ;

-- --------------------------------------------------------

--
-- Structure for view `lms_return_assignment`
--
DROP TABLE IF EXISTS `lms_return_assignment`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lms_return_assignment`  AS  select `uobs-db`.`lms_return_assignment`.`return_id` AS `return_id`,`uobs-db`.`lms_return_assignment`.`sub_assi_id` AS `sub_assi_id`,`uobs-db`.`lms_return_assignment`.`return_file` AS `return_file` from `uobs-db`.`lms_return_assignment` ;

-- --------------------------------------------------------

--
-- Structure for view `lms_submitte_assignment`
--
DROP TABLE IF EXISTS `lms_submitte_assignment`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lms_submitte_assignment`  AS  select `uobs-db`.`lms_submitte_assignment`.`sub_assi_id` AS `sub_assi_id`,`uobs-db`.`lms_submitte_assignment`.`std_id` AS `std_id`,`uobs-db`.`lms_submitte_assignment`.`assi_id` AS `assi_id`,`uobs-db`.`lms_submitte_assignment`.`remarks` AS `remarks`,`uobs-db`.`lms_submitte_assignment`.`submission_date` AS `submission_date`,`uobs-db`.`lms_submitte_assignment`.`marks` AS `marks` from `uobs-db`.`lms_submitte_assignment` ;

-- --------------------------------------------------------

--
-- Structure for view `lms_submitte_file`
--
DROP TABLE IF EXISTS `lms_submitte_file`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lms_submitte_file`  AS  select `uobs-db`.`lms_submitte_file`.`f_id` AS `f_id`,`uobs-db`.`lms_submitte_file`.`sub_assi_id` AS `sub_assi_id`,`uobs-db`.`lms_submitte_file`.`sub_file` AS `sub_file` from `uobs-db`.`lms_submitte_file` ;

-- --------------------------------------------------------

--
-- Structure for view `lms_syllabus`
--
DROP TABLE IF EXISTS `lms_syllabus`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lms_syllabus`  AS  select `uobs-db`.`lms_syllabus`.`syl_id` AS `syl_id`,`uobs-db`.`lms_syllabus`.`lecture_id` AS `lecture_id`,`uobs-db`.`lms_syllabus`.`lecture` AS `lecture`,`uobs-db`.`lms_syllabus`.`topic` AS `topic`,`uobs-db`.`lms_syllabus`.`reading` AS `reading`,`uobs-db`.`lms_syllabus`.`cofr_id` AS `cofr_id` from `uobs-db`.`lms_syllabus` ;

-- --------------------------------------------------------

--
-- Structure for view `lms_visiting_bill`
--
DROP TABLE IF EXISTS `lms_visiting_bill`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lms_visiting_bill`  AS  select `uobs-db`.`lms_visiting_bill`.`id` AS `id`,`uobs-db`.`lms_visiting_bill`.`c_offer_id` AS `c_offer_id`,`uobs-db`.`lms_visiting_bill`.`last_lecture_date` AS `last_lecture_date`,`uobs-db`.`lms_visiting_bill`.`generate_date` AS `generate_date`,`uobs-db`.`lms_visiting_bill`.`t_amount` AS `t_amount`,`uobs-db`.`lms_visiting_bill`.`paid` AS `paid` from `uobs-db`.`lms_visiting_bill` ;

-- --------------------------------------------------------

--
-- Structure for view `s04cf_session`
--
DROP TABLE IF EXISTS `s04cf_session`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `s04cf_session`  AS  select `uobs-db`.`s04cf_session`.`session_id` AS `session_id`,`uobs-db`.`s04cf_session`.`client_id` AS `client_id`,`uobs-db`.`s04cf_session`.`guest` AS `guest`,`uobs-db`.`s04cf_session`.`time` AS `time`,`uobs-db`.`s04cf_session`.`data` AS `data`,`uobs-db`.`s04cf_session`.`userid` AS `userid`,`uobs-db`.`s04cf_session`.`username` AS `username` from `uobs-db`.`s04cf_session` ;

-- --------------------------------------------------------

--
-- Structure for view `s04cf_usergroups`
--
DROP TABLE IF EXISTS `s04cf_usergroups`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `s04cf_usergroups`  AS  select `uobs-db`.`s04cf_usergroups`.`id` AS `id`,`uobs-db`.`s04cf_usergroups`.`parent_id` AS `parent_id`,`uobs-db`.`s04cf_usergroups`.`lft` AS `lft`,`uobs-db`.`s04cf_usergroups`.`rgt` AS `rgt`,`uobs-db`.`s04cf_usergroups`.`title` AS `title` from `uobs-db`.`s04cf_usergroups` ;

-- --------------------------------------------------------

--
-- Structure for view `s04cf_users`
--
DROP TABLE IF EXISTS `s04cf_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `s04cf_users`  AS  select `uobs-db`.`s04cf_users`.`id` AS `id`,`uobs-db`.`s04cf_users`.`name` AS `name`,`uobs-db`.`s04cf_users`.`username` AS `username`,`uobs-db`.`s04cf_users`.`email` AS `email`,`uobs-db`.`s04cf_users`.`password` AS `password`,`uobs-db`.`s04cf_users`.`block` AS `block`,`uobs-db`.`s04cf_users`.`sendEmail` AS `sendEmail`,`uobs-db`.`s04cf_users`.`registerDate` AS `registerDate`,`uobs-db`.`s04cf_users`.`lastvisitDate` AS `lastvisitDate`,`uobs-db`.`s04cf_users`.`activation` AS `activation`,`uobs-db`.`s04cf_users`.`params` AS `params`,`uobs-db`.`s04cf_users`.`lastResetTime` AS `lastResetTime`,`uobs-db`.`s04cf_users`.`resetCount` AS `resetCount`,`uobs-db`.`s04cf_users`.`otpKey` AS `otpKey`,`uobs-db`.`s04cf_users`.`otep` AS `otep`,`uobs-db`.`s04cf_users`.`requireReset` AS `requireReset` from `uobs-db`.`s04cf_users` ;

-- --------------------------------------------------------

--
-- Structure for view `s04cf_user_usergroup_map`
--
DROP TABLE IF EXISTS `s04cf_user_usergroup_map`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `s04cf_user_usergroup_map`  AS  select `uobs-db`.`s04cf_user_usergroup_map`.`user_id` AS `user_id`,`uobs-db`.`s04cf_user_usergroup_map`.`group_id` AS `group_id` from `uobs-db`.`s04cf_user_usergroup_map` ;

-- --------------------------------------------------------

--
-- Structure for view `s04cf_viewlevels`
--
DROP TABLE IF EXISTS `s04cf_viewlevels`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `s04cf_viewlevels`  AS  select `uobs-db`.`s04cf_viewlevels`.`id` AS `id`,`uobs-db`.`s04cf_viewlevels`.`title` AS `title`,`uobs-db`.`s04cf_viewlevels`.`ordering` AS `ordering`,`uobs-db`.`s04cf_viewlevels`.`rules` AS `rules` from `uobs-db`.`s04cf_viewlevels` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `s04cf_assets`
--
ALTER TABLE `s04cf_assets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_asset_name` (`name`),
  ADD KEY `idx_lft_rgt` (`lft`,`rgt`),
  ADD KEY `idx_parent_id` (`parent_id`);

--
-- Indexes for table `s04cf_associations`
--
ALTER TABLE `s04cf_associations`
  ADD PRIMARY KEY (`context`,`id`),
  ADD KEY `idx_key` (`key`);

--
-- Indexes for table `s04cf_banners`
--
ALTER TABLE `s04cf_banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_state` (`state`),
  ADD KEY `idx_own_prefix` (`own_prefix`),
  ADD KEY `idx_banner_catid` (`catid`),
  ADD KEY `idx_language` (`language`),
  ADD KEY `idx_metakey_prefix` (`metakey_prefix`(100));

--
-- Indexes for table `s04cf_banner_clients`
--
ALTER TABLE `s04cf_banner_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_own_prefix` (`own_prefix`),
  ADD KEY `idx_metakey_prefix` (`metakey_prefix`(100));

--
-- Indexes for table `s04cf_banner_tracks`
--
ALTER TABLE `s04cf_banner_tracks`
  ADD PRIMARY KEY (`track_date`,`track_type`,`banner_id`),
  ADD KEY `idx_track_date` (`track_date`),
  ADD KEY `idx_track_type` (`track_type`),
  ADD KEY `idx_banner_id` (`banner_id`);

--
-- Indexes for table `s04cf_categories`
--
ALTER TABLE `s04cf_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_idx` (`extension`,`published`,`access`),
  ADD KEY `idx_access` (`access`),
  ADD KEY `idx_checkout` (`checked_out`),
  ADD KEY `idx_left_right` (`lft`,`rgt`),
  ADD KEY `idx_language` (`language`),
  ADD KEY `idx_path` (`path`(100)),
  ADD KEY `idx_alias` (`alias`(100));

--
-- Indexes for table `s04cf_contact_details`
--
ALTER TABLE `s04cf_contact_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_access` (`access`),
  ADD KEY `idx_checkout` (`checked_out`),
  ADD KEY `idx_state` (`published`),
  ADD KEY `idx_catid` (`catid`),
  ADD KEY `idx_createdby` (`created_by`),
  ADD KEY `idx_featured_catid` (`featured`,`catid`),
  ADD KEY `idx_language` (`language`),
  ADD KEY `idx_xreference` (`xreference`);

--
-- Indexes for table `s04cf_content`
--
ALTER TABLE `s04cf_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_access` (`access`),
  ADD KEY `idx_checkout` (`checked_out`),
  ADD KEY `idx_state` (`state`),
  ADD KEY `idx_catid` (`catid`),
  ADD KEY `idx_createdby` (`created_by`),
  ADD KEY `idx_featured_catid` (`featured`,`catid`),
  ADD KEY `idx_language` (`language`),
  ADD KEY `idx_xreference` (`xreference`);

--
-- Indexes for table `s04cf_contentitem_tag_map`
--
ALTER TABLE `s04cf_contentitem_tag_map`
  ADD UNIQUE KEY `uc_ItemnameTagid` (`type_id`,`content_item_id`,`tag_id`),
  ADD KEY `idx_tag_type` (`tag_id`,`type_id`),
  ADD KEY `idx_date_id` (`tag_date`,`tag_id`),
  ADD KEY `idx_core_content_id` (`core_content_id`);

--
-- Indexes for table `s04cf_content_frontpage`
--
ALTER TABLE `s04cf_content_frontpage`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `s04cf_content_rating`
--
ALTER TABLE `s04cf_content_rating`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `s04cf_content_types`
--
ALTER TABLE `s04cf_content_types`
  ADD PRIMARY KEY (`type_id`),
  ADD KEY `idx_alias` (`type_alias`(100));

--
-- Indexes for table `s04cf_extensions`
--
ALTER TABLE `s04cf_extensions`
  ADD PRIMARY KEY (`extension_id`),
  ADD KEY `element_clientid` (`element`,`client_id`),
  ADD KEY `element_folder_clientid` (`element`,`folder`,`client_id`),
  ADD KEY `extension` (`type`,`element`,`folder`,`client_id`);

--
-- Indexes for table `s04cf_finder_filters`
--
ALTER TABLE `s04cf_finder_filters`
  ADD PRIMARY KEY (`filter_id`);

--
-- Indexes for table `s04cf_finder_links`
--
ALTER TABLE `s04cf_finder_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `idx_type` (`type_id`),
  ADD KEY `idx_md5` (`md5sum`),
  ADD KEY `idx_url` (`url`(75)),
  ADD KEY `idx_published_list` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`list_price`),
  ADD KEY `idx_published_sale` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`sale_price`),
  ADD KEY `idx_title` (`title`(100));

--
-- Indexes for table `s04cf_finder_links_terms0`
--
ALTER TABLE `s04cf_finder_links_terms0`
  ADD PRIMARY KEY (`link_id`,`term_id`),
  ADD KEY `idx_term_weight` (`term_id`,`weight`),
  ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `s04cf_finder_links_terms1`
--
ALTER TABLE `s04cf_finder_links_terms1`
  ADD PRIMARY KEY (`link_id`,`term_id`),
  ADD KEY `idx_term_weight` (`term_id`,`weight`),
  ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `s04cf_finder_links_terms2`
--
ALTER TABLE `s04cf_finder_links_terms2`
  ADD PRIMARY KEY (`link_id`,`term_id`),
  ADD KEY `idx_term_weight` (`term_id`,`weight`),
  ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `s04cf_finder_links_terms3`
--
ALTER TABLE `s04cf_finder_links_terms3`
  ADD PRIMARY KEY (`link_id`,`term_id`),
  ADD KEY `idx_term_weight` (`term_id`,`weight`),
  ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `s04cf_finder_links_terms4`
--
ALTER TABLE `s04cf_finder_links_terms4`
  ADD PRIMARY KEY (`link_id`,`term_id`),
  ADD KEY `idx_term_weight` (`term_id`,`weight`),
  ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `s04cf_finder_links_terms5`
--
ALTER TABLE `s04cf_finder_links_terms5`
  ADD PRIMARY KEY (`link_id`,`term_id`),
  ADD KEY `idx_term_weight` (`term_id`,`weight`),
  ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `s04cf_finder_links_terms6`
--
ALTER TABLE `s04cf_finder_links_terms6`
  ADD PRIMARY KEY (`link_id`,`term_id`),
  ADD KEY `idx_term_weight` (`term_id`,`weight`),
  ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `s04cf_finder_links_terms7`
--
ALTER TABLE `s04cf_finder_links_terms7`
  ADD PRIMARY KEY (`link_id`,`term_id`),
  ADD KEY `idx_term_weight` (`term_id`,`weight`),
  ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `s04cf_finder_links_terms8`
--
ALTER TABLE `s04cf_finder_links_terms8`
  ADD PRIMARY KEY (`link_id`,`term_id`),
  ADD KEY `idx_term_weight` (`term_id`,`weight`),
  ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `s04cf_finder_links_terms9`
--
ALTER TABLE `s04cf_finder_links_terms9`
  ADD PRIMARY KEY (`link_id`,`term_id`),
  ADD KEY `idx_term_weight` (`term_id`,`weight`),
  ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `s04cf_finder_links_termsa`
--
ALTER TABLE `s04cf_finder_links_termsa`
  ADD PRIMARY KEY (`link_id`,`term_id`),
  ADD KEY `idx_term_weight` (`term_id`,`weight`),
  ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `s04cf_finder_links_termsb`
--
ALTER TABLE `s04cf_finder_links_termsb`
  ADD PRIMARY KEY (`link_id`,`term_id`),
  ADD KEY `idx_term_weight` (`term_id`,`weight`),
  ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `s04cf_finder_links_termsc`
--
ALTER TABLE `s04cf_finder_links_termsc`
  ADD PRIMARY KEY (`link_id`,`term_id`),
  ADD KEY `idx_term_weight` (`term_id`,`weight`),
  ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `s04cf_finder_links_termsd`
--
ALTER TABLE `s04cf_finder_links_termsd`
  ADD PRIMARY KEY (`link_id`,`term_id`),
  ADD KEY `idx_term_weight` (`term_id`,`weight`),
  ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `s04cf_finder_links_termse`
--
ALTER TABLE `s04cf_finder_links_termse`
  ADD PRIMARY KEY (`link_id`,`term_id`),
  ADD KEY `idx_term_weight` (`term_id`,`weight`),
  ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `s04cf_finder_links_termsf`
--
ALTER TABLE `s04cf_finder_links_termsf`
  ADD PRIMARY KEY (`link_id`,`term_id`),
  ADD KEY `idx_term_weight` (`term_id`,`weight`),
  ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `s04cf_finder_taxonomy`
--
ALTER TABLE `s04cf_finder_taxonomy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `state` (`state`),
  ADD KEY `ordering` (`ordering`),
  ADD KEY `access` (`access`),
  ADD KEY `idx_parent_published` (`parent_id`,`state`,`access`);

--
-- Indexes for table `s04cf_finder_taxonomy_map`
--
ALTER TABLE `s04cf_finder_taxonomy_map`
  ADD PRIMARY KEY (`link_id`,`node_id`),
  ADD KEY `link_id` (`link_id`),
  ADD KEY `node_id` (`node_id`);

--
-- Indexes for table `s04cf_finder_terms`
--
ALTER TABLE `s04cf_finder_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD UNIQUE KEY `idx_term` (`term`),
  ADD KEY `idx_term_phrase` (`term`,`phrase`),
  ADD KEY `idx_stem_phrase` (`stem`,`phrase`),
  ADD KEY `idx_soundex_phrase` (`soundex`,`phrase`);

--
-- Indexes for table `s04cf_finder_terms_common`
--
ALTER TABLE `s04cf_finder_terms_common`
  ADD KEY `idx_word_lang` (`term`,`language`),
  ADD KEY `idx_lang` (`language`);

--
-- Indexes for table `s04cf_finder_tokens`
--
ALTER TABLE `s04cf_finder_tokens`
  ADD KEY `idx_word` (`term`),
  ADD KEY `idx_context` (`context`);

--
-- Indexes for table `s04cf_finder_tokens_aggregate`
--
ALTER TABLE `s04cf_finder_tokens_aggregate`
  ADD KEY `token` (`term`),
  ADD KEY `keyword_id` (`term_id`);

--
-- Indexes for table `s04cf_finder_types`
--
ALTER TABLE `s04cf_finder_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `s04cf_languages`
--
ALTER TABLE `s04cf_languages`
  ADD PRIMARY KEY (`lang_id`),
  ADD UNIQUE KEY `idx_sef` (`sef`),
  ADD UNIQUE KEY `idx_image` (`image`),
  ADD UNIQUE KEY `idx_langcode` (`lang_code`),
  ADD KEY `idx_access` (`access`),
  ADD KEY `idx_ordering` (`ordering`);

--
-- Indexes for table `s04cf_menu`
--
ALTER TABLE `s04cf_menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_client_id_parent_id_alias_language` (`client_id`,`parent_id`,`alias`(100),`language`),
  ADD KEY `idx_componentid` (`component_id`,`menutype`,`published`,`access`),
  ADD KEY `idx_menutype` (`menutype`),
  ADD KEY `idx_left_right` (`lft`,`rgt`),
  ADD KEY `idx_language` (`language`),
  ADD KEY `idx_alias` (`alias`(100)),
  ADD KEY `idx_path` (`path`(100));

--
-- Indexes for table `s04cf_menu_types`
--
ALTER TABLE `s04cf_menu_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_menutype` (`menutype`);

--
-- Indexes for table `s04cf_messages`
--
ALTER TABLE `s04cf_messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `useridto_state` (`user_id_to`,`state`);

--
-- Indexes for table `s04cf_messages_cfg`
--
ALTER TABLE `s04cf_messages_cfg`
  ADD UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`);

--
-- Indexes for table `s04cf_modules`
--
ALTER TABLE `s04cf_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `published` (`published`,`access`),
  ADD KEY `newsfeeds` (`module`,`published`),
  ADD KEY `idx_language` (`language`);

--
-- Indexes for table `s04cf_modules_menu`
--
ALTER TABLE `s04cf_modules_menu`
  ADD PRIMARY KEY (`moduleid`,`menuid`);

--
-- Indexes for table `s04cf_newsfeeds`
--
ALTER TABLE `s04cf_newsfeeds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_access` (`access`),
  ADD KEY `idx_checkout` (`checked_out`),
  ADD KEY `idx_state` (`published`),
  ADD KEY `idx_catid` (`catid`),
  ADD KEY `idx_createdby` (`created_by`),
  ADD KEY `idx_language` (`language`),
  ADD KEY `idx_xreference` (`xreference`);

--
-- Indexes for table `s04cf_overrider`
--
ALTER TABLE `s04cf_overrider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s04cf_postinstall_messages`
--
ALTER TABLE `s04cf_postinstall_messages`
  ADD PRIMARY KEY (`postinstall_message_id`);

--
-- Indexes for table `s04cf_redirect_links`
--
ALTER TABLE `s04cf_redirect_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_link_modifed` (`modified_date`),
  ADD KEY `idx_old_url` (`old_url`(100));

--
-- Indexes for table `s04cf_schemas`
--
ALTER TABLE `s04cf_schemas`
  ADD PRIMARY KEY (`extension_id`,`version_id`);

--
-- Indexes for table `s04cf_tags`
--
ALTER TABLE `s04cf_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_idx` (`published`,`access`),
  ADD KEY `idx_access` (`access`),
  ADD KEY `idx_checkout` (`checked_out`),
  ADD KEY `idx_left_right` (`lft`,`rgt`),
  ADD KEY `idx_language` (`language`),
  ADD KEY `idx_path` (`path`(100)),
  ADD KEY `idx_alias` (`alias`(100));

--
-- Indexes for table `s04cf_template_styles`
--
ALTER TABLE `s04cf_template_styles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_template` (`template`),
  ADD KEY `idx_home` (`home`);

--
-- Indexes for table `s04cf_ucm_base`
--
ALTER TABLE `s04cf_ucm_base`
  ADD PRIMARY KEY (`ucm_id`),
  ADD KEY `idx_ucm_item_id` (`ucm_item_id`),
  ADD KEY `idx_ucm_type_id` (`ucm_type_id`),
  ADD KEY `idx_ucm_language_id` (`ucm_language_id`);

--
-- Indexes for table `s04cf_ucm_content`
--
ALTER TABLE `s04cf_ucm_content`
  ADD PRIMARY KEY (`core_content_id`),
  ADD KEY `tag_idx` (`core_state`,`core_access`),
  ADD KEY `idx_access` (`core_access`),
  ADD KEY `idx_language` (`core_language`),
  ADD KEY `idx_modified_time` (`core_modified_time`),
  ADD KEY `idx_created_time` (`core_created_time`),
  ADD KEY `idx_core_modified_user_id` (`core_modified_user_id`),
  ADD KEY `idx_core_checked_out_user_id` (`core_checked_out_user_id`),
  ADD KEY `idx_core_created_user_id` (`core_created_user_id`),
  ADD KEY `idx_core_type_id` (`core_type_id`),
  ADD KEY `idx_alias` (`core_alias`(100)),
  ADD KEY `idx_title` (`core_title`(100)),
  ADD KEY `idx_content_type` (`core_type_alias`(100));

--
-- Indexes for table `s04cf_ucm_history`
--
ALTER TABLE `s04cf_ucm_history`
  ADD PRIMARY KEY (`version_id`),
  ADD KEY `idx_ucm_item_id` (`ucm_type_id`,`ucm_item_id`),
  ADD KEY `idx_save_date` (`save_date`);

--
-- Indexes for table `s04cf_updates`
--
ALTER TABLE `s04cf_updates`
  ADD PRIMARY KEY (`update_id`);

--
-- Indexes for table `s04cf_update_sites`
--
ALTER TABLE `s04cf_update_sites`
  ADD PRIMARY KEY (`update_site_id`);

--
-- Indexes for table `s04cf_update_sites_extensions`
--
ALTER TABLE `s04cf_update_sites_extensions`
  ADD PRIMARY KEY (`update_site_id`,`extension_id`);

--
-- Indexes for table `s04cf_user_keys`
--
ALTER TABLE `s04cf_user_keys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `series` (`series`),
  ADD UNIQUE KEY `series_2` (`series`),
  ADD UNIQUE KEY `series_3` (`series`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `s04cf_user_notes`
--
ALTER TABLE `s04cf_user_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_category_id` (`catid`);

--
-- Indexes for table `s04cf_user_profiles`
--
ALTER TABLE `s04cf_user_profiles`
  ADD UNIQUE KEY `idx_user_id_profile_key` (`user_id`,`profile_key`);

--
-- Indexes for table `s04cf_weblinks`
--
ALTER TABLE `s04cf_weblinks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_access` (`access`),
  ADD KEY `idx_checkout` (`checked_out`),
  ADD KEY `idx_state` (`state`),
  ADD KEY `idx_catid` (`catid`),
  ADD KEY `idx_createdby` (`created_by`),
  ADD KEY `idx_featured_catid` (`featured`,`catid`),
  ADD KEY `idx_language` (`language`),
  ADD KEY `idx_xreference` (`xreference`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `s04cf_assets`
--
ALTER TABLE `s04cf_assets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=178;
--
-- AUTO_INCREMENT for table `s04cf_banners`
--
ALTER TABLE `s04cf_banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `s04cf_banner_clients`
--
ALTER TABLE `s04cf_banner_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `s04cf_categories`
--
ALTER TABLE `s04cf_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `s04cf_contact_details`
--
ALTER TABLE `s04cf_contact_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `s04cf_content`
--
ALTER TABLE `s04cf_content`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT for table `s04cf_content_types`
--
ALTER TABLE `s04cf_content_types`
  MODIFY `type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000;
--
-- AUTO_INCREMENT for table `s04cf_extensions`
--
ALTER TABLE `s04cf_extensions`
  MODIFY `extension_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10006;
--
-- AUTO_INCREMENT for table `s04cf_finder_filters`
--
ALTER TABLE `s04cf_finder_filters`
  MODIFY `filter_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `s04cf_finder_links`
--
ALTER TABLE `s04cf_finder_links`
  MODIFY `link_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `s04cf_finder_taxonomy`
--
ALTER TABLE `s04cf_finder_taxonomy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `s04cf_finder_terms`
--
ALTER TABLE `s04cf_finder_terms`
  MODIFY `term_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `s04cf_finder_types`
--
ALTER TABLE `s04cf_finder_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `s04cf_languages`
--
ALTER TABLE `s04cf_languages`
  MODIFY `lang_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `s04cf_menu`
--
ALTER TABLE `s04cf_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=384;
--
-- AUTO_INCREMENT for table `s04cf_menu_types`
--
ALTER TABLE `s04cf_menu_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `s04cf_messages`
--
ALTER TABLE `s04cf_messages`
  MODIFY `message_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `s04cf_modules`
--
ALTER TABLE `s04cf_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `s04cf_newsfeeds`
--
ALTER TABLE `s04cf_newsfeeds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `s04cf_overrider`
--
ALTER TABLE `s04cf_overrider`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';
--
-- AUTO_INCREMENT for table `s04cf_postinstall_messages`
--
ALTER TABLE `s04cf_postinstall_messages`
  MODIFY `postinstall_message_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `s04cf_redirect_links`
--
ALTER TABLE `s04cf_redirect_links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `s04cf_tags`
--
ALTER TABLE `s04cf_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `s04cf_template_styles`
--
ALTER TABLE `s04cf_template_styles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `s04cf_ucm_content`
--
ALTER TABLE `s04cf_ucm_content`
  MODIFY `core_content_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `s04cf_ucm_history`
--
ALTER TABLE `s04cf_ucm_history`
  MODIFY `version_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT for table `s04cf_updates`
--
ALTER TABLE `s04cf_updates`
  MODIFY `update_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `s04cf_update_sites`
--
ALTER TABLE `s04cf_update_sites`
  MODIFY `update_site_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `s04cf_user_keys`
--
ALTER TABLE `s04cf_user_keys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT for table `s04cf_user_notes`
--
ALTER TABLE `s04cf_user_notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `s04cf_weblinks`
--
ALTER TABLE `s04cf_weblinks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
