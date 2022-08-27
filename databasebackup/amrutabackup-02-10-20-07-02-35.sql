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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO cancelorders VALUES("8","217","1","1970-01-01","AFCT/adm-09/20/005","Mayur wankhade","8805996248","Nothing","amravati","Chaprasipura","CASH","00:04:37","null","0","1","-1","mistake","0","105","2020-09-26 18:45:01","2020-09-26 18:45:01");
INSERT INTO cancelorders VALUES("9","215","1","1970-01-01","AFCT/adm-09/20/003","mohsin khan","9579309718","Nothing","dhule","Chaprasipura","CASH","00:05:21","null","0","1","-1","money","0","600","2020-09-26 18:45:22","2020-09-26 18:45:22");
INSERT INTO cancelorders VALUES("10","221","1","1970-01-01","AFCT/adm-09/20/009","mohsin sk","8329089765","Nothing","pravin nagar near vmv college behind mosque amravati","Chaprasipura","ONLINE","00:01:19","rahul dhole","2","1","-1","nn","0","150","2020-09-28 13:11:10","2020-09-28 13:11:10");
INSERT INTO cancelorders VALUES("11","223","1","2020-01-10","AFCT/adm-10/20/001","kapil sharma","9665665026","Nothing","amravati","Chaprasipura","CASH","00:00:04","null","0","1","-1","a","0","150","2020-10-01 19:39:25","2020-10-01 19:39:25");



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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO customers VALUES("1","10","Person","Mayur wankhade","8805996248","amravati","2020-09-14 10:51:04","2020-09-25 15:29:42");
INSERT INTO customers VALUES("2","10","Person","saurav","7559381887","akola","2020-09-14 10:51:18","2020-09-25 14:24:56");
INSERT INTO customers VALUES("3","10","Person","Ashish","8600218059","pune","2020-09-14 10:51:32","2020-09-24 19:07:22");
INSERT INTO customers VALUES("4","10","Person","mohsin khan","9579309718","dhule","2020-09-14 10:51:51","2020-09-25 11:06:05");
INSERT INTO customers VALUES("5","1","Person","mohsin sk","8329089765","pravin nagar near vmv college behind mosque amravati","2020-09-24 18:40:20","2020-09-25 16:36:47");
INSERT INTO customers VALUES("6","1","Person","kapil sharma","9665665026","amravati","2020-09-25 15:30:12","2020-09-26 19:30:50");



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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO deliveryboys VALUES("1","10","Sunil khadare","9887744563","amar colony amravati","2020-09-14 10:57:30","2020-09-14 10:57:30");
INSERT INTO deliveryboys VALUES("2","10","rahul dhole","8554411236","prabha colony","2020-09-14 10:57:58","2020-09-14 10:57:58");
INSERT INTO deliveryboys VALUES("3","10","akshay malik","8554411474","mahajan colony","2020-09-14 10:58:28","2020-09-14 10:58:28");
INSERT INTO deliveryboys VALUES("4","1","virat kohli","9887755465","pravin nagar amravati","2020-09-25 14:24:19","2020-09-25 14:24:19");



