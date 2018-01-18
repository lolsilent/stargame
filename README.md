# stargame
browser game stargame



-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 18, 2018 at 11:22 PM
-- Server version: 5.7.19
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stargame`
--

-- --------------------------------------------------------

--
-- Table structure for table `lol_members`
--

DROP TABLE IF EXISTS `lol_members`;
CREATE TABLE IF NOT EXISTS `lol_members` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL DEFAULT '',
  `password` varchar(10) NOT NULL DEFAULT '',
  `email` varchar(64) NOT NULL DEFAULT '',
  `level` tinyint(4) NOT NULL,
  `sex` varchar(8) NOT NULL,
  `charname` varchar(16) NOT NULL DEFAULT '',
  `timer` int(11) NOT NULL DEFAULT '0',
  `updater` int(11) NOT NULL DEFAULT '0',
  `a0` bigint(20) NOT NULL DEFAULT '0',
  `a1` bigint(20) NOT NULL DEFAULT '0',
  `a2` bigint(20) NOT NULL DEFAULT '0',
  `a3` bigint(20) NOT NULL DEFAULT '0',
  `a4` bigint(20) NOT NULL DEFAULT '0',
  `a5` bigint(20) NOT NULL DEFAULT '0',
  `a6` bigint(20) NOT NULL DEFAULT '0',
  `a7` bigint(20) NOT NULL DEFAULT '0',
  `a8` bigint(20) NOT NULL DEFAULT '0',
  `a9` bigint(20) NOT NULL DEFAULT '0',
  `a10` bigint(20) NOT NULL DEFAULT '0',
  `a11` bigint(20) NOT NULL DEFAULT '0',
  `a12` bigint(20) NOT NULL DEFAULT '0',
  `a13` bigint(20) NOT NULL DEFAULT '0',
  `a14` bigint(20) NOT NULL DEFAULT '0',
  `a15` bigint(20) NOT NULL DEFAULT '0',
  `a16` bigint(20) NOT NULL DEFAULT '0',
  `a17` bigint(20) NOT NULL DEFAULT '0',
  `a18` bigint(20) NOT NULL DEFAULT '0',
  `a19` bigint(20) NOT NULL DEFAULT '0',
  `b0` int(11) NOT NULL DEFAULT '0',
  `b1` int(11) NOT NULL DEFAULT '0',
  `b2` int(11) NOT NULL DEFAULT '0',
  `b3` int(11) NOT NULL DEFAULT '0',
  `b4` int(11) NOT NULL DEFAULT '0',
  `b5` int(11) NOT NULL DEFAULT '0',
  `b6` int(11) NOT NULL DEFAULT '0',
  `b7` int(11) NOT NULL DEFAULT '0',
  `b8` int(11) NOT NULL DEFAULT '0',
  `b9` int(11) NOT NULL DEFAULT '0',
  `b10` int(11) NOT NULL DEFAULT '0',
  `b11` int(11) NOT NULL DEFAULT '0',
  `b12` int(11) NOT NULL DEFAULT '0',
  `b13` int(11) NOT NULL DEFAULT '0',
  `b14` int(11) NOT NULL DEFAULT '0',
  `b15` int(11) NOT NULL DEFAULT '0',
  `b16` int(11) NOT NULL DEFAULT '0',
  `b17` int(11) NOT NULL DEFAULT '0',
  `b18` int(11) NOT NULL DEFAULT '0',
  `b19` int(11) NOT NULL DEFAULT '0',
  `c0` int(11) NOT NULL DEFAULT '0',
  `c1` int(11) NOT NULL DEFAULT '0',
  `c2` int(11) NOT NULL DEFAULT '0',
  `c3` int(11) NOT NULL DEFAULT '0',
  `c4` int(11) NOT NULL DEFAULT '0',
  `c5` int(11) NOT NULL DEFAULT '0',
  `c6` int(11) NOT NULL DEFAULT '0',
  `c7` int(11) NOT NULL DEFAULT '0',
  `c8` int(11) NOT NULL DEFAULT '0',
  `c9` int(11) NOT NULL DEFAULT '0',
  `c10` int(11) NOT NULL DEFAULT '0',
  `c11` int(11) NOT NULL DEFAULT '0',
  `c12` int(11) NOT NULL DEFAULT '0',
  `c13` int(11) NOT NULL DEFAULT '0',
  `c14` int(11) NOT NULL DEFAULT '0',
  `c15` int(11) NOT NULL DEFAULT '0',
  `c16` int(11) NOT NULL DEFAULT '0',
  `c17` int(11) NOT NULL DEFAULT '0',
  `c18` int(11) NOT NULL DEFAULT '0',
  `c19` int(11) NOT NULL DEFAULT '0',
  `d0` int(11) NOT NULL DEFAULT '0',
  `d1` int(11) NOT NULL DEFAULT '0',
  `d2` int(11) NOT NULL DEFAULT '0',
  `d3` int(11) NOT NULL DEFAULT '0',
  `d4` int(11) NOT NULL DEFAULT '0',
  `d5` int(11) NOT NULL DEFAULT '0',
  `d6` int(11) NOT NULL DEFAULT '0',
  `d7` int(11) NOT NULL DEFAULT '0',
  `d8` int(11) NOT NULL DEFAULT '0',
  `d9` int(11) NOT NULL DEFAULT '0',
  `d10` int(11) NOT NULL DEFAULT '0',
  `d11` int(11) NOT NULL DEFAULT '0',
  `d12` int(11) NOT NULL DEFAULT '0',
  `d13` int(11) NOT NULL DEFAULT '0',
  `d14` int(11) NOT NULL DEFAULT '0',
  `d15` int(11) NOT NULL DEFAULT '0',
  `d16` int(11) NOT NULL DEFAULT '0',
  `d17` int(11) NOT NULL DEFAULT '0',
  `d18` int(11) NOT NULL DEFAULT '0',
  `d19` int(11) NOT NULL DEFAULT '0',
  `e0` int(11) NOT NULL DEFAULT '0',
  `e1` int(11) NOT NULL DEFAULT '0',
  `e2` int(11) NOT NULL DEFAULT '0',
  `e3` int(11) NOT NULL DEFAULT '0',
  `e4` int(11) NOT NULL DEFAULT '0',
  `e5` int(11) NOT NULL DEFAULT '0',
  `e6` int(11) NOT NULL DEFAULT '0',
  `e7` int(11) NOT NULL DEFAULT '0',
  `e8` int(11) NOT NULL DEFAULT '0',
  `e9` int(11) NOT NULL DEFAULT '0',
  `e10` int(11) NOT NULL DEFAULT '0',
  `e11` int(11) NOT NULL DEFAULT '0',
  `e12` int(11) NOT NULL DEFAULT '0',
  `e13` int(11) NOT NULL DEFAULT '0',
  `e14` int(11) NOT NULL DEFAULT '0',
  `e15` int(11) NOT NULL DEFAULT '0',
  `e16` int(11) NOT NULL DEFAULT '0',
  `e17` int(11) NOT NULL DEFAULT '0',
  `e18` int(11) NOT NULL DEFAULT '0',
  `e19` int(11) NOT NULL DEFAULT '0',
  `f0` int(11) NOT NULL DEFAULT '0',
  `f1` int(11) NOT NULL DEFAULT '0',
  `f2` int(11) NOT NULL DEFAULT '0',
  `f3` int(11) NOT NULL DEFAULT '0',
  `f4` int(11) NOT NULL DEFAULT '0',
  `f5` int(11) NOT NULL DEFAULT '0',
  `f6` int(11) NOT NULL DEFAULT '0',
  `f7` int(11) NOT NULL DEFAULT '0',
  `f8` int(11) NOT NULL DEFAULT '0',
  `f9` int(11) NOT NULL DEFAULT '0',
  `f10` int(11) NOT NULL DEFAULT '0',
  `f11` int(11) NOT NULL DEFAULT '0',
  `f12` int(11) NOT NULL DEFAULT '0',
  `f13` int(11) NOT NULL DEFAULT '0',
  `f14` int(11) NOT NULL DEFAULT '0',
  `f15` int(11) NOT NULL DEFAULT '0',
  `f16` int(11) NOT NULL DEFAULT '0',
  `f17` int(11) NOT NULL DEFAULT '0',
  `f18` int(11) NOT NULL DEFAULT '0',
  `f19` int(11) NOT NULL DEFAULT '0',
  `g0` int(11) NOT NULL DEFAULT '0',
  `g1` int(11) NOT NULL DEFAULT '0',
  `g2` int(11) NOT NULL DEFAULT '0',
  `g3` int(11) NOT NULL DEFAULT '0',
  `g4` int(11) NOT NULL DEFAULT '0',
  `g5` int(11) NOT NULL DEFAULT '0',
  `g6` int(11) NOT NULL DEFAULT '0',
  `g7` int(11) NOT NULL DEFAULT '0',
  `g8` int(11) NOT NULL DEFAULT '0',
  `g9` int(11) NOT NULL DEFAULT '0',
  `g10` int(11) NOT NULL DEFAULT '0',
  `g11` int(11) NOT NULL DEFAULT '0',
  `g12` int(11) NOT NULL DEFAULT '0',
  `g13` int(11) NOT NULL DEFAULT '0',
  `g14` int(11) NOT NULL DEFAULT '0',
  `g15` int(11) NOT NULL DEFAULT '0',
  `g16` int(11) NOT NULL DEFAULT '0',
  `g17` int(11) NOT NULL DEFAULT '0',
  `g18` int(11) NOT NULL DEFAULT '0',
  `g19` int(11) NOT NULL DEFAULT '0',
  `h0` int(11) NOT NULL DEFAULT '0',
  `h1` int(11) NOT NULL DEFAULT '0',
  `h2` int(11) NOT NULL DEFAULT '0',
  `h3` int(11) NOT NULL DEFAULT '0',
  `h4` int(11) NOT NULL DEFAULT '0',
  `h5` int(11) NOT NULL DEFAULT '0',
  `h6` int(11) NOT NULL DEFAULT '0',
  `h7` int(11) NOT NULL DEFAULT '0',
  `h8` int(11) NOT NULL DEFAULT '0',
  `h9` int(11) NOT NULL DEFAULT '0',
  `h10` int(11) NOT NULL DEFAULT '0',
  `h11` int(11) NOT NULL DEFAULT '0',
  `h12` int(11) NOT NULL DEFAULT '0',
  `h13` int(11) NOT NULL DEFAULT '0',
  `h14` int(11) NOT NULL DEFAULT '0',
  `h15` int(11) NOT NULL DEFAULT '0',
  `h16` int(11) NOT NULL DEFAULT '0',
  `h17` int(11) NOT NULL DEFAULT '0',
  `h18` int(11) NOT NULL DEFAULT '0',
  `h19` int(11) NOT NULL DEFAULT '0',
  `i0` int(11) NOT NULL DEFAULT '0',
  `i1` int(11) NOT NULL DEFAULT '0',
  `i2` int(11) NOT NULL DEFAULT '0',
  `i3` int(11) NOT NULL DEFAULT '0',
  `i4` int(11) NOT NULL DEFAULT '0',
  `i5` int(11) NOT NULL DEFAULT '0',
  `i6` int(11) NOT NULL DEFAULT '0',
  `i7` int(11) NOT NULL DEFAULT '0',
  `i8` int(11) NOT NULL DEFAULT '0',
  `i9` int(11) NOT NULL DEFAULT '0',
  `i10` int(11) NOT NULL DEFAULT '0',
  `i11` int(11) NOT NULL DEFAULT '0',
  `i12` int(11) NOT NULL DEFAULT '0',
  `i13` int(11) NOT NULL DEFAULT '0',
  `i14` int(11) NOT NULL DEFAULT '0',
  `i15` int(11) NOT NULL DEFAULT '0',
  `i16` int(11) NOT NULL DEFAULT '0',
  `i17` int(11) NOT NULL DEFAULT '0',
  `i18` int(11) NOT NULL DEFAULT '0',
  `i19` int(11) NOT NULL DEFAULT '0',
  `j0` int(11) NOT NULL DEFAULT '0',
  `j1` int(11) NOT NULL DEFAULT '0',
  `j2` int(11) NOT NULL DEFAULT '0',
  `j3` int(11) NOT NULL DEFAULT '0',
  `j4` int(11) NOT NULL DEFAULT '0',
  `j5` int(11) NOT NULL DEFAULT '0',
  `j6` int(11) NOT NULL DEFAULT '0',
  `j7` int(11) NOT NULL DEFAULT '0',
  `j8` int(11) NOT NULL DEFAULT '0',
  `j9` int(11) NOT NULL DEFAULT '0',
  `j10` int(11) NOT NULL DEFAULT '0',
  `j11` int(11) NOT NULL DEFAULT '0',
  `j12` int(11) NOT NULL DEFAULT '0',
  `j13` int(11) NOT NULL DEFAULT '0',
  `j14` int(11) NOT NULL DEFAULT '0',
  `j15` int(11) NOT NULL DEFAULT '0',
  `j16` int(11) NOT NULL DEFAULT '0',
  `j17` int(11) NOT NULL DEFAULT '0',
  `j18` int(11) NOT NULL DEFAULT '0',
  `j19` int(11) NOT NULL DEFAULT '0',
  `k0` int(11) NOT NULL DEFAULT '0',
  `k1` int(11) NOT NULL DEFAULT '0',
  `k2` int(11) NOT NULL DEFAULT '0',
  `k3` int(11) NOT NULL DEFAULT '0',
  `k4` int(11) NOT NULL DEFAULT '0',
  `k5` int(11) NOT NULL DEFAULT '0',
  `k6` int(11) NOT NULL DEFAULT '0',
  `k7` int(11) NOT NULL DEFAULT '0',
  `k8` int(11) NOT NULL DEFAULT '0',
  `k9` int(11) NOT NULL DEFAULT '0',
  `k10` int(11) NOT NULL DEFAULT '0',
  `k11` int(11) NOT NULL DEFAULT '0',
  `k12` int(11) NOT NULL DEFAULT '0',
  `k13` int(11) NOT NULL DEFAULT '0',
  `k14` int(11) NOT NULL DEFAULT '0',
  `k15` int(11) NOT NULL DEFAULT '0',
  `k16` int(11) NOT NULL DEFAULT '0',
  `k17` int(11) NOT NULL DEFAULT '0',
  `k18` int(11) NOT NULL DEFAULT '0',
  `k19` int(11) NOT NULL DEFAULT '0',
  `l0` int(11) NOT NULL DEFAULT '0',
  `l1` int(11) NOT NULL DEFAULT '0',
  `l2` int(11) NOT NULL DEFAULT '0',
  `l3` int(11) NOT NULL DEFAULT '0',
  `l4` int(11) NOT NULL DEFAULT '0',
  `l5` int(11) NOT NULL DEFAULT '0',
  `l6` int(11) NOT NULL DEFAULT '0',
  `l7` int(11) NOT NULL DEFAULT '0',
  `l8` int(11) NOT NULL DEFAULT '0',
  `l9` int(11) NOT NULL DEFAULT '0',
  `l10` int(11) NOT NULL DEFAULT '0',
  `l11` int(11) NOT NULL DEFAULT '0',
  `l12` int(11) NOT NULL DEFAULT '0',
  `l13` int(11) NOT NULL DEFAULT '0',
  `l14` int(11) NOT NULL DEFAULT '0',
  `l15` int(11) NOT NULL DEFAULT '0',
  `l16` int(11) NOT NULL DEFAULT '0',
  `l17` int(11) NOT NULL DEFAULT '0',
  `l18` int(11) NOT NULL DEFAULT '0',
  `l19` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_merchant`
