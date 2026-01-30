-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2026 at 07:04 AM
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
-- Database: `php2`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`) VALUES
(17, 'Máy ảnh', '2026-01-30 04:27:48'),
(18, 'Laptop', '2026-01-30 04:27:55'),
(19, 'Phụ kiện', '2026-01-30 04:35:49'),
(20, 'PC', '2026-01-30 04:36:34');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `name` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `name`) VALUES
(10, 'Đen'),
(11, 'Trắng');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `img` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `img`, `created_at`) VALUES
(2, 'Fujifilm X Half White Edition Chính Thức Ra Mắt', '<p>Fujifilm vừa chính thức ra mắt phiên bản <strong>X Half White Edition</strong> tại một số thị trường quốc tế, bổ sung thêm lựa chọn màu sắc mới cho dòng máy ảnh Fujifilm X Half vốn đã gây nhiều chú ý ngay từ khi trình làng. Phiên bản màu trắng mang đến diện mạo thanh lịch, tối giản và hiện đại hơn, phù hợp với người dùng yêu thích phong cách tinh tế nhưng vẫn muốn giữ nét hoài cổ đặc trưng của Fujifilm.</p><p><img src=\"http://mayanh24h.com/upload/assets/2026/0110/ar/fujifilm-x-half-white-edition-chinh-thuc-ra-mat-2.jpg\" alt=\"Fujifilm vừa chính thức ra mắt phiên bản X Half White Edition tại một số thị trường quốc tế\" width=\"700\" height=\"701\"></p><p><i>Fujifilm vừa chính thức ra mắt phiên bản <strong>X Half White Edition</strong> tại một số thị trường quốc tế</i></p><h2><strong>Thiết kế màu trắng mới, giữ nguyên tinh thần X Half</strong></h2><p>Ở phiên bản White Edition, Fujifilm X Half được hoàn thiện với tông trắng chủ đạo kết hợp các chi tiết tối màu, tạo nên sự tương phản nhẹ nhàng nhưng vẫn nổi bật khi cầm trên tay. Tổng thể thiết kế vẫn giữ nguyên phong cách nhỏ gọn, đậm chất retro, lấy cảm hứng từ các máy ảnh half-frame cổ điển, hướng đến trải nghiệm chụp ảnh chậm rãi, giàu cảm xúc thay vì chạy theo thông số thuần kỹ thuật.</p><p><img src=\"http://mayanh24h.com/upload/assets/2026/0110/ar/fujifilm-x-half-white-edition-chinh-thuc-ra-mat-3.jpg\" alt=\"Ở phiên bản White Edition, Fujifilm X Half được hoàn thiện với tông trắng chủ đạo kết hợp các chi tiết tối màu\" width=\"700\" height=\"700\"></p><p><i>Ở phiên bản White Edition, Fujifilm X Half được hoàn thiện với tông trắng chủ đạo kết hợp các chi tiết tối màu</i></p><h2><strong>Fujifilm X Half – máy ảnh half-frame kỹ thuật số độc đáo</strong></h2><p>Fujifilm X Half là mẫu máy ảnh kỹ thuật số mang triết lý half-frame hiếm gặp trên thị trường hiện nay, cho phép người dùng ghi lại hai khung hình theo chiều dọc trên cùng một khung hình hoàn chỉnh, tạo nên cách kể chuyện bằng hình ảnh rất riêng. Dòng máy này hướng tới người dùng yêu thích nhiếp ảnh đời thường, sáng tạo nội dung mang tính cá nhân, đồng thời tái hiện lại tinh thần chụp phim cổ điển trong một thân máy kỹ thuật số hiện đại và dễ tiếp cận.</p><p><img src=\"http://mayanh24h.com/upload/assets/2026/0110/ar/fujifilm-x-half-white-edition-chinh-thuc-ra-mat-7.jpg\" alt=\"Fujifilm X Half là mẫu máy ảnh kỹ thuật số mang triết lý half-frame hiếm gặp trên thị trường hiện nay\" width=\"700\" height=\"700\"></p><p><i>Fujifilm X Half là mẫu máy ảnh kỹ thuật số mang triết lý half-frame hiếm gặp trên thị trường hiện nay</i></p><h2><strong>Chưa rõ thời điểm phân phối tại các thị trường khác</strong></h2><p>Hiện tại, Fujifilm vẫn chưa công bố thông tin chính thức về việc <strong>X Half White Edition</strong> có được phân phối rộng rãi sang các thị trường khác hay không, cũng như thời gian mở bán cụ thể tại từng khu vực. Điều này khiến phiên bản màu trắng mới trở thành tâm điểm quan tâm của cộng đồng yêu Fujifilm, đặc biệt là những người đang tìm kiếm một chiếc máy ảnh vừa mang tính thẩm mỹ cao vừa có trải nghiệm chụp ảnh khác biệt.</p>', '1768289074best-camera-for-entry-level-11.jpg', '2026-01-13 08:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `img` text NOT NULL,
  `mota` text NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `quantity`, `price`, `img`, `mota`, `id_category`, `id_color`, `created_at`) VALUES
(14, 'Sony A6300', 12, 1240000, '[\"1769752143_main_sony-alpha-a6300-black-500x500.jpg\",\"1769752143_gal_0_sony-alpha-a6300-black3-55x55.jpg\",\"1769752143_gal_1_sony-alpha-a6300-black6-55x55.jpg\",\"1769752143_gal_2_sony-alpha-a6300-black10-55x55.jpg\",\"1769752143_gal_3_sony-alpha-a6300-black-500x500.jpg\"]', 'Sony A6400 là máy ảnh mirrorless APS-C 24.2MP nhỏ gọn, nổi bật với hệ thống lấy nét siêu nhanh 0.02 giây, Real-time Eye AF và Tracking theo thời gian thực. Thiết kế màn hình lật 180 độ cùng khả năng quay video 4K/30p chất lượng cao khiến máy rất được ưa chuộng bởi vlogger, Youtuber và người chụp ảnh đa dụng.', 17, 10, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(12) NOT NULL,
  `name` varchar(40) NOT NULL,
  `point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `point`) VALUES
