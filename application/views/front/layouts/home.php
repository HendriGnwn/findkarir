<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">
<head>

    <!-- Basic -->
    <title><?php echo $this->Config_Model->get_app_name() ?> | <?php echo isset($page_title) ? $page_title : '' ?></title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Page Description and Author -->
    <meta name="description" content="<?php echo isset($meta_deskripsi) ? $meta_deskripsi : '' ?>">
    <meta name="author" content="Art Techno Corporation">

	<meta property="og:title" content="<?php echo isset($page_title) ? $page_title : '' ?> | <?php echo $this->Config_Model->get_app_name() ?>" /> 
	<meta property="og:type" content="website">
	<meta property="og:image" content="<?php echo base_url('assets/img/meta.jpg'); ?>" /> 
  	<meta property="og:image:type" content="image/jpg">
	<meta property="og:description" content="<?php echo isset($meta_deskripsi) ? $meta_deskripsi : '' ?>" /> 
	<meta property="og:url" content="<?php echo base_url(); ?>">

	<!-- for Twitter -->          
    <meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo isset($page_title) ? $page_title : '' ?> | <?php echo $this->Config_Model->get_app_name() ?>">
	<meta name="twitter:description" content="<?php echo isset($meta_deskripsi) ? $meta_deskripsi : '' ?>">
	<meta name="twitter:image:src" content="<?php echo base_url('assets/img/meta.jpg'); ?>"> 
	
	<!--for G+-->
	<meta itemprop="name" content="<?php echo isset($page_title) ? $page_title : '' ?> | <?php echo $this->Config_Model->get_app_name() ?>">
	<meta itemprop="description" content="<?php echo isset($meta_deskripsi) ? $meta_deskripsi : '' ?>">
	<meta itemprop="image" content="<?php echo base_url('assets/img/meta.jpg'); ?>">
	

    <link rel="shortcut icon" href="<?php echo base_url('assets/img/icon_front.PNG') ?>" />

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" type="text/css" media="screen">

    <!-- Font Awesome CSS -->
    <link href="<?php echo base_url(); ?>assets/font_awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- Margo CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style-hg.css'); ?>" media="screen">

    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.css');?>" media="screen">

    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/animate.css');?>" media="screen">

    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/colors/red.css');?>" title="red" media="screen" />
    
    <!-- Margo JS  -->
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery-2.1.1.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery.migrate.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/modernizrr.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery.fitvids.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/owl.carousel.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/nivo-lightbox.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery.isotope.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery.appear.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/count-to.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery.textillate.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery.lettering.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery.easypiechart.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery.nicescroll.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery.parallax.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/mediaelement-and-player.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/script.js');?>"></script>

    <!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

</head>

