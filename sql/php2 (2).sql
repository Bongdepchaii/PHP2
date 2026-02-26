-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 25, 2026 lúc 02:46 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `php2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `id_user`, `id_product`, `quantity`, `created_at`) VALUES
(18, 8, 26, 9, '0000-00-00 00:00:00'),
(22, 5, 27, 12, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`) VALUES
(17, 'Máy ảnh', '0000-00-00 00:00:00'),
(18, 'Laptop', '2026-01-30 04:27:55'),
(19, 'Phụ kiện', '2026-01-30 04:35:49'),
(29, 'Điện thoại', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `name` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `color`
--

INSERT INTO `color` (`id`, `name`) VALUES
(10, 'Đen'),
(11, 'Trắng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`id`, `full_name`, `email`, `phone`, `subject`, `message`, `created_at`) VALUES
(1, 'BUI TRONG THANH', 'tvi14318@gmail.com', '12345678', 'Đổi trả & Hoàn tiền', 'Test (demo)', '2026-02-22 13:37:43'),
(2, 'Trương Thị My Ly', 'truongmly06@gmail.com', '01242141241', 'Sản phẩm', 'Sản phẩm này có okee khonggg', '2026-02-22 13:58:37'),
(3, 'Trương Thị My Ly', 'thanhbtps@gmail.com', '01242141241', 'Tài khoản', 'Chuyển cho anh 1 củ mốt 3 mưi', '2026-02-22 14:03:22'),
(4, 'Trương Thị My Ly', 'truongmly06@gmail.com', '01242141241', 'Khác', 'Trả tìn', '2026-02-22 14:12:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `favorite`
--

INSERT INTO `favorite` (`id`, `id_product`, `id_user`, `created_at`) VALUES
(9, 25, 5, '2026-02-22 12:49:47'),
(10, 26, 6, '2026-02-22 14:12:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_voucher` varchar(50) DEFAULT NULL,
  `subtotal` int(11) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL,
  `receiver` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `note` text DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `id_user`, `id_voucher`, `subtotal`, `discount`, `total`, `receiver`, `phone`, `address`, `note`, `status`, `created_at`) VALUES
(1, 6, 'SALETET', 51328428, 20531371, 30797057, 'BUI TRONG THANH', '12345678', 'Công ty MMO Buôn ma thuật city', 'Đừng để hàng rơi vỡ', 'cancelled', '2026-02-22 09:13:27'),
(2, 6, NULL, 24214214, 0, 24214214, 'BUI TRONG THANH', '12345678', 'Công ty MMO Buôn ma thuật city', 'Phải ngon bổ rẻ', 'done', '2026-02-22 09:41:26'),
(3, 5, NULL, 39787000, 0, 39787000, 'BUI TRONG THANH', '12345678', 'Buon Trap Eahdinh', 'Hàng dễ vỡ', 'confirmed', '2026-02-24 08:42:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `id_order`, `id_product`, `product_name`, `price`, `quantity`) VALUES
(1, 1, 22, 'Bộ dán Full Innostyle MacBook Pro 14 inch 2021/2023/2024', 24214214, 2),
(2, 1, 21, 'MacBook Pro 2021 14 inch Apple M1 PRO 10-Core CPU 16-Core GPU 16GB RAM 512GB SSD – 98%', 2900000, 1),
(3, 2, 22, 'Bộ dán Full Innostyle MacBook Pro 14 inch 2021/2023/2024', 24214214, 1),
(4, 3, 25, 'iPhone 13 pro', 19800000, 2),
(5, 3, 27, 'Sạc anker', 98000, 1),
(6, 3, 26, 'Sạc 30W', 89000, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `img` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `img`, `created_at`) VALUES
(2, 'Fujifilm X Half White Edition Chính Thức Ra Mắt', '<p>Fujifilm vừa chính thức ra mắt phiên bản <strong>X Half White Edition</strong> tại một số thị trường quốc tế, bổ sung thêm lựa chọn màu sắc mới cho dòng máy ảnh Fujifilm X Half vốn đã gây nhiều chú ý ngay từ khi trình làng. Phiên bản màu trắng mang đến diện mạo thanh lịch, tối giản và hiện đại hơn, phù hợp với người dùng yêu thích phong cách tinh tế nhưng vẫn muốn giữ nét hoài cổ đặc trưng của Fujifilm.</p><p><img src=\"http://mayanh24h.com/upload/assets/2026/0110/ar/fujifilm-x-half-white-edition-chinh-thuc-ra-mat-2.jpg\" alt=\"Fujifilm vừa chính thức ra mắt phiên bản X Half White Edition tại một số thị trường quốc tế\" width=\"700\" height=\"701\"></p><p><i>Fujifilm vừa chính thức ra mắt phiên bản <strong>X Half White Edition</strong> tại một số thị trường quốc tế</i></p><h2><strong>Thiết kế màu trắng mới, giữ nguyên tinh thần X Half</strong></h2><p>Ở phiên bản White Edition, Fujifilm X Half được hoàn thiện với tông trắng chủ đạo kết hợp các chi tiết tối màu, tạo nên sự tương phản nhẹ nhàng nhưng vẫn nổi bật khi cầm trên tay. Tổng thể thiết kế vẫn giữ nguyên phong cách nhỏ gọn, đậm chất retro, lấy cảm hứng từ các máy ảnh half-frame cổ điển, hướng đến trải nghiệm chụp ảnh chậm rãi, giàu cảm xúc thay vì chạy theo thông số thuần kỹ thuật.</p><p><img src=\"http://mayanh24h.com/upload/assets/2026/0110/ar/fujifilm-x-half-white-edition-chinh-thuc-ra-mat-3.jpg\" alt=\"Ở phiên bản White Edition, Fujifilm X Half được hoàn thiện với tông trắng chủ đạo kết hợp các chi tiết tối màu\" width=\"700\" height=\"700\"></p><p><i>Ở phiên bản White Edition, Fujifilm X Half được hoàn thiện với tông trắng chủ đạo kết hợp các chi tiết tối màu</i></p><h2><strong>Fujifilm X Half – máy ảnh half-frame kỹ thuật số độc đáo</strong></h2><p>Fujifilm X Half là mẫu máy ảnh kỹ thuật số mang triết lý half-frame hiếm gặp trên thị trường hiện nay, cho phép người dùng ghi lại hai khung hình theo chiều dọc trên cùng một khung hình hoàn chỉnh, tạo nên cách kể chuyện bằng hình ảnh rất riêng. Dòng máy này hướng tới người dùng yêu thích nhiếp ảnh đời thường, sáng tạo nội dung mang tính cá nhân, đồng thời tái hiện lại tinh thần chụp phim cổ điển trong một thân máy kỹ thuật số hiện đại và dễ tiếp cận.</p><p><img src=\"http://mayanh24h.com/upload/assets/2026/0110/ar/fujifilm-x-half-white-edition-chinh-thuc-ra-mat-7.jpg\" alt=\"Fujifilm X Half là mẫu máy ảnh kỹ thuật số mang triết lý half-frame hiếm gặp trên thị trường hiện nay\" width=\"700\" height=\"700\"></p><p><i>Fujifilm X Half là mẫu máy ảnh kỹ thuật số mang triết lý half-frame hiếm gặp trên thị trường hiện nay</i></p><h2><strong>Chưa rõ thời điểm phân phối tại các thị trường khác</strong></h2><p>Hiện tại, Fujifilm vẫn chưa công bố thông tin chính thức về việc <strong>X Half White Edition</strong> có được phân phối rộng rãi sang các thị trường khác hay không, cũng như thời gian mở bán cụ thể tại từng khu vực. Điều này khiến phiên bản màu trắng mới trở thành tâm điểm quan tâm của cộng đồng yêu Fujifilm, đặc biệt là những người đang tìm kiếm một chiếc máy ảnh vừa mang tính thẩm mỹ cao vừa có trải nghiệm chụp ảnh khác biệt.</p>', '1768289074best-camera-for-entry-level-11.jpg', '2026-01-13 08:24:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `img` text NOT NULL,
  `mota` text NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_trademark` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `quantity`, `price`, `img`, `mota`, `id_category`, `id_trademark`, `id_color`, `created_at`) VALUES
(14, 'Sony A6300', 12, 1240000, '[\"1769752143_main_sony-alpha-a6300-black-500x500.jpg\",\"1769752143_gal_0_sony-alpha-a6300-black3-55x55.jpg\",\"1769752143_gal_1_sony-alpha-a6300-black6-55x55.jpg\",\"1769752143_gal_2_sony-alpha-a6300-black10-55x55.jpg\",\"1769752143_gal_3_sony-alpha-a6300-black-500x500.jpg\"]', 'Sony A6400 là máy ảnh mirrorless APS-C 24.2MP nhỏ gọn, nổi bật với hệ thống lấy nét siêu nhanh 0.02 giây, Real-time Eye AF và Tracking theo thời gian thực. Thiết kế màn hình lật 180 độ cùng khả năng quay video 4K/30p chất lượng cao khiến máy rất được ưa chuộng bởi vlogger, Youtuber và người chụp ảnh đa dụng.', 17, 20, 10, '0000-00-00 00:00:00'),
(15, 'Canon R50V', 144, 1298000, '[\"1769765186_main_may-sony-a7-mark-iii.jpg\",\"1769765186_gal_0_r50v-7.jpg\",\"1769765186_gal_1_r50v-8.jpg\",\"1769765186_gal_2_r50v-13.jpg\",\"1769765186_gal_3_r50v-14.jpg\"]', 'Canon EOS R50 V là chiếc máy ảnh mirrorless nhỏ gọn, linh hoạt dành cho nhà sáng tạo nội dung. Máy ảnh hỗ trợ quay UHD 4K 60p, lấy nét Dual Pixel CMOS AF II ...', 17, 20, 10, '0000-00-00 00:00:00'),
(17, 'Fujifilm X half', 12, 41910019, '[\"1769765762_main_fujifilm-x-half-15.jpg\",\"1769765762_gal_0_fujifilm-x-half-15.jpg\",\"1769765762_gal_1_fujifilm-x-half-16.jpg\",\"1769765762_gal_2_fujifilm-x-half-17.jpg\",\"1769765762_gal_3_fujifilm-x-half-18.jpg\"]', 'Fujifilm X half', 17, 20, 11, '2026-01-30 10:36:02'),
(21, 'MacBook Pro 2021 14 inch Apple M1 PRO 10-Core CPU 16-Core GPU 16GB RAM 512GB SSD – 98%', 12, 2900000, '[\"1771729539_main_macbook-pro-14-inch-2021-silver.png\",\"1771729539_gal_0_airm1.webp\",\"1771729539_gal_1_dell Inspiron.webp\",\"1771729539_gal_2_macbook_pro_13_inch_intel_m1.jpg\",\"1771729539_gal_3_macbook-pro-14-inch-2021-gray.png\",\"1771729539_gal_4_macbook-pro-14-inch-2021-silver.png\"]', '14.2-inch (diagonal) Liquid Retina XDR display; 3024-by-1964 native resolution at 254 pixels per inch, 1 billion colors, ProMotion technology for adaptive refresh rates up to 120Hz.', 18, 24, 10, '2026-02-22 04:05:39'),
(22, 'Bộ dán Full Innostyle MacBook Pro 14 inch 2021/2023/2024', 12, 24214214, '[\"1771729628_main_dan-macbook-pro-14inch-space-black.jpg\",\"1771729628_gal_0_dan-macbook-pro-13-inch-innostyle-5-in-1-2.webp\",\"1771729628_gal_1_dan-macbook-pro-13-inch-innostyle-5-in-1-3.jpeg\",\"1771729628_gal_2_dan-macbook-pro-13-inch-innostyle-5-in-1-6.jpeg\",\"1771729628_gal_3_dan-macbook-pro-14inch-space-black.jpg\"]', 'Dán 3M mặt trên (top), mặt đáy (bottom), kê tay (Palm Guard), khung bàn phím (Keyboard frame), màn hình (Screen protector), di chuột (trackpad).', 18, 24, 10, '2026-02-22 04:07:08'),
(23, 'iPhone 5s', 12, 8900000, '[\"1771759382_main_54923-iphone-5s-32gb-quoc-te-den.jpg\",\"1771759382_gal_0_(600x600)_samsung_galaxy_a16_5g_trang_thumb_1.jpg\",\"1771759382_gal_1_54923-iphone-5s-32gb-quoc-te-den.jpg\"]', 'iPhone 5s', 29, 24, 10, '2026-02-22 12:23:02'),
(24, 'Samsung A50', 59, 4900000, '[\"1771760018_update_main_(600x600)_samsung_galaxy_a16_5g_trang_thumb_1.jpg\",\"1771760018_update_gal_0_(600x600)_samsung_galaxy_a16_5g_trang_thumb_1.jpg\"]', 'Samsung A50 Samsung A50 Samsung A50 Samsung A50', 29, 23, 11, '2026-02-22 12:23:39'),
(25, 'iPhone 13 pro', 142, 19800000, '[\"1771759517_main_xamssss.webp\",\"1771759517_gal_0_1_66_6_2_1_7.webp\",\"1771759517_gal_1_4_36_3_2_1_5.webp\",\"1771759517_gal_2_iphone-13-pro.webp\",\"1771759517_gal_3_xamssss.webp\"]', 'iPhone 13 pro của chúng tôi', 29, 24, 10, '2026-02-22 12:25:17'),
(26, 'Sạc 30W', 415, 89000, '[\"1771761605_main_Artboard_2_result.webp\",\"1771761605_gal_0_Artboard_2_result.webp\",\"1771761605_gal_1_images.jpg\"]', 'Củ sạc 30 W', 19, 23, 10, '2026-02-22 13:00:05'),
(27, 'Sạc anker', 12, 98000, '[\"1771761647_main_vn-11134208-7ras8-m2krtv9tjeeyc8.png\",\"1771761647_gal_0_vn-11134208-7ras8-m2krtv9tjeeyc8.png\"]', 'Sạc anker trắng', 19, 23, 11, '2026-02-22 13:00:47'),
(28, 'Xiao mi 17 pro maxx', 329, 12984200, '[\"1771761715_main_xiaomi-17-pro-max-trang.jpg\",\"1771761715_gal_0_xiaomi-17-pro-max-den.jpg\",\"1771761715_gal_1_xiaomi-17-pro-max-tim.jpg\",\"1771761715_gal_2_xiaomi-17-pro-max-trang.jpg\",\"1771761715_gal_3_xiaomi-17-pro-max-xanh-la.jpg\"]', 'Xiao mi 17 pro maxx 256gb', 29, 21, 11, '2026-02-22 13:01:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student`
--

CREATE TABLE `student` (
  `id` int(12) NOT NULL,
  `name` varchar(40) NOT NULL,
  `point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `student`
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
-- Cấu trúc bảng cho bảng `trademark`
--

CREATE TABLE `trademark` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `img` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `trademark`
--

INSERT INTO `trademark` (`id`, `name`, `img`, `created_at`) VALUES
(19, 'ASUS', '1769701053_images.png', '2026-01-29 16:37:33'),
(20, 'Canon', '1769701072_canon-logo-png_seeklogo-25733.png', '2026-01-29 16:37:52'),
(21, 'Sony', '1769701082_sony-logo-png_seeklogo-129420.png', '2026-01-29 16:38:02'),
(23, 'Panasonic', '1769765074_images.png', '2026-01-30 10:24:34'),
(24, 'Apple', '1771729505_5e3a8f27bcadf212785013.png', '2026-02-22 04:05:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
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
  `otp` int(11) NOT NULL,
  `end_otp` time NOT NULL,
  `role` varchar(12) NOT NULL,
  `google_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `name`, `sex`, `age`, `address`, `created_at`, `otp`, `end_otp`, `role`, `google_id`) VALUES
(2, 'yen', 'yen@1234', 'ptcy@gmail.com', 'Phạm Thị Cẩm Yến', 'Nữ', 18, 'Lào', '2026-01-30 04:57:23', 0, '00:00:00', 'user', NULL),
(3, 'huyen', '$2y$10$d7uSNsHM98T93QXzZlagA.xsDT7xKsaFmmC00U36jefqplMPpwyRC', 'nttt@gmail.com', 'Nguyễn Thị Thu Trang', 'Nữ', 18, 'Thái Lan', '2026-02-22 04:36:34', 0, '00:00:00', 'user', NULL),
(4, 'Bet06', 'admin@1234', 'truongmly06@gmail.com', 'Admin', '', 18, 'Campuchia', '2026-02-22 14:02:25', 479083, '17:18:47', 'admin', NULL),
(5, '05_thanh', '$2y$10$IPRFg1XjUfV618zYth81we0JpbwUfGxHITmuZ9eqqpvub/.VP7gnq', 'tvi14318@gmail.com', 'Ha Thi Tuyen', 'Male', 40, 'Buon Ma Thuat city', '2026-02-20 07:06:08', 0, '00:00:00', 'admin', NULL),
(6, '05_thanh', '$2y$10$ZbR.FPBscnc3AcAKRzq7Qe1dMxgkLZCEzDbQUkgEJWJ9rd8nrwirS', 'bongdepchaii@gmail.com', 'Thành Bùi', '', 20, '', '2026-02-22 14:44:45', 604190, '07:09:02', 'user', NULL),
(7, 'abcabc', '$2y$10$FEG8TjMePx7OBYc19JsHrOmTTas2/Rv5gz8hexCYcHgvOdSNLUKdC', 'abcd@gmail.com', 'Thanh Bui bong', 'Other', 0, '', '2026-01-30 10:47:31', 0, '00:00:00', 'user', NULL),
(8, 'buitrongthanh2k5@gmail.com', '', 'buitrongthanh2k5@gmail.com', 'Bùi Thành', 'Nam', 0, '', '2026-02-22 14:46:44', 0, '00:00:00', 'admin', '104701144669158178211');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL DEFAULT 'Nhà riêng',
  `receiver` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `label`, `receiver`, `phone`, `address`, `is_default`, `created_at`) VALUES
(1, 6, 'Nhà riêng', 'Bùi Trọng Thành', '0976844023', 'Buôn Trấp Xã Eahdinh CuwMgarr Đắk Lắk', 0, '2026-02-22 08:43:15'),
(2, 6, 'Văn phòng', 'BUI TRONG THANH', '12345678', 'Công ty MMO Buôn ma thuật city', 0, '2026-02-22 08:43:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voucher`
--

CREATE TABLE `voucher` (
  `id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `quanity` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp(),
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `voucher`
--

INSERT INTO `voucher` (`id`, `name`, `value`, `quanity`, `status`, `created_at`, `end_date`) VALUES
('SALETET', 'GIảm giá tết 2026', 40, 3, 'active', '2026-02-20 07:29:53', '2026-02-25');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_user` (`id_user`),
  ADD KEY `fk_id_product` (`id_product`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_iduser` (`id_user`),
  ADD KEY `fk_idproduct` (`id_product`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_order` (`id_order`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_color` (`id_color`),
  ADD KEY `fk_id_category` (`id_category`),
  ADD KEY `fk_id_trademark` (`id_trademark`);

--
-- Chỉ mục cho bảng `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `trademark`
--
ALTER TABLE `trademark`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `student`
--
ALTER TABLE `student`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `trademark`
--
ALTER TABLE `trademark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_id_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `fk_idproduct` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `fk_iduser` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_id_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `fk_id_color` FOREIGN KEY (`id_color`) REFERENCES `color` (`id`),
  ADD CONSTRAINT `fk_id_trademark` FOREIGN KEY (`id_trademark`) REFERENCES `trademark` (`id`);

--
-- Các ràng buộc cho bảng `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
