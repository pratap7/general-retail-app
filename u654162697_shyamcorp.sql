-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 23, 2020 at 05:50 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u654162697_shyamcorp`
--

-- --------------------------------------------------------

--
-- Table structure for table `builders`
--

CREATE TABLE `builders` (
  `id` int(11) NOT NULL,
  `party_name` varchar(250) NOT NULL,
  `postal_address` varchar(250) NOT NULL,
  `village` varchar(200) DEFAULT NULL,
  `taluka` varchar(200) DEFAULT NULL,
  `district` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `pincode` varchar(200) DEFAULT NULL,
  `owner_name` varchar(250) NOT NULL,
  `owner_landline` varchar(25) DEFAULT NULL,
  `owner_mobile` varchar(15) DEFAULT NULL,
  `contact_person_name` varchar(200) DEFAULT NULL,
  `contact_person_landline` varchar(25) DEFAULT NULL,
  `contact_person_mobile` varchar(15) DEFAULT NULL,
  `project_category` varchar(250) DEFAULT NULL,
  `project_status` varchar(50) DEFAULT NULL,
  `site_destinations` text CHARACTER SET utf8 DEFAULT NULL,
  `order_procured` varchar(100) DEFAULT NULL,
  `direct_customer_email` varchar(50) DEFAULT NULL,
  `sales_rep_code` varchar(100) DEFAULT NULL,
  `non_trade` varchar(200) DEFAULT NULL,
  `credit_terms` varchar(200) DEFAULT NULL,
  `credit_limit_period` varchar(200) DEFAULT NULL,
  `is_dealing_other_firm` tinyint(1) NOT NULL DEFAULT 0,
  `other_firm_details` varchar(200) DEFAULT NULL,
  `letterhead_file` varchar(100) DEFAULT NULL,
  `pancard_no` varchar(100) DEFAULT NULL,
  `pancard_file` varchar(100) DEFAULT NULL,
  `gst_no` varchar(100) DEFAULT NULL,
  `gst_file` varchar(100) DEFAULT NULL,
  `cancel_cheque_file` varchar(120) DEFAULT NULL,
  `branch_head` varchar(200) DEFAULT NULL,
  `party_code` varchar(200) DEFAULT NULL,
  `factory_code` varchar(200) DEFAULT NULL,
  `frieght_code` varchar(200) DEFAULT NULL,
  `dist_code` varchar(200) DEFAULT NULL,
  `ac_ahmdbd` varchar(200) DEFAULT NULL,
  `cement_brand` varchar(20) NOT NULL DEFAULT 'ambuja',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `total_consumption` varchar(200) DEFAULT NULL,
  `monthly_consumption` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `builders`
--

INSERT INTO `builders` (`id`, `party_name`, `postal_address`, `village`, `taluka`, `district`, `state`, `pincode`, `owner_name`, `owner_landline`, `owner_mobile`, `contact_person_name`, `contact_person_landline`, `contact_person_mobile`, `project_category`, `project_status`, `site_destinations`, `order_procured`, `direct_customer_email`, `sales_rep_code`, `non_trade`, `credit_terms`, `credit_limit_period`, `is_dealing_other_firm`, `other_firm_details`, `letterhead_file`, `pancard_no`, `pancard_file`, `gst_no`, `gst_file`, `cancel_cheque_file`, `branch_head`, `party_code`, `factory_code`, `frieght_code`, `dist_code`, `ac_ahmdbd`, `cement_brand`, `created_at`, `updated_at`, `deleted_at`, `total_consumption`, `monthly_consumption`) VALUES
(1, 'S.G Builders', '421, vishala supreme, ahmedabad - 382350', 'Shekh Pipriya', 'Lathi', 'Amreli', 'GUJARAT', '382350', 'Dhruval Ramani', NULL, '7990810440', NULL, NULL, '7990810440', 'a:6:{s:10:\"is_builder\";s:3:\"YES\";s:18:\"is_govt_contractor\";s:2:\"NO\";s:13:\"is_contractor\";s:2:\"NO\";s:16:\"is_institutional\";s:2:\"NO\";s:11:\"is_industry\";s:2:\"NO\";s:12:\"is_developer\";s:2:\"NO\";}', 'NEW', 'a:2:{i:0;a:5:{s:11:\"destination\";s:27:\"Pavillion Mall, S.G Highway\";s:3:\"qty\";i:0;s:7:\"contact\";s:10:\"9687767193\";s:6:\"taluka\";s:5:\"Nikol\";s:8:\"district\";s:9:\"Ahmedabad\";}i:1;a:5:{s:11:\"destination\";s:42:\"Bhakti Bunglows, Nikol, Ahmedabad - 382350\";s:3:\"qty\";i:0;s:7:\"contact\";s:10:\"8000349694\";s:6:\"taluka\";s:11:\"S.g Highway\";s:8:\"district\";s:9:\"Ahmedabad\";}}', 'dealer', 'geeky.dhruval@gmail.com', 'SHIV VYAS', 'a:4:{s:17:\"fright_debit_note\";s:2:\"NO\";s:13:\"gross_billing\";s:2:\"NO\";s:11:\"tax_invoice\";s:3:\"YES\";s:6:\"retail\";s:2:\"NO\";}', 'a:4:{s:7:\"advance\";s:3:\"YES\";s:16:\"against_delivery\";s:2:\"NO\";s:5:\"bg_lc\";s:2:\"NO\";s:14:\"parent_mapping\";s:2:\"NO\";}', '7 Days', 0, '', 'LETTERHEAD_1589137106.png', 'HIJD743748', 'PANCARD_1589137106.png', '743898479348', 'GST_1589137106.png', 'CANCELCHEQUE_1589137106.png', NULL, 'GPC346', NULL, NULL, NULL, NULL, 'mehta', '2020-05-10 18:58:26', '2020-05-10 18:59:11', NULL, '300', '51 MT'),
(2, 'S.G Group', '421, vishala supreme, ahmedabad - 382350', 'Shekh Pipriya', 'Lathi', 'Amreli', 'GUJARAT', '382350', 'Dhruval Ramani', NULL, '7990810440', NULL, NULL, '7990810440', 'a:6:{s:10:\"is_builder\";s:3:\"YES\";s:18:\"is_govt_contractor\";s:2:\"NO\";s:13:\"is_contractor\";s:2:\"NO\";s:16:\"is_institutional\";s:2:\"NO\";s:11:\"is_industry\";s:2:\"NO\";s:12:\"is_developer\";s:2:\"NO\";}', 'NEW', 'a:2:{i:0;a:5:{s:11:\"destination\";s:27:\"Pavillion Mall, S.G Highway\";s:3:\"qty\";i:0;s:7:\"contact\";s:10:\"9687767193\";s:6:\"taluka\";s:5:\"Nikol\";s:8:\"district\";s:9:\"Ahmedabad\";}i:1;a:5:{s:11:\"destination\";s:42:\"Bhakti Bunglows, Nikol, Ahmedabad - 382350\";s:3:\"qty\";i:0;s:7:\"contact\";s:10:\"8000349694\";s:6:\"taluka\";s:11:\"S.g Highway\";s:8:\"district\";s:9:\"Ahmedabad\";}}', 'tpca', 'geeky.dhruval@gmail.com', 'SHIV VYAS', 'a:4:{s:17:\"fright_debit_note\";s:2:\"NO\";s:13:\"gross_billing\";s:2:\"NO\";s:11:\"tax_invoice\";s:3:\"YES\";s:6:\"retail\";s:2:\"NO\";}', 'a:4:{s:7:\"advance\";s:2:\"NO\";s:16:\"against_delivery\";s:3:\"YES\";s:5:\"bg_lc\";s:2:\"NO\";s:14:\"parent_mapping\";s:2:\"NO\";}', '15 days', 0, '', 'LETTERHEAD_1589137543.png', 'HIJD743748', 'PANCARD_1589137543.png', '743898479348', 'GST_1589137543.png', 'CANCELCHEQUE_1589137543.png', NULL, '9124130094', NULL, NULL, NULL, NULL, 'ambuja', '2020-05-10 19:05:43', '2020-05-10 19:10:23', NULL, '300', '51 MT'),
(3, 'NORTH INFRASTRUCTURE', 'KALASH-2 ENCLAVE, B/H. SUNRISE HOMES, LAMBHA VATVA ROAD,VATVA', 'AHMEDABAD', 'AHMEDABAD', 'AHMEDABAD', 'GUJARAT', '382445', 'ROHITBHAI', NULL, '9723823899', NULL, NULL, NULL, 'a:6:{s:10:\"is_builder\";s:2:\"NO\";s:18:\"is_govt_contractor\";s:2:\"NO\";s:13:\"is_contractor\";s:2:\"NO\";s:16:\"is_institutional\";s:2:\"NO\";s:11:\"is_industry\";s:2:\"NO\";s:12:\"is_developer\";s:2:\"NO\";}', 'on_going', 'a:3:{i:0;a:5:{s:11:\"destination\";s:5:\"NAROL\";s:3:\"qty\";i:0;s:7:\"contact\";s:13:\"9090909909700\";s:6:\"taluka\";s:9:\"AHMEDABAD\";s:8:\"district\";s:15:\"AHEDABAD-382415\";}i:1;a:5:{s:11:\"destination\";s:5:\"SURAT\";s:3:\"qty\";i:0;s:7:\"contact\";s:12:\"000797907098\";s:6:\"taluka\";s:5:\"SURAT\";s:8:\"district\";s:12:\"SURAT-779099\";}i:2;a:5:{s:11:\"destination\";s:36:\"E-983 AJITNAKRUPA SOCITY AMBUKANAGAR\";s:3:\"qty\";i:0;s:7:\"contact\";s:10:\"8530808620\";s:6:\"taluka\";s:5:\"ODHAV\";s:8:\"district\";s:9:\"AHMEDABAD\";}}', 'tpca', 'devanshumunjani7@gmail.com', 'SHIV VYAS', 'a:4:{s:17:\"fright_debit_note\";s:2:\"NO\";s:13:\"gross_billing\";s:2:\"NO\";s:11:\"tax_invoice\";s:3:\"YES\";s:6:\"retail\";s:2:\"NO\";}', 'a:4:{s:7:\"advance\";s:2:\"NO\";s:16:\"against_delivery\";s:2:\"NO\";s:5:\"bg_lc\";s:2:\"NO\";s:14:\"parent_mapping\";s:3:\"YES\";}', NULL, 0, '', 'LETTERHEAD_1590578546.jpg', 'AAPFN4115L', 'PANCARD_1590578546.jpg', '24AAPFN4115L1Z3', 'GST_1590578546.jpg', 'CANCELCHEQUE_1590578546.jpg', NULL, '7676', NULL, NULL, NULL, NULL, 'ambuja', '2020-05-27 11:22:26', '2020-05-27 11:51:47', NULL, NULL, '51 MT'),
(4, 'NORTH INFRASTRUCTURE', 'NAROL AHMEDABAD', 'AHMEDBAD', 'AHEMDABAD', 'AHMEDABD', 'GUJARAT', '383231', 'SANJAYBHAI', NULL, '9970940990', NULL, NULL, NULL, 'a:6:{s:10:\"is_builder\";s:2:\"NO\";s:18:\"is_govt_contractor\";s:2:\"NO\";s:13:\"is_contractor\";s:2:\"NO\";s:16:\"is_institutional\";s:2:\"NO\";s:11:\"is_industry\";s:2:\"NO\";s:12:\"is_developer\";s:2:\"NO\";}', 'on_going', 'a:3:{i:0;a:5:{s:11:\"destination\";s:5:\"ODHAV\";s:3:\"qty\";i:0;s:7:\"contact\";s:12:\"979709440301\";s:6:\"taluka\";s:8:\"AHMEDABD\";s:8:\"district\";s:17:\"AHMEDABDA-2609940\";}i:1;a:5:{s:11:\"destination\";s:6:\"BARODA\";s:3:\"qty\";i:0;s:7:\"contact\";s:10:\"0912407031\";s:6:\"taluka\";s:6:\"BARODA\";s:8:\"district\";s:6:\"BARODA\";}i:2;a:5:{s:11:\"destination\";s:36:\"E-983 AJITNAKRUPA SOCITY AMBUKANAGAR\";s:3:\"qty\";i:0;s:7:\"contact\";s:10:\"8530808620\";s:6:\"taluka\";s:8:\"AHMEDABD\";s:8:\"district\";s:9:\"AHMEDABAD\";}}', 'tpca', 'ADAAS@GMAIL.COM', 'SHIV VYAS', 'a:4:{s:17:\"fright_debit_note\";s:2:\"NO\";s:13:\"gross_billing\";s:2:\"NO\";s:11:\"tax_invoice\";s:3:\"YES\";s:6:\"retail\";s:2:\"NO\";}', 'a:4:{s:7:\"advance\";s:2:\"NO\";s:16:\"against_delivery\";s:2:\"NO\";s:5:\"bg_lc\";s:2:\"NO\";s:14:\"parent_mapping\";s:3:\"YES\";}', NULL, 0, '', '', 'AAPFN4115L', '', '24AAPFN4115L1Z3', '', '', NULL, '2222', NULL, NULL, NULL, NULL, 'mehta', '2020-05-27 11:42:51', '2020-05-28 04:35:35', '2020-05-28 04:35:35', NULL, '51 MT'),
(5, 'SMIT CONSRUCTION', 'KRUSHNKUNJ SOCIETY,52, OPP. GOKULDHAM SOCIETY, KATHVADA ROAD, NARODA', 'AHMEDABAD', 'AHMEDABAD', 'AHMEDABAD', 'GUJARAT', '382330', 'JANAKBHAI PRAJPATI', NULL, '9737999028', NULL, NULL, NULL, 'a:6:{s:10:\"is_builder\";s:2:\"NO\";s:18:\"is_govt_contractor\";s:2:\"NO\";s:13:\"is_contractor\";s:2:\"NO\";s:16:\"is_institutional\";s:2:\"NO\";s:11:\"is_industry\";s:2:\"NO\";s:12:\"is_developer\";s:2:\"NO\";}', 'on_going', 'a:3:{i:0;a:6:{s:11:\"destination\";s:52:\"NEAR KRISHNAGAR CANAL, OPP.SARDAR CHOW, KRISHNANAGAR\";s:3:\"qty\";i:0;s:7:\"contact\";s:10:\"9824473800\";s:6:\"taluka\";s:8:\"AHMEDABD\";s:8:\"district\";s:9:\"AHMEDABAD\";s:7:\"pincode\";s:5:\"15001\";}i:1;a:6:{s:11:\"destination\";s:63:\"PLOT NO-29-30-31,SWATIK ESTATE , TARAV / BAKROL GAM PASE,BAKROL\";s:3:\"qty\";i:0;s:7:\"contact\";s:10:\"9737999028\";s:6:\"taluka\";s:8:\"AHMEDABD\";s:8:\"district\";s:9:\"AHMEDABAD\";s:7:\"pincode\";s:5:\"15002\";}i:2;a:6:{s:11:\"destination\";s:46:\"PAYAL NAGAR SOCITEY , NEAR DEVI CINEMA, NARODA\";s:3:\"qty\";i:0;s:7:\"contact\";s:10:\"9824473800\";s:6:\"taluka\";s:8:\"AHMEDABD\";s:8:\"district\";s:9:\"AHMEDABAD\";s:7:\"pincode\";s:5:\"15003\";}}', 'tpca', 'janakprajapati66@gmail.com', 'SHIV VYAS', 'a:4:{s:17:\"fright_debit_note\";s:2:\"NO\";s:13:\"gross_billing\";s:2:\"NO\";s:11:\"tax_invoice\";s:3:\"YES\";s:6:\"retail\";s:2:\"NO\";}', 'a:4:{s:7:\"advance\";s:2:\"NO\";s:16:\"against_delivery\";s:2:\"NO\";s:5:\"bg_lc\";s:2:\"NO\";s:14:\"parent_mapping\";s:3:\"YES\";}', '500000 & 4 DAYS', 0, '', '', 'BATPP8344J', '', '24BATPP8344J1Z0', '', '', NULL, 'GSC1045', NULL, NULL, NULL, NULL, 'mehta', '2020-05-28 05:19:03', '2020-06-09 09:54:21', NULL, NULL, '51 MT'),
(6, 'SHIV ENTERPRISE', 'SHOP NO.11, SAI APPARTMENT, RAJPIPLA ROAD, ANKLESHWAR, Bharuch,', 'BHARUCH', 'BHARUCH', 'BHARUCH', 'GUJARAT', '393002', 'RAJESH MAGANLAL CHOUVATIYA', NULL, '8530808620', NULL, NULL, NULL, 'a:6:{s:10:\"is_builder\";s:2:\"NO\";s:18:\"is_govt_contractor\";s:2:\"NO\";s:13:\"is_contractor\";s:2:\"NO\";s:16:\"is_institutional\";s:2:\"NO\";s:11:\"is_industry\";s:2:\"NO\";s:12:\"is_developer\";s:2:\"NO\";}', 'on_going', 'a:1:{i:0;a:5:{s:11:\"destination\";s:53:\"SHOP NO.11, SAI APPARTMENT, RAJPIPLA ROAD, ANKLESHWAR\";s:3:\"qty\";i:0;s:7:\"contact\";s:10:\"7622097097\";s:6:\"taluka\";s:7:\"BHARUCH\";s:8:\"district\";s:7:\"BHARUCH\";}}', 'tpca', 'ms.shiventerprise@rediffmail.com', 'SHIV VYAS', 'a:4:{s:17:\"fright_debit_note\";s:2:\"NO\";s:13:\"gross_billing\";s:2:\"NO\";s:11:\"tax_invoice\";s:2:\"NO\";s:6:\"retail\";s:2:\"NO\";}', 'a:4:{s:7:\"advance\";s:2:\"NO\";s:16:\"against_delivery\";s:2:\"NO\";s:5:\"bg_lc\";s:2:\"NO\";s:14:\"parent_mapping\";s:2:\"NO\";}', NULL, 0, '', '', 'AGHPC4479L', '', '24AGHPC4479L1Z6', '', '', NULL, '9124100000', NULL, NULL, NULL, NULL, 'ambuja', '2020-05-28 09:17:06', '2020-05-28 09:47:09', NULL, NULL, '51 MT'),
(7, 'Dhruval Ramani', 'Ahmedabad,  India', 'Pipriya', 'Lathi', 'Amreli', 'GUJARAT', '382350', 'Dhruval Ramani', NULL, '7990810440', NULL, NULL, '7990810440', 'a:6:{s:10:\"is_builder\";s:3:\"YES\";s:18:\"is_govt_contractor\";s:2:\"NO\";s:13:\"is_contractor\";s:2:\"NO\";s:16:\"is_institutional\";s:2:\"NO\";s:11:\"is_industry\";s:2:\"NO\";s:12:\"is_developer\";s:2:\"NO\";}', 'NEW', 'a:2:{i:0;a:6:{s:11:\"destination\";s:37:\"Pavillion mall, SG highway, Ahmedabad\";s:3:\"qty\";i:0;s:7:\"contact\";s:10:\"8000349694\";s:6:\"taluka\";s:9:\"Ahmedabad\";s:8:\"district\";s:9:\"Ahmedabad\";s:7:\"pincode\";s:6:\"382350\";}i:1;a:6:{s:11:\"destination\";s:36:\"Bhakti Bunglows, Ringroad, Ahmedabad\";s:3:\"qty\";i:0;s:7:\"contact\";s:10:\"9687767193\";s:6:\"taluka\";s:9:\"Ahmedabad\";s:8:\"district\";s:9:\"Ahmedabad\";s:7:\"pincode\";s:6:\"235610\";}}', 'tpca', 'geeky.dhruval@gmail.com', 'SHIV VYAS', 'a:4:{s:17:\"fright_debit_note\";s:2:\"NO\";s:13:\"gross_billing\";s:2:\"NO\";s:11:\"tax_invoice\";s:2:\"NO\";s:6:\"retail\";s:2:\"NO\";}', 'a:4:{s:7:\"advance\";s:2:\"NO\";s:16:\"against_delivery\";s:2:\"NO\";s:5:\"bg_lc\";s:2:\"NO\";s:14:\"parent_mapping\";s:2:\"NO\";}', '7 days', 0, '', '', '65465132', '', '6549846162', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'mehta', '2020-06-09 09:59:51', '2020-06-09 09:59:51', NULL, '100', '51 MT'),
(8, 'Harsh Kathiriya', 'Ahmedabad, India', 'Lathi', 'Pipriya', 'Amreli', 'GUJARAT', '382350', 'Harsh Kathiritya', NULL, '7990810440', NULL, NULL, '7990810440', 'a:6:{s:10:\"is_builder\";s:3:\"YES\";s:18:\"is_govt_contractor\";s:2:\"NO\";s:13:\"is_contractor\";s:2:\"NO\";s:16:\"is_institutional\";s:2:\"NO\";s:11:\"is_industry\";s:2:\"NO\";s:12:\"is_developer\";s:2:\"NO\";}', 'NEW', 'a:2:{i:0;a:6:{s:11:\"destination\";s:36:\"Pavillion mall, SG highway Ahmedabad\";s:3:\"qty\";i:0;s:7:\"contact\";s:10:\"8000349694\";s:6:\"taluka\";s:9:\"ahmedabad\";s:8:\"district\";s:9:\"ahmedabad\";s:7:\"pincode\";s:6:\"382350\";}i:1;a:6:{s:11:\"destination\";s:24:\"Bhakti circle, ahmedabad\";s:3:\"qty\";i:0;s:7:\"contact\";s:10:\"9687767193\";s:6:\"taluka\";s:9:\"ahmedabad\";s:8:\"district\";s:9:\"ahmedabad\";s:7:\"pincode\";s:6:\"552663\";}}', 'tpca', 'geeky.dhruval@gmail.com', 'SHIV VYAS', 'a:4:{s:17:\"fright_debit_note\";s:2:\"NO\";s:13:\"gross_billing\";s:2:\"NO\";s:11:\"tax_invoice\";s:2:\"NO\";s:6:\"retail\";s:2:\"NO\";}', 'a:4:{s:7:\"advance\";s:3:\"YES\";s:16:\"against_delivery\";s:2:\"NO\";s:5:\"bg_lc\";s:2:\"NO\";s:14:\"parent_mapping\";s:2:\"NO\";}', '7', 0, '', '', 'fkjgndkjfgbkdjfg', '', 'gfsdkjhgkjdfngkdmf', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'mehta', '2020-06-09 18:13:31', '2020-06-09 18:14:47', NULL, '200', '51 MT'),
(9, 'grs pvt ltd', 'chandigarh', 'chandigarh', 'chandigarh', 'chandigarh', 'CHANDIGARH', '160001', 'Gaurav Sharma', NULL, '2423434345', NULL, '5345345334', '45234234', 'a:6:{s:10:\"is_builder\";s:3:\"YES\";s:18:\"is_govt_contractor\";s:2:\"NO\";s:13:\"is_contractor\";s:2:\"NO\";s:16:\"is_institutional\";s:2:\"NO\";s:11:\"is_industry\";s:2:\"NO\";s:12:\"is_developer\";s:2:\"NO\";}', 'on_going', 'a:2:{i:0;a:6:{s:11:\"destination\";s:5:\"delhi\";s:3:\"qty\";i:0;s:7:\"contact\";s:11:\"23984134234\";s:6:\"taluka\";s:5:\"delhi\";s:8:\"district\";s:5:\"delhi\";s:7:\"pincode\";s:6:\"160004\";}i:1;a:6:{s:11:\"destination\";s:9:\"Bangalore\";s:3:\"qty\";i:0;s:7:\"contact\";s:12:\"234768234623\";s:6:\"taluka\";s:9:\"Bangalore\";s:8:\"district\";s:9:\"Bangalore\";s:7:\"pincode\";s:6:\"160045\";}}', 'dealer', 'grs@outlook.com', 'SHIV VYAS', 'a:4:{s:17:\"fright_debit_note\";s:3:\"YES\";s:13:\"gross_billing\";s:2:\"NO\";s:11:\"tax_invoice\";s:2:\"NO\";s:6:\"retail\";s:2:\"NO\";}', 'a:4:{s:7:\"advance\";s:3:\"YES\";s:16:\"against_delivery\";s:2:\"NO\";s:5:\"bg_lc\";s:2:\"NO\";s:14:\"parent_mapping\";s:2:\"NO\";}', '12', 1, '', '', 'pb0874234df', '', '7508332', '', '', 'qe', '12345667890', '09876', NULL, NULL, '12231231234345345', 'mehta', '2020-06-09 20:35:36', '2020-06-11 04:52:08', '2020-06-11 04:52:08', '100', '51 MT'),
(10, 'grs pvt ltd', 'chandigarh', 'chandigarh', 'chandigarh', 'chandigarh', 'PUNJAB', '160012', 'gaurav Sharma', '35348273', '5656537237', NULL, NULL, '9417334614', 'a:6:{s:10:\"is_builder\";s:2:\"NO\";s:18:\"is_govt_contractor\";s:2:\"NO\";s:13:\"is_contractor\";s:2:\"NO\";s:16:\"is_institutional\";s:2:\"NO\";s:11:\"is_industry\";s:2:\"NO\";s:12:\"is_developer\";s:2:\"NO\";}', 'on_going', 'a:3:{i:0;a:6:{s:11:\"destination\";s:9:\"Bangalore\";s:3:\"qty\";i:0;s:7:\"contact\";s:12:\"234768234623\";s:6:\"taluka\";s:9:\"Bangalore\";s:8:\"district\";s:9:\"Bangalore\";s:7:\"pincode\";s:6:\"160103\";}i:1;a:6:{s:11:\"destination\";s:7:\"chennai\";s:3:\"qty\";i:0;s:7:\"contact\";s:10:\"7819273123\";s:6:\"taluka\";s:7:\"chennai\";s:8:\"district\";s:7:\"chennai\";s:7:\"pincode\";s:6:\"160045\";}i:2;a:6:{s:11:\"destination\";s:10:\"chandigarh\";s:3:\"qty\";i:0;s:7:\"contact\";s:12:\"564234765675\";s:6:\"taluka\";s:10:\"chandigarh\";s:8:\"district\";s:11:\"channdigarh\";s:7:\"pincode\";s:6:\"160043\";}}', 'dealer', 'grs@gmail.com', 'SHIV VYAS', 'a:4:{s:17:\"fright_debit_note\";s:2:\"NO\";s:13:\"gross_billing\";s:2:\"NO\";s:11:\"tax_invoice\";s:2:\"NO\";s:6:\"retail\";s:2:\"NO\";}', 'a:4:{s:7:\"advance\";s:2:\"NO\";s:16:\"against_delivery\";s:2:\"NO\";s:5:\"bg_lc\";s:2:\"NO\";s:14:\"parent_mapping\";s:2:\"NO\";}', NULL, 0, '', '', 'pb0874234df', '', '7508332', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'mehta', '2020-06-11 04:51:34', '2020-06-11 04:58:22', NULL, '1000', '51 MT'),
(11, 'codeshode', 'chandigarh', 'chand', 'chand', 'chandigarh', 'CHANDIGARH', '160020', 'Gaurav Sharma', NULL, '7463984584', NULL, NULL, NULL, 'a:6:{s:10:\"is_builder\";s:2:\"NO\";s:18:\"is_govt_contractor\";s:2:\"NO\";s:13:\"is_contractor\";s:2:\"NO\";s:16:\"is_institutional\";s:2:\"NO\";s:11:\"is_industry\";s:2:\"NO\";s:12:\"is_developer\";s:2:\"NO\";}', 'on_going', 'a:2:{i:0;a:6:{s:11:\"destination\";s:5:\"delhi\";s:3:\"qty\";i:0;s:7:\"contact\";s:9:\"238489234\";s:6:\"taluka\";s:5:\"delhi\";s:8:\"district\";s:5:\"delhi\";s:7:\"pincode\";s:7:\"0110234\";}i:1;a:6:{s:11:\"destination\";s:9:\"bangalore\";s:3:\"qty\";i:0;s:7:\"contact\";s:6:\"289472\";s:6:\"taluka\";s:4:\"bang\";s:8:\"district\";s:4:\"lore\";s:7:\"pincode\";s:7:\"4392032\";}}', 'tpca', 'grs@65.com', 'SHIV VYAS', 'a:4:{s:17:\"fright_debit_note\";s:3:\"YES\";s:13:\"gross_billing\";s:2:\"NO\";s:11:\"tax_invoice\";s:2:\"NO\";s:6:\"retail\";s:2:\"NO\";}', 'a:4:{s:7:\"advance\";s:2:\"NO\";s:16:\"against_delivery\";s:2:\"NO\";s:5:\"bg_lc\";s:2:\"NO\";s:14:\"parent_mapping\";s:2:\"NO\";}', NULL, 0, '', '', '3242343qwe432', '', '234234234', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'mehta', '2020-06-13 18:02:01', '2020-06-13 18:02:01', NULL, '1000', '51 MT'),
(12, 'grs81293', 'chandigarh', 'Rest data', 'chandigarh', 'chandigarh', 'PUNJAB', '120934', 'gaurav', '98423434723', '234234234', NULL, NULL, NULL, 'a:6:{s:10:\"is_builder\";s:2:\"NO\";s:18:\"is_govt_contractor\";s:2:\"NO\";s:13:\"is_contractor\";s:2:\"NO\";s:16:\"is_institutional\";s:2:\"NO\";s:11:\"is_industry\";s:2:\"NO\";s:12:\"is_developer\";s:2:\"NO\";}', 'on_going', 'a:2:{i:0;a:6:{s:11:\"destination\";s:9:\"bangalore\";s:3:\"qty\";i:0;s:7:\"contact\";s:10:\"4853459345\";s:6:\"taluka\";s:8:\"banglore\";s:8:\"district\";s:8:\"banglore\";s:7:\"pincode\";s:7:\"1298453\";}i:1;a:6:{s:11:\"destination\";s:7:\"chennai\";s:3:\"qty\";i:0;s:7:\"contact\";s:11:\"23434234234\";s:6:\"taluka\";s:7:\"chennai\";s:8:\"district\";s:7:\"chennai\";s:7:\"pincode\";s:6:\"432345\";}}', 'tpca', 'q@a.com', 'SHIV VYAS', 'a:4:{s:17:\"fright_debit_note\";s:2:\"NO\";s:13:\"gross_billing\";s:2:\"NO\";s:11:\"tax_invoice\";s:2:\"NO\";s:6:\"retail\";s:2:\"NO\";}', 'a:4:{s:7:\"advance\";s:2:\"NO\";s:16:\"against_delivery\";s:2:\"NO\";s:5:\"bg_lc\";s:2:\"NO\";s:14:\"parent_mapping\";s:2:\"NO\";}', NULL, 0, '', '', '3242343qwe432', '', '24234', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'mehta', '2020-06-13 20:01:16', '2020-06-13 20:01:16', NULL, '1234', '51 MT');

-- --------------------------------------------------------

--
-- Table structure for table `dispatch_reports`
--

CREATE TABLE `dispatch_reports` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL DEFAULT 'ambuja',
  `ref_doc_no` varchar(100) DEFAULT NULL,
  `del_date` date DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `invoice_no` varchar(100) DEFAULT NULL,
  `s_plan_no` varchar(100) DEFAULT NULL,
  `transport_name` varchar(250) DEFAULT NULL,
  `date_tmg` date DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `order_no` varchar(100) DEFAULT NULL,
  `party_code` varchar(100) DEFAULT NULL,
  `truck_no` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `party_name` varchar(100) DEFAULT NULL,
  `invoice_amount` varchar(100) DEFAULT NULL,
  `company` varchar(150) DEFAULT NULL,
  `tax_retail_inv` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dispatch_reports`
