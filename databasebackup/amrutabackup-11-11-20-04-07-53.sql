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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO cancelorders VALUES("13","518","1","2020-10-10","AFCT/adm-10/20/001","SANDIP VISHWAKARMA","8483988094","Nothing","GALLI NO.5,VILAS NAGAR","Akoli","CASH","00:05:28","HIRA PAWAR","12","1","-1","money","0","615","2020-10-10 11:30:08","2020-10-10 11:30:08");
INSERT INTO cancelorders VALUES("12","519","1","2020-10-10","AFCT/adm-10/20/002","SANDIP VISHWAKARMA","8483988094","Nothing","GALLI NO.5,VILAS NAGAR","Akoli","CASH","00:04:49","HIRA PAWAR","12","1","-1","issue","0","660","2020-10-10 11:29:51","2020-10-10 11:29:51");
INSERT INTO cancelorders VALUES("11","467","1","2020-09-10","AFCT/adm-10/20/058","MANISH KACHVE","9890205109","NA","BACK SIDE OF SAIBABA VIDYALAYA,UDAY COLONY NO.1","Akoli","CASH","00:03:11","null","0","1","-1","aisihi","0","660","2020-10-09 11:56:55","2020-10-09 11:56:55");



DROP TABLE customers;

CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `masterid` int(11) NOT NULL,
  `custtype` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `altmobile` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO customers VALUES("12","34","Person","SUKESHNI GEDAM","8600104843","0","FLAT NO. 302B VISAVA COLONY LOTUS GARDEN NEAR COLLECTOR BUNGLOW","2020-10-03 13:10:48","2020-10-03 13:10:48");
