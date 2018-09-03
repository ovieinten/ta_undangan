/*
 Navicat Premium Data Transfer

 Source Server         : db_connection
 Source Server Type    : MySQL
 Source Server Version : 100128
 Source Host           : localhost:3306
 Source Schema         : ta_undangan

 Target Server Type    : MySQL
 Target Server Version : 100128
 File Encoding         : 65001

 Date: 13/07/2018 10:47:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for carts
-- ----------------------------
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `categories_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cities
-- ----------------------------
DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities`  (
  `id` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cities_province_id_foreign`(`province_id`) USING BTREE,
  CONSTRAINT `cities_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for colors
-- ----------------------------
DROP TABLE IF EXISTS `colors`;
CREATE TABLE `colors`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `colors_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `body` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for core_locations
-- ----------------------------
DROP TABLE IF EXISTS `core_locations`;
CREATE TABLE `core_locations`  (
  `location_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `location_parent_id` bigint(20) NULL DEFAULT NULL,
  `location_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_shortname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `location_postcode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `location_type` enum('provinsi','kota/kabupaten','kecamatan','desa/kelurahan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `location_latitude` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `location_longitude` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `location_created_at` timestamp(0) NULL DEFAULT NULL,
  `location_updated_at` timestamp(0) NULL DEFAULT NULL,
  `location_deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`location_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for creation_photos
-- ----------------------------
DROP TABLE IF EXISTS `creation_photos`;
CREATE TABLE `creation_photos`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `creation_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `creation_photos_creation_id_foreign`(`creation_id`) USING BTREE,
  CONSTRAINT `creation_photos_creation_id_foreign` FOREIGN KEY (`creation_id`) REFERENCES `creations` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for creations
-- ----------------------------
DROP TABLE IF EXISTS `creations`;
CREATE TABLE `creations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint(20) NOT NULL DEFAULT 0,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shape_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('sent','draft','trash') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sent',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `creations_slug_unique`(`slug`) USING BTREE,
  INDEX `creations_color_id_foreign`(`color_id`) USING BTREE,
  INDEX `creations_size_id_foreign`(`size_id`) USING BTREE,
  INDEX `creations_shape_id_foreign`(`shape_id`) USING BTREE,
  CONSTRAINT `creations_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `creations_shape_id_foreign` FOREIGN KEY (`shape_id`) REFERENCES `shapes` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `creations_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for discounts
-- ----------------------------
DROP TABLE IF EXISTS `discounts`;
CREATE TABLE `discounts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `percent` bigint(20) NOT NULL DEFAULT 0,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `discounts_product_id_foreign`(`product_id`) USING BTREE,
  CONSTRAINT `discounts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for districts
-- ----------------------------
DROP TABLE IF EXISTS `districts`;
CREATE TABLE `districts`  (
  `id` char(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `districts_city_id_foreign`(`city_id`) USING BTREE,
  CONSTRAINT `districts_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2016_08_03_072729_create_provinces_table', 1);
INSERT INTO `migrations` VALUES (4, '2016_08_03_072750_create_cities_table', 1);
INSERT INTO `migrations` VALUES (5, '2016_08_03_072804_create_districts_table', 1);
INSERT INTO `migrations` VALUES (6, '2016_08_03_072819_create_villages_table', 1);
INSERT INTO `migrations` VALUES (7, '2018_05_16_153135_create_product_categories_table', 1);
INSERT INTO `migrations` VALUES (8, '2018_05_25_045909_create_sizes_table', 1);
INSERT INTO `migrations` VALUES (9, '2018_05_25_072750_create_colors_table', 1);
INSERT INTO `migrations` VALUES (10, '2018_06_01_153639_create_shapes_table', 1);
INSERT INTO `migrations` VALUES (11, '2018_06_03_031438_create_products_table', 1);
INSERT INTO `migrations` VALUES (12, '2018_06_09_015839_create_creations_table', 1);
INSERT INTO `migrations` VALUES (13, '2018_06_16_122635_create_orders_table', 1);
INSERT INTO `migrations` VALUES (14, '2018_06_16_122751_create_payments_table', 1);
INSERT INTO `migrations` VALUES (15, '2018_06_16_122948_create_carts_table', 1);
INSERT INTO `migrations` VALUES (16, '2018_06_16_123054_create_comments_table', 1);
INSERT INTO `migrations` VALUES (17, '2018_06_16_123128_create_notifications_table', 1);
INSERT INTO `migrations` VALUES (18, '2018_06_16_132329_create_discounts_table', 1);
INSERT INTO `migrations` VALUES (19, '2018_06_18_065722_create_product_photos_table', 1);
INSERT INTO `migrations` VALUES (20, '2018_06_20_014517_create_ratings_table', 1);
INSERT INTO `migrations` VALUES (21, '2018_06_24_042702_create_pages_table', 1);
INSERT INTO `migrations` VALUES (22, '2018_06_27_094004_create_locations_table', 1);
INSERT INTO `migrations` VALUES (23, '2018_06_30_035601_create_creation_photos_table', 1);
INSERT INTO `migrations` VALUES (24, '2018_07_12_150000_create_roles_table', 1);
INSERT INTO `migrations` VALUES (25, '2018_07_12_150112_add_column_role_id_to_users', 1);
INSERT INTO `migrations` VALUES (26, '2018_07_12_175941_create_sales_table', 1);

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `from_user_id` bigint(20) UNSIGNED NOT NULL,
  `to_user_id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `read_at` datetime(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `responsible_user_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `village` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `regence` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_total` bigint(20) NOT NULL DEFAULT 0,
  `discount_total` bigint(20) NOT NULL DEFAULT 0,
  `grand_total` bigint(20) NOT NULL DEFAULT 0,
  `qty` bigint(20) NOT NULL DEFAULT 0,
  `date` datetime(0) NULL DEFAULT NULL,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('payment confirmed','packaging','shipped out','order delivered','cancel') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'payment confirmed',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `orders_order_number_unique`(`order_number`) USING BTREE,
  UNIQUE INDEX `orders_slug_unique`(`slug`) USING BTREE,
  INDEX `orders_product_id_foreign`(`product_id`) USING BTREE,
  INDEX `orders_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `orders_responsible_user_id_foreign`(`responsible_user_id`) USING BTREE,
  CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `orders_responsible_user_id_foreign` FOREIGN KEY (`responsible_user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `is_home` tinyint(1) NOT NULL DEFAULT 1,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `pages_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for payments
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `confirm_user_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `payments_order_id_unique`(`order_id`) USING BTREE,
  INDEX `payments_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `payments_confirm_user_id_foreign`(`confirm_user_id`) USING BTREE,
  CONSTRAINT `payments_confirm_user_id_foreign` FOREIGN KEY (`confirm_user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for product_photos
-- ----------------------------
DROP TABLE IF EXISTS `product_photos`;
CREATE TABLE `product_photos`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_photos_product_id_foreign`(`product_id`) USING BTREE,
  CONSTRAINT `product_photos_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint(20) NOT NULL DEFAULT 0,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `shape_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` enum('publish','draft','trash','archive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `note` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `products_slug_unique`(`slug`) USING BTREE,
  INDEX `products_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `products_category_id_foreign`(`category_id`) USING BTREE,
  INDEX `products_color_id_foreign`(`color_id`) USING BTREE,
  INDEX `products_size_id_foreign`(`size_id`) USING BTREE,
  INDEX `products_shape_id_foreign`(`shape_id`) USING BTREE,
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `products_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `products_shape_id_foreign` FOREIGN KEY (`shape_id`) REFERENCES `shapes` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `products_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for provinces
-- ----------------------------
DROP TABLE IF EXISTS `provinces`;
CREATE TABLE `provinces`  (
  `id` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ratings
-- ----------------------------
DROP TABLE IF EXISTS `ratings`;
CREATE TABLE `ratings`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `rateable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rateable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `ratings_rateable_type_rateable_id_index`(`rateable_type`, `rateable_id`) USING BTREE,
  INDEX `ratings_rateable_id_index`(`rateable_id`) USING BTREE,
  INDEX `ratings_rateable_type_index`(`rateable_type`) USING BTREE,
  INDEX `ratings_user_id_index`(`user_id`) USING BTREE,
  CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'operator', 'Operator', '2018-07-12 21:36:54', '2018-07-12 21:36:54');
INSERT INTO `roles` VALUES (2, 'designer', 'Designer', '2018-07-12 21:36:54', '2018-07-12 21:36:54');
INSERT INTO `roles` VALUES (3, 'customer', 'Customer', '2018-07-12 21:36:54', '2018-07-12 21:36:54');

-- ----------------------------
-- Table structure for sales
-- ----------------------------
DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(10) UNSIGNED NOT NULL,
  `paid_total` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sales_order_id_foreign`(`order_id`) USING BTREE,
  INDEX `sales_payment_id_foreign`(`payment_id`) USING BTREE,
  CONSTRAINT `sales_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `sales_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for shapes
-- ----------------------------
DROP TABLE IF EXISTS `shapes`;
CREATE TABLE `shapes`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `shapes_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for sizes
-- ----------------------------
DROP TABLE IF EXISTS `sizes`;
CREATE TABLE `sizes`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `sizes_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT 3,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `avatar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gender` enum('pria','wanita','') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `birth_place` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `birth_date` date NULL DEFAULT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  INDEX `users_role`(`role_id`) USING BTREE,
  CONSTRAINT `users_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 1, 'karlie.braun@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Alejandra', 'Lockman', 'https://lorempixel.com/640/480/?55704', 'wanita', 'Mosciskiburgh', '1988-12-31', '+1 (894) 518-1150', '8548 Boyle Mountains\nWest Kavonview, VT 36219', 'akFYjKuESU', '2018-07-12 21:36:51', '2018-07-12 21:36:51', NULL);
INSERT INTO `users` VALUES (2, 3, 'wchristiansen@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Kane', 'Balistreri', 'https://lorempixel.com/640/480/?77944', 'wanita', 'Altenwerthland', '1993-04-11', '+1-886-936-0026', '450 Kub Streets Suite 978\nPort Bernardo, CA 89690-3477', 'dIy7ZR3ggr', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (3, 1, 'bailey.myron@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Mckenna', 'Collier', 'https://lorempixel.com/640/480/?70798', 'pria', 'Odessaburgh', '1980-06-23', '1-825-745-8356', '647 White Port Suite 274\nEast German, SD 00549-2643', 'TE9MdQ1Q46', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (4, 3, 'cummerata.sylvester@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Maddison', 'Witting', 'https://lorempixel.com/640/480/?23748', 'pria', 'Harberville', '2017-01-18', '741-275-5480 x30994', '95127 Franz Points\nNew Marquisport, MI 88605-6674', 'zMty04cL8t', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (5, 2, 'ncasper@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Zelma', 'Franecki', 'https://lorempixel.com/640/480/?25786', 'pria', 'Rauhaven', '1995-11-05', '(661) 415-1510 x6789', '378 Dedric Landing\nCollinsview, WI 32306-7963', 'dbvWrUooQ2', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (6, 2, 'hans86@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Elinor', 'Wiegand', 'https://lorempixel.com/640/480/?12729', 'wanita', 'Freidaton', '1970-10-14', '873-800-9852 x6605', '788 Eloy Ports\nNevafurt, TN 91709-0220', 'YC24MWHwiC', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (7, 1, 'bechtelar.jacquelyn@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Shany', 'Towne', 'https://lorempixel.com/640/480/?39973', 'pria', 'East Maxie', '2010-04-01', '1-790-494-6955 x575', '639 Simeon Village Suite 400\nSouth Justynberg, VA 89937', '9hyrksTjRz', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (8, 3, 'jblick@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Berniece', 'Stehr', 'https://lorempixel.com/640/480/?91648', 'wanita', 'West Orlandobury', '1996-10-13', '448.413.8979 x361', '259 Troy Passage Suite 737\nWest Amiyaside, TN 51388', 'So4cwNcnjQ', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (9, 3, 'lucinda21@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Berry', 'Kessler', 'https://lorempixel.com/640/480/?70986', 'wanita', 'Laurynton', '1989-12-23', '(591) 943-3162', '1649 Roberto Courts Suite 080\nKemmerbury, NY 41376-8502', 'KjUM20DAom', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (10, 2, 'slindgren@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Matilda', 'Skiles', 'https://lorempixel.com/640/480/?52966', 'wanita', 'West Norbert', '2009-09-12', '1-990-934-9806 x76613', '67758 Halvorson Port Apt. 297\nMeredithfort, NJ 10288', 'KmdJcO7aWb', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (11, 3, 'trace75@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Mayra', 'Hagenes', 'https://lorempixel.com/640/480/?71499', 'wanita', 'Lake Briellechester', '1975-02-01', '960.417.2695 x466', '91418 Eduardo Pass Suite 779\nPort Nicolatown, UT 17230', 'JZH5hkN9EQ', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (12, 3, 'aroberts@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Tavares', 'Crooks', 'https://lorempixel.com/640/480/?21214', 'pria', 'Lake Marvinhaven', '2005-03-03', '947-551-7116', '157 Carissa Trace Suite 729\nNew Clydeton, WI 13518', '09r8zgkcGb', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (13, 3, 'kiara94@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Jordane', 'Legros', 'https://lorempixel.com/640/480/?20004', 'pria', 'East Lela', '2007-03-12', '984-755-2196 x572', '366 Cummerata Stream Apt. 988\nSouth Shemarbury, ME 46133-1973', 'mbxU8lNrs1', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (14, 2, 'fkohler@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Berry', 'Murray', 'https://lorempixel.com/640/480/?22467', 'pria', 'Lake Carolannefurt', '1996-12-12', '+1-543-962-0361', '9068 Myrtle Plaza\nWest Samir, NE 34168', 'UIW4dvbf4S', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (15, 2, 'yheller@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Nayeli', 'Lueilwitz', 'https://lorempixel.com/640/480/?91065', 'wanita', 'Devinmouth', '2002-10-09', '(616) 419-1597 x69281', '165 Osinski Pass Suite 589\nWaelchifort, GA 18560-9624', 'qRuIZvhDiJ', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (16, 3, 'lebsack.zora@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Florencio', 'Zboncak', 'https://lorempixel.com/640/480/?87384', 'pria', 'Drewmouth', '1976-06-17', '1-263-417-5006 x350', '500 Luettgen Fords Apt. 104\nVontown, GA 52457-7673', 'DDa2wOl8Nt', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (17, 2, 'delmer.buckridge@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Precious', 'Bergnaum', 'https://lorempixel.com/640/480/?57545', 'wanita', 'West Yazminstad', '2014-08-03', '459.605.9545', '10125 Macejkovic Walk\nMargotview, WI 05574-9973', 'F85BFGXVmn', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (18, 2, 'sferry@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Eryn', 'Jacobs', 'https://lorempixel.com/640/480/?31941', 'pria', 'Judgeshire', '1987-06-24', '282.690.2375 x39694', '624 Watson Heights\nEast Viviannestad, RI 67471', 'FO1EANWqm3', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (19, 2, 'skiles.luisa@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Mattie', 'Marvin', 'https://lorempixel.com/640/480/?58048', 'pria', 'East Gretchenside', '2004-11-30', '+1 (379) 290-4331', '108 Dietrich Springs Suite 216\nRohanborough, ID 05804-4117', 'QABpbWUa2a', '2018-07-12 21:36:52', '2018-07-12 21:36:52', NULL);
INSERT INTO `users` VALUES (20, 3, 'tkassulke@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Delbert', 'Grady', 'https://lorempixel.com/640/480/?26414', 'wanita', 'West Broderick', '2000-09-12', '472-412-9975', '685 Max Estates\nRusselville, AZ 89179', 'UAyVqiXJTc', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (21, 2, 'herzog.emerald@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Bertrand', 'Hickle', 'https://lorempixel.com/640/480/?99094', 'pria', 'West Haleyburgh', '1989-12-19', '949-450-5455', '114 Rosendo Isle\nSouth Anastasia, MN 15507', 'jnLyTHi7WG', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (22, 1, 'mgaylord@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Mckayla', 'Bins', 'https://lorempixel.com/640/480/?44778', 'wanita', 'North Mikel', '1982-01-03', '317.768.0698', '408 Corkery Prairie Apt. 067\nWardshire, NH 35399-5526', 'HcuR4YDApg', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (23, 2, 'lilian03@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Allison', 'Moore', 'https://lorempixel.com/640/480/?81137', 'wanita', 'Lake Onie', '2015-09-04', '(561) 769-2302', '3525 Lyla Spur Apt. 662\nHunterborough, TN 15336-7882', 'Vm8Qwek1Tu', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (24, 3, 'runolfsdottir.jana@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Syble', 'Tromp', 'https://lorempixel.com/640/480/?52793', 'wanita', 'South Devonte', '1985-04-14', '1-259-483-6804', '848 Daphnee Ford Suite 806\nTremblaystad, FL 44165-8803', 'W966tdzwcd', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (25, 2, 'lottie38@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Jessyca', 'Beier', 'https://lorempixel.com/640/480/?65758', 'pria', 'Doviemouth', '1971-02-06', '1-791-847-8602 x94241', '823 Kieran Junction\nNorth Katrina, FL 71418', '7EdbHQhJvm', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (26, 1, 'kelley80@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Lonny', 'Wyman', 'https://lorempixel.com/640/480/?91420', 'pria', 'East Marian', '1983-01-23', '1-341-996-4053 x000', '76879 Casper View\nErnestobury, CT 18696', '0IfaIAlUEv', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (27, 1, 'nbeier@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Conor', 'Krajcik', 'https://lorempixel.com/640/480/?47951', 'wanita', 'Burdetteville', '1984-03-05', '+1.436.659.3283', '183 Franecki Vista\nNorth Liam, VA 74630', 'iGfj2c1fEh', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (28, 2, 'abernathy.clyde@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Brayan', 'Zboncak', 'https://lorempixel.com/640/480/?50469', 'pria', 'South Emanuelland', '1977-05-19', '(468) 797-7965 x529', '949 Nelda Ramp Suite 590\nElsachester, ID 54553-0583', '9XoP4wxG2q', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (29, 2, 'xstamm@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Ena', 'Zemlak', 'https://lorempixel.com/640/480/?59967', 'pria', 'New Miles', '1980-08-07', '(301) 653-5073 x75536', '25518 Leo Islands\nEast Royce, OK 34278', 'K8ibWlWHnF', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (30, 1, 'carlos.runolfsdottir@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Pierce', 'Hamill', 'https://lorempixel.com/640/480/?27005', 'wanita', 'Lake Santaville', '2013-09-25', '(441) 658-0513', '593 Toy Skyway\nEstellashire, CA 17241', 'UUhYy7xTQ5', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (31, 2, 'hstrosin@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Jamil', 'Ritchie', 'https://lorempixel.com/640/480/?54996', 'wanita', 'South Laurineton', '2016-10-23', '387.991.5731 x37515', '39072 Rutherford Flat Apt. 020\nWest Izabellaville, NM 22154-9982', 'Z1SoosEPax', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (32, 1, 'little.keshaun@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Margot', 'Grimes', 'https://lorempixel.com/640/480/?51992', 'pria', 'New Gertrudeview', '1988-11-26', '449.425.9449 x2008', '29551 Johnson Run Suite 927\nBlicktown, NV 29017', 'iNyQizzN8D', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (33, 3, 'cleora94@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Violet', 'Erdman', 'https://lorempixel.com/640/480/?15806', 'pria', 'Hodkiewiczview', '1984-02-14', '+1.295.939.8500', '495 Brant Circle\nSamsonville, SD 64063-1443', '49iuEcPx8F', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (34, 3, 'kilback.alison@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Arlie', 'Schulist', 'https://lorempixel.com/640/480/?81676', 'pria', 'Dickensshire', '2017-10-25', '(936) 275-8731 x5027', '745 Eichmann Spurs Apt. 358\nLake Cyrilside, SC 88602-2423', 'zTlTFuL7Ak', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (35, 2, 'deichmann@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Fausto', 'McCullough', 'https://lorempixel.com/640/480/?65521', 'wanita', 'Ashlyfort', '2015-10-14', '1-278-921-2362 x304', '7491 Hank Meadows Suite 622\nWest Aliceville, AZ 91407-1906', 'rrk9XxeaT1', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (36, 2, 'prussel@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Alison', 'Kulas', 'https://lorempixel.com/640/480/?10378', 'pria', 'North Flostad', '1972-03-25', '+1 (837) 442-8431', '8088 Nienow Street\nNew Luna, MS 32285-0054', 'Zg6qeyfYHB', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (37, 1, 'jada.murray@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Hermann', 'Blick', 'https://lorempixel.com/640/480/?86406', 'wanita', 'Hayesshire', '2001-08-16', '203.463.3763', '9849 Stamm Square\nSmithbury, VA 64887-6501', 'BrfBbR6Ky6', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (38, 3, 'flatley.luis@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Lisandro', 'Hermiston', 'https://lorempixel.com/640/480/?28163', 'pria', 'Torpchester', '2015-11-05', '+17715150900', '244 Nader Islands Suite 945\nNew Shanna, MN 14740', 'TodBxEqumb', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (39, 3, 'ray75@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Monserrat', 'Carroll', 'https://lorempixel.com/640/480/?94153', 'wanita', 'Troyport', '2009-11-07', '+1-740-442-7023', '337 Leola Terrace\nHarveyfurt, DC 59082', 'vII5jRWC67', '2018-07-12 21:36:53', '2018-07-12 21:36:53', NULL);
INSERT INTO `users` VALUES (40, 1, 'katherine.shields@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Cynthia', 'Koepp', 'https://lorempixel.com/640/480/?85058', 'pria', 'Lake Howardstad', '2014-11-03', '1-963-261-9795 x00747', '569 Alexis Underpass\nMitchellborough, SD 71378', 'tyhl47FMCW', '2018-07-12 21:36:54', '2018-07-12 21:36:54', NULL);
INSERT INTO `users` VALUES (41, 1, 'lessie21@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Lula', 'Stiedemann', 'https://lorempixel.com/640/480/?23019', 'wanita', 'Kutchburgh', '1977-06-18', '672.366.1361 x8946', '3442 Arne Overpass Suite 002\nMcCulloughburgh, LA 63283-3355', 'BKNrEfgzb4', '2018-07-12 21:36:54', '2018-07-12 21:36:54', NULL);
INSERT INTO `users` VALUES (42, 1, 'stanton.tatum@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Violette', 'Kuhlman', 'https://lorempixel.com/640/480/?74726', 'wanita', 'Lunaberg', '1973-05-26', '590-612-2252 x7171', '7081 Effertz Radial Apt. 560\nBlickstad, NV 88510', 'mRJKpYDlcd', '2018-07-12 21:36:54', '2018-07-12 21:36:54', NULL);
INSERT INTO `users` VALUES (43, 1, 'marian.crist@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Pat', 'Brekke', 'https://lorempixel.com/640/480/?83423', 'pria', 'Keatonport', '1995-05-01', '+1-536-902-5924', '99509 Langosh Mountains Suite 385\nLake Mathew, NH 14647-9018', 'BC0CZJ2PmM', '2018-07-12 21:36:54', '2018-07-12 21:36:54', NULL);
INSERT INTO `users` VALUES (44, 2, 'lind.alessandra@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Arnold', 'Lowe', 'https://lorempixel.com/640/480/?51264', 'pria', 'Raulhaven', '2006-08-12', '1-271-655-6402 x014', '3861 Kilback Pike\nSipeschester, AL 22184', 'cA1wOYyEsW', '2018-07-12 21:36:54', '2018-07-12 21:36:54', NULL);
INSERT INTO `users` VALUES (45, 2, 'hessel.columbus@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Percival', 'Reichert', 'https://lorempixel.com/640/480/?66109', 'wanita', 'New Shaynehaven', '1990-06-18', '+1.825.522.6308', '887 Gabrielle Coves\nRohanburgh, TX 32351', 'ht2NBaYmoD', '2018-07-12 21:36:54', '2018-07-12 21:36:54', NULL);
INSERT INTO `users` VALUES (46, 1, 'javier.keebler@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Jennie', 'Weissnat', 'https://lorempixel.com/640/480/?79837', 'pria', 'North Maia', '1982-12-07', '(841) 763-3462', '1504 Sid Drive Apt. 624\nLake Darbytown, IA 95876-5863', 'T5jCl3Z8lS', '2018-07-12 21:36:54', '2018-07-12 21:36:54', NULL);
INSERT INTO `users` VALUES (47, 1, 'nakia.kreiger@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Kade', 'Herzog', 'https://lorempixel.com/640/480/?66773', 'wanita', 'Geoborough', '1993-10-16', '1-681-624-9950 x25500', '9407 Lakin Road\nNew Rhea, ND 08469', 'f5j1RpyLyO', '2018-07-12 21:36:54', '2018-07-12 21:36:54', NULL);
INSERT INTO `users` VALUES (48, 3, 'lucious.cole@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Payton', 'Beier', 'https://lorempixel.com/640/480/?67812', 'pria', 'Wilfredoberg', '1982-08-21', '867.688.2694', '892 Colt Keys\nCarmineport, LA 15819', '55OWWMQtxb', '2018-07-12 21:36:54', '2018-07-12 21:36:54', NULL);
INSERT INTO `users` VALUES (49, 2, 'ryan.carson@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Moshe', 'Bartell', 'https://lorempixel.com/640/480/?49958', 'wanita', 'Blandaside', '2002-08-13', '1-547-969-8555 x70422', '6409 Bartoletti Common Suite 488\nWelchshire, MD 39267', 'JBb8PrEnps', '2018-07-12 21:36:54', '2018-07-12 21:36:54', NULL);
INSERT INTO `users` VALUES (50, 3, 'volkman.amelia@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'Skylar', 'Gaylord', 'https://lorempixel.com/640/480/?81956', 'wanita', 'Lake Cruzmouth', '1984-12-31', '1-738-549-1363', '702 Sabina Burgs\nPort Veronica, NE 72863', '5QRh2SDmQS', '2018-07-12 21:36:54', '2018-07-12 21:36:54', NULL);

-- ----------------------------
-- Table structure for villages
-- ----------------------------
DROP TABLE IF EXISTS `villages`;
CREATE TABLE `villages`  (
  `id` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` char(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `villages_district_id_foreign`(`district_id`) USING BTREE,
  CONSTRAINT `villages_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
