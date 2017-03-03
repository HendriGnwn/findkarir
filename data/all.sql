-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `name` char(100) NOT NULL,
  `value` text NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('app_main_url',	'http://findkarir.com',	'Web Main Url',	NULL),
('app_name',	'FindKarir',	NULL,	NULL),
('app_name_url',	'FindKarir.com',	NULL,	NULL),
('app_pagetitle',	'FindKarir.com | Salah satu situs penyedia lowongan kerja di Indonesia',	NULL,	NULL),
('app_twitter_url',	'https://www.twitter.com/',	NULL,	NULL),
('developers_email',	'[\"hendrigunawan195@gmail.com\", \"winatasandi05@gmail.com\"]',	NULL,	NULL),
('main_metadesc',	'Temukan lowongan kerja dan masa depan karier yang lebih baik bersama FindKarir, salah satu situs penyedia informasi pekerjaan di Indonesia',	NULL,	NULL),
('main_metakey',	'findkarir in indonesia, Jakarta, Surabaya, Bandung, Medan, Palembang, Tangerang, indonesia jobs, indonesia, find karir,  IT jobs, HR jobs, finance jobs, sales jobs, marketing jobs, engineering jobs, customer service jobs, accounting jobs, management jobs, legal jobs, business development, career resource,  career, create resume, education career, employer, employment, employment opportunity, employment asia,  find job, free job posting, it recruitment, human resource, internet recruitment, jobstreet, job, job interview, job listing, job site, job vacancy, job opening, job placement, job opportunity, job seeker, karir tips,  job alert,  job online, job search, lowongan kerja, online job search, online recruitment,  post advertisement, recruitment, recruitment agency, findkarir, find karir',	NULL,	NULL),
('noreply_email',	'no-reply@findkarir.com',	NULL,	NULL);