--

DROP TABLE IF EXISTS `lol_merchant`;
CREATE TABLE IF NOT EXISTS `lol_merchant` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mid` bigint(20) NOT NULL DEFAULT '0',
  `recipient` int(11) NOT NULL,
  `timer` int(11) NOT NULL DEFAULT '0',
  `a0` bigint(20) NOT NULL DEFAULT '0',
  `a1` bigint(20) NOT NULL DEFAULT '0',
  `a2` bigint(20) NOT NULL DEFAULT '0',
  `a3` bigint(20) NOT NULL DEFAULT '0',
  `a4` bigint(20) NOT NULL DEFAULT '0',
  `a5` bigint(20) NOT NULL DEFAULT '0',
  `a6` bigint(20) NOT NULL DEFAULT '0',
  `a7` bigint(20) NOT NULL DEFAULT '0',
  `a8` bigint(20) NOT NULL DEFAULT '0',
  `a9` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_messages`
--

DROP TABLE IF EXISTS `lol_messages`;
CREATE TABLE IF NOT EXISTS `lol_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL DEFAULT '0',
  `mid` bigint(20) NOT NULL DEFAULT '0',
  `rid` bigint(20) NOT NULL DEFAULT '0',
  `body` text NOT NULL,
  `importance` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `dater` varchar(32) NOT NULL DEFAULT '',
  `delay_timer` int(11) NOT NULL DEFAULT '0',
  `timer` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17307 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_trade`
