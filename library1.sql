/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : library

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 25/06/2019 13:28:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for active
-- ----------------------------
DROP TABLE IF EXISTS `active`;
CREATE TABLE `active`  (
  `active_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`active_id`) USING BTREE,
  UNIQUE INDEX `uq_active_name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of active
-- ----------------------------
INSERT INTO `active` VALUES (0, '');
INSERT INTO `active` VALUES (1, 'aktivna');
INSERT INTO `active` VALUES (4, 'drugo');
INSERT INTO `active` VALUES (2, 'izgubljena');
INSERT INTO `active` VALUES (3, 'unistena');

-- ----------------------------
-- Table structure for author
-- ----------------------------
DROP TABLE IF EXISTS `author`;
CREATE TABLE `author`  (
  `author_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `forename` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`author_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of author
-- ----------------------------
INSERT INTO `author` VALUES (1, 'Petar', 'Petrović Njegoš', 'Crna Gora');
INSERT INTO `author` VALUES (2, ' Žan (Molijer)', 'Batist Poklen', 'Francuska');
INSERT INTO `author` VALUES (3, 'Ivo ', 'Andrić', 'Jugoslavija');
INSERT INTO `author` VALUES (4, 'Vilijem ', 'Šekspir', 'Engleska');
INSERT INTO `author` VALUES (5, 'Fjodor', 'Dostojevski', 'Rusija');

-- ----------------------------
-- Table structure for book
-- ----------------------------
DROP TABLE IF EXISTS `book`;
CREATE TABLE `book`  (
  `book_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `isbn` int(13) UNSIGNED NOT NULL,
  `published_at` datetime(0) NULL DEFAULT NULL,
  `image_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `librarian_id` int(10) UNSIGNED NOT NULL,
  `active_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`book_id`) USING BTREE,
  UNIQUE INDEX `uq_book_isbn`(`isbn`) USING BTREE,
  INDEX `fk_book_category_id`(`category_id`) USING BTREE,
  INDEX `fk_book_librarian_id`(`librarian_id`) USING BTREE,
  INDEX `fk_book_active_id`(`active_id`) USING BTREE,
  CONSTRAINT `fk_book_active_id` FOREIGN KEY (`active_id`) REFERENCES `active` (`active_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_book_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_book_librarian_id` FOREIGN KEY (`librarian_id`) REFERENCES `librarian` (`librarian_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 92 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of book
-- ----------------------------
INSERT INTO `book` VALUES (1, 'Gorski vjenac', 'Gorski vijenac (u prvom izdanju: Горскıй вıенацъ) je pesnički ep i drama koja se smatra vrhunskim djelom crnogorske književnosti epohe romantizma. Autor „Gorskog vijenca“ je crnogorski episkop, vladar i pesnik Petar II Petrović Njegoš.', 4294967295, '2005-07-14 00:00:00', '/assets/img/gorski-vijenac.jpg', 5, 1, 1);
INSERT INTO `book` VALUES (2, 'Tvrdica', 'Tvrdica (franc. L\'Avare ou l\'École du mensonge) je komedija u pet činova i u prozi koju je 9. septembra 1668. napisao Molijer.', 2112345328, '2009-07-30 00:00:00', '/assets/img/tvrdica.jpg', 2, 2, 2);
INSERT INTO `book` VALUES (3, 'Zlocin i kazna', 'Zločin i kazna (ruski: Преступление и наказание) je roman ruskog pisca Fjodora Mihajloviča Dostojevskog izdan 1866. godine u časopisu Ruski vjesnik. Smatra se jednim od najvećih djela ruske književnosti.', 456739847, '2006-08-05 00:00:00', '/assets/img/zlocin.jpg', 1, 1, 3);
INSERT INTO `book` VALUES (4, 'Romeo i Julija', 'Romeo i Julija (engleski original Romeo and Juliet) je znamenita tragedija Williama Shakespearea o dvoje mladih ljubavnika čija zlosretna ljubav i smrt ujedini dvije zavađene porodice.', 909087273, '2014-02-05 00:00:00', '/assets/img/romeo.jpg', 3, 1, 1);
INSERT INTO `book` VALUES (5, 'Prokleta avlija', 'Prokleta avlija je naziv dela jugoslavenskog književnika Iva Andrića, dobitnika Nobelove nagrade za književnost 1961. godine za životno delo, a pre svega za dela Na Drini Cuprija i Prokleta Avlija. Ovaj roman pripada kasnijem periodu Andrićevog književnog stvaranjam i on se njome opet vraća bosanskoj prošlosti i motivima ljudske tragike i izgubljenosti. S obzirom na koncepciju, likove i kompoziciju, ovo delo ima sve osobine romaneskne strukture, iako se ponekad zbog obima svrstava u pripovetke.', 636437874, '2002-09-04 00:00:00', '/assets/img/prokleta_avlija.jpg', 4, 2, 3);
INSERT INTO `book` VALUES (6, 'Knjiga o ljudima', 'Ovo je fejk knjiga koje ovdew samo da bi smo popinili mesto', 1238349345, '2015-07-16 00:00:00', '/assets/img/fejk1.jpg', 2, 1, 4);
INSERT INTO `book` VALUES (11, 'Neka knjiga', '123123', 123123, '2019-05-07 00:00:00', '123', 2, 1, 1);
INSERT INTO `book` VALUES (13, 'Knjizica', 'asdsadasdas', 12351236, '2019-06-20 00:00:00', '889jpg', 1, 3, 3);
INSERT INTO `book` VALUES (14, 'subscribe here', '123123213', 1235123623, '2019-06-04 00:00:00', '462.jpg', 5, 3, 4);
INSERT INTO `book` VALUES (15, 'Fortnite game channel', 'asddasd', 123, '1111-11-11 00:00:00', '133.jpg', 3, 3, 4);
INSERT INTO `book` VALUES (21, 'subscribe here123', '23', 123333323, '2019-06-20 00:00:00', '848.jpg', 2, 3, 3);
INSERT INTO `book` VALUES (22, 'subscribe here123', '23', 1233, '2019-06-20 00:00:00', '776.jpg', 2, 3, 2);
INSERT INTO `book` VALUES (24, 'Proba321', 'asdsdasdasdasdasdas', 45678123, '2019-06-15 00:00:00', '750.jpg', 2, 3, 2);
INSERT INTO `book` VALUES (26, 'subscribe here3222', '2323232', 12322, '2019-06-22 00:00:00', '886.jpg', 2, 3, 2);
INSERT INTO `book` VALUES (27, '2323232', '123', 2323, '2019-06-15 00:00:00', '129.jpg', 1, 3, 3);
INSERT INTO `book` VALUES (28, '123', '2323232', 33321, '2019-06-20 00:00:00', '844.jpg', 4, 3, 1);
INSERT INTO `book` VALUES (29, '123123213', '232323', 23222, '2019-06-07 00:00:00', '817.jpg', 2, 3, 0);
INSERT INTO `book` VALUES (74, 'asd', 'a', 0, '2019-06-12 02:03:00', '2728.jpg', 2, 4, 1);
INSERT INTO `book` VALUES (77, 'Sta je ovo ljudi', '123', 3, '2019-06-03 02:03:00', '7742.jpg', 2, 4, 1);
INSERT INTO `book` VALUES (78, 'Sta je ovo ljudi', '123', 34, '2019-06-03 02:03:00', '6757.jpg', 2, 4, 1);
INSERT INTO `book` VALUES (81, 'sta je sad problem', '11111', 11, '2019-01-01 01:01:00', '669.jpg', 5, 4, 1);

-- ----------------------------
-- Table structure for book_author
-- ----------------------------
DROP TABLE IF EXISTS `book_author`;
CREATE TABLE `book_author`  (
  `book_author_id` int(10) NOT NULL AUTO_INCREMENT,
  `book_id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`book_author_id`) USING BTREE,
  INDEX `fk_book_author_book_id`(`book_id`) USING BTREE,
  INDEX `fk_book_author_author_id`(`author_id`) USING BTREE,
  CONSTRAINT `fk_book_author_author_id` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_book_author_book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of book_author
-- ----------------------------
INSERT INTO `book_author` VALUES (1, 1, 1);
INSERT INTO `book_author` VALUES (2, 2, 2);
INSERT INTO `book_author` VALUES (3, 3, 5);
INSERT INTO `book_author` VALUES (4, 4, 4);
INSERT INTO `book_author` VALUES (5, 5, 3);

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`) USING BTREE,
  UNIQUE INDEX `uq_category_name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (3, 'Drama');
INSERT INTO `category` VALUES (2, 'Komedija');
INSERT INTO `category` VALUES (5, 'Poema');
INSERT INTO `category` VALUES (4, 'Pripovetka');
INSERT INTO `category` VALUES (1, 'Roman');

-- ----------------------------
-- Table structure for librarian
-- ----------------------------
DROP TABLE IF EXISTS `librarian`;
CREATE TABLE `librarian`  (
  `librarian_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `forename` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`librarian_id`) USING BTREE,
  UNIQUE INDEX `uq_librarian_username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of librarian
-- ----------------------------
INSERT INTO `librarian` VALUES (1, 'Natasa', 'Pavlovic', 'npavlovic', '12345678');
INSERT INTO `librarian` VALUES (2, 'Vera', 'Pavladoljska', 'vpavladoljska', '8342u8329fh983h823hf239ghf7823gf23');
INSERT INTO `librarian` VALUES (3, 'Milanka', 'Pesic', 'b_m.pesic', '1234567');
INSERT INTO `librarian` VALUES (4, 'Danica', 'Zvezdic', 'b_d.zvezdic', '76543210');
INSERT INTO `librarian` VALUES (5, 'Dragana', 'dikic', 'b_d.dikic', '1234567');

-- ----------------------------
-- Table structure for reservation
-- ----------------------------
DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation`  (
  `reservation_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `expires_at` datetime(0) NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `librarian_id` int(10) UNSIGNED NOT NULL,
  `book_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`reservation_id`) USING BTREE,
  INDEX `fk_reservation_student_id`(`student_id`) USING BTREE,
  INDEX `fk_reservation_librarian_id`(`librarian_id`) USING BTREE,
  INDEX `fk_reservation_book_id`(`book_id`) USING BTREE,
  CONSTRAINT `fk_reservation_book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_reservation_librarian_id` FOREIGN KEY (`librarian_id`) REFERENCES `librarian` (`librarian_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_reservation_student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of reservation
-- ----------------------------
INSERT INTO `reservation` VALUES (1, '2019-05-15 14:42:57', '2019-05-22 14:43:40', 1, 1, 1);
INSERT INTO `reservation` VALUES (2, '2019-05-15 14:44:07', '2019-05-23 14:43:51', 3, 2, 5);
INSERT INTO `reservation` VALUES (3, '2019-05-30 14:48:06', '2019-06-05 14:48:16', 2, 2, 1);

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student`  (
  `student_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `forename` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `grade` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`student_id`) USING BTREE,
  UNIQUE INDEX `uq_student_username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES (1, 'David', 'Borikić', 'dborikic', '2', '6', '1234567');
INSERT INTO `student` VALUES (2, 'Mladen', 'Tanić', 'mtanic', '3', '6', 'fsjidjf8sfdjj9jaasdsad');
INSERT INTO `student` VALUES (3, 'Bojan', 'Filipović', 'bfilipovic', '1', '6', '8sdj8f9ju283476dhufnij21342dsf');
INSERT INTO `student` VALUES (4, 'test', 'test', 'user1', '2', '3', '1234567');
INSERT INTO `student` VALUES (5, 'Nikola', 'Nikolic', 's_n.nikolic', '3', '2', '1234567');

SET FOREIGN_KEY_CHECKS = 1;
