/*
 Navicat MySQL Data Transfer

 Source Server         : dev.db.infra.fortressitx.lan
 Source Server Version : 50152
 Source Host           : localhost
 Source Database       : questions

 Target Server Version : 50152
 File Encoding         : utf-8

 Date: 08/09/2013 10:55:47 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `answerActivity`
-- ----------------------------
DROP TABLE IF EXISTS `answerActivity`;
CREATE TABLE `answerActivity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questionId` int(11) NOT NULL,
  `user` varchar(128) DEFAULT NULL,
  `ts` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `action` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `answers`
-- ----------------------------
DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `questionId` int(11) NOT NULL,
  `timeCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `answer` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `questions`
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `name` varchar(254) DEFAULT NULL,
  `timeCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `answered` int(11) DEFAULT NULL,
  `category` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

SET FOREIGN_KEY_CHECKS = 1;