DROP TABLE IF EXISTS `job_aktivasi`;
CREATE TABLE `job_aktivasi` (
  `id_aktivasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_lowongan` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_k_golongan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `harga` bigint(12) NOT NULL,
  `date_bill` date NOT NULL,
  `date_limit` date NOT NULL,
  `upload_bukti` char(100) DEFAULT NULL,
  `ket` char(255) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_aktivasi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_aktivasi` (`id_aktivasi`, `id_lowongan`, `id_perusahaan`, `id_k_golongan`, `id_user`, `harga`, `date_bill`, `date_limit`, `upload_bukti`, `ket`, `status`) VALUES
(40710001,	7403001,	7439004,	5,	64887001,	10000,	'2017-02-26',	'2017-03-05',	'7403001.png',	'sudah bayar',	1),
(40731002,	7403002,	7439004,	1,	64887001,	15000,	'2017-02-26',	'2017-03-05',	'7403002.png',	'sip',	1),
(40735003,	7403003,	7428003,	6,	64887001,	20000,	'2015-07-04',	'2015-07-18',	'40735003.JPG',	'Segera di aktifkan , saya mentransfer uang ke reke',	1),
(40737004,	7403004,	7428003,	8,	NULL,	40000,	'2015-07-04',	'2015-08-03',	'40737004.JPG',	'Segera aktifkan karena kami sudah mengirim uang vi',	1),
(40743005,	7403005,	7434002,	9,	NULL,	8000,	'2015-07-04',	'2015-07-11',	'40743005.JPG',	'Segera proses lebih lanjut dan kami tunggu tayangn',	1),
(40744006,	7403006,	7434002,	12,	NULL,	32000,	'2015-07-04',	'2015-08-03',	'40744006.JPG',	'OK',	1),
(40746007,	7403007,	7404001,	11,	64887001,	24000,	'2015-07-04',	'2015-07-25',	'40746007.JPG',	'ok',	1),
(40748008,	7403008,	7404001,	4,	64887001,	45000,	'2015-07-04',	'2015-08-18',	'40748008.JPG',	'Saya sudah bayar transfer ke rekening bank BRI',	1),
(40752009,	7403009,	7458005,	4,	64887001,	45000,	'2015-07-04',	'2015-08-03',	'40752009.JPG',	'ok',	1),
(40752010,	7403010,	7458005,	3,	64887001,	35000,	'2015-07-04',	'2015-07-25',	'40752010.JPG',	'Lunas OK',	1),
(40756011,	7403011,	7454006,	4,	NULL,	45000,	'2015-07-04',	'2015-08-03',	'40756011.JPG',	'saya sudah transfer uangnya ke rekening DANAMON',	1),
(40758012,	7403012,	7454006,	3,	NULL,	35000,	'2015-07-04',	'2015-07-25',	'40758012.JPG',	'ok',	1),
(40759013,	7403013,	7454006,	7,	64887001,	30000,	'2015-07-04',	'2015-08-11',	'40759013.png',	'(Transfer ke BANK BRI) Saya sudah transfer melalui',	1),
(40700014,	7404014,	7454006,	7,	64887001,	30000,	'2015-07-04',	'2015-07-25',	'40700014.JPG',	'ok\r\n',	1),
(40714015,	7408015,	7454006,	12,	NULL,	32000,	'2015-07-04',	'2015-08-03',	NULL,	NULL,	0),
(270235016,	22710016,	22718008,	2,	64887001,	25000,	'2017-02-27',	'2017-03-13',	'270235016.jpg',	'sudat',	1),
(280242017,	22810017,	22718007,	4,	NULL,	0,	'2017-02-28',	'2017-03-30',	NULL,	'member perusahaan',	1),
(280249018,	22810018,	22718007,	4,	NULL,	0,	'2017-02-28',	'2017-03-20',	NULL,	'member perusahaan',	1);

DROP TABLE IF EXISTS `job_bantuan`;
CREATE TABLE `job_bantuan` (
  `id_bantuan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(50) NOT NULL,
  `subjek` char(255) NOT NULL,
  `email` char(50) NOT NULL,
  `pesan` text NOT NULL,
  `tgl` datetime NOT NULL,
  `sts` int(1) NOT NULL,
  PRIMARY KEY (`id_bantuan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_bantuan` (`id_bantuan`, `nama`, `subjek`, `email`, `pesan`, `tgl`, `sts`) VALUES
(6,	'Aldiansyah',	'[ASK] Tes',	'winatasandi05@gmail.com',	'tes email doang',	'2015-07-01 04:47:54',	1),
(7,	'Hendri Gunawan',	'[ASK] Tanya Tes Psikotes',	'hendrigunawan195@gmail.com',	'bla bla bla bla bla bla bla bla bla bla bla bla bla',	'2015-07-26 07:31:46',	0),
(2,	'Sandi Winata',	'Sed ut perspiciatis',	'sandiwinata@gmail.com',	'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore\r\nveritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.',	'2015-06-27 06:00:00',	0),
(5,	'Wina Marlina',	'[JWB] EMAIL MASUK',	'winamarlina97@gmail.com',	'<b>TEST EMAIL MASUK</b>',	'2015-07-01 04:52:13',	1),
(3,	'Menjajal Tes',	'[ASK] Pemasangan Iklan Lowongan Kerja',	'hendrigunawan195@gmail.com',	'Saya Menjajal Tes dari PT. Bersuka Cita ingin bertanya soal pemasangan iklan lowongan kerja di situs ini bagaimana caranya? Bales secepatnya saya tunggu email masuk dari Anda, Terima Kasih.',	'2015-07-04 11:43:41',	1),
(4,	'Hendri Gunawan',	'[ASK] Informasi Pemasangan Iklan Lowongan Kerja',	'hendrigunawan195@gmail.com',	'Saya Panitia Perekrutan Pegawai Baru di PT. Bina Karya (Persero) ingin menanyakan tentang informasi pemasangan iklan lowongan kerja di website ini, oleh karena itu saya mohon kerjasamanya untuk diberitahukan langkah demi langkah agar dapat posting lowongan kerja di website ini. Saya tunggu balesannya Terima Kasih.<br><br><b>//Jawab</b><br><br><b>Anda bisa baca di ketentuan perusahaan, klik Ketentuan Perusahaan di bagian kolom Perusahaan di footer (paling bwah halaman)</b><br>',	'2015-06-30 01:25:25',	1);

DROP TABLE IF EXISTS `job_berita`;
CREATE TABLE `job_berita` (
  `id_berita` int(11) NOT NULL AUTO_INCREMENT,
  `judul` char(255) NOT NULL,
  `slug` char(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl` datetime NOT NULL,
  `foto` char(100) DEFAULT NULL,
  `aktif` int(1) NOT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_berita` (`id_berita`, `judul`, `slug`, `deskripsi`, `tgl`, `foto`, `aktif`) VALUES
(6001,	'Youtube PDF CodeIgniter 1',	'youtube-pdf-codeigniter-1',	'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.',	'2017-02-27 10:21:32',	'6001.png',	1),
(29002,	'Berita Tidak Ada Gambar',	'berita-tidak-ada-gambar',	'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.',	'2015-07-04 02:41:43',	NULL,	1);

DROP TABLE IF EXISTS `job_captcha`;
CREATE TABLE `job_captcha` (
  `id_captcha` int(11) NOT NULL AUTO_INCREMENT,
  `captcha` varchar(15) NOT NULL,
  `hcaptcha` varchar(10) NOT NULL,
  PRIMARY KEY (`id_captcha`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_captcha` (`id_captcha`, `captcha`, `hcaptcha`) VALUES
(1,	'5 + 4 + 7',	'16'),
(2,	'15 + 10 + 8',	'33'),
(3,	'17 + 4 + 5',	'26'),
(4,	'8 + 8 + 4',	'20'),
(5,	'7 x 8',	'56'),
(6,	'5 x 8',	'40'),
(7,	'5 + 4 + 10',	'19'),
(8,	'5 + 5 + 10',	'20'),
(9,	'5 + 6 + 5',	'16'),
(10,	'10 + 5 + 9',	'24');

DROP TABLE IF EXISTS `job_golongan`;
CREATE TABLE `job_golongan` (
  `id_golongan` int(11) NOT NULL AUTO_INCREMENT,
  `nm_golongan` char(30) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `kode` char(30) NOT NULL,
  PRIMARY KEY (`id_golongan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_golongan` (`id_golongan`, `nm_golongan`, `rating`, `kode`) VALUES
(1,	'PLATINUM',	'Iklan Lowongan akan tampil paling depan dan paling atas dibandingkan dengan GOLD atau SILVER',	'btn-success'),
(2,	'GOLD',	'Iklan Lowongan akan tampil normal dan seimbang di tengah diantara PLATINUM dengan SILVER',	'btn-warning'),
(3,	'SILVER',	'Iklan lowongan akan tampil di bawah PLATINUM dan GOLD',	'bg-gray');

DROP TABLE IF EXISTS `job_hit`;
CREATE TABLE `job_hit` (
  `id_hit` int(11) NOT NULL AUTO_INCREMENT,
  `jml_hit` char(20) NOT NULL,
  `jml_hari_ini` char(20) NOT NULL,
  `tgl` date NOT NULL,
  `is_real` int(11) NOT NULL,
  PRIMARY KEY (`id_hit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_hit` (`id_hit`, `jml_hit`, `jml_hari_ini`, `tgl`, `is_real`) VALUES
(1,	'3066',	'2',	'2017-03-02',	0),
(2,	'3',	'3',	'2017-02-27',	1),
(3,	'4',	'4',	'2017-02-28',	1),
(4,	'8',	'8',	'2017-03-01',	1),
(5,	'2',	'2',	'2017-03-02',	1);

DROP TABLE IF EXISTS `job_kontak`;
CREATE TABLE `job_kontak` (
  `id_kontak` int(11) NOT NULL AUTO_INCREMENT,
  `alamat` char(255) NOT NULL,
  `latitude` char(30) NOT NULL,
  `longitude` char(30) NOT NULL,
  `no_telp` char(20) NOT NULL,
  `email` char(50) NOT NULL,
  `web_url` char(50) NOT NULL,
  `facebook` char(50) NOT NULL,
  `twitter` char(50) NOT NULL,
  `google` char(50) NOT NULL,
  `dribble` char(50) NOT NULL,
  `linkedin` char(50) NOT NULL,
  `skype` char(50) NOT NULL,
  PRIMARY KEY (`id_kontak`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_kontak` (`id_kontak`, `alamat`, `latitude`, `longitude`, `no_telp`, `email`, `web_url`, `facebook`, `twitter`, `google`, `dribble`, `linkedin`, `skype`) VALUES
(1,	'Bogor - Jawa Barat',	'-6.5459917',	'106.6778467',	'+62 856 1471 500',	'info@jeloker.com',	'www.jeLoker.com',	'www.facebook.com/jeLoker',	'www.twitter.com/jeLoker_id',	'www.plus.google.com/jeLoker',	'www.dribble.com/jeLoker',	'www.linkedin.com/jeLoker',	'www.skype.com/jeLoker');

DROP TABLE IF EXISTS `job_k_golongan`;
CREATE TABLE `job_k_golongan` (
  `id_k_golongan` int(11) NOT NULL AUTO_INCREMENT,
  `id_golongan` int(11) NOT NULL,
  `limit_waktu` int(11) NOT NULL,
  `harga` bigint(12) NOT NULL,
  `deskripsi` char(255) NOT NULL,
  PRIMARY KEY (`id_k_golongan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_k_golongan` (`id_k_golongan`, `id_golongan`, `limit_waktu`, `harga`, `deskripsi`) VALUES
(1,	1,	7,	15000,	'Kategori Golongan Platinum'),
(2,	1,	14,	25000,	'Kategori Golongan Platinum'),
(3,	1,	21,	35000,	'Kategori Golongan Platinum'),
(4,	1,	30,	45000,	'Kategori Golongan Platinum'),
(5,	2,	7,	10000,	'Kategori Golongan Gold'),
(6,	2,	14,	20000,	'Kategori Golongan Gold'),
(7,	2,	21,	30000,	'Kategori Golongan Gold'),
(8,	2,	30,	40000,	'Kategori Golongan Gold'),
(9,	3,	7,	8000,	'Kategori Golongan Silver'),
(10,	3,	14,	16000,	'Kategori Golongan Silver'),
(11,	3,	21,	24000,	'Kategori Golongan Silver'),
(12,	3,	30,	32000,	'Kategori Golongan Silver');

DROP TABLE IF EXISTS `job_k_lowongan`;
CREATE TABLE `job_k_lowongan` (
  `id_k_low` int(11) NOT NULL AUTO_INCREMENT,
  `nm_k_lowongan` char(50) NOT NULL,
  PRIMARY KEY (`id_k_low`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_k_lowongan` (`id_k_low`, `nm_k_lowongan`) VALUES
(1,	'ADMINISTRASI'),
(2,	'AKUNTANSI'),
(3,	'SEKRETARIS'),
(4,	'DRIVER'),
(5,	'OFFICE BOY'),
(8,	'PROGRAMMER'),
(9,	'SATPAM');

DROP TABLE IF EXISTS `job_k_tentang`;
CREATE TABLE `job_k_tentang` (
  `id_k_tentang` int(11) NOT NULL AUTO_INCREMENT,
  `nm_k_tentang` char(30) NOT NULL,
  PRIMARY KEY (`id_k_tentang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_k_tentang` (`id_k_tentang`, `nm_k_tentang`) VALUES
(1,	'jeLoker.com'),
(2,	'Perusahaan'),
(3,	'Pelamar');

DROP TABLE IF EXISTS `job_lamar`;
CREATE TABLE `job_lamar` (
  `id_lamar` int(11) NOT NULL AUTO_INCREMENT,
  `id_lowongan` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_pelamar` int(11) NOT NULL,
  `cv` char(100) NOT NULL,
  `sts_lamar` int(1) NOT NULL,
  `tgl_create` datetime NOT NULL,
  `tgl_datang` date DEFAULT NULL,
  `jam_datang` time DEFAULT NULL,
  `almt_datang` char(255) DEFAULT NULL,
  `ket` text NOT NULL,
  PRIMARY KEY (`id_lamar`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_lamar` (`id_lamar`, `id_lowongan`, `id_perusahaan`, `id_pelamar`, `cv`, `sts_lamar`, `tgl_create`, `tgl_datang`, `jam_datang`, `almt_datang`, `ket`) VALUES
(70438001,	7403001,	7439004,	74001,	'70438001.pdf',	1,	'2015-07-04 03:24:38',	'2015-07-05',	'10:00:00',	'Alamat Kantor kami',	'Saya ingin melamar di perusahaan yang bapak/ibu pimpin ...'),
(22639003,	7403001,	7439004,	0,	'22639003.docx',	0,	'2017-02-26 09:59:39',	NULL,	NULL,	NULL,	'Test');

DROP TABLE IF EXISTS `job_limit`;
CREATE TABLE `job_limit` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `job_perusahaan_id` bigint(20) NOT NULL,
  `limit` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=active;2=inactive',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `job_limit` (`id`, `job_perusahaan_id`, `limit`, `date_start`, `date_end`, `status`, `created_at`, `updated_at`) VALUES
(1,	22718007,	0,	'0000-00-00',	'2017-03-30',	0,	'2017-03-01 21:24:39',	NULL),
(2,	22718007,	12,	'2017-02-10',	'2017-03-30',	1,	'2017-03-01 22:34:45',	NULL);

DROP TABLE IF EXISTS `job_lowongan`;
CREATE TABLE `job_lowongan` (
  `id_lowongan` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_perusahaan` bigint(20) NOT NULL,
  `id_k_low` int(11) NOT NULL,
  `nm_lowongan` char(255) NOT NULL,
  `kualifikasi` text NOT NULL,
  `benefit` text NOT NULL,
  `gaji` char(30) NOT NULL,
  `kota` char(30) NOT NULL,
  `provinsi` char(30) NOT NULL,
  `date_post` date NOT NULL,
  `date_close` date NOT NULL,
  `aktif` int(1) NOT NULL,
  `id_golongan` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  PRIMARY KEY (`id_lowongan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_lowongan` (`id_lowongan`, `id_perusahaan`, `id_k_low`, `nm_lowongan`, `kualifikasi`, `benefit`, `gaji`, `kota`, `provinsi`, `date_post`, `date_close`, `aktif`, `id_golongan`, `id_type`) VALUES
(7403001,	7439004,	1,	'Staf Administrasi di PT. Perusahaan Keempat',	'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.\r\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.',	'Pelayanan Jasa&nbsp;',	'Rp. 2.000.000 - Rp. 3.000.000',	'Bogor',	'Jawa Barat',	'2017-02-18',	'2017-03-20',	1,	2,	1),
(7403002,	7439004,	2,	'Akuntansi PT. Perusahaan Ke Empat',	'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.',	'Consultant Proyek<br>',	'Rp. 2.000.000 - Rp. 3.000.000',	'Bogor',	'Jawa Barat',	'2015-07-04',	'2015-08-04',	1,	1,	1),
(7403003,	7428003,	5,	'OB di Perusahaan Kami',	'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.',	'Consultant IT',	'Rp. 1.000.000 - Rp. 2.000.000',	'Bogor',	'Jawa Barat',	'2015-07-04',	'2015-07-20',	2,	2,	2),
(7403004,	7428003,	8,	'Programmer PT. Perusahaan Ketiga',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim \r\nveniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea \r\ncommodo consequat. Duis aute irure dolor in reprehenderit in voluptate \r\nvelit esse cillum dolore eu fugiat nulla pariatur.&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim \r\nveniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea \r\ncommodo consequat. Duis aute irure dolor in reprehenderit in voluptate \r\nvelit esse cillum dolore eu fugiat nulla pariatur.',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim \r\nveniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea \r\ncommodo consequat. Duis aute irure dolor in reprehenderit in voluptate \r\nvelit esse cillum dolore eu fugiat nulla pariatur.',	'Rp. 4.000.000 - Rp. 5.000.000',	'Jakarta Timur',	'D.K.I Jakarta',	'2015-07-04',	'2015-08-04',	2,	2,	1),
(7403005,	7434002,	9,	'Satpam Perusahaan ini',	'But I must explain to you how all this mistaken idea of denouncing \r\npleasure and praising pain was born and I will give you a complete \r\naccount of the system, and expound the actual teachings of the great \r\nexplorer of the truth, the master-builder of human happiness. No one \r\nrejects, dislikes, or avoids pleasure itself, because it is pleasure, \r\nbut because those who do not know how to pursue pleasure rational \r\nencounter consequences that are extremely painful. Nor again is there \r\nanyone who loves or pursues or desires to obtain pain of itself, because\r\n it is pain, but because occasionally circumstances occur in which toil \r\nand pain can procure.',	'Ini benefitnya',	'Rp. 2.000.000 - Rp. 3.000.000',	'Jakarta',	'D.K.I Jakarta',	'2015-07-04',	'2015-07-11',	2,	3,	2),
(7403006,	7434002,	3,	'Sekretaris Direktur',	'But I must explain to you how all this mistaken idea of denouncing \r\npleasure and praising pain was born and I will give you a complete \r\naccount of the system, and expound the actual teachings of the great \r\nexplorer of the truth, the master-builder of human happiness. No one \r\nrejects, dislikes, or avoids pleasure itself, because it is pleasure, \r\nbut because those who do not know how to pursue pleasure rational \r\nencounter consequences that are extremely painful. Nor again is there \r\nanyone who loves or pursues or desires to obtain pain of itself, because\r\n it is pain, but because occasionally circumstances occur in which toil \r\nand pain can procure.',	'Ini benefitnya OK',	'Rp. 4.000.000 - Rp. 5.000.000',	'Bogor',	'Jawa Barat',	'2015-07-04',	'2015-08-04',	2,	3,	1),
(7403007,	7404001,	3,	'Sekretaris Komisaris PT. Perusahaan Pertama',	'But I must explain to you how all this mistaken idea of denouncing \r\npleasure and praising pain was born and I will give you a complete \r\naccount of the system, and expound the actual teachings of the great \r\nexplorer of the truth, the master-builder of human happiness. No one \r\nrejects, dislikes, or avoids pleasure itself, because it is pleasure, \r\nbut because those who do not know how to pursue pleasure rational \r\nencounter consequences that are extremely painful. Nor again is there \r\nanyone who loves or pursues or desires to obtain pain of itself, because\r\n it is pain, but because occasionally circumstances occur in which toil \r\nand pain can procure.<br>',	'ok ini benefitnya<br>',	'Rp. 5.000.000 - Rp. 6.000.000',	'Jakarta Timur',	'D.K.I Jakarta',	'2015-07-04',	'2015-07-30',	2,	3,	1),
(7403008,	7404001,	8,	'Programmer Perusahaan Pertama',	'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.',	'Benefitnya ini yaaaaaaa',	'Rp. 6.000.000 - Rp. 7.000.000',	'Jakarta',	'D.K.I Jakarta',	'2015-07-04',	'2015-08-04',	2,	1,	1),
(7403009,	7458005,	1,	'Administrasi di Perusahaan Kelima',	'Lorem Ipsum dolor Maaf tadi ada error, sudah saya perbaiki, dan sekarang sudah normal , tadi belum di refresh...<br>sekarang bisa kan hehehe..<br>cerita nya sudah di transfer<br>tekan enter akan mensave<br>selanjutnya status akan proses, dan itu waktunya admin yang bekerja .. kita ke adamin<br>iklan sudah bisa tayang...<br>agar lebih mudah untuk di hapal, password bisa di ganti<br><br>',	'ini benefitnya yaaaaa<br>',	'Rp. 4.000.000 - Rp. 5.000.000',	'Jakarta',	'D.K.I Jakarta',	'2015-07-04',	'2015-08-04',	2,	1,	1),
(7403010,	7458005,	4,	'Supir Kelima Perusahaan',	'Maaf tadi ada error, sudah saya perbaiki, dan sekarang sudah normal , tadi belum di refresh...<br>sekarang bisa kan hehehe..<br>cerita nya sudah di transfer<br>tekan enter akan mensave<br>selanjutnya status akan proses, dan itu waktunya admin yang bekerja .. kita ke adamin<br>iklan sudah bisa tayang...<br>agar lebih mudah untuk di hapal, password bisa di ganti<br>',	'Maaf tadi ada error, sudah saya perbaiki, dan sekarang sudah normal , tadi belum di refresh...<br>sekarang bisa kan hehehe..<br>cerita nya sudah di transfer<br>tekan enter akan mensave<br>selanjutnya status akan proses, dan itu waktunya admin yang bekerja .. kita ke adamin<br>iklan sudah bisa tayang...<br>agar lebih mudah untuk di hapal, password bisa di ganti<br>',	'Rp. 2.000.000 - Rp. 3.000.000',	'Jakarta',	'D.K.I Jakarta',	'2015-07-04',	'2015-07-25',	2,	1,	1),
(7403011,	7454006,	8,	'Dibutuhkan Banyak Programmer',	'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.',	'Benefitnya ini dia',	'Rp. 4.000.000 - Rp. 5.000.000',	'Jakarta Timur',	'D.K.I Jakarta',	'2015-07-04',	'2015-08-04',	2,	1,	1),
(7403012,	7454006,	1,	'Satu Staff Admin',	'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.',	'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.',	'Rp. 3.000.000 - Rp. 4.000.000',	'Bekasi',	'Jawa Barat',	'2015-07-04',	'2015-07-30',	2,	1,	1),
(7408015,	7454006,	3,	'Dibutuhkan Sekretaris Perusahaan',	'Sed ut perspiciatis unde omnis iste natus error sit voluptatem \r\naccusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab\r\n illo inventore veritatis et quasi architecto beatae vitae dicta sunt \r\nexplicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut \r\nodit aut fugit, sed quia consequuntur magni dolores eos qui ratione \r\nvoluptatem sequi nesciunt.',	'Sed ut perspiciatis unde omnis iste natus error sit voluptatem \r\naccusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab\r\n illo inventore veritatis et quasi architecto beatae vitae dicta sunt \r\nexplicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut \r\nodit aut fugit, sed quia consequuntur magni dolores eos qui ratione \r\nvoluptatem sequi nesciunt.',	'Rp. 4.000.000 - Rp. 5.000.000',	'Jakarta',	'Banten',	'2015-07-04',	'2015-08-04',	2,	3,	1),
(7403013,	7454006,	5,	'OB di Perusahaan Keenam',	'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.',	'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.',	'Rp. 2.000.000 - Rp. 3.000.000',	'Bekasi',	'Jawa Barat',	'2015-07-04',	'2015-08-01',	2,	2,	1),
(7404014,	7454006,	3,	'Direktur butuh Sekteraris',	'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.',	'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.',	'Rp. 2.000.000 - Rp. 3.000.000',	'Bekasi',	'Jawa Barat',	'2015-07-04',	'2015-07-30',	2,	2,	1),
(22710016,	22718008,	4,	'Driver',	'tasygdua sdasd<br>',	'us ahfisa fasodfsdf<br>',	'Rp. 2.000.000 - Rp. 3.000.000',	'Bogor',	'Jawa Barat',	'2017-02-27',	'2017-03-27',	1,	1,	1),
(22810017,	22718007,	1,	'Staff Administrasi di PT Seni Teknologi Indonesia',	'Sed ut perspiciatis unde omnis iste natus error sit voluptatem \r\naccusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab\r\n illo inventore veritatis et quasi architecto beatae vitae dicta sunt \r\nexplicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut \r\nodit aut fugit, sed quia consequuntur magni dolores eos qui ratione \r\nvoluptatem sequi nesciunt. Sed ut perspiciatis unde omnis iste natus \r\nerror sit voluptatem accusantium doloremque laudantium, totam rem \r\naperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto\r\n beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia \r\nvoluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni \r\ndolores eos qui ratione voluptatem sequi nesciunt. Sed ut perspiciatis \r\nunde omnis iste natus error sit voluptatem accusantium doloremque \r\nlaudantium, totam rem aperiam, eaque ipsa quae ab illo inventore \r\nveritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo \r\nenim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, \r\nsed quia consequuntur magni dolores eos qui ratione voluptatem sequi \r\nnesciunt.<br>',	'Sed ut perspiciatis unde omnis iste natus error sit voluptatem \r\naccusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab\r\n illo inventore veritatis et quasi architecto beatae vitae dicta sunt \r\nexplicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut \r\nodit aut fugit, sed quia consequuntur magni dolores eos qui ratione \r\nvoluptatem sequi nesciunt. Sed ut perspiciatis unde omnis iste natus \r\nerror sit voluptatem accusantium doloremque laudantium, totam rem \r\naperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto\r\n beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia \r\nvoluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni \r\ndolores eos qui ratione voluptatem sequi nesciunt. Sed ut perspiciatis \r\nunde omnis iste natus error sit voluptatem accusantium doloremque \r\nlaudantium, totam rem aperiam, eaque ipsa quae ab illo inventore \r\nveritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo \r\nenim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, \r\nsed quia consequuntur magni dolores eos qui ratione voluptatem sequi \r\nnesciunt.<br>',	'Rp. 2.000.000 - Rp. 3.000.000',	'Ciampea - Bogor',	'Jawa Barat',	'2017-02-28',	'2017-03-30',	1,	1,	1),
(22810018,	22718007,	5,	'Office Boy',	'Sed ut perspiciatis unde omnis iste natus error sit voluptatem \r\naccusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab\r\n illo inventore veritatis et quasi architecto beatae vitae dicta sunt \r\nexplicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut \r\nodit aut fugit, sed quia consequuntur magni dolores eos qui ratione \r\nvoluptatem sequi nesciunt. Sed ut perspiciatis unde omnis iste natus \r\nerror sit voluptatem accusantium doloremque laudantium, totam rem \r\naperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto\r\n beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia \r\nvoluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni \r\ndolores eos qui ratione voluptatem sequi nesciunt. Sed ut perspiciatis \r\nunde omnis iste natus error sit voluptatem accusantium doloremque \r\nlaudantium, totam rem aperiam, eaque ipsa quae ab illo inventore \r\nveritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo \r\nenim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, \r\nsed quia consequuntur magni dolores eos qui ratione voluptatem sequi \r\nnesciunt.<br>',	'Sed ut perspiciatis unde omnis iste natus error sit voluptatem \r\naccusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab\r\n illo inventore veritatis et quasi architecto beatae vitae dicta sunt \r\nexplicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut \r\nodit aut fugit, sed quia consequuntur magni dolores eos qui ratione \r\nvoluptatem sequi nesciunt. Sed ut perspiciatis unde omnis iste natus \r\nerror sit voluptatem accusantium doloremque laudantium, totam rem \r\naperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto\r\n beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia \r\nvoluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni \r\ndolores eos qui ratione voluptatem sequi nesciunt. Sed ut perspiciatis \r\nunde omnis iste natus error sit voluptatem accusantium doloremque \r\nlaudantium, totam rem aperiam, eaque ipsa quae ab illo inventore \r\nveritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo \r\nenim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, \r\nsed quia consequuntur magni dolores eos qui ratione voluptatem sequi \r\nnesciunt.<br>',	'Rp. 2.000.000 - Rp. 3.000.000',	'Ciampea - Bogor',	'D.K.I Jakarta',	'2017-02-28',	'2017-03-20',	1,	1,	1);

DROP TABLE IF EXISTS `job_pelamar`;
CREATE TABLE `job_pelamar` (
  `id_pelamar` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama` char(50) NOT NULL,
  `no_ktp` char(50) DEFAULT NULL,
  `tmp_lhr` char(30) DEFAULT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `jk` char(15) DEFAULT NULL,
  `agama` char(15) DEFAULT NULL,
  `alamat` char(255) DEFAULT NULL,
  `kota` char(30) DEFAULT NULL,
  `kodepos` char(15) DEFAULT NULL,
  `email` char(50) NOT NULL,
  `no_telp` char(12) DEFAULT NULL,
  `sts_kawin` char(15) DEFAULT NULL,
  `pendidikan` char(20) DEFAULT NULL,
  `deskripsi` text,
  `foto` char(255) DEFAULT NULL,
  `tgl_create` datetime NOT NULL,
  `password` char(100) NOT NULL,
  `pass_view` char(40) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `sts_login` int(1) NOT NULL,
  PRIMARY KEY (`id_pelamar`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_pelamar` (`id_pelamar`, `nama`, `no_ktp`, `tmp_lhr`, `tgl_lhr`, `jk`, `agama`, `alamat`, `kota`, `kodepos`, `email`, `no_telp`, `sts_kawin`, `pendidikan`, `deskripsi`, `foto`, `tgl_create`, `password`, `pass_view`, `last_login`, `sts_login`) VALUES
(74001,	'HENDRI GUNAWAN',	'23890127986192',	'Jakarta',	'1997-06-15',	'Laki-laki',	'Islam',	'Jl. Lapangan Tembak 300 Kp. Padatimondok Rt. 02/09 No. 33 Ciaruteun Ilir Cibungbulang Bogor',	'Bogor',	'16630',	'hendrigunawan195@gmail.com',	'08561471500',	'',	'SMA/SMK Sederajat',	'Saya lulusan SMK Adi Sanggoro jurusan Teknik Informatika keahlian Rekayasa Perangkat Lunak. Keahlian saya adalah di bidang Web Designer dan Developer, programming yang saya kuasai adalah php, html, css, javascript, ajax, vb.net, java, dan framework CodeIgniter',	'74001.PNG',	'2015-07-04 02:59:14',	'dbc730eb6904c02437def2cbe6e7a389',	'hendri195',	'2017-03-01 11:31:17',	0),
(74002,	'SANDI WINATA',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'winatasandi05@gmail.com',	NULL,	NULL,	NULL,	NULL,	NULL,	'2015-07-04 03:03:03',	'159a87d4a1044eaa7ca98eaf64b4260c',	'sandiwinata',	'0000-00-00 00:00:00',	0);

DROP TABLE IF EXISTS `job_perusahaan`;
CREATE TABLE `job_perusahaan` (
  `id_perusahaan` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode` char(100) NOT NULL COMMENT 'kode ini bersifat unique',
  `nm_perusahaan` char(50) NOT NULL,
  `logo` char(100) DEFAULT NULL,
  `alamat` char(255) NOT NULL,
  `almt_web` char(50) DEFAULT NULL,
  `no_izin` char(30) DEFAULT NULL,
  `tentang` text,
  `no_telp` char(12) NOT NULL,
  `no_fax` char(12) DEFAULT NULL,
  `email` char(50) NOT NULL,
  `aktif` int(1) NOT NULL,
  `tgl_create` datetime NOT NULL,
  `password` char(255) NOT NULL,
  `pass_view` char(40) NOT NULL,
  `last_login` datetime NOT NULL,
  `sts_login` int(1) NOT NULL,
  `category` int(1) NOT NULL DEFAULT '1' COMMENT '1=umum;2=findkarir-partnership',
  PRIMARY KEY (`id_perusahaan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_perusahaan` (`id_perusahaan`, `kode`, `nm_perusahaan`, `logo`, `alamat`, `almt_web`, `no_izin`, `tentang`, `no_telp`, `no_fax`, `email`, `aktif`, `tgl_create`, `password`, `pass_view`, `last_login`, `sts_login`, `category`) VALUES
(7404001,	'1-20170227000001',	'PT. PERUSAHAAN PERTAMA',	'7404001.PNG',	'Jl. Raya Bogor Km. 16 Kab. Bogor',	'www.perusahaan-pertama.co.id',	'1234-5678-9101-1213',	'Perusahaan Pertama bergerak di bidang IT Consultant dan membuka cabang area Bogor<br>',	'08561471500',	'08561471500',	'hendrigunawan195@gmail.com',	1,	'2015-07-04 02:48:04',	'6d3eccd4ee7f2727fad8823d678edc5e',	'perusahaan-pertama',	'2015-07-04 08:25:45',	0,	1),
(7434002,	'1-20170227000002',	'PT. PERUSAHAAN KEDUA',	'7434002.png',	'Jl. Raya Bogor Km. 12',	'www.perusahaan-kedua.co.id',	'781-2891-23801-12391',	'Perusahaan kedua bergerak di bidang jasa konsultansi pembangunan,&nbsp;',	'08561471500',	'08561471500',	'winamarlina97@gmail.com',	1,	'2015-07-04 02:49:45',	'6f88c7361ef6e674fdf3351d70aadcea',	'QpCknv1O',	'2015-07-04 03:41:56',	0,	1),
(7428003,	'1-20170227000003',	'PT. PERUSAHAAN KETIGA',	'7428003.png',	'Jl. H. M. Hatta Km. 13 No. 15 Jakarta Pusat',	'www.perusahaan-ketiga.co.id',	'781-2891-23801-12391',	'Tentang Perusahaan kami isi dengan penuh kebohongan, karena perusahaan kami fiktif adanya&nbsp;',	'08561471500',	'08561471500',	'hendrigunawan195@outlook.com',	1,	'2015-07-04 02:51:39',	'12803a19a64aa5581aa7a073a28203bb',	'dkDUm51S',	'2015-07-04 03:33:17',	0,	1),
(7439004,	'1-20170227000004',	'PT. PERUSAHAAN KEEMPAT',	'7439004.png',	'Jl. Raya Cinangneng Km. 1 No. 15 Ciampea - Bogor',	'www.perusahaan-keempat.co.id',	'781-2891-23801-12391',	'Perusahaan ke Empat bergerak di bidang Pelayanan Jasa Office',	'08561471500',	'08561471500',	'hendrigunawan195@outlook.com',	1,	'2015-07-04 03:07:01',	'1863d94a9babbafbf8c5fd0203dd2072',	'perusahaan-keempat',	'2015-07-29 11:22:41',	0,	1),
(7458005,	'1-20170227000005',	'PT. PERUSAHAAN KELIMA',	'7458005.png',	'Jl. Blok M No. 14 Jakarta Selatan',	'www.perusahaan-kelima.co.id',	'821-D-123891',	'Tentang Kami ya ini lah kami , dengan segala kesederhanaan, gajebo ini tentang , ya ini kami gajebo<br>',	'08561471500',	'08561471500',	'hendrigunawan195@gmail.com',	1,	'2015-07-04 03:50:58',	'cfc0710d5bbeebdb7a3f4b2670bdc7b1',	'perusahaan-kelima',	'0000-00-00 00:00:00',	0,	1),
(7454006,	'1-20170227000006',	'PT. PERUSAHAAN KEENAM',	'7454006.png',	'Jl. Sudahlah No. 18918 Km. 12 Bekasi',	'www.perusahaan-keenam.co.id',	'2891-129831-12039',	'tentang kami males saya input datanya kebanyakan atuh ge<br>',	'08561471500',	'08561471500',	'hendrigunawan195@gmail.com',	1,	'2015-07-04 03:54:55',	'17d0699611359a06b61ef514f83b5d31',	'perusahaan-keenam',	'2015-07-21 10:07:15',	0,	1),
(22718007,	'217022700001',	'PT ART TECHNO CORPORATION',	'22718007.png',	'Jl Purnawarman No 11, Ciampea Bogor',	'http://www.atc.co.id',	'1290321739123',	'lorem ipsum dolor de Jl Purnawarman No 11, Ciampea Bogor lorem ipsum dolor de Jl Purnawarman No 11, Ciampea Bogor lorem ipsum dolor de Jl Purnawarman No 11, Ciampea Bogor lorem ipsum dolor de Jl Purnawarman No 11, Ciampea Bogor lorem ipsum dolor de Jl Purnawarman No 11, Ciampea Bogor <br><br><br><br><br><br>',	'08561471500',	'',	'hello@atc.co.id',	1,	'2017-02-27 09:39:18',	'0192023a7bbd73250516f069df18b500',	'admin123',	'2017-03-01 11:21:21',	0,	2),
(22718008,	'117022700001',	'PT SUMBER DAYA TEKNOLOGI',	'22702008.png',	'jalan antasari',	'http://www.atc.co.id',	'12398123',	'test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test <br>',	'08561471500',	'',	'hendrigunawan195@gmail.com',	1,	'2017-02-27 10:02:02',	'0192023a7bbd73250516f069df18b500',	'admin123',	'0000-00-00 00:00:00',	0,	1);

DROP TABLE IF EXISTS `job_rekening`;
CREATE TABLE `job_rekening` (
  `id_rekening` int(11) NOT NULL AUTO_INCREMENT,
  `nm_rek` char(30) NOT NULL,
  `kode_rek` char(30) NOT NULL,
  `nm_bank` char(30) DEFAULT NULL,
  `logo` char(100) NOT NULL,
  PRIMARY KEY (`id_rekening`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_rekening` (`id_rekening`, `nm_rek`, `kode_rek`, `nm_bank`, `logo`) VALUES
(1,	'HENDRI GUNAWAN',	'0105389753',	'DANAMON',	'1.png'),
(2,	'HENDRI GUNAWAN',	'0791-01-006386-53-8',	'BRI',	'2.png');

DROP TABLE IF EXISTS `job_tentang`;
CREATE TABLE `job_tentang` (
  `id_tentang` int(11) NOT NULL AUTO_INCREMENT,
  `judul` char(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_update` datetime NOT NULL,
  `kategori` char(30) NOT NULL,
  `id_k_tentang` int(11) NOT NULL,
  PRIMARY KEY (`id_tentang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_tentang` (`id_tentang`, `judul`, `deskripsi`, `tgl_update`, `kategori`, `id_k_tentang`) VALUES
(1,	'Mengenai jeLoker.com',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit volup accusantium. Lorem ipsum dolor sit amet, consectetur.',	'2015-06-29 11:17:59',	'Mengenai jeLoker.com',	1),
(2,	'Berkarir Bersama Kami',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit volup accusantium. Lorem ipsum dolor sit amet, consectetur.',	'2015-06-27 07:29:16',	'Berkarir Bersama Kami',	1),
(3,	'Pasang Iklan',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit volup accusantium. Lorem ipsum dolor sit amet, consectetur.',	'2015-06-30 04:53:15',	'Pasang Iklan Lowongan',	2),
(4,	'Ketentuan Penggunaan untuk Perusahaan',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit volup accusantium. Lorem ipsum dolor sit amet, consectetur.',	'2015-06-27 00:00:00',	'Ketentuan Penggunaan',	2),
(5,	'Kebijakan Privasi untuk Pencari Kerja',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit volup accusantium. Lorem ipsum dolor sit amet, consectetur.',	'2015-06-27 00:00:00',	'Kebijakan Privasi',	3);

DROP TABLE IF EXISTS `job_type`;
CREATE TABLE `job_type` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `nm_type` varchar(15) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_type` (`id_type`, `nm_type`) VALUES
(1,	'Full Time'),
(2,	'Part Time'),
(3,	'Freelance');

DROP TABLE IF EXISTS `job_user`;
CREATE TABLE `job_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(30) NOT NULL,
  `username` char(30) NOT NULL,
  `password` char(255) NOT NULL,
  `pass_view` char(30) NOT NULL,
  `foto` char(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `aktif` int(1) NOT NULL,
  `hak_akses` int(1) NOT NULL,
  `last_login` datetime NOT NULL,
  `tgl_create` date NOT NULL,
  `sts_login` int(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `job_user` (`id_user`, `nama`, `username`, `password`, `pass_view`, `foto`, `alamat`, `aktif`, `hak_akses`, `last_login`, `tgl_create`, `sts_login`) VALUES
(64887001,	'HENDRI GUNAWAN',	'admin',	'21232f297a57a5a743894a0e4a801fc3',	'admin',	'admin.PNG',	'Kp. Padatimondok Rt. 02/09 No. 33 Ciruteun Ilir Cibungbulang Bogor',	1,	1,	'2017-03-01 11:53:55',	'2015-06-22',	1),
(150624002,	'SANDI WINATA',	'sandiwinata',	'159a87d4a1044eaa7ca98eaf64b4260c',	'sandiwinata',	NULL,	'Kp. Wangun Jaya',	1,	1,	'2015-07-02 08:51:33',	'2015-06-24',	1);

DROP TABLE IF EXISTS `lowongan_masalah`;
CREATE TABLE `lowongan_masalah` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lowongan_id` bigint(20) NOT NULL,
  `pesan` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `lowongan_masalah` (`id`, `lowongan_id`, `pesan`, `created_at`) VALUES
(1,	22810018,	'Test',	'2017-02-28 23:21:44');

DROP TABLE IF EXISTS `page`;
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
(1,	'Mengenai jeLoker.com',	'mengenai-findkarir-com',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit volup accusantium. Lorem ipsum dolor sit amet, consectetur.',	1,	1,	'2015-06-29 11:17:59',	NULL),
(2,	'Berkarir Bersama Kami',	'berkarir-bersama-kami',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit volup accusantium. Lorem ipsum dolor sit amet, consectetur.',	1,	1,	'2015-06-27 07:29:16',	NULL),
(3,	'Pasang Iklan',	'pasang-iklan',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit volup accusantium. Lorem ipsum dolor sit amet, consectetur.',	2,	1,	'2015-06-30 04:53:15',	NULL),
(4,	'Ketentuan Penggunaan untuk Perusahaan',	'ketentuan-penggunaan-untuk-perusahaan',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit volup accusantium. Lorem ipsum dolor sit amet, consectetur.',	2,	1,	'2015-06-27 00:00:00',	NULL),
(5,	'Kebijakan Privasi untuk Pencari Kerja',	'kebijakan-privasi-untuk-pencari-kerja',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit volup accusantium. Lorem ipsum dolor sit amet, consectetur.',	3,	1,	'2015-06-27 00:00:00',	NULL);

DROP TABLE IF EXISTS `pelamar_bidang`;
CREATE TABLE `pelamar_bidang` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_pelamar` bigint(20) NOT NULL,
  `id_k_lowongan` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pelamar_bidang` (`id`, `id_pelamar`, `id_k_lowongan`, `status`, `created_at`) VALUES
(3,	74001,	5,	1,	'2017-03-01 23:49:54'),
(4,	74001,	4,	1,	'2017-03-01 23:53:13'),
(5,	74002,	4,	1,	'0000-00-00 00:00:00'),
(6,	74002,	8,	1,	'0000-00-00 00:00:00'),
(7,	74002,	5,	1,	'0000-00-00 00:00:00');

-- 2017-03-03 09:40:53
