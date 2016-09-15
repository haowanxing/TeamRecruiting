# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.6.19)
# Database: teamrecruit
# Generation Time: 2016-09-14 15:38:39 +0000
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
  `nation` tinyint(2) DEFAULT NULL,
  `origin` char(20) DEFAULT NULL,
  `pic` varchar(64) DEFAULT NULL,
  `qq` char(11) DEFAULT NULL,
  `skill` varchar(100) DEFAULT NULL,
  `reason` varchar(200) DEFAULT NULL,
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
	(2,'WEB_SITE_DESCRIPTION',2,'网站描述',1,'','网站搜索引擎描述',1378898976,1379235841,'创明软件工作室2017年招新工作正在展开',5,1),
	(6,'WEB_URL',1,'网站地址',1,'','网站域名地址',0,0,'http://192.168.31.5/',2,1),
	(3,'WEB_SITE_KEYWORD',2,'网站关键字',1,'','网站搜索引擎关键字',1378898976,1381390100,'团队招新,创明软件工作室招新,2017招新',6,1),
	(4,'WEB_SITE_CLOSE',4,'关闭站点',1,'0:关闭\r\n1:开启','站点关闭后其他用户不能访问，管理员可以正常访问',1378898976,1379235296,'1',0,1),
	(5,'WEB_SITE_ICP',1,'网站备案号',1,'','设置在网站底部显示的备案号，如“沪ICP备12007941号-2',1378900335,1379235859,'鄂ICP备0000000号',7,1),
	(7,'WEB_NAME',1,'网站名称',1,'','网站名称',0,0,'社团招新管理系统',1,1),
	(8,'WEB_LOGO',1,'网站logo',1,'','',0,0,'logo.png',3,1),
	(9,'MAIL_SMTP',1,'SMTP服务器地址',2,'','SMTP服务器的地址',0,0,'smtp.exmail.qq.com',0,1),
	(10,'MAIL_PORT',1,'SMTP服务器端口',2,'','SMTP服务器端口',0,0,'25',0,1),
	(11,'MAIL_ADDRESS',1,'邮箱地址',2,'','发件邮箱地址',0,0,'',0,1),
	(12,'MAIL_PASSWORD',1,'邮箱密码',2,'','发件邮箱密码',0,0,'',0,1),
	(13,'MAIL_LOGINNAME',1,'邮箱登录账号',2,'','登录邮箱账号',0,0,'',0,1),
	(14,'MAIL_AUTH',4,'邮箱认证',2,'0:关闭\n1:开启','邮箱是否需要登录认证',0,0,'1',0,1),
	(15,'MAIL_HTML',4,'HTML格式',2,'0:TXT\n1:HTML','邮件内容的格式',0,0,'1',0,1),
	(18,'MAIL_CHARSET',1,'邮件编码格式',2,'','推荐使用UTF-8',0,0,'UTF-8',0,1),
	(19,'USER_ALLOW_REGISTER',4,'是否允许用户注册',3,'0:关闭注册\r\n1:允许注册','是否开放用户注册',1379504487,1379504580,'1',0,1),
	(20,'AlidayuAppKey',1,'大鱼Key',7,'','',0,0,'',0,1),
	(21,'AlidayuAppSecret',1,'大鱼Secret',7,'','',0,0,'',0,1),
	(22,'AlidayuApiEnv',4,'大鱼运行方式',7,'0:沙箱\r\n1:正常','',0,0,'1',0,1),
	(23,'MAIL_SECURE',1,'加密方式',2,'','发送邮件的加密方式SSL',0,0,'ssl',0,1),
	(24,'CONFIG_GROUP_LIST',3,'配置分组',4,'','配置分组',1379228036,1384418383,'1:基本\r\n2:邮件\r\n3:用户\r\n4:备份\r\n7:短信',4,0),
	(25,'DATA_BACKUP_PATH',1,'数据库备份根路径',4,'','路径必须以 / 结尾',1381482411,1381482411,'./Data/',1,1),
	(26,'DATA_BACKUP_PART_SIZE',0,'数据库备份卷大小',4,'','该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M',1381482488,1381729564,'20971520',2,1),
	(27,'DATA_BACKUP_COMPRESS',4,'数据库备份文件是否启用压缩',4,'0:不压缩\r\n1:启用压缩','压缩备份文件需要PHP环境支持gzopen,gzwrite函数',1381713345,1381729544,'1',3,1),
	(28,'DATA_BACKUP_COMPRESS_LEVEL',4,'数据库备份文件压缩级别',4,'1:普通\r\n4:一般\r\n9:最高','数据库备份文件的压缩级别，该配置在开启压缩时生效',1381713408,1381713408,'9',4,1),
	(29,'SHOW_PAGE_TRACE',4,'是否显示页面Trace',4,'0:关闭\r\n1:开启','是否显示页面Trace信息',1387165685,1387165685,'0',1,0);

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


