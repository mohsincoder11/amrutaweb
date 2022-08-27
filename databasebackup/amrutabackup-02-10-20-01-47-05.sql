DROP TABLE admins;

CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE cancelorders;

CREATE TABLE `cancelorders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `teleorderid` int(11) NOT NULL,
  `masterid` int(11) NOT NULL,
  `orderdate` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orderno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `custname` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopname` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mop` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timetaken` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assignto` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deliveryboyid` int(11) NOT NULL,
  `timestatus` int(11) NOT NULL,
  `paidstatus` int(11) NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `collectedcash` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO cancelorders VALUES("8","217","1","1970-01-01","AFCT/adm-09/20/005","Mayur wankhade","8805996248","Nothing","amravati","Chaprasipura","CASH","00:04:37","null","0","1","-1","mistake","0","105","2020-09-26 18:45:01","2020-09-26 18:45:01");
INSERT INTO cancelorders VALUES("9","215","1","1970-01-01","AFCT/adm-09/20/003","mohsin khan","9579309718","Nothing","dhule","Chaprasipura","CASH","00:05:21","null","0","1","-1","money","0","600","2020-09-26 18:45:22","2020-09-26 18:45:22");
INSERT INTO cancelorders VALUES("10","221","1","1970-01-01","AFCT/adm-09/20/009","mohsin sk","8329089765","Nothing","pravin nagar near vmv college behind mosque amravati","Chaprasipura","ONLINE","00:01:19","rahul dhole","2","1","-1","nn","0","150","2020-09-28 13:11:10","2020-09-28 13:11:10");



DROP TABLE customers;

CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `masterid` int(11) NOT NULL,
  `custtype` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO customers VALUES("1","10","Person","Mayur wankhade","8805996248","amravati","2020-09-14 10:51:04","2020-09-25 15:29:42");
INSERT INTO customers VALUES("2","10","Person","saurav","7559381887","akola","2020-09-14 10:51:18","2020-09-25 14:24:56");
INSERT INTO customers VALUES("3","10","Person","Ashish","8600218059","pune","2020-09-14 10:51:32","2020-09-24 19:07:22");
INSERT INTO customers VALUES("4","10","Person","mohsin khan","9579309718","dhule","2020-09-14 10:51:51","2020-09-25 11:06:05");
INSERT INTO customers VALUES("5","1","Person","mohsin sk","8329089765","pravin nagar near vmv college behind mosque amravati","2020-09-24 18:40:20","2020-09-25 16:36:47");
INSERT INTO customers VALUES("6","1","Person","kapil sharma","9665665026","amravati","2020-09-25 15:30:12","2020-09-26 19:30:50");
INSERT INTO customers VALUES("8","19","Person","Neha","9975728747","camp","2020-10-02 08:32:10","2020-10-02 08:32:10");
INSERT INTO customers VALUES("9","1","Person","ANAND","9975728747","CAMP","2020-10-02 19:06:37","2020-10-02 19:06:37");



DROP TABLE deliveryboys;

CREATE TABLE `deliveryboys` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `masterid` int(10) NOT NULL,
  `name` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO deliveryboys VALUES("6","1","LAXMAN THAKARE","7498847424","AMRAVATI","2020-10-02 18:52:53","2020-10-02 18:52:53");
INSERT INTO deliveryboys VALUES("7","1","SOPAN SONONE","9022104895","AMRAVATI","2020-10-02 18:54:07","2020-10-02 18:54:07");
INSERT INTO deliveryboys VALUES("8","1","AVINASH KAMBLE","9370942915","AMRAVATI","2020-10-02 18:55:16","2020-10-02 18:55:16");
INSERT INTO deliveryboys VALUES("9","1","ROSHAN GHARDE","9890292143","AMRAVATI","2020-10-02 18:58:56","2020-10-02 18:58:56");
INSERT INTO deliveryboys VALUES("10","1","ADITYA GAJBHIYE","7020740579","AMRAVATI","2020-10-02 19:00:14","2020-10-02 19:00:14");
INSERT INTO deliveryboys VALUES("11","1","ASHISH CHAUDHARI","8830809303","AMRAVATI","2020-10-02 19:01:42","2020-10-02 19:01:42");
INSERT INTO deliveryboys VALUES("12","1","HIRA PAWAR","8261822512","AMRAVATI","2020-10-02 19:03:36","2020-10-02 19:03:36");



