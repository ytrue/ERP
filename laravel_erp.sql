/*
 Navicat MySQL Data Transfer

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 50719
 Source Host           : localhost:3306
 Source Schema         : laravel_erp

 Target Server Type    : MySQL
 Target Server Version : 50719
 File Encoding         : 65001

 Date: 16/02/2019 12:10:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for erp_accounts
-- ----------------------------
DROP TABLE IF EXISTS `erp_accounts`;
CREATE TABLE `erp_accounts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `number` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `balance_date` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `balance` decimal(10, 2) NOT NULL,
  `current_balance` decimal(10, 2) NULL DEFAULT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_accounts
-- ----------------------------
INSERT INTO `erp_accounts` VALUES (2, '蜡笔小新', '0001', '2019-02-07 18:34:56', 2121.00, -89161.00, 2, '2018-12-21 14:46:45', '2018-12-21 14:46:45');
INSERT INTO `erp_accounts` VALUES (3, '孙悟空', '0002', '2019-02-01 10:57:40', 3000.00, 33896.00, 1, '2018-12-21 14:47:35', '2018-12-21 14:47:35');
INSERT INTO `erp_accounts` VALUES (4, '阿凡提', '0003', '2019-02-01 11:19:00', 2000.00, 1900.00, 1, '2018-12-21 14:48:05', '2018-12-21 14:48:05');
INSERT INTO `erp_accounts` VALUES (5, '樱桃小丸子', '0005', '2019-02-01 10:43:12', 2121.00, -7878.00, 2, '2018-12-21 14:49:03', '2018-12-21 14:49:03');

-- ----------------------------
-- Table structure for erp_allocation_extends
-- ----------------------------
DROP TABLE IF EXISTS `erp_allocation_extends`;
CREATE TABLE `erp_allocation_extends`  (
  `allocation_id` int(10) UNSIGNED NOT NULL,
  `out_warehouse` int(11) NOT NULL,
  `in_warehouse` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `number` int(10) UNSIGNED NOT NULL,
  `company` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_allocation_extends
-- ----------------------------
INSERT INTO `erp_allocation_extends` VALUES (4, 17, 19, 50, 1, '台');
INSERT INTO `erp_allocation_extends` VALUES (4, 16, 16, 49, 1, '台');
INSERT INTO `erp_allocation_extends` VALUES (5, 17, 19, 50, 1, '台');
INSERT INTO `erp_allocation_extends` VALUES (5, 16, 16, 49, 1, '台');
INSERT INTO `erp_allocation_extends` VALUES (6, 16, 21, 51, 1, '个');
INSERT INTO `erp_allocation_extends` VALUES (8, 16, 21, 49, 1, '台');

-- ----------------------------
-- Table structure for erp_allocations
-- ----------------------------
DROP TABLE IF EXISTS `erp_allocations`;
CREATE TABLE `erp_allocations`  (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `ood_number` char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `details` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_allocations
-- ----------------------------
INSERT INTO `erp_allocations` VALUES (0000000004, 'DB20190122103647', 1, 'admin', '2019-01-22 10:36:47', '2019-01-22 10:36:47', '222...');
INSERT INTO `erp_allocations` VALUES (0000000005, 'DB20190122103723', 1, 'admin', '2019-01-22 10:37:23', '2019-01-22 10:37:23', '222...');
INSERT INTO `erp_allocations` VALUES (0000000006, 'DB20190122103938', 1, 'admin', '2019-01-22 10:39:38', '2019-01-22 10:39:38', '111....');
INSERT INTO `erp_allocations` VALUES (0000000008, 'DB20190122104012', 1, 'admin', '2019-01-22 10:40:12', '2019-01-22 10:40:12', '1...');

-- ----------------------------
-- Table structure for erp_client_extends
-- ----------------------------
DROP TABLE IF EXISTS `erp_client_extends`;
CREATE TABLE `erp_client_extends`  (
  `c_id` int(10) UNSIGNED NOT NULL,
  `contacts` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `landline` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `qq` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `info` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`c_id`) USING BTREE,
  CONSTRAINT `FK_c_id` FOREIGN KEY (`c_id`) REFERENCES `erp_clients` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_client_extends
-- ----------------------------
INSERT INTO `erp_client_extends` VALUES (3, '马云', '11518320351', '11518320351', '1151832035', '北京....', '阿里巴巴....');
INSERT INTO `erp_client_extends` VALUES (4, '马化腾', '11518320351', '11518320351', '1151832035', '北京....', '马化腾。。。。');
INSERT INTO `erp_client_extends` VALUES (5, '迪迦奥特曼', '11518320351', '11518320351', '1151832035', '北京....', '奥特曼...');

-- ----------------------------
-- Table structure for erp_clients
-- ----------------------------
DROP TABLE IF EXISTS `erp_clients`;
CREATE TABLE `erp_clients`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `number` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `level` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `balance_date` timestamp(0) NULL DEFAULT NULL,
  `initial_payable` decimal(8, 2) UNSIGNED NOT NULL,
  `initial_advance_payment` decimal(8, 2) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_clients
-- ----------------------------
INSERT INTO `erp_clients` VALUES (3, '00001', '阿里巴巴客户', '现实客户', '零售客户', '2018-12-27 00:00:00', 0.00, 0.00, 1, '2019-01-05 19:02:59', '2018-12-27 12:15:00');
INSERT INTO `erp_clients` VALUES (4, '00002', '腾讯客户', '目标客户', '批发客户', '2018-12-27 00:00:00', 0.00, 0.00, 1, '2019-01-05 19:02:49', '2018-12-27 12:15:59');
INSERT INTO `erp_clients` VALUES (5, '00003', '奥特曼客户', '潜在客户与目标客户', 'VIP客户', '2018-12-27 00:00:00', 0.00, 0.00, 1, '2019-01-12 18:37:31', '2018-12-27 12:17:18');

-- ----------------------------
-- Table structure for erp_commodities
-- ----------------------------
DROP TABLE IF EXISTS `erp_commodities`;
CREATE TABLE `erp_commodities`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name`(`name`) USING BTREE,
  INDEX `name_2`(`name`, `id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 57 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_commodities
-- ----------------------------
INSERT INTO `erp_commodities` VALUES (50, '笔记本电脑', '2018-12-20 20:14:44', '2018-12-20 20:14:44');
INSERT INTO `erp_commodities` VALUES (51, '智能手机', '2018-12-20 20:14:58', '2018-12-20 20:14:58');
INSERT INTO `erp_commodities` VALUES (52, '书籍', '2018-12-20 20:15:33', '2018-12-20 20:15:33');
INSERT INTO `erp_commodities` VALUES (53, '鼠标', '2018-12-20 20:15:41', '2018-12-20 20:15:41');
INSERT INTO `erp_commodities` VALUES (54, '键盘', '2018-12-20 20:15:49', '2018-12-20 20:15:49');
INSERT INTO `erp_commodities` VALUES (55, 'U盘', '2018-12-20 20:15:57', '2018-12-20 20:15:57');
INSERT INTO `erp_commodities` VALUES (56, '耳机', '2018-12-20 20:16:02', '2018-12-20 20:16:02');

-- ----------------------------
-- Table structure for erp_customers
-- ----------------------------
DROP TABLE IF EXISTS `erp_customers`;
CREATE TABLE `erp_customers`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_customers
-- ----------------------------
INSERT INTO `erp_customers` VALUES (46, '非客户', '2018-12-20 21:20:48', '2018-12-20 21:20:48');
INSERT INTO `erp_customers` VALUES (47, '潜在客户', '2018-12-20 21:20:57', '2018-12-20 21:20:57');
INSERT INTO `erp_customers` VALUES (48, '目标客户', '2018-12-20 21:21:06', '2018-12-20 21:21:06');
INSERT INTO `erp_customers` VALUES (49, '潜在客户与目标客户', '2018-12-20 21:21:16', '2018-12-20 21:21:16');
INSERT INTO `erp_customers` VALUES (50, '现实客户', '2018-12-20 21:21:24', '2018-12-20 21:21:24');
INSERT INTO `erp_customers` VALUES (51, '流失客户', '2018-12-20 21:21:30', '2018-12-21 15:59:25');

-- ----------------------------
-- Table structure for erp_expenditures
-- ----------------------------
DROP TABLE IF EXISTS `erp_expenditures`;
CREATE TABLE `erp_expenditures`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_expenditures
-- ----------------------------
INSERT INTO `erp_expenditures` VALUES (46, '主营业务成本', '2018-12-20 19:52:55', '2018-12-20 19:52:55');
INSERT INTO `erp_expenditures` VALUES (47, '其他业务支出', '2018-12-20 19:53:06', '2018-12-20 19:53:06');
INSERT INTO `erp_expenditures` VALUES (48, '营业外支出', '2018-12-20 19:53:19', '2018-12-20 19:53:19');
INSERT INTO `erp_expenditures` VALUES (49, '营业费用', '2018-12-20 19:53:36', '2018-12-20 19:53:36');

-- ----------------------------
-- Table structure for erp_goods
-- ----------------------------
DROP TABLE IF EXISTS `erp_goods`;
CREATE TABLE `erp_goods`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `number` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `bar_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `specification` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `minimum` int(10) UNSIGNED NOT NULL,
  `maxnum` int(10) UNSIGNED NULL DEFAULT NULL,
  `measurement` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `predicted_price` decimal(8, 2) UNSIGNED NOT NULL,
  `retail_price` decimal(8, 2) UNSIGNED NOT NULL,
  `wholesale_price` decimal(8, 2) UNSIGNED NOT NULL,
  `vip_price` decimal(8, 2) UNSIGNED NOT NULL,
  `discount_one` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `current_inventory` int(10) UNSIGNED NULL DEFAULT 0 COMMENT '//当前库存',
  `discount_two` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NULL DEFAULT 1,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_typess`(`type`) USING BTREE,
  INDEX `fk_xxxx`(`measurement`) USING BTREE,
  INDEX `name`(`name`) USING BTREE,
  CONSTRAINT `fk_typess` FOREIGN KEY (`type`) REFERENCES `erp_commodities` (`name`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_xxxx` FOREIGN KEY (`measurement`) REFERENCES `erp_meterings` (`name`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_goods
-- ----------------------------
INSERT INTO `erp_goods` VALUES (48, '华为手机', '00001', '2197328yehdjbjdsf', 's', '智能手机', 0, 999999, '台', 9000.00, 10000.00, 9000.00, 9500.00, 90, 0, 90, 1, '2018-12-30 07:18:46', '2018-12-30 07:18:46');
INSERT INTO `erp_goods` VALUES (49, 'thinkpad电脑', '00002', '9324hujdfsjsgfkx', 's', '书籍', 0, 99999, '台', 9999.00, 12999.00, 9999.00, 11999.00, 90, 99, 90, 1, '2018-12-30 07:20:46', '2018-12-30 07:20:46');
INSERT INTO `erp_goods` VALUES (50, '惠普电脑', '00003', '324也8gsdjhbfjsbvx', 's', '笔记本电脑', 0, 99999, '台', 9999.00, 12999.00, 9999.00, 11222.00, 90, 8, 90, 1, '2018-12-30 07:21:40', '2018-12-30 07:21:40');
INSERT INTO `erp_goods` VALUES (51, '奥特曼玩具', '00004', '32897432rbdsjhgfjd', 's', 'U盘', 0, 99999, '个', 100.00, 120.00, 90.00, 110.00, 90, 109, 90, 1, '2018-12-30 07:46:49', '2018-12-30 07:22:35');

-- ----------------------------
-- Table structure for erp_incomes
-- ----------------------------
DROP TABLE IF EXISTS `erp_incomes`;
CREATE TABLE `erp_incomes`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 54 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_incomes
-- ----------------------------
INSERT INTO `erp_incomes` VALUES (49, '主营业务收入', '2018-12-20 19:28:25', '2018-12-20 19:28:25');
INSERT INTO `erp_incomes` VALUES (50, '其他业务收入', '2018-12-20 19:28:36', '2018-12-20 19:28:36');
INSERT INTO `erp_incomes` VALUES (51, '营业外收入', '2018-12-20 19:28:54', '2018-12-20 19:28:54');
INSERT INTO `erp_incomes` VALUES (52, '补贴收入', '2018-12-20 19:29:03', '2018-12-20 19:29:03');
INSERT INTO `erp_incomes` VALUES (53, '基本建设拨款收入', '2018-12-20 19:29:45', '2018-12-20 19:30:19');

-- ----------------------------
-- Table structure for erp_log
-- ----------------------------
DROP TABLE IF EXISTS `erp_log`;
CREATE TABLE `erp_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_log
-- ----------------------------
INSERT INTO `erp_log` VALUES (5, 1, '用户登录：用户名：admin', '2019-02-15 19:52:36', '2019-02-15 19:52:36');
INSERT INTO `erp_log` VALUES (6, 1, '用户登录：用户名：admin', '2019-02-15 20:13:27', '2019-02-15 20:13:27');
INSERT INTO `erp_log` VALUES (7, 1, '用户登录：用户名：admin', '2019-02-16 10:52:11', '2019-02-16 10:52:11');
INSERT INTO `erp_log` VALUES (8, 1, '用户登录：用户名：admin', '2019-02-16 11:32:46', '2019-02-16 11:32:46');

-- ----------------------------
-- Table structure for erp_meterings
-- ----------------------------
DROP TABLE IF EXISTS `erp_meterings`;
CREATE TABLE `erp_meterings`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 54 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_meterings
-- ----------------------------
INSERT INTO `erp_meterings` VALUES (49, '千克', '2018-12-20 19:00:39', '2018-12-20 19:00:39');
INSERT INTO `erp_meterings` VALUES (50, '吨', '2018-12-20 19:01:27', '2018-12-20 19:01:27');
INSERT INTO `erp_meterings` VALUES (51, '台', '2018-12-20 19:01:34', '2018-12-20 19:01:34');
INSERT INTO `erp_meterings` VALUES (52, '个', '2018-12-20 19:01:54', '2018-12-20 19:01:54');
INSERT INTO `erp_meterings` VALUES (53, '米', '2018-12-20 19:02:15', '2018-12-20 19:02:15');

-- ----------------------------
-- Table structure for erp_migrations
-- ----------------------------
DROP TABLE IF EXISTS `erp_migrations`;
CREATE TABLE `erp_migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_migrations
-- ----------------------------
INSERT INTO `erp_migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `erp_migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `erp_migrations` VALUES (3, '2019_01_08_123835_create_permission_tables', 1);

-- ----------------------------
-- Table structure for erp_model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `erp_model_has_permissions`;
CREATE TABLE `erp_model_has_permissions`  (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `erp_permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_model_has_permissions
-- ----------------------------
INSERT INTO `erp_model_has_permissions` VALUES (1, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (2, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (3, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (4, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (5, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (6, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (7, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (8, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (9, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (10, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (11, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (12, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (13, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (14, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (15, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (17, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (18, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (19, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (20, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (21, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (22, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (23, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (24, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (25, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (26, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (27, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (28, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (29, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (30, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (31, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (32, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (33, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (34, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (35, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (36, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (37, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (38, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (39, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (40, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (41, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (42, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (43, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (44, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (45, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (46, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (47, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (48, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (49, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (50, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (51, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (52, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (53, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (54, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (55, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (56, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (57, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (58, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (59, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (60, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (61, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (62, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (63, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (64, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (65, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (66, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (67, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (68, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (69, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (70, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (71, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (72, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (73, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (74, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (75, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (76, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (77, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (78, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (79, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (80, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (81, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (82, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (83, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (84, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (85, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (86, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (87, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (88, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (89, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (90, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (91, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (92, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (93, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (94, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (95, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (96, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (97, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (98, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (99, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (100, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (101, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (102, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (103, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (104, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (105, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (106, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (107, 'App\\User', 1);
INSERT INTO `erp_model_has_permissions` VALUES (107, 'App\\User', 3);

-- ----------------------------
-- Table structure for erp_model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `erp_model_has_roles`;
CREATE TABLE `erp_model_has_roles`  (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `erp_roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for erp_password_resets
-- ----------------------------
DROP TABLE IF EXISTS `erp_password_resets`;
CREATE TABLE `erp_password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for erp_payment_extends
-- ----------------------------
DROP TABLE IF EXISTS `erp_payment_extends`;
CREATE TABLE `erp_payment_extends`  (
  `payment_id` int(10) UNSIGNED NOT NULL,
  `settlement_account` int(10) UNSIGNED NOT NULL,
  `payment_amount` decimal(10, 2) NULL DEFAULT NULL,
  `payment_type` int(10) UNSIGNED NOT NULL,
  `unpaid_amount` decimal(10, 2) NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_payment_extends
-- ----------------------------
INSERT INTO `erp_payment_extends` VALUES (8, 2, 109990.00, 10, 109990.00, 52);
INSERT INTO `erp_payment_extends` VALUES (8, 2, 9999.00, 10, 9999.00, 54);
INSERT INTO `erp_payment_extends` VALUES (9, 4, 100.00, 10, 1000.00, 53);
INSERT INTO `erp_payment_extends` VALUES (10, 3, 999.00, 8, 9999.00, 41);
INSERT INTO `erp_payment_extends` VALUES (11, 3, 9999.00, 11, 9999.00, 40);
INSERT INTO `erp_payment_extends` VALUES (12, 3, 19998.00, 10, 19998.00, 38);
INSERT INTO `erp_payment_extends` VALUES (13, 2, 9000.00, 9, 9999.00, 39);
INSERT INTO `erp_payment_extends` VALUES (13, 2, 9999.00, 11, 9999.00, 37);
INSERT INTO `erp_payment_extends` VALUES (14, 3, 9999.00, 8, 9999.00, 47);
INSERT INTO `erp_payment_extends` VALUES (14, 3, 100.00, 8, 9999.00, 41);
INSERT INTO `erp_payment_extends` VALUES (15, 2, 9899.00, 10, 9899.00, 59);
INSERT INTO `erp_payment_extends` VALUES (16, 2, 9899.00, 10, 9899.00, 44);

-- ----------------------------
-- Table structure for erp_payments
-- ----------------------------
DROP TABLE IF EXISTS `erp_payments`;
CREATE TABLE `erp_payments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ood_number` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `details` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_payments
-- ----------------------------
INSERT INTO `erp_payments` VALUES (8, 'GHZF20190125122448', '111111111.......', 31, 1, 1, '2019-01-25 12:24:48', '2019-01-25 12:24:48');
INSERT INTO `erp_payments` VALUES (9, 'GHZF20190125122514', '2.............', 30, 1, 1, '2019-01-25 12:25:14', '2019-01-25 12:25:14');
INSERT INTO `erp_payments` VALUES (10, 'GHSK20190125182355', '1.......', 31, 2, 1, '2019-01-25 18:23:55', '2019-01-25 18:23:55');
INSERT INTO `erp_payments` VALUES (11, 'GHSK20190125182423', '2.......', 31, 2, 1, '2019-01-25 18:24:23', '2019-01-25 18:24:23');
INSERT INTO `erp_payments` VALUES (12, 'XHSK20190125191945', '11111........', 4, 3, 1, '2019-01-25 19:19:45', '2019-01-25 19:19:45');
INSERT INTO `erp_payments` VALUES (13, 'XHSK20190125192102', '2.............', 4, 3, 1, '2019-01-25 19:21:02', '2019-01-25 19:21:02');
INSERT INTO `erp_payments` VALUES (14, 'XHZF20190125195502', '1........................', 4, 4, 1, '2019-01-25 19:55:02', '2019-01-25 19:55:02');
INSERT INTO `erp_payments` VALUES (15, 'GHZF20190201102838', '1........', 33, 1, 1, '2019-02-01 10:28:38', '2019-02-01 10:28:38');
INSERT INTO `erp_payments` VALUES (16, 'GHSK20190201102929', '1.......', 33, 2, 1, '2019-02-01 10:29:29', '2019-02-01 10:29:29');

-- ----------------------------
-- Table structure for erp_permissions
-- ----------------------------
DROP TABLE IF EXISTS `erp_permissions`;
CREATE TABLE `erp_permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 108 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_permissions
-- ----------------------------
INSERT INTO `erp_permissions` VALUES (1, 'index settlement', 'web', '2019-02-12 19:03:52', '2019-02-12 19:03:52');
INSERT INTO `erp_permissions` VALUES (2, 'add settlement', 'web', '2019-02-12 19:12:58', '2019-02-12 19:12:58');
INSERT INTO `erp_permissions` VALUES (3, 'edit settlement', 'web', '2019-02-13 18:51:56', '2019-02-13 18:51:59');
INSERT INTO `erp_permissions` VALUES (4, 'delete settlement', 'web', '2019-02-13 18:52:20', '2019-02-13 18:52:23');
INSERT INTO `erp_permissions` VALUES (5, 'index metering', 'web', '2019-02-13 18:52:35', '2019-02-13 18:52:38');
INSERT INTO `erp_permissions` VALUES (6, 'add metering', 'web', '2019-02-13 18:52:50', '2019-02-13 18:52:52');
INSERT INTO `erp_permissions` VALUES (7, 'edit metering', 'web', '2019-02-13 18:53:17', '2019-02-13 18:53:25');
INSERT INTO `erp_permissions` VALUES (8, 'delete metering', 'web', '2019-02-13 18:53:20', '2019-02-13 18:53:28');
INSERT INTO `erp_permissions` VALUES (9, 'index income', 'web', '2019-02-13 19:11:50', '2019-02-13 19:11:53');
INSERT INTO `erp_permissions` VALUES (10, 'add income', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (11, 'edit income', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (12, 'delete income', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (13, 'index expenditure', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (14, 'add expenditure', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (15, 'edit expenditure', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (17, 'delete expenditure', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (18, 'index commodity', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (19, 'add commodity', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (20, 'edit commodity', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (21, 'delete commodity', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (22, 'index supplier', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (23, 'add supplier', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (24, 'edit supplier', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (25, 'delete supplier', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (26, 'index customer', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (27, 'add customer', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (28, 'edit customer', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (29, 'delete customer', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (30, 'index account', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (31, 'add account', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (32, 'edit account', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (33, 'delete account', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (34, 'index staff', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (35, 'add staff', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (36, 'edit staff', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (37, 'status staff', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (38, 'delete staff', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (39, 'index warehouse', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (40, 'add warehouse', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (41, 'edit warehouse', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (42, 'status warehouse', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (43, 'delete warehouse', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (44, 'index goods', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (45, 'add goods', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (46, 'edit goods', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (47, 'status goods', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (48, 'delete goods', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (49, 'index supplierManagement', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (50, 'add supplierManagement', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (51, 'edit supplierManagement', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (52, 'status supplierManagement', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (53, 'delete supplierManagement', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (54, 'index client', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (55, 'add client', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (56, 'edit client', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (57, 'status client', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (58, 'delete client', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (59, 'index suppliersReconciliationNew', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (60, 'index customersReconciliationNew', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (61, 'index accountProceedsDetailNew', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (62, 'index accountPayDetailNew', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (63, 'index cashBankJournalNew', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (64, 'index goodsFlowDetails', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (65, 'index goodsBalance', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (66, 'index salesSummaryClient', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (67, 'index salesSummaryGoods', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (68, 'index salesDetails', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (69, 'index procurementSummarySupplier', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (70, 'index procurementSummaryGoods', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (71, 'index procurementDetails', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (72, 'index salesPayment', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (73, 'add salesPayment', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (74, 'index salesReceipts', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (75, 'add salesReceipts', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (76, 'index purchaseReceipts', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (77, 'add purchaseReceipts', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (78, 'index purchasePayment', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (79, 'add purchasePayment', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (80, 'index getSaleReturn', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (81, 'status getSaleReturn', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (82, 'index getSales', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (83, 'status getSales', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (84, 'index getPurchaseReturn', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (85, 'status getPurchaseReturn', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (86, 'index getPurchase', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (87, 'status getPurchase', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (88, 'index inventory', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (89, 'index allocation', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (90, 'add allocation', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (91, 'index saleReturn', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (92, 'add saleReturn', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (93, 'index sale', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (94, 'add sale', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (95, 'index purchaseReturns', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (96, 'add purchaseReturns', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (97, 'index purchase', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (98, 'add purchase', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (99, 'index log', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (100, 'index user', 'web', '2019-02-13 19:11:56', '2019-02-13 19:14:09');
INSERT INTO `erp_permissions` VALUES (101, 'add user', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (102, 'edit user', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (103, 'delete user', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (104, 'status user', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (105, 'user permission', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (106, 'index system', 'web', '2019-02-13 19:11:56', '2019-02-13 19:11:56');
INSERT INTO `erp_permissions` VALUES (107, 'index index', 'web', '2019-03-09 19:53:57', '2019-02-13 19:54:00');

-- ----------------------------
-- Table structure for erp_purchase_extends
-- ----------------------------
DROP TABLE IF EXISTS `erp_purchase_extends`;
CREATE TABLE `erp_purchase_extends`  (
  `purchase_id` int(10) UNSIGNED NOT NULL COMMENT '//关联的购货的id',
  `goods_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//商品名称',
  `goods_id` int(10) UNSIGNED NOT NULL COMMENT '//商品的id',
  `warehouse_id` int(11) NOT NULL COMMENT '//仓库的id',
  `company` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//单位',
  `number` int(10) UNSIGNED NOT NULL COMMENT '//购货的数量',
  `unit_purchase_price` decimal(10, 2) UNSIGNED NOT NULL COMMENT '//购货单价',
  `discount_rate` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '//折扣率',
  `purchase_amount` decimal(10, 2) UNSIGNED NOT NULL COMMENT '//购货金额'
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_purchase_extends
-- ----------------------------
INSERT INTO `erp_purchase_extends` VALUES (51, 'thinkpad电脑', 49, 16, '台', 100, 9999.00, 0, 999900.00);
INSERT INTO `erp_purchase_extends` VALUES (52, '奥特曼玩具', 51, 16, '个', 100, 100.00, 0, 10000.00);
INSERT INTO `erp_purchase_extends` VALUES (52, '惠普电脑', 50, 17, '台', 10, 9999.00, 0, 99990.00);
INSERT INTO `erp_purchase_extends` VALUES (53, '奥特曼玩具', 51, 19, '个', 10, 100.00, 0, 1000.00);
INSERT INTO `erp_purchase_extends` VALUES (54, 'thinkpad电脑', 49, 18, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_purchase_extends` VALUES (59, 'thinkpad电脑', 49, 20, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_purchase_extends` VALUES (60, 'thinkpad电脑', 49, 16, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_purchase_extends` VALUES (61, 'thinkpad电脑', 49, 20, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_purchase_extends` VALUES (62, 'thinkpad电脑', 49, 20, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_purchase_extends` VALUES (63, 'thinkpad电脑', 49, 20, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_purchase_extends` VALUES (64, 'thinkpad电脑', 49, 16, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_purchase_extends` VALUES (65, 'thinkpad电脑', 49, 16, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_purchase_extends` VALUES (66, 'thinkpad电脑', 49, 21, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_purchase_extends` VALUES (67, 'thinkpad电脑', 49, 18, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_purchase_extends` VALUES (68, 'thinkpad电脑', 49, 18, '台', 1, 9999.00, 0, 9999.00);

-- ----------------------------
-- Table structure for erp_purchasereturn_extends
-- ----------------------------
DROP TABLE IF EXISTS `erp_purchasereturn_extends`;
CREATE TABLE `erp_purchasereturn_extends`  (
  `purchase_id` int(10) UNSIGNED NOT NULL COMMENT '//关联的购货的id',
  `goods_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//商品名称',
  `goods_id` int(10) UNSIGNED NOT NULL COMMENT '//商品的id',
  `warehouse_id` int(11) NOT NULL COMMENT '//仓库的id',
  `company` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//单位',
  `number` int(10) UNSIGNED NOT NULL COMMENT '//购货的数量',
  `unit_purchase_price` decimal(10, 2) UNSIGNED NOT NULL COMMENT '//购货单价',
  `discount_rate` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '//折扣率',
  `purchase_amount` decimal(10, 2) UNSIGNED NOT NULL COMMENT '//购货金额'
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_purchasereturn_extends
-- ----------------------------
INSERT INTO `erp_purchasereturn_extends` VALUES (40, 'thinkpad电脑', 49, 16, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_purchasereturn_extends` VALUES (41, '惠普电脑', 50, 17, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_purchasereturn_extends` VALUES (42, 'thinkpad电脑', 49, 16, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_purchasereturn_extends` VALUES (44, 'thinkpad电脑', 49, 20, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_purchasereturn_extends` VALUES (45, 'thinkpad电脑', 49, 20, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_purchasereturn_extends` VALUES (46, 'thinkpad电脑', 49, 20, '台', 2, 9999.00, 0, 19998.00);
INSERT INTO `erp_purchasereturn_extends` VALUES (47, '惠普电脑', 50, 17, '台', 1, 9999.00, 0, 9999.00);

-- ----------------------------
-- Table structure for erp_purchasereturns
-- ----------------------------
DROP TABLE IF EXISTS `erp_purchasereturns`;
CREATE TABLE `erp_purchasereturns`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `document_number` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//单据编号',
  `supplier_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//供应商名称',
  `supplier_id` int(10) UNSIGNED NOT NULL COMMENT '//供应商id',
  `preferential_rate` tinyint(3) UNSIGNED NULL DEFAULT 0 COMMENT '//优惠率',
  `paid` decimal(10, 2) UNSIGNED NULL DEFAULT 0.00 COMMENT '//已付款',
  `settlement_account` int(11) UNSIGNED NULL DEFAULT NULL COMMENT '//结算账号',
  `details` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '//备注信息',
  `user_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '//制单人',
  `user_id` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '//制单人id',
  `status` tinyint(1) UNSIGNED NULL DEFAULT 1,
  `total_amount` decimal(10, 2) NULL DEFAULT 0.00,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_purchasereturns
-- ----------------------------
INSERT INTO `erp_purchasereturns` VALUES (40, 'TH20190112170050', '网易云供应商', 31, 0, 9999.00, 2, NULL, 'admin', 1, 2, 9999.00, '2019-01-16 10:20:43', '2019-01-12 17:00:50');
INSERT INTO `erp_purchasereturns` VALUES (41, 'TH20190112170257', '网易云供应商', 31, 0, 999.00, 3, NULL, 'admin', 1, 2, 9999.00, '2019-01-16 10:20:50', '2019-01-12 17:02:57');
INSERT INTO `erp_purchasereturns` VALUES (42, 'TH20190122115750', '网易云供应商', 31, 0, 0.00, 4, NULL, 'admin', 1, 1, 9999.00, '2019-01-22 11:57:50', '2019-01-22 11:57:50');
INSERT INTO `erp_purchasereturns` VALUES (44, 'TH20190201101545', 'thinkpad供应商', 33, 0, 9999.00, 2, '1.......', 'admin', 1, 2, 9999.00, '2019-02-07 19:25:26', '2019-02-01 10:15:45');
INSERT INTO `erp_purchasereturns` VALUES (45, 'TH20190201111859', 'pad供应商', 34, 0, 9999.00, 4, NULL, 'admin', 1, 1, 9999.00, '2019-02-01 11:19:00', '2019-02-01 11:19:00');
INSERT INTO `erp_purchasereturns` VALUES (46, 'TH20190201112429', 'pad供应商', 34, 0, 19998.00, 2, NULL, 'admin', 1, 1, 19998.00, '2019-02-01 11:24:29', '2019-02-01 11:24:29');
INSERT INTO `erp_purchasereturns` VALUES (47, 'TH20190207114723', '网易云供应商', 31, 90, 0.00, 2, NULL, 'admin', 1, 1, 8999.10, '2019-02-07 11:47:23', '2019-02-07 11:47:23');

-- ----------------------------
-- Table structure for erp_purchases
-- ----------------------------
DROP TABLE IF EXISTS `erp_purchases`;
CREATE TABLE `erp_purchases`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `document_number` char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//单据编号',
  `supplier_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//供应商名称',
  `supplier_id` int(10) UNSIGNED NOT NULL COMMENT '//供应商id',
  `preferential_rate` tinyint(3) UNSIGNED NULL DEFAULT 0 COMMENT '//优惠率',
  `paid` decimal(10, 2) UNSIGNED NULL DEFAULT 0.00 COMMENT '//已付款',
  `settlement_account` int(11) UNSIGNED NULL DEFAULT NULL COMMENT '//结算账号',
  `details` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '//备注信息',
  `user_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '//制单人',
  `user_id` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '//制单人id',
  `status` tinyint(4) NULL DEFAULT 1,
  `total_amount` decimal(10, 2) UNSIGNED NULL DEFAULT 0.00,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 69 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_purchases
-- ----------------------------
INSERT INTO `erp_purchases` VALUES (51, 'CG20190112165817', '网易云供应商', 31, 0, 0.00, 3, NULL, 'admin', 1, 2, 999900.00, '2019-01-12 20:35:26', '2019-01-12 16:58:17');
INSERT INTO `erp_purchases` VALUES (52, 'CG20190112165851', '网易云供应商', 31, 0, 109990.00, 2, NULL, 'admin', 1, 2, 109990.00, '2019-01-12 20:35:29', '2019-01-12 16:58:51');
INSERT INTO `erp_purchases` VALUES (53, 'CG20190112165916', '阿里巴巴供应商', 30, 0, 100.00, 2, NULL, 'admin', 1, 2, 1000.00, '2019-01-12 20:35:30', '2019-01-12 16:59:16');
INSERT INTO `erp_purchases` VALUES (54, 'CG20190122115235', '网易云供应商', 31, 0, 9999.00, 5, NULL, 'admin', 1, 2, 9999.00, '2019-02-07 16:53:47', '2019-01-22 11:52:35');
INSERT INTO `erp_purchases` VALUES (59, 'CG20190201100726', 'thinkpad供应商', 33, 0, 9999.00, 2, NULL, 'admin', 1, 2, 9999.00, '2019-02-01 10:11:27', '2019-02-01 10:07:27');
INSERT INTO `erp_purchases` VALUES (60, 'CG20190201111730', '腾讯供应商', 29, 0, 9999.00, 2, NULL, 'admin', 1, 2, 9999.00, '2019-02-01 11:17:42', '2019-02-01 11:17:30');
INSERT INTO `erp_purchases` VALUES (61, 'CG20190201111805', 'pad供应商', 34, 0, 9999.00, 4, NULL, 'admin', 1, 2, 9999.00, '2019-02-01 11:18:45', '2019-02-01 11:18:05');
INSERT INTO `erp_purchases` VALUES (62, 'CG20190201112033', 'pad供应商', 34, 0, 9999.00, 2, NULL, 'admin', 1, 2, 9999.00, '2019-02-01 11:23:52', '2019-02-01 11:20:33');
INSERT INTO `erp_purchases` VALUES (63, 'CG20190201112310', 'pad供应商', 34, 0, 9999.00, 2, NULL, 'admin', 1, 2, 9999.00, '2019-02-01 11:23:50', '2019-02-01 11:23:10');
INSERT INTO `erp_purchases` VALUES (64, 'CG20190207113414', '网易云供应商', 31, 0, 0.00, 2, NULL, 'admin', 1, 2, 9999.00, '2019-02-15 20:24:58', '2019-02-07 11:34:14');
INSERT INTO `erp_purchases` VALUES (65, 'CG20190207113747', '阿里巴巴供应商', 30, 90, 0.00, 2, NULL, 'admin', 1, 1, 8999.10, '2019-02-07 11:37:47', '2019-02-07 11:37:47');
INSERT INTO `erp_purchases` VALUES (66, 'CG20190207183112', '网易云供应商', 31, 0, 0.00, 2, NULL, 'admin', 1, 1, 9999.00, '2019-02-07 18:31:12', '2019-02-07 18:31:12');
INSERT INTO `erp_purchases` VALUES (67, 'CG20190207183218', '网易云供应商', 31, 0, 9999.00, 2, NULL, 'admin', 1, 1, 9999.00, '2019-02-07 18:32:18', '2019-02-07 18:32:18');
INSERT INTO `erp_purchases` VALUES (68, 'CG20190207183455', '网易云供应商', 31, 0, 100.00, 2, NULL, 'admin', 1, 1, 9999.00, '2019-02-07 18:34:56', '2019-02-07 18:34:56');

-- ----------------------------
-- Table structure for erp_role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `erp_role_has_permissions`;
CREATE TABLE `erp_role_has_permissions`  (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `erp_permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `erp_roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for erp_roles
-- ----------------------------
DROP TABLE IF EXISTS `erp_roles`;
CREATE TABLE `erp_roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for erp_salereturn_extends
-- ----------------------------
DROP TABLE IF EXISTS `erp_salereturn_extends`;
CREATE TABLE `erp_salereturn_extends`  (
  `sales_id` int(10) UNSIGNED NOT NULL COMMENT '//关联的购货的id',
  `goods_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//商品名称',
  `goods_id` int(10) UNSIGNED NOT NULL COMMENT '//商品的id',
  `warehouse_id` int(11) NOT NULL COMMENT '//仓库的id',
  `company` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//单位',
  `number` int(10) UNSIGNED NOT NULL COMMENT '//购货的数量',
  `unit_purchase_price` decimal(10, 2) UNSIGNED NOT NULL COMMENT '//购货单价',
  `discount_rate` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '//折扣率',
  `purchase_amount` decimal(10, 2) UNSIGNED NOT NULL COMMENT '//购货金额'
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_salereturn_extends
-- ----------------------------
INSERT INTO `erp_salereturn_extends` VALUES (41, 'thinkpad电脑', 49, 22, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_salereturn_extends` VALUES (47, 'thinkpad电脑', 49, 17, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_salereturn_extends` VALUES (48, 'thinkpad电脑', 49, 16, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_salereturn_extends` VALUES (49, 'thinkpad电脑', 49, 16, '台', 1, 9999.00, 0, 9999.00);

-- ----------------------------
-- Table structure for erp_salereturns
-- ----------------------------
DROP TABLE IF EXISTS `erp_salereturns`;
CREATE TABLE `erp_salereturns`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `document_number` char(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//单据编号',
  `client_name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//客户名称',
  `client_id` int(20) UNSIGNED NOT NULL COMMENT '//客户id',
  `preferential_rate` tinyint(3) UNSIGNED NULL DEFAULT 0 COMMENT '//优惠率',
  `paid` decimal(10, 2) UNSIGNED NULL DEFAULT 0.00 COMMENT '//已付款',
  `settlement_account` int(11) UNSIGNED NULL DEFAULT NULL COMMENT '//结算账号',
  `details` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '//备注信息',
  `user_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '//制单人',
  `user_id` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '//制单人id',
  `staff_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//销售人员',
  `staff_id` int(10) UNSIGNED NOT NULL COMMENT '//销售人员id',
  `status` tinyint(3) UNSIGNED NULL DEFAULT 1,
  `total_amount` decimal(10, 2) NULL DEFAULT 0.00,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_salereturns
-- ----------------------------
INSERT INTO `erp_salereturns` VALUES (41, 'XHTH20190112173941', '腾讯客户', 4, 0, 100.00, 2, NULL, '临时制单人', 1, '职员04号', 9, 2, 9999.00, '2019-01-16 10:59:20', '2019-01-12 17:39:41');
INSERT INTO `erp_salereturns` VALUES (47, 'XHTH20190122121405', '腾讯客户', 4, 0, 9999.00, 2, NULL, 'admin', 1, '职员03号', 8, 2, 9999.00, '2019-02-11 11:10:00', '2019-01-22 12:14:05');
INSERT INTO `erp_salereturns` VALUES (48, 'XHTH20190201102036', '腾讯客户', 4, 0, 0.00, 2, NULL, 'admin', 1, '职员02号', 7, 1, 9999.00, '2019-02-01 10:20:36', '2019-02-01 10:20:36');
INSERT INTO `erp_salereturns` VALUES (49, 'XHTH20190207125709', '腾讯客户', 4, 90, 0.00, 2, NULL, 'admin', 1, '职员04号', 9, 1, 8999.10, '2019-02-07 12:57:09', '2019-02-07 12:57:09');

-- ----------------------------
-- Table structure for erp_sales
-- ----------------------------
DROP TABLE IF EXISTS `erp_sales`;
CREATE TABLE `erp_sales`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `document_number` char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//单据编号',
  `client_name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//客户名称',
  `client_id` int(20) UNSIGNED NOT NULL COMMENT '//客户id',
  `preferential_rate` tinyint(3) UNSIGNED NULL DEFAULT 0 COMMENT '//优惠率',
  `paid` decimal(10, 2) UNSIGNED NULL DEFAULT 0.00 COMMENT '//已付款',
  `settlement_account` int(11) UNSIGNED NULL DEFAULT NULL COMMENT '//结算账号',
  `details` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '//备注信息',
  `user_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '//制单人',
  `user_id` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '//制单人id',
  `staff_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//销售人员',
  `staff_id` int(10) UNSIGNED NOT NULL COMMENT '//销售人员id',
  `status` tinyint(1) UNSIGNED NULL DEFAULT 1,
  `total_amount` decimal(10, 2) NULL DEFAULT 0.00,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_sales
-- ----------------------------
INSERT INTO `erp_sales` VALUES (37, 'XH20190112173346', '腾讯客户', 4, 0, 9999.00, 2, NULL, '临时制单人', 1, '职员03号', 8, 2, 9999.00, '2019-02-10 09:33:30', '2019-01-12 17:33:46');
INSERT INTO `erp_sales` VALUES (38, 'XH20190112173516', '腾讯客户', 4, 0, 19998.00, 2, NULL, '临时制单人', 1, '职员04号', 9, 2, 19998.00, '2019-01-16 10:39:12', '2019-01-12 17:35:16');
INSERT INTO `erp_sales` VALUES (39, 'XH20190122120037', '腾讯客户', 4, 0, 9000.00, 3, NULL, 'admin', 1, '职员05号', 10, 1, 9999.00, '2019-01-22 12:00:37', '2019-01-22 12:00:37');
INSERT INTO `erp_sales` VALUES (40, 'XH20190122120113', '阿里巴巴客户', 3, 0, 0.00, 2, NULL, 'admin', 1, '职员04号', 9, 1, 10099.00, '2019-01-22 12:01:13', '2019-01-22 12:01:13');
INSERT INTO `erp_sales` VALUES (41, 'XH20190201101953', '腾讯客户', 4, 0, 9999.00, 2, NULL, 'admin', 1, '职员04号', 9, 1, 9999.00, '2019-02-01 10:19:53', '2019-02-01 10:19:53');
INSERT INTO `erp_sales` VALUES (42, 'XH20190207122543', '腾讯客户', 4, 90, 0.00, 2, NULL, 'admin', 1, '职员03号', 8, 1, 8999.10, '2019-02-07 12:25:43', '2019-02-07 12:25:43');

-- ----------------------------
-- Table structure for erp_sales_extends
-- ----------------------------
DROP TABLE IF EXISTS `erp_sales_extends`;
CREATE TABLE `erp_sales_extends`  (
  `sales_id` int(10) UNSIGNED NOT NULL COMMENT '//关联的购货的id',
  `goods_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//商品名称',
  `goods_id` int(10) UNSIGNED NOT NULL COMMENT '//商品的id',
  `warehouse_id` int(11) NOT NULL COMMENT '//仓库的id',
  `company` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '//单位',
  `number` int(10) UNSIGNED NOT NULL COMMENT '//购货的数量',
  `unit_purchase_price` decimal(10, 2) UNSIGNED NOT NULL COMMENT '//购货单价',
  `discount_rate` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '//折扣率',
  `purchase_amount` decimal(10, 2) UNSIGNED NOT NULL COMMENT '//购货金额'
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_sales_extends
-- ----------------------------
INSERT INTO `erp_sales_extends` VALUES (37, '惠普电脑', 50, 17, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_sales_extends` VALUES (38, '惠普电脑', 50, 17, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_sales_extends` VALUES (38, 'thinkpad电脑', 49, 16, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_sales_extends` VALUES (39, 'thinkpad电脑', 49, 16, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_sales_extends` VALUES (40, 'thinkpad电脑', 49, 16, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_sales_extends` VALUES (40, '奥特曼玩具', 51, 16, '个', 1, 100.00, 0, 100.00);
INSERT INTO `erp_sales_extends` VALUES (41, 'thinkpad电脑', 49, 16, '台', 1, 9999.00, 0, 9999.00);
INSERT INTO `erp_sales_extends` VALUES (42, 'thinkpad电脑', 49, 16, '台', 1, 9999.00, 0, 9999.00);

-- ----------------------------
-- Table structure for erp_settlements
-- ----------------------------
DROP TABLE IF EXISTS `erp_settlements`;
CREATE TABLE `erp_settlements`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_settlements
-- ----------------------------
INSERT INTO `erp_settlements` VALUES (8, '支付宝支付', '2018-12-20 11:09:28', '2018-12-20 17:59:13');
INSERT INTO `erp_settlements` VALUES (9, '微信支付', '2018-12-20 11:09:36', '2018-12-20 11:09:46');
INSERT INTO `erp_settlements` VALUES (10, '现金支付', '2018-12-20 11:09:38', '2018-12-20 11:09:49');
INSERT INTO `erp_settlements` VALUES (11, '工商支付', '2018-12-20 11:09:41', '2018-12-20 17:27:40');

-- ----------------------------
-- Table structure for erp_staffs
-- ----------------------------
DROP TABLE IF EXISTS `erp_staffs`;
CREATE TABLE `erp_staffs`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `number` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_staffs
-- ----------------------------
INSERT INTO `erp_staffs` VALUES (6, '0001', '职员01号', 2, '2019-01-06 19:27:49', '2018-12-21 19:45:56');
INSERT INTO `erp_staffs` VALUES (7, '0002', '职员02号', 1, '2019-02-15 20:09:39', '2018-12-21 19:46:06');
INSERT INTO `erp_staffs` VALUES (8, '0003', '职员03号', 1, '2018-12-21 20:32:08', '2018-12-21 19:46:15');
INSERT INTO `erp_staffs` VALUES (9, '0004', '职员04号', 1, '2018-12-21 20:44:47', '2018-12-21 19:46:23');
INSERT INTO `erp_staffs` VALUES (10, '0005', '职员05号', 1, '2018-12-21 21:25:46', '2018-12-21 19:46:32');

-- ----------------------------
-- Table structure for erp_suppliermanagement_extends
-- ----------------------------
DROP TABLE IF EXISTS `erp_suppliermanagement_extends`;
CREATE TABLE `erp_suppliermanagement_extends`  (
  `s_id` int(10) UNSIGNED NOT NULL,
  `contacts` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `landline` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `qq` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  INDEX `FK_s_id`(`s_id`) USING BTREE,
  CONSTRAINT `FK_s_id` FOREIGN KEY (`s_id`) REFERENCES `erp_suppliermanagements` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_suppliermanagement_extends
-- ----------------------------
INSERT INTO `erp_suppliermanagement_extends` VALUES (29, '马化腾', '11929127182', '11929127121', '1192912718', '北京....');
INSERT INTO `erp_suppliermanagement_extends` VALUES (30, '马云', '11518320351', '11518320351', '1151832035', '北京....');
INSERT INTO `erp_suppliermanagement_extends` VALUES (31, 'test01', '18076596567', '18076596567', '1807659656', '北京....');
INSERT INTO `erp_suppliermanagement_extends` VALUES (32, 'test02', '22121333444', '22121333444', '2212133344', '北京....');
INSERT INTO `erp_suppliermanagement_extends` VALUES (33, 'thinkpad负责人', '12189787676', '12189787676', '1218978767', '北京....');
INSERT INTO `erp_suppliermanagement_extends` VALUES (34, 'test03', '18165386363', '18165386364', '1816538636', '北京....');

-- ----------------------------
-- Table structure for erp_suppliermanagements
-- ----------------------------
DROP TABLE IF EXISTS `erp_suppliermanagements`;
CREATE TABLE `erp_suppliermanagements`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `number` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `balance_date` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `initial_payable` decimal(8, 2) NOT NULL,
  `initial_advance_payment` decimal(8, 2) NOT NULL,
  `rate` tinyint(4) NOT NULL,
  `status` tinyint(1) NULL DEFAULT 1,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_type`(`type`) USING BTREE,
  CONSTRAINT `FK_type` FOREIGN KEY (`type`) REFERENCES `erp_suppliers` (`name`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_suppliermanagements
-- ----------------------------
INSERT INTO `erp_suppliermanagements` VALUES (29, '00001', '腾讯供应商', '键盘供应商', '2018-12-26 00:00:00', 10000.00, 10000.00, 10, 1, '2018-12-30 04:50:22', '2018-12-30 04:50:22');
INSERT INTO `erp_suppliermanagements` VALUES (30, '00002', '阿里巴巴供应商', '电脑供应商', '2018-12-13 00:00:00', 0.00, 0.00, 10, 1, '2018-12-30 04:51:08', '2018-12-30 04:51:08');
INSERT INTO `erp_suppliermanagements` VALUES (31, '00003', '网易云供应商', '鼠标供应商', '2018-12-04 00:00:00', 0.00, 0.00, 10, 1, '2018-12-30 04:52:04', '2018-12-30 04:52:04');
INSERT INTO `erp_suppliermanagements` VALUES (32, '00004', '百度供应商', '云服务供应商', '2018-12-30 00:00:00', 0.00, 0.00, 10, 1, '2018-12-30 04:53:08', '2018-12-30 04:53:08');
INSERT INTO `erp_suppliermanagements` VALUES (33, '00005', 'thinkpad供应商', '椅子供应商', '2018-11-28 00:00:00', 0.00, 0.00, 10, 1, '2018-12-30 04:54:00', '2018-12-30 04:54:00');
INSERT INTO `erp_suppliermanagements` VALUES (34, '00006', 'pad供应商', '鼠标供应商', '2019-01-05 19:49:28', 0.00, 0.00, 0, 1, '2018-12-30 04:54:56', '2018-12-30 04:54:56');

-- ----------------------------
-- Table structure for erp_suppliers
-- ----------------------------
DROP TABLE IF EXISTS `erp_suppliers`;
CREATE TABLE `erp_suppliers`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_suppliers
-- ----------------------------
INSERT INTO `erp_suppliers` VALUES (46, '键盘供应商', '2018-12-20 21:02:54', '2018-12-20 21:02:54');
INSERT INTO `erp_suppliers` VALUES (48, '电脑供应商', '2018-12-20 21:03:13', '2018-12-20 21:03:13');
INSERT INTO `erp_suppliers` VALUES (49, '鼠标供应商', '2018-12-20 21:03:39', '2018-12-20 21:03:39');
INSERT INTO `erp_suppliers` VALUES (50, '椅子供应商', '2018-12-20 21:04:06', '2018-12-20 21:04:06');
INSERT INTO `erp_suppliers` VALUES (51, '云服务供应商', '2018-12-20 21:04:30', '2018-12-20 21:04:30');

-- ----------------------------
-- Table structure for erp_system_parameter
-- ----------------------------
DROP TABLE IF EXISTS `erp_system_parameter`;
CREATE TABLE `erp_system_parameter`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fax` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `zip_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `standard_currency` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `inventory_valuation_method` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_system_parameter
-- ----------------------------
INSERT INTO `erp_system_parameter` VALUES (1, 'Yang-ERP', '广西壮族自治区桂林市', '17687410790', '434654645322', '529836', 'RMB', '移动平均法');

-- ----------------------------
-- Table structure for erp_users
-- ----------------------------
DROP TABLE IF EXISTS `erp_users`;
CREATE TABLE `erp_users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `real_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_users
-- ----------------------------
INSERT INTO `erp_users` VALUES (1, 'admin', '1151832035@qq.com', '小阳', '17687410790', '$2y$10$460W.1gE3ChT2bKPoJbWT.DPTwu7cJzqNafuJwiSZkNG8K9UBrk0a', 'O4e0FEQfIB21EH9Ygg7kn8j4nlvGVrRPDU4l6UNSjf4WGTvDkyvow1HD0XQ0', '2019-01-11 15:17:21', '2019-01-11 15:17:23');
INSERT INTO `erp_users` VALUES (3, 'admin01', '1151832095@qq.com', '小明', '18777327245', '$2y$10$6G7NX9RBoqw46.L6hnyfpeIuEoUjvzLzAfvrvfeErijxE31mpu2GW', 'qK1mGlYM6673XkgtqBc57GWhs5tOe2q0EdjG1wIIUQZTK5g2BJcXKK6sXvSw', '2019-02-13 11:55:20', '2019-02-13 11:55:20');

-- ----------------------------
-- Table structure for erp_warehouse_goods_number
-- ----------------------------
DROP TABLE IF EXISTS `erp_warehouse_goods_number`;
CREATE TABLE `erp_warehouse_goods_number`  (
  `warehouse_id` int(10) UNSIGNED NOT NULL,
  `goods_id` int(11) NOT NULL,
  `number` int(10) UNSIGNED NULL DEFAULT 0
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_warehouse_goods_number
-- ----------------------------
INSERT INTO `erp_warehouse_goods_number` VALUES (16, 49, 95);
INSERT INTO `erp_warehouse_goods_number` VALUES (16, 51, 98);
INSERT INTO `erp_warehouse_goods_number` VALUES (17, 50, 6);
INSERT INTO `erp_warehouse_goods_number` VALUES (19, 51, 10);
INSERT INTO `erp_warehouse_goods_number` VALUES (22, 49, 1);
INSERT INTO `erp_warehouse_goods_number` VALUES (19, 50, 2);
INSERT INTO `erp_warehouse_goods_number` VALUES (21, 51, 1);
INSERT INTO `erp_warehouse_goods_number` VALUES (21, 49, 1);
INSERT INTO `erp_warehouse_goods_number` VALUES (18, 49, 1);
INSERT INTO `erp_warehouse_goods_number` VALUES (17, 49, 1);

-- ----------------------------
-- Table structure for erp_warehouses
-- ----------------------------
DROP TABLE IF EXISTS `erp_warehouses`;
CREATE TABLE `erp_warehouses`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `number` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of erp_warehouses
-- ----------------------------
INSERT INTO `erp_warehouses` VALUES (16, '00001', '北京仓库', 1, '2019-02-15 20:24:05', '2019-02-15 20:02:03');
INSERT INTO `erp_warehouses` VALUES (17, '00002', '深圳仓库', 1, '2019-01-20 12:20:22', '2018-12-21 21:06:15');
INSERT INTO `erp_warehouses` VALUES (18, '00003', '南京仓库', 1, '2018-12-22 11:22:45', '2018-12-21 21:06:35');
INSERT INTO `erp_warehouses` VALUES (19, '00004', '杭州仓库', 1, '2019-01-20 12:20:20', '2018-12-21 21:06:49');
INSERT INTO `erp_warehouses` VALUES (20, '00005', '广州仓库', 1, '2019-01-20 12:20:19', '2018-12-21 21:07:07');
INSERT INTO `erp_warehouses` VALUES (21, '00006', '贵州仓库', 1, '2018-12-22 11:23:17', '2018-12-21 21:07:21');
INSERT INTO `erp_warehouses` VALUES (22, '00007', '桂林仓库', 1, '2018-12-22 11:23:17', '2018-12-21 21:07:37');

SET FOREIGN_KEY_CHECKS = 1;