INSERT INTO customers VALUES("13","34","Person","SONALI PADOLE","9049702889","9049702889","VIVEKANAND COLONY GAJANAN BABA MANDIR,RUKMINI NAGAR","2020-10-03 13:19:09","2020-10-03 13:19:09");
INSERT INTO customers VALUES("14","34","Person","DR. RAGINI DESHMUKH","9604072360","0","BEHIND IMA HALL AMT","2020-10-03 13:22:03","2020-10-03 13:22:03");
INSERT INTO customers VALUES("15","33","Person","ABHINAV KHERDE","9922527348","0","NEMANE GADAUN PARIJAT COLNY","2020-10-03 13:28:31","2020-10-03 13:28:31");
INSERT INTO customers VALUES("16","34","Person","SURAJ PATIL","8007052741","0","AMAR BHAGAT SINGH CHOWK, FREZARPURA","2020-10-03 13:31:19","2020-10-03 13:31:19");
INSERT INTO customers VALUES("17","33","Person","ABHINAV KHERDE","9922527348","0","PARIJAT  COLNY  NEYR  NEMANE GODAUN","2020-10-03 13:41:06","2020-10-03 13:41:06");
INSERT INTO customers VALUES("18","34","Person","SURESH SHIRSAT","7741885830","0","NEW PAWAN NAGAR ARIHANT HOSPITAL ROAD BADNERAROAD","2020-10-03 13:50:23","2020-10-03 13:50:23");
INSERT INTO customers VALUES("19","33","Person","VRUSHBH DHAYE","7719967310","0","VARHADHI  THAT NEAR LOODS  HOTEL","2020-10-03 13:56:37","2020-10-03 13:56:37");
INSERT INTO customers VALUES("20","34","Person","KUNAL JAWARKAR","8169382828","0","SHRINATH WADI NEAR KALIMATA MANDIR BACK SIDE OF SMASHAN BHUMI AMT","2020-10-03 14:03:08","2020-10-03 14:03:08");
INSERT INTO customers VALUES("21","33","Person","DHANSHREE BANSOD","9764773264","0","GANEDIWAL LE-OUT CAMP","2020-10-03 14:03:39","2020-10-03 14:03:39");
INSERT INTO customers VALUES("22","34","Person","PRATIBHA BORKAR","7559269662","0","SHRIKANT SAHARE MARG FREZARPURA","2020-10-03 14:04:45","2020-10-03 14:04:45");
INSERT INTO customers VALUES("23","34","Person","VISHAL DHOKE","9623857633","0","SIDHHARTH CHOWK FREZARPURA","2020-10-03 14:07:04","2020-10-03 14:07:04");
INSERT INTO customers VALUES("24","33","Person","SARNG DAIVI","7350308540","0","VEER NAGAR TAWAR LINE ROD SHEGAW  NAKA","2020-10-03 14:07:07","2020-10-03 14:07:07");
INSERT INTO customers VALUES("25","34","Person","PADMASHRI DESHMUKH","8830560727","0","SAI HERITAGE APPARTMENT,SAI NAGAR,BADNERA","2020-10-03 16:58:01","2020-10-03 16:58:01");
INSERT INTO customers VALUES("26","34","Person","SMITA BANSOD","9284882993","0","NEAR AJAY MANGAL KARYALAY,YASHODA NAGAR BYE-PASS AMT","2020-10-03 17:01:09","2020-10-03 17:01:09");
INSERT INTO customers VALUES("27","33","Person","MANISH KEWLRAMANI","8484017292","0","SHIV GANGA  OIL MIL KE PAS","2020-10-03 17:04:11","2020-10-03 17:04:11");
INSERT INTO customers VALUES("28","34","Person","SHUBHAM DESHMUKH","9970078549","0","BALAJI NAGAR, KATORA ROAD IN FRONT OF ROHINI PARK","2020-10-03 17:06:04","2020-10-03 17:06:04");
INSERT INTO customers VALUES("29","33","Person","GOVARDHAN RAMTEKE","9881894911","0","PAWAN NAGAR BADNERA","2020-10-03 17:07:53","2020-10-03 17:07:53");
INSERT INTO customers VALUES("30","34","Person","ZOEB HASSONJEE","9423649860","0","ZOEB HASSONJEE,ZAINAB VILLA,OPPOSITE UTTAM LAWN INKAYA PURA CAMP AMT","2020-10-03 17:09:53","2020-10-03 17:09:53");
INSERT INTO customers VALUES("31","34","Person","DIPAK BAGERIYA","9804691800","0","VENUS PLAZA SHEGAON NAKA AMT","2020-10-03 17:12:01","2020-10-03 17:12:01");
INSERT INTO customers VALUES("32","33","Person","RADHA HUTKY","9325402133","0","VINUS PLAZA","2020-10-03 17:16:44","2020-10-03 17:16:44");
INSERT INTO customers VALUES("33","34","Person","MANOJ BHENDE","8806088227","0","KHAPARDE BAGICHA AMT","2020-10-03 17:20:11","2020-10-03 17:20:11");
INSERT INTO customers VALUES("34","34","Person","M.N.SHEIKH","9373832178","0","SAGAR NAGAR CHAPRASHIPURA","2020-10-03 17:23:38","2020-10-03 17:23:38");
INSERT INTO customers VALUES("35","34","Person","MAYUR METKAR","7620579657","0","JANATA BANK RATHI NAGAR AMT","2020-10-03 17:48:08","2020-10-03 17:48:08");
INSERT INTO customers VALUES("36","34","Person","AVINASH INGOLE","9011099878","0","RAM MEGHE COLLAGE VORDA BADNERA","2020-10-03 17:55:29","2020-10-03 17:55:29");
INSERT INTO customers VALUES("37","34","Person","SHIVAJI WANKHADE","9420125432","0","13,PARIJAT COLONY NEAR NEMANE GODOWN BADNERA","2020-10-03 17:58:07","2020-10-03 17:58:07");
INSERT INTO customers VALUES("38","33","Person","BIBISHA PTRA","9096989068","0","SATYDEV PARK  VILAS COLNY KATORA NAKA","2020-10-03 17:59:33","2020-10-03 17:59:33");
INSERT INTO customers VALUES("39","33","Person","RUDHRA BHENDE","9545190889","0","JOSHI COLNY  NEAR OLD MAFIL OPOZIT","2020-10-03 18:07:40","2020-10-03 18:07:40");
INSERT INTO customers VALUES("40","33","Person","SHUBHM RITHE","9028015730","0","SHREEDARSHN COLNY  ESHHA HOTEL APOZIT SAID  SATURNA","2020-10-03 18:10:58","2020-10-03 18:10:58");
INSERT INTO customers VALUES("41","34","Person","ASIT MOHAN","9044202204","0","JAY LAXMI RESIDENCY, ARJUN NAGAR NEAR PATANJALI STORE FLAT NO. 04 1ST FLOOR","2020-10-03 18:12:52","2020-10-03 18:12:52");
INSERT INTO customers VALUES("42","33","Person","SARANG DALVI","7350308540","0","VEER NAGAR TAWER LINE ROD  KATHORA NAKA","2020-10-03 18:15:45","2020-10-03 18:15:45");
INSERT INTO customers VALUES("43","34","Person","RAJESH KHATWA","9766225820","0","DAHISAT ROAD INSIDE AMBA GATE NEAR MAHAVEER PROVISION","2020-10-03 18:17:53","2020-10-03 18:17:53");
INSERT INTO customers VALUES("44","34","Person","MAYUR DERE","7028244207","0","RUKMINI NAGAR NEAR RATHOD PETROL PUMP","2020-10-03 18:19:59","2020-10-03 18:19:59");
INSERT INTO customers VALUES("45","34","Person","AJAY GAWANDE","8623995262","0","KISHOR NAGAR","2020-10-03 18:21:28","2020-10-03 18:21:28");
INSERT INTO customers VALUES("46","33","Person","ADITYA THAKUR","7558727003","0","JAY SIYARAM NAGAR  NIYAR","2020-10-03 18:24:08","2020-10-03 18:24:08");
INSERT INTO customers VALUES("47","34","Person","CHANCHAL SHINGADE","9552823955","0","YOGIRAJ NAGAR PANCHASHIL CHOWK TAPOVAN UNIVERSITY ROAD AMT..","2020-10-03 18:29:59","2020-10-03 18:29:59");
INSERT INTO customers VALUES("48","33","Person","DAYANAND DIKKA","8308707456","0","DATTA COLNY SAVTA MAIDAN ROD  NEAR JUNI BASTI","2020-10-03 18:30:55","2020-10-03 18:30:55");
INSERT INTO customers VALUES("49","34","Person","BITTU DENDULE","8485044270","0","AMBA GATE NEAR RAMKRISHNA SCHOOL","2020-10-03 18:31:40","2020-10-03 18:31:40");
INSERT INTO customers VALUES("50","34","Person","VIJAY GULHANE","9422126922","0","FLAT NO 98 SAI NAGAR NEAR SAI BABA SCHOOL BACK SIDE OF SAI MANDIR","2020-10-03 18:34:36","2020-10-03 18:34:36");
INSERT INTO customers VALUES("51","33","Person","RAJESH SOLNKE","9890290920","0","SANT NAMDEV NAGAR  NEAR MAHADEV KHORI TE MANGLDHAM ROD","2020-10-03 18:34:39","2020-10-03 18:34:39");
INSERT INTO customers VALUES("52","34","Person","SAGAR BOPATE","9545869824","0","NEAR MUNGSAJI MAHARAJ MANDIR, RAVI NAGAR","2020-10-03 18:38:21","2020-10-03 18:38:21");
INSERT INTO customers VALUES("53","33","Person","VAIBHAV RATHOD","9823419221","0","SAI  NAGAR NEAR  BENAM CHAIK","2020-10-03 18:39:20","2020-10-03 18:39:20");
INSERT INTO customers VALUES("54","34","Person","ANJALI BHAGWAT","7387373338","0","SAI SAMRUDHHI APPARTMENT MAHABANK COLONY AKOLI ROAD BADNERA","2020-10-03 18:42:09","2020-10-03 18:42:09");
INSERT INTO customers VALUES("55","34","Person","DR. DHOLE","9423126494","0","DR. DHOLE HOSPITAL RUKMINI NAGAR AMT","2020-10-03 18:44:29","2020-10-03 18:44:29");
INSERT INTO customers VALUES("56","33","Person","DINESH  JAYSWAL","7744848814","0","SHIV NAGAR  LAYBRY KE PASS  FREJRPURA","2020-10-03 18:47:45","2020-10-03 18:47:45");
INSERT INTO customers VALUES("57","34","Person","PARIMAL KOWALE","7798005296","0","NEAR SAI HEIGHT RATHI NAGR AMT","2020-10-03 18:49:02","2020-10-03 18:49:02");
INSERT INTO customers VALUES("59","34","Person","DR. SOMESH CHAUDHARI","9881388580","0","CHAUDHARI HOSPITAL RATHI NAGAR AMT","2020-10-03 18:53:12","2020-10-03 18:53:12");
INSERT INTO customers VALUES("60","34","Person","GAJANAN HANDE","8421032898","0","CHAITANYA COLONY IN FRONT OF POONAM PALACE OLD BYE-PASS YASHODA NAGAR","2020-10-03 18:58:02","2020-10-03 18:58:02");
INSERT INTO customers VALUES("61","34","Person","HOLA WALA","7020868720","0","UTTAM LAWN NEAR HASONJEE HOME","2020-10-03 19:35:25","2020-10-03 19:35:25");
INSERT INTO customers VALUES("62","33","Person","KEWIN LIWO","7972974748","0","GAJANAN NAGAR MHADA COLNY BADNERA","2020-10-05 10:32:30","2020-10-05 10:32:30");
INSERT INTO customers VALUES("63","33","Person","KEWIN LIWO","7972974748","0","GAJANAN NAGAR MHADA COLNY BADNERA","2020-10-05 10:32:31","2020-10-05 10:32:31");
INSERT INTO customers VALUES("64","34","Person","AMIT OGALE","8459796998","0","AKSHAY COLONY NEAR MEGHE LAY-OUT VIDYUT NAGAR V.M.V. ROAD AMT","2020-10-05 10:36:41","2020-10-05 10:36:41");
INSERT INTO customers VALUES("65","33","Person","AKASH SOLNKE","8956850852","0","MHADA COLNY VILAS NAGAR","2020-10-05 10:40:14","2020-10-05 10:40:14");
INSERT INTO customers VALUES("66","33","Person","HOTEL ATHWAN","9511854690","0","NAVSARI","2020-10-05 10:43:12","2020-10-05 10:43:12");
INSERT INTO customers VALUES("67","34","Person","SURAJ PATIL","8007052741","0","AMAR BHAGAT SINGH CHOWK FREZARPURA AMT","2020-10-05 10:55:09","2020-10-05 10:55:09");
INSERT INTO customers VALUES("68","34","Person","SATISH KURHADE","9765020494","0","JADHAV TVS IN FRONT OF RADHEY IN HOTEL NEAR RAILWAY STATION MAIN DEPO ROAD","2020-10-05 10:59:02","2020-10-05 10:59:02");
INSERT INTO customers VALUES("69","33","Person","SACHIN SHENDE","9717953707","0","GAJANAN TOWNSHIP, POTE COLLEGE","2020-10-05 10:59:09","2020-10-05 10:59:09");
INSERT INTO customers VALUES("70","33","Person","AYUSHI GULHANE","7588591989","0","NEAR LORDS HOTEL","2020-10-05 11:07:48","2020-10-05 11:07:48");
INSERT INTO customers VALUES("71","34","Person","RAJ HUDDA","8446291992","0","LAKADGANJ NEW TOWN BADNERA NEAR GURUDWARA","2020-10-05 11:08:09","2020-10-05 11:08:09");
INSERT INTO customers VALUES("72","33","Person","NAHID ANJUM","8888703679","0","GULJAR NAGAR","2020-10-05 11:09:22","2020-10-05 11:09:22");
INSERT INTO customers VALUES("73","34","Person","J.S. WAKODE","8329495099","0","SHANTI NAGAR NEAR YASHODA NAGAR NEAR AJAY MANGAL KARYALAY AMT","2020-10-05 11:10:29","2020-10-05 11:10:29");
INSERT INTO customers VALUES("74","34","Person","SUBODH AMBADEKAR","9561959585","0","NEAR HARIGANGA OIL NEAR NAGALKAR HOSPITAL AMT","2020-10-05 11:15:40","2020-10-05 11:15:40");
INSERT INTO customers VALUES("76","33","Person","LOKESH CHHABDA","9834492586","0","GREEN PARK SUDARSHAN BULDING","2020-10-05 11:17:42","2020-10-05 11:17:42");
INSERT INTO customers VALUES("77","34","Person","RAJESH MARVE","7385000732","0","TILAK NAGAR OLD TOWN BADNERA","2020-10-05 11:17:47","2020-10-05 11:17:47");
INSERT INTO customers VALUES("78","34","Person","SWATI LOKHANDE","9766438529","0","RACHNA RESIDENCY GANEDIWAL LAY-OUT AMT","2020-10-05 11:19:22","2020-10-05 11:19:22");
INSERT INTO customers VALUES("79","33","Person","POOJA  TAYDE","9890603679","0","HARSHRAJ STOP  NEAR CANRA BANK","2020-10-05 11:20:43","2020-10-05 11:20:43");
INSERT INTO customers VALUES("80","34","Person","PANKAJ DEVGADE","9096744922","0","TIRUMALLA COLONY NEAR SONAL COLONY PURVA TOWNSHIP","2020-10-05 11:21:43","2020-10-05 11:21:43");
INSERT INTO customers VALUES("81","33","Person","PANKAJ PARMAR","9131387423","0","GOVIND KRUPA RECIDANCYNEAR SHEGAWN RAHTGAWN ROD","2020-10-05 11:23:47","2020-10-05 11:23:47");
INSERT INTO customers VALUES("82","34","Person","SATISH KHADSE","7387855098","0","ANNABHAU SATHE NAGAR WADALI MATANGPURA","2020-10-05 11:23:59","2020-10-05 11:23:59");
INSERT INTO customers VALUES("83","33","Person","SONU GUDHADHE","9284186799","0","TAWAR LINE ROD","2020-10-05 11:26:02","2020-10-05 11:26:02");
INSERT INTO customers VALUES("84","34","Person","ANIL WANKHADE","9823144581","0","BYE PASS ROAD NEAR FOREST COLONY BOARD FREZARPURA","2020-10-05 11:27:16","2020-10-05 11:27:16");
INSERT INTO customers VALUES("85","33","Person","NITIN AMBORE","7972256572","0","NAVSRI","2020-10-05 11:28:08","2020-10-05 11:28:08");
INSERT INTO customers VALUES("86","1","Person","DR. ASHWIN KUMAR","9860600349","0","IMA HOLL","2020-10-05 11:28:47","2020-10-05 11:28:47");
INSERT INTO customers VALUES("87","34","Person","RAHUL PAHUWANI","9075012363","0","BABA HARIDAS RAM SOCIETY COVER NAGAR","2020-10-05 11:29:21","2020-10-05 11:29:21");
INSERT INTO customers VALUES("88","34","Person","AMRUTA BHARSAKLE","7499312963","0","PLOT NO. 102 CHIMOTE LAYOUT NEAR GONDBABA MANDIR","2020-10-05 11:31:05","2020-10-05 11:31:05");
INSERT INTO customers VALUES("89","34","Person","SHASHI CHATWANI","9422857300","0","NAVJIVAN COLONY SUDARSHAN BUILDING SHANKAR NAGAR ROAD","2020-10-05 11:34:47","2020-10-05 11:34:47");
INSERT INTO customers VALUES("90","34","Person","SANJAY PAWAR","9422154414","0","VASANT BUNGLOW CAMP KANTA NAGAR","2020-10-05 11:42:45","2020-10-05 11:42:45");
INSERT INTO customers VALUES("91","34","Person","MADHURA HALKARE","8446640876","0","21 SANTKRUPA INDRAYANI COLONY BADNERA ROAD OPPOSITE SIDE OF RANGOLI HOTEL","2020-10-05 11:48:43","2020-10-05 11:48:43");
INSERT INTO customers VALUES("92","34","Person","RAVINDRA SHEGOKAR","9423761970","0","NEAR MANDAR PETROL PUMP VILAS NAGAR WHITE BOARD PALACE BUILDING FLAT NO. 104","2020-10-05 12:00:17","2020-10-05 12:00:17");
INSERT INTO customers VALUES("93","34","Person","RAVINDRA SHEGOKAR","9423761970","0","NEAR MANDAR PETROL PUMP VILAS NAGAR WHITE BOARD PALACE BUILDING FLAT NO. 104","2020-10-05 12:00:18","2020-10-05 12:00:18");
INSERT INTO customers VALUES("94","34","Person","RAVINDRA SHEGOKAR","9423761970","0","NEAR MANDAR PETROL PUMP VILAS NAGAR WHITE BOARD PALACE BUILDING FLAT NO. 104","2020-10-05 12:00:21","2020-10-05 12:00:21");
INSERT INTO customers VALUES("95","34","Person","BHOJRAJ DHOLE","9890714149","0","RACHNA DREAMS CIRCUIT HOUSE ROAD CAMP","2020-10-05 12:01:42","2020-10-05 12:01:42");
INSERT INTO customers VALUES("97","34","Hotel","VINAY BASAK","8779797265","0","SHRI KRUPA NO. 1 APPARTMENT BHARAT NAGAR NO.1 AKOLI ROAD SAI NAGAR","2020-10-05 12:07:10","2020-10-14 19:25:24");
INSERT INTO customers VALUES("98","34","Person","OM PRAKASH KHATRI","8767725908","0","CHIMOTE LAYOUT NEAR GUNVANT LAWN","2020-10-05 12:08:32","2020-10-05 12:08:32");
INSERT INTO customers VALUES("99","34","Hotel","SUMIT GANDE","8308018555","0","LAXMI NARAYAN NAGAR,NEAR GONDBABA MANDIR","2020-10-05 12:10:25","2020-10-14 19:25:15");
INSERT INTO customers VALUES("100","34","Person","MUKESH MOHITE","7499575814","0","NIMBORA, BADNERA","2020-10-05 12:12:30","2020-10-05 12:12:30");
INSERT INTO customers VALUES("103","1","Hotel","SANDIP VISHWAKARMA","8483988094","0","GALLI NO.5,VILAS NAGAR","2020-10-05 12:16:27","2020-11-10 18:45:52");
INSERT INTO customers VALUES("115","1","Person","quazi","9999999999","99999999","RAIWAY QUARTER,OLD TOWN BADNERA","2020-11-10 18:17:37","2020-11-10 18:34:14");
INSERT INTO customers VALUES("118","1","Hotel","ram bhaduri","9999999999","8888888888","asdasd","2020-11-10 18:46:27","2020-11-10 18:46:27");