DROP TABLE failed_jobs;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE items;

CREATE TABLE `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `masterid` int(11) NOT NULL,
  `itemname` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO items VALUES("16","1","FULL CHICKEN / WHOLE CHICKEN","220","2020-10-02 18:31:51","2020-10-02 18:31:51");
INSERT INTO items VALUES("17","1","CHICKEN CURRY PIECE ( SMALL)","220","2020-10-02 18:33:11","2020-10-02 18:33:11");
INSERT INTO items VALUES("18","1","CHICKEN CURRY PIECE ( MEDIUM)","220","2020-10-02 18:33:48","2020-10-02 18:33:48");
INSERT INTO items VALUES("19","1","CHICKEN CURRY PIECE ( LARGE)","220","2020-10-02 18:34:06","2020-10-02 18:34:06");
INSERT INTO items VALUES("20","1","CHICKEN DRUM STICK","500","2020-10-02 18:34:34","2020-10-02 18:34:34");
INSERT INTO items VALUES("21","1","CHICKEN  LEG PIECE ( WITH THIGH)","300","2020-10-02 18:35:16","2020-10-02 18:36:21");
INSERT INTO items VALUES("22","1","CHICKEN KEEMA","400","2020-10-02 18:36:46","2020-10-02 18:36:46");
INSERT INTO items VALUES("23","1","CHICKEN BONE LESS","400","2020-10-02 18:37:06","2020-10-02 18:37:06");
INSERT INTO items VALUES("24","1","CHICKEN LOLLIPOP","450","2020-10-02 18:38:00","2020-10-02 18:38:00");
INSERT INTO items VALUES("25","1","CHICKEN WINGS","300","2020-10-02 18:38:16","2020-10-02 18:38:16");
INSERT INTO items VALUES("26","1","CHICKEN BIRYANI PIECE","220","2020-10-02 18:38:39","2020-10-02 18:38:39");
INSERT INTO items VALUES("27","1","CHICKEN LIVER","160","2020-10-02 18:38:58","2020-10-02 18:38:58");
INSERT INTO items VALUES("28","1","CHICKEN GIZZARD","80","2020-10-02 18:39:19","2020-10-02 18:39:19");
INSERT INTO items VALUES("29","1","CHICKEN TANDOORI (ONE PIECE)","200","2020-10-02 18:40:18","2020-10-02 18:40:18");
INSERT INTO items VALUES("30","1","WHOLE CHICKEN WITH SKIN","220","2020-10-02 18:41:58","2020-10-02 18:41:58");



DROP TABLE masters;

CREATE TABLE `masters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES("1","2014_10_12_000000_create_users_table","1");
INSERT INTO migrations VALUES("2","2014_10_12_100000_create_password_resets_table","1");
INSERT INTO migrations VALUES("3","2019_08_19_000000_create_failed_jobs_table","1");
INSERT INTO migrations VALUES("4","2020_08_28_153735_create_admins_table","1");
INSERT INTO migrations VALUES("5","2020_08_28_153804_create_masters_table","1");
INSERT INTO migrations VALUES("6","2020_08_28_153818_create_shops_table","2");
INSERT INTO migrations VALUES("7","2020_08_28_153836_create_telecallers_table","2");
INSERT INTO migrations VALUES("8","2020_08_29_081854_create_usermanages_table","3");
INSERT INTO migrations VALUES("9","2020_08_29_081933_create_customers_table","3");
INSERT INTO migrations VALUES("10","2020_08_29_081946_create_items_table","4");
INSERT INTO migrations VALUES("11","2020_08_29_082313_create_telebookorders_table","4");
INSERT INTO migrations VALUES("12","2020_08_29_082330_create_shopbookorders_table","4");
INSERT INTO migrations VALUES("13","2020_09_03_051609_create_orderlists_table","5");
INSERT INTO migrations VALUES("14","2020_09_03_051609_create_shoporderlists_table","6");
INSERT INTO migrations VALUES("15","2020_09_03_052825_create_tele_orderlists_table","6");
INSERT INTO migrations VALUES("16","2020_09_03_051609_create_shop_orderlists_table","7");
INSERT INTO migrations VALUES("17","2020_09_07_130849_create_deliveryboys_table","7");
INSERT INTO migrations VALUES("18","2020_09_11_164849_create_cancelorders_table","8");



