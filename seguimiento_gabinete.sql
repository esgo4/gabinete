/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : seguimiento_gabinete

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 20/03/2020 09:19:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for acuerdos
-- ----------------------------
DROP TABLE IF EXISTS `acuerdos`;
CREATE TABLE `acuerdos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acuerdo` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `minutas_id` int(11) NULL DEFAULT NULL,
  `secretaria_id` int(11) NULL DEFAULT NULL,
  `plazo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fecha_inicio` date NULL DEFAULT NULL,
  `fecha_termino` date NULL DEFAULT NULL,
  `timestamp` timestamp(0) NULL DEFAULT current_timestamp(),
  `user_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_acuerdos_minuta1_idx`(`minutas_id`) USING BTREE,
  INDEX `fk_acuerdos_secretarias1_idx`(`secretaria_id`) USING BTREE,
  INDEX `fk_acuerdos_user1_idx`(`user_id`) USING BTREE,
  CONSTRAINT `fk_acuerdos_minuta1` FOREIGN KEY (`minutas_id`) REFERENCES `minutas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_acuerdos_secretarias1` FOREIGN KEY (`secretaria_id`) REFERENCES `secretarias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_acuerdos_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of acuerdos
-- ----------------------------
INSERT INTO `acuerdos` VALUES (1, 'Reglamentos de contencion', 1, 1, NULL, '2020-03-18', '2020-03-25', '2020-03-18 10:05:06', 3);
INSERT INTO `acuerdos` VALUES (2, 'Suspension ', 2, 9, NULL, '2020-03-18', NULL, '2020-03-18 10:36:10', 3);
INSERT INTO `acuerdos` VALUES (3, 'Actividades para la cuarentena', 3, 9, NULL, '2020-03-18', '2020-03-25', '2020-03-18 13:19:48', 3);
INSERT INTO `acuerdos` VALUES (4, 'reglamento de instalacion de servicios de alumbrado', 4, 8, NULL, '2020-03-18', '2020-03-25', '2020-03-18 15:13:00', 3);

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment`  (
  `item_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`item_name`, `user_id`) USING BTREE,
  INDEX `idx-auth_assignment-user_id`(`user_id`) USING BTREE,
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('admin', '3', NULL);
INSERT INTO `auth_assignment` VALUES ('user', '1', NULL);
INSERT INTO `auth_assignment` VALUES ('user', '4', 1583512851);
INSERT INTO `auth_assignment` VALUES ('user', '5', 1584565757);

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `rule_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `data` blob NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  `updated_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE,
  INDEX `rule_name`(`rule_name`) USING BTREE,
  INDEX `idx-auth_item-type`(`type`) USING BTREE,
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('admin', 1, NULL, NULL, NULL, 1574187161, 1574187161);
INSERT INTO `auth_item` VALUES ('admin-agregar-avance', 1, 'permite al administrador agregar un avance de cualquier secretaria', NULL, NULL, 1574194651, 1574194651);
INSERT INTO `auth_item` VALUES ('admin-button', 1, 'habilita button de administrador', NULL, NULL, 1574196270, 1574196270);
INSERT INTO `auth_item` VALUES ('admin-cambiar-status', 1, 'permite cambiar status', NULL, NULL, 1574187035, 1574187035);
INSERT INTO `auth_item` VALUES ('admin-filtro', 1, 'habilitad los filtrados de secretaria responsable y participante  en la sección de seguimientos', NULL, NULL, 1574186823, 1574186823);
INSERT INTO `auth_item` VALUES ('admin-filtro-participante', 1, 'habilita filtro participante', NULL, NULL, 1574187006, 1574187006);
INSERT INTO `auth_item` VALUES ('admin-filtro-responsable', 1, 'habilita filtro responsable', NULL, NULL, 1574186989, 1574186989);
INSERT INTO `auth_item` VALUES ('admin-notificaciones', 1, 'activa las notificaciones de administrador, recibe los avances', NULL, NULL, 1574186869, 1574186869);
INSERT INTO `auth_item` VALUES ('admin-nuevo-seguimiento', 1, 'permite agragar nuevo seguimiento', NULL, NULL, 1574194781, 1574194781);
INSERT INTO `auth_item` VALUES ('avances_admin', 1, 'permite al administrador agregar un avance de cualquier secretaria', NULL, NULL, 1574186734, 1574186734);
INSERT INTO `auth_item` VALUES ('index', 1, 'habilita index', NULL, NULL, 1574187346, 1574187346);
INSERT INTO `auth_item` VALUES ('user', 1, NULL, NULL, NULL, 1574196322, 1574196322);
INSERT INTO `auth_item` VALUES ('user-button', 1, 'habilita el button detalles, sección seguimientos', NULL, NULL, 1574196254, 1574196254);
INSERT INTO `auth_item` VALUES ('user-notificaciones', 1, 'habilita las notificaciones para los usuarios, les notifica cuando se agrego un seguimiento', NULL, NULL, 1574186903, 1574186903);

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child`  (
  `parent` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`, `child`) USING BTREE,
  INDEX `child`(`child`) USING BTREE,
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('admin', 'admin-agregar-avance');
INSERT INTO `auth_item_child` VALUES ('admin', 'admin-button');
INSERT INTO `auth_item_child` VALUES ('admin', 'admin-cambiar-status');
INSERT INTO `auth_item_child` VALUES ('admin', 'admin-filtro');
INSERT INTO `auth_item_child` VALUES ('admin', 'admin-filtro-participante');
INSERT INTO `auth_item_child` VALUES ('admin', 'admin-filtro-responsable');
INSERT INTO `auth_item_child` VALUES ('admin', 'admin-notificaciones');
INSERT INTO `auth_item_child` VALUES ('admin', 'admin-nuevo-seguimiento');
INSERT INTO `auth_item_child` VALUES ('admin', 'avances_admin');
INSERT INTO `auth_item_child` VALUES ('admin', 'index');
INSERT INTO `auth_item_child` VALUES ('user', 'user-button');
INSERT INTO `auth_item_child` VALUES ('user', 'user-notificaciones');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` blob NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  `updated_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for avances
-- ----------------------------
DROP TABLE IF EXISTS `avances`;
CREATE TABLE `avances`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `secretarias_id` int(11) NULL DEFAULT NULL,
  `acuerdos_id` int(11) NULL DEFAULT NULL,
  `comentario` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `fecha_captura` date NULL DEFAULT NULL,
  `timestamp` timestamp(0) NULL DEFAULT current_timestamp(),
  `user_id` int(11) NULL DEFAULT NULL,
  `minuta_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_avances_secretarias1_idx`(`secretarias_id`) USING BTREE,
  INDEX `fk_avances_acuerdos1_idx`(`acuerdos_id`) USING BTREE,
  INDEX `fk_avances_user1_idx`(`user_id`) USING BTREE,
  INDEX `fk_avances_minutaid`(`minuta_id`) USING BTREE,
  CONSTRAINT `fk_avances_acuerdos1` FOREIGN KEY (`acuerdos_id`) REFERENCES `acuerdos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_avances_minutaid` FOREIGN KEY (`minuta_id`) REFERENCES `minutas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_avances_secretarias1` FOREIGN KEY (`secretarias_id`) REFERENCES `secretarias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_avances_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of avances
-- ----------------------------
INSERT INTO `avances` VALUES (1, 9, 3, 'muchas tareas', '2020-03-18', '2020-03-18 14:39:28', NULL, 3);
INSERT INTO `avances` VALUES (3, 8, 4, 'Acuerdos listos y aprobados', '2020-03-18', '2020-03-18 15:15:34', NULL, 4);

-- ----------------------------
-- Table structure for img_avances
-- ----------------------------
DROP TABLE IF EXISTS `img_avances`;
CREATE TABLE `img_avances`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `avances_id` int(11) NULL DEFAULT NULL,
  `archivo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fecha_captura` date NULL DEFAULT NULL,
  `timestamp` timestamp(0) NULL DEFAULT current_timestamp(),
  `user_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_img_avances_avances1_idx`(`avances_id`) USING BTREE,
  INDEX `fk_img_avances_user1_idx`(`user_id`) USING BTREE,
  CONSTRAINT `fk_img_avances_avances1` FOREIGN KEY (`avances_id`) REFERENCES `avances` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_img_avances_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of img_avances
-- ----------------------------
INSERT INTO `img_avances` VALUES (1, 1, '2pD8hUiP588Udi0HXB_CafpUsP0u0lih.png', '2020-03-18', '2020-03-18 14:39:28', 1);
INSERT INTO `img_avances` VALUES (2, 3, 'wA1-rtP20ST1Ls_bvTD_NjrDoWo58NV_.docx', '2020-03-18', '2020-03-18 15:15:34', 5);

-- ----------------------------
-- Table structure for m_proyectos
-- ----------------------------
DROP TABLE IF EXISTS `m_proyectos`;
CREATE TABLE `m_proyectos`  (
  `minutas_id` int(11) NOT NULL,
  `m_proyectos_estrategicos_id` int(11) NOT NULL,
  PRIMARY KEY (`minutas_id`, `m_proyectos_estrategicos_id`) USING BTREE,
  INDEX `fk_m_proyectos_proyectos_estrategicos1_idx`(`m_proyectos_estrategicos_id`) USING BTREE,
  CONSTRAINT `fk_m_proyectos_minuta1` FOREIGN KEY (`minutas_id`) REFERENCES `minutas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_m_proyectos_proyectos_estrategicos1` FOREIGN KEY (`m_proyectos_estrategicos_id`) REFERENCES `proyectos_estrategicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_proyectos
-- ----------------------------
INSERT INTO `m_proyectos` VALUES (1, 2);
INSERT INTO `m_proyectos` VALUES (2, 2);
INSERT INTO `m_proyectos` VALUES (3, 1);
INSERT INTO `m_proyectos` VALUES (4, 1);

-- ----------------------------
-- Table structure for minutas
-- ----------------------------
DROP TABLE IF EXISTS `minutas`;
CREATE TABLE `minutas`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folio` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lugar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `seguimientos_id` int(11) NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `tema` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `datetime` datetime(0) NULL DEFAULT NULL,
  `timestamp` timestamp(0) NULL DEFAULT current_timestamp(),
  `user_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_minuta_seguimiento1_idx`(`seguimientos_id`) USING BTREE,
  INDEX `fk_minuta_user1_idx`(`user_id`) USING BTREE,
  CONSTRAINT `fk_minuta_seguimiento1` FOREIGN KEY (`seguimientos_id`) REFERENCES `seguimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_minuta_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of minutas
-- ----------------------------
INSERT INTO `minutas` VALUES (1, 'acdo-1-2020', 'Sala de proteccion civil', 1, '2020-03-18', 'Enfermadades', '2020-03-18 17:00:40', '2020-03-18 10:04:40', 3);
INSERT INTO `minutas` VALUES (2, 'acdo-2-2020', 'Sala de transito', 1, '2020-03-18', 'Enfermadades', '2020-03-18 17:00:10', '2020-03-18 10:29:10', 3);
INSERT INTO `minutas` VALUES (3, 'acdo-3-2020', 'Plaza la ranita', 2, '2020-03-18', 'Relamento de cuarentena', '2020-03-18 20:00:23', '2020-03-18 13:19:23', 3);
INSERT INTO `minutas` VALUES (4, 'acdo-4-2020', 'Sala de juntas de obras publicas', 3, '2020-03-18', 'Alumbrado publico', '2020-03-18 22:00:18', '2020-03-18 15:12:18', 3);

-- ----------------------------
-- Table structure for notificaciones
-- ----------------------------
DROP TABLE IF EXISTS `notificaciones`;
CREATE TABLE `notificaciones`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seguimientos_id` int(11) NULL DEFAULT NULL,
  `minutas_id` int(11) NULL DEFAULT NULL,
  `avances_id` int(11) NULL DEFAULT NULL,
  `acuerdos_id` int(11) NULL DEFAULT NULL,
  `secretarias_id` int(11) NULL DEFAULT NULL,
  `leido` tinyint(4) NULL DEFAULT NULL,
  `fecha_lectura` date NULL DEFAULT NULL,
  `hora_lectura` datetime(0) NULL DEFAULT NULL,
  `fecha_captura` date NULL DEFAULT NULL,
  `hora_captura` datetime(0) NULL DEFAULT NULL,
  `timestamp` timestamp(0) NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_notificaciones_seguimiento1_idx`(`seguimientos_id`) USING BTREE,
  INDEX `fk_notificaciones_minuta1_idx`(`minutas_id`) USING BTREE,
  INDEX `fk_notificaciones_avances1_idx`(`avances_id`) USING BTREE,
  INDEX `fk_notificaciones_acuerdos1_idx`(`acuerdos_id`) USING BTREE,
  INDEX `fk_notificaciones_secretarias1_idx`(`secretarias_id`) USING BTREE,
  CONSTRAINT `fk_notificaciones_acuerdos1` FOREIGN KEY (`acuerdos_id`) REFERENCES `acuerdos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_notificaciones_avances1` FOREIGN KEY (`avances_id`) REFERENCES `avances` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_notificaciones_minuta1` FOREIGN KEY (`minutas_id`) REFERENCES `minutas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_notificaciones_secretarias1` FOREIGN KEY (`secretarias_id`) REFERENCES `secretarias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_notificaciones_seguimiento1` FOREIGN KEY (`seguimientos_id`) REFERENCES `seguimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for participantes
-- ----------------------------
DROP TABLE IF EXISTS `participantes`;
CREATE TABLE `participantes`  (
  `secretarias_id` int(11) NOT NULL,
  `seguimientos_id` int(11) NOT NULL,
  PRIMARY KEY (`secretarias_id`, `seguimientos_id`) USING BTREE,
  INDEX `fk_participantes_seguimiento1_idx`(`seguimientos_id`) USING BTREE,
  CONSTRAINT `fk_participantes_secretarias1` FOREIGN KEY (`secretarias_id`) REFERENCES `secretarias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_participantes_seguimiento1` FOREIGN KEY (`seguimientos_id`) REFERENCES `seguimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of participantes
-- ----------------------------
INSERT INTO `participantes` VALUES (8, 3);
INSERT INTO `participantes` VALUES (9, 1);
INSERT INTO `participantes` VALUES (9, 2);

-- ----------------------------
-- Table structure for profile
-- ----------------------------
DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile`  (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `public_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `gravatar_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `gravatar_id` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `bio` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `timezone` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of profile
-- ----------------------------
INSERT INTO `profile` VALUES (1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `profile` VALUES (3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `profile` VALUES (4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `profile` VALUES (5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for proyectos_estrategicos
-- ----------------------------
DROP TABLE IF EXISTS `proyectos_estrategicos`;
CREATE TABLE `proyectos_estrategicos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proyectos_estrategicos
-- ----------------------------
INSERT INTO `proyectos_estrategicos` VALUES (1, 'Uruapan Seguro');
INSERT INTO `proyectos_estrategicos` VALUES (2, 'Red del Sol');

-- ----------------------------
-- Table structure for responsables
-- ----------------------------
DROP TABLE IF EXISTS `responsables`;
CREATE TABLE `responsables`  (
  `secretarias_id` int(11) NOT NULL,
  `seguimientos_id` int(11) NOT NULL,
  PRIMARY KEY (`secretarias_id`, `seguimientos_id`) USING BTREE,
  INDEX `fk_responsables_seguimiento1_idx`(`seguimientos_id`) USING BTREE,
  CONSTRAINT `fk_responsables_secretarias1` FOREIGN KEY (`secretarias_id`) REFERENCES `secretarias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_responsables_seguimiento1` FOREIGN KEY (`seguimientos_id`) REFERENCES `seguimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of responsables
-- ----------------------------
INSERT INTO `responsables` VALUES (1, 1);
INSERT INTO `responsables` VALUES (1, 2);
INSERT INTO `responsables` VALUES (1, 3);
INSERT INTO `responsables` VALUES (2, 3);

-- ----------------------------
-- Table structure for secretarias
-- ----------------------------
DROP TABLE IF EXISTS `secretarias`;
CREATE TABLE `secretarias`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `titular_nombres` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `titular_apellido_paterno` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `titular_apellido_materno` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `correo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `activo` tinyint(4) NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_secretarias_user1_idx`(`user_id`) USING BTREE,
  CONSTRAINT `fk_secretarias_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of secretarias
-- ----------------------------
INSERT INTO `secretarias` VALUES (1, 'Secretaria del Ayuntamiento', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (2, 'Secretaria Particular', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (3, 'Sindicatura', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (4, 'Contraloría', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (5, 'Tesorería Municipal', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (6, 'Secretaria Jurídica', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (7, 'Secretaria de Administración', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (8, 'Secretaria de Obras Públicas y Servicios', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (9, 'Secretaria de Planeación', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (10, 'Secretaria de Desarrollo Urbano', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (11, 'Secretaria de Medio Ambiente', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (12, 'Secretaria de Fomento Económico', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (13, 'Secretaria de Desarrollo Social', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (14, 'Secretaria de Turismo', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (15, 'Secretaria de Seguridad Publica', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (16, 'Secretaria de Perspectiva de Género e Inclusión', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (17, 'DIF', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (18, 'Capasu', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (19, 'Parque Nacional', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (20, 'Implan', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `secretarias` VALUES (21, 'Coordinador de Asesores', NULL, NULL, NULL, NULL, 1, NULL);

-- ----------------------------
-- Table structure for seguimiento
-- ----------------------------
DROP TABLE IF EXISTS `seguimiento`;
CREATE TABLE `seguimiento`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folio` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tema` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tareas` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `fecha_inicio` date NULL DEFAULT NULL,
  `fecha_vencimiento` date NULL DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `status` tinyint(4) NULL DEFAULT NULL,
  `fecha_captura` date NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `leido` tinyint(4) NULL DEFAULT NULL,
  `timestamp` timestamp(0) NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_seguimiento_user1_idx`(`user_id`) USING BTREE,
  CONSTRAINT `fk_seguimiento_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of seguimiento
-- ----------------------------
INSERT INTO `seguimiento` VALUES (1, '1-2020-03-18', 'Enfermadades', '<p>Tareas de prevecion&nbsp;</p>', '2020-03-18', '2020-03-25', 'sin Ob', 3, '2020-03-18', 3, 0, '2020-03-18 10:03:21');
INSERT INTO `seguimiento` VALUES (2, '2-2020-03-18', 'Relamento de cuarentena', '<p>Tareas para cuarentena</p>', '2020-03-18', '2020-03-25', '', 2, '2020-03-18', 3, 0, '2020-03-18 13:18:55');
INSERT INTO `seguimiento` VALUES (3, '3-2020-03-18', 'Alumbrado publico', '<p>tareas para alumbrado</p>', '2020-03-18', '2020-03-25', '', 0, '2020-03-18', 3, 0, '2020-03-18 15:07:01');

-- ----------------------------
-- Table structure for social_account
-- ----------------------------
DROP TABLE IF EXISTS `social_account`;
CREATE TABLE `social_account`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `code` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `account_unique`(`provider`, `client_id`) USING BTREE,
  UNIQUE INDEX `account_unique_code`(`code`) USING BTREE,
  INDEX `fk_user_account`(`user_id`) USING BTREE,
  CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for token
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token`  (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE INDEX `token_unique`(`user_id`, `code`, `type`) USING BTREE,
  CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of token
-- ----------------------------
INSERT INTO `token` VALUES (1, '_VzqZ3VtCLNJaVgc1cjRekm8oW3DQQrr', 1580190241, 0);
INSERT INTO `token` VALUES (3, 'wZNqFW6dUpB--ZLyO1rZWEzI593_wXBb', 1583244389, 0);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) NULL DEFAULT NULL,
  `unconfirmed_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `blocked_at` int(11) NULL DEFAULT NULL,
  `registration_ip` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT 0,
  `last_login_at` int(11) NULL DEFAULT NULL,
  `nombres` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `apellido_paterno` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `apellido_materno` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `secretarias_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `user_unique_username`(`username`) USING BTREE,
  UNIQUE INDEX `user_unique_email`(`email`) USING BTREE,
  INDEX `fk_user_secretarias1_idx`(`secretarias_id`) USING BTREE,
  CONSTRAINT `fk_user_secretarias1` FOREIGN KEY (`secretarias_id`) REFERENCES `secretarias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'Planeacion', 'planeacion@uruapan.gob.mx', '$2y$12$cFwU.MAWdjcFzAIaTIkbYOCanGj5qpAip7fesg5ZQMOXlfSQNoJPO', 'N-JgA3j0pfMn3UW6c_c4aBunQdERHmvB', 1583431074, NULL, NULL, '189.197.21.209', 1580190240, 1583432921, 0, 1584545301, 'Secretaria', 'Planeacion', NULL, 9);
INSERT INTO `user` VALUES (3, 'Admin', 'esgo_4@hotmail.com', '$2y$12$NsY1f9wh5.xFfnYZnrZ.B.wyRZW9xVRHO.POUyWORv2GSGnBB1oYS', '-FF8_cGlEaxKXfBaExyt13jLmE1dM1ns', 1583431066, NULL, NULL, '127.0.0.1', 1583244389, 1583244389, 0, 1584565545, 'Super', 'admin', 'admin', NULL);
INSERT INTO `user` VALUES (4, 'Ayuntamiento', 'correo@homail.com', '$2y$12$5hUVSFiAV/IZC.rAt98W/uT/wGR95Lzg.YtQSshFPWbLAPTsmx/zi', 'pLleZSriyRj8raU18WqrEu5X8ctzlM6E', 1583512751, NULL, NULL, '127.0.0.1', 1583512751, 1583512751, 0, 1584130270, 'Secretaria', 'Ayuntamiento', NULL, 1);
INSERT INTO `user` VALUES (5, 'Obras', 'email@hotmail.com', '$2y$12$1Lg4ivJ8aDyWUGWkUyi98u8iD7mI7YW9H2WhdXGOZd5D/E2UEfTzq', 'T87ZEUgZNccoYSHOqkYPZnoIdZsKTLPS', 1584565743, NULL, NULL, '127.0.0.1', 1584565743, 1584565743, 0, 1584565782, 'Secretaria ', 'Obras', NULL, 8);

SET FOREIGN_KEY_CHECKS = 1;