# Dump of table tr_feedback
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tr_feedback`;

CREATE TABLE `tr_feedback` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(64) DEFAULT '',
  `content` varchar(200) NOT NULL DEFAULT '',
  `stats` tinyint(3) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `tr_feedback` WRITE;
/*!40000 ALTER TABLE `tr_feedback` DISABLE KEYS */;

INSERT INTO `tr_feedback` (`id`, `from`, `content`, `stats`)
VALUES
	(1,'','ok',1),
	(2,'york_mail@qq.com','测试正常',1);

/*!40000 ALTER TABLE `tr_feedback` ENABLE KEYS */;
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


# Dump of table tr_member
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tr_member`;

CREATE TABLE `tr_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(16) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `login` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0',
  `session_admin` varchar(32) NOT NULL DEFAULT '',
  `status` tinyint(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `tr_member` WRITE;
/*!40000 ALTER TABLE `tr_member` DISABLE KEYS */;

INSERT INTO `tr_member` (`id`, `username`, `password`, `login`, `last_login_ip`, `last_login_time`, `session_admin`, `status`)
VALUES
	(1,'admin','bac5f7756f975153544693aeddecbcdc',0,0,0,'',1);

/*!40000 ALTER TABLE `tr_member` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tr_nations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tr_nations`;

CREATE TABLE `tr_nations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `tr_nations` WRITE;
/*!40000 ALTER TABLE `tr_nations` DISABLE KEYS */;

INSERT INTO `tr_nations` (`id`, `name`)
VALUES
	(1,'汉族'),
	(2,'蒙古族'),
	(3,'回族'),
	(4,'藏族'),
	(5,'维吾尔族'),
	(6,'苗族'),
	(7,'彝族'),
	(8,'壮族'),
	(9,'布依族'),
	(10,'朝鲜族'),
	(11,'满族'),
	(12,'侗族'),
	(13,'瑶族'),
	(14,'白族'),
	(15,'土家族'),
	(16,'哈尼族'),
	(17,'哈萨克族'),
	(18,'傣族'),
	(19,'黎族'),
	(20,'傈僳族'),
	(21,'佤族'),
	(22,'畲族'),
	(23,'高山族'),
	(24,'拉祜族'),
	(25,'水族'),
	(26,'东乡族'),
	(27,'纳西族'),
	(28,'景颇族'),
	(29,'柯尔克孜族'),
	(30,'土族'),
	(31,'达斡尔族'),
	(32,'仫佬族'),
	(33,'羌族'),
	(34,'布朗族'),
	(35,'撒拉族'),
	(36,'毛难族'),
	(37,'仡佬族'),
	(38,'锡伯族'),
	(39,'阿昌族'),
	(40,'普米族'),
	(41,'塔吉克族'),
	(42,'怒族'),
	(43,'乌孜别克族'),
	(44,'俄罗斯族'),
	(45,'鄂温克族'),
	(46,'崩龙族'),
	(47,'保安族'),
	(48,'裕固族'),
	(49,'京族'),
	(50,'塔塔尔族'),
	(51,'独龙族'),
	(52,'鄂伦春族'),
	(53,'赫哲族'),
	(54,'门巴族'),
	(55,'珞巴族'),
	(56,'基诺族');

/*!40000 ALTER TABLE `tr_nations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tr_news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tr_news`;

CREATE TABLE `tr_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` int(10) unsigned NOT NULL DEFAULT '0',
  `title` char(80) NOT NULL DEFAULT '',
  `content` text,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `wid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