DROP TABLE orderlists;

CREATE TABLE `orderlists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL,
  `itemname` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE password_resets;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE shopbookorders;

CREATE TABLE `shopbookorders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `masterid` int(11) NOT NULL,
  `orderdate` date NOT NULL,
  `orderno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mop` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO shopbookorders VALUES("19","1","1970-01-01","AFCS/adm-09/20/005","989888888","Nothing","ONLINE","10","140","pravin nagar amravati","2020-09-26 18:47:29","2020-09-26 18:47:29");
INSERT INTO shopbookorders VALUES("18","1","1970-01-01","AFCS/adm-09/20/004","8600218059","Nothing","ONLINE","0","560","pravin nagar amravati","2020-09-26 18:41:36","2020-09-26 18:41:36");
INSERT INTO shopbookorders VALUES("16","1","1970-01-01","AFCS/adm-09/20/002","989888888","Nothing","ONLINE","0","800","pravin nagar amravati","2020-09-26 18:40:58","2020-09-26 18:40:58");
INSERT INTO shopbookorders VALUES("17","1","1970-01-01","AFCS/adm-09/20/003","9898989898","Nothing","ONLINE","0","918","pravin nagar amravati","2020-09-26 18:41:14","2020-09-26 18:41:14");
INSERT INTO shopbookorders VALUES("15","1","1970-01-01","AFCS/adm-09/20/001","989888888","Nothing","ONLINE","0","375","pune","2020-09-26 18:40:41","2020-09-26 18:40:41");
INSERT INTO shopbookorders VALUES("20","1","1970-01-01","AFCS/adm-09/20/006","989888888","Nothing","ONLINE","10","140","pravin nagar amravati","2020-09-26 18:49:53","2020-09-26 18:49:53");
INSERT INTO shopbookorders VALUES("21","1","1970-01-01","AFCS/adm-09/20/007","989888888","Nothing","ONLINE","4","110","pune","2020-09-26 18:50:11","2020-09-26 18:50:11");
INSERT INTO shopbookorders VALUES("22","1","1970-01-01","AFCS/adm-09/20/008","989888888","Nothing","ONLINE","8","370","pune","2020-09-26 18:50:30","2020-09-26 18:50:30");
INSERT INTO shopbookorders VALUES("23","1","1970-01-01","AFCS/adm-09/20/009","989888888","Nothing","ONLINE","5","380","pune","2020-09-26 19:17:36","2020-09-26 19:17:36");
INSERT INTO shopbookorders VALUES("24","1","1970-01-01","AFCS/adm-09/20/010","989888888","Nothing","ONLINE","10","140","pravin nagar amravati","2020-09-26 19:20:14","2020-09-26 19:20:14");
INSERT INTO shopbookorders VALUES("25","1","1970-01-01","AFCS/adm-09/20/011","989888888","Nothing","CASH","0","150","pravin nagar amravati","2020-09-28 13:07:33","2020-09-28 13:07:33");
INSERT INTO shopbookorders VALUES("26","1","1970-01-01","AFCS/adm-09/20/012","9898998898","Nothing","CASH","0","150","pune","2020-09-28 13:08:49","2020-09-28 13:08:49");
INSERT INTO shopbookorders VALUES("27","1","2020-02-10","AFCS/adm-10/20/001","9885544565","Nothing","CASH","0","300","pravin nagar amravati","2020-10-02 11:27:04","2020-10-02 11:27:04");



