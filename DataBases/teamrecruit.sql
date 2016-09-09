# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.6.19)
# Database: teamrecruit
# Generation Time: 2016-09-09 12:23:07 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table tr_apply
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tr_apply`;

CREATE TABLE `tr_apply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `sex` tinyint(4) NOT NULL,
  `phone` varchar(11) NOT NULL DEFAULT '',
  `stuId` varchar(12) NOT NULL DEFAULT '',
  `dep` int(11) NOT NULL,
  `major` int(11) NOT NULL,
  `interest` varchar(200) DEFAULT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# Dump of table tr_config
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tr_config`;

CREATE TABLE `tr_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL DEFAULT '',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `extra` varchar(255) NOT NULL DEFAULT '',
  `remark` varchar(100) NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `value` text NOT NULL,
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `type` (`type`),
  KEY `group` (`group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `tr_config` WRITE;
/*!40000 ALTER TABLE `tr_config` DISABLE KEYS */;

INSERT INTO `tr_config` (`id`, `name`, `type`, `title`, `group`, `extra`, `remark`, `create_time`, `update_time`, `value`, `sort`, `display`)
VALUES
	(1,'WEB_SITE_TITLE',1,'网站标题',1,'','网站标题前台显示标题',1378898976,1379235274,'招新系统',4,1),
	(2,'WEB_SITE_DESCRIPTION',2,'网站描述',1,'','网站搜索引擎描述',1378898976,1379235841,'招新工作正在展开',5,1),
	(6,'WEB_URL',1,'网站地址',1,'','网站域名地址',0,0,'http://www.example.com/',2,1),
	(3,'WEB_SITE_KEYWORD',2,'网站关键字',1,'','网站搜索引擎关键字',1378898976,1381390100,'团队招新',6,1),
	(4,'WEB_SITE_CLOSE',4,'关闭站点',1,'0:关闭\r\n1:开启','站点关闭后其他用户不能访问，管理员可以正常访问',1378898976,1379235296,'1',0,1),
	(5,'WEB_SITE_ICP',1,'网站备案号',1,'','设置在网站底部显示的备案号，如“沪ICP备00000001号',1378900335,1379235859,'沪ICP备00000001号',7,1),
	(7,'WEB_NAME',1,'网站名称',1,'','网站名称',0,0,'社团招新管理系统',1,1),
	(8,'WEB_LOGO',1,'网站logo',1,'','',0,0,'logo.png',3,1),
	(9,'MAIL_SMTP',1,'SMTP服务器地址',1,'','SMTP服务器的地址',0,0,'smtp.exmail.qq.com',0,0),
	(10,'MAIL_PORT',1,'SMTP服务器端口',1,'','SMTP服务器端口',0,0,'465',0,0),
	(11,'MAIL_ADDRESS',1,'邮箱地址',1,'','发件邮箱地址',0,0,'example@qq.com',0,0),
	(12,'MAIL_PASSWORD',1,'邮箱密码',1,'','发件邮箱密码',0,0,'emailpassword',0,0),
	(13,'MAIL_LOGINNAME',1,'邮箱登录账号',1,'','登录邮箱账号',0,0,'example@qq.com',0,0),
	(14,'MAIL_AUTH',4,'邮箱认证',1,'0:关闭\n1:开启','邮箱是否需要登录认证',0,0,'1',0,0),
	(15,'MAIL_HTML',4,'HTML格式',1,'0:TXT\n1:HTML','邮件内容的格式',0,0,'1',0,0),
	(18,'MAIL_CHARSET',1,'邮件编码格式',1,'','推荐使用UTF-8',0,0,'UTF-8',0,0),
	(19,'USER_ALLOW_REGISTER',4,'是否允许用户注册',3,'0:关闭注册\r\n1:允许注册','是否开放用户注册',1379504487,1379504580,'1',0,1),
	(20,'AlidayuAppKey',1,'大鱼Key',7,'','',0,0,'',0,1),
	(21,'AlidayuAppSecret',1,'大鱼Secret',7,'','',0,0,'',0,1),
	(22,'AlidayuApiEnv',4,'大鱼运行方式',7,'0:沙箱\r\n1:正常','',0,0,'1',0,1),
	(23,'MAIL_SECURE',1,'加密方式',1,'','发送邮件的加密方式SSL',0,0,'ssl',0,0);

/*!40000 ALTER TABLE `tr_config` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tr_department
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tr_department`;

CREATE TABLE `tr_department` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dpname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `tr_department` WRITE;
/*!40000 ALTER TABLE `tr_department` DISABLE KEYS */;

INSERT INTO `tr_department` (`id`, `dpname`)
VALUES
	(1,'计算机科学学院'),
	(2,'法学院'),
	(3,'文学与新闻传播学院'),
	(4,'美术学院'),
	(5,'民族学与社会学学院'),
	(6,'外语学院'),
	(7,'经济学院'),
	(8,'管理学院'),
	(9,'公共管理学院'),
	(10,'教育学院'),
	(11,'马克思主义学院'),
	(12,'数学与统计学学院'),
	(13,'电子信息工程学院'),
	(14,'生物医学工程学院'),
	(15,'化学与材料科学学院'),
	(16,'资源与环境学院'),
	(17,'生命科学学院'),
	(18,'药学院'),
	(19,'预科教育学院'),
	(20,'体育学院'),
	(21,'音乐舞蹈学院');

/*!40000 ALTER TABLE `tr_department` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tr_major
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tr_major`;

CREATE TABLE `tr_major` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dp_id` int(11) NOT NULL,
  `mjname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `dp_id` (`dp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `tr_major` WRITE;
/*!40000 ALTER TABLE `tr_major` DISABLE KEYS */;

INSERT INTO `tr_major` (`id`, `dp_id`, `mjname`)
VALUES
	(1,1,'软件工程'),
	(2,1,'网络工程'),
	(3,1,'计算机科学与技术'),
	(4,1,'自动化'),
	(5,1,'智能科学与技术'),
	(6,1,'轨道交通信号与控制'),
	(7,2,'政治学与行政学'),
	(8,2,'知识产权'),
	(9,2,'法学'),
	(10,3,'汉语言文学'),
	(11,3,'新闻学'),
	(12,3,'广告学'),
	(13,3,'汉语国际教育'),
	(14,3,'广播电视学专业'),
	(15,4,'视觉传达设计'),
	(16,4,'环境设计'),
	(17,4,'服装与服饰设计'),
	(18,4,'动画专业'),
	(19,4,'美术学'),
	(20,5,'文物与博物馆学'),
	(21,5,'历史学'),
	(22,5,'民族学'),
	(23,5,'社会学'),
	(24,5,'社会工作'),
	(25,6,'朝鲜语'),
	(26,6,'翻译专业'),
	(27,6,'商务英语'),
	(28,6,'英语'),
	(29,6,'日语'),
	(30,7,'经济统计学'),
	(31,7,'保险学'),
	(32,7,'国际经济与贸易'),
	(33,7,'金融学'),
	(34,7,'经济学'),
	(35,7,'金融工程'),
	(36,8,'电子商务'),
	(37,8,'信息管理与信息系统'),
	(38,8,'人力资源管理'),
	(39,8,'市场营销'),
	(40,8,'旅游管理'),
	(41,8,'财务管理'),
	(42,8,'会计学'),
	(43,8,'工商管理'),
	(44,9,'公共事业管理'),
	(45,9,'劳动与社会保障'),
	(46,9,'行政管理'),
	(47,9,'土地资源管理'),
	(48,10,'教育技术学'),
	(49,10,'教育学'),
	(50,10,'应用心理学'),
	(51,11,'思想政治教育'),
	(52,12,'统计学学'),
	(53,12,'基础数学'),
	(54,12,'信息与计算科学'),
	(55,12,'应用数学'),
	(56,13,'光电信息科学与工程'),
	(57,13,'通信工程'),
	(58,13,'电子信息工程'),
	(59,14,'医学信息工程'),
	(60,14,'生物医学工程'),
	(61,15,'应用化学'),
	(62,15,'材料化学'),
	(63,15,'化学工程与工艺'),
	(64,15,'高分子材料与工程'),
	(65,16,'资源环境科学'),
	(66,16,'水文与水资源工程'),
	(67,16,'环境科学'),
	(68,16,'环境工程'),
	(69,17,'生物工程'),
	(70,17,'食品质量与安全'),
	(71,17,'生物技术'),
	(72,18,'化学生物学'),
	(73,18,'药学'),
	(74,18,'药物制剂'),
	(75,18,'药物分析'),
	(76,19,'少数民族预科'),
	(77,20,'社会体育指导与管理'),
	(78,21,'音乐学'),
	(79,21,'舞蹈表演');

/*!40000 ALTER TABLE `tr_major` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tr_team
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tr_team`;

CREATE TABLE `tr_team` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(64) DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `name` varchar(32) DEFAULT '',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `desc` varchar(220) DEFAULT '',
  `intro` text,
  `url` varchar(120) DEFAULT NULL,
  `logo` varchar(120) DEFAULT NULL,
  `phone` char(20) DEFAULT '0',
  `location` varchar(120) DEFAULT NULL,
  `notice` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` int(10) unsigned NOT NULL,
  `login_time` int(11) unsigned DEFAULT NULL,
  `login_ip` bigint(20) NOT NULL DEFAULT '0',
  `activation` tinyint(3) NOT NULL DEFAULT '0',
  `ucid` int(11) DEFAULT NULL,
  `province` char(20) DEFAULT '',
  `city` char(20) DEFAULT '',
  `country` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
