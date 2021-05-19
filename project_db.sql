-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-06-09 18:07:51
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `project_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `introduce` text NOT NULL,
  `img_dir` varchar(255) NOT NULL,
  `category_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `price`, `amount`, `introduce`, `img_dir`, `category_id`) VALUES
(1, '電鍋', 1200, 7, '', 'img\\Images\\電器\\pot.png', 1),
(2, '冰箱', 40000, 7, '', 'img\\Images\\電器\\refrigerator.png', 1),
(3, '烤箱', 3200, 40, '', 'img\\Images\\電器\\oven.png', 1),
(4, '除濕機', 5000, 23, '', 'img\\Images\\電器\\dehumidifier.png', 1),
(5, '檯燈', 1500, 30, '', 'img\\Images\\電器\\lamp.png', 1),
(6, '沙發', 5000, 9, '', 'img\\Images\\家具\\sofa.png', 2),
(7, '電視櫃', 3500, 7, '', 'img\\Images\\家具\\TV_box.png', 2),
(8, '小茶几', 1500, 20, '', 'img\\Images\\家具\\tea_table.png', 2),
(9, '鞋櫃', 2500, 20, '', 'img\\Images\\家具\\shoe_box.png', 2),
(10, '衣櫃', 4000, 8, '', 'img\\Images\\家具\\clothes_box.png', 2),
(11, '牙膏', 50, 60, '', 'img\\Images\\日用品\\toothpaste.png', 3),
(12, '牙刷', 45, 70, '', 'img\\Images\\日用品\\toothbrush.png', 3),
(13, '菜瓜布', 30, 150, '', 'img\\Images\\日用品\\caiguabu.png', 3),
(14, '清潔刷', 40, 10, '', 'img\\Images\\日用品\\cleaner.png', 3),
(15, '去霉劑', 150, 30, '', 'img\\Images\\日用品\\remover.png', 3),
(16, '籃球', 650, 20, '', 'img\\Images\\運動用品\\basketball.png', 4),
(17, '運動頭戴', 150, 100, '', 'img\\Images\\運動用品\\scarf.png', 4),
(18, '運動毛巾', 60, 190, '', 'img\\Images\\運動用品\\towel.png', 4),
(19, '瑜珈墊', 450, 30, '', 'img\\Images\\運動用品\\yoga.png', 4),
(20, '運動水壺', 250, 50, '', 'img\\Images\\運動用品\\water_cup.png', 4),
(21, '折疊椅', 450, 25, '', 'img\\Images\\戶外休閒用品\\chair.png', 5),
(22, '強光頭燈', 200, 50, '', 'img\\Images\\戶外休閒用品\\headlamp.png', 5),
(23, '保冰袋', 100, 100, '', 'img\\Images\\戶外休閒用品\\ice_pack.png', 5),
(24, '滑板車', 1500, 10, '', 'img\\Images\\戶外休閒用品\\scooter.png', 5),
(25, '滑板', 1200, 13, '', 'img\\Images\\戶外休閒用品\\skateboard.png', 5),
(26, '手工藝', 1000, 38, '', 'img\\Images\\藝品\\手工藝.png', 6),
(27, '佛珠', 4000, 10, '', 'img\\Images\\藝品\\佛珠.png', 6),
(28, '龍筆', 5000, 2, '太行山崖柏龍筆 直徑70公分', 'img\\Images\\藝品\\龍筆.png', 6),
(29, '聚寶盆', 3000, 14, '台灣黃檜一代木聚寶盆(含五帝錢) 直徑20cm', 'img\\Images\\藝品\\聚寶盆.png', 6),
(30, '三腳蟾蜍', 18000, 30, '純沙金三腳蟾蜍  嘴咬古銅錢 白天向外招財 晚上向內守財 讓你不失財 不漏財 不破財', 'img\\Images\\藝品\\三角蟾蜍.png', 6),
(31, '小葉黃楊福德正神', 5000, 20, '小葉黃楊福德正神 右手拿如意 讓大家都如意 左手拿元寶 金銀財寶免煩惱 整個底部是簍空雕刻', 'img\\Images\\藝品\\小葉黃楊福德正神.png', 6),
(32, '純沙金關公', 20000, 6, '純沙金關公 高度48公分 直徑19公分 精細雕刻的戰甲', 'img\\Images\\藝品\\純沙金關公.png', 6),
(33, '黃玉蟾蜍', 1200, 8, '黃玉三腳蟾蜍 百年石 千年玉 千年才會形成的黃玉 吸收千年的日月精華 嘴咬的古銅錢 可以轉動 讓你十來運轉 都是手工水膜的', 'img\\Images\\藝品\\黃玉蟾蜍.png', 6),
(34, '彌勒佛', 3200, 14, '越檜彌勒佛 直徑25cm 越檜樹頭料 讓你賺錢越來越快', 'img\\Images\\藝品\\彌勒佛.png', 6),
(35, '你的加油', 0, 999, '謝謝你的加油，我們會努力的!!!', 'img/emoji.gif', 6);