DROP TABLE shoporderlists;

CREATE TABLE `shoporderlists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL,
  `masterid` int(11) NOT NULL,
  `itemname` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO shoporderlists VALUES("34","20","1","mashroom masala","3","150","2020-09-26 18:49:53","2020-09-26 18:49:53");
INSERT INTO shoporderlists VALUES("35","21","1","panner bhurji","2","114","2020-09-26 18:50:11","2020-09-26 18:50:11");
INSERT INTO shoporderlists VALUES("36","22","1","shahi panner","7","378","2020-09-26 18:50:30","2020-09-26 18:50:30");
INSERT INTO shoporderlists VALUES("37","23","1","chicken lollypop","1","150","2020-09-26 19:17:36","2020-09-26 19:17:36");
INSERT INTO shoporderlists VALUES("38","23","1","chicken 360","1","160","2020-09-26 19:17:36","2020-09-26 19:17:36");
INSERT INTO shoporderlists VALUES("33","19","1","Raw Chicken","3","150","2020-09-26 18:47:29","2020-09-26 18:47:29");
INSERT INTO shoporderlists VALUES("32","19","1","chicken lollypop","1","150","2020-09-26 18:47:29","2020-09-26 18:47:29");
INSERT INTO shoporderlists VALUES("31","18","1","Kabab Chicken","15","525","2020-09-26 18:41:36","2020-09-26 18:41:36");
INSERT INTO shoporderlists VALUES("27","15","1","chiicken tikka","5","375","2020-09-26 18:40:41","2020-09-26 18:40:41");
INSERT INTO shoporderlists VALUES("28","16","1","chicken 360","5","800","2020-09-26 18:40:58","2020-09-26 18:40:58");
INSERT INTO shoporderlists VALUES("29","17","1","Mughlai Koram","17","918","2020-09-26 18:41:14","2020-09-26 18:41:14");
INSERT INTO shoporderlists VALUES("30","18","1","Kabab Chicken","1","35","2020-09-26 18:41:36","2020-09-26 18:41:36");
INSERT INTO shoporderlists VALUES("39","23","1","chiicken tikka","1","75","2020-09-26 19:17:36","2020-09-26 19:17:36");
INSERT INTO shoporderlists VALUES("40","24","1","chicken lollypop","1","150","2020-09-26 19:20:14","2020-09-26 19:20:14");
INSERT INTO shoporderlists VALUES("41","25","1","chicken lollypop","1","150","2020-09-28 13:07:33","2020-09-28 13:07:33");
INSERT INTO shoporderlists VALUES("42","26","1","chicken lollypop","1","150","2020-09-28 13:08:49","2020-09-28 13:08:49");
INSERT INTO shoporderlists VALUES("43","27","1","chicken lollypop","1","150","2020-10-02 11:27:04","2020-10-02 11:27:04");



DROP TABLE shops;

CREATE TABLE `shops` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `masterid` int(11) NOT NULL,
  `userid` int(10) NOT NULL,
  `shopname` varchar(350) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uniqueprefix` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO shops VALUES("20","1","31","CHAPARASIPURA","CHA","CHAPARASIPURA","2020-10-02 18:51:16","2020-10-02 18:51:16");
INSERT INTO shops VALUES("21","1","32","BADNERA","BAD","BADNERA","2020-10-02 18:51:51","2020-10-02 18:51:51");



DROP TABLE telebookorders;

