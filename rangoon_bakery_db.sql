-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2023 at 04:59 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rangoon_bakery_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `birthday`
--

CREATE TABLE `birthday` (
  `ID` int(11) NOT NULL,
  `Photo` varchar(150) NOT NULL,
  `Design` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `birthday`
--

INSERT INTO `birthday` (`ID`, `Photo`, `Design`) VALUES
(1, 'ProductPhotos/Birthday_Cakes/1.jpg', 'Chocolate Design'),
(1, 'ProductPhotos/Birthday_Cakes/2.jpg', 'Chocolate Design'),
(1, 'ProductPhotos/Birthday_Cakes/3.jpg', 'Chocolate Design'),
(1, 'ProductPhotos/Birthday_Cakes/4.jpg', 'Chocolate Design'),
(1, 'ProductPhotos/Birthday_Cakes/5.jpg', 'Chocolate Design'),
(1, 'ProductPhotos/Birthday_Cakes/6.jpg', 'Chocolate Design'),
(1, 'ProductPhotos/Birthday_Cakes/7.jpg', 'Chocolate Design'),
(1, 'ProductPhotos/Birthday_Cakes/8.jpg', 'Chocolate Design'),
(1, 'ProductPhotos/Birthday_Cakes/9.jpg', 'Chocolate Design'),
(2, 'ProductPhotos/Birthday_Cakes/a1.jpg', 'Flower Design'),
(2, 'ProductPhotos/Birthday_Cakes/a2.jpg', 'Flower Design'),
(2, 'ProductPhotos/Birthday_Cakes/a3.jpg', 'Flower Design'),
(2, 'ProductPhotos/Birthday_Cakes/a4.jpg', 'Flower Design'),
(2, 'ProductPhotos/Birthday_Cakes/a5.jpg', 'Flower Design'),
(2, 'ProductPhotos/Birthday_Cakes/a6.jpg', 'Flower Design'),
(2, 'ProductPhotos/Birthday_Cakes/a7.jpg', 'Flower Design'),
(2, 'ProductPhotos/Birthday_Cakes/a8.jpg', 'Flower Design'),
(2, 'ProductPhotos/Birthday_Cakes/a9.jpg', 'Flower Design'),
(2, 'ProductPhotos/Birthday_Cakes/a10.jpg', 'Flower Design'),
(2, 'ProductPhotos/Birthday_Cakes/a11.jpg', 'Flower Design'),
(2, 'ProductPhotos/Birthday_Cakes/a12.jpg', 'Flower Design'),
(2, 'ProductPhotos/Birthday_Cakes/a13.jpg', 'Flower Design');

-- --------------------------------------------------------

--
-- Table structure for table `birthday_cake_type`
--

CREATE TABLE `birthday_cake_type` (
  `BCTID` int(11) NOT NULL,
  `Birthday` varchar(30) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `Size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `Name`) VALUES
(1, 'Bread'),
(2, 'Cake'),
(3, 'Birthday Cake');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Ph_No` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `Name`, `Ph_No`, `Email`, `Password`) VALUES
(1, 'John', '09-441045925', 'johnwick@email.com', 'johnwick'),
(2, 'Honey Jackson', '', 'hooneyjackson@gmail.com', ''),
(3, 'Thura Win', '+959441045925', 'thura@email.com', 'thura'),
(4, 'Mg Thura', '', 'tmg18471@gmail.com', ''),
(5, 'mcu movies', '', 'mcumoviespartone@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `ID` int(11) NOT NULL,
  `Product` int(11) NOT NULL,
  `Total` int(11) NOT NULL,
  `Delivery` int(11) NOT NULL,
  `Customer` varchar(30) NOT NULL,
  `D_Name` varchar(30) NOT NULL,
  `D_Phone` varchar(15) NOT NULL,
  `D_Address` varchar(200) NOT NULL,
  `Payment` varchar(15) NOT NULL,
  `Staff` varchar(30) NOT NULL,
  `Date` date NOT NULL,
  `Status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`ID`, `Product`, `Total`, `Delivery`, `Customer`, `D_Name`, `D_Phone`, `D_Address`, `Payment`, `Staff`, `Date`, `Status`) VALUES
(1, 1, 1005, 1500, '', 'Thura Win', '+959441045925', 'bet 20st & 21st, 81st. Mandalay Aungmyethazan Township', 'KBZ', 'Peter Parker', '2022-05-08', 'Delivered'),
(2, 1, 1005, 1750, '', 'Thura Win', '+959441045925', 'Blah Blah Yangon Dagon Township', 'KBZ', 'Peter Parker', '2022-06-12', 'Delivered'),
(3, 1, 1005, 1750, '', 'Thura Win', '+959441045925', 'Blah Mandalay Kyaukse Township', 'KBZ', 'Peter Parker', '2022-06-12', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_details`
--

CREATE TABLE `delivery_details` (
  `Delivery_ID` int(11) NOT NULL,
  `Product` varchar(50) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_details`
--

INSERT INTO `delivery_details` (`Delivery_ID`, `Product`, `Price`, `Quantity`) VALUES
(1, 'Butterfly Danish', 1000, 1),
(2, 'Butterfly Danish', 1000, 1),
(3, 'Butterfly Danish', 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `entry_details`
--

CREATE TABLE `entry_details` (
  `Entry_ID` int(11) NOT NULL,
  `Product` varchar(30) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entry_details`
--

INSERT INTO `entry_details` (`Entry_ID`, `Product`, `Quantity`) VALUES
(1, 'Cream Cheese Bread', 150),
(1, 'Sausage Bread', 100),
(1, 'Sweet Danish', 175),
(1, 'Wife Cake', 100),
(1, 'Chocolate Cashewnut', 200),
(2, 'Butterfly Danish', 125),
(2, 'Walnut Raisin', 150),
(2, 'Almond Stick Cookies', 175),
(2, 'Chocolate Crossiant', 225),
(2, 'Tuna Puff', 240),
(3, 'Butterfly Danish', 150),
(3, 'Plain Crossiant', 175),
(4, 'Butterfly Danish', 40),
(4, 'Wife Cake', 15),
(5, 'Sausage Bread', 15),
(6, 'Sweet Danish', 3),
(6, 'Sausage Bread', 1);

-- --------------------------------------------------------

--
-- Table structure for table `entry_record`
--

CREATE TABLE `entry_record` (
  `Entry_ID` int(11) NOT NULL,
  `Factory` varchar(30) NOT NULL,
  `Total_Product` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entry_record`
--

INSERT INTO `entry_record` (`Entry_ID`, `Factory`, `Total_Product`, `Date`) VALUES
(1, 'Sat Mu Zone', 5, '2022-04-26'),
(2, 'Da Gone', 5, '2022-04-26'),
(3, 'Myout Pyin', 2, '2022-04-27'),
(4, 'Myout Pyin', 2, '2022-05-24'),
(5, 'Da Gone', 1, '2022-05-24'),
(6, 'Myout Pyin', 2, '2022-05-25');

-- --------------------------------------------------------

--
-- Table structure for table `factory`
--

CREATE TABLE `factory` (
  `ID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `factory`
--

INSERT INTO `factory` (`ID`, `Name`, `Location`) VALUES
(1, 'Sat Mu Zone', 'Mandalay'),
(2, 'Myout Pyin', 'Mandalay'),
(3, 'Da Gone', 'Yangon'),
(4, 'Hlel Tan', 'Yangon');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `User` int(11) NOT NULL,
  `Product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`User`, `Product`) VALUES
(2, 8),
(2, 10),
(2, 13),
(2, 14),
(2, 20),
(2, 22);

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `ID` int(11) NOT NULL,
  `Form` varchar(50) NOT NULL,
  `Photo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`ID`, `Form`, `Photo`) VALUES
(1, 'Staff', 'FormPhotos/Category'),
(2, 'Factory', 'FormPhotos/Factory'),
(3, 'Jobs', 'FormPhotos/Role'),
(4, 'Product', 'FormPhotos/Product'),
(5, 'Category', 'FormPhotos/Category'),
(6, 'Entry', '');

-- --------------------------------------------------------

--
-- Table structure for table `nrc`
--

CREATE TABLE `nrc` (
  `No` int(11) NOT NULL,
  `Code` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nrc`
--

INSERT INTO `nrc` (`No`, `Code`) VALUES
(1, 'AhGaYa'),
(1, 'AhTaNa'),
(1, 'BhaMaNa'),
(1, 'DaPhaYa'),
(1, 'HaPaNa'),
(1, 'KaMaNa'),
(1, 'KaMaTa'),
(1, 'KaPaTa'),
(1, 'KhaLaPha'),
(1, 'KhaPhaNa'),
(1, 'LaGaNa'),
(1, 'MaGaDa'),
(1, 'MaKaNa'),
(1, 'MaKaTa'),
(1, 'MaKaTha'),
(1, 'MaKhaBa'),
(1, 'MaLaNa'),
(1, 'MaMaNa'),
(1, 'MaNyaNa'),
(1, 'MaSaNa'),
(1, 'MaTaNa'),
(1, 'NaMaNa'),
(1, 'PaMaNa'),
(1, 'PaNaDa'),
(1, 'PaTaAh'),
(1, 'PaWaNa'),
(1, 'PhaKaNa'),
(1, 'SaBaNa'),
(1, 'SaBaTa'),
(1, 'SaDaNa'),
(1, 'SaKaNa'),
(1, 'SaLaNa'),
(1, 'SaPaBa'),
(1, 'TaNaNa'),
(1, 'WaMaNa'),
(1, 'YaBaYa'),
(1, 'YaKaNa'),
(2, 'BaLaKha'),
(2, 'DaMaSa'),
(2, 'HtaTaPa'),
(2, 'KhaSana'),
(2, 'LaKaNa'),
(2, 'MaSaNa'),
(2, 'MaYaMa'),
(2, 'PhaLaSa'),
(2, 'PhaSaNa'),
(2, 'PhaYaSa'),
(2, 'SaSaNa'),
(2, 'YaTaNa'),
(2, 'YaThaNa'),
(3, 'BaAhNa'),
(3, 'BaGaLa'),
(3, 'BaKaLa'),
(3, 'BaThaSa'),
(3, 'KaDaNa'),
(3, 'KaKaYa'),
(3, 'KaMaMa'),
(3, 'KaSaKa'),
(3, 'KaTaKha'),
(3, 'LaBaNa'),
(3, 'LaThaNa'),
(3, 'MaSaLa'),
(3, 'MaWaTa'),
(3, 'PaKaNa'),
(3, 'PhaAhNa'),
(3, 'PhaPaNa'),
(3, 'SaKaLa'),
(3, 'ThaTaKa'),
(3, 'ThaTaNa'),
(3, 'WaLaMa'),
(3, 'YaYaTha'),
(4, 'HaKhaNa'),
(4, 'HtaTaLa'),
(4, 'KaKhaNa'),
(4, 'KaPaLa'),
(4, 'MaTaNa'),
(4, 'MaTaPa'),
(4, 'PaLaWa'),
(4, 'PhaLaNa'),
(4, 'SaMaNa'),
(4, 'TaTaNa'),
(4, 'TaZaNa'),
(4, 'YaKhaDa'),
(4, 'YaZaNa'),
(5, 'AhHtaNa'),
(5, 'AhMaZa'),
(5, 'AhTaNa'),
(5, 'AhYaTa'),
(5, 'BaTaLa'),
(5, 'BhaMaNa'),
(5, 'DaHaNa'),
(5, 'DaKaNa'),
(5, 'DaPaYa'),
(5, 'HaMaLa'),
(5, 'HtaKhaNa'),
(5, 'HtaPaKha'),
(5, 'KaBaLa'),
(5, 'KaLaHta'),
(5, 'KaLaNa'),
(5, 'KaLaTa'),
(5, 'KaLaTha'),
(5, 'KaLaWa'),
(5, 'KaMaNa'),
(5, 'KaNaWah'),
(5, 'KaSaLa'),
(5, 'KaThaNa'),
(5, 'KhaAuNa'),
(5, 'KhaAuTa'),
(5, 'KhaPaNa'),
(5, 'KhaTaNa'),
(5, 'LaHaNa'),
(5, 'LaYaNa'),
(5, 'MaKaNa'),
(5, 'MaLaNa'),
(5, 'MaMaNa'),
(5, 'MaMaTa'),
(5, 'MaPaLa'),
(5, 'MaThaNa'),
(5, 'MaYaNa'),
(5, 'NaYaNa'),
(5, 'NgaSaNa'),
(5, 'PaLaBa'),
(5, 'PaSaNa'),
(5, 'PhaPaNa'),
(5, 'SaKaNa'),
(5, 'SaLaKa'),
(5, 'SaMaYa'),
(5, 'TaAuNa'),
(5, 'TaMaNa'),
(5, 'TaSaNa'),
(5, 'WaLaNa'),
(5, 'WaThaNa'),
(5, 'YaAuNa'),
(5, 'YaBaNa'),
(5, 'YaMaPa'),
(6, 'AhMaYa'),
(6, 'BaPaNa'),
(6, 'HaThaTa'),
(6, 'HtaWaNa'),
(6, 'KaLaAh'),
(6, 'KaPaNa'),
(6, 'KaSaNa'),
(6, 'KaThaMa'),
(6, 'KaThaNa'),
(6, 'KaYaYa'),
(6, 'KhaMaKa'),
(6, 'LaLaNa'),
(6, 'MaAaNa'),
(6, 'MaAhYa'),
(6, 'MaMaLa'),
(6, 'MaMaNa'),
(6, 'MaTaNa'),
(6, 'PaKaMa'),
(6, 'PaLaNa'),
(6, 'PaLaTa'),
(6, 'TaNaTha'),
(6, 'ThaTaYa'),
(6, 'ThaYaKha'),
(6, 'YaPhaNa'),
(7, 'AhPhaNa'),
(7, 'AuTaNa'),
(7, 'DaAuNa'),
(7, 'HtaTaPa'),
(7, 'KaKaNa'),
(7, 'KaPaKa'),
(7, 'KaTaKha'),
(7, 'KaTaNa'),
(7, 'KaTaTa'),
(7, 'KaWaNa'),
(7, 'LaPaTa'),
(7, 'MaDaNa'),
(7, 'MaLaNa'),
(7, 'MaNyaNa'),
(7, 'MaWaTa'),
(7, 'NaTaLa'),
(7, 'NyaLaPa'),
(7, 'PaKhaNa'),
(7, 'PaKhaTa'),
(7, 'PaMaNa'),
(7, 'PaNaKa'),
(7, 'PaSaTa'),
(7, 'PaTaLa'),
(7, 'PaTaNa'),
(7, 'PaTaSa'),
(7, 'PaTaTa'),
(7, 'PhaMaNa'),
(7, 'TaNgaNa'),
(7, 'ThaKaNa'),
(7, 'ThaNaPa'),
(7, 'ThaNaSa'),
(7, 'ThaWaTa'),
(7, 'WaMaNa'),
(7, 'YaKaNa'),
(7, 'YaTaNa'),
(7, 'YaTaYa'),
(7, 'ZaKaNa'),
(8, 'AhLaNa'),
(8, 'BaKaLa'),
(8, 'GaGaNa'),
(8, 'HtaLaNa'),
(8, 'KaHtaNa'),
(8, 'KaMaNa'),
(8, 'KhaMaNa'),
(8, 'MaBaNa'),
(8, 'MaGaDa'),
(8, 'MaHtaLa'),
(8, 'MaHtaNa'),
(8, 'MaKaNa'),
(8, 'MaLaNa'),
(8, 'MaMaNa'),
(8, 'MaTaNa'),
(8, 'MaThaNa'),
(8, 'MaYaSa'),
(8, 'NaMaNa'),
(8, 'NgaPhaNa'),
(8, 'PaKhaKa'),
(8, 'PaMaNa'),
(8, 'PaPhaNa'),
(8, 'SaKaNa'),
(8, 'SaLaNa'),
(8, 'SaMaNa'),
(8, 'SaPaWa'),
(8, 'SaPhaNa'),
(8, 'SaTaYa'),
(8, 'TaTaKa'),
(8, 'ThaYaNa'),
(8, 'YaNaKa'),
(8, 'YaNaKha'),
(8, 'YaSaKa'),
(9, 'AhKhaNa'),
(9, 'AhMaBa'),
(9, 'AhMaYa'),
(9, 'AhMaZa'),
(9, 'AhSaNa'),
(9, 'AhYaTa'),
(9, 'AuTaTha'),
(9, 'DaKhaTha'),
(9, 'KaMaNa'),
(9, 'KaPaTa'),
(9, 'KaSaNa'),
(9, 'KhaAhZa'),
(9, 'KhaMaKha'),
(9, 'KhaMaMa'),
(9, 'KhaMaNa'),
(9, 'KhaMaSa'),
(9, 'KhaMaTha'),
(9, 'KhaMaZa'),
(9, 'LaKaNa'),
(9, 'LaWaNa'),
(9, 'MaHaMa'),
(9, 'MaHtaLa'),
(9, 'MaKaKha'),
(9, 'MaKaNa'),
(9, 'MaKhaNa'),
(9, 'MaLaNa'),
(9, 'MaMaNa'),
(9, 'MaNaMa'),
(9, 'MaNaTa'),
(9, 'MaSaNa'),
(9, 'MaTaLa'),
(9, 'MaTaNa'),
(9, 'MaTaYa'),
(9, 'MaThaNa'),
(9, 'MaYaMa'),
(9, 'MaYaTa'),
(9, 'NaHtaKa'),
(9, 'NaMaNa'),
(9, 'NaNaMa'),
(9, 'NaTaKa'),
(9, 'NgaThaYa'),
(9, 'NgaZaNa'),
(9, 'NyaAuNa'),
(9, 'PaAuLa'),
(9, 'PaBaNa'),
(9, 'PaBaTha'),
(9, 'PaKaKha'),
(9, 'PaKhaKa'),
(9, 'PaKhaMa'),
(9, 'PaMaNa'),
(9, 'PaThaKa'),
(9, 'SaKaNa'),
(9, 'SaKaTa'),
(9, 'TaKaNa'),
(9, 'TaKaTa'),
(9, 'TaTaAu'),
(9, 'TaThaNa'),
(9, 'ThaPaKa'),
(9, 'ThaSaNa'),
(9, 'ThaTaYa'),
(9, 'ThaWaNa'),
(9, 'WaTaNa'),
(9, 'YaAuNa'),
(9, 'YaMaTha'),
(9, 'ZaBaTha'),
(9, 'ZaYaTha'),
(10, 'BaAhNa'),
(10, 'BaLaNa'),
(10, 'HtaHtaNa'),
(10, 'KaHtaNa'),
(10, 'KaKhaMa'),
(10, 'KaMaLa'),
(10, 'KaMaYa'),
(10, 'KhaSaNa'),
(10, 'KhaZaNa'),
(10, 'LaMaNa'),
(10, 'MaDaNa'),
(10, 'MaLaMa'),
(10, 'MaSaNa'),
(10, 'PaMaNa'),
(10, 'PhaPaNa'),
(10, 'ThaHtaNa'),
(10, 'ThaPhaYa'),
(10, 'YaMaNa'),
(11, 'AhMaNa'),
(11, 'BaThaTa'),
(11, 'GaMaNa'),
(11, 'KaPhaNa'),
(11, 'KaTaLa'),
(11, 'KaTaNa'),
(11, 'LaMaTa'),
(11, 'MaAhNa'),
(11, 'MaAhTa'),
(11, 'MaAuNa'),
(11, 'MaMaNa'),
(11, 'MaPaNa'),
(11, 'MaPaTa'),
(11, 'MaTaNa'),
(11, 'PaNaKa'),
(11, 'PaNaTa'),
(11, 'PaTaNa'),
(11, 'SaTaNa'),
(11, 'TaKaNa'),
(11, 'TaPaWa'),
(11, 'ThaTaNa'),
(11, 'YaBhaNa'),
(11, 'YaTaNa'),
(11, 'YaTaTha'),
(11, 'YaThaTa'),
(12, 'AhLaNa'),
(12, 'AhSaNa'),
(12, 'AuKaMa'),
(12, 'AuKaTa'),
(12, 'BhaHaNa'),
(12, 'BhaTaHta'),
(12, 'DaGaMa'),
(12, 'DaGaNa'),
(12, 'DaGaSa'),
(12, 'DaGaTa'),
(12, 'DaGaYa'),
(12, 'DaLaNa'),
(12, 'DaPaNa'),
(12, 'HtaTaPa'),
(12, 'KaKaKa'),
(12, 'KaKhaKa'),
(12, 'KaMaNa'),
(12, 'KaMaTa'),
(12, 'KaMaYa'),
(12, 'KaTaNa'),
(12, 'KaTaTa'),
(12, 'KhaYaNa'),
(12, 'LaKaNa'),
(12, 'LaMaNa'),
(12, 'LaMaTa'),
(12, 'LaThaNa'),
(12, 'LaThaYa'),
(12, 'MaAuKa'),
(12, 'MaBaNa'),
(12, 'MaGaDa'),
(12, 'MaGaTa'),
(12, 'MaYaKa'),
(12, 'PaBaTa'),
(12, 'PaZaTa'),
(12, 'SaKaKha'),
(12, 'SaKaNa'),
(12, 'SaKhaNa'),
(12, 'TaAuKa'),
(12, 'TaKaNa'),
(12, 'TaMaNa'),
(12, 'TaTaHta'),
(12, 'TaTaNa'),
(12, 'ThaGaKa'),
(12, 'ThaKaTa'),
(12, 'ThaKhaNa'),
(12, 'ThaLaNa'),
(12, 'YaKaNa'),
(12, 'YaPaTha'),
(13, 'HaMaNa'),
(13, 'HaPaNa'),
(13, 'KaHaNa'),
(13, 'KaKaNa'),
(13, 'KaKhaNa'),
(13, 'KaLaNa'),
(13, 'KaMaNa'),
(13, 'KaTaLa'),
(13, 'KaTaNa'),
(13, 'KaThaNa'),
(13, 'KhaLaNa'),
(13, 'KhaYaHa'),
(13, 'LaKaNa'),
(13, 'LaKhaNa'),
(13, 'LaLaNa'),
(13, 'LaYaNa'),
(13, 'MaBaNa'),
(13, 'MaHaYa'),
(13, 'MaHtaTa'),
(13, 'MaKaNa'),
(13, 'MaKhaNa'),
(13, 'MaKhaTa'),
(13, 'MaLaNa'),
(13, 'MaMaNa'),
(13, 'MaNaNa'),
(13, 'MaNgaNa'),
(13, 'MaPaNa'),
(13, 'MaPhaNa'),
(13, 'MaPhaTa'),
(13, 'MaSaNa'),
(13, 'MaSaTa'),
(13, 'MaTaNa'),
(13, 'MaYaNa'),
(13, 'MaYaTa'),
(13, 'NaKhaNa'),
(13, 'NaKhaTa'),
(13, 'NaMaTa'),
(13, 'NaPhaNa'),
(13, 'NaSaNa'),
(13, 'NaTaNa'),
(13, 'NyaYaNa'),
(13, 'PaLaNa'),
(13, 'PaPaKa'),
(13, 'PaSaNa'),
(13, 'PaTaYa'),
(13, 'PaWaNa'),
(13, 'PhaKhaNa'),
(13, 'SaSaNa'),
(13, 'TaKaNa'),
(13, 'TaMaNya'),
(13, 'TaTaNa'),
(13, 'TaYaNa'),
(13, 'ThaKhaLa'),
(13, 'ThaNaNa'),
(13, 'ThaPaNa'),
(13, 'WaKaNa'),
(13, 'YaNgaNa'),
(13, 'YaNyaNa'),
(13, 'YaSaNa'),
(14, 'AhGaPa'),
(14, 'AhMaNa'),
(14, 'AhMaTa'),
(14, 'AhPaNa'),
(14, 'AhSaNa'),
(14, 'BaKaLa'),
(14, 'DaDaYa'),
(14, 'DaNaPha'),
(14, 'HaKaKa'),
(14, 'HaThaTa'),
(14, 'KaKaHta'),
(14, 'KaKaNa'),
(14, 'KaKhaNa'),
(14, 'KaLaNa'),
(14, 'KaMaNa'),
(14, 'KaMaTha'),
(14, 'KaPaNa'),
(14, 'LaMaNa'),
(14, 'LaPaTa'),
(14, 'MaAhBa'),
(14, 'MaAhNa'),
(14, 'MaMaKa'),
(14, 'MaMaNa'),
(14, 'MaYaKa'),
(14, 'NgaPaTa'),
(14, 'NgaSaNa'),
(14, 'NgaThaKha'),
(14, 'NgaYaKa'),
(14, 'NyaTaNa'),
(14, 'PaKaKha'),
(14, 'PaSaLa'),
(14, 'PaTaNa'),
(14, 'PaThaNa'),
(14, 'PaThaYa'),
(14, 'PhaPaNa'),
(14, 'TaMaNa'),
(14, 'ThaPaNa'),
(14, 'WaKhaMa'),
(14, 'YaKaNa'),
(14, 'YaThaYa'),
(14, 'ZaLaNa');

-- --------------------------------------------------------

--
-- Table structure for table `nrc_no`
--

CREATE TABLE `nrc_no` (
  `No` int(11) NOT NULL,
  `Code` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nrc_no`
--

INSERT INTO `nrc_no` (`No`, `Code`) VALUES
(1, 'AhGaYa'),
(1, 'AhTaNa'),
(1, 'BhaMaNa'),
(1, 'DaPhaYa'),
(1, 'HaPaNa'),
(1, 'KaMaNa'),
(1, 'KaMaTa'),
(1, 'KaPaTa'),
(1, 'KhaLaPha'),
(1, 'KhaPhaNa'),
(1, 'LaGaNa'),
(1, 'MaGaDa'),
(1, 'MaKaNa'),
(1, 'MaKaTa'),
(1, 'MaKaTha'),
(1, 'MaKhaBa'),
(1, 'MaLaNa'),
(1, 'MaMaNa'),
(1, 'MaNyaNa'),
(1, 'MaSaNa'),
(1, 'MaTaNa'),
(1, 'NaMaNa'),
(1, 'PaMaNa'),
(1, 'PaNaDa'),
(1, 'PaTaAh'),
(1, 'PaWaNa'),
(1, 'PhaKaNa'),
(1, 'SaBaNa'),
(1, 'SaBaTa'),
(1, 'SaDaNa'),
(1, 'SaKaNa'),
(1, 'SaLaNa'),
(1, 'SaPaBa'),
(1, 'TaNaNa'),
(1, 'WaMaNa'),
(1, 'YaBaYa'),
(1, 'YaKaNa'),
(2, 'BaLaKha'),
(2, 'DaMaSa'),
(2, 'HtaTaPa'),
(2, 'KhaSana'),
(2, 'LaKaNa'),
(2, 'MaSaNa'),
(2, 'MaYaMa'),
(2, 'PhaLaSa'),
(2, 'PhaSaNa'),
(2, 'PhaYaSa'),
(2, 'SaSaNa'),
(2, 'YaTaNa'),
(2, 'YaThaNa'),
(3, 'BaAhNa'),
(3, 'BaGaLa'),
(3, 'BaKaLa'),
(3, 'BaThaSa'),
(3, 'KaDaNa'),
(3, 'KaKaYa'),
(3, 'KaMaMa'),
(3, 'KaSaKa'),
(3, 'KaTaKha'),
(3, 'LaBaNa'),
(3, 'LaThaNa'),
(3, 'MaSaLa'),
(3, 'MaWaTa'),
(3, 'PaKaNa'),
(3, 'PhaAhNa'),
(3, 'PhaPaNa'),
(3, 'SaKaLa'),
(3, 'ThaTaKa'),
(3, 'ThaTaNa'),
(3, 'WaLaMa'),
(3, 'YaYaTha'),
(4, 'HaKhaNa'),
(4, 'HtaTaLa'),
(4, 'KaKhaNa'),
(4, 'KaPaLa'),
(4, 'MaTaNa'),
(4, 'MaTaPa'),
(4, 'PaLaWa'),
(4, 'PhaLaNa'),
(4, 'SaMaNa'),
(4, 'TaTaNa'),
(4, 'TaZaNa'),
(4, 'YaKhaDa'),
(4, 'YaZaNa'),
(5, 'AhHtaNa'),
(5, 'AhMaZa'),
(5, 'AhTaNa'),
(5, 'AhYaTa'),
(5, 'BaTaLa'),
(5, 'BhaMaNa'),
(5, 'DaHaNa'),
(5, 'DaKaNa'),
(5, 'DaPaYa'),
(5, 'HaMaLa'),
(5, 'HtaKhaNa'),
(5, 'HtaPaKha'),
(5, 'KaBaLa'),
(5, 'KaLaHta'),
(5, 'KaLaNa'),
(5, 'KaLaTa'),
(5, 'KaLaTha'),
(5, 'KaLaWa'),
(5, 'KaMaNa'),
(5, 'KaNaWah'),
(5, 'KaSaLa'),
(5, 'KaThaNa'),
(5, 'KhaAuNa'),
(5, 'KhaAuTa'),
(5, 'KhaPaNa'),
(5, 'KhaTaNa'),
(5, 'LaHaNa'),
(5, 'LaYaNa'),
(5, 'MaKaNa'),
(5, 'MaLaNa'),
(5, 'MaMaNa'),
(5, 'MaMaTa'),
(5, 'MaPaLa'),
(5, 'MaThaNa'),
(5, 'MaYaNa'),
(5, 'NaYaNa'),
(5, 'NgaSaNa'),
(5, 'PaLaBa'),
(5, 'PaSaNa'),
(5, 'PhaPaNa'),
(5, 'SaKaNa'),
(5, 'SaLaKa'),
(5, 'SaMaYa'),
(5, 'TaAuNa'),
(5, 'TaMaNa'),
(5, 'TaSaNa'),
(5, 'WaLaNa'),
(5, 'WaThaNa'),
(5, 'YaAuNa'),
(5, 'YaBaNa'),
(5, 'YaMaPa'),
(6, 'AhMaYa'),
(6, 'BaPaNa'),
(6, 'HaThaTa'),
(6, 'HtaWaNa'),
(6, 'KaLaAh'),
(6, 'KaPaNa'),
(6, 'KaSaNa'),
(6, 'KaThaMa'),
(6, 'KaThaNa'),
(6, 'KaYaYa'),
(6, 'KhaMaKa'),
(6, 'LaLaNa'),
(6, 'MaAaNa'),
(6, 'MaAhYa'),
(6, 'MaMaLa'),
(6, 'MaMaNa'),
(6, 'MaTaNa'),
(6, 'PaKaMa'),
(6, 'PaLaNa'),
(6, 'PaLaTa'),
(6, 'TaNaTha'),
(6, 'ThaTaYa'),
(6, 'ThaYaKha'),
(6, 'YaPhaNa'),
(7, 'AhPhaNa'),
(7, 'AuTaNa'),
(7, 'DaAuNa'),
(7, 'HtaTaPa'),
(7, 'KaKaNa'),
(7, 'KaPaKa'),
(7, 'KaTaKha'),
(7, 'KaTaNa'),
(7, 'KaTaTa'),
(7, 'KaWaNa'),
(7, 'LaPaTa'),
(7, 'MaDaNa'),
(7, 'MaLaNa'),
(7, 'MaNyaNa'),
(7, 'MaWaTa'),
(7, 'NaTaLa'),
(7, 'NyaLaPa'),
(7, 'PaKhaNa'),
(7, 'PaKhaTa'),
(7, 'PaMaNa'),
(7, 'PaNaKa'),
(7, 'PaSaTa'),
(7, 'PaTaLa'),
(7, 'PaTaNa'),
(7, 'PaTaSa'),
(7, 'PaTaTa'),
(7, 'PhaMaNa'),
(7, 'TaNgaNa'),
(7, 'ThaKaNa'),
(7, 'ThaNaPa'),
(7, 'ThaNaSa'),
(7, 'ThaWaTa'),
(7, 'WaMaNa'),
(7, 'YaKaNa'),
(7, 'YaTaNa'),
(7, 'YaTaYa'),
(7, 'ZaKaNa'),
(8, 'AhLaNa'),
(8, 'BaKaLa'),
(8, 'GaGaNa'),
(8, 'HtaLaNa'),
(8, 'KaHtaNa'),
(8, 'KaMaNa'),
(8, 'KhaMaNa'),
(8, 'MaBaNa'),
(8, 'MaGaDa'),
(8, 'MaHtaLa'),
(8, 'MaHtaNa'),
(8, 'MaKaNa'),
(8, 'MaLaNa'),
(8, 'MaMaNa'),
(8, 'MaTaNa'),
(8, 'MaThaNa'),
(8, 'MaYaSa'),
(8, 'NaMaNa'),
(8, 'NgaPhaNa'),
(8, 'PaKhaKa'),
(8, 'PaMaNa'),
(8, 'PaPhaNa'),
(8, 'SaKaNa'),
(8, 'SaLaNa'),
(8, 'SaMaNa'),
(8, 'SaPaWa'),
(8, 'SaPhaNa'),
(8, 'SaTaYa'),
(8, 'TaTaKa'),
(8, 'ThaYaNa'),
(8, 'YaNaKa'),
(8, 'YaNaKha'),
(8, 'YaSaKa'),
(9, 'AhKhaNa'),
(9, 'AhMaBa'),
(9, 'AhMaYa'),
(9, 'AhMaZa'),
(9, 'AhSaNa'),
(9, 'AhYaTa'),
(9, 'AuTaTha'),
(9, 'DaKhaTha'),
(9, 'KaMaNa'),
(9, 'KaPaTa'),
(9, 'KaSaNa'),
(9, 'KhaAhZa'),
(9, 'KhaMaKha'),
(9, 'KhaMaMa'),
(9, 'KhaMaNa'),
(9, 'KhaMaSa'),
(9, 'KhaMaTha'),
(9, 'KhaMaZa'),
(9, 'LaKaNa'),
(9, 'LaWaNa'),
(9, 'MaHaMa'),
(9, 'MaHtaLa'),
(9, 'MaKaKha'),
(9, 'MaKaNa'),
(9, 'MaKhaNa'),
(9, 'MaLaNa'),
(9, 'MaMaNa'),
(9, 'MaNaMa'),
(9, 'MaNaTa'),
(9, 'MaSaNa'),
(9, 'MaTaLa'),
(9, 'MaTaNa'),
(9, 'MaTaYa'),
(9, 'MaThaNa'),
(9, 'MaYaMa'),
(9, 'MaYaTa'),
(9, 'NaHtaKa'),
(9, 'NaMaNa'),
(9, 'NaNaMa'),
(9, 'NaTaKa'),
(9, 'NgaThaYa'),
(9, 'NgaZaNa'),
(9, 'NyaAuNa'),
(9, 'PaAuLa'),
(9, 'PaBaNa'),
(9, 'PaBaTha'),
(9, 'PaKaKha'),
(9, 'PaKhaKa'),
(9, 'PaKhaMa'),
(9, 'PaMaNa'),
(9, 'PaThaKa'),
(9, 'SaKaNa'),
(9, 'SaKaTa'),
(9, 'TaKaNa'),
(9, 'TaKaTa'),
(9, 'TaTaAu'),
(9, 'TaThaNa'),
(9, 'ThaPaKa'),
(9, 'ThaSaNa'),
(9, 'ThaTaYa'),
(9, 'ThaWaNa'),
(9, 'WaTaNa'),
(9, 'YaAuNa'),
(9, 'YaMaTha'),
(9, 'ZaBaTha'),
(9, 'ZaYaTha'),
(10, 'BaAhNa'),
(10, 'BaLaNa'),
(10, 'HtaHtaNa'),
(10, 'KaHtaNa'),
(10, 'KaKhaMa'),
(10, 'KaMaLa'),
(10, 'KaMaYa'),
(10, 'KhaSaNa'),
(10, 'KhaZaNa'),
(10, 'LaMaNa'),
(10, 'MaDaNa'),
(10, 'MaLaMa'),
(10, 'MaSaNa'),
(10, 'PaMaNa'),
(10, 'PhaPaNa'),
(10, 'ThaHtaNa'),
(10, 'ThaPhaYa'),
(10, 'YaMaNa'),
(11, 'AhMaNa'),
(11, 'BaThaTa'),
(11, 'GaMaNa'),
(11, 'KaPhaNa'),
(11, 'KaTaLa'),
(11, 'KaTaNa'),
(11, 'LaMaTa'),
(11, 'MaAhNa'),
(11, 'MaAhTa'),
(11, 'MaAuNa'),
(11, 'MaMaNa'),
(11, 'MaPaNa'),
(11, 'MaPaTa'),
(11, 'MaTaNa'),
(11, 'PaNaKa'),
(11, 'PaNaTa'),
(11, 'PaTaNa'),
(11, 'SaTaNa'),
(11, 'TaKaNa'),
(11, 'TaPaWa'),
(11, 'ThaTaNa'),
(11, 'YaBhaNa'),
(11, 'YaTaNa'),
(11, 'YaTaTha'),
(11, 'YaThaTa'),
(12, 'AhLaNa'),
(12, 'AhSaNa'),
(12, 'AuKaMa'),
(12, 'AuKaTa'),
(12, 'BhaHaNa'),
(12, 'BhaTaHta'),
(12, 'DaGaMa'),
(12, 'DaGaNa'),
(12, 'DaGaSa'),
(12, 'DaGaTa'),
(12, 'DaGaYa'),
(12, 'DaLaNa'),
(12, 'DaPaNa'),
(12, 'HtaTaPa'),
(12, 'KaKaKa'),
(12, 'KaKhaKa'),
(12, 'KaMaNa'),
(12, 'KaMaTa'),
(12, 'KaMaYa'),
(12, 'KaTaNa'),
(12, 'KaTaTa'),
(12, 'KhaYaNa'),
(12, 'LaKaNa'),
(12, 'LaMaNa'),
(12, 'LaMaTa'),
(12, 'LaThaNa'),
(12, 'LaThaYa'),
(12, 'MaAuKa'),
(12, 'MaBaNa'),
(12, 'MaGaDa'),
(12, 'MaGaTa'),
(12, 'MaYaKa'),
(12, 'PaBaTa'),
(12, 'PaZaTa'),
(12, 'SaKaKha'),
(12, 'SaKaNa'),
(12, 'SaKhaNa'),
(12, 'TaAuKa'),
(12, 'TaKaNa'),
(12, 'TaMaNa'),
(12, 'TaTaHta'),
(12, 'TaTaNa'),
(12, 'ThaGaKa'),
(12, 'ThaKaTa'),
(12, 'ThaKhaNa'),
(12, 'ThaLaNa'),
(12, 'YaKaNa'),
(12, 'YaPaTha'),
(13, 'HaMaNa'),
(13, 'HaPaNa'),
(13, 'KaHaNa'),
(13, 'KaKaNa'),
(13, 'KaKhaNa'),
(13, 'KaLaNa'),
(13, 'KaMaNa'),
(13, 'KaTaLa'),
(13, 'KaTaNa'),
(13, 'KaThaNa'),
(13, 'KhaLaNa'),
(13, 'KhaYaHa'),
(13, 'LaKaNa'),
(13, 'LaKhaNa'),
(13, 'LaLaNa'),
(13, 'LaYaNa'),
(13, 'MaBaNa'),
(13, 'MaHaYa'),
(13, 'MaHtaTa'),
(13, 'MaKaNa'),
(13, 'MaKhaNa'),
(13, 'MaKhaTa'),
(13, 'MaLaNa'),
(13, 'MaMaNa'),
(13, 'MaNaNa'),
(13, 'MaNgaNa'),
(13, 'MaPaNa'),
(13, 'MaPhaNa'),
(13, 'MaPhaTa'),
(13, 'MaSaNa'),
(13, 'MaSaTa'),
(13, 'MaTaNa'),
(13, 'MaYaNa'),
(13, 'MaYaTa'),
(13, 'NaKhaNa'),
(13, 'NaKhaTa'),
(13, 'NaMaTa'),
(13, 'NaPhaNa'),
(13, 'NaSaNa'),
(13, 'NaTaNa'),
(13, 'NyaYaNa'),
(13, 'PaLaNa'),
(13, 'PaPaKa'),
(13, 'PaSaNa'),
(13, 'PaTaYa'),
(13, 'PaWaNa'),
(13, 'PhaKhaNa'),
(13, 'SaSaNa'),
(13, 'TaKaNa'),
(13, 'TaMaNya'),
(13, 'TaTaNa'),
(13, 'TaYaNa'),
(13, 'ThaKhaLa'),
(13, 'ThaNaNa'),
(13, 'ThaPaNa'),
(13, 'WaKaNa'),
(13, 'YaNgaNa'),
(13, 'YaNyaNa'),
(13, 'YaSaNa'),
(14, 'AhGaPa'),
(14, 'AhMaNa'),
(14, 'AhMaTa'),
(14, 'AhPaNa'),
(14, 'AhSaNa'),
(14, 'BaKaLa'),
(14, 'DaDaYa'),
(14, 'DaNaPha'),
(14, 'HaKaKa'),
(14, 'HaThaTa'),
(14, 'KaKaHta'),
(14, 'KaKaNa'),
(14, 'KaKhaNa'),
(14, 'KaLaNa'),
(14, 'KaMaNa'),
(14, 'KaMaTha'),
(14, 'KaPaNa'),
(14, 'LaMaNa'),
(14, 'LaPaTa'),
(14, 'MaAhBa'),
(14, 'MaAhNa'),
(14, 'MaMaKa'),
(14, 'MaMaNa'),
(14, 'MaYaKa'),
(14, 'NgaPaTa'),
(14, 'NgaSaNa'),
(14, 'NgaThaKha'),
(14, 'NgaYaKa'),
(14, 'NyaTaNa'),
(14, 'PaKaKha'),
(14, 'PaSaLa'),
(14, 'PaTaNa'),
(14, 'PaThaNa'),
(14, 'PaThaYa'),
(14, 'PhaPaNa'),
(14, 'TaMaNa'),
(14, 'ThaPaNa'),
(14, 'WaKhaMa'),
(14, 'YaKaNa'),
(14, 'YaThaYa'),
(14, 'ZaLaNa');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `ID` int(11) NOT NULL,
  `Product` varchar(30) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`ID`, `Product`, `Price`, `Quantity`, `OrderID`) VALUES
(1, 'Butterfly Danish', 1000, 1, 1),
(2, 'Butterfly Danish', 1000, 3, 2),
(3, 'Flower Design Cake', 500000, 2, 3),
(4, 'Chocolate Design Cake', 250000, 1, 3),
(5, 'Butterfly Danish', 1000, 2, 4),
(6, 'Sweet Danish', 1200, 2, 4),
(7, 'Butterfly Danish', 1000, 1, 5),
(8, 'Almond Stick Cookies', 3300, 1, 5),
(9, 'Flower Design Cake', 172000, 1, 5),
(10, 'Chocolate Design Cake', 150000, 1, 5),
(11, 'Cream Cheese Bread', 2800, 1, 6),
(12, 'Cream Cheese Bread', 2800, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `order_record`
--

CREATE TABLE `order_record` (
  `ID` int(11) NOT NULL,
  `Customer` varchar(30) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Phone` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Payment` varchar(30) NOT NULL,
  `Staff` varchar(30) NOT NULL,
  `Location` varchar(500) NOT NULL,
  `Delivery` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_record`
--

INSERT INTO `order_record` (`ID`, `Customer`, `Name`, `Phone`, `Email`, `Payment`, `Staff`, `Location`, `Delivery`, `Date`, `Status`) VALUES
(1, '', 'Thura Win', '+959441045925', 'hooneyjackson@gmail.com', 'Wave', 'Peter Parker', 'Bet 20st & 21st, 81st, Mandalay, Aungmyethazan Township', 1500, '2022-06-14', 'Delivered'),
(2, '', 'Thura Win', '+959441045925', 'hooneyjackson@gmail.com', 'KBZ', 'Peter Parker', 'Bet 20st & 21st, 81st, Mandalay, Aungmyethazan Township', 1000, '2022-06-14', 'Delivered'),
(3, '', 'Thura Win', '+959441045925', 'hooneyjackson@gmail.com', 'COD', 'Peter Parker', 'Bet 20st & 21st, 81st, Mandalay, Aungmyethazan Township', 0, '2022-06-14', 'Assign'),
(4, '', 'Thura Win', '+959441045925', 'hooneyjackson@gmail.com', 'KBZ', 'Peter Parker', 'Bet 20st & 21st, 81st, Mandalay, Aungmyethazan Township', 1500, '2022-06-14', 'Assign'),
(5, '', 'Thura Win', '+959441045925', 'hooneyjackson@gmail.com', 'KBZ', 'Peter Parker', 'Bet 20st & 21st, 81st, Mandalay, Aungmyethazan Township', 0, '2022-06-14', 'Assign'),
(6, '', 'Thura Win', '+959441045925', 'hooneyjackson@gmail.com', 'COD', 'Peter Parker', 'Bet 20st & 21st, 81st, Mandalay, Aungmyethazan Township', 1750, '2022-06-14', 'Assign'),
(7, '', 'Thura Win', '+959441045925', 'hooneyjackson@gmail.com', 'KBZ', 'Peter Parker', 'Bet 20st & 21st, 81st, Mandalay, Aungmyethazan Township', 1750, '2022-06-14', 'Assign');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Price` double NOT NULL,
  `Photo` varchar(300) NOT NULL,
  `Category` varchar(15) NOT NULL,
  `Stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `Name`, `Price`, `Photo`, `Category`, `Stock`) VALUES
(6, 'Cream Cheese Bread', 2800, 'ProductPhotos/6_Cream Cheese Bread.png', 'Bread', 149),
(7, 'Butterfly Danish', 1000, 'ProductPhotos/7_Butterfly Danish.png', 'Bread', 315),
(8, 'Sausage Bread', 1700, 'ProductPhotos/8_Sausage Bread.png', 'Bread', 116),
(9, 'Sweet Danish', 1200, 'ProductPhotos/9_Sweet Danish.png', 'Bread', 178),
(10, 'Wife Cake', 1200, 'ProductPhotos/10_Wife Cake.png', 'Bread', 115),
(12, 'Banana Cake', 2700, 'ProductPhotos/12_Banana Cake.png', 'Cake', 0),
(13, 'Banana Cheese Cake', 2700, 'ProductPhotos/13_Banana Cheese Cake.png', 'Cake', 0),
(14, 'Chocolate Cashewnut', 2000, 'ProductPhotos/14_Chocolate Cashewnut.png', 'Cake', 200),
(15, 'Pandam Cake', 2500, 'ProductPhotos/15_Pandam Cake.png', 'Cake', 0),
(16, 'Durain Cake', 2200, 'ProductPhotos/16_Durain Cake.png', 'Cake', 0),
(17, 'Cake Cookies', 2500, 'ProductPhotos/17_Cake Cookies.png', 'Cake', 0),
(18, 'Chhese Fiber Cake', 2700, 'ProductPhotos/18_Chhese Fiber Cake.png', 'Cake', 0),
(19, 'Walnut Raisin', 3300, 'ProductPhotos/19_Walnut Raisin.png', 'Cake', 150),
(20, 'Almond Stick Cookies', 3300, 'ProductPhotos/20_Almond Stick Cookies.png', 'Cake', 175),
(21, 'Chicken Curry Danish', 1500, 'ProductPhotos/21_Chicken Curry Danish.png', 'Bread', 0),
(22, 'Chocolate Crossiant', 1500, 'ProductPhotos/22_Chocolate Crossiant.png', 'Bread', 225),
(23, 'Plain Crossiant', 1300, 'ProductPhotos/23_Plain Crossiant.png', 'Bread', 175),
(24, 'Tuna Puff', 1300, 'ProductPhotos/24_Tuna Puff.png', 'Bread', 240);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `ID` int(11) NOT NULL,
  `Title` varchar(30) NOT NULL,
  `Salary` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`ID`, `Title`, `Salary`) VALUES
(1, 'Manager', 1000000),
(3, 'Receptionist', 500000),
(10, 'Driver', 250000),
(11, 'Warehouse inspector', 500000);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `ID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Father` varchar(30) NOT NULL,
  `Mother` varchar(30) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Marital_Status` varchar(10) NOT NULL,
  `Position` varchar(20) NOT NULL,
  `Ph_No` varchar(30) NOT NULL,
  `Birthday` date NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `NRC` varchar(30) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Registration_Date` date NOT NULL,
  `Photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`ID`, `Name`, `Father`, `Mother`, `Gender`, `Marital_Status`, `Position`, `Ph_No`, `Birthday`, `Email`, `Password`, `NRC`, `Address`, `Registration_Date`, `Photo`) VALUES
(1, 'Tony Stark', 'Howard Stark', 'Maria Stark', 'Male', 'Married', 'Manager', '+959441045925', '1970-05-29', 'tony@ironman.com', 'tony', '9/AhMaZa(N)076141', '10880 malibu Point, 90265', '2022-03-24', 'StaffPhotos/1_Tony Stark.png'),
(2, 'Joker', 'Thomas Wayne', 'Penny Fleck', 'Male', 'Single', 'Receptionist', '+959441045925', '1940-04-25', 'joker@gotham.com', 'joker', '9/AhMaZa(N)076141', 'Gotham, New York and New Jersey', '2022-04-25', 'StaffPhotos/2_Joker.png'),
(3, 'Peter Parker', 'Ben Parker', 'Mary Parker', 'Male', 'Married', 'Driver', '+959441045925', '2001-08-10', 'peter@spiderman.com', 'peter', '9/AhMaZa(N)076141', '8839 69th Road between Metropolitan Avenue.', '2022-04-25', 'StaffPhotos/3_Peter Parker.png'),
(4, 'Thura Win', 'U Mg Mg Win', 'Daw Moe Moe Lwin', 'Male', 'Single', 'Manager', '+959441045925', '2002-10-28', 'thura@email.com', 'thura', '9/AhMaZa(N)076141', 'Bet 20st & 21st, 81st', '2022-06-24', 'StaffPhotos/4_Thura Win.png');

-- --------------------------------------------------------

--
-- Table structure for table `township`
--

CREATE TABLE `township` (
  `City` varchar(30) NOT NULL,
  `Township` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `township`
--

INSERT INTO `township` (`City`, `Township`) VALUES
('Yangon', 'Ahlon Township'),
('Yangon', 'Bahan Township'),
('Yangon', 'Botataung Township'),
('Yangon', '\r\nDagon Seikkan Township'),
('Yangon', 'Dagon Township'),
('Yangon', 'Dala Township'),
('Yangon', 'Dawbon Township'),
('Yangon', 'East Dagon Township'),
('Yangon', 'Hlaing Township'),
('Yangon', 'Insein Township'),
('Yangon', 'Kamayut Township'),
('Yangon', 'Kyauktada Township'),
('Yangon', 'Kyimyindaing Township'),
('Yangon', 'Lanmadaw Township'),
('Yangon', 'Latha Township'),
('Yangon', 'Mayangon Township'),
('Yangon', 'Mingala Taungnyunt Township'),
('Yangon', 'Mingaladon Township'),
('Yangon', 'North Dagon Township'),
('Yangon', 'North Okkalapa Township'),
('Yangon', 'Pabedan Township'),
('Yangon', 'Pazundaung Township'),
('Yangon', 'Sanchaung Township'),
('Yangon', 'Seikkan Township'),
('Yangon', 'Seikkyi Kanaungto Township'),
('Yangon', 'Shwepyitha Township'),
('Yangon', 'South Dagon Township'),
('Yangon', 'South Okkalapa Township'),
('Yangon', 'Tamwe Township'),
('Yangon', 'Thaketa Township'),
('Yangon', 'Thingangyun Township'),
('Yangon', '\r\nYankin Township'),
('Mandalay', 'Aungmyethazan Township'),
('Mandalay', 'Chanayethazan Township'),
('Mandalay', 'Chanmyathazi Township'),
('Mandalay', '\r\nKyaukpadaung Township'),
('Mandalay', 'Kyaukse Township'),
('Mandalay', 'Maha Aungmye Township'),
('Mandalay', 'Mahlaing Township'),
('Mandalay', 'Meiktila Township'),
('Mandalay', 'Mogok Township'),
('Mandalay', 'Myingyan Township'),
('Mandalay', 'Myittha Township'),
('Mandalay', 'Natogyi Township'),
('Mandalay', 'Ngazun Township'),
('Mandalay', 'Nyaung-U Township'),
('Mandalay', 'Patheingyi Township'),
('Mandalay', 'Pyawbwe Township'),
('Mandalay', 'Pyigyidagun Township'),
('Mandalay', 'Pyinoolwin Township'),
('Mandalay', 'Singu Township'),
('Mandalay', 'Sintgaing Township'),
('Mandalay', 'Tada-U Township'),
('Mandalay', 'Taungtha Township'),
('Mandalay', 'Thabeikkyin Township'),
('Mandalay', 'Thazi Township'),
('Mandalay', 'Wundwin Township'),
('Mandalay', 'Yamethin Township');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `ID` int(11) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `Size` int(11) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`ID`, `Type`, `Size`, `Price`) VALUES
(1, 'Chiffon(BLB/STW)', 8, 31000),
(1, 'Chiffon(BLB/STW)', 10, 44000),
(1, 'Chiffon(BLB/STW)', 12, 58000),
(1, 'Chiffon(BLB/STW)', 14, 82000),
(1, 'Chiffon(BLB/STW)', 16, 100000),
(1, 'Chiffon(BLB/STW)', 18, 128000),
(1, 'Chiffon(BLB/STW)', 20, 150000),
(1, 'Chiffon(BLB/STW)', 22, 172000),
(1, 'Chiffon(BLB/STW)', 24, 250000),
(2, 'Brownie', 8, 41000),
(2, 'Brownie', 10, 54000),
(2, 'Brownie', 12, 71000),
(2, 'Brownie', 14, 103000),
(2, 'Brownie', 16, 136000),
(2, 'Brownie', 18, 159000),
(2, 'Brownie', 20, 181000),
(2, 'Brownie', 22, 223000),
(2, 'Brownie', 24, 276000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `entry_record`
--
ALTER TABLE `entry_record`
  ADD PRIMARY KEY (`Entry_ID`) USING BTREE;

--
-- Indexes for table `factory`
--
ALTER TABLE `factory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`User`,`Product`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `nrc`
--
ALTER TABLE `nrc`
  ADD PRIMARY KEY (`No`,`Code`);

--
-- Indexes for table `nrc_no`
--
ALTER TABLE `nrc_no`
  ADD PRIMARY KEY (`No`,`Code`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`ID`,`OrderID`);

--
-- Indexes for table `order_record`
--
ALTER TABLE `order_record`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`ID`,`Size`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `entry_record`
--
ALTER TABLE `entry_record`
  MODIFY `Entry_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `factory`
--
ALTER TABLE `factory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