<body>

    <!-- Full Body Container -->
    <div id="container">
        
        
        <!-- Start Header Section --> 
        <div class="hidden-header"></div>
        <header class="clearfix">
            
            <!-- Start Top Bar -->
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <!-- Start Contact Info -->
                            <ul class="contact-details">
                                <li><a href="#"><i class="fa fa-map-marker"></i> <?php echo isset($alamat)? $alamat:''; ?></a>
                                </li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i> <?php echo isset($email)? $email:''; ?></a>
                                </li>
                                <li><a href="#"><i class="fa fa-phone"></i> <?php echo isset($no_telp)? $no_telp:''; ?></a>
                                </li>
                            </ul>
                            <!-- End Contact Info -->
                        </div><!-- .col-md-6 -->
                        <div class="col-md-5">
                            <!-- Start Social Links -->
                            <ul class="social-list">
                                <?php
                                    if(isset($facebook)? $facebook:''!=''){
                                ?>
                                <li>
                                    <a class="facebook itl-tooltip" data-placement="bottom" title="Facebook" target="_BLANK" href="http://<?php echo isset($facebook)? $facebook:''; ?>"><i class="fa fa-facebook"></i></a>
                                </li>
                                <?php
                                    }
                                    if(isset($twiter)? $twitter:''!=''){
                                ?>
                                <li>
                                    <a class="twitter itl-tooltip" data-placement="bottom" title="Twitter" target="_BLANK" href="http://<?php echo isset($twitter)? $twitter:''; ?>"><i class="fa fa-twitter"></i></a>
                                </li>
                                <?php
                                    }
                                    if(isset($google)? $google:''!=''){
                                ?>
                                <li>
                                    <a class="google itl-tooltip" data-placement="bottom" title="Google Plus" target="_BLANK" href="http://<?php echo isset($google)? $google:''; ?>"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <?php
                                    }
                                    if(isset($dribbble)? $dribbble:''!=''){
                                ?>
                                <li>
                                    <a class="dribbble itl-tooltip" data-placement="bottom" title="Dribble" target="_BLANK" href="http://<?php echo isset($dribbble)? $dribbble:''; ?>"><i class="fa fa-dribbble"></i></a>
                                </li>
                                <?php
                                    }
                                    if(isset($linkedin)? $linkedin:''!=''){
                                ?>
                                <li>
                                    <a class="linkdin itl-tooltip" data-placement="bottom" title="Linkedin" target="_BLANK" href="http://<?php echo isset($linkedin)? $linkedin:''; ?>"><i class="fa fa-linkedin"></i></a>
                                </li>
                                <?php
                                    }
                                    if(isset($skype)? $skype:''!=''){
                                ?>
                                <li>
                                    <a class="skype itl-tooltip" data-placement="bottom" title="Skype" target="_BLANK" href="http://<?php echo isset($skype)? $skype:''; ?>"><i class="fa fa-skype"></i></a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                            <!-- End Social Links -->
                        </div><!-- .col-md-6 -->
                    </div><!-- .row -->
                </div><!-- .container -->
            </div><!-- .top-bar -->
            <!-- End Top Bar -->
            
            
            <!-- Start  Logo & Naviagtion  -->
            <div class="navbar navbar-default navbar-top">
                <div class="container">
                    <div class="navbar-header">
                        <!-- Stat Toggle Nav Link For Mobiles -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                        <!-- End Toggle Nav Link For Mobiles -->
                        <a class="navbar-brand" href="<?php echo base_url(''); ?>">
                            <img alt="" src="<?php echo base_url('assets/img/logo.png') ?>">
                        </a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <!-- Stat Search -->
                        <!-- <div class="search-side">
                            <a href="#" class="show-search"><i class="fa fa-search"></i></a>
                            <div class="search-form">
                                <form autocomplete="off" role="search" method="get" class="searchform" action="#">
                                    <input type="text" value="" name="s" id="s" placeholder="Search the site...">
                                </form>
                            </div>
                        </div> -->
                        <!-- Start Navigation List -->
                        <ul class="nav navbar-nav navbar-right">

                            <?php
                                    if($this->session->userdata('id_login')=='' || $this->session->userdata('id_login')==null){
                                ?>
                                    <li><a href="<?php echo base_url('login/masuk'); ?>">Login</a>
                                    </li>
                                    <li><a href="<?php echo base_url('login/daftar'); ?>">Mendaftar</a></li>
                                    <li><a href="<?php echo base_url('perusahaan'); ?>">Perusahaan</a></li>
                                <?php
                                    }elseif($this->session->userdata('id_login')!='' || $this->session->userdata('id_login')!=null){
                                ?>
                                    <?php
                                        if($this->session->userdata('hak_akses')=='perusahaan'){
                                    ?>
                                        <li><a href="<?php echo base_url('company'); ?>"><i class="fa fa-laptop"></i>&nbsp; <?php echo $this->session->userdata('nama'); ?></a>
                                        </li>
                                        <li><a href="<?php echo base_url('lowongan'); ?>">Cari Lowongan</a></li>
                                    <?php
                                        }elseif($this->session->userdata('hak_akses')=='pelamar'){
                                    ?>
                                        <li><a href="<?php echo base_url('pelamar'); ?>"><i class="fa fa-user"></i>&nbsp; <?php echo $this->session->userdata('nama'); ?></a>
                                        </li>
                                        <li><a href="<?php echo base_url('lowongan'); ?>">Cari Lowongan</a></li>
                                    <?php 
                                        }
                                    ?>
                                <?php
                                    }
                                ?>
                        </ul>
                        <!-- End Navigation List -->
                    </div>
                </div>
            </div>
            <!-- End Header Logo & Naviagtion -->
            
        </header> 
        <!-- End Header Section -->
        
        
        
        <!-- Start Home Page Slider -->
        <section id="home">
            <!-- Carousel -->
            <div id="main-slide" class="carousel slide" data-ride="carousel">

                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#main-slide" data-slide-to="0" class="active"></li>
                    <li data-target="#main-slide" data-slide-to="1"></li>
                    <!-- <li data-target="#main-slide" data-slide-to="2"></li> -->
                </ol>
                <!--/ Indicators end-->

                <!-- Carousel inner -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img class="img-responsive" src="<?php echo base_url('assets/img/slider/bg2.jpg') ?>" alt="slider">
                        <div class="slider-content">
                            <div class="col-md-12 text-center">
                                <h2 class="animated2">
                                <span class="label label-danger" style="font-size: 20pt; border-radius: 0; color: #fff !important;text-transform: none;" ><?php echo number_format($statistik['lowongan'],0,'.',','); ?> Lowongan Kerja di Indonesia</span>
                        		  <span class="label label-danger" style="font-size: 20pt; border-radius: 0; color: #fff !important;text-transform: none;" ><?php echo number_format($statistik['jml_hit'],0,'.',','); ?> Pengunjung Situs</span><br>
                                  <span style="font-size: 12pt; color: #fff;text-transform: none;">Gudangnya Informasi Lowongan Kerja</span>
                                </h2>
                                <h3 class="animated3" style="margin-top: 10px;">
                                    <a href="<?php echo base_url('login/daftar'); ?>" class="btn-system btn-large btn-wite"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp; Mendaftar</a>
                                    <a href="<?php echo base_url('lowongan'); ?>" class="btn-system btn-large"><i class="fa fa-search"></i>&nbsp;&nbsp; Cari Lowongan</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--/ Carousel item end -->
                    <div class="item">
                        <img class="img-responsive" src="<?php echo base_url('assets/img/slider/bg2.jpg') ?>" alt="slider">
                        <div class="slider-content">
                            <h2 class="animated4" style="font-size: 35pt;">
                              <span><strong><?php echo $this->Config_Model->get_app_name_url() ?></strong></span><br>
                              <span style="font-size: 12pt; color: #fff;text-transform: none;">Gudangnya Informasi Lowongan Kerja</span>
                            </h2>
                            <h3 class="animated5" style="margin-top: 10px;">
                                <a href="<?php echo base_url('perusahaan/kategori/3'); ?>" class="btn-system btn-large"><i class="fa fa-external-link-square"></i>&nbsp;&nbsp; Pasang Iklan Lowongan</a>
                            </h3>
                        </div>
                    </div>
                    <!--/ Carousel item end -->
                </div>
                <!-- Carousel inner end-->

                <!-- Controls -->
                <a class="left carousel-control" href="#main-slide" data-slide="prev">
                    <span><i class="fa fa-angle-left"></i></span>
                </a>
                <a class="right carousel-control" href="#main-slide" data-slide="next">
                    <span><i class="fa fa-angle-right"></i></span>
                </a>
            </div>
            <!-- /carousel -->
        </section>
        <!-- End Home Page Slider -->
        
        
        <!-- Start Services Section -->
        <div id="content">
            <div class="container">
                <!-- Start Services Icons -->
                  <div class="row">
                    
                    <!-- Start Service Icon 1 -->
                    <div class="col-md-4 col-sm-6 service-box service-center">
                       <div class="service-boxed">
                          <div class="service-icon" style="margin-top:-25px;">
                            <i class="fa fa-pencil-square-o icon-large-effect icon-effect-1"></i>
                        </div>
                        <div class="service-content">
                            <h4>Daftar Cepat dan Mudah</h4>
                            <p>Beritahu kami preferensi pekerjaan Anda untuk mendapatkan lowongan kerja yang sesuai.</p>
                        </div>
                    </div>
                </div>
                <!-- End Service Icon 1 -->
                
                <!-- Start Service Icon 2 -->
                <div class="col-md-4 col-sm-6 service-box service-center">
                 <div class="service-boxed">
                    <div class="service-icon" style="margin-top:-25px;">
                      <i class="fa fa-user icon-large-effect icon-effect-1"></i>
                  </div>
                  <div class="service-content">
                      <h4>Profil Anda</h4>
                      <p>Masuk ke halaman profil Anda dan segera kirim lamaran ke tempat lowongan kerja yang sesuai.</p>
                  </div>
              </div>
            </div>
            <!-- End Service Icon 2 -->

            <!-- Start Service Icon 3 -->
            <div class="col-md-4 col-sm-6 service-box service-center">
               <div class="service-boxed">
                  <div class="service-icon" style="margin-top:-25px;">
                    <i class="fa fa-globe icon-large-effect icon-effect-1"></i>
                </div>
                <div class="service-content">
                    <h4>Daftar Iklan Lowongan</h4>
                    <p>Dapatkan informasi lowongan kerja disini, daftar gaji dan Informasi Perusahaan</p>
                </div>
            </div>
            </div>
            <!-- End Service Icon 3 -->

            </div>
            
            <div class="hr1 margin-30"></div>

                   <!-- Start Recent Projects Carousel -->
                <div class="recent-projects">
                    <h4 class="title"><span>Daftar Lowongan Kerja</span></h4>
                    <div class="projects-carousel touch-carousel">
                        <?php
                            if($loker!=''){
                                foreach($loker as $data){
                        ?>
                        <div class="portfolio-item item">
                            <div class="portfolio-border border-system">
                                <div class="portfolio-details">
                                    <a href="<?php echo base_url('lowongan/detailLowongan/'.$data->id_lowongan) ?>">
                                        <!-- <img src="<?php echo base_url('assets/upload/img/'.$data->logo) ?>" /><br> -->
                                        <h4><?php echo $data->nm_k_lowongan ?></h4>
                                        <span>
                                            <?php 
                                                if(strlen($data->nm_lowongan)>70){
                                                    echo substr($data->nm_lowongan, 0, 70)." ...";
                                                }else{
                                                    echo substr($data->nm_lowongan, 0, 70); 
                                                }
                                            ?>
                                        </span>
                                        <br>
                                        <span style="float:right;"><?php echo $data->nm_perusahaan; ?></span>
                                        <!-- <span>Animation</span> -->
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        }   
                        ?>
                       
                    </div>
                    <div class="hr1 margin-30"></div>
                    <div class="container align-center">
                        <a href="<?php echo base_url('lowongan'); ?>" class="btn btn-system btn-small">Selengkapnya&nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <!-- End Recent Projects Carousel -->
                <!-- Start Testimonials Section -->
        
        </div>
        <!-- End Services Section -->
        
        <div class="section" style="background:#fff;">
            <div class="container">

                    <!-- Start Big Heading -->
                    <div class="big-title text-center" data-animation="fadeInDown" data-animation-delay="01">
                        <h1>Statistik  <span class="accent-color sh-tooltip"><strong><?php echo $this->Config_Model->get_app_name_url() ?></strong></span></h1>
                    </div>
                    <!-- End Big Heading -->

            </div>

        <div id="parallax-one" class="parallax" style="background-image:url(<?php echo base_url('assets/img/parallax.jpg'); ?>);">
            <div class="parallax-text-container-1">
              <div class="parallax-text-item">
                <div class="container">
                  <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-3">
                      <div class="counter-item">
                        <i class="fa fa-arrow-circle-down"></i>
                        <div class="timer" id="item1" data-to="<?php echo isset($statistik['jml_hit'])? $statistik['jml_hit']:''; ?>" data-speed="5000"></div>
                        <h5>Pengunjung <?php echo $this->Config_Model->get_app_name_url() ?></h5>                               
                      </div>
                    </div>  
                    <div class="col-xs-12 col-sm-3 col-md-3">
                      <div class="counter-item">
                        <i class="fa fa-chevron-circle-down"></i>
                        <div class="timer" id="item2" data-to="<?php echo isset($statistik['hari_ini'])? $statistik['hari_ini']:''; ?>" data-speed="5000"></div>
                        <h5>Pengunjung Hari ini</h5>                               
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                      <div class="counter-item">
                        <i class="fa fa-laptop"></i>
                        <div class="timer" id="item3" data-to="<?php echo isset($statistik['perusahaan'])? $statistik['perusahaan']:''; ?>" data-speed="5000"></div>
                        <h5>Perusahaan</h5>                               
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                      <div class="counter-item">
                        <i class="fa fa-globe"></i>
                        <div class="timer" id="item4" data-to="<?php echo isset($statistik['lowongan'])? $statistik['lowongan']:''; ?>" data-speed="5000"></div>
                        <h5>Lowongan Kerja</h5>                               
                      </div>
                    </div>                                                  
                  </div>         
                </div>       
              </div>
            </div>        
          </div>
        </div>

            <div class="container">
                <div class="row">
         <div class="col-md-8">
          
           <!-- Start Recent Posts Carousel -->
           <div class="latest-posts">
            <h4 class="classic-title"><span>Berita Terbaru</span></h4>
            <div class="latest-posts-classic custom-carousel touch-carousel" data-appeared-items="2">
              <?php
                if($loadBerita!=''){
                    foreach ($loadBerita as $berita) {
                        $tgl_berita = explode(" ", tgl_indo_time1($berita->tgl));
                        //var_dump($tgl_berita);
              ?>
              <!-- Posts 1 -->
              <div class="post-row item">
                <div class="left-meta-post">
                  <div class="post-date"><span class="day"><?php echo $tgl_berita[0]; ?></span><span class="month"><?php echo $tgl_berita[1]; ?></span></div>
                  <?php if($berita->foto!=null){ ?>
                  <div class="post-type"><i class="fa fa-picture-o"></i></div>
                  <?php }else{ ?>
                  <div class="post-type"><i class="fa fa-pencil-square-o"></i></div>
                  <?php } ?>
                </div>
                <h3 class="post-title"><a href="<?php echo base_url('berita/detail/'.$berita->id_berita) ?>"><?php echo $berita->judul; ?></a></h3>
                <div class="post-content">
                  <p><?php echo isiSingkat($berita->deskripsi); ?> <a class="read-more" href="<?php echo base_url('berita/detail/'.$berita->id_berita) ?>">Selengkapnya ...</a></p>
                </div>
              </div>

              <?php
                    }
                }
              ?>
            </div>
          </div>
        <!-- End Recent Posts Carousel -->
  
                </div>

                <div class="col-md-4">
                
                <!-- Classic Heading -->
                <h4 class="classic-title"><span>Tentang <?php echo $this->Config_Model->get_app_name_url() ?></span></h4>
                
                <!-- Accordion -->
                <div class="panel-group" id="accordion">
                    <?php
                        foreach($tentang as $data){
                    ?>
                    <!-- Start Accordion 1 -->
                    <div class="panel panel-default">
                        <!-- Toggle Heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $data->id_tentang; ?>" class="collapsed">
                                    <i class="icon-down-open-1 control-icon"></i>
                                    <i class="icon-laptop-1"></i> <?php echo $data->kategori; ?>
                                </a>
                            </h4>
                        </div>
                        <!-- Toggle Content -->
                        <div id="collapse<?php echo $data->id_tentang; ?>" class="panel-collapse collapse">
                            <div class="panel-body"><?php echo isiSingkat($data->deskripsi); ?> <a href="<?php echo base_url('berita/tentang/'.$data->id_tentang) ?>">Selengkapnya</a></div>
                        </div>
                    </div>
                    <!-- End Accordion 1 -->
                    <?php
                        }
                    ?>                    
                </div>
                <!-- End Accordion -->
                
            </div>
                  
                </div>
            </div>
        </div>
        <!-- End Testimonials Section -->        
        
        <!-- Start Client/Partner Section -->
        <div id="partner content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <!-- Start Big Heading -->
        		<div class="big-title text-center">
        			<h1>Daftar <strong>Perusahaan</strong></h1>
        			<p class="title-desc">Perusahaan yang bergabung di <?php echo $this->Config_Model->get_app_name_url() ?></p>
        		</div>
        		<!-- End Big Heading -->
        		
        		<div class="our-clients">
                    
                    <!-- Classic Heading -->
                    <h4 class="classic-title"><span>Daftar Perusahaan</span></h4>
                    
                    <div class="clients-carousel custom-carousel touch-carousel" data-appeared-items="5">
                        
                        <?php if($daftarPerusahaan!=''){
                                foreach($daftarPerusahaan as $perusahaanData){
                         ?>
                        <!-- Client 1 -->
                        <div class="client-item item">
                            <a href="#"><img src="<?php echo base_url('assets/upload/img/'.$perusahaanData->logo);?>" alt="" /></a>
                        </div>
                        <?php 
                                } 
                            }else{ 
                        ?>
                        <!-- Client 2 -->
                        <div class="client-item item">
                            <a href="#"><img src="<?php echo base_url('assets/img/logo.png');?>" alt="" /></a>
                        </div>
                        
                        <!-- Client 3 -->
                        <div class="client-item item">
                            <a href="#"><img src="<?php echo base_url('assets/img/logo.png');?>" alt="" /></a>
                        </div>
                        
                        <!-- Client 4 -->
                        <div class="client-item item">
                            <a href="#"><img src="<?php echo base_url('assets/img/logo.png');?>" alt="" /></a>
                        </div>
                        
                        <!-- Client 5 -->
                        <div class="client-item item">
                            <a href="#"><img src="<?php echo base_url('assets/img/logo.png');?>" alt="" /></a>
                        </div>
                        
                        <!-- Client 6 -->
                        <div class="client-item item">
                            <a href="#"><img src="<?php echo base_url('assets/img/logo.png');?>" alt="" /></a>
                        </div>
                        
                        <!-- Client 7 -->
                        <div class="client-item item">
                            <a href="#"><img src="<?php echo base_url('assets/img/logo.png');?>" alt="" /></a>
                        </div>
                        
                        <!-- Client 8 -->
                        <div class="client-item item">
                            <a href="#"><img src="<?php echo base_url('assets/img/logo.png');?>" alt="" /></a>
                        </div>
                        <?php } ?>
                        
                    </div>
                </div>
            </div><!-- .row -->
        </div><!-- .container -->
        </div>
        <!-- End Client/Partner Section -->
        <div class="hr1 margin-60"></div>

        <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

        <div id="loader">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
</body>

</html>