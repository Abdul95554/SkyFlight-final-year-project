-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2025 at 10:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musafir_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `from_city_id` int(11) DEFAULT NULL,
  `to_city_id` int(11) DEFAULT NULL,
  `passenger_count` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `distance_km` float DEFAULT NULL,
  `amount_given` int(11) DEFAULT NULL,
  `change_returned` int(11) DEFAULT NULL,
  `departure_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `airport_code` varchar(10) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `country_id`, `airport_code`, `latitude`, `longitude`) VALUES
(1, 'Karachi', 11, 'KHI', 24.8607, 67.0011),
(2, 'Lahore', 11, 'LHE', 31.5216, 74.4036),
(3, 'Islamabad', 11, 'ISB', 33.6167, 73.0992),
(4, 'Delhi', 7, 'DEL', 28.5562, 77.1),
(5, 'Mumbai', 7, 'BOM', 19.0896, 72.8656),
(6, 'Bangalore', 7, 'BLR', 13.1986, 77.7066),
(7, 'New York', 20, 'JFK', 40.6413, -73.7781),
(8, 'Los Angeles', 20, 'LAX', 33.9416, -118.4085),
(9, 'Chicago', 20, 'ORD', 41.9742, -87.9073),
(10, 'London', 19, 'LHR', 51.47, -0.4543),
(11, 'Manchester', 19, 'MAN', 53.3659, -2.2729),
(12, 'Toronto', 3, 'YYZ', 43.6777, -79.6248),
(13, 'Vancouver', 3, 'YVR', 49.1967, -123.1815),
(14, 'Frankfurt', 6, 'FRA', 50.1109, 8.6821),
(15, 'Paris', 5, 'CDG', 49.0097, 2.5479),
(16, 'Sydney', 1, 'SYD', -33.9399, 151.1753),
(17, 'Beijing', 4, 'PEK', 40.0801, 116.5846),
(18, 'Tokyo', 9, 'NRT', 35.773, 140.3929),
(19, 'Istanbul', 17, 'IST', 41.2753, 28.7519),
(20, 'Dubai', 18, 'DXB', 25.2532, 55.3657),
(21, 'Jeddah', 13, 'JED', 21.6702, 39.1515),
(22, 'Johannesburg', 15, 'JNB', -26.1337, 28.242),
(23, 'Sao Paulo', 2, 'GRU', -23.4356, -46.4731),
(24, 'Moscow', 12, 'SVO', 55.9726, 37.4146),
(25, 'Rome', 8, 'FCO', 41.8003, 12.2389),
(26, 'Madrid', 16, 'MAD', 40.472, -3.5608),
(27, 'Amsterdam', 10, 'AMS', 52.3105, 4.7683),
(28, 'Singapore', 14, 'SIN', 1.3644, 103.9915),
(29, 'Buenos Aires', 21, 'EZE', -34.8222, -58.5358),
(30, 'Dhaka', 22, 'DAC', 23.8433, 90.3978),
(31, 'Cairo', 23, 'CAI', 30.1219, 31.4056),
(32, 'Jakarta', 24, 'CGK', -6.1256, 106.6558),
(33, 'Kuala Lumpur', 26, 'KUL', 2.7456, 101.7092),
(34, 'Mexico City', 27, 'MEX', 19.4361, -99.0719),
(35, 'Auckland', 28, 'AKL', -37.0081, 174.7917),
(36, 'Lagos', 29, 'LOS', 6.5774, 3.3212),
(37, 'Oslo', 30, 'OSL', 60.1939, 11.1004),
(38, 'Manila', 31, 'MNL', 14.5086, 121.0198),
(39, 'Warsaw', 32, 'WAW', 52.1657, 20.9671),
(40, 'Lisbon', 33, 'LIS', 38.7742, -9.1342),
(41, 'Doha', 34, 'DOH', 25.2731, 51.6081),
(42, 'Seoul', 35, 'ICN', 37.4602, 126.4407),
(43, 'Stockholm', 36, 'ARN', 59.6519, 17.9238),
(44, 'Zurich', 37, 'ZRH', 47.4581, 8.5555),
(45, 'Bangkok', 38, 'BKK', 13.69, 100.7501),
(46, 'Kyiv', 39, 'KBP', 50.345, 30.8947),
(47, 'Ho Chi Minh City', 40, 'SGN', 10.8188, 106.6518),
(48, 'Nairobi', 25, 'NBO', -1.3192, 36.9278);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Australia'),
(2, 'Brazil'),
(3, 'Canada'),
(4, 'China'),
(5, 'France'),
(6, 'Germany'),
(7, 'India'),
(8, 'Italy'),
(9, 'Japan'),
(10, 'Netherlands'),
(11, 'Pakistan'),
(12, 'Russia'),
(13, 'Saudi Arabia'),
(14, 'Singapore'),
(15, 'South Africa'),
(16, 'Spain'),
(17, 'Turkey'),
(18, 'UAE'),
(19, 'United Kingdom'),
(20, 'United States'),
(21, 'Argentina'),
(22, 'Bangladesh'),
(23, 'Egypt'),
(24, 'Indonesia'),
(25, 'Kenya'),
(26, 'Malaysia'),
(27, 'Mexico'),
(28, 'New Zealand'),
(29, 'Nigeria'),
(30, 'Norway'),
(31, 'Philippines'),
(32, 'Poland'),
(33, 'Portugal'),
(34, 'Qatar'),
(35, 'South Korea'),
(36, 'Sweden'),
(37, 'Switzerland'),
(38, 'Thailand'),
(39, 'Ukraine'),
(40, 'Vietnam');

-- --------------------------------------------------------

--
-- Table structure for table `distances`
--

CREATE TABLE `distances` (
  `id` int(11) NOT NULL,
  `from_city_id` int(11) DEFAULT NULL,
  `to_city_id` int(11) DEFAULT NULL,
  `distance_km` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE `passengers` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `cnic` varchar(20) DEFAULT NULL,
  `seat_no` varchar(10) DEFAULT NULL,
  `travel_class` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distances`
--
ALTER TABLE `distances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_city_id` (`from_city_id`),
  ADD KEY `to_city_id` (`to_city_id`);

--
-- Indexes for table `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `distances`
--
ALTER TABLE `distances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passengers`
--
ALTER TABLE `passengers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Constraints for table `distances`
--
ALTER TABLE `distances`
  ADD CONSTRAINT `distances_ibfk_1` FOREIGN KEY (`from_city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `distances_ibfk_2` FOREIGN KEY (`to_city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `passengers`
--
ALTER TABLE `passengers`
  ADD CONSTRAINT `passengers_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