DROP TABLE dailyentries;

CREATE TABLE `dailyentries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `salegbird` int(11) NOT NULL,
  `openingbirds` int(11) NOT NULL,
  `salegwt` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billqtywt` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mortality` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wt` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `closingbird` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tsaleamt` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disamt` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salablechick` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO dailyentries VALUES("1","2020-11-04","12:32:00","4","0","4","4","3","4","3","4","44","4","2020-11-10 12:39:32","2020-11-10 12:39:32");
INSERT INTO dailyentries VALUES("3","2020-11-05","13:59:00","5","10","50","12","5","5","5","1200","50","50","2020-11-11 13:58:01","2020-11-11 13:58:01");



DROP TABLE dailysupers;

CREATE TABLE `dailysupers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `openingbirds` int(11) NOT NULL,
  `feedconsumption` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avgbirdwt` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mortality` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `closingbird` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO dailysupers VALUES("4","2020-11-04","12:52:00","3","3","3","3","4","2020-11-10 12:51:03","2020-11-10 12:51:03");



DROP TABLE deliveryboyorders;

CREATE TABLE `deliveryboyorders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `orderno` text NOT NULL,
  `ordernostring` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO deliveryboyorders VALUES("11","8","\"AFCT/adm-10/20/005\",\"AFCT/adm-10/20/004\",\"AFCT/adm-10/20/003\"","379,378,377","2020-10-06 16:16:59","2020-10-06 16:16:59");
INSERT INTO deliveryboyorders VALUES("12","6","\"AFCT/adm-10/20/002\",\"AFCT/adm-10/20/001\"","376,375","2020-10-06 16:17:08","2020-10-06 16:17:08");
INSERT INTO deliveryboyorders VALUES("13","6","\"AFCT/adm-10/20/006\"","380","2020-10-06 16:53:11","2020-10-06 16:53:11");
INSERT INTO deliveryboyorders VALUES("14","12","\"AFCT/adm-10/20/008\",\"AFCT/adm-10/20/007\"","382,381","2020-10-07 17:16:18","2020-10-07 17:16:18");
INSERT INTO deliveryboyorders VALUES("15","10","\"AFCT/adm-10/20/014\",\"AFCT/adm-10/20/013\",\"AFCT/adm-10/20/012\",\"AFCT/adm-10/20/011\",\"AFCT/adm-10/20/010\",\"AFCT/adm-10/20/009\"","388,387,386,385,384,383","2020-10-07 18:34:40","2020-10-07 18:34:40");
INSERT INTO deliveryboyorders VALUES("16","13","\"AFCT/adm-10/20/059\"","468","2020-10-09 11:59:15","2020-10-09 11:59:15");
INSERT INTO deliveryboyorders VALUES("17","8","\"AFCT/adm-10/20/004\",\"AFCT/adm-10/20/003\"","521,520","2020-10-10 11:29:20","2020-10-10 11:29:20");
INSERT INTO deliveryboyorders VALUES("18","12","\"AFCT/adm-10/20/002\",\"AFCT/adm-10/20/001\"","519,518","2020-10-10 11:29:30","2020-10-10 11:29:30");
INSERT INTO deliveryboyorders VALUES("19","10","\"AFCT/adm-10/20/014\",\"AFCT/adm-10/20/013\"","531,530","2020-10-10 16:01:29","2020-10-10 16:01:29");
INSERT INTO deliveryboyorders VALUES("20","16","\"AFCT/adm-10/20/012\",\"AFCT/adm-10/20/011\"","529,528","2020-10-10 16:01:39","2020-10-10 16:01:39");
INSERT INTO deliveryboyorders VALUES("21","13","\"AFCT/adm-10/20/044\"","563","2020-10-27 13:24:18","2020-10-27 13:24:18");
INSERT INTO deliveryboyorders VALUES("22","11","\"AFCT/adm-10/20/045\"","564","2020-10-27 13:39:25","2020-10-27 13:39:25");



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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO deliveryboys VALUES("18","1","ramesh","9999999999","adadadd","2020-10-09 11:48:07","2020-11-10 19:40:12");
INSERT INTO deliveryboys VALUES("8","1","AVINASH KAMBLE","9370942915","AMRAVATI","2020-10-02 18:55:16","2020-10-02 18:55:16");
INSERT INTO deliveryboys VALUES("13","1","asdd","5646446465","dasdasd","2020-10-09 11:46:53","2020-10-09 11:46:53");
INSERT INTO deliveryboys VALUES("10","1","ADITYA GAJBHIYE","7020740579","AMRAVATI","2020-10-02 19:00:14","2020-10-02 19:00:14");
INSERT INTO deliveryboys VALUES("11","1","ASHISH CHAUDHARI","8830809303","AMRAVATI","2020-10-02 19:01:42","2020-10-02 19:01:42");
INSERT INTO deliveryboys VALUES("12","1","HIRA PAWAR","8261822512","AMRAVATI","2020-10-02 19:03:36","2020-10-02 19:03:36");
INSERT INTO deliveryboys VALUES("14","1","asdad","5555555555","5555","2020-10-09 11:47:04","2020-10-09 11:47:04");
INSERT INTO deliveryboys VALUES("15","1","ada","8888888888","asddd","2020-10-09 11:47:16","2020-10-09 11:47:16");
INSERT INTO deliveryboys VALUES("16","1","asdadasd","9999999999","adsdasdasd","2020-10-09 11:47:28","2020-10-09 11:47:28");
INSERT INTO deliveryboys VALUES("17","1","rakesh","9999999999","dadasd","2020-10-09 11:47:40","2020-11-10 19:42:03");



DROP TABLE distributes;

CREATE TABLE `distributes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `vehno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `drivername` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noofbirds` int(11) NOT NULL,
  `totalwt` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avgbirdwt` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopcutunit` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO distributes VALUES("3","2020-11-11","15:37:00","mh-27aj4320","mahmood","3","1","3","mg","2020-11-11 15:35:51","2020-11-11 15:35:51");



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




DROP TABLE godawns;

CREATE TABLE `godawns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `geolocation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `godawnname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pername` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobno` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO godawns VALUES("1","pravin nagar","20.9307479,77.758749","nagpur","mohsin shiakh","123123213123","2","2020-11-10 16:17:36","2020-11-11 14:19:07");
INSERT INTO godawns VALUES("2","pravin nagar","20.9307479,77.758749","akola","ramesh sinha","123123213123","2","2020-11-10 16:18:26","2020-11-11 14:19:00");
INSERT INTO godawns VALUES("5","dasdjasdjsdkas","20.930738299999998,77.7587556","walgaon","Demo Tester","3324234234","32","2020-11-11 13:39:23","2020-11-11 14:18:53");



DROP TABLE grns;

CREATE TABLE `grns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `grnno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `vehicleno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO grns VALUES("4","AH/1120/001","2020-11-12","11:44:00","mh27aj4320","2","adasd","2020-11-11 11:42:51","2020-11-11 11:42:51");
INSERT INTO grns VALUES("6","AH/1120/002","2020-11-12","11:47:00","mh27aj4320","2","asdasd","2020-11-11 11:48:44","2020-11-11 11:48:44");
INSERT INTO grns VALUES("11","AH/1120/003","2020-11-05","11:54:00","mh27aj4320","2","asdasd","2020-11-11 11:51:13","2020-11-11 11:51:13");



DROP TABLE gtogs;

