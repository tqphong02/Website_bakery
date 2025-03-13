-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 08, 2024 lúc 12:18 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `asm_php1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Bánh mochi', '2021-07-07 11:50:15', '2021-11-07 08:07:44'),
(2, 'Bánh donut', '2021-07-07 11:50:15', '2021-07-22 16:07:29'),
(3, 'Bánh tiramisu', '2021-07-07 11:50:15', '2021-07-22 16:12:25'),
(38, 'Bánh crepe', '2021-07-13 10:57:52', '2021-07-13 10:57:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(200) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `fullname`, `phone_number`, `email`, `address`, `note`, `order_date`) VALUES
(143, 'Khánh Như', '0387578520', 'KNxingdeps1tg@gmail.com', '68.65.120.213, viet nam', '', '2021-11-07 08:37:06'),
(144, 'DEMO', '03875723232', 'DEMO@gmail.com', 'DEMO', 'DEMO', '2021-11-07 08:42:16'),
(145, 'Tô Quốc Phong', '0932163500', 'phongnhihaha@gmail.com', 'haha', '', '2024-02-23 10:28:37'),
(146, 'Trần Thanh Hòa', '0903959879', 'phongnhihaha@gmail.com', 'hehe', '', '2024-02-27 12:15:08'),
(147, 'mamnhukhoua', '012345678', 'mamnhukhoua@gmail.com', 'mamnhukhoua', '', '2024-02-27 12:43:14'),
(148, 'mamnhukhoua', '012345648', 'mamnhukhoua@gmail.com', 'mamnhukhoua', '', '2024-02-27 12:58:40'),
(149, 'cá heo', '0939319493', 'caheo@gmail.com', 'thai binh duong', '', '2024-02-28 08:52:31'),
(150, 'Cao Đức Thanh', '0939319493', 'phongnhihaha@gmail.com', 'thai binh duong', '', '2024-02-28 09:55:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `id_user`, `quantity`, `price`, `status`) VALUES
(149, 143, 2, 7, 3, 35000, 'Đã hủy'),
(150, 143, 4, 7, 1, 25000, 'Đã hủy'),
(151, 143, 12, 7, 1, 30000, 'Đã hủy'),
(152, 143, 14, 7, 1, 35000, 'Đã hủy'),
(153, 144, 12, 8, 11, 30000, 'Đã nhận hàng'),
(154, 145, 2, 8, 1, 35000, 'Đã nhận hàng'),
(155, 146, 9, 57, 1, 25000, 'Đang chuẩn bị'),
(156, 147, 2, 57, 1, 35000, 'Đã nhận hàng'),
(157, 148, 2, 57, 2, 35000, 'Đã nhận hàng'),
(158, 149, 1, 57, 2, 25000, 'Đang chuẩn bị'),
(159, 149, 2, 57, 1, 35000, 'Đang chuẩn bị'),
(160, 150, 2, 57, 2, 35000, 'Đang chuẩn bị'),
(161, 150, 12, 57, 4, 30000, 'Đang chuẩn bị');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `thumbnail` varchar(500) NOT NULL,
  `content` longtext NOT NULL,
  `id_category` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `title`, `price`, `quantity`, `thumbnail`, `content`, `id_category`, `created_at`, `updated_at`) VALUES
(1, 'Donut socola', 15000, 20, 'uploads/OIP (5).jpg', '<p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; line-height: 44px; padding: 0px;\"><span style=\"color: rgb(0, 0, 0);\">Bánh donut có hương vị rất ngon và đặc trưng, hơn nữa còn xốp mềm, thơm mùi bơ sữa cực kì hấp dẫn</span><br></p>', 2, '2021-07-07 17:41:08', '2024-03-03 08:34:46'),
(2, 'Mochi Trà xanh', 35000, 50, 'uploads/mochitraxanh.jpg', '<font color=\"#000000\">Bánh hấp dẫn nhờ độ dẻo ngon, lớp vỏ thơm mềm cùng nhân kem mát lạnh.</font><br>', 1, '2021-07-07 17:41:08', '2021-08-15 16:53:50'),
(4, 'Tiramisu socola', 25000, 30, 'uploads/OIP (6).jpg', 'Tiramisu béo thơm hượng vị socola ngọt ngào', 3, '2021-07-07 17:25:47', '2021-08-15 16:12:51'),
(5, 'Donut vanila', 35000, 10, 'uploads/OIP (3).jpg', '<span style=\"color: rgb(83, 56, 44); font-family: \"Open Sans\", sans-serif; font-size: 15px; text-align: justify;\">donut vanila.</span><br>', 2, '2021-07-07 18:36:37', '2021-08-15 16:24:51'),
(8, 'Mochi socola', 50000, 10, 'uploads/OIP.jpg', '<p><span style=\"color: rgb(0, 0, 0); font-family: \" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" 20px;=\"\" font-weight:=\"\" 700;=\"\" text-align:=\"\" center;\"=\"\">Bánh mochi nhân socola tan chảy có vỏ bánh dai mềm thơm ngon cùng nhân bánh ngọt đắng, beo béo hấp dẫn</span><br></p>', 1, '2021-07-11 16:07:58', '2021-08-15 16:44:51'),
(9, 'Mochi dâu tây', 25000, 46, 'uploads/Mochidautay.jpg', '<p>bánh Mochi dâu tây với hương vị dâu tây dẻo thơm khiến bạn ngây ngất<br></p>', 1, '2021-07-11 16:38:58', '2021-08-15 16:02:52'),
(10, 'Crepe sầu riêng', 50000, 44, 'uploads/OIP (9).jpg', '<p><font color=\"#53382c\">Bánh crepe sầu riêng béo thơm vị sầu riêng, sầu riêng nhiều kem ít</font><br></p>', 38, '2021-07-11 16:12:59', '2021-08-15 16:18:52'),
(12, 'Crepe trà xanh lớn', 30000, 15, 'uploads/b4acb563ec03b243559a3900474a0c7e.jpg', '<p>Crepe trà xanh lớn ngàn lớp!!<br></p>', 38, '2021-07-13 10:20:53', '2021-08-15 16:45:54'),
(13, 'Donut dâu', 19000, 20, 'uploads/OIP (4).jpg', '<span style=\"color: rgb(83, 56, 44); font-family: \"Open Sans\", sans-serif; font-size: 15px; text-align: justify;\">donut dâu</span><br>', 2, '2021-07-07 17:41:08', '2021-08-15 16:40:53'),
(14, 'Donut thượng hạng', 35000, 5, 'uploads/OIP (5).jpg', '<span style=\"color: rgb(83, 56, 44); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">donut thượng  hạng.</span><br>', 2, '2021-07-07 17:41:08', '2021-08-15 16:00:55'),
(16, 'Tiramisu lớn', 20000, 30, 'uploads/OIP (7).jpg', 'Tiramisu siêu to khổng lồ 1 người ăn không hết!!', 3, '2021-07-07 17:25:47', '2021-08-15 16:17:55'),
(18, 'Mochi phô mai', 50000, 10, 'uploads/OIP (1).jpg', '<p><span style=\"color: rgb(0, 0, 0); font-size: 1rem;\">Bánh mochi mềm mịn, dẻo ngon sẽ càng hấp dẫn hơn khi kết hợp cùng phô mai béo ngậy, mằn mặn ăn vào cực thích miệng mà không bị ngán</span><br></p><p><br></p>', 1, '2021-07-11 16:07:58', '2021-08-15 16:48:55'),
(28, 'Tiramisu dâu tây', 20000, 90, 'uploads/R.jpg', '<p>Tiramisu dâu tây ngọt ngào.<br></p>', 3, '2021-08-15 08:25:31', '2021-08-15 16:13:57'),
(30, 'Crepe ngàn lớp', 35000, 100, 'uploads/OIP (11).jpg', '<p>Bánh crepe ngàn lớn ăn cực đã cực nhiều sầu riêng !!!<br></p>', 38, '2021-08-15 08:01:37', '2021-08-15 17:03:01'),
(43, 'Tiramisu dâu tây lớn', 50000, 0, 'uploads/OIP (8).jpg', 'tiramisu dâu tây siêu to khổng lồ 2 3 người ăn ', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `hoten` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(28) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id_user`, `hoten`, `username`, `password`, `phone`, `email`) VALUES
(7, 'Nguyễn Văn A', 'Admin', 'admin', '+84387578520', 'liuliu@gmail.com'),
(8, 'Nguyễn Văn B', 'toquocphong1', 'toquocphong1', '0387578520', 'hihihi@gmail.com'),
(55, 'Nguyễn Văn C', 'toquocphong2', 'toquocphong2', '0387578520', 'huuhuhu@gmail.com'),
(57, 'Nguyễn Hồ Khánh Như', 'beiu', 'beiu', '0387578520', 'khanhnhuxingdeps1tg@gmail.com'),
(58, 'Tô Quốc Phong', 'toquocphong3', 'toquocphong3', '0387578520', 'hehehee@gmail.com');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