LOCK TABLES `tr_news` WRITE;
/*!40000 ALTER TABLE `tr_news` DISABLE KEYS */;

INSERT INTO `tr_news` (`id`, `category`, `title`, `content`, `create_time`, `status`, `display`, `wid`)
VALUES
	(2,2,'服务协议','&lt;h4 style=&quot;font-family: Simsun; font-size: medium; white-space: normal; text-align: center;&quot;&gt;社团招新管理云平台服务协议&lt;/h4&gt;&lt;p&gt;1.拟定中。。。&lt;/p&gt;',1451664000,1,1,0),
	(3,2,'常见问题','&lt;p style=&quot;font-family: Simsun; font-size: medium; white-space: normal;&quot;&gt;如何加入？&lt;/p&gt;&lt;p style=&quot;font-family: Simsun; font-size: medium; white-space: normal;&quot;&gt;哈哈&lt;/p&gt;',1451664000,1,1,0),
	(4,2,'关于我们','&lt;p&gt;我们就是我们。&lt;/p&gt;',1451664000,1,1,0),
	(5,1,'系统公告','&lt;p&gt;系统正在开发中，敬请期待！&lt;/p&gt;',1456070400,1,1,0);

/*!40000 ALTER TABLE `tr_news` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tr_picture
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tr_picture`;

CREATE TABLE `tr_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL DEFAULT '',
  `md5` char(32) NOT NULL DEFAULT '',
  `sha1` char(40) NOT NULL DEFAULT '',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



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
  `notice` tinyint(4) NOT NULL DEFAULT '0',
  `applyop` varchar(220) DEFAULT '{"reason":0,"qq":0,"stuId":1,"nation":1,"origin":0,"pic":0,"skill":0}',
  `create_time` int(10) unsigned NOT NULL,
  `login_time` int(11) unsigned DEFAULT NULL,
  `login_ip` bigint(20) NOT NULL DEFAULT '0',
  `activation` tinyint(3) NOT NULL DEFAULT '0',
  `ucid` int(11) DEFAULT NULL,
  `province` char(20) DEFAULT '',
  `city` char(20) DEFAULT '',
  `country` char(20) DEFAULT NULL,
  `session` varchar(32) NOT NULL DEFAULT '',
  `sort` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Dump of table tr_web_menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tr_web_menu`;

CREATE TABLE `tr_web_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `url` char(255) NOT NULL DEFAULT '',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tip` varchar(255) NOT NULL DEFAULT '',
  `group` varchar(50) DEFAULT '',
  `icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `tr_web_menu` WRITE;
/*!40000 ALTER TABLE `tr_web_menu` DISABLE KEYS */;

INSERT INTO `tr_web_menu` (`id`, `title`, `pid`, `sort`, `url`, `hide`, `tip`, `group`, `icon`)
VALUES
	(1,'管理首页',0,0,'Index/index',0,'','',''),
	(2,'数据管理',0,2,'Config/index',0,'','微信','fa fa-comments'),
	(11,'添加公告',2,22,'News/add',0,'','公告',''),
	(10,'设置',2,1,'Config/weixin',0,'','设置','fa fa-cog'),
	(9,'公告管理',2,21,'News/index',0,'','公告','fa fa-volume-up'),
	(7,'修改密码',1,24,'Member/Password',1,'','用户',''),
	(6,'还原数据',1,4,'Database/index/type/import',0,'','数据',''),
	(5,'备份数据',1,3,'Database/index/type/export',0,'','数据','fa fa-hdd-o'),
	(4,'管理员添加',1,0,'Member/add',0,'','管理员','fa fa-user'),
	(3,'管理员管理',1,1,'Member/index',0,'','管理员',''),
	(12,'修改公告',2,23,'News/edit',1,'','公告',''),
	(13,'用户管理',2,37,'Team/index',0,'','用户','fa fa-user'),
	(14,'用户修改',2,38,'Team/edit',1,'','用户',''),
	(15,'修改密码',2,41,'Team/password',1,'','用户','');

/*!40000 ALTER TABLE `tr_web_menu` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
