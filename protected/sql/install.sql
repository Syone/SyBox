SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_page
-- ----------------------------
DROP TABLE IF EXISTS `t_page`;
CREATE TABLE `t_page` (
  `id` varchar(24) NOT NULL,
  `lang` varchar(3) NOT NULL DEFAULT '' COMMENT 'hidden',
  `title` varchar(128) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'none',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'none',
  PRIMARY KEY (`id`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of t_page
-- ----------------------------
INSERT INTO `t_page` (id, lang, title) VALUES ('404', 'en', 'Page not found');
INSERT INTO `t_page` (id, lang, title) VALUES ('404', 'fr', 'Page non trouvée');
INSERT INTO `t_page` (id, lang, title) VALUES ('about-us', 'en', 'About us');
INSERT INTO `t_page` (id, lang, title) VALUES ('about-us', 'fr', 'A propos de nous');
INSERT INTO `t_page` (id, lang, title) VALUES ('home', 'en', 'Home');
INSERT INTO `t_page` (id, lang, title) VALUES ('home', 'fr', 'Accueil');
INSERT INTO `t_page` (id, lang, title) VALUES ('privacy', 'en', 'Privacy policy');
INSERT INTO `t_page` (id, lang, title) VALUES ('privacy', 'fr', 'Politique de confidentialité');
INSERT INTO `t_page` (id, lang, title) VALUES ('use', 'en', 'Conditions of use');
INSERT INTO `t_page` (id, lang, title) VALUES ('use', 'fr', "Conditions générales d'utilisation");
INSERT INTO `t_page` (id, lang, title) VALUES ('user-account', 'en', 'My account');
INSERT INTO `t_page` (id, lang, title) VALUES ('user-account', 'fr', 'Mon compte');
INSERT INTO `t_page` (id, lang, title) VALUES ('user-connection', 'en', 'Sign-In');
INSERT INTO `t_page` (id, lang, title) VALUES ('user-connection', 'fr', 'Connectez-vous');
INSERT INTO `t_page` (id, lang, title) VALUES ('user-password', 'en', 'Choose a new password');
INSERT INTO `t_page` (id, lang, title) VALUES ('user-password', 'fr', 'Choisir un nouveau mot de passe');

-- ----------------------------
-- Table structure for t_page_history
-- ----------------------------
DROP TABLE IF EXISTS `t_page_history`;
CREATE TABLE `t_page_history` (
  `page_id` varchar(24) NOT NULL,
  `page_lang` varchar(3) NOT NULL DEFAULT '' COMMENT 'hidden',
  `page_crc32` bigint NOT NULL,
  `page_content` text NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`page_id`,`page_lang`,`page_crc32`),
  KEY `t_page_history_ibfk_1` (`user_id`) USING BTREE,
  CONSTRAINT `t_page_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `t_page_history_ibfk_2` FOREIGN KEY (`page_id`, `page_lang`) REFERENCES `t_page` (`id`, `lang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Table structure for t_user
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(32) DEFAULT 'user',
  `firstname` varchar(64) DEFAULT NULL,
  `lastname` varchar(64) NOT NULL DEFAULT '',
  `description` varchar(512) NOT NULL DEFAULT '',
  `email` varchar(128) NOT NULL,
  `phone` varchar(24) NOT NULL DEFAULT '',
  `language` varchar(2) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_connection_at` datetime DEFAULT NULL,
  `status` enum('inactive','active') NOT NULL DEFAULT 'inactive',
  `ip` int unsigned DEFAULT NULL,
  `token` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`) USING BTREE,
  KEY `role` (`role`) USING BTREE,
  CONSTRAINT `t_user_ibfk_1` FOREIGN KEY (`role`) REFERENCES `t_user_role` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Table structure for t_user_has_permission
-- ----------------------------
DROP TABLE IF EXISTS `t_user_has_permission`;
CREATE TABLE `t_user_has_permission` (
  `id` int unsigned NOT NULL,
  `permission` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`,`permission`),
  KEY `permission` (`permission`) USING BTREE,
  CONSTRAINT `t_user_has_permission_ibfk_1` FOREIGN KEY (`id`) REFERENCES `t_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_user_has_permission_ibfk_2` FOREIGN KEY (`permission`) REFERENCES `t_user_permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Table structure for t_user_permission
-- ----------------------------
DROP TABLE IF EXISTS `t_user_permission`;
CREATE TABLE `t_user_permission` (
  `id` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of t_user_permission
-- ----------------------------
INSERT INTO `t_user_permission` VALUES ('page-create', 'Create a new page');
INSERT INTO `t_user_permission` VALUES ('page-css', 'Update page CSS');
INSERT INTO `t_user_permission` VALUES ('page-delete', 'Delete a page');
INSERT INTO `t_user_permission` VALUES ('page-html', 'Update page HTML');
INSERT INTO `t_user_permission` VALUES ('page-js', 'Update page JS');
INSERT INTO `t_user_permission` VALUES ('page-update', 'Update a page');
INSERT INTO `t_user_permission` VALUES ('page-update-inline', 'Update a page with inline edition (need page-update)');

-- ----------------------------
-- Table structure for t_user_role
-- ----------------------------
DROP TABLE IF EXISTS `t_user_role`;
CREATE TABLE `t_user_role` (
  `id` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of t_user_role
-- ----------------------------
INSERT INTO `t_user_role` VALUES ('admin', 'Administrator');
INSERT INTO `t_user_role` VALUES ('blacklisted', 'Blacklisted user');
INSERT INTO `t_user_role` VALUES ('super-admin', 'Super administrator');
INSERT INTO `t_user_role` VALUES ('user', 'Simple user');

-- ----------------------------
-- Table structure for t_user_role_has_permission
-- ----------------------------
DROP TABLE IF EXISTS `t_user_role_has_permission`;
CREATE TABLE `t_user_role_has_permission` (
  `id_role` varchar(32) NOT NULL,
  `id_permission` varchar(32) NOT NULL,
  PRIMARY KEY (`id_role`,`id_permission`),
  KEY `fk_t_user_role_has_t_user_permission_t_user_role1` (`id_role`) USING BTREE,
  KEY `fk_t_user_role_has_t_user_permission_t_user_permission1` (`id_permission`) USING BTREE,
  CONSTRAINT `t_user_role_has_permission_ibfk_1` FOREIGN KEY (`id_permission`) REFERENCES `t_user_permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_user_role_has_permission_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `t_user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of t_user_role_has_permission
-- ----------------------------
INSERT INTO `t_user_role_has_permission` VALUES ('super-admin', 'page-create');
INSERT INTO `t_user_role_has_permission` VALUES ('super-admin', 'page-css');
INSERT INTO `t_user_role_has_permission` VALUES ('super-admin', 'page-delete');
INSERT INTO `t_user_role_has_permission` VALUES ('super-admin', 'page-html');
INSERT INTO `t_user_role_has_permission` VALUES ('super-admin', 'page-js');
INSERT INTO `t_user_role_has_permission` VALUES ('super-admin', 'page-update');
INSERT INTO `t_user_role_has_permission` VALUES ('super-admin', 'page-update-inline');

-- ----------------------------
-- Table structure for t_user_setting
-- ----------------------------
DROP TABLE IF EXISTS `t_user_setting`;
CREATE TABLE `t_user_setting` (
  `user_id` int unsigned NOT NULL,
  `key` varchar(32) NOT NULL,
  `value` varchar(32) NOT NULL,
  PRIMARY KEY (`user_id`,`key`),
  CONSTRAINT `t_user_setting_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

SET FOREIGN_KEY_CHECKS=1;