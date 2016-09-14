-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2016 at 09:18 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cs_business_areas`
--

DROP TABLE IF EXISTS `cs_business_areas`;
CREATE TABLE IF NOT EXISTS `cs_business_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_areas` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `create_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_ts` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cs_business_areas`
--

INSERT INTO `cs_business_areas` (`id`, `name_areas`, `image`, `description`, `status`, `create_ts`, `update_ts`) VALUES
(5, 'Mỹ phẩm', '/upload/images/businessArea/img_mypham1.jpg', '<p>Chuyên cung cấp hàng mỹ phẩm nhật ,hàn giá tốt nhất thị trường</p>', 0, '2016-05-04 10:13:36', '2016-05-04 17:13:36'),
(6, 'Nước hoa', '/upload/images/businessArea/img_chanel2.jpg', '<p>Chuyên cung cấp nước hoa xách tay của các nhãn hàng hàng đầu thế giới</p>', 0, '2016-05-04 10:30:24', '2016-05-04 17:30:24'),
(7, 'Đồ gia dụng', '/upload/images/businessArea/img_family.jpg', '<p>Chuyên cung cấp máy móc thiết bị gia dụng giá tốt.</p>', 0, '2016-05-04 10:30:59', '2016-05-04 17:30:59'),
(8, 'Điện thoại', '/upload/images/businessArea/img_dt.jpg', '<p>Luôn cập nhật những dòng điện thoại mới nhất trên thị trường</p>', 0, '2016-05-04 10:31:32', '2016-05-04 17:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `cs_products`
--

DROP TABLE IF EXISTS `cs_products`;
CREATE TABLE IF NOT EXISTS `cs_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_product` varchar(128) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `business_area` int(10) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `thumn_img` varchar(256) DEFAULT NULL,
  `description` text NOT NULL,
  `product_intro` text NOT NULL,
  `cur_price` int(20) DEFAULT NULL,
  `old_price` int(20) DEFAULT NULL,
  `discount_percent` varchar(16) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '0',
  `number_sale` int(10) NOT NULL DEFAULT '2',
  `create_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_ts` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cs_products`
--

INSERT INTO `cs_products` (`id`, `code_product`, `name`, `business_area`, `image`, `thumn_img`, `description`, `product_intro`, `cur_price`, `old_price`, `discount_percent`, `status`, `number_sale`, `create_ts`, `update_ts`) VALUES
(1, 'MP_001', 'Olay', 5, '/upload/images/products/mp_02.jpg', NULL, '<h4 align="LEFT"><strong><span lang="zxx">OLAY</span> <span lang="zxx">RG WRINKLE RELAXING CREAM</span></strong></h4><p> Sản phẩm giúp giảm nếp nhăn, vết chân chim, thâm nám, mang lại làn da mịn màng, tươi trẻ ngay sau khi thức dậy mỗi ngày</p><h3>Điểm nổi bật</h3><ul><li>Ngăn ngừa lão hóa dành cho ban đêm giúp thúc đẩy quá trình tái tạo</li><li>ngăn ngừa các dấu hiệu lão hóa da vào thời điểm da được phục hồi tối đa trong khi bạn ngủ</li><li>Bảo vệ máy khỏi va chạm, trầy xước đồng thời mang đến cho dế yêu vẻ ngoài đẹp</li></ul><p><br></p>', '<p><span lang="zxx">K</span><span lang="zxx">em ngăn ngừa lão hóa dành cho ban đêm giúp thúc đẩy quá trình tái tạo</span></p>', 75, 100, '25.00', 0, 2, '2016-05-04 13:23:58', '2016-05-04 20:23:58'),
(2, 'MP_002', 'Divine Eyes', 5, '/upload/images/products/mp_03.jpg', NULL, '<h4 align="LEFT"><strong>L’OCCITANE IMMORTELLE DIVINE EYES</strong></h4><p>Công thức từ kem mắt Divine Eyes</p><h3>Điểm nổi bật</h3><ul><li>Điều trị chính xác các dấu hiệu lão hóa vùng mắt.</li><li>Lấy lại vẻ tươi trẻ và khỏe khoắn cho&nbsp;mắt.</li></ul>', '<p>Chống lão hóa vùng mắt cực kì hiệu quả</p>', 45, 60, '25.00', 0, 2, '2016-05-04 14:02:19', '2016-05-04 21:02:19'),
(3, 'GD_001', 'Bình đun siêu tốc', 7, '/upload/images/products/gd_6.jpg', NULL, '<h3>Bình đun siêu tốc</h3><p>Bình đun siêu tốc là vật dụng quen thuộc với mọi gia đình, đặc biệt không thể thiếu trong những ngày lạnh. </p><h3>Điểm nổi bật</h3><ul><li>Nấu nước sôi chỉ trong vòng vài phút.</li><li>Gọn nhẹ và tiện dụng.</li></ul>', '<p>Bình đun siêu tốc là vật dụng quen thuộc với mọi gia đình</p>', 80, 100, '20.00', 0, 2, '2016-05-04 14:15:11', '2016-05-04 21:15:11'),
(4, 'NH_001', 'VIVA LA JUICY GOLD COUTURE EDP', 6, '/upload/images/products/202779419771.JPG', NULL, '<p><br></p><h3>VIVA LA JUICY GOLD COUTURE EDP 100ml (Nữ)</h3><p>Mùi Hương: Quyến rủ, Sang trọng, Rực rở...Giữ mùi cực lâu</p><p>Xuất Xứ: MỸ (Hàng Xách Tay)</p><p>CAM KẾT ĐÃM BẢO CHÍNH HÃNG 100%</p><p>Mùi Hương: Quyến rủ, Sang trọng, Rực rở...Giữ mùi cực lâu</p><p>Xuất Xứ: MỸ (Hàng Xách Tay)</p><p>CAM KẾT ĐÃM BẢO CHÍNH HÃNG 100%</p>', '<p>Quyến rủ, Sang trọng, Rực rở...Giữ mùi cực lâu</p>', 60, 80, '25.00', 0, 2, '2016-05-04 14:21:16', '2016-05-04 21:21:16'),
(5, 'GD_002', 'Nồi lẩu điện', 7, '/upload/images/products/gd_3.jpg', NULL, '<h3><a title="Nồi lẩu điện Happycook HCHP-300A 2.8 lít" href="https://www.dienmayxanh.com/lau-dien/happycook-hchp-300a" target="_blank" data-mce-href="https://www.dienmayxanh.com/lau-dien/happycook-hchp-300a">Nồi lẩu điện Happycook HCHP</a></h3><p>Lẩu là món ăn quen thuộc trong những buổi liên hoan, họp mặt và rất được ưa chuộng trong những ngày đông. </p><h3>Điểm nổi bật</h3><ul><li>Nồi lẩu điện có tính ứng dụng cao và trông rất lịch sự và sạch sẽ.</li><li>Có thể dùng để chiên, xào, rim, nấu canh rất tiện lợi.<br></li><li>Đẹp và tiện ích.</li></ul>', '<p>Nồi lẩu điện có tính ứng dụng cao và trông rất lịch sự và sạch sẽ.</p>', 25, 50, '50.00', 0, 2, '2016-05-04 14:29:09', '2016-05-04 21:29:09'),
(6, 'NH_002', 'Gucci Premiere', 6, '/upload/images/products/nh_02.jpg', NULL, '<h3>Nước hoa <strong>Gucci Premiere</strong></h3><p><strong>Gucci Premiere</strong> là dòng nước hoa được ra đời từ cảm hứng của bộ sưu tập<strong> Gucci Première</strong></p><h3>Điểm nổi bật</h3><ul><li>Mua 01 nước hoa Gucci Made to Measure&nbsp;50ml phần quà tặng sẽ là 01 Nước hoa Gucci Premiere 5ml.</li><li>Mang lại hương thơm quý phái cho bạn</li></ul>', '<p><strong>Gucci Premiere</strong> là dòng nước hoa được ra đời từ cảm hứng của bộ sưu tập<strong> Gucci Première</strong></p>', 70, 80, '12.50', 0, 2, '2016-05-04 14:35:36', '2016-05-04 21:35:36'),
(7, 'NH_003', 'Love Fury', 6, '/upload/images/products/Nine_West_Love_Fury_Bottle.jpg', NULL, '<h3>LOVE FURY</h3><p>Love Fury được tạo ra trong sự hợp tác với Inter Parfums Inc</p><h3>Điểm nổi bật</h3><ul><li>Hương thơm nồng nàng mở ra với Rose Bud FirNat , mai dương , quýt.</li><li>Nước hoa có màu hồng nhạt vô cùng dễ thương.</li><li>Đi kèm với sản phẩm có mùi thơm - 6 oz. kem dưỡng da. </li></ul>', '<p>Hương thơm ấn tượng với mùi hương sang trọng của đăng ten hoa, xạ hương, gỗ quý và hổ phách. </p>', 39, 52, '25.00', 0, 2, '2016-05-04 14:54:27', '2016-05-04 21:54:27'),
(8, 'DT_001', 'IPhone 6 16G Silver', 8, '/upload/images/products/dt_01.jpg', NULL, '<h1>IPhone 6 16G Silver (Quốc Tế , Mầu Trắng)</h1><p>Bảo hành 12 tháng - 1 đổi 1 trong vong 30 ngày.<br></p><h3>Điểm nổi bật</h3><ul><li>Sản Phẩm Chính Hãng. Hình Thức Đẹp.</li><li>Có thể dùng thử trong 5 ngày.<br></li><li>Tặng tai nghe ốp lưng cao cấp<br></li></ul>', '<p>Cam kết giá tốt nhất trên thị trường.</p>', 450, 500, '10.00', 0, 2, '2016-05-04 15:09:57', '2016-05-04 22:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'info', '4297f44b13955235245b2497399d7a93');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
