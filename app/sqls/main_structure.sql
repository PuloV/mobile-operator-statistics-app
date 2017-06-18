/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : mo_statistics

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2017-06-18 11:24:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for personal_usage
-- ----------------------------
DROP TABLE IF EXISTS `personal_usage`;
CREATE TABLE `personal_usage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `age` int(7) NOT NULL,
  `mobile_operator` varchar(100) NOT NULL,
  `tax_amount` decimal(11,2) NOT NULL,
  `minutes` int(11) NOT NULL,
  `sms_count` int(11) NOT NULL,
  `megabytes` int(11) NOT NULL,
  `respondent_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106002 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(500) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