DROP TABLE failed_jobs;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO items VALUES("1","10","chicken lollypop","150","2020-09-14 10:52:07","2020-09-14 10:52:07");
INSERT INTO items VALUES("2","10","boneless chciken","180","2020-09-14 10:52:16","2020-09-14 10:52:16");
INSERT INTO items VALUES("3","10","chciken","120","2020-09-14 10:52:26","2020-09-14 10:52:26");
INSERT INTO items VALUES("4","10","live bird","100","2020-09-14 10:52:33","2020-09-14 10:52:33");
INSERT INTO items VALUES("5","1","Raw Chicken","50","2020-09-26 12:33:18","2020-09-26 12:33:18");
INSERT INTO items VALUES("6","1","biryani","15","2020-09-26 18:36:38","2020-09-26 18:36:38");
INSERT INTO items VALUES("7","1","chiicken tikka","75","2020-09-26 18:36:47","2020-09-26 18:36:47");
INSERT INTO items VALUES("8","1","chicken 360","160","2020-09-26 18:37:48","2020-09-26 18:37:48");
INSERT INTO items VALUES("9","1","Mughlai Koram","54","2020-09-26 18:38:05","2020-09-26 18:38:05");
INSERT INTO items VALUES("10","1","Kabab Chicken","35","2020-09-26 18:38:43","2020-09-26 18:38:43");
INSERT INTO items VALUES("11","1","mashroom masala","50","2020-09-26 18:48:56","2020-09-26 18:48:56");
INSERT INTO items VALUES("12","1","panner bhurji","57","2020-09-26 18:49:04","2020-09-26 18:49:04");
INSERT INTO items VALUES("13","1","shahi panner","54","2020-09-26 18:49:12","2020-09-28 12:26:23");



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
INSERT INTO shopbookorders VALUES("27","1","2020-02-10","AFCS/adm-10/20/001","9885545454","Nothing","CASH","0","10000","pravin nagar amravati","2020-10-02 14:31:53","2020-10-02 14:31:53");



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
INSERT INTO shoporderlists VALUES("43","27","1","live bird","100","10000","2020-10-02 14:31:53","2020-10-02 14:31:53");



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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO shops VALUES("1","10","2","Chaprasipura","cha","chaprasipura near camp, amravati","2020-09-14 10:53:54","2020-09-14 10:53:54");
INSERT INTO shops VALUES("2","10","3","Dastur nagar","Das","dastur nagar badnere road amravati","2020-09-14 10:54:41","2020-09-14 10:54:41");
INSERT INTO shops VALUES("3","10","4","vilas nagar","vil","vilas nagar,cotton market road amravati","2020-09-14 10:55:24","2020-09-14 10:55:24");
INSERT INTO shops VALUES("4","10","5","rajkamal","ra1","rajkamal near jayastambh amravati","2020-09-14 10:56:56","2020-09-14 10:56:56");
INSERT INTO shops VALUES("14","1","15","pravinnagar","pra","pravin nagar near vmv college amravati","2020-09-14 12:22:16","2020-09-14 12:22:16");
INSERT INTO shops VALUES("15","1","16","frezarpura","frx","fezar pura amravati","2020-09-14 12:23:14","2020-09-14 12:23:14");
INSERT INTO shops VALUES("16","1","17","newshop","new","newshop akola","2020-09-14 12:25:13","2020-09-14 12:25:13");
INSERT INTO shops VALUES("17","1","18","mahendra","mah","amravati","2020-09-14 12:36:27","2020-09-14 12:36:27");



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
  `paidstatus` int(2) NOT NULL DEFAULT 0,
  `assignto` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deliveryboyid` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=225 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO telebookorders VALUES("224","1","2020-02-10","AFCT/adm-10/20/002","Ashish","8600218059","Nothing","pune","Chaprasipura","CASH","00:00:00","0","600","0","0","null","0","2020-10-02 14:31:29","2020-10-02 14:31:29");
INSERT INTO telebookorders VALUES("223","1","2020-01-10","AFCT/adm-10/20/001","kapil sharma","9665665026","Nothing","amravati","Chaprasipura","CASH","00:00:04","1","150","0","-1","null","0","2020-10-01 19:39:15","2020-10-01 19:39:25");
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

INSERT INTO teleorderlists VALUES("513","1","224","chicken lollypop","0","1","150","2020-10-02 14:31:29","2020-10-02 14:31:29");
INSERT INTO teleorderlists VALUES("505","1","222","chicken lollypop","3","1","150","2020-09-28 13:11:31","2020-09-28 13:11:39");
INSERT INTO teleorderlists VALUES("512","1","224","chicken lollypop","0","1","150","2020-10-02 14:31:29","2020-10-02 14:31:29");
INSERT INTO teleorderlists VALUES("511","1","224","chicken lollypop","0","1","150","2020-10-02 14:31:29","2020-10-02 14:31:29");
INSERT INTO teleorderlists VALUES("510","1","224","chicken lollypop","0","1","150","2020-10-02 14:31:29","2020-10-02 14:31:29");
INSERT INTO teleorderlists VALUES("509","1","223","chicken lollypop","0","1","150","2020-10-01 19:39:15","2020-10-01 19:39:15");
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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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



DROP TABLE users;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`) USING HASH
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