CREATE TABLE `telebookorders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `masterid` int(11) NOT NULL,
  `orderdate` date NOT NULL,
  `orderno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `custname` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopname` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mop` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timetaken` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestatus` int(10) NOT NULL,
  `amount` int(11) NOT NULL,
  `collectedcash` int(10) NOT NULL,
  `paidstatus` int(2) NOT NULL DEFAULT '0',
  `assignto` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deliveryboyid` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=226 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO telebookorders VALUES("222","1","1970-01-01","AFCT/adm-09/20/010","mohsin sk","8329089765","Nothing","pravin nagar near vmv college behind mosque amravati","Chaprasipura","CASH","00:00:00","0","408","0","0","akshay malik","3","2020-09-28 13:11:31","2020-09-28 13:11:39");
INSERT INTO telebookorders VALUES("221","1","1970-01-01","AFCT/adm-09/20/009","mohsin sk","8329089765","Nothing","pravin nagar near vmv college behind mosque amravati","Chaprasipura","ONLINE","00:01:19","1","150","0","-1","rahul dhole","2","2020-09-28 13:09:43","2020-09-28 13:11:10");
INSERT INTO telebookorders VALUES("218","1","1970-01-01","AFCT/adm-09/20/006","Ashish","8600218059","Nothing","pune","Chaprasipura","CASH","00:00:00","0","490","0","0","null","0","2020-09-26 18:50:54","2020-09-26 18:50:54");
INSERT INTO telebookorders VALUES("219","1","1970-01-01","AFCT/adm-09/20/007","kapil sharma","9665665026","Nothing","amravati","Chaprasipura","CASH","00:00:00","0","150","0","0","null","0","2020-09-26 19:30:16","2020-09-26 19:30:16");
INSERT INTO telebookorders VALUES("220","1","1970-01-01","AFCT/adm-09/20/008","kapil sharma","9665665026","Nothing","amravati","Chaprasipura","CASH","00:00:00","0","150","0","0","null","0","2020-09-28 13:07:10","2020-09-28 13:07:10");
INSERT INTO telebookorders VALUES("216","1","1970-01-01","AFCT/adm-09/20/004","Ashish","8600218059","Nothing","pune","Chaprasipura","CASH","00:05:40","1","400","350","1","rahul dhole","2","2020-09-26 18:40:04","2020-09-26 18:45:51");
INSERT INTO telebookorders VALUES("217","1","1970-01-01","AFCT/adm-09/20/005","Mayur wankhade","8805996248","Nothing","amravati","Chaprasipura","CASH","00:04:37","1","105","0","-1","null","0","2020-09-26 18:40:16","2020-09-26 18:45:01");
INSERT INTO telebookorders VALUES("215","1","1970-01-01","AFCT/adm-09/20/003","mohsin khan","9579309718","Nothing","dhule","Chaprasipura","CASH","00:05:21","1","600","0","-1","null","0","2020-09-26 18:39:52","2020-09-26 18:45:22");
INSERT INTO telebookorders VALUES("214","1","1970-01-01","AFCT/adm-09/20/002","mohsin sk","8329089765","Nothing","pravin nagar near vmv college behind mosque amravati","Chaprasipura","CASH","00:03:35","1","540","400","1","rahul dhole","2","2020-09-26 18:39:36","2020-09-26 18:43:23");
INSERT INTO telebookorders VALUES("213","1","1970-01-01","AFCT/adm-09/20/001","kapil sharma","9665665026","Nothing","amravati","Chaprasipura","CASH","00:06:29","1","750","700","1","rahul dhole","2","2020-09-26 18:39:22","2020-09-26 18:45:55");
INSERT INTO telebookorders VALUES("223","19","2020-02-10","AFCT/ajy-10/20/001","Neha","9975728747","Nothing","camp","Chaprasipura","CASH","00:00:00","0","230","0","0","LAXMAN THAKARE","6","2020-10-02 08:32:10","2020-10-02 19:09:25");
INSERT INTO telebookorders VALUES("224","1","2020-02-10","AFCT/adm-10/20/002","mohsin sk","8329089765","Nothing","pravin nagar near vmv college behind mosque amravati","vilas nagar","ONLINE","00:00:26","1","72","72","1","rahul dhole","2","2020-10-02 11:25:46","2020-10-02 11:26:43");
INSERT INTO telebookorders VALUES("225","1","2020-02-10","AFCT/adm-10/20/003","ANAND","9975728747","N/A","CAMP","CHAPARASIPURA","CASH","00:00:11","1","890","0","1","LAXMAN THAKARE","6","2020-10-02 19:06:37","2020-10-02 19:09:25");



DROP TABLE telecallers;

CREATE TABLE `telecallers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE teleorderlists;

