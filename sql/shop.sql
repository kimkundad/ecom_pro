-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2012 at 10:09 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE IF NOT EXISTS `bank` (
  `id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `account_number` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `account_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `branch` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bank`
--


-- --------------------------------------------------------

--
-- โครงสร้างตาราง `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `insert_date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- dump ตาราง `category`
--

INSERT INTO `category` (`id`, `name`, `insert_date`, `last_update`) VALUES
(0, 'ไม่มีหมวดหมู่', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `decoration`
--

CREATE TABLE IF NOT EXISTS `decoration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `favicon` text COLLATE utf8_unicode_ci NOT NULL,
  `logo` text COLLATE utf8_unicode_ci NOT NULL,
  `header` text COLLATE utf8_unicode_ci NOT NULL,
  `background_image` text COLLATE utf8_unicode_ci NOT NULL,
  `background_color` text COLLATE utf8_unicode_ci NOT NULL,
  `repeat` text COLLATE utf8_unicode_ci NOT NULL,
  `attachment` text COLLATE utf8_unicode_ci NOT NULL,
  `horizontal_position` text COLLATE utf8_unicode_ci NOT NULL,
  `vertical_position` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- dump ตาราง `decoration`
--

INSERT INTO `decoration` (`id`, `favicon`, `logo`, `header`, `background_image`, `background_color`, `repeat`, `attachment`, `horizontal_position`, `vertical_position`) VALUES
(1, '1348035367-basket.png', '1350549350-nuningshop.png', '', '', '#efefef', 'repeat', 'fixed', 'center', 'top');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `insert_date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- dump ตาราง `image`
--


-- --------------------------------------------------------

--
-- โครงสร้างตาราง `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `fullname` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` int(5) NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `tel` text COLLATE utf8_unicode_ci NOT NULL,
  `total` float NOT NULL,
  `shipping_option` text COLLATE utf8_unicode_ci NOT NULL,
  `shipping_price` float NOT NULL,
  `status` text COLLATE utf8_unicode_ci NOT NULL,
  `ems` text COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `insert_date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- dump ตาราง `order`
--


-- --------------------------------------------------------

--
-- โครงสร้างตาราง `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_image` text COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` text COLLATE utf8_unicode_ci NOT NULL,
  `option_name` text COLLATE utf8_unicode_ci NOT NULL,
  `product_price` float NOT NULL,
  `amount` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- dump ตาราง `order_detail`
--


-- --------------------------------------------------------

--
-- โครงสร้างตาราง `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` text COLLATE utf8_unicode_ci NOT NULL,
  `fullname` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `tel` text COLLATE utf8_unicode_ci NOT NULL,
  `money` float NOT NULL,
  `bank` text COLLATE utf8_unicode_ci NOT NULL,
  `payment_date` datetime NOT NULL,
  `status` text COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `insert_date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- dump ตาราง `payment`
--


-- --------------------------------------------------------

--
-- โครงสร้างตาราง `plus`
--

CREATE TABLE IF NOT EXISTS `plus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `html_1` text COLLATE utf8_unicode_ci NOT NULL,
  `html_2` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- dump ตาราง `plus`
--

INSERT INTO `plus` (`id`, `html_1`, `html_2`) VALUES
(1, '<div style="text-align: center; ">\r\n	แก้ไขเนื้อหาภายในนี้ได้ที่ระบบหลังร้าน</div>\r\n', 'html 2');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `normal_price` float NOT NULL,
  `discount` int(3) NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `status` text COLLATE utf8_unicode_ci NOT NULL,
  `keyword` text COLLATE utf8_unicode_ci NOT NULL,
  `view` int(11) NOT NULL,
  `insert_date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- dump ตาราง `product`
--


-- --------------------------------------------------------

--
-- โครงสร้างตาราง `product_image`
--

CREATE TABLE IF NOT EXISTS `product_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `insert_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- dump ตาราง `product_image`
--


-- --------------------------------------------------------

--
-- โครงสร้างตาราง `product_option`
--

CREATE TABLE IF NOT EXISTS `product_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `insert_date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- dump ตาราง `product_option`
--


-- --------------------------------------------------------

--
-- โครงสร้างตาราง `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_name` text COLLATE utf8_unicode_ci NOT NULL,
  `website_name` text COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `keyword` text COLLATE utf8_unicode_ci NOT NULL,
  `google_analytics` text COLLATE utf8_unicode_ci NOT NULL,
  `author` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `tel` text COLLATE utf8_unicode_ci NOT NULL,
  `about_us` text COLLATE utf8_unicode_ci NOT NULL,
  `promotion` text COLLATE utf8_unicode_ci NOT NULL,
  `order` text COLLATE utf8_unicode_ci NOT NULL,
  `payment` text COLLATE utf8_unicode_ci NOT NULL,
  `contact_us` text COLLATE utf8_unicode_ci NOT NULL,
  `facebook_fanpage` text COLLATE utf8_unicode_ci NOT NULL,
  `stats_meta` text COLLATE utf8_unicode_ci NOT NULL,
  `stats_script` text COLLATE utf8_unicode_ci NOT NULL,
  `stats_display` text COLLATE utf8_unicode_ci NOT NULL,
  `news_subject_member` text COLLATE utf8_unicode_ci NOT NULL,
  `news_detail_member` text COLLATE utf8_unicode_ci NOT NULL,
  `news_subject_guest` text COLLATE utf8_unicode_ci NOT NULL,
  `news_detail_guest` text COLLATE utf8_unicode_ci NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- dump ตาราง `setting`
--

INSERT INTO `setting` (`id`, `shop_name`, `website_name`, `title`, `description`, `keyword`, `google_analytics`, `author`, `email`, `tel`, `about_us`, `promotion`, `order`, `payment`, `contact_us`, `facebook_fanpage`, `stats_meta`, `stats_script`, `stats_display`, `news_subject_member`, `news_detail_member`, `news_subject_guest`, `news_detail_guest`, `last_update`) VALUES
(1, 'Nuning Shop', 'http://localhost/s01_free', 'Nuning Shop ขายรองเท้าผ้าใบ รองเท้าผู้ชาย VANS', 'Description', 'สคริปร้านเสื้อผ้า, สคริปร้านค้าออนไลน์    ', '<meta name="stats-in-th" content="44af"/>                ', 'Nuningshop', 'nuningshop@gmail.com', '0846821081', 'เกี่ยวกับเรา ', 'โปรโมชั่น test', 'วิธีการสั่งซื้อ ', '<span style="font-size:14px;">แจ้งการชำระเงิน</span> ', 'ติดต่อเรา', 'http://www.facebook.com/pages/Nuning-Shop/217395585045407', '<meta name="stats-in-th" content="257f"/>', '<script type="text/javascript" language="javascript1.1" src="http://tracker.stats.in.th/tracker.php?sid=45678"></script><noscript></noscript>', 'block', 'ข่าวสารสมาชิก', 'ข่าวสารสมาชิก ', 'ข่าวสารสมาชิก', 'tedt', '2012-10-18 01:46:12');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `shipping`
--

CREATE TABLE IF NOT EXISTS `shipping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` text COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `insert_date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- dump ตาราง `shipping`
--

INSERT INTO `shipping` (`id`, `option`, `price`, `insert_date`, `last_update`) VALUES
(1, 'ค่าจัดส่งทางไปรษณีย์แบบลงทะเบียน (ฟรี)', 0, '2012-10-19 13:52:53', '2012-10-19 13:52:55');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `slideshow`
--

CREATE TABLE IF NOT EXISTS `slideshow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `insert_date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- dump ตาราง `slideshow`
--


-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `insert_date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- dump ตาราง `tag`
--


-- --------------------------------------------------------

--
-- โครงสร้างตาราง `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `insert_date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- dump ตาราง `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `insert_date`, `last_update`) VALUES
(1, 'admin', '1234', '2012-09-10 13:45:41', '2012-09-30 09:27:00');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `webboard_post`
--

CREATE TABLE IF NOT EXISTS `webboard_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` text COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `insert_date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- dump ตาราง `webboard_post`
--


-- --------------------------------------------------------

--
-- โครงสร้างตาราง `webboard_reply`
--

CREATE TABLE IF NOT EXISTS `webboard_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `insert_date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- dump ตาราง `webboard_reply`
--