CREATE TABLE `gtogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `targetgod` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sourcegod` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicleno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `drivername` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `livebird` int(11) NOT NULL,
  `totalwt` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avgwt` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO gtogs VALUES("4","2020-11-12","14:04:00","5","2","mh27aj4320","abdu;","3","4","4","2020-11-11 14:01:54","2020-11-11 14:01:54");
INSERT INTO gtogs VALUES("2","2020-12-04","13:54:00","1","1","mh27aj4320","quazi","1","1","1","2020-11-10 13:52:43","2020-11-10 13:52:43");
INSERT INTO gtogs VALUES("5","2020-11-12","03:20:00","2","5","mh27aj4320","mahmood","3","2","3","2020-11-11 15:20:27","2020-11-11 15:20:27");



DROP TABLE items;

CREATE TABLE `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `masterid` int(11) NOT NULL,
  `itemname` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `retailrate` int(11) NOT NULL,
  `hotelrate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO items VALUES("38","1","chciken new","100","85","2020-11-10 18:58:57","2020-11-10 18:58:57");
INSERT INTO items VALUES("35","1","chicken liver","85","65","2020-10-16 12:49:55","2020-10-29 11:18:12");
INSERT INTO items VALUES("34","1","chiekn raw","253","543","2020-10-16 12:49:45","2020-11-10 19:03:03");
INSERT INTO items VALUES("32","1","chciken leg","120","100","2020-10-16 12:49:19","2020-10-16 12:49:19");
INSERT INTO items VALUES("33","1","chicken 360","200","150","2020-10-16 12:49:36","2020-10-16 12:49:36");



DROP TABLE lastidtables;

CREATE TABLE `lastidtables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastid` int(11) NOT NULL,
  `shopid` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO lastidtables VALUES("13","569","1","2020-11-02 15:44:33","2020-11-02 15:44:33");
INSERT INTO lastidtables VALUES("9","562","25","2020-10-16 15:29:06","2020-10-16 15:29:06");
INSERT INTO lastidtables VALUES("10","565","26","2020-10-29 11:08:23","2020-10-29 11:08:23");



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
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
INSERT INTO migrations VALUES("19","2020_11_09_195233_create_purchases_table","9");
INSERT INTO migrations VALUES("20","2020_11_09_195247_create_grns_table","9");
INSERT INTO migrations VALUES("21","2020_11_09_195304_create_dailysupers_table","9");
INSERT INTO migrations VALUES("22","2020_11_09_195319_create_distributes_table","9");
INSERT INTO migrations VALUES("23","2020_11_09_195337_create_dailyentries_table","10");
INSERT INTO migrations VALUES("24","2020_11_09_195419_create_gtogs_table","10");
INSERT INTO migrations VALUES("25","2020_11_09_195435_create_stos_table","10");
INSERT INTO migrations VALUES("26","2020_11_09_195446_create_stogs_table","10");
INSERT INTO migrations VALUES("27","2020_11_10_160833_create_godawns_table","11");
INSERT INTO migrations VALUES("28","2020_11_10_164019_create_vendors_table","12");
INSERT INTO migrations VALUES("29","2020_11_10_164036_create_units_table","12");



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




DROP TABLE purchases;

CREATE TABLE `purchases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `godawn` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateofpur` date NOT NULL,
  `vendor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uidrefno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `drivername` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transmornos` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transmorwt` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `noofbird` int(11) NOT NULL,
  `avgbodywt` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `labor` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO purchases VALUES("2","AH/1120/001","2","2020-11-06","2","dada3","mh-27aj4320","abdu;","23","2","35","23","2","0","32","3423","343434","2020-11-11 13:42:06","2020-11-11 13:42:06");
INSERT INTO purchases VALUES("3","AH/1120/002","5","2020-11-11","2","dada3","mh-27aj4320","abdul","23","2","32","54","54","0","54","455445","4","2020-11-11 13:45:46","2020-11-11 13:45:46");



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
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO shopbookorders VALUES("110","1","1970-01-01","AFCS/adm-10/20/005","9922857552","NA","ONLINE","0","200","RAIWAY QUARTER,OLD TOWN BADNERA","2020-10-23 11:28:45","2020-10-23 11:28:45");
INSERT INTO shopbookorders VALUES("109","1","2020-12-10","AFCS/adm-10/20/004","9922857552","NA","CASH","0","440","RAIWAY QUARTER,OLD TOWN BADNERA","2020-10-12 15:58:24","2020-10-12 15:58:24");
INSERT INTO shopbookorders VALUES("100","1","2020-10-10","AFCS/adm-10/20/001","8554455221","Nothing","CASH","0","660","amravati","2020-10-10 11:27:04","2020-10-10 11:27:04");
INSERT INTO shopbookorders VALUES("102","1","2020-10-10","AFCS/adm-10/20/003","8554455221","Nothing","CASH","0","2292","amravati","2020-10-10 15:03:34","2020-10-10 15:03:34");
INSERT INTO shopbookorders VALUES("101","1","2020-10-10","AFCS/adm-10/20/002","8554455221","Nothing","CASH","52","600","amravati","2020-10-10 11:27:44","2020-10-10 11:27:44");



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
) ENGINE=MyISAM AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO shoporderlists VALUES("154","110","1","chicken 360","1.000","200","2020-10-23 11:28:45","2020-10-23 11:28:45");
INSERT INTO shoporderlists VALUES("153","109","1","CHICKEN CURRY PIECE ( LARGE)","1.000","220","2020-10-12 15:58:24","2020-10-12 15:58:24");
INSERT INTO shoporderlists VALUES("152","109","1","CHICKEN CURRY PIECE ( LARGE)","1.000","220","2020-10-12 15:58:24","2020-10-12 15:58:24");
INSERT INTO shoporderlists VALUES("136","102","1","CHICKEN BIRYANI PIECE","1.547","340","2020-10-10 15:03:34","2020-10-10 15:03:34");
INSERT INTO shoporderlists VALUES("135","102","1","CHICKEN BIRYANI PIECE","7.000","1540","2020-10-10 15:03:34","2020-10-10 15:03:34");
INSERT INTO shoporderlists VALUES("129","100","1","CHICKEN CURRY PIECE ( LARGE)","1","220","2020-10-10 11:27:04","2020-10-10 11:27:04");
INSERT INTO shoporderlists VALUES("130","100","1","CHICKEN CURRY PIECE ( LARGE)","1","220","2020-10-10 11:27:04","2020-10-10 11:27:04");
INSERT INTO shoporderlists VALUES("131","100","1","CHICKEN CURRY PIECE ( LARGE)","1","220","2020-10-10 11:27:04","2020-10-10 11:27:04");
INSERT INTO shoporderlists VALUES("132","101","1","CHICKEN CURRY PIECE ( LARGE)","1","220","2020-10-10 11:27:44","2020-10-10 11:27:44");
INSERT INTO shoporderlists VALUES("133","101","1","CHICKEN CURRY PIECE ( LARGE)","1.968","433","2020-10-10 11:27:44","2020-10-10 11:27:44");
INSERT INTO shoporderlists VALUES("134","102","1","CHICKEN CURRY PIECE ( LARGE)","1.874","412","2020-10-10 15:03:34","2020-10-10 15:03:34");



DROP TABLE shops;

CREATE TABLE `shops` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `masterid` int(11) NOT NULL,
  `userid` int(10) NOT NULL,
  `shopname` varchar(350) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO shops VALUES("26","1","43","Akoliiii","akolaaaaaa","2020-10-06 12:52:32","2020-11-10 19:27:21");
INSERT INTO shops VALUES("25","1","42","Chaprasipura","amravati","2020-10-06 12:31:18","2020-10-06 12:51:41");



DROP TABLE stogs;