(10, 'Bui Trong Thanh', 5),
(11, 'Nguyen Yen Trang', 6),
(12, 'Truong My Ly', 8),
(13, 'Tran Quang Khai', 3),
(14, 'Tran Ha Vy', 5),
(20, 'NGuyen van a', 5),
(21, 'Nguyen van b', 8);

-- --------------------------------------------------------

--
-- Table structure for table `trademark`
--

CREATE TABLE `trademark` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `img` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trademark`
--

INSERT INTO `trademark` (`id`, `name`, `img`, `created_at`) VALUES
(19, 'ASUS', '1769701053_images.png', '2026-01-29 16:37:33'),
(20, 'Canon', '1769701072_canon-logo-png_seeklogo-25733.png', '2026-01-29 16:37:52'),
(21, 'Sony', '1769701082_sony-logo-png_seeklogo-129420.png', '2026-01-29 16:38:02');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sex` varchar(12) NOT NULL,
  `age` int(3) NOT NULL,
  `address` text NOT NULL,
  `created_at` datetime NOT NULL,
  `role` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `name`, `sex`, `age`, `address`, `created_at`, `role`) VALUES
(2, 'yen', 'yen@1234', 'ptcy@gmail.com', 'Phạm Thị Cẩm Yến', 'Nữ', 18, 'Lào', '2026-01-30 04:57:23', 'user'),
(3, 'huyen', 'huyen@1234', 'nttt@gmail.com', 'Nguyễn Thị Thu Trang', 'Nữ', 18, 'Thái Lan', '2026-01-30 04:57:37', 'user'),
(4, 'admin', 'admin@1234', 'admin@gmail.com', 'Admin', '', 18, 'Campuchia', '2026-01-30 04:48:17', 'admin'),
(5, '05_thanh', '$2y$10$7eDY1w48Kn815uGGMiijYuyKrAkWjp6X58G2qiR1U/3HKHFI24NCG', 'tuyen2180@gmail.com', 'Ha Thi Tuyen', 'Nữ', 40, '', '2026-01-30 05:58:07', 'admin'),
(6, '05_thanh', '$2y$10$ZbR.FPBscnc3AcAKRzq7Qe1dMxgkLZCEzDbQUkgEJWJ9rd8nrwirS', 'abc@gmail.com', 'Thành Bùi', 'Nam', 20, '', '2026-01-30 05:57:59', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_color` (`id_color`),
  ADD KEY `fk_id_category` (`id_category`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trademark`
--
ALTER TABLE `trademark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `trademark`
--
ALTER TABLE `trademark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_id_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `fk_id_color` FOREIGN KEY (`id_color`) REFERENCES `color` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