--

INSERT INTO `dispatch_reports` (`id`, `type`, `ref_doc_no`, `del_date`, `quantity`, `invoice_no`, `s_plan_no`, `transport_name`, `date_tmg`, `brand`, `price`, `order_no`, `party_code`, `truck_no`, `location`, `party_name`, `invoice_amount`, `company`, `tax_retail_inv`, `created_at`, `updated_at`) VALUES
(1, 'ambuja', '6834767432', '2020-05-11', '22.97', 'NE16241911042635', '1900416533', 'VIKRAM COAL CARRIERS PVT LTD', NULL, NULL, NULL, '56784532', '9124130094', 'GJ18AV6468', 'Saroligam(Surat)', 'S.G Group', '130929', NULL, NULL, '2020-05-10 19:26:26', '2020-05-10 19:26:26'),
(2, 'mehta', NULL, NULL, '30', 'SGC1920040675', NULL, 'SHYAM ROADWAYS', NULL, 'SIDHEE', '285', 'GAHSO001216DEC19', 'GPC346', 'GJ11TT9530', 'C/O PATEL CONSTRUCTION', 'S.G Builders', '171000', 'GSCL', '37246873', '2020-05-10 19:33:50', '2020-05-10 19:33:50'),
(3, 'mehta', NULL, NULL, '25', 'SGC1920040646', NULL, 'SHREE VAIBHAV LAXMI CARRI', NULL, 'HATHI', '285', 'GAHSO001234DEC19', 'GPC346', 'GJ27U3231', 'SAGAR RESIDENCY NR JANHVI FARM', 'S.G Builders', '142500', 'GSCL', '36674536', '2020-05-10 19:45:26', '2020-05-10 19:45:26'),
(4, 'ambuja', '6834767252', '2020-05-11', '21.75', 'NE16241911042631', '1900415375', 'A M KURESHI', NULL, NULL, NULL, '34526798', '9124130094', 'GJ18AT9312', 'Devsar(Navsari)', 'S.G Group', '123975', NULL, NULL, '2020-05-10 19:47:13', '2020-05-10 19:47:13'),
(5, 'ambuja', '314', '2020-05-14', '120', '22344567', '34234', 'new transporter', NULL, NULL, NULL, '56784532', '9124130094', 'rj4298b34-32', 'jaipur', 'S.G Group', '32000', NULL, NULL, '2020-05-15 13:46:51', '2020-05-15 13:46:51'),
(6, 'mehta', NULL, NULL, '12', '22344567', NULL, 'new transporter', NULL, 'hathi', '45000', 'GAHSO001234DEC19', '9124130094', 'rj4298b34-32', 'jaipur dat sdf fdr', 'S.G Group', '45000', 'tmg', '342424234', '2020-05-15 15:00:21', '2020-05-15 15:00:21'),
(7, 'ambuja', 'q34324', '2020-05-16', '12', '324234', '234234234', '3434234', NULL, NULL, NULL, '56784532', '9124130094', '234234', '33434', 'S.G Group', '234234', NULL, NULL, '2020-05-15 15:10:09', '2020-05-15 15:10:09'),
(8, 'ambuja', '314123', '2020-05-21', '12', '12313123', '2342234', 'new transporter123', NULL, NULL, NULL, '56784532', 'GPC346', 'rj4298b34-32', 'jaipur dat sdf fdr', 'S.G Builders', '123456', NULL, NULL, '2020-05-21 09:21:24', '2020-05-21 09:21:24'),
(10, 'mehta', NULL, NULL, '25', 'RNVC2021005774', NULL, 'OKHAI ENTERPRISE', NULL, 'HATHI', '315', 'SAHSO000497MAY20', 'GSC1045', 'GJ11Y8056', 'OPP:SARDAR CHOWK', 'SMIT CONSRUCTION', '157500', 'SCL', 'RNVT2021005174', '2020-05-28 07:30:57', '2020-05-28 07:30:57'),
(11, 'mehta', NULL, NULL, '25', 'RNVC2021005774', NULL, 'OKHAI ENTERPRISE', NULL, 'HATHI', '315', 'SAHSO000497MAY20', 'GSC1045', 'GJ11Y8056', 'OPP:SARDAR CHOWK', NULL, '157500', 'SCL', 'RNVT2021005174', '2020-05-28 07:32:30', '2020-05-28 07:32:30'),
(12, 'ambuja', '6835659071', '2020-05-20', '20', 'NE02242011005151', '1900507970', 'AUTO TRANSPORT SERVICES', NULL, NULL, NULL, '78910', '9124100000', 'GJ11Y8056', 'Moti Khilori(Rajkot)', 'SHIV ENTERPRISE', '148800', NULL, NULL, '2020-05-28 10:10:51', '2020-05-28 10:10:51'),
(14, 'ambuja', '6835659071', '2020-05-30', '20', 'NE02242011005151', '1900507970', 'AUTO TRANSPORT SERVICES', NULL, NULL, NULL, '78910', '9124100000', 'GJ11Z5590', 'Moti Khilori(Rajkot)', 'SHIV ENTERPRISE', '148800', NULL, NULL, '2020-05-28 10:14:41', '2020-05-28 10:14:41');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_code` varchar(7) DEFAULT NULL,
  `builder_id` int(11) NOT NULL,
  `cement_brand` varchar(50) NOT NULL,
  `cement_brand_value` varchar(100) NOT NULL DEFAULT 'ambuja',
  `plant_id` int(11) NOT NULL,
  `packing_type` varchar(50) NOT NULL,
  `cement_type` varchar(50) NOT NULL,
  `bag_price` int(10) NOT NULL DEFAULT 0,
  `quantity_type_kg` varchar(100) DEFAULT NULL,
  `quantity_type_bag` int(10) NOT NULL DEFAULT 0,
  `total_amount` int(10) NOT NULL DEFAULT 0,
  `payment_detail` varchar(200) DEFAULT NULL,
  `cheque_no` varchar(200) DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `bank` varchar(200) DEFAULT NULL,
  `order_no` varchar(200) DEFAULT NULL,
  `order_schedule` varchar(100) DEFAULT NULL,
  `billing_address` varchar(250) DEFAULT NULL,
  `delivery_address` varchar(250) DEFAULT NULL,
  `site_address` varchar(100) DEFAULT NULL,
  `site_contact` varchar(25) DEFAULT NULL,
  `rate_per_mt` varchar(100) DEFAULT NULL,
  `site_taluka` varchar(250) DEFAULT NULL,
  `site_district` varchar(250) DEFAULT NULL,
  `delivery_details` varchar(210) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `builder_id`, `cement_brand`, `cement_brand_value`, `plant_id`, `packing_type`, `cement_type`, `bag_price`, `quantity_type_kg`, `quantity_type_bag`, `total_amount`, `payment_detail`, `cheque_no`, `cheque_date`, `bank`, `order_no`, `order_schedule`, `billing_address`, `delivery_address`, `site_address`, `site_contact`, `rate_per_mt`, `site_taluka`, `site_district`, `delivery_details`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 1, 'mehta', 'ambuja', 2, 'bulk', 'opc_43', 255, '30', 0, 0, NULL, NULL, NULL, 'Axis Bank', 'GAHSO001216DEC19', 'Daily 2', '421, vishala supreme, ahmedabad - 382350', 'Pavillion Mall, S.G Highway', 'Pavillion Mall, S.G Highway', '9687767193', '700', 'Nikol', 'Ahmedabad', NULL, '2020-05-10 19:33:46', '2020-05-10 19:33:46', NULL),
(2, NULL, 2, 'ambuja', 'ambuja', 1, 'bulk', 'opc_53', 265, '35', 0, 0, NULL, NULL, NULL, 'ICICI Bank', '56784532', 'Daily', '421, vishala supreme, ahmedabad - 382350', 'Bhakti Bunglows, Nikol, Ahmedabad - 382350', 'Bhakti Bunglows, Nikol, Ahmedabad - 382350', '8000349694', '600', 'S.g Highway', 'Ahmedabad', NULL, '2020-05-10 19:26:04', '2020-05-10 19:26:04', NULL),
(3, NULL, 1, 'mehta', 'ambuja', 2, 'bulk', 'ppc', 260, '35', 0, 0, NULL, NULL, NULL, 'Axis Bank Ltd.', 'GAHSO001234DEC19', 'Daily 2', '421, vishala supreme, ahmedabad - 382350', 'Pavillion Mall, S.G Highway', 'Pavillion Mall, S.G Highway', '9687767193', '700', 'Nikol', 'Ahmedabad', NULL, '2020-05-10 19:45:21', '2020-05-10 19:45:21', NULL),
(4, NULL, 2, 'ambuja', 'ambuja', 1, 'bag', 'opc_53', 45, '50', 0, 0, NULL, NULL, NULL, 'ICICI Bank', '34526798', 'Daily 1', '421, vishala supreme, ahmedabad - 382350', 'Bhakti Bunglows, Nikol, Ahmedabad - 382350', 'Bhakti Bunglows, Nikol, Ahmedabad - 382350', '8000349694', '700', 'S.g Highway', 'Ahmedabad', NULL, '2020-05-10 19:47:10', '2020-05-10 19:47:10', NULL),
(5, NULL, 3, 'ambuja', 'ambuja', 2, 'bulk', 'opc_53', 315, '100', 0, 0, NULL, NULL, NULL, NULL, NULL, 'N/A', 'KALASH-2 ENCLAVE, B/H. SUNRISE HOMES, LAMBHA VATVA ROAD,VATVA', 'NAROL', 'NAROL', '9090909909700', NULL, 'AHMEDABAD', 'AHEDABAD-382415', NULL, '2020-05-28 04:36:10', '2020-05-28 04:36:10', '2020-05-28 04:36:10'),
(6, NULL, 3, 'ambuja', 'ambuja', 1, 'bulk', 'ppc', 315, '100', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'KALASH-2 ENCLAVE, B/H. SUNRISE HOMES, LAMBHA VATVA ROAD,VATVA', 'E-983 AJITNAKRUPA SOCITY AMBUKANAGAR', 'NAROL', '9090909909700', NULL, 'AHMEDABAD', 'AHEDABAD-382415', NULL, '2020-05-27 11:53:33', '2020-05-27 11:53:33', NULL),
(7, NULL, 5, 'mehta', 'ambuja', 5, 'bag', 'opc_53', 315, '25', 0, 0, NULL, NULL, NULL, NULL, 'SAHSO000497MAY20', 'N/A', 'KRUSHNKUNJ SOCIETY,52, OPP. GOKULDHAM SOCIETY, KATHVADA ROAD, NARODA', 'PLOT NO-29-30-31,SWATIK ESTATE , TARAV / BAKROL GAM PASE,BAKROL', 'NEAR KRISHNAGAR CANAL, OPP.SARDAR CHOW, KRISHNANAGAR', '9824473800', '6300', 'AHMEDABD', 'AHMEDABAD', NULL, '2020-05-28 07:23:59', '2020-05-28 07:23:59', NULL),
(8, NULL, 6, 'ambuja', 'ambuja', 6, 'bulk', 'opc_53', 315, '20', 0, 0, NULL, NULL, NULL, NULL, '100', 'N/A', 'SHOP NO.11, SAI APPARTMENT, RAJPIPLA ROAD, ANKLESHWAR, Bharuch,', 'SHOP NO.11, SAI APPARTMENT, RAJPIPLA ROAD, ANKLESHWAR', 'SHOP NO.11, SAI APPARTMENT, RAJPIPLA ROAD, ANKLESHWAR', 'N/A', NULL, 'N/A', 'N/A', NULL, '2020-05-28 09:47:54', '2020-05-28 09:47:54', NULL),
(9, NULL, 6, 'ambuja', 'ambuja', 6, 'bag', 'ppc', 315, '50', 0, 0, NULL, '78910', NULL, NULL, '78910', 'N/A', 'SHOP NO.11, SAI APPARTMENT, RAJPIPLA ROAD, ANKLESHWAR, Bharuch,', 'SHOP NO.11, SAI APPARTMENT, RAJPIPLA ROAD, ANKLESHWAR', 'SHOP NO.11, SAI APPARTMENT, RAJPIPLA ROAD, ANKLESHWAR', '7622097097', NULL, 'BHARUCH', 'BHARUCH', NULL, '2020-05-28 10:09:59', '2020-05-28 10:09:59', NULL),
(10, NULL, 1, 'ambuja', 'ambuja', 6, 'bulk', 'opc_43', 315, '20', 0, 0, NULL, NULL, '2020-06-08', NULL, NULL, NULL, '421, vishala supreme, ahmedabad - 382350', 'Bhakti Bunglows, Nikol, Ahmedabad - 382350', 'Pavillion Mall, S.G Highway', '9687767193', '200', 'Nikol', 'Ahmedabad', NULL, '2020-06-09 08:09:39', '2020-06-09 08:09:39', NULL),
(11, NULL, 5, 'mehta', 'sidhi', 4, 'bulk', 'opc_53', 20, '20', 0, 0, NULL, NULL, '2020-06-03', NULL, NULL, NULL, 'KRUSHNKUNJ SOCIETY,52, OPP. GOKULDHAM SOCIETY, KATHVADA ROAD, NARODA', 'NEAR KRISHNAGAR CANAL, OPP.SARDAR CHOW, KRISHNANAGAR', 'NEAR KRISHNAGAR CANAL, OPP.SARDAR CHOW, KRISHNANAGAR', '9824473800', '200', 'AHMEDABD', 'AHMEDABAD', NULL, '2020-06-09 09:53:39', '2020-06-09 09:53:39', NULL),
(12, NULL, 7, 'mehta', 'hathi', 5, 'bag', 'opc_53', 20, '20', 0, 0, NULL, NULL, '2020-06-01', NULL, NULL, NULL, 'Ahmedabad,  India', 'Pavillion mall, SG highway, Ahmedabad', 'Pavillion mall, SG highway, Ahmedabad', '8000349694', '20', 'Ahmedabad', 'Ahmedabad', NULL, '2020-06-09 10:00:27', '2020-06-09 10:00:27', NULL),
(13, NULL, 7, 'mehta', 'hathi', 5, 'bulk', 'opc_53', 20, '20', 0, 0, NULL, NULL, '2020-06-02', NULL, NULL, NULL, 'Ahmedabad,  India', 'Bhakti Bunglows, Ringroad, Ahmedabad', 'Pavillion mall, SG highway, Ahmedabad', '8000349694', '120', 'Ahmedabad', 'Ahmedabad', NULL, '2020-06-09 17:52:29', '2020-06-09 17:52:29', NULL),
(14, NULL, 8, 'ambuja', 'ambuja', 6, 'bulk', 'ppc', 20, '20', 0, 0, NULL, NULL, '2020-06-03', NULL, NULL, NULL, 'Ahmedabad, India', 'Bhakti circle, ahmedabad', 'Pavillion mall, SG highway Ahmedabad', '8000349694', '20', 'ahmedabad', 'ahmedabad', NULL, '2020-06-09 18:14:14', '2020-06-09 18:14:14', NULL),
(15, NULL, 8, 'mehta', 'hathi', 4, 'bag', 'opc_53', 20, '20', 0, 0, NULL, NULL, '2020-06-08', NULL, NULL, NULL, 'Ahmedabad, India', 'Pavillion mall, SG highway Ahmedabad', 'Pavillion mall, SG highway Ahmedabad', '8000349694', '20', 'ahmedabad', 'ahmedabad', NULL, '2020-06-09 18:15:18', '2020-06-09 18:15:18', NULL),
(16, NULL, 9, 'ambuja', 'ambuja', 5, 'bulk', 'opc_53', 230, '50', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'chandigarh', 'delhi', 'delhi', '23984134234', NULL, 'delhi', 'delhi', NULL, '2020-06-11 04:48:59', '2020-06-11 04:48:59', '2020-06-11 04:48:59'),
(17, NULL, 9, 'mehta', 'hathi', 5, 'bulk', 'opc_53', 230, '50', 0, 0, 'ewrwer', 'erwe', '2020-07-10', 'werwerwe', 'rwerwer', 'now', 'chandigarh', 'delhi', 'delhi', 'N/A', '23', 'N/A', 'N/A', NULL, '2020-06-11 04:48:56', '2020-06-11 04:48:56', '2020-06-11 04:48:56'),
(18, NULL, 9, 'mehta', 'hathi', 4, 'bag', 'opc_53', 32, '23', 0, 0, NULL, NULL, NULL, NULL, NULL, 'N/A', 'chandigarh', 'Bangalore', 'delhi', '23984134234', NULL, 'delhi', 'delhi', NULL, '2020-06-11 04:48:52', '2020-06-11 04:48:52', '2020-06-11 04:48:52'),
(19, NULL, 10, 'mehta', 'hathi', 5, 'bulk', 'opc_43', 345, '23', 0, 0, NULL, NULL, NULL, NULL, NULL, 'N/A', 'chandigarh', 'chennai', 'Bangalore', '234768234623', NULL, 'Bangalore', 'Bangalore', NULL, '2020-06-11 04:56:04', '2020-06-11 04:56:04', NULL),
(20, NULL, 10, 'mehta', 'hathi', 4, 'bulk', 'opc_53', 300, '10', 0, 0, NULL, NULL, NULL, NULL, NULL, 'N/A', 'chandigarh', 'chandigarh', 'Bangalore', '234768234623', '12', 'Bangalore', 'Bangalore', '160103', '2020-06-12 18:00:49', '2020-06-12 18:00:49', NULL),
(21, NULL, 11, 'mehta', 'hathi', 5, 'bag', 'opc_53', 230, '50', 0, 0, NULL, NULL, NULL, NULL, NULL, 'N/A', 'chandigarh', 'delhi', 'delhi', '238489234', NULL, 'delhi', 'delhi', '{\"destination\":\"delhi\",\"qty\":0,\"contact\":\"238489234\",\"taluka\":\"delhi\",\"district\":\"delhi\",\"pincode\":\"0110234\"}', '2020-06-13 18:07:25', '2020-06-13 18:07:25', NULL),
(22, NULL, 11, 'mehta', 'hathi', 4, 'bag', 'opc_53', 11212, '3232`', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'chandigarh', 'delhi', 'chandigarh', '7463984584', NULL, 'chand', 'chandigarh', '{\"destination\":\"delhi\",\"qty\":0,\"contact\":\"238489234\",\"taluka\":\"delhi\",\"district\":\"delhi\",\"pincode\":\"0110234\"}', '2020-06-13 19:08:05', '2020-06-13 19:08:05', NULL),
(23, NULL, 11, 'ambuja', 'ambuja', 4, 'bag', 'opc_53', 230, '50', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'chandigarh', 'bangalore', 'chandigarh', '7463984584', NULL, 'chand', 'chandigarh', '{\"destination\":\"bangalore\",\"qty\":0,\"contact\":\"289472\",\"taluka\":\"bang\",\"district\":\"lore\",\"pincode\":\"4392032\"}', '2020-06-13 19:10:20', '2020-06-13 19:10:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `builder_id` int(11) NOT NULL,
  `payment_mode` int(5) NOT NULL DEFAULT 1 COMMENT '1=>Cash, 2=>RTGS, 3=> Cheque',
  `amount` int(11) DEFAULT NULL,
  `rtgs_no` varchar(40) DEFAULT NULL,
  `cheque_rtgs_no` varchar(50) DEFAULT NULL,
  `account_no` varchar(50) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `ifsc_code` varchar(20) DEFAULT NULL,
  `branch_name` varchar(80) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `party_remarks` varchar(250) DEFAULT NULL,
  `utilize` tinyint(1) NOT NULL DEFAULT 0,
  `account_holder` varchar(200) DEFAULT NULL,
  `invoice_reference` varchar(200) DEFAULT NULL,
  `dispatch_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `builder_id`, `payment_mode`, `amount`, `rtgs_no`, `cheque_rtgs_no`, `account_no`, `bank_name`, `ifsc_code`, `branch_name`, `remarks`, `party_remarks`, `utilize`, `account_holder`, `invoice_reference`, `dispatch_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, 130929, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 1, '2020-05-10 19:26:08', '2020-05-10 19:26:08'),
(2, 1, 1, 1, 171000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 2, '2020-05-10 19:33:50', '2020-05-10 19:33:50'),
(3, 3, 1, 1, 142500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 3, '2020-05-10 19:45:26', '2020-05-10 19:45:26'),
(4, 4, 2, 1, 123975, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 4, '2020-05-10 19:47:13', '2020-05-10 19:47:13'),
(5, 2, 2, 1, 100000, NULL, NULL, NULL, NULL, NULL, NULL, 'Credited amount', 'S.G Group', 1, NULL, 'NE16241911042635', 0, '2020-05-10 19:55:03', '2020-05-10 19:55:03'),
(6, 2, 2, 2, 50000, NULL, '47985473985', '984783657843', 'AXIS Bank', 'AXIS3424', 'Ahmedabad', 'Credited amount', 'S.G Group', 1, 'Dhruval Ramani', 'NE16241911042635', 0, '2020-05-10 19:55:03', '2020-05-10 19:55:03'),
(7, 1, 1, 3, 300000, NULL, '87647362468732', '4765874658', 'ICICI Bank', 'ICIC37846827', 'Ahmedabad', 'Credited amount', 'S.G Group', 1, 'Dhruval Ramani', 'SGC1920040675', 0, '2020-05-10 20:07:47', '2020-05-10 20:07:47'),
(8, 3, 1, 2, 125000, NULL, '776347647394578', '984783657843', 'ICICI Bank', 'ICIC37846827', 'Ahmedabad', 'Credited amount', 'S.G Group', 1, 'Dhruval Ramani', 'SGC1920040690', 0, '2020-05-10 20:09:45', '2020-05-10 20:09:45'),
(9, 4, 2, 1, 40000, NULL, NULL, NULL, NULL, NULL, NULL, 'Credited amount', 'S.G Group', 1, NULL, 'NE16241911042635', 0, '2020-05-10 20:34:42', '2020-05-10 20:34:42'),
(10, 2, 2, 1, 32000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 5, '2020-05-15 13:46:51', '2020-05-15 13:46:51'),
(11, 3, 1, 1, 45000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 6, '2020-05-15 15:00:21', '2020-05-15 15:00:21'),
(12, 2, 2, 1, 234234, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 7, '2020-05-15 15:10:09', '2020-05-15 15:10:09'),
(13, 2, 2, 1, 123456, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 8, '2020-05-21 09:21:24', '2020-05-21 09:21:24'),
(14, 6, 3, 1, 4404040, NULL, NULL, NULL, NULL, NULL, NULL, '4804', NULL, 1, NULL, NULL, 0, '2020-05-27 12:15:40', '2020-05-27 12:15:40'),
(15, 7, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 9, '2020-05-28 07:25:14', '2020-05-28 07:25:14'),
(16, 7, 5, 1, 157500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 10, '2020-05-28 07:30:57', '2020-05-28 07:30:57'),
(17, 7, 5, 1, 157500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 11, '2020-05-28 07:32:30', '2020-05-28 07:32:30'),
(18, 7, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SGMTI2021003534', NULL, 1, NULL, 'SGMTI2021003534', 0, '2020-05-28 07:47:32', '2020-05-28 07:47:32'),
(19, 7, 5, 2, 157500, NULL, 'GSCBN20147856529', 'NO', 'BANK OF BARODA', NULL, NULL, 'GSCBN20147856529', 'GSCBN20147856529', 1, 'SMIT', 'GSCBN20147856529', 0, '2020-05-28 07:47:32', '2020-05-28 07:47:32'),
(20, 9, 6, 1, 148800, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 12, '2020-05-28 10:10:51', '2020-05-28 10:10:51'),
(21, 9, 6, 1, 148800, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 13, '2020-05-28 10:13:36', '2020-05-28 10:13:36'),
(22, 9, 6, 1, 148800, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 14, '2020-05-28 10:14:41', '2020-05-28 10:14:41'),
(23, 9, 6, 2, 100000, NULL, 'KKBC6008', '100', 'KOTAK', 'JAJOA', 'UDJND', 'RTGS', 'RTGS', 0, 'SHIV ENTERPRISE', NULL, 0, '2020-05-28 10:20:27', '2020-05-28 10:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `id` int(11) NOT NULL,
  `plant_name` varchar(200) DEFAULT NULL,
  `plant_email` varchar(200) DEFAULT NULL,
  `plant_contact` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`id`, `plant_name`, `plant_email`, `plant_contact`, `created_at`, `updated_at`) VALUES
(4, 'GSCL', 'g@gmail.com', 'GSCL', '2020-05-28 05:47:27', '2020-05-28 05:47:27'),
(5, 'SCL', 'g@gmail.com', 'SCL', '2020-05-28 05:48:04', '2020-05-28 05:48:04'),
(6, 'AMBUJA CEMENTS LTD', 'g@gmail.com', 'AMBUJA', '2020-05-28 05:48:22', '2020-05-28 05:48:22'),
(7, 'daf', NULL, NULL, '2020-06-09 07:31:29', '2020-06-09 07:31:29'),
(8, 'Test', 'test@gmail.com', NULL, '2020-06-09 08:02:51', '2020-06-09 08:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state`) VALUES
(1, 'ANDAMAN AND NICOBAR ISLANDS'),
(2, 'ANDHRA PRADESH'),
(3, 'ARUNACHAL PRADESH'),
(4, 'ASSAM'),
(5, 'BIHAR'),
(6, 'CHATTISGARH'),
(7, 'CHANDIGARH'),
(8, 'DAMAN AND DIU'),
(9, 'DELHI'),
(10, 'DADRA AND NAGAR HAVELI'),
(11, 'GOA'),
(12, 'GUJARAT'),
(13, 'HIMACHAL PRADESH'),
(14, 'HARYANA'),
(15, 'JAMMU AND KASHMIR'),
(16, 'JHARKHAND'),
(17, 'KERALA'),
(18, 'KARNATAKA'),
(19, 'LAKSHADWEEP'),
(20, 'MEGHALAYA'),
(21, 'MAHARASHTRA'),
(22, 'MANIPUR'),
(23, 'MADHYA PRADESH'),
(24, 'MIZORAM'),
(25, 'NAGALAND'),
(26, 'ORISSA'),
(27, 'PUNJAB'),
(28, 'PONDICHERRY'),
(29, 'RAJASTHAN'),
(30, 'SIKKIM'),
(31, 'TAMIL NADU'),
(32, 'TRIPURA'),
(33, 'UTTARAKHAND'),
(34, 'UTTAR PRADESH'),
(35, 'WEST BENGAL'),
(36, 'TELANGANA');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Shyaam corporation', 'admin@gmail.com', NULL, '$2y$10$28.G.17/4wW63L3uMD2vNO.ijlV6t4s4.w3VaSv7oQfHG0deJRBI2', 'tDNQjgb8FQq9BjUDBIagMtx8lGVh3KZm46HkVKbGldi8ICiFuIBqKsVlEFld', '2020-02-27 13:42:58', '2020-04-15 20:27:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `builders`
--
ALTER TABLE `builders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispatch_reports`
--
ALTER TABLE `dispatch_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `builder_id` (`builder_id`),
  ADD KEY `plant_id` (`plant_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `builders`
--
ALTER TABLE `builders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dispatch_reports`
--
ALTER TABLE `dispatch_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
