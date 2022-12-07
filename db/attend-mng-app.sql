-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2022 at 09:12 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attend-mng-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE `division` (
  `div_id` varchar(128) NOT NULL,
  `div_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`div_id`, `div_name`) VALUES
('D01', 'IT Officer Manager'),
('D02', 'IT Support Engineer'),
('D03', 'Software Developer');

-- --------------------------------------------------------

--
-- Table structure for table `presence`
--

CREATE TABLE `presence` (
  `present_id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `hour_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `presence`
--

INSERT INTO `presence` (`present_id`, `username`, `hour_id`, `date`, `time`) VALUES
(8, 'hengki.chen', 1, '2022-09-26', '08:13:00'),
(9, 'cytra.sari', 1, '2022-09-26', '08:13:13'),
(10, 'nindy.khintami', 1, '2022-09-26', '08:13:28'),
(11, 'yudhi.tan', 1, '2022-09-26', '08:13:46'),
(12, 'nadia.septa', 1, '2022-09-26', '08:14:01'),
(14, 'nindy.khintami', 2, '2022-09-26', '17:01:42'),
(15, 'nadia.septa', 2, '2022-09-26', '17:02:03'),
(16, 'cytra.sari', 2, '2022-09-26', '17:02:18'),
(17, 'yudhi.tan', 2, '2022-09-26', '17:02:32'),
(18, 'hengki.chen', 2, '2022-09-26', '17:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `presence_hour`
--

CREATE TABLE `presence_hour` (
  `hour_id` int(11) NOT NULL,
  `description` enum('Get In','Get Out') NOT NULL,
  `start` time NOT NULL,
  `finished` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `presence_hour`
--

INSERT INTO `presence_hour` (`hour_id`, `description`, `start`, `finished`) VALUES
(1, 'Get In', '08:00:00', '08:30:00'),
(2, 'Get Out', '17:00:00', '17:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(128) NOT NULL,
  `firstName` varchar(128) NOT NULL,
  `lastName` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `div_id` varchar(128) NOT NULL,
  `img` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `firstName`, `lastName`, `email`, `role_id`, `div_id`, `img`, `password`, `is_active`, `date_created`) VALUES
('cytra.sari', 'Cytra', 'Sari', 'cytra_sari@gmail.com', 2, 'D03', 'default.jpg', '$2y$10$jBgmku0H.z7pXYu8syti.uzWsS9zFPVM/93iRwtP69IyMkSbjtHPy', 1, 1663988184),
('florensa.evelina', 'Florensa', 'Evelina', 'florensa_evelina@gmail.com', 2, 'D03', 'default.jpg', '$2y$10$7g409d1AY6kaMfkgDFtRB.CzlrKLsJ7FRog1pa6ndONn4kB.mDjSK', 1, 1665631229),
('hengki.chen', 'Hengki', 'Chen', 'hengki_chen@gmail.com', 1, 'D01', 'default.jpg', '$2y$10$hIcV0RA2TYMzEbMiKP5Ua.fCNbymJCag8ePqHJz5j5SW7zArQr4FO', 1, 1663987917),
('nadia.septa', 'Nadia', 'Septa', 'nadia_septa@gmail.com', 2, 'D03', 'default.jpg', '$2y$10$NuHk8ZiVFzac035IV3xQfu14p5O3LZ5HPGbv2iEmfMASkVqb4iBiy', 1, 1663988114),
('nindy.khintami', 'Nindy', 'Khintami', 'nindy_khintami@gmail.com', 2, 'D03', 'default.jpg', '$2y$10$cfMWjznwitZ5DQ61Z5eQEe4LdNLaW78KlAk1gYrFAZk3ndDh.z3my', 1, 1663988047),
('yudhi.tan', 'Yudhi', 'Tan', 'yudhi_tan@gmail.com', 2, 'D02', 'default.jpg', '$2y$10$vEoRZYZYzRI3KUDq4dVeOew.xyFnlnz6a9O92ls6FnIai5/iYKF/G', 1, 1663988216);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `amenu_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`amenu_id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`menu_id`, `menu_name`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `smenu_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`smenu_id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'administrator', 'fas fa-fw fa-tachometer-alt', 1),
(2, 1, 'Employee Data', 'administrator/employee_data', 'fas fa-fw fa-users', 1),
(3, 1, 'Division Data', 'administrator/division_data', 'fas fa-fw fa-list', 1),
(4, 1, 'Presence Settings', 'administrator/presence_settings', 'fas fa-fw fa-wrench', 1),
(5, 1, 'Presence History', 'administrator/presence_history', 'fas fa-fw fa-timeline', 1),
(6, 1, 'Presence Report', 'administrator/presence_report', 'fas fa-fw fa-swatchbook', 1),
(7, 2, 'Attendance', 'user/attendance', 'fas fa-fw fa-id-card-clip', 1),
(8, 2, 'My Presence History', 'user/my_presence_history', 'fas fa-fw fa-clock-rotate-left', 1),
(9, 2, 'My Profile', 'user/my_profile', 'fas fa-fw fa-user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`div_id`);

--
-- Indexes for table `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`present_id`),
  ADD KEY `username` (`username`),
  ADD KEY `hour_id` (`hour_id`);

--
-- Indexes for table `presence_hour`
--
ALTER TABLE `presence_hour`
  ADD PRIMARY KEY (`hour_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `div_id` (`div_id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`amenu_id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`smenu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `presence`
--
ALTER TABLE `presence`
  MODIFY `present_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `presence_hour`
--
ALTER TABLE `presence_hour`
  MODIFY `hour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `amenu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `smenu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `presence`
--
ALTER TABLE `presence`
  ADD CONSTRAINT `presence_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presence_ibfk_2` FOREIGN KEY (`hour_id`) REFERENCES `presence_hour` (`hour_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`div_id`) REFERENCES `division` (`div_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
