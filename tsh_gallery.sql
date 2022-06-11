-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 16, 2020 at 01:32 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tshu2_dmit2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `tsh_gallery`
--

CREATE TABLE `tsh_gallery` (
  `tsh_title` varchar(255) NOT NULL,
  `tsh_description` text NOT NULL,
  `tsh_filename` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tsh_gallery`
--

INSERT INTO `tsh_gallery` (`tsh_title`, `tsh_description`, `tsh_filename`, `id`) VALUES
('Eating Cat', 'Cat eating food.', '5fb2320f71b78.jpg', 173),
('Cat & a Dog', 'Image of a cat & a dog.', '5fb233611c1c6.jpg', 174),
('Angry Cat', 'A very angry cat.', '5fb2339a1faa6.jpg', 175),
('Posing Dog', 'Dog posing. Also this is a .PNG image.', '5fb233bd4f2f0.png', 176),
('Dog in the snow', 'A dog in the snow.', '5fb233e47a01e.jpg', 177),
('Dog Running', 'An image of a dog running.', '5fb233fb336a4.jpg', 178),
('Dog Sleeping', 'A dog taking a nap.', '5fb2344949305.jpg', 179),
('Cat Peeping', 'A picture of a cat peeping.', '5fb23467a9b33.jpg', 180),
('Dog with a Stick', 'A picture of a very tiny dog holding a very big stick.', '5fb234902f971.jpg', 181),
('Dog Walking', 'A dog going for a walk.', '5fb234aa05f0c.jpg', 182),
('A dog holding a flower', 'A picture of a dog holding a flower.', '5fb234dda28ca.jpg', 183),
('Sleeping Cat', 'A cat taking a nap.', '5fb235009a1d5.jpg', 184),
('Happy Dog', 'A very happy dog.', '5fb23526258d8.jpg', 185),
('Cat Stretching', 'A cat stretching.', '5fb2356903db1.jpg', 186),
('Dog Eating', 'A dog eating food', '5fb2358d82fb6.jpg', 187);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tsh_gallery`
--
ALTER TABLE `tsh_gallery`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tsh_gallery`
--
ALTER TABLE `tsh_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
