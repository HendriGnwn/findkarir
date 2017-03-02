/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Carbon
 * Created: Feb 24, 2017
 */

-- [24/02/2017] create config table
CREATE TABLE `config` (
  `name` char(100) NOT NULL,
  `value` text NOT NULL,
  `label` varchar(255) NULL,
  `note` varchar(500) NULL
);
ALTER TABLE `config` ADD UNIQUE `name` (`name`);

INSERT INTO `config` (`name`, `value`, `label`, `note`) VALUES
	('admin_email',	'hendrigunawan195@gmail.com',	NULL,	NULL),
	('app_contact_address',	'Jakarta, Indonesia',	'Contact Address',	NULL),
	('app_contact_address_2',	'Jakarta, Indonesia',	'Contact Address 2',	NULL),
	('app_contact_email',	'info@findkarir.com',	'Contact Email',	NULL),
	('app_contact_latitude',	'-6.5459917',	NULL,	NULL),
	('app_contact_longitude',	'106.6778467',	NULL,	NULL),
	('app_contact_phone',	'+62 856 1471 500',	'Contact Phone',	NULL),
	('app_contact_phone_2',	'+62 856 1471 500',	'Contact Phone 2',	NULL),
	('app_facebook_url',	'https://www.facebook.com/',	NULL,	NULL),
	('app_google_url',	'https://plus.google.com/',	NULL,	NULL),
	('app_main_url',	'http://www.findkarir.com',	'Web Main Url',	NULL),
	('main_metadesc',	'Temukan lowongan kerja dan masa depan karier yang lebih baik bersama FindKarir, salah satu situs penyedia informasi pekerjaan di Indonesia',	NULL,	NULL),
	('app_name',	'Find Karir',	NULL,	NULL),
	('app_pagetitle',	'FindKarir.com | Salah satu situs penyedia lowongan kerja di Indonesia',	NULL,	NULL),
	('app_twitter_url',	'https://www.twitter.com/',	NULL,	NULL),
	('developers_email',	'[\"hendrigunawan195@gmail.com\", \"winatasandi05@gmail.com\"]',	NULL,	NULL),
	('main_metakey',	'findkarir in indonesia, Jakarta, Surabaya, Bandung, Medan, Palembang, Tangerang, indonesia jobs, indonesia, find karir,  IT jobs, HR jobs, finance jobs, sales jobs, marketing jobs, engineering jobs, customer service jobs, accounting jobs, management jobs, legal jobs, business development, career resource,  career, create resume, education career, employer, employment, employment opportunity, employment asia,  find job, free job posting, it recruitment, human resource, internet recruitment, jobstreet, job, job interview, job listing, job site, job vacancy, job opening, job placement, job opportunity, job seeker, karir tips,  job alert,  job online, job search, lowongan kerja, online job search, online recruitment,  post advertisement, recruitment, recruitment agency, findkarir, find karir',	NULL,	NULL),
	('noreply_email',	'no-reply@findkarir.com',	NULL,	NULL),
	('app_name_url', 'FindKarir.com', NULL, NULL);

CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` int(11) NOT NULL COMMENT '1=web;2=company;3=candidate employee',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=active;0=inactive',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `page` (`id`, `name`, `slug`, `description`, `category`, `status`, `created_at`, `updated_at`) VALUES
(1,	'Mengenai jeLoker.com',	'mengenai-findkarir-com',	"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit volup accusantium. Lorem ipsum dolor sit amet, consectetur.",	1,	1,	'2015-06-29 11:17:59',	NULL),
(2,	'Berkarir Bersama Kami',	'berkarir-bersama-kami',	"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit volup accusantium. Lorem ipsum dolor sit amet, consectetur.",	1,	1,	'2015-06-27 07:29:16',	NULL),
(3,	'Pasang Iklan',	'pasang-iklan',	"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit volup accusantium. Lorem ipsum dolor sit amet, consectetur.",	2,	1,	'2015-06-30 04:53:15',	NULL),
(4,	'Ketentuan Penggunaan untuk Perusahaan',	'ketentuan-penggunaan-untuk-perusahaan',	"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit volup accusantium. Lorem ipsum dolor sit amet, consectetur.",	2,	1,	'2015-06-27 00:00:00',	NULL),
(5,	'Kebijakan Privasi untuk Pencari Kerja',	'kebijakan-privasi-untuk-pencari-kerja',	"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit volup accusantium. Lorem ipsum dolor sit amet, consectetur.",	3,	1,	'2015-06-27 00:00:00',	NULL);

-- [26/02/2017] alter table add slug in berita
ALTER TABLE `job_berita` ADD `slug` char(255) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `judul`;

-- add field category in job_perusahaan
ALTER TABLE `job_perusahaan` ADD `category` int(1) NOT NULL DEFAULT '1' COMMENT '1=umum;2=findkarir-partnership';

-- create table job_limit
CREATE TABLE `job_limit` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `job_perusahaan_id` bigint NOT NULL,
  `limit` int NOT NULL,
  `date` date NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1=active;2=inactive',
  `created_at` datetime NULL,
  `updated_at` datetime NULL
);

-- big integer
ALTER TABLE `job_lowongan`
CHANGE `id_lowongan` `id_lowongan` bigint NOT NULL AUTO_INCREMENT FIRST,
CHANGE `id_perusahaan` `id_perusahaan` bigint NOT NULL AFTER `id_lowongan`;

ALTER TABLE `job_pelamar`
CHANGE `id_pelamar` `id_pelamar` bigint NOT NULL AUTO_INCREMENT FIRST;

ALTER TABLE `job_perusahaan`
CHANGE `id_perusahaan` `id_perusahaan` bigint NOT NULL AUTO_INCREMENT FIRST;

-- [27/02/2017] add column kode
ALTER TABLE `job_perusahaan`
ADD `kode` char(100) NOT NULL COMMENT 'kode ini bersifat unique' AFTER `id_perusahaan`;

-- [28/02/2017] add table pelamar_bidang
CREATE TABLE `pelamar_bidang` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_pelamar` bigint NOT NULL,
  `id_k_lowongan` bigint NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL
);

CREATE TABLE `lowongan_masalah` (
  `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `lowongan_id` bigint NOT NULL,
  `pesan` text NOT NULL,
  `created_at` datetime NOT NULL
);

ALTER TABLE `job_hit`
ADD `is_real` int NOT NULL;