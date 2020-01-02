-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2019 at 12:42 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eexamportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_email` varchar(40) NOT NULL,
  `admin_pwd` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_email`, `admin_pwd`) VALUES
(1, 'admin@nomail.com', 'Admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `administration`
--

CREATE TABLE `administration` (
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(80) NOT NULL,
  `admin_type` varchar(40) NOT NULL,
  `sub_id` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administration`
--

INSERT INTO `administration` (`admin_name`, `admin_email`, `admin_password`, `admin_type`, `sub_id`) VALUES
('Raj Shekhar', 'raj@nomail.com', '12345678', 'infosec', '2018001'),
('Rahul', 'rahul@nomail.com', '12345678', 'history', '2018002'),
('Arnab Karan', 'arnab@gmail.com', '12345678', 'DBMS', '2018004');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `can_id` varchar(80) NOT NULL,
  `subject` varchar(80) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `qno` int(11) NOT NULL,
  `answers_given` varchar(10) DEFAULT NULL,
  `correct_ans` varchar(10) NOT NULL,
  `markgot` decimal(8,2) NOT NULL,
  `dates` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `can_id`, `subject`, `user_name`, `user_email`, `qno`, `answers_given`, `correct_ans`, `markgot`, `dates`) VALUES
(1, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 1, 'A', 'A', '2.00', '2018-10-13 06:15:02'),
(2, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 2, 'A', 'A', '2.00', '2018-10-13 06:15:13'),
(3, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 3, 'D', 'D', '2.00', '2018-10-13 06:15:17'),
(4, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 4, 'A', 'A', '2.00', '2018-10-13 09:19:15'),
(5, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 5, 'C', 'C', '2.00', '2018-10-13 06:15:29'),
(6, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 6, 'D', 'D', '2.00', '2018-10-13 06:15:34'),
(7, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 7, 'D', 'D', '2.00', '2018-10-13 06:18:23'),
(8, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 8, 'A', 'A', '2.00', '2018-10-13 06:18:53'),
(9, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 9, 'D', 'D', '2.00', '2018-10-13 09:20:32'),
(10, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 10, 'A', 'A', '2.00', '2018-10-13 06:19:02'),
(11, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 11, 'C', 'C', '2.00', '2018-10-13 06:19:05'),
(12, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 12, 'A', 'A', '2.00', '2018-10-13 06:19:09'),
(13, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 13, 'B', 'B', '2.00', '2018-10-13 06:19:12'),
(14, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 14, 'C', 'B', '0.00', '2018-10-13 06:20:12'),
(15, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 15, 'C', 'C', '2.00', '2018-10-13 06:20:27'),
(16, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 16, 'B', 'B', '2.00', '2018-10-13 06:21:18'),
(17, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 17, 'A', 'A', '2.00', '2018-10-13 06:21:30'),
(18, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 18, 'A', 'A', '2.00', '2018-10-13 06:22:02'),
(19, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 19, 'D', 'D', '2.00', '2018-10-13 06:22:29'),
(20, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 20, 'A', 'A', '2.00', '2018-10-13 06:22:44'),
(21, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 20, 'D', 'B', '0.00', '2018-10-13 06:25:31'),
(22, 'Arnab001', 'DBMS', 'Arnab Karan', 'arnab@gmail.com', 1, 'A', 'A', '2.00', '2018-10-13 07:02:00'),
(23, 'Arnab001', 'DBMS', 'Arnab Karan', 'arnab@gmail.com', 2, 'B', 'B', '6.00', '2018-10-13 07:02:12'),
(24, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 1, 'D', 'D', '2.00', '2018-10-13 09:18:44'),
(25, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 2, 'C', 'C', '2.00', '2018-10-13 09:18:55'),
(26, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 3, 'D', 'D', '2.00', '2018-10-13 09:19:00'),
(27, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 4, 'A', 'A', '2.00', '2018-10-13 09:19:15'),
(28, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 5, 'D', 'D', '2.00', '2018-10-13 09:19:45'),
(29, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 6, 'A', 'A', '2.00', '2018-10-13 09:19:53'),
(30, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 7, 'C', 'C', '2.00', '2018-10-13 09:19:59'),
(31, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 8, 'B', 'B', '2.00', '2018-10-13 09:20:03'),
(32, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 9, 'D', 'D', '2.00', '2018-10-13 09:20:32'),
(33, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 10, 'B', 'B', '2.00', '2018-10-13 09:20:38'),
(34, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 11, 'C', 'C', '2.00', '2018-10-13 09:20:43'),
(35, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 12, 'B', 'B', '2.00', '2018-10-13 09:20:50'),
(36, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 13, 'B', 'B', '2.00', '2018-10-13 09:20:53'),
(37, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 14, 'B', 'B', '2.00', '2018-10-13 09:20:59'),
(38, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 15, 'A', 'A', '2.00', '2018-10-13 09:21:03'),
(39, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 16, 'C', 'A', '0.00', '2018-10-13 09:21:14'),
(40, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 17, 'C', 'C', '2.00', '2018-10-13 09:21:18'),
(41, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 18, 'D', 'D', '2.00', '2018-10-13 09:21:36'),
(42, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 19, 'B', 'B', '2.00', '2018-10-13 09:21:40'),
(43, 'GodsonInfoSec2018001', 'infosec', 'Godson Emmanuel', 'godson@nomail.com', 20, 'C', 'C', '2.00', '2018-10-13 09:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_details`
--

CREATE TABLE `candidate_details` (
  `id` int(11) NOT NULL,
  `can_id` varchar(40) NOT NULL,
  `subject` varchar(80) NOT NULL,
  `status` varchar(80) NOT NULL DEFAULT 'Not Appeared',
  `can_name` varchar(40) NOT NULL,
  `can_email` varchar(150) NOT NULL,
  `can_password` varchar(80) NOT NULL,
  `can_contact` varchar(10) DEFAULT NULL,
  `can_gender` varchar(10) NOT NULL,
  `can_blood_group` varchar(10) NOT NULL,
  `can_DOB` date NOT NULL,
  `can_address` varchar(100) NOT NULL,
  `dates` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate_details`
--

INSERT INTO `candidate_details` (`id`, `can_id`, `subject`, `status`, `can_name`, `can_email`, `can_password`, `can_contact`, `can_gender`, `can_blood_group`, `can_DOB`, `can_address`, `dates`) VALUES
(1, 'GodsonInfoSec2018001', 'infosec', 'appeared', 'Godson Emmanuel', 'godson@nomail.com', '12345678', '1234567890', 'Male', 'B-', '2018-10-05', 'bbsr', '2019-06-17 10:11:17'),
(2, 'Arnab001', 'DBMS', 'appeared', 'Arnab Karan', 'arnab@gmail.com', '12345678', '1234567890', 'Male', 'B+', '2018-10-02', 'bbsr', '2018-10-13 07:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `sub_id` varchar(40) NOT NULL,
  `subject` varchar(40) NOT NULL,
  `question` text NOT NULL,
  `optionA` varchar(200) NOT NULL,
  `optionB` varchar(200) NOT NULL,
  `optionC` varchar(200) NOT NULL,
  `optionD` varchar(200) NOT NULL,
  `answer` varchar(200) NOT NULL,
  `marks` decimal(8,2) NOT NULL DEFAULT '2.00',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `sub_id`, `subject`, `question`, `optionA`, `optionB`, `optionC`, `optionD`, `answer`, `marks`, `date_added`) VALUES
(1, '2018001', 'infosec', 'What is VAPT?', 'Vulnerability assigning and penetration tool', 'Vulnerability assessment and penetration tool', 'Vulnerability assessment and penetration testing', 'Vulnerability assessment and penetration test', 'C', '2.00', '2018-10-13 06:42:11'),
(2, '2018001', 'infosec', 'In this topology there is a central controller or hub?', 'Star', ' Mesh', 'Ring', 'Bus', 'A', '2.00', '2018-09-17 11:35:06'),
(3, '2018001', 'infosec', 'Data communication system spanning states, countries, or the whole world is ______.', 'LAN', 'WAN', 'MAN', 'None', 'B', '2.00', '2018-09-17 11:35:06'),
(4, '2018001', 'infosec', 'Data communication system within a building or campus is _____?', 'LAN', 'WAN', 'MAN', 'None', 'A', '2.00', '2018-09-17 11:35:06'),
(5, '2018001', 'infosec', 'Expand OSI', 'Opening system interconnection', 'Open System Interconnecting', 'Open System Interconnection', 'All of the above', 'C', '2.00', '2018-09-17 11:35:06'),
(6, '2018001', 'infosec', 'Which layer links the network support layers and user support layers ?', 'Session layer', 'Data link layer', 'Transport layer', 'Network layer', 'C', '2.00', '2018-09-17 11:35:06'),
(7, '2018001', 'infosec', 'TCP/IP model does not have ______ layer but OSI model have this layer.', 'Session layer', 'Presentation layer', 'Application layer', 'both (a) and (b)', 'D', '2.00', '2018-09-17 11:35:06'),
(8, '2018001', 'infosec', 'Segmentation of a data stream happens at which layer of the osi model ?', 'Physical', 'Data link', 'Network', 'transport', 'D', '2.00', '2018-09-17 11:35:06'),
(9, '2018001', 'infosec', 'You are the network administrator for your company. you are preparing to implement a new network for a building your company is currently having constructed. Which network device will you use to control what packets are allowed to enter or leave your new network and the internet ?', 'Firewall', 'Hub', 'Switch', 'Router', 'A', '2.00', '2018-09-17 11:35:06'),
(10, '2018001', 'infosec', 'What is subnet mask of the IP address 220.0.224.0', '255.0.0.0', '255.255.0.0', '255.255.255.0', '255.255.245.0', 'C', '2.00', '2018-09-17 11:35:06'),
(11, '2018001', 'infosec', 'Terminators are used in ______ topology.', 'Bus', 'Star', 'Ring', 'Token ring', 'A', '2.00', '2018-09-17 11:35:06'),
(12, '2018001', 'infosec', 'Which layer is responsible for process to process delivery ?', 'Network layer', 'Transport layer', 'Session layer', 'Data link layer', 'B', '2.00', '2018-09-17 11:35:06'),
(13, '2018001', 'infosec', 'Transmission data rate is decided by ____ ?', 'Network layer', 'Physical layer', 'Data link layer', 'Transport layer', 'B', '2.00', '2018-09-17 11:35:06'),
(14, '2018001', 'infosec', 'Which layer provides the services to user ?', 'Application layer', 'Session layer', 'Presentation layer', 'none of the mentioned', 'A', '2.00', '2018-09-17 11:35:06'),
(15, '2018001', 'infosec', 'Which address identifies a process on a host ?', 'Physical address', 'Logical address', 'Port address', 'Specific address', 'C', '2.00', '2018-09-17 11:35:06'),
(16, '2018001', 'infosec', 'The ____ translates internet domain and host names to IP address.', 'Domain name system', 'Routing information protocol', 'Network time protocol', 'Internet Relay Chat', 'A', '2.00', '2018-09-17 11:35:06'),
(17, '2018001', 'infosec', 'Transmission control protocol is ____ ?', 'Connection Oriented Protocol', 'uses a three way handshake to establish a connection', 'receives data from application as a single stream', 'all of the mentioned', 'D', '2.00', '2018-09-17 11:35:06'),
(18, '2018001', 'infosec', 'SSH uses which port ?', '21', '22', '80', '25', 'B', '2.00', '2018-09-17 11:35:06'),
(19, '2018001', 'infosec', 'Physical or logical arrangement of network is ___ ?', 'Topology', 'Routing', 'Networking', 'None of the mentioned', 'A', '2.00', '2018-09-17 11:35:06'),
(20, '2018001', 'infosec', 'This topology requires multipoint connection ___ ?', 'Star', 'Mesh', 'Ring', 'Bus', 'D', '2.00', '2018-09-17 11:35:06'),
(21, '2018001', 'infosec', 'Data communication system within a building or campus is ___?', 'LAN', 'WAN', 'MAN', 'None of the mentioned', 'A', '2.00', '2018-09-17 11:35:06'),
(22, '2018001', 'infosec', 'Expand WAN', 'World area network', 'Wide area network', 'Web area network', 'None of the mentioned', 'B', '2.00', '2018-09-17 11:35:06'),
(23, '2018001', 'infosec', 'HTTP is ________ protocol.', 'Application layer', 'Transport layer', 'Network layer', 'None of the mentioned', 'A', '2.00', '2018-09-17 11:35:06'),
(24, '2018001', 'infosec', 'Communication between a computer and a keyboard involves ______________ transmission', 'Automatic', 'Half-duplex', 'Full-duplex', 'Simplex', 'D', '2.00', '2018-09-17 11:35:06'),
(25, '2018001', 'infosec', 'Which one is not a application layer protocol ?', 'HTTP', 'SMTP', 'FTP', 'TCP', 'D', '2.00', '2018-09-17 11:35:06'),
(26, '2018001', 'infosec', 'The packet of information at the application layer is called ____ ?', 'Packet', 'Message', 'Segment', 'Frame', 'B', '2.00', '2018-09-17 11:35:06'),
(27, '2018001', 'infosec', 'This is one of the architecture paradigm', 'Peer to peer', 'Client-server', 'HTTP', 'Both a and b', 'D', '2.00', '2018-09-17 11:35:06'),
(28, '2018001', 'infosec', 'Application developer has permission to decide the following on transport layer side', 'Transport layer protocol', 'Maximum buffer size', 'Both of the mentioned', 'None of the mentioned', 'C', '2.00', '2018-09-17 11:35:06'),
(29, '2018001', 'infosec', 'Application layer offers _______ service', 'End to end', 'Process to process', 'Both of the mentioned', 'None of the mentioned', 'A', '2.00', '2018-09-17 11:35:06'),
(30, '2018001', 'infosec', 'E-mail is', 'Loss-tolerant application', 'Bandwidth-sensitive application', 'Elastic application', 'None of the mentioned', 'C', '2.00', '2018-09-17 11:35:06'),
(31, '2018001', 'infosec', 'Pick the odd one out', 'File transfer', 'File download', 'E-mail', 'Interactive games', 'D', '2.00', '2018-09-17 11:35:06'),
(32, '2018001', 'infosec', 'Which of the following is an application layer service ?', 'Network virtual terminal', 'File transfer, access, and management', 'Mail service', 'All of the mentioned', 'D', '2.00', '2018-09-17 11:35:06'),
(33, '2018001', 'infosec', 'To deliver a message to the correct application program running on a host, the _______ address must be consulted', 'IP', 'MAC', 'Port', 'None of the mentioned', 'C', '2.00', '2018-09-17 11:35:06'),
(34, '2018001', 'infosec', 'This is a time-sensitive service', 'File transfer', 'File download', 'E-mail', 'Internet telephony', 'D', '2.00', '2018-09-17 11:35:06'),
(35, '2018001', 'infosec', 'Transport services available to applications in one or another form', 'Reliable data transfer', 'Timing', 'Security', 'All of the mentioned', 'D', '2.00', '2018-09-17 11:35:06'),
(36, '2018001', 'infosec', 'Electronic mail uses this Application layer protocol', 'SMTP', 'HTTP', 'FTP', 'SIP', 'A', '2.00', '2018-09-17 11:35:06'),
(37, '2018001', 'infosec', 'What have caused the rise in computer crimes and new methods of committing old computer crimes?', 'Increased use of computer and expansion of the internet and its services', 'New security methods of detecting computer crimes', 'Creation of new software', 'World Wide Web', 'A', '2.00', '2018-09-17 11:35:06'),
(38, '2018001', 'infosec', 'What has become more important because of the increased use of computers, the internet and WWW ?', 'Natural Disasters', 'Hardware Malfunctions', 'Data integrity and data security', 'Malicious deletions', 'C', '2.00', '2018-09-17 11:35:06'),
(39, '2018001', 'infosec', 'What characteristic makes the internet so attractive ? ', 'the \'secure\' surroundings within which it is implemented', 'the ability to provide an open, easy-to-use network', 'it eliminates the need for firewalls', 'you don\'t require a fast computer to use the internet', 'B', '2.00', '2018-09-17 11:35:06'),
(40, '2018001', 'infosec', 'Why is it important for the internet to implement protocols ?', 'to provide a universal data \'platform\' for all connections to use', 'so that nobody gets confused', 'to enable the use of cryptographical techniques', 'to prevent the use of viruses', 'A', '2.00', '2018-09-17 11:35:06'),
(41, '2018001', 'infosec', 'What is the main purpose of access control ?', 'to authorize full access to authorized users', 'to limit the actions or operations that a legitimate user can perform', 'to stop unauthorized users accessing resources', 'to protect computers from viral infections', 'C', '2.00', '2018-09-17 11:35:06'),
(42, '2018001', 'infosec', 'This is used to search for a particular file type', 'File:', 'Filetype:', 'Filetyping:', 'All of the above', 'B', '2.00', '2018-09-17 11:35:06'),
(43, '2018001', 'infosec', 'The device is used to amplify or regenerate the digital signal received while setting them from one part of a network to another network is called as ____?', 'Switch', 'Hub', 'Repeater', 'None of these', 'C', '2.00', '2018-09-17 11:35:06'),
(44, '2018001', 'infosec', 'Modem is used for', 'Encryption and Decryption', 'Modulation and Demodulation', 'Both A and B', 'None', 'B', '2.00', '2018-09-17 11:35:06'),
(45, '2018001', 'infosec', 'Firewall is a ', 'Hardware', 'Software', 'always both hardware and software', 'can be hardware or software', 'D', '2.00', '2018-09-17 11:35:06'),
(46, '2018001', 'infosec', 'Default gateway is', 'Router Address', 'System Address', 'Broadcasting Address', 'Loopback Address', 'A', '2.00', '2018-10-03 11:52:59'),
(51, '2018002', 'history', 'What is ancient name of Odisha?', 'Awadh', 'Burma', 'Kalinga', 'Magadh', 'C', '2.00', '2018-10-13 05:53:44'),
(52, 'DBMS100', 'DBMS', 'Insertion in dbms is a ______ functionality?', 'DDL', 'DML', 'VIEW', 'Integrity constraint', 'B', '2.00', '2018-10-13 07:49:45'),
(53, 'DBMS100', 'DBMS', 'Which key is unique in nature?', 'primary key', 'Super key', 'Forgein key', 'No key', 'A', '2.00', '2018-10-13 06:34:52');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `can_id` varchar(150) NOT NULL,
  `subject` varchar(40) NOT NULL,
  `result` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `dates` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `can_id`, `subject`, `result`, `total`, `dates`) VALUES
(1, 'Arnab001', 'DBMS', '8.00', '8.00', '2018-10-13 07:02:12'),
(2, 'GodsonInfoSec2018001', 'infosec', '0.00', '40.00', '2019-06-17 10:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subjects` varchar(40) NOT NULL,
  `subjects_name` varchar(100) NOT NULL,
  `time_limit` int(10) UNSIGNED NOT NULL DEFAULT '3600',
  `no_of_questions` int(10) UNSIGNED NOT NULL DEFAULT '20'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subjects`, `subjects_name`, `time_limit`, `no_of_questions`) VALUES
(1, 'infosec', 'IT Security and Ethical Hacking', 900, 20),
(2, 'history', 'History', 3600, 20),
(3, 'DBMS', 'Data base management system', 120, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `administration`
--
ALTER TABLE `administration`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_details`
--
ALTER TABLE `candidate_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `candidate_details`
--
ALTER TABLE `candidate_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