CREATE TABLE `stogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `targetgod` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sourceshop` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicleno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `drivername` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `livebird` int(11) NOT NULL,
  `totalwt` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avgwt` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO stogs VALUES("4","2020-11-05","16:06:00","2","25","mh27aj4320","mahmood","3","1","4","2020-11-11 16:04:55","2020-11-11 16:04:55");
INSERT INTO stogs VALUES("5","2020-11-17","16:08:00","1","26","mh27aj4320","quazi","3","1","4","2020-11-11 16:05:23","2020-11-11 16:05:23");
INSERT INTO stogs VALUES("6","2020-11-10","16:09:00","1","25","mh27aj4320","abdu;","3","4","4","2020-11-11 16:05:50","2020-11-11 16:05:50");



DROP TABLE stos;

CREATE TABLE `stos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `targetshop` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sourceshop` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicleno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `drivername` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `livebird` int(11) NOT NULL,
  `totalwt` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avgwt` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rawchicken` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO stos VALUES("2","2020-11-04","02:47:00","1","1","mh27aj4320","abdu;","3","4","4","12","2020-11-10 14:47:14","2020-11-10 14:47:14");
INSERT INTO stos VALUES("3","2020-11-05","15:51:00","26","25","mh27aj4320","mahmood","3","4","4","12","2020-11-11 15:50:03","2020-11-11 15:50:03");



DROP TABLE telebookorders;

CREATE TABLE `telebookorders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `masterid` int(11) NOT NULL,
  `orderdate` date NOT NULL,
  `orderno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `custname` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `altmobile` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=573 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO telebookorders VALUES("563","1","1970-01-01","AFCT/adm-10/20/044","SONALI PADOLE","9049702889","9049702889","NA","VIVEKANAND COLONY GAJANAN BABA MANDIR,RUKMINI NAGAR","Akoli","CASH","00:00:00","0","205","0","0","asdd","13","2020-10-27 13:24:05","2020-10-27 13:24:18");
INSERT INTO telebookorders VALUES("562","38","1970-01-01","AFCT/vjy-10/20/043","VRUSHBH DHAYE","7719967310","","NA","VARHADHI  THAT NEAR LOODS  HOTEL","Chaprasipura","CASH","00:00:00","0","480","0","0","null","0","2020-10-16 15:16:24","2020-10-16 15:16:24");
INSERT INTO telebookorders VALUES("560","38","1970-01-01","AFCT/vjy-10/20/041","DR. RAGINI DESHMUKH","9604072360","","NA","BEHIND IMA HALL AMT","Akoli","CASH","00:00:00","0","240","0","0","null","0","2020-10-16 15:16:01","2020-10-16 15:16:01");
INSERT INTO telebookorders VALUES("561","38","1970-01-01","AFCT/vjy-10/20/042","DR. RAGINI DESHMUKH","9604072360","","NA","BEHIND IMA HALL AMT","Chaprasipura","CASH","00:00:00","0","240","0","0","null","0","2020-10-16 15:16:14","2020-10-16 15:16:14");
INSERT INTO telebookorders VALUES("559","1","1970-01-01","AFCT/adm-10/20/040","ABHINAV KHERDE","9922527348","","NA","PARIJAT  COLNY  NEYR  NEMANE GODAUN","Akoli","CASH","00:00:00","0","240","0","0","null","0","2020-10-16 15:12:23","2020-10-16 15:12:23");
INSERT INTO telebookorders VALUES("558","1","1970-01-01","AFCT/adm-10/20/039","DR. RAGINI DESHMUKH","9604072360","","NA","BEHIND IMA HALL AMT","Akoli","CASH","00:00:00","0","240","0","0","null","0","2020-10-16 15:12:14","2020-10-16 15:12:14");
INSERT INTO telebookorders VALUES("557","1","1970-01-01","AFCT/adm-10/20/038","SURAJ PATIL","8007052741","","NA","AMAR BHAGAT SINGH CHOWK, FREZARPURA","Akoli","CASH","00:00:00","0","240","0","0","null","0","2020-10-16 15:09:53","2020-10-16 15:09:53");
INSERT INTO telebookorders VALUES("555","1","1970-01-01","AFCT/adm-10/20/037","SONALI PADOLE","9049702889","","NA","VIVEKANAND COLONY GAJANAN BABA MANDIR,RUKMINI NAGAR","Akoli","CASH","00:00:00","0","240","0","0","null","0","2020-10-15 15:06:38","2020-10-16 15:06:38");
INSERT INTO telebookorders VALUES("556","1","1970-01-01","AFCT/adm-10/20/037","ABHINAV KHERDE","9922527348","","NA","NEMANE GADAUN PARIJAT COLNY","Akoli","CASH","00:00:00","0","240","0","0","null","0","2020-10-15 15:09:47","2020-10-16 15:09:47");
INSERT INTO telebookorders VALUES("554","1","1970-01-01","AFCT/adm-10/20/037","SURAJ PATIL","8007052741","","NA","AMAR BHAGAT SINGH CHOWK, FREZARPURA","Akoli","CASH","00:00:00","0","600","0","0","null","0","2020-10-16 00:00:00","2020-10-16 15:02:34");
INSERT INTO telebookorders VALUES("552","1","1970-01-01","AFCT/adm-10/20/035","DR. RAGINI DESHMUKH","9604072360","","NA","BEHIND IMA HALL AMT","Akoli","CASH","00:00:00","0","480","0","0","null","0","2020-10-15 13:08:24","2020-10-15 13:08:24");
INSERT INTO telebookorders VALUES("553","1","1970-01-01","AFCT/adm-10/20/036","DR. RAGINI DESHMUKH","9604072360","","NA","BEHIND IMA HALL AMT","Akoli","CASH","00:00:00","0","360","0","0","null","0","2020-10-15 15:02:23","2020-10-16 15:02:23");
INSERT INTO telebookorders VALUES("551","1","1970-01-01","AFCT/adm-10/20/034","SUMIT GANDE","8308018555","","NA","LAXMI NARAYAN NAGAR,NEAR GONDBABA MANDIR","Akoli","CASH","00:00:00","0","260","0","0","null","0","2020-10-15 13:04:44","2020-10-15 13:04:44");
INSERT INTO telebookorders VALUES("550","1","1970-01-01","AFCT/adm-10/20/033","SUMIT GANDE","8308018555","","NA","LAXMI NARAYAN NAGAR,NEAR GONDBABA MANDIR","Akoli","CASH","00:00:00","0","390","0","0","null","0","2020-10-15 13:03:21","2020-10-15 13:03:21");
INSERT INTO telebookorders VALUES("548","1","1970-01-01","AFCT/adm-10/20/031","DR. RAGINI DESHMUKH","9604072360","","NA","BEHIND IMA HALL AMT","Akoli","CASH","00:00:00","0","420","0","0","null","0","2020-10-14 19:39:47","2020-10-14 19:39:47");
INSERT INTO telebookorders VALUES("549","1","1970-01-01","AFCT/adm-10/20/032","SANDIP VISHWAKARMA","8483988094","","NA","GALLI NO.5,VILAS NAGAR","Akoli","CASH","00:00:00","0","368","0","0","null","0","2020-10-14 19:40:31","2020-10-14 19:40:31");
INSERT INTO telebookorders VALUES("544","1","1970-01-01","AFCT/adm-10/20/027","NAZIM BULIDING WORK","9420269830","","NA","OLD BADNERA ,","Akoli","CASH","00:00:00","0","440","0","0","null","0","2020-10-13 10:38:27","2020-10-13 10:38:27");
INSERT INTO telebookorders VALUES("545","1","1970-01-01","AFCT/adm-10/20/028","ABHINAV KHERDE","9922527348","","NA","PARIJAT  COLNY  NEYR  NEMANE GODAUN","Akoli","CASH","00:00:00","0","702","0","0","null","0","2020-10-13 10:38:46","2020-10-13 10:38:46");
INSERT INTO telebookorders VALUES("546","1","1970-01-01","AFCT/adm-10/20/029","SONALI PADOLE","9049702889","","NA","VIVEKANAND COLONY GAJANAN BABA MANDIR,RUKMINI NAGAR","Akoli","CASH","00:00:00","0","660","0","0","null","0","2020-10-13 10:53:53","2020-10-13 10:53:53");
INSERT INTO telebookorders VALUES("547","1","1970-01-01","AFCT/adm-10/20/030","DR. RAGINI DESHMUKH","9604072360","","NA","BEHIND IMA HALL AMT","Akoli","CASH","00:00:00","0","440","0","0","null","0","2020-10-13 10:54:21","2020-10-13 10:54:21");
INSERT INTO telebookorders VALUES("542","1","2020-12-10","AFCT/adm-10/20/025","ANAND","9975728747","","NA","CAMP","Akoli","CASH","00:00:00","0","440","0","0","null","0","2020-10-12 16:39:12","2020-10-12 16:39:12");
INSERT INTO telebookorders VALUES("543","1","2020-12-10","AFCT/adm-10/20/026","DR. RAGINI DESHMUKH","9604072360","","NA","BEHIND IMA HALL AMT","Akoli","CASH","00:00:00","0","220","0","0","null","0","2020-10-12 16:39:16","2020-10-12 16:39:16");
INSERT INTO telebookorders VALUES("541","1","2020-12-10","AFCT/adm-10/20/024","SUKESHNI GEDAM","8600104843","","NA","FLAT NO. 302B VISAVA COLONY LOTUS GARDEN NEAR COLLECTOR BUNGLOW","Akoli","CASH","00:00:00","0","440","0","0","null","0","2020-10-12 16:30:30","2020-10-12 16:30:30");
INSERT INTO telebookorders VALUES("540","1","2020-12-10","AFCT/adm-10/20/023","SONALI PADOLE","9049702889","","NA","VIVEKANAND COLONY GAJANAN BABA MANDIR,RUKMINI NAGAR","Akoli","CASH","00:00:00","0","440","0","0","null","0","2020-10-12 16:30:23","2020-10-12 16:30:23");
INSERT INTO telebookorders VALUES("539","1","2020-12-10","AFCT/adm-10/20/022","NAZIM BULIDING WORK","9420269830","","NA","OLD BADNERA ,","Akoli","CASH","00:00:00","0","220","0","0","null","0","2020-10-12 16:30:11","2020-10-12 16:30:11");
INSERT INTO telebookorders VALUES("537","1","2020-12-10","AFCT/adm-10/20/020","ANAND","9975728747","","NA","CAMP","Akoli","CASH","00:00:00","0","440","0","0","null","0","2020-10-12 16:22:52","2020-10-12 16:22:52");
INSERT INTO telebookorders VALUES("538","1","2020-12-10","AFCT/adm-10/20/021","SUKESHNI GEDAM","8600104843","","NA","FLAT NO. 302B VISAVA COLONY LOTUS GARDEN NEAR COLLECTOR BUNGLOW","Akoli","CASH","00:00:00","0","440","0","0","null","0","2020-10-12 16:27:57","2020-10-12 16:27:57");
INSERT INTO telebookorders VALUES("536","1","2020-12-10","AFCT/adm-10/20/019","SUKESHNI GEDAM","8600104843","","NA","FLAT NO. 302B VISAVA COLONY LOTUS GARDEN NEAR COLLECTOR BUNGLOW","Akoli","CASH","00:00:00","0","440","0","0","null","0","2020-10-12 15:47:03","2020-10-12 15:47:03");
INSERT INTO telebookorders VALUES("535","1","2020-12-10","AFCT/adm-10/20/018","DR. RAGINI DESHMUKH","9604072360","","NA","BEHIND IMA HALL AMT","Akoli","CASH","00:00:00","0","440","0","0","null","0","2020-10-12 13:42:36","2020-10-12 13:42:36");
INSERT INTO telebookorders VALUES("534","1","2020-12-10","AFCT/adm-10/20/017","NAZIM BULIDING WORK","9420269830","","NA","OLD BADNERA ,","Akoli","CASH","00:00:00","0","220","0","0","null","0","2020-10-12 13:34:06","2020-10-12 13:34:06");
INSERT INTO telebookorders VALUES("533","1","2020-12-10","AFCT/adm-10/20/016","SONALI PADOLE","9049702889","","Nothing","VIVEKANAND COLONY GAJANAN BABA MANDIR,RUKMINI NAGAR","Akoli","CASH","00:00:00","0","2924","0","0","null","0","2020-10-12 12:04:34","2020-10-12 12:04:34");
INSERT INTO telebookorders VALUES("532","1","2020-10-10","AFCT/adm-10/20/015","ANAND","9975728747","","Nothing","CAMP","Akoli","CASH","00:00:00","0","660","0","0","null","0","2020-10-10 16:34:59","2020-10-10 16:34:59");
INSERT INTO telebookorders VALUES("531","1","2020-10-10","AFCT/adm-10/20/014","SUKESHNI GEDAM","8600104843","","Nothing","FLAT NO. 302B VISAVA COLONY LOTUS GARDEN NEAR COLLECTOR BUNGLOW","Akoli","CASH","00:00:00","0","5549","0","0","ADITYA GAJBHIYE","10","2020-10-10 14:59:19","2020-10-10 16:01:29");
INSERT INTO telebookorders VALUES("530","1","2020-10-10","AFCT/adm-10/20/013","SUKESHNI GEDAM","8600104843","","Nothing","FLAT NO. 302B VISAVA COLONY LOTUS GARDEN NEAR COLLECTOR BUNGLOW","Akoli","CASH","00:00:00","0","660","0","0","ADITYA GAJBHIYE","10","2020-10-10 14:57:48","2020-10-10 16:01:29");
INSERT INTO telebookorders VALUES("529","1","2020-10-10","AFCT/adm-10/20/012","SONALI PADOLE","9049702889","","Nothing","VIVEKANAND COLONY GAJANAN BABA MANDIR,RUKMINI NAGAR","Akoli","CASH","00:00:00","0","1107","0","0","asdadasd","16","2020-10-10 14:57:40","2020-10-10 16:01:39");
INSERT INTO telebookorders VALUES("526","1","2020-10-10","AFCT/adm-10/20/009","NAZIM BULIDING WORK","9420269830","","Nothing","OLD BADNERA ,","Akoli","CASH","00:00:00","0","1880","0","0","null","0","2020-10-10 14:46:25","2020-10-10 14:46:25");
INSERT INTO telebookorders VALUES("527","1","2020-10-10","AFCT/adm-10/20/010","ANAND","9975728747","","Nothing","CAMP","Akoli","CASH","00:00:00","0","1088","0","0","null","0","2020-10-10 14:53:56","2020-10-10 14:53:56");
INSERT INTO telebookorders VALUES("528","1","2020-10-10","AFCT/adm-10/20/011","DR. RAGINI DESHMUKH","9604072360","","Nothing","BEHIND IMA HALL AMT","Akoli","CASH","00:00:00","0","1277","0","0","asdadasd","16","2020-10-10 14:54:49","2020-10-10 16:01:39");
INSERT INTO telebookorders VALUES("524","1","2020-10-10","AFCT/adm-10/20/007","mohsin","7385078839","","Nothing","amravati","Akoli","CASH","00:00:00","0","660","0","0","null","0","2020-10-10 14:36:23","2020-10-10 14:36:23");
INSERT INTO telebookorders VALUES("525","1","2020-10-10","AFCT/adm-10/20/008","RAHUL PAHUWANI","9075012363","","Nothing","BABA HARIDAS RAM SOCIETY COVER NAGAR","Chaprasipura","CASH","00:00:00","0","1088","0","0","null","0","2020-10-10 14:37:24","2020-10-10 14:37:24");
INSERT INTO telebookorders VALUES("523","1","2020-10-10","AFCT/adm-10/20/006","kapil sharma","9665665026","","Nothing","amravati","Akoli","CASH","00:00:00","0","220","0","0","null","0","2020-10-10 14:35:03","2020-10-10 14:35:03");
INSERT INTO telebookorders VALUES("522","1","2020-10-10","AFCT/adm-10/20/005","ANAND","9975728747","","Nothing","CAMP","Akoli","CASH","00:00:00","0","1100","0","0","null","0","2020-10-10 14:07:35","2020-10-10 14:07:35");
INSERT INTO telebookorders VALUES("520","1","2020-10-10","AFCT/adm-10/20/003","FIROZ KHAN","9422913614","","Nothing","RAIWAY QUARTER,OLD TOWN BADNERA","Akoli","CASH","00:04:27","1","440","440","1","AVINASH KAMBLE","8","2020-10-10 11:25:12","2020-10-10 11:29:42");
INSERT INTO telebookorders VALUES("521","1","2020-10-10","AFCT/adm-10/20/004","LATIF","9834177301","","Nothing","TAPOVAN ROAD SURAKSHA COLONY HOUSE NO.10","Akoli","CASH","00:01:04","1","2508","2500","1","AVINASH KAMBLE","8","2020-10-10 11:28:28","2020-10-10 11:29:39");
INSERT INTO telebookorders VALUES("519","1","2020-10-10","AFCT/adm-10/20/002","SANDIP VISHWAKARMA","8483988094","","Nothing","GALLI NO.5,VILAS NAGAR","Akoli","CASH","00:04:49","1","660","0","-1","HIRA PAWAR","12","2020-10-10 11:24:53","2020-10-10 11:29:51");
INSERT INTO telebookorders VALUES("518","1","2020-10-10","AFCT/adm-10/20/001","SANDIP VISHWAKARMA","8483988094","","Nothing","GALLI NO.5,VILAS NAGAR","Akoli","CASH","00:05:28","1","615","0","-1","HIRA PAWAR","12","2020-10-10 11:24:23","2020-10-10 11:30:08");
INSERT INTO telebookorders VALUES("564","1","1970-01-01","AFCT/adm-10/20/045","SUKESHNI GEDAM","8600104843","8600104843","NA","FLAT NO. 302B VISAVA COLONY LOTUS GARDEN NEAR COLLECTOR BUNGLOW","Akoli","CASH","00:00:00","0","170","0","0","ASHISH CHAUDHARI","11","2020-10-27 13:39:11","2020-10-27 13:39:25");
INSERT INTO telebookorders VALUES("565","1","1970-01-01","AFCT/adm-10/20/046","SUKESHNI GEDAM","8600104843","0","NA","FLAT NO. 302B VISAVA COLONY LOTUS GARDEN NEAR COLLECTOR BUNGLOW","Akoli","CASH","00:00:00","0","85","0","0","null","0","2020-10-27 13:56:58","2020-10-27 13:56:58");
INSERT INTO telebookorders VALUES("566","1","1970-01-01","AFCT/adm-10/20/047","DR. RAGINI DESHMUKH","9604072360","0","NA","BEHIND IMA HALL AMT","Akoli","CASH","00:00:00","0","205","0","0","null","0","2020-10-29 13:03:44","2020-10-29 13:03:44");
INSERT INTO telebookorders VALUES("567","1","1970-01-01","AFCT/adm-10/20/048","SONALI PADOLE","9049702889","9049702889","NA","VIVEKANAND COLONY GAJANAN BABA MANDIR,RUKMINI NAGAR","Akoli","CASH","00:00:00","0","230","0","0","null","0","2020-10-29 13:06:24","2020-10-29 13:06:24");
INSERT INTO telebookorders VALUES("568","1","2020-02-11","AFCT/adm-11/20/001","KUNAL JAWARKAR","8169382828","0","NA","SHRINATH WADI NEAR KALIMATA MANDIR BACK SIDE OF SMASHAN BHUMI AMT","Chaprasipura","CASH","00:00:00","0","170","0","0","null","0","2020-11-02 15:43:42","2020-11-02 15:43:42");
INSERT INTO telebookorders VALUES("569","1","2020-02-11","AFCT/adm-11/20/002","mohsin sh","7385078839","8329089765","NA","amravati","Akoli","CASH","00:00:00","0","170","0","0","null","0","2020-11-02 15:44:22","2020-11-02 15:44:22");
INSERT INTO telebookorders VALUES("570","1","2020-02-11","AFCT/adm-11/20/003","mohsin sh","7385078839","8329089765","NA","amravati","Akoli","CASH","00:00:00","0","255","0","0","null","0","2020-11-02 15:45:02","2020-11-02 15:45:02");
INSERT INTO telebookorders VALUES("571","1","2020-06-11","AFCT/adm-11/20/004","SONALI PADOLE","9049702889","9049702889","NA","VIVEKANAND COLONY GAJANAN BABA MANDIR,RUKMINI NAGAR","Akoli","CASH","00:00:00","0","170","0","0","null","0","2020-11-06 11:57:51","2020-11-06 11:57:51");
INSERT INTO telebookorders VALUES("572","1","2020-06-11","AFCT/adm-11/20/005","SUKESHNI GEDAM","8600104843","0","NA","FLAT NO. 302B VISAVA COLONY LOTUS GARDEN NEAR COLLECTOR BUNGLOW","Akoli","CASH","00:00:00","0","170","0","0","null","0","2020-11-06 11:58:42","2020-11-06 11:58:42");



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
) ENGINE=MyISAM AUTO_INCREMENT=1049 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO teleorderlists VALUES("1047","1","572","chicken liver","0","1.000","85","2020-11-06 11:58:42","2020-11-06 11:58:42");
INSERT INTO teleorderlists VALUES("1048","1","572","chicken liver","0","1.000","85","2020-11-06 11:58:42","2020-11-06 11:58:42");
INSERT INTO teleorderlists VALUES("1046","1","571","chicken liver","0","1.000","85","2020-11-06 11:57:51","2020-11-06 11:57:51");
INSERT INTO teleorderlists VALUES("1045","1","571","chicken liver","0","1.000","85","2020-11-06 11:57:51","2020-11-06 11:57:51");
INSERT INTO teleorderlists VALUES("1044","1","570","chicken liver","0","1.000","85","2020-11-02 15:45:02","2020-11-02 15:45:02");
INSERT INTO teleorderlists VALUES("1043","1","570","chicken liver","0","1.000","85","2020-11-02 15:45:02","2020-11-02 15:45:02");
INSERT INTO teleorderlists VALUES("1041","1","569","chicken liver","0","1.000","85","2020-11-02 15:44:22","2020-11-02 15:44:22");
INSERT INTO teleorderlists VALUES("1042","1","570","chicken liver","0","1.000","85","2020-11-02 15:45:02","2020-11-02 15:45:02");
INSERT INTO teleorderlists VALUES("1040","1","569","chicken liver","0","1.000","85","2020-11-02 15:44:22","2020-11-02 15:44:22");
INSERT INTO teleorderlists VALUES("1039","1","568","chicken liver","0","1.000","85","2020-11-02 15:43:42","2020-11-02 15:43:42");
INSERT INTO teleorderlists VALUES("1038","1","568","chicken liver","0","1.000","85","2020-11-02 15:43:42","2020-11-02 15:43:42");
INSERT INTO teleorderlists VALUES("1037","1","567","chicken liver","0","1.000","85","2020-10-29 13:06:24","2020-10-29 13:06:24");
INSERT INTO teleorderlists VALUES("1036","1","567","chiekn raw","0","1.000","25","2020-10-29 13:06:24","2020-10-29 13:06:24");
INSERT INTO teleorderlists VALUES("1035","1","567","chciken leg","0","1.000","120","2020-10-29 13:06:24","2020-10-29 13:06:24");
INSERT INTO teleorderlists VALUES("1034","1","566","chciken leg","0","1.000","120","2020-10-29 13:03:44","2020-10-29 13:03:44");
INSERT INTO teleorderlists VALUES("1033","1","566","chicken liver","0","1.000","85","2020-10-29 13:03:44","2020-10-29 13:03:44");
INSERT INTO teleorderlists VALUES("1032","1","565","chicken liver","0","1.000","85","2020-10-27 13:56:58","2020-10-27 13:56:58");
INSERT INTO teleorderlists VALUES("1031","1","564","chicken liver","11","1.000","85","2020-10-27 13:39:11","2020-10-27 13:39:25");
INSERT INTO teleorderlists VALUES("1030","1","564","chicken liver","11","1.000","85","2020-10-27 13:39:11","2020-10-27 13:39:25");
INSERT INTO teleorderlists VALUES("1029","1","563","chciken leg","13","1.000","120","2020-10-27 13:24:05","2020-10-27 13:24:18");
INSERT INTO teleorderlists VALUES("1028","1","563","chicken liver","13","1.000","85","2020-10-27 13:24:05","2020-10-27 13:24:18");
INSERT INTO teleorderlists VALUES("1027","38","562","live chicken","0","1.000","120","2020-10-16 15:16:24","2020-10-16 15:16:24");
INSERT INTO teleorderlists VALUES("1026","38","562","live chicken","0","1.000","120","2020-10-16 15:16:24","2020-10-16 15:16:24");
INSERT INTO teleorderlists VALUES("1025","38","562","live chicken","0","1.000","120","2020-10-16 15:16:24","2020-10-16 15:16:24");
INSERT INTO teleorderlists VALUES("1024","38","562","live chicken","0","1.000","120","2020-10-16 15:16:24","2020-10-16 15:16:24");
INSERT INTO teleorderlists VALUES("1023","38","561","live chicken","0","1.000","120","2020-10-16 15:16:14","2020-10-16 15:16:14");
INSERT INTO teleorderlists VALUES("1022","38","561","live chicken","0","1.000","120","2020-10-16 15:16:14","2020-10-16 15:16:14");
INSERT INTO teleorderlists VALUES("1021","38","560","live chicken","0","1.000","120","2020-10-16 15:16:01","2020-10-16 15:16:01");
INSERT INTO teleorderlists VALUES("1020","38","560","live chicken","0","1.000","120","2020-10-16 15:16:01","2020-10-16 15:16:01");
INSERT INTO teleorderlists VALUES("1019","1","559","live chicken","0","1.000","120","2020-10-16 15:12:23","2020-10-16 15:12:23");
INSERT INTO teleorderlists VALUES("1018","1","559","live chicken","0","1.000","120","2020-10-16 15:12:23","2020-10-16 15:12:23");
INSERT INTO teleorderlists VALUES("1017","1","558","live chicken","0","1.000","120","2020-10-16 15:12:14","2020-10-16 15:12:14");
INSERT INTO teleorderlists VALUES("1015","1","557","live chicken","0","1.000","120","2020-10-16 15:09:53","2020-10-16 15:09:53");
INSERT INTO teleorderlists VALUES("1016","1","558","live chicken","0","1.000","120","2020-10-16 15:12:14","2020-10-16 15:12:14");
INSERT INTO teleorderlists VALUES("1013","1","556","live chicken","0","1.000","120","2020-10-16 15:09:47","2020-10-16 15:09:47");
INSERT INTO teleorderlists VALUES("1014","1","557","live chicken","0","1.000","120","2020-10-16 15:09:53","2020-10-16 15:09:53");
INSERT INTO teleorderlists VALUES("1012","1","556","live chicken","0","1.000","120","2020-10-16 15:09:47","2020-10-16 15:09:47");
INSERT INTO teleorderlists VALUES("1010","1","555","live chicken","0","1.000","120","2020-10-16 15:06:38","2020-10-16 15:06:38");
INSERT INTO teleorderlists VALUES("1011","1","555","live chicken","0","1.000","120","2020-10-16 15:06:38","2020-10-16 15:06:38");
INSERT INTO teleorderlists VALUES("1009","1","554","live chicken","0","1.000","120","2020-10-16 15:02:34","2020-10-16 15:02:34");
INSERT INTO teleorderlists VALUES("1008","1","554","live chicken","0","1.000","120","2020-10-16 15:02:34","2020-10-16 15:02:34");
INSERT INTO teleorderlists VALUES("1007","1","554","live chicken","0","1.000","120","2020-10-16 15:02:34","2020-10-16 15:02:34");
INSERT INTO teleorderlists VALUES("1006","1","554","live chicken","0","1.000","120","2020-10-16 15:02:34","2020-10-16 15:02:34");
INSERT INTO teleorderlists VALUES("1005","1","554","live chicken","0","1.000","120","2020-10-16 15:02:34","2020-10-16 15:02:34");
INSERT INTO teleorderlists VALUES("1003","1","553","live chicken","0","1.000","120","2020-10-16 15:02:23","2020-10-16 15:02:23");
INSERT INTO teleorderlists VALUES("1004","1","553","live chicken","0","1.000","120","2020-10-16 15:02:23","2020-10-16 15:02:23");
INSERT INTO teleorderlists VALUES("1002","1","553","live chicken","0","1.000","120","2020-10-16 15:02:23","2020-10-16 15:02:23");
INSERT INTO teleorderlists VALUES("1000","1","552","CHICKEN LIVER","0","1.000","160","2020-10-15 13:08:24","2020-10-15 13:08:24");
INSERT INTO teleorderlists VALUES("1001","1","552","CHICKEN LIVER","0","1.000","160","2020-10-15 13:08:24","2020-10-15 13:08:24");
INSERT INTO teleorderlists VALUES("999","1","552","CHICKEN LIVER","0","1.000","160","2020-10-15 13:08:24","2020-10-15 13:08:24");
INSERT INTO teleorderlists VALUES("998","1","551","CHICKEN LIVER","0","1.000","130","2020-10-15 13:04:44","2020-10-15 13:04:44");
INSERT INTO teleorderlists VALUES("996","1","550","CHICKEN LIVER","0","1.000","130","2020-10-15 13:03:21","2020-10-15 13:03:21");
INSERT INTO teleorderlists VALUES("997","1","551","CHICKEN LIVER","0","1.000","130","2020-10-15 13:04:44","2020-10-15 13:04:44");
INSERT INTO teleorderlists VALUES("995","1","550","CHICKEN LIVER","0","1.000","130","2020-10-15 13:03:21","2020-10-15 13:03:21");
INSERT INTO teleorderlists VALUES("994","1","550","CHICKEN LIVER","0","1.000","130","2020-10-15 13:03:21","2020-10-15 13:03:21");
INSERT INTO teleorderlists VALUES("993","1","550","CHICKEN LIVER","0","1.000","160","2020-10-15 13:03:21","2020-10-15 13:03:21");
INSERT INTO teleorderlists VALUES("991","1","549","CHICKEN TANDOORI (ONE PIECE)","0","1.145","206","2020-10-14 19:40:31","2020-10-14 19:40:31");
INSERT INTO teleorderlists VALUES("992","1","550","CHICKEN LIVER","0","1.000","160","2020-10-15 13:03:21","2020-10-15 13:03:21");
INSERT INTO teleorderlists VALUES("990","1","549","CHICKEN LIVER","0","1.245","162","2020-10-14 19:40:31","2020-10-14 19:40:31");
INSERT INTO teleorderlists VALUES("989","1","548","chicken33","0","1.249","187","2020-10-14 19:39:47","2020-10-14 19:39:47");
INSERT INTO teleorderlists VALUES("988","1","548","CHICKEN LIVER","0","1.456","233","2020-10-14 19:39:47","2020-10-14 19:39:47");
INSERT INTO teleorderlists VALUES("987","1","547","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-13 10:54:21","2020-10-13 10:54:21");
INSERT INTO teleorderlists VALUES("986","1","547","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-13 10:54:21","2020-10-13 10:54:21");
INSERT INTO teleorderlists VALUES("984","1","546","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-13 10:53:53","2020-10-13 10:53:53");
INSERT INTO teleorderlists VALUES("985","1","546","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-13 10:53:53","2020-10-13 10:53:53");
INSERT INTO teleorderlists VALUES("982","1","545","CHICKEN CURRY PIECE ( LARGE)","0","1.945","428","2020-10-13 10:38:46","2020-10-13 10:38:46");
INSERT INTO teleorderlists VALUES("983","1","546","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-13 10:53:53","2020-10-13 10:53:53");
INSERT INTO teleorderlists VALUES("980","1","544","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-13 10:38:27","2020-10-13 10:38:27");
INSERT INTO teleorderlists VALUES("981","1","545","CHICKEN CURRY PIECE ( LARGE)","0","1.247","274","2020-10-13 10:38:46","2020-10-13 10:38:46");
INSERT INTO teleorderlists VALUES("979","1","544","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-13 10:38:27","2020-10-13 10:38:27");
INSERT INTO teleorderlists VALUES("978","1","543","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-12 16:39:16","2020-10-12 16:39:16");
INSERT INTO teleorderlists VALUES("977","1","542","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-12 16:39:12","2020-10-12 16:39:12");
INSERT INTO teleorderlists VALUES("976","1","542","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-12 16:39:12","2020-10-12 16:39:12");
INSERT INTO teleorderlists VALUES("975","1","541","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-12 16:30:30","2020-10-12 16:30:30");
INSERT INTO teleorderlists VALUES("972","1","540","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-12 16:30:23","2020-10-12 16:30:23");
INSERT INTO teleorderlists VALUES("973","1","540","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-12 16:30:23","2020-10-12 16:30:23");
INSERT INTO teleorderlists VALUES("974","1","541","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-12 16:30:30","2020-10-12 16:30:30");
INSERT INTO teleorderlists VALUES("970","1","538","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-12 16:27:57","2020-10-12 16:27:57");
INSERT INTO teleorderlists VALUES("971","1","539","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-12 16:30:11","2020-10-12 16:30:11");
INSERT INTO teleorderlists VALUES("969","1","538","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-12 16:27:57","2020-10-12 16:27:57");
INSERT INTO teleorderlists VALUES("968","1","537","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-12 16:22:52","2020-10-12 16:22:52");
INSERT INTO teleorderlists VALUES("967","1","537","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-12 16:22:52","2020-10-12 16:22:52");
INSERT INTO teleorderlists VALUES("964","1","535","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-12 13:42:36","2020-10-12 13:42:36");
INSERT INTO teleorderlists VALUES("965","1","535","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-12 13:42:36","2020-10-12 13:42:36");
INSERT INTO teleorderlists VALUES("966","1","536","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-12 15:47:03","2020-10-12 15:47:03");
INSERT INTO teleorderlists VALUES("963","1","534","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-12 13:34:06","2020-10-12 13:34:06");
INSERT INTO teleorderlists VALUES("962","1","533","CHICKEN GIZZARD","0","2.58","206","2020-10-12 12:04:34","2020-10-12 12:04:34");
INSERT INTO teleorderlists VALUES("961","1","533","CHICKEN BONE LESS","0","4.987","1995","2020-10-12 12:04:34","2020-10-12 12:04:34");
INSERT INTO teleorderlists VALUES("960","1","533","CHICKEN BIRYANI PIECE","0","1.741","383","2020-10-12 12:04:34","2020-10-12 12:04:34");
INSERT INTO teleorderlists VALUES("959","1","533","CHICKEN CURRY PIECE ( LARGE)","0","1.547","340","2020-10-12 12:04:34","2020-10-12 12:04:34");
INSERT INTO teleorderlists VALUES("958","1","532","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-10 16:34:59","2020-10-10 16:34:59");
INSERT INTO teleorderlists VALUES("957","1","532","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-10 16:34:59","2020-10-10 16:34:59");
INSERT INTO teleorderlists VALUES("956","1","532","CHICKEN CURRY PIECE ( LARGE)","0","1.000","220","2020-10-10 16:34:59","2020-10-10 16:34:59");
INSERT INTO teleorderlists VALUES("955","1","531","CHICKEN DRUM STICK","10","9.874","4937","2020-10-10 14:59:19","2020-10-10 16:01:29");
INSERT INTO teleorderlists VALUES("953","1","530","CHICKEN CURRY PIECE ( LARGE)","10","1.000","220","2020-10-10 14:57:48","2020-10-10 16:01:29");
INSERT INTO teleorderlists VALUES("954","1","531","CHICKEN CURRY PIECE ( LARGE)","10","2.784","612","2020-10-10 14:59:19","2020-10-10 16:01:29");
INSERT INTO teleorderlists VALUES("950","1","529","CHICKEN CURRY PIECE ( LARGE)","16","1.874","412","2020-10-10 14:57:40","2020-10-10 16:01:39");
INSERT INTO teleorderlists VALUES("951","1","530","CHICKEN CURRY PIECE ( LARGE)","10","1.000","220","2020-10-10 14:57:48","2020-10-10 16:01:29");
INSERT INTO teleorderlists VALUES("952","1","530","CHICKEN CURRY PIECE ( LARGE)","10","1.000","220","2020-10-10 14:57:48","2020-10-10 16:01:29");
INSERT INTO teleorderlists VALUES("949","1","529","CHICKEN LIVER","16","1.885","302","2020-10-10 14:57:40","2020-10-10 16:01:39");
INSERT INTO teleorderlists VALUES("948","1","529","CHICKEN BIRYANI PIECE","16","1.785","393","2020-10-10 14:57:40","2020-10-10 16:01:39");
INSERT INTO teleorderlists VALUES("947","1","528","CHICKEN GIZZARD","16","1.25","100","2020-10-10 14:54:49","2020-10-10 16:01:39");
INSERT INTO teleorderlists VALUES("946","1","528","CHICKEN WINGS","16","2.845","854","2020-10-10 14:54:49","2020-10-10 16:01:39");
INSERT INTO teleorderlists VALUES("945","1","528","CHICKEN CURRY PIECE ( LARGE)","16","1.47","323","2020-10-10 14:54:49","2020-10-10 16:01:39");
INSERT INTO teleorderlists VALUES("944","1","527","CHICKEN CURRY PIECE ( LARGE)","0","1.847","406","2020-10-10 14:53:56","2020-10-10 14:53:56");
INSERT INTO teleorderlists VALUES("943","1","527","CHICKEN CURRY PIECE ( LARGE)","0","1.954","430","2020-10-10 14:53:56","2020-10-10 14:53:56");
INSERT INTO teleorderlists VALUES("942","1","527","CHICKEN CURRY PIECE ( LARGE)","0","1.145","252","2020-10-10 14:53:56","2020-10-10 14:53:56");
INSERT INTO teleorderlists VALUES("941","1","526","CHICKEN BONE LESS","0","1.114","446","2020-10-10 14:46:25","2020-10-10 14:46:25");
INSERT INTO teleorderlists VALUES("940","1","526","CHICKEN DRUM STICK","0","1.87","935","2020-10-10 14:46:25","2020-10-10 14:46:25");
INSERT INTO teleorderlists VALUES("939","1","526","CHICKEN KEEMA","0","1.25","500","2020-10-10 14:46:25","2020-10-10 14:46:25");
INSERT INTO teleorderlists VALUES("938","1","525","CHICKEN CURRY PIECE ( LARGE)","0","1.965","432","2020-10-10 14:37:24","2020-10-10 14:37:24");
INSERT INTO teleorderlists VALUES("937","1","525","CHICKEN CURRY PIECE ( LARGE)","0","1.528","336","2020-10-10 14:37:24","2020-10-10 14:37:24");
INSERT INTO teleorderlists VALUES("935","1","524","CHICKEN CURRY PIECE ( LARGE)","0","1.75","385","2020-10-10 14:36:23","2020-10-10 14:36:23");
INSERT INTO teleorderlists VALUES("936","1","525","CHICKEN CURRY PIECE ( LARGE)","0","1.455","320","2020-10-10 14:37:24","2020-10-10 14:37:24");
INSERT INTO teleorderlists VALUES("934","1","524","CHICKEN CURRY PIECE ( LARGE)","0","1.25","275","2020-10-10 14:36:23","2020-10-10 14:36:23");
INSERT INTO teleorderlists VALUES("933","1","524","CHICKEN CURRY PIECE ( LARGE)","0","1","220","2020-10-10 14:36:23","2020-10-10 14:36:23");
INSERT INTO teleorderlists VALUES("932","1","523","CHICKEN CURRY PIECE ( LARGE)","0","1","220","2020-10-10 14:35:03","2020-10-10 14:35:03");
INSERT INTO teleorderlists VALUES("931","1","522","CHICKEN BIRYANI PIECE","0","5","1100","2020-10-10 14:07:35","2020-10-10 14:07:35");
INSERT INTO teleorderlists VALUES("930","1","521","CHICKEN TANDOORI (ONE PIECE)","8","1.54","308","2020-10-10 11:28:28","2020-10-10 11:29:20");
INSERT INTO teleorderlists VALUES("929","1","521","CHICKEN BONE LESS","8","4","1600","2020-10-10 11:28:28","2020-10-10 11:29:20");
INSERT INTO teleorderlists VALUES("928","1","521","CHICKEN WINGS","8","2","600","2020-10-10 11:28:28","2020-10-10 11:29:20");
INSERT INTO teleorderlists VALUES("927","1","520","CHICKEN CURRY PIECE ( LARGE)","8","1","220","2020-10-10 11:25:12","2020-10-10 11:29:20");
INSERT INTO teleorderlists VALUES("926","1","520","CHICKEN CURRY PIECE ( LARGE)","8","1","220","2020-10-10 11:25:12","2020-10-10 11:29:20");
INSERT INTO teleorderlists VALUES("925","1","519","CHICKEN CURRY PIECE ( LARGE)","12","1","220","2020-10-10 11:24:53","2020-10-10 11:29:30");
INSERT INTO teleorderlists VALUES("924","1","519","CHICKEN CURRY PIECE ( LARGE)","12","1","220","2020-10-10 11:24:53","2020-10-10 11:29:30");
INSERT INTO teleorderlists VALUES("923","1","519","CHICKEN CURRY PIECE ( LARGE)","12","1","220","2020-10-10 11:24:53","2020-10-10 11:29:30");
INSERT INTO teleorderlists VALUES("922","1","518","CHICKEN CURRY PIECE ( LARGE)","12","1.547","340","2020-10-10 11:24:23","2020-10-10 11:29:30");
INSERT INTO teleorderlists VALUES("921","1","518","CHICKEN CURRY PIECE ( LARGE)","12","1.254","276","2020-10-10 11:24:23","2020-10-10 11:29:30");



DROP TABLE units;

CREATE TABLE `units` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `unittype` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO units VALUES("1","gm","2020-11-10 17:22:26","2020-11-11 15:34:36");
INSERT INTO units VALUES("4","mg","2020-11-11 15:34:42","2020-11-11 15:34:42");
INSERT INTO units VALUES("2","kg","2020-11-10 17:23:58","2020-11-11 15:34:32");



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
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO usermanages VALUES("1","admin","adm","$2y$10$eHNmQsnI76j3zazcsSfpDOEoNTcZDpM0wjXEsS62HQ3fhKaUbg7se","admin@fmg.com","1","1","1","1","1","2020-09-14 10:50:14","2020-09-24 16:35:02");
INSERT INTO usermanages VALUES("19","Ajaytelecaller","ajy","$2y$10$Hkb2ktgFqIHFzVMFhN/S/.rul6KJQYddowQ/DCMxSwyjm7ENlRVnS","demo@gmail.com","3","","","1","","2020-09-14 12:46:30","2020-09-14 12:46:30");
INSERT INTO usermanages VALUES("38","vijaytelecaller","vjy","$2y$10$0Q1BD9OkGvdYVo9TA3w01uqPe3mpnDjMKO3Uc1XgfzMAOJm/MjET2","aa@gmail.com","3","","","1","","2020-10-06 12:16:48","2020-10-06 12:16:48");
INSERT INTO usermanages VALUES("43","akolishop","akl","$2y$10$lc3B8c0zpY5yLRs3wO2FMO9hoLwvehRXHiH8XluY8DFZ0rK2hBvs.","admin@fmg.com","2","","1","","","2020-10-06 12:52:31","2020-10-06 12:52:31");
INSERT INTO usermanages VALUES("42","chaprasipura","chp","$2y$10$q2Z63SXLFvAzArJHEWcqqODt9IFoc0SNGxCkOWQxpcbz4dFIJIzDe","hello@gmail.com","2","","1","","","2020-10-06 12:31:18","2020-10-06 12:31:18");



DROP TABLE vendors;

CREATE TABLE `vendors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobno` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pan` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bankname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ifsccode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shedsize` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `geolocation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO vendors VALUES("2","asdd","RAIWAY QUARTER,OLD TOWN BADNERA","888885","demo@gmail.com","erwervwer","werwer","3342342","23423","58","85","98","20.9307566,77.7587657","2020-11-10 17:10:51","2020-11-10 17:11:33");



