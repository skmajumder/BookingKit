-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2020 at 10:05 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_status`
--

CREATE TABLE `active_status` (
  `active_id` int(11) NOT NULL,
  `status_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `active_status`
--

INSERT INTO `active_status` (`active_id`, `status_type`) VALUES
(0, 'pending'),
(1, 'approved'),
(2, 'cancel');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `industry_id` int(11) NOT NULL,
  `academy_id` int(11) NOT NULL,
  `booking_date` varchar(255) NOT NULL,
  `booking_time` varchar(255) NOT NULL,
  `created_date` varchar(255) NOT NULL,
  `total_teacher` int(5) NOT NULL,
  `total_male_student` int(5) NOT NULL,
  `total_female_student` int(5) NOT NULL,
  `total_stuff` int(5) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `tour_end` tinyint(4) NOT NULL DEFAULT 0,
  `review` int(11) NOT NULL DEFAULT 0,
  `notice` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `industry_id`, `academy_id`, `booking_date`, `booking_time`, `created_date`, `total_teacher`, `total_male_student`, `total_female_student`, `total_stuff`, `active`, `tour_end`, `review`, `notice`) VALUES
(4, 27, 2, '07/03/2020', '9:00 am', '02/07/2020', 5, 5, 5, 5, 2, 0, 0, 0),
(5, 20, 2, '07/04/2020', '10:00 am', '02/07/2020', 5, 20, 10, 5, 1, 1, 1, 1),
(6, 27, 2, '07/08/2020', '9:00 am', '06/07/2020', 5, 20, 4, 2, 1, 1, 1, 1),
(8, 28, 2, '08/06/2020', '10:00 am', '07/30/2020', 4, 25, 8, 3, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `faculty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `faculty_id`) VALUES
(1, 'Bangla', 1),
(2, 'English', 1),
(3, 'History', 1),
(4, 'Philosophy', 1),
(5, 'Islamic History and Culture', 1),
(6, 'Sanskrit', 1),
(7, 'Bangladesh Studies', 1),
(8, 'Information Science and Library Management', 1),
(9, 'Theatre and Performance Studies', 1),
(10, 'Linguistics', 1),
(11, 'Physics', 2),
(12, 'Chemistry', 2),
(13, 'Mathematics', 2),
(14, 'Statistics', 2),
(15, 'Biomedical Physics & Technology', 2),
(16, 'Applied Mathematics', 2),
(17, 'Theoretical and Computational Chemistry', 2),
(18, 'Accounting', 3),
(19, 'Management', 3),
(20, 'Finance', 3),
(21, 'Marketing', 3),
(22, 'Human Resource Management', 3),
(23, 'Banking and Insurance', 3),
(24, 'Management Information Systems', 3),
(25, 'International Business', 3),
(26, 'Tourism and Hospitality Management', 3),
(27, 'Organization Strategy and Leadership', 3),
(28, 'Economics', 4),
(29, 'Political Science', 4),
(30, 'Sociology', 4),
(31, 'Public Administration', 4),
(32, 'Anthropology', 4),
(33, 'International Relations', 4),
(34, 'Communication and Journalism', 4),
(35, 'Criminology and Police Science', 4),
(36, 'Development Studies', 4),
(37, 'Public Administration', 4),
(38, 'Anthropology', 4),
(39, 'Population Sciences', 4),
(40, 'Peace and Conflict Studies', 4),
(41, 'Women and Gender Studies', 4),
(42, 'Television Film and Photography', 4),
(43, 'Criminology', 4),
(44, 'Communication Disorders', 4),
(45, 'Printing and Publication Studies', 4),
(46, 'Law', 5),
(47, 'Zoology', 6),
(48, 'Botany', 6),
(49, 'Geography and Environmental Studies', 6),
(50, 'Biochemistry and Molecular Biology', 6),
(51, 'Microbiology', 6),
(52, 'Soil Water & Environment', 6),
(53, 'Genetic Engineering and Biotechnology', 6),
(54, 'Psychology', 6),
(55, 'Fisheries', 6),
(56, 'Clinical Psychology', 6),
(57, 'Computer Science & Engineering', 7),
(58, 'Electrical and Electronic Engineering', 7),
(59, 'Applied Chemistry & Chemical Engineering', 7),
(60, 'Nuclear Engineering', 7),
(61, 'Robotics and Mechatronics Engineering', 7),
(62, 'Civil Engineering', 7),
(63, 'Mechanical Engineering', 7),
(64, 'Architecture & Planning', 7),
(65, 'Oceanography', 8),
(66, 'Fisheries', 8),
(67, 'Medicine', 9),
(68, 'Physical Education and Sports Science', 10),
(69, 'Pharmaceutical Chemistry', 11),
(70, 'Clinical Pharmacy and Pharmacology', 11),
(71, 'Pharmaceutical Technology', 11),
(72, 'Pharmacy', 11),
(73, 'Geography & Environment', 12),
(74, 'Geology', 12),
(75, 'Oceanography', 12),
(76, 'Disaster Science and Management', 12),
(77, 'Meteorology', 12);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL,
  `faculty_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_name`) VALUES
(1, 'Arts and Humanities'),
(2, 'Science & Technology'),
(3, 'Business Administration'),
(4, 'Social Sciences'),
(5, 'Law'),
(6, 'Biological Sciences'),
(7, 'Engineering'),
(8, 'Marine Sciences'),
(9, 'Medicine'),
(10, 'Education'),
(11, 'Pharmacy'),
(12, 'Earth and Environmental Sciences');

-- --------------------------------------------------------

--
-- Table structure for table `industry_information`
--

CREATE TABLE `industry_information` (
  `id` int(11) NOT NULL,
  `industry_slogan` text NOT NULL,
  `industry_details` text NOT NULL,
  `industry_mission` text NOT NULL,
  `industry_vision` text NOT NULL,
  `industry_environment` text NOT NULL,
  `industry_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `industry_information`
--

INSERT INTO `industry_information` (`id`, `industry_slogan`, `industry_details`, `industry_mission`, `industry_vision`, `industry_environment`, `industry_id`) VALUES
(1, 'One of South Asia&rsquo;s largest vertically integrated textile and garment companies with in-house analytical and creative abilities', 'Bextex Ltd. (the &quot;Company&quot;) was incorporated in Bangladesh as a Public Limited Company with limited liability on 8 March 1994 and commenced commercial operation in 1995 and also went into the public issue of shares and debentures in the same year. The shares of the Company are listed in the Dhaka and Chittagong Stock Exchanges of Bangladesh.\r\n\r\nBextex Ltd. is the most modern composite mill in the region. Bextex Ltd. has an installed capacity of 288 high-speed air-jet looms in its weaving section and a high-tech dyeing and finishing section with a capacity of 100,000 yards of finished fabric per day. This company is located at the Beximco Industrial Park .\r\n\r\nBextex Ltd. has a state of the art composite knit fabric production mill, which serves the growing needs of high-quality knit garments exporters in Bangladesh. The project was set up as a state of the art knit fabric knitting, dyeing and finishing facility. During the year the Company produced and sold high quality of knit fabrics and bringing forth all the latest in hard and soft technologies in knitting, dyeing and finishing of knit fabric.\r\n\r\nBextex Ltd. also has a cotton and polyester blended yarn-spinning mill, with 122,000 spindles is one of the largest spinning mills of the country. The mill was set up to feed the country\'s export oriented industries.\r\n\r\nBextex Ltd. produces specialized finishes of denim cloth for export in finished as well as cloth only form.', 'BEXTEX Ltd. is a full service vendor with strong vertically integrated production facilities as well as creative &amp; analytical capabilities which clearly sets us apart from most other South Asian vendors.', 'Gain market leadership in high value added apparel in USA &amp; Europe .\r\n\r\nUse &ldquo;Innovation&rdquo; &amp; &ldquo;Speed&rdquo; as prime drivers, rather than cotton &amp; cheap labour.', 'Our company is very committed to preserve a healthy and pollution-free environment. It has a very efficient waste collection and disposal system. In order to reduce air pollution by exhaust of gas from engine-generators, it maintains a costly plant that uses the exhaust gas to generate steam for chilling unit. Above measures not only help keep the water &amp; air free from pollution but also help save cost of water treatment &amp; air conditioning. Your company uses only AZO-free dyes and is dedicated to ensure a healthy and eco-friendly environment. ', 20),
(2, 'Improving Livehood', 'PRAN stands for “Program for Rural Advancement Nationally” and RFL stands for “Rangpur Foundry Limited” I think it is the largest FMCG industry in Bangladesh', 'overty & hunger are curses. Our aim is to generate employment and earn dignity & self-respect for our compatriots through profitable enterprises.', 'Improving Livelihood', 'The idea of corporate social responsibility is being widely promoted all over the world and rightly so, PRAN has the bifocal objective of making profits through the fulfillment of corporate social responsibilities.', 27),
(4, 'Changing Lifestyle', 'DataSoft Systems Bangladesh Limited is a CMMI Level - 5 &amp; ISO 9001:2000 certified leading software company in Bangladesh. Founded in 1998, DataSoft has successful track records for delivering the most innovative and cost-effective technical services to customers in both commercial and Government sectors. Since its inception back in 1998, stepped into the core field of ICT to cater to the needs of enterprise, governance, and economy.\r\n\r\nStrengthened by a strong team of experienced professionals DataSoft has a unique approach towards continuous training and development of human resources to adapt to the market demands for the national and international venues. DataSoft is incorporating new technology to further expand the client base and continue to serve clients with a little more than utmost satisfaction.\r\n', 'Creates customized technological solutions for changing customer needs with flawless execution and world-class advisory services.', '', 'Pointing on different industry trends, polishes solutions and services to meet the customized requirements for players across different industries', 28);

-- --------------------------------------------------------

--
-- Table structure for table `industry_type`
--

CREATE TABLE `industry_type` (
  `industry_id` int(11) NOT NULL,
  `industry_category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `industry_type`
--

INSERT INTO `industry_type` (`industry_id`, `industry_category_name`) VALUES
(1, 'IT'),
(2, 'Telecommunication'),
(3, 'Agriculture'),
(4, 'Construction'),
(5, 'Pharmaceutical'),
(6, 'Food and Beverage'),
(7, 'Health Care'),
(8, 'News Media'),
(9, 'Textile'),
(10, 'Energy'),
(11, 'Manufacturing'),
(12, 'Electronics'),
(13, 'Export Import'),
(14, 'Entertainment'),
(15, 'Mining'),
(16, 'Transportation and Warehousing'),
(17, 'Aerospace'),
(18, 'Hospitality'),
(19, 'Music'),
(20, 'Finance');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` int(11) NOT NULL,
  `active` int(5) NOT NULL,
  `validation_code` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `password`, `user_type`, `active`, `validation_code`) VALUES
(15, 'info@beximco.net', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '0'),
(18, 'skmajumder.cse@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 3, 1, '0'),
(19, 'crd@prangroup.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '0'),
(20, 'admission@portcity.edu.bd', 'e10adc3949ba59abbe56e057f20f883e', 2, 1, '0'),
(21, 'shuvokumarmajumder@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 4, 1, '0'),
(24, 'tasinmahbub79@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 3, 1, '0'),
(25, 'info@datasoft-bd.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '0'),
(26, 'raihanremon534@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 3, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `notice_title` text NOT NULL,
  `notice_content` text NOT NULL,
  `notice_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `booking_id`, `program_id`, `batch`, `notice_title`, `notice_content`, `notice_date`) VALUES
(1, 8, 1, 'CSE009', 'Industrial Visit Notice', 'This is to inform you that the following students of the CSE009 batch are selected to go for an Industrial visit on August 6, 2020, to DataSoft Systems Bangladesh Limited, Address: Rupayan Shelford (20th Floor), 23/6, Mirpur Road, Shyamoli, Dhaka-1207, Bangladesh.\r\n\r\nAll the students are requested to take the bus from the university campus which will leave the campus at 6.00 PM on August 5, 2020, without any delay.\r\n\r\nWish you all a happy industrial trip.', '07/31/2020'),
(2, 8, 1, 'CSE009', 'Industrial Visit Notice 2', 'Dear All,\r\nAll the students CSE009 are requested to take the bus from the university campus which will leave the campus at 6.00 PM on August 5, 2020, without any delay.\r\n\r\nWish you all a happy industrial trip.', '07/31/2020');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `program_id` int(11) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`program_id`, `program_name`, `department_id`) VALUES
(1, 'B.Sc. In CSE', 57),
(2, 'B.Sc. In EEE', 58);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `industry_id` int(11) NOT NULL,
  `academy_id` int(11) NOT NULL,
  `rating_star` int(11) NOT NULL,
  `review_title` text DEFAULT NULL,
  `review_comment` text NOT NULL,
  `created_date` varchar(255) NOT NULL,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `industry_id`, `academy_id`, `rating_star`, `review_title`, `review_comment`, `created_date`, `booking_id`) VALUES
(1, 20, 2, 4, '', 'Good.', '05/07/2020', 5),
(2, 27, 2, 5, 'Excellent Place', 'It is an excellent place to gain hands-on knowledge and training about the latest equipment. We came to learn about various smelting processes during our visit.', '13/07/2020', 6);

-- --------------------------------------------------------

--
-- Table structure for table `student_file_upload`
--

CREATE TABLE `student_file_upload` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `uv_id_photo` text NOT NULL,
  `cv_file` text DEFAULT NULL,
  `verify` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_file_upload`
--

INSERT INTO `student_file_upload` (`id`, `student_id`, `uv_id_photo`, `cv_file`, `verify`) VALUES
(2, 61, 'uploads/ID_shuvo.jpg', 'uploads/cv_shuvo.docx', 1),
(3, 64, 'uploads/mahbub.jpg', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_session`
--

CREATE TABLE `student_session` (
  `id` int(11) NOT NULL,
  `session_year` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_session`
--

INSERT INTO `student_session` (`id`, `session_year`) VALUES
(1, '2006-2010'),
(2, '2007-2011'),
(3, '2008-2012'),
(4, '2009-2013'),
(5, '2010-2014'),
(6, '2011-2015'),
(7, '2012-2016'),
(8, '2013-2017'),
(9, '2014-2018'),
(10, '2015-2019'),
(11, '2016-2020'),
(12, '2017-2021'),
(13, '2018-2022'),
(14, '2019-2023'),
(15, '2020-2024');

-- --------------------------------------------------------

--
-- Table structure for table `university_list`
--

CREATE TABLE `university_list` (
  `id` int(11) NOT NULL,
  `university_name` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `university_list`
--

INSERT INTO `university_list` (`id`, `university_name`, `website`) VALUES
(1, 'University of Dhaka', 'www.du.ac.bd'),
(2, 'University of Rajshahi', 'www.ru.ac.bd'),
(3, 'Bangladesh Agricultural University', 'www.bau.edu.bd'),
(4, 'Bangladesh University of Engineering & Technology', 'www.buet.ac.bd'),
(5, 'University of Chittagong', 'www.cu.ac.bd'),
(6, 'Jahangirnagar University', 'www.juniv.edu'),
(7, 'Islamic University', 'www.iu.ac.bd'),
(8, 'Shahjalal University of Science & Technology', 'www.sust.edu'),
(9, 'Khulna University', 'www.ku.ac.bd'),
(10, 'National University', 'www.nu.edu.bd'),
(11, 'Bangladesh Open University', 'www.bou.edu.bd'),
(12, 'Bangabandhu Sheikh Mujib Medical University', 'www.bsmmu.edu.bd'),
(13, 'Bangabandhu Sheikh Mujibur Rahman Agricultural University', 'www.bsmrau.edu.bd'),
(14, 'Hajee Mohammad Danesh Science & Technology University', 'www.hstu.ac.bd'),
(15, 'Mawlana Bhashani Science & Technology University', 'www.mbstu.ac.bd'),
(16, 'Patuakhali Science And Technology University', 'www.pstu.ac.bd'),
(17, 'Sher-e-Bangla Agricultural University', 'www.sau.edu.bd'),
(18, 'Chittagong University of Engineering & Technology', 'www.cuet.ac.bd'),
(19, 'Rajshahi University of Engineering & Technology', 'www.ruet.ac.bd'),
(20, 'Khulna University of Engineering and Technology', 'www.kuet.ac.bd'),
(21, 'Dhaka University of Engineering & Technology', 'www.duet.ac.bd'),
(22, 'Noakhali Science & Technology University', 'www.nstu.edu.bd'),
(23, 'Jagannath University', 'www.jnu.ac.bd'),
(24, 'Comilla University', 'www.cou.ac.bd'),
(25, 'Jatiya Kabi Kazi Nazrul Islam University', 'www.jkkniu.edu.bd'),
(26, 'Chittagong Veterinary and Animal Sciences University', 'www.cvasu.ac.bd'),
(27, 'Sylhet Agricultural University', 'www.sau.ac.bd'),
(28, 'Jessore University of Science & Technology', 'www.just.edu.bd'),
(29, 'Pabna University of Science and Technology', 'www.pust.ac.bd'),
(30, 'Begum Rokeya University', 'www.brur.ac.bd'),
(31, 'Bangladesh University of Professionals', 'www.bup.edu.bd'),
(32, 'Bangabandhu Sheikh Mujibur Rahman Science & Technology University', 'www.bsmrstu.edu.bd'),
(33, 'Bangladesh University of Textiles', 'www.butex.edu.bd'),
(34, 'Barisal University', 'www.barisaluniv.edu.bd'),
(35, 'Rangamati Science and Technology University', 'www.rmstu.edu.bd'),
(36, 'Bangabandhu Sheikh Mujibur Rahman Maritime University', 'www.bsmrmu.edu.bd'),
(37, 'Islamic Arabic University', 'www.iau.edu.bd'),
(38, 'Chittagong Medical University', ''),
(39, 'Rajshahi Medical University', ''),
(40, 'Rabindra University', ' Bangladesh'),
(41, 'Bangabandhu Sheikh Mujibur Rahman Digital University', 'www.bdu.ac.bd'),
(42, 'Sheikh Hasina University', 'https://shubd.net/'),
(43, 'Khulna Agricultural University', ''),
(44, 'Bangamata Sheikh Fojilatunnesa Mujib Science and Technology University', 'https://bsfmstu.ac.bd/'),
(45, 'Sylhet Medical University', ''),
(46, 'Bangabandhu Sheikh Mujibur Rahman Aviation And Aerospace University (BSMRAAU)', 'www.bsmraau.edu.bd'),
(47, 'North South University', 'www.northsouth.edu'),
(48, 'University of Science & Technology Chittagong', 'www.ustc.edu.bd'),
(49, 'Independent University', ' Bangladesh'),
(50, 'Central Women\'s University', 'www.cwu.edu.bd'),
(51, 'International University of Business Agriculture & Technology', 'www.iubat.edu'),
(52, 'International Islamic University Chittagong', 'www.iiuc.ac.bd'),
(53, 'Ahsanullah University of Science and Technology', 'www.aust.edu'),
(54, 'American International University-Bangladesh', 'www.aiub.edu'),
(55, 'East West University', 'www.ewubd.edu'),
(56, 'University of Asia Pacific', 'www.uap-bd.edu'),
(57, 'Gono Bishwabidyalay', 'www.gonouniversity.edu.bd'),
(58, 'The People\'s University of Bangladesh', 'www.pub.ac.bd'),
(59, 'Asian University of Bangladesh', 'www.aub.edu.bd'),
(60, 'Dhaka International University', 'www.diu.ac'),
(61, 'Manarat International University', 'www.manarat.ac.bd'),
(62, 'BRAC University', 'www.bracu.ac.bd'),
(63, 'Bangladesh University', 'www.bu.edu.bd'),
(64, 'Leading University', 'www.lus.ac.bd'),
(65, 'BGC Trust University Bangladesh', 'www.bgctub-edu.net'),
(66, 'Sylhet International University **', 'www.siu.edu.bd'),
(67, 'University of Development Alternative *', 'www.uoda.edu.bd'),
(68, 'Premier University', 'www.puc.ac.bd'),
(69, 'Southeast University *', 'www.seu.ac.bd'),
(70, 'Daffodil International University *', 'www.daffodilvarsity.edu.bd'),
(71, 'Stamford University Bangladesh *', 'www.stamforduniversity.edu.bd'),
(72, 'State University of Bangladesh', 'www.sub.edu.bd'),
(73, 'City University', 'www.cityuniversity.edu.bd'),
(74, 'Prime University', 'www.primeuniversity.edu.bd'),
(75, 'Northern University Bangladesh *', 'www.nub.ac.bd'),
(76, 'Southern University Bangladesh', 'www.southern.edu.bd'),
(77, 'Green University of Bangladesh', 'www.green.edu.bd'),
(78, 'Pundra University of Science & Technology *', 'www.pundrouniversity.edu.bd'),
(79, 'World University of Bangladesh', 'www.wub.edu.bd'),
(80, 'Shanto-Mariam University of Creative Technology *', 'www.smuct.edu.bd'),
(81, 'The Millennium University', 'www.themillenniumuniversity.edu.bd'),
(82, 'United International University', 'www.uiu.ac.bd'),
(83, 'University of South Asia *', 'www.southasia-uni.org'),
(84, 'Eastern University *', 'www.easternuni.edu.bd'),
(85, 'Uttara University *', 'www.uttarauniversity.edu.bd'),
(86, 'Metropolitan University', 'www.metrouni.edu.bd'),
(87, 'Victoria University of Bangladesh *', 'www.vub.edu.bd'),
(88, 'Bangladesh University of Business & Technology', 'www.bubt.ac.bd'),
(89, 'Presidency University', 'www.presidency.edu.bd'),
(90, 'University of Information Technology & Sciences', 'www.uits.edu.bd'),
(91, 'Primeasia University', 'www.primeasia.edu.bd'),
(92, 'Royal University of Dhaka', 'www.royal.edu.bd'),
(93, 'University of Liberal Arts Bangladesh', 'www.ulab.edu.bd'),
(94, 'Atish Dipankar University of Science & Technology', 'www.adust.edu.bd'),
(95, 'Bangladesh Islami University', 'www.biu.ac.bd'),
(96, 'ASA University Bangladesh', 'www.asaub.edu.bd'),
(97, 'East Delta University', 'www.eastdelta.edu.bd'),
(98, 'European University of Bangladesh', 'www.eub.edu.bd'),
(99, 'Varendra University', 'www.vu.edu.bd'),
(100, 'Hamdard University Bangladesh', 'www.hamdarduniversity.edu.bd'),
(101, 'BGMEA University of Fashion & Technology(BUFT) *', 'www.buft.edu.bd'),
(102, 'North East University Bangladesh', 'www.neub.edu.bd'),
(103, 'First Capital University of Bangladesh', 'www.fcub.edu.bd'),
(104, 'Ishakha International University', ' Bangladesh'),
(105, 'Z.H Sikder University of Science & Technology', 'www. zhsust.edu.bd'),
(106, 'Exim Bank Agricultural University', ' Bangladesh'),
(107, 'North Western University', 'www.nwu.edu.bd'),
(108, 'Khwaja Yunus Ali University', 'www.kyau.edu.bd'),
(109, 'Sonargaon University', 'www.su.edu.bd'),
(110, 'Feni University', 'www.feniuniversity.edu.bd'),
(111, 'Britannia University **', 'www.britannia.ac'),
(112, 'Port City International University', 'www.portcity.edu.bd'),
(113, 'Bangladesh University of Health Sciences', 'www.buhs.ac.bd'),
(114, 'Chittagong Independent University', 'www.ciu.edu.bd'),
(115, 'Notre Dame University Bangladesh', 'www.ndub.edu.bd'),
(116, 'Times University', ' Bangladesh'),
(117, 'North Bengal International University', 'www.nbiu.edu.bd'),
(118, 'Fareast International University', 'www.fiu.edu.bd'),
(119, 'Rajshahi Science & Technology University (RSTU)', ' Natore'),
(120, 'Sheikh Fazilatunnesa Mujib University', 'www.sfmuniversity.org'),
(121, 'Cox\'s Bazar International University', 'www.cbiu.ac.bd'),
(122, 'Ranada Prasad Shaha University', 'www.rpsu.edu.bd'),
(123, 'German University Bangladesh', 'www.gub.edu.bd'),
(124, 'Global University Bangladesh', 'www.globaluniversity.edu.bd'),
(125, 'CCN University of Science & Technology', 'www.ccnust.edu.bd'),
(126, 'Bangladesh Army University of Science and Technology(BAUST)', ' Saidpur'),
(127, 'Bangladesh Army University of Engineering and Technology (BAUET)', ' Qadirabad'),
(128, 'Bangladesh Army International University of Science & Technology(BAIUST) ', 'Comilla'),
(129, 'The International University of Scholars', 'www.ius.edu.bd'),
(130, 'Canadian University of Bangladesh', 'www.cub.edu.bd'),
(131, 'N.P.I University of Bangladesh', 'www.npiub.edu.bd'),
(132, 'Northern University of Business & Technology', ' Khulna'),
(133, 'Rabindra Maitree University', ' Kushtia'),
(134, 'University of Creative Technology', ' Chittagong'),
(135, 'Central University of Science and Technology', ''),
(136, 'Tagore University of Creative Arts', ' Keranigonj'),
(137, 'University of Global Village', 'www.ugv.edu.bd'),
(138, 'Anwer Khan Modern University', 'www.akmu.edu.bd'),
(139, 'Rupayan A.K.M Shamsuzzoha University (Academic programs have not yet started)', ''),
(140, 'Z.N.R.F. University of Management Sciences', 'www.zums.edu.bd'),
(141, 'Ahsania Mission University of Science and Technology (Academic programs have not yet started)', ''),
(142, 'Khulna Khan Bahadur Ahsanullah University (Academic programs have not yet started)', ''),
(143, 'Bandarban University', 'www.bubban.edu.bd'),
(144, 'Shah Makhdum Management University', ' Rajshahi '),
(145, 'Trust University', ' Barishal (Academic programs have not yet started)'),
(146, 'International Standard University', 'www.isu.ac.bd'),
(147, 'University of Brahmanbaria', ''),
(148, 'University of Skill Enrichment and Technology', ''),
(149, 'IBAIS University', ''),
(150, 'Queens University', ''),
(151, 'Test Sample University', 'test.uv.com');

-- --------------------------------------------------------

--
-- Table structure for table `users_academy`
--

CREATE TABLE `users_academy` (
  `id` int(11) NOT NULL,
  `university_name` int(11) NOT NULL,
  `university_address` text NOT NULL,
  `faculty_category` int(11) NOT NULL,
  `department_category` int(11) NOT NULL,
  `university_department_chairman` varchar(50) NOT NULL,
  `university_department_chairman_email` varchar(255) NOT NULL,
  `university_department_chairman_number` varchar(50) NOT NULL,
  `university_office_phone` varchar(50) NOT NULL,
  `university_email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `validation_code` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `user_type` int(11) NOT NULL,
  `image_name` text NOT NULL,
  `image` text NOT NULL,
  `verify` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_academy`
--

INSERT INTO `users_academy` (`id`, `university_name`, `university_address`, `faculty_category`, `department_category`, `university_department_chairman`, `university_department_chairman_email`, `university_department_chairman_number`, `university_office_phone`, `university_email`, `password`, `validation_code`, `active`, `user_type`, `image_name`, `image`, `verify`) VALUES
(2, 112, '7-14, Nikunja Housing Society             South Khulshi, Chittagong', 7, 57, 'Sowmitra Das', 'sowmitracsecu@gmail.com', '01620325472', '01851120791', 'admission@portcity.edu.bd', 'e10adc3949ba59abbe56e057f20f883e', '0', 1, 2, 'uv-logo.jpg', 'uploads/uv-logo.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_admin`
--

CREATE TABLE `users_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(2) NOT NULL DEFAULT 0,
  `user_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_admin`
--

INSERT INTO `users_admin` (`id`, `name`, `email`, `password`, `active`, `user_type`) VALUES
(1, 'Shuvo', 'shuvokumarmajumder@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users_industry`
--

CREATE TABLE `users_industry` (
  `id` int(11) NOT NULL,
  `industry_name` text NOT NULL,
  `industry_city` varchar(255) NOT NULL,
  `industry_category` int(11) NOT NULL,
  `industry_address` text NOT NULL,
  `industry_contact_number` varchar(20) NOT NULL,
  `industry_office_phone` varchar(20) NOT NULL,
  `industry_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image` longtext NOT NULL,
  `validation_code` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `user_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_industry`
--

INSERT INTO `users_industry` (`id`, `industry_name`, `industry_city`, `industry_category`, `industry_address`, `industry_contact_number`, `industry_office_phone`, `industry_email`, `password`, `image_name`, `image`, `validation_code`, `active`, `user_type`) VALUES
(20, 'Bangladesh Export Import Company Limited', 'Dhaka', 13, '17, Dhanmondi R/A, Road No. 2 Dhaka 1205, Bangladesh', '+880-2-8611891', '+880-2-8618220', 'info@beximco.net', 'e10adc3949ba59abbe56e057f20f883e', 'Beximco-logo.jpg', 'uploads/Beximco-logo.jpg', '0', 1, 1),
(27, 'PRAN-RFL GROUP', 'Dhaka', 6, 'PRAN-RFL Center 105 Middle Badda, Dhaka – 1212, Bangladesh', '09613-737777', '09613-737776', 'crd@prangroup.com', 'e10adc3949ba59abbe56e057f20f883e', 'pran-rfl.jpg', 'uploads/pran-rfl.jpg', '0', 1, 1),
(28, 'DataSoft Systems Bangladesh Limited', 'Dhaka', 1, 'Rupayan Shelford (20th Floor), 23/6, Mirpur Road, Shyamoli, Dhaka-1207, Bangladesh.', '880-2-9110136', '880-2-9110169', 'info@datasoft-bd.com', 'e10adc3949ba59abbe56e057f20f883e', 'data_soft_logo.jpg', 'uploads/data_soft_logo.jpg', '0', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_student`
--

CREATE TABLE `users_student` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `university_name` int(11) NOT NULL,
  `student_session` int(11) NOT NULL,
  `university_id` varchar(255) NOT NULL,
  `program` int(11) NOT NULL,
  `batch` varchar(255) NOT NULL,
  `image_name` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `validation_code` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `user_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_student`
--

INSERT INTO `users_student` (`id`, `first_name`, `last_name`, `email`, `university_name`, `student_session`, `university_id`, `program`, `batch`, `image_name`, `image`, `password`, `validation_code`, `active`, `user_type`) VALUES
(61, 'Shuvo', 'Kumar Majumder', 'skmajumder.cse@gmail.com', 112, 11, 'CSE00905616', 1, 'CSE009', 'MyPic.jpg', 'uploads/MyPic.jpg', 'e10adc3949ba59abbe56e057f20f883e', '0', 1, 3),
(64, 'Mahbub-e-jalil', 'Tasin', 'tasinmahbub79@gmail.com', 112, 11, 'CSE00905623', 1, 'CSE009', 'mahbub_profile.jpg', 'uploads/mahbub_profile.jpg', 'e10adc3949ba59abbe56e057f20f883e', '0', 1, 3),
(65, 'Md. Shamsul', 'Raihan', 'raihanremon534@gmail.com', 112, 11, 'CSE01005675', 1, 'CSE010', 'rimon.jpg', 'uploads/rimon.jpg', 'e10adc3949ba59abbe56e057f20f883e', '0', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_category`
--

CREATE TABLE `user_category` (
  `user_id` int(11) NOT NULL,
  `user_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_category`
--

INSERT INTO `user_category` (`user_id`, `user_type`) VALUES
(1, 'user_industry'),
(2, 'user_academy'),
(3, 'user_student'),
(4, 'user_admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_status`
--
ALTER TABLE `active_status`
  ADD PRIMARY KEY (`active_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `industry_id` (`industry_id`),
  ADD KEY `academy_id` (`academy_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `industry_information`
--
ALTER TABLE `industry_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `industry_id` (`industry_id`);

--
-- Indexes for table `industry_type`
--
ALTER TABLE `industry_type`
  ADD PRIMARY KEY (`industry_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`program_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `industry_id` (`industry_id`),
  ADD KEY `academy_id` (`academy_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `student_file_upload`
--
ALTER TABLE `student_file_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_session`
--
ALTER TABLE `student_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `university_list`
--
ALTER TABLE `university_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_academy`
--
ALTER TABLE `users_academy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `university_email` (`university_email`),
  ADD KEY `university_name` (`university_name`),
  ADD KEY `faculty_category` (`faculty_category`),
  ADD KEY `department_category` (`department_category`),
  ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `users_admin`
--
ALTER TABLE `users_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `users_industry`
--
ALTER TABLE `users_industry`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `industry_email` (`industry_email`),
  ADD KEY `users_industry_ibfk_1` (`user_type`),
  ADD KEY `industry_category` (`industry_category`);

--
-- Indexes for table `users_student`
--
ALTER TABLE `users_student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `university_id` (`university_id`),
  ADD KEY `university_name` (`university_name`),
  ADD KEY `student_session` (`student_session`),
  ADD KEY `user_type` (`user_type`),
  ADD KEY `program` (`program`);

--
-- Indexes for table `user_category`
--
ALTER TABLE `user_category`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `industry_information`
--
ALTER TABLE `industry_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `industry_type`
--
ALTER TABLE `industry_type`
  MODIFY `industry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_file_upload`
--
ALTER TABLE `student_file_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_session`
--
ALTER TABLE `student_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `university_list`
--
ALTER TABLE `university_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `users_academy`
--
ALTER TABLE `users_academy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_admin`
--
ALTER TABLE `users_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_industry`
--
ALTER TABLE `users_industry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users_student`
--
ALTER TABLE `users_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `user_category`
--
ALTER TABLE `user_category`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`industry_id`) REFERENCES `users_industry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`academy_id`) REFERENCES `users_academy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `industry_information`
--
ALTER TABLE `industry_information`
  ADD CONSTRAINT `industry_information_ibfk_1` FOREIGN KEY (`industry_id`) REFERENCES `users_industry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_category` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `notice_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notice_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`industry_id`) REFERENCES `users_industry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`academy_id`) REFERENCES `users_academy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_3` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_file_upload`
--
ALTER TABLE `student_file_upload`
  ADD CONSTRAINT `student_file_upload_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users_student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_academy`
--
ALTER TABLE `users_academy`
  ADD CONSTRAINT `users_academy_ibfk_1` FOREIGN KEY (`university_name`) REFERENCES `university_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_academy_ibfk_2` FOREIGN KEY (`faculty_category`) REFERENCES `faculty` (`faculty_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_academy_ibfk_3` FOREIGN KEY (`department_category`) REFERENCES `department` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_academy_ibfk_4` FOREIGN KEY (`user_type`) REFERENCES `user_category` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_admin`
--
ALTER TABLE `users_admin`
  ADD CONSTRAINT `users_admin_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_category` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_industry`
--
ALTER TABLE `users_industry`
  ADD CONSTRAINT `users_industry_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_category` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_industry_ibfk_2` FOREIGN KEY (`industry_category`) REFERENCES `industry_type` (`industry_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_student`
--
ALTER TABLE `users_student`
  ADD CONSTRAINT `users_student_ibfk_1` FOREIGN KEY (`university_name`) REFERENCES `university_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_student_ibfk_2` FOREIGN KEY (`student_session`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_student_ibfk_3` FOREIGN KEY (`user_type`) REFERENCES `user_category` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_student_ibfk_4` FOREIGN KEY (`program`) REFERENCES `programs` (`program_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