-- --------------------------------------------------------

--
-- 資料表結構 `product_category`
--

CREATE TABLE `product_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_name`) VALUES
(1, '電器'),
(2, '家俱'),
(3, '日用品'),
(4, '運動用品'),
(5, '戶外休閒用品'),
(6, '藝品');

-- --------------------------------------------------------

--
-- 資料表結構 `product_order`
--

CREATE TABLE `product_order` (
  `order_id` int(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `total_sale` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `product_order`
--

INSERT INTO `product_order` (`order_id`, `product_id`, `user_id`, `order_number`, `total_sale`, `order_date`) VALUES
(2052804902, 6, 210, 5, 25000, '2020-05-28 02:41:42'),
(2052858032, 26, 213, 10, 12000, '2020-05-28 17:27:12'),
(2052859826, 6, 213, 6, 30000, '2020-05-28 17:57:06'),
(2052876422, 28, 213, 38, 190000, '2020-05-28 22:33:42'),
(2052877201, 7, 217, 3, 10500, '2020-05-28 22:46:41'),
(2052925491, 32, 211, 4, 80000, '2020-05-29 12:11:31'),
(2052925706, 32, 213, 20, 400000, '2020-05-29 12:15:06');

-- --------------------------------------------------------

--
-- 資料表結構 `product_sale`
--

CREATE TABLE `product_sale` (
  `product_id` int(11) NOT NULL,
  `sales_number` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `product_sale`
--

INSERT INTO `product_sale` (`product_id`, `sales_number`) VALUES
(1, 0),
(2, 1),
(3, 3),
(4, 0),
(5, 0),
(6, 2),
(7, 3),
(8, 5),
(9, 0),
(10, 0),
(11, 0),
(12, 0),
(13, 0),
(14, 0),
(15, 0),
(16, 0),
(17, 0),
(18, 10),
(19, 0),
(20, 0),
(21, 0),
(22, 0),
(23, 0),
(24, 0),
(25, 0),
(26, 0),
(27, 0),
(28, 38),
(29, 0),
(30, 0),
(31, 40),
(32, 0),
(33, 15),
(34, 30),
(35, 66);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `phone_number`, `email`, `gender`) VALUES
(210, 'ggbb54321', '2a57ab6e34c13997d7860d8901edf79c', 'ggbb520', '0958492497', 'ggbb54321@gmail.com', 'male'),
(211, 'smile19991021', '9a2525ff0137b46338f4a86b9b60ec8b', '林哲弘', '0978392397', 'smile19991021@gmail.com', 'male'),
(212, 'hello123', '2a57ab6e34c13997d7860d8901edf79c', 'Haha', '0993852394', 'haha520@gmail.com', 'male'),
(213, 'zx1155xz', '6895acbfc9f33f654a58620ed9a24708', '111', '0978556162', '11@gmail.com', 'male'),
(214, 'HaHaMiMi', '2a57ab6e34c13997d7860d8901edf79c', 'MiMi', '0957125431', 'MiMi@gmail.com', 'female'),
(215, 'wesley890529', '6dde7a07f68b802e6f51f61418b3cbe7', '龔抹聽', '0960200529', 'q2794125@gmail.com', 'male'),
(216, 'HaHa45La', '2a57ab6e34c13997d7860d8901edf79c', '哈哈是我啦', '0954765198', 'HaHa@gmail.com', 'male'),
(217, 'AllenChen', 'dd4b21e9ef71e1291183a46b913ae6f2', 'Allen', '0977618338', 'boy610640@gmail.com', 'male');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- 資料表索引 `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- 資料表索引 `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`order_id`);

--
-- 資料表索引 `product_sale`
--
ALTER TABLE `product_sale`
  ADD PRIMARY KEY (`product_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_sale`
--
ALTER TABLE `product_sale`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
