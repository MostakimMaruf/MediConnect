-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 22, 2024 at 04:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `23189637`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `email`, `contact`) VALUES
('admin', '$2y$10$u4sO7.gHGGlOq5OloyjV9OjerEc5Ac1S3dTY.tdHogUEf3gY8E2Iu', 'admin123@gmail.com', '9812345672');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `spec_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `timeslot` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `doctor_id`, `patient_id`, `spec_id`, `date`, `timeslot`) VALUES
(15, 31, 15, 3, '2024-06-19', '13:00:00'),
(17, 32, 14, 49, '2024-06-19', '08:20:00'),
(22, 35, 12, 3, '2024-06-21', '08:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `spec_id` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact` varchar(10) DEFAULT NULL,
  `fees` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `name`, `username`, `password`, `spec_id`, `email`, `contact`, `fees`) VALUES
(31, 'puja', 'doctor4', '$2y$10$qZDi9bu8GjikScBlH5jVMuVpRRg3u/QqDkI4pIBNg/MGYXdOf/fnG', 3, 'doctor4@gmail.com', '53627881', '300'),
(32, 'doctor5', 'dpctor5', '$2y$10$yd9JMvloD4XZJcNuJjlZdeEg.zxdk5GvUCoAc3oZjLm/uVyPShejS', 49, 'doctor5@gmail.com', '98765432', '700'),
(34, 'doctor1', 'doctor1', '$2y$10$/mON8LV4yZixLKdaJl3JkeitEr2VfqcuPPAgZT8KhZoMlSO3zFaxi', 50, 'doctor1@gmail.com', '111111', '1001'),
(35, 'sushant', 'doctor2', '$2y$10$rwEuE6RzIECORRQvcDw9y.St80lp6KA6nn5RvOLe7Awtq62.dMjUO', 3, 'doctor2@gmail.com', '444444', '550');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `blood_group` varchar(50) DEFAULT NULL,
  `contact` varchar(10) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `name`, `password`, `age`, `gender`, `blood_group`, `contact`, `username`) VALUES
(12, 'patient1', '$2y$10$FYCebDGOH/14INif8hs5hONWLpojFw4EXmvT/s8R2Qxwqx4c799PW', 22, 'female', 'A+', '12344567', 'patient1'),
(14, 'patient2', '$2y$10$Cju6akePlhifo2eRRGPPSOOEOU76Cxqp0wKY/xP5gU./SK60Tq6R2', 5, 'Female', 'O+', '7689503', 'patient2'),
(15, 'new patient', '$2y$10$H20CQcaXjCTcr13RPxEGfea4a5oR/YZS55Q169Sn69IFGrwnQzIL6', 15, 'Male', 'B+', '9876654331', 'patient4');

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE `specialization` (
  `spec_id` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`spec_id`, `category`) VALUES
(3, 'Gynocologist'),
(46, 'Neurologist'),
(47, 'orthopedics'),
(48, 'pediatrics'),
(49, 'psychiatrist'),
(50, 'surgeon'),
(51, 'hehe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `specialization`
--
ALTER TABLE `specialization`
  ADD PRIMARY KEY (`spec_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `specialization`
--
ALTER TABLE `specialization`
  MODIFY `spec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`spec_id`) REFERENCES `specialization` (`spec_id`);

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `specialization` (`spec_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