CREATE TABLE `teleorderlists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `masterid` int(10) NOT NULL,
  `orderid` int(11) NOT NULL,
  `itemname` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deliveryboyid` int(10) NOT NULL,
  `weight` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=514 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO teleorderlists VALUES("505","1","222","chicken lollypop","3","1","150","2020-09-28 13:11:31","2020-09-28 13:11:39");
INSERT INTO teleorderlists VALUES("508","1","222","Mughlai Koram","3","1","54","2020-09-28 13:11:31","2020-09-28 13:11:39");
INSERT INTO teleorderlists VALUES("507","1","222","Mughlai Koram","3","1","54","2020-09-28 13:11:31","2020-09-28 13:11:39");
INSERT INTO teleorderlists VALUES("506","1","222","chicken lollypop","3","1","150","2020-09-28 13:11:31","2020-09-28 13:11:39");
INSERT INTO teleorderlists VALUES("504","1","221","chicken lollypop","2","1","150","2020-09-28 13:09:43","2020-09-28 13:10:15");
INSERT INTO teleorderlists VALUES("503","1","220","chicken lollypop","0","1","150","2020-09-28 13:07:10","2020-09-28 13:07:10");
INSERT INTO teleorderlists VALUES("502","1","219","chicken lollypop","0","1","150","2020-09-26 19:30:16","2020-09-26 19:30:16");
INSERT INTO teleorderlists VALUES("501","1","218","egg masala","0","7","490","2020-09-26 18:50:54","2020-09-26 18:50:54");
INSERT INTO teleorderlists VALUES("500","1","218","chicken lollypop","0","1","150","2020-09-26 18:50:54","2020-09-26 18:50:54");
INSERT INTO teleorderlists VALUES("499","1","217","biryani","0","7","105","2020-09-26 18:40:16","2020-09-26 18:40:16");
INSERT INTO teleorderlists VALUES("498","1","216","live bird","2","4","400","2020-09-26 18:40:04","2020-09-26 18:45:39");
INSERT INTO teleorderlists VALUES("497","1","215","chciken","0","5","600","2020-09-26 18:39:52","2020-09-26 18:39:52");
INSERT INTO teleorderlists VALUES("496","1","214","boneless chciken","2","3","540","2020-09-26 18:39:36","2020-09-26 18:43:05");
INSERT INTO teleorderlists VALUES("495","1","213","chicken lollypop","2","5","750","2020-09-26 18:39:22","2020-09-26 18:45:39");
INSERT INTO teleorderlists VALUES("509","1","224","panner bhurji","2","1","57","2020-10-02 11:25:46","2020-10-02 11:26:08");
INSERT INTO teleorderlists VALUES("510","1","224","biryani","2","1","15","2020-10-02 11:25:46","2020-10-02 11:26:08");
INSERT INTO teleorderlists VALUES("511","1","225","CHICKEN CURRY PIECE ( SMALL)","6","1","220","2020-10-02 19:06:37","2020-10-02 19:09:25");
INSERT INTO teleorderlists VALUES("512","1","225","CHICKEN CURRY PIECE ( MEDIUM)","6","1","220","2020-10-02 19:06:37","2020-10-02 19:09:25");
INSERT INTO teleorderlists VALUES("513","1","225","CHICKEN LOLLIPOP","6","1","450","2020-10-02 19:06:37","2020-10-02 19:09:25");



DROP TABLE usermanages;

CREATE TABLE `usermanages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uniqueprefix` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `master` int(11) DEFAULT NULL,
  `shop` int(11) DEFAULT NULL,
  `telecaller` int(11) DEFAULT NULL,
  `report` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO usermanages VALUES("1","admin","adm","$2y$10$eHNmQsnI76j3zazcsSfpDOEoNTcZDpM0wjXEsS62HQ3fhKaUbg7se","admin@fmg.com","1","1","1","1","1","2020-09-14 10:50:14","2020-09-24 16:35:02");