--

DROP TABLE IF EXISTS `lol_trade`;
CREATE TABLE IF NOT EXISTS `lol_trade` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mid` bigint(20) NOT NULL DEFAULT '0',
  `rid` bigint(20) NOT NULL DEFAULT '0',
  `timer` int(11) NOT NULL DEFAULT '0',
  `oamo` bigint(20) NOT NULL DEFAULT '0',
  `ores` bigint(20) NOT NULL DEFAULT '0',
  `samo` bigint(20) NOT NULL DEFAULT '0',
  `sres` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lol_war`
--

DROP TABLE IF EXISTS `lol_war`;
CREATE TABLE IF NOT EXISTS `lol_war` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mid` bigint(20) NOT NULL DEFAULT '0',
  `rid` bigint(20) NOT NULL DEFAULT '0',
  `wid` bigint(20) NOT NULL DEFAULT '0',
  `mission` bigint(20) NOT NULL DEFAULT '0',
  `timer` int(11) NOT NULL DEFAULT '0',
  `mtimer` int(11) NOT NULL DEFAULT '0',
  `k0` int(11) NOT NULL DEFAULT '0',
  `k1` int(11) NOT NULL DEFAULT '0',
  `k2` int(11) NOT NULL DEFAULT '0',
  `k3` int(11) NOT NULL DEFAULT '0',
  `k4` int(11) NOT NULL DEFAULT '0',
  `k5` int(11) NOT NULL DEFAULT '0',
  `k6` int(11) NOT NULL DEFAULT '0',
  `k7` int(11) NOT NULL DEFAULT '0',
  `k8` int(11) NOT NULL DEFAULT '0',
  `k9` int(11) NOT NULL DEFAULT '0',
  `k10` int(11) NOT NULL DEFAULT '0',
  `k11` int(11) NOT NULL DEFAULT '0',
  `k12` int(11) NOT NULL DEFAULT '0',
  `k13` int(11) NOT NULL DEFAULT '0',
  `k14` int(11) NOT NULL DEFAULT '0',
  `k15` int(11) NOT NULL DEFAULT '0',
  `k16` int(11) NOT NULL DEFAULT '0',
  `k17` int(11) NOT NULL DEFAULT '0',
  `k18` int(11) NOT NULL DEFAULT '0',
  `k19` int(11) NOT NULL DEFAULT '0',
  `d0` int(11) NOT NULL DEFAULT '0',
  `d1` int(11) NOT NULL DEFAULT '0',
  `d2` int(11) NOT NULL DEFAULT '0',
  `d3` int(11) NOT NULL DEFAULT '0',
  `d4` int(11) NOT NULL DEFAULT '0',
  `d5` int(11) NOT NULL DEFAULT '0',
  `d6` int(11) NOT NULL DEFAULT '0',
  `d7` int(11) NOT NULL DEFAULT '0',
  `d8` int(11) NOT NULL DEFAULT '0',
  `d9` int(11) NOT NULL DEFAULT '0',
  `d10` int(11) NOT NULL DEFAULT '0',
  `d11` int(11) NOT NULL DEFAULT '0',
  `d12` int(11) NOT NULL DEFAULT '0',
  `d13` int(11) NOT NULL DEFAULT '0',
  `d14` int(11) NOT NULL DEFAULT '0',
  `d15` int(11) NOT NULL DEFAULT '0',
  `d16` int(11) NOT NULL DEFAULT '0',
  `d17` int(11) NOT NULL DEFAULT '0',
  `d18` int(11) NOT NULL DEFAULT '0',
  `d19` int(11) NOT NULL DEFAULT '0',
  `a0` bigint(20) NOT NULL DEFAULT '0',
  `a1` bigint(20) NOT NULL DEFAULT '0',
  `a2` bigint(20) NOT NULL DEFAULT '0',
  `a3` bigint(20) NOT NULL DEFAULT '0',
  `a4` bigint(20) NOT NULL DEFAULT '0',
  `a5` bigint(20) NOT NULL DEFAULT '0',
  `a6` bigint(20) NOT NULL DEFAULT '0',
  `a7` bigint(20) NOT NULL DEFAULT '0',
  `a8` bigint(20) NOT NULL DEFAULT '0',
  `a9` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1102 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