INSERT INTO usermanages VALUES("2","chaprasipura","Cha","$2y$10$tuL4vL21idkpdCNzD0ROc.XoO7oLqT160B7HfOHJtwdxAkjqh8Vzy","demo@gmail.com","2","","1","","","2020-09-14 10:53:54","2020-09-14 10:53:54");
INSERT INTO usermanages VALUES("3","dasturnagar","Das","$2y$10$Od0T6e9dRe.sHxszkmikguGE9VCSYTN1mp0FEIcnU47ba.andjsJ.","demo@gmail.com","2","","1","","","2020-09-14 10:54:41","2020-09-14 10:54:41");
INSERT INTO usermanages VALUES("4","vilasnagarshop","vil","$2y$10$/Rvq4SviuFdpBneQSiFolOSActr1U5RdgmRfuehnvhygqfzfMdiM2","demo@gmail.com","2","","1","","","2020-09-14 10:55:24","2020-09-14 10:55:24");
INSERT INTO usermanages VALUES("5","rajkamal","ra1","$2y$10$mwIzFqh.aYxJTY792NY85uINmo9Ospma7kenaidrcJludVwcTZDie","demo@gmail.com","2","","1","","","2020-09-14 10:56:56","2020-09-14 10:56:56");
INSERT INTO usermanages VALUES("15","pravinnagar","pra","$2y$10$hI7jB/DxZLqWlQr1cFn60uM71PnNXez73/qbJqH/ey4M7WUvCZ.yS","demo@gmail.com","2","","1","","","2020-09-14 12:22:16","2020-09-14 12:22:16");
INSERT INTO usermanages VALUES("16","frezerpura","frx","$2y$10$nhf9pXD4JR9C4bPVbSAy/uqtwu9aoGU75ARapxZOKvKo1xnPPavDC","fer@gmail.com","2","","1","","","2020-09-14 12:23:14","2020-09-14 12:23:14");
INSERT INTO usermanages VALUES("17","newshop","new","$2y$10$dv8dfb1czsG2hP1FcJzczOfFYW76QAT7nhgxTduKY8uiIl2FPz2FG","demo@gmail.com","2","","1","","","2020-09-14 12:25:13","2020-09-14 12:25:13");
INSERT INTO usermanages VALUES("19","Ajaytelecaller","ajy","$2y$10$Hkb2ktgFqIHFzVMFhN/S/.rul6KJQYddowQ/DCMxSwyjm7ENlRVnS","demo@gmail.com","3","","","1","","2020-09-14 12:46:30","2020-09-14 12:46:30");
INSERT INTO usermanages VALUES("28","demo","123","$2y$10$SgU/ZscaZ2GzcBfQKiQ4x.5w3XPH.7KLLTYLlsMgb.LSxBq2dShOq","demo@gmail.com","3","1","1","1","1","2020-09-28 12:25:28","2020-09-28 12:25:28");
INSERT INTO usermanages VALUES("21","sameertelecaller","sam","$2y$10$lGjf1GYAY0tso.q.7VNJ2uHIDVhba/cu0Zx1lQdlJ2MJTyCYtZeUC","demo@gmail.com","3","","","1","","2020-09-14 13:19:41","2020-09-14 13:19:41");
INSERT INTO usermanages VALUES("31","AMRUTACHA","CHA","$2y$10$F2ePl3ByMbnLf7fRDu0y0.AiG4XEOaoKaO21C/SvQNc9IZjSajA4m","amrutahatcheries2@gmail.com","2","","1","","","2020-10-02 18:51:16","2020-10-02 18:51:16");
INSERT INTO usermanages VALUES("32","AMRUTABD","BAD","$2y$10$6/196NwqcbaOE8MHpy3FIewCDz2BQSWkbXdMS44i2MPlAbWDZa99G","amrutahatcheries2@gmail.com","2","","1","","","2020-10-02 18:51:51","2020-10-02 18:51:51");



