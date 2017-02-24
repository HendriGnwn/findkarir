
<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">
<head>
    
    <!-- Basic -->
    <title><?php echo isset($page_title) ? $page_title : '' ?> | <?php echo $this->Config_Model->get_app_name() ?></title>
    
    <!-- Define Charset -->
    <meta charset="utf-8">
    
    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- Page Description and Author -->
    <meta name="description" content="<?php echo isset($meta_deskripsi)? $meta_deskripsi:''; ?>">
    <meta name="author" content="Hendri Gunawan">

    <meta property="og:title" content="JELOKER.COM | <?php echo strtoupper(isset($title_head)? $title_head:''); ?>" /> 
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?php echo base_url('assets/img/meta.jpg'); ?>" /> 
    <meta property="og:image:type" content="image/jpg">
    <meta property="og:description" content="<?php echo isset($meta_deskripsi)? $meta_deskripsi:''; ?>" /> 
    <meta property="og:url" content="<?php echo base_url(uri_string()); ?>">

    <!-- for Twitter -->          
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@hendriGnwin">
    <meta name="twitter:creator" content="Hendri Gunawan">
    <meta name="twitter:title" content="JELOKER.COM | <?php echo strtoupper(isset($title_head)? $title_head:''); ?>">
    <meta name="twitter:description" content="<?php echo isset($meta_deskripsi)? $meta_deskripsi:''; ?>">
    <meta name="twitter:image:src" content="<?php echo base_url('assets/img/meta.jpg'); ?>"> 
    
    <!--for G+-->
    <meta itemprop="name" content="JELOKER.COM | <?php echo strtoupper(isset($title_head)? $title_head:''); ?>" > 
    <meta itemprop="description" content="<?php echo isset($meta_deskripsi)? $meta_deskripsi:''; ?>">
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

    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/colors/red.css');?>" title="red" media="screen" />
    
    
    <!-- Margo JS  -->
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery-2.1.1.min.js');?>"></script>
    <!--<script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery.migrate.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/modernizrr.js');?>"></script>-->
    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery.fitvids.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/owl.carousel.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/nivo-lightbox.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery.nicescroll.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery.isotope.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery.appear.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/count-to.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery.textillate.js');?>"></script>
<!--    <script type="text/javascript" src="js/jquery.lettering.js"></script>-->
<!--    <script type="text/javascript" src="js/jquery.easypiechart.min.js"></script>-->
    
    <!--<script type="text/javascript" src="<?php echo base_url('assets/plugins/js/jquery.parallax.js');?>"></script>-->
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/script.js');?>"></script>
    
    <!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    
</head>
<body>

    <!-- Container -->
    <div id="container">
        
        <!-- Start Header -->
        <div class="hidden-header"></div>
        <header class="clearfix">
            
            <!-- Start Top Bar -->
            <div class="top-bar top-bar-margin">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Start Contact Info -->
                            <ul class="contact-details">
                                <li><a href="<?php echo base_url('beranda'); ?>"><i class="fa fa-home"></i>&nbsp; Beranda</a>
                                </li>
                                <li><a <?php if(uri_string()=='lowongan'){?> class="active"<?php } ?> href="<?php echo base_url('lowongan'); ?>"><i class="fa fa-globe"></i>&nbsp; Lowongan</a>
                                </li>
                                <li><a <?php if(uri_string()=='bantuan'){?> class="active"<?php } ?> href="<?php echo base_url('bantuan'); ?>"><i class="fa fa-envelope-o"></i>&nbsp; Bantuan</a>
                                </li>
                            </ul>
                            <!-- End Contact Info -->
                        </div>
                        <div class="col-md-6">
                            <ul class="contact-details align-right">
                                <?php
                                    if($this->session->userdata('id_login')=='' || $this->session->userdata('id_login')==null){
                                ?>
                                    <li><a <?php if(uri_string()=='login/masuk'){?> class="active"<?php } ?> href="<?php echo base_url('login/masuk'); ?>"><i class="fa fa-sign-in"></i>&nbsp; Login</a>
                                    </li>
                                    <li><a <?php if(uri_string()=='login/daftar'){?> class="active"<?php } ?> href="<?php echo base_url('login/daftar'); ?>"><i class="fa fa-pencil-square-o"></i>&nbsp; Mendaftar</a>
                                <?php
                                    }elseif($this->session->userdata('id_login')!='' || $this->session->userdata('id_login')!=null){
                                ?>
                                    <?php
                                        if($this->session->userdata('hak_akses')=='perusahaan'){
                                    ?>
                                        <li><a <?php if(uri_string()=='company'){?> class="active"<?php } ?> href="<?php echo base_url('company'); ?>"><i class="fa fa-laptop"></i>&nbsp; <?php echo $this->session->userdata('nama'); ?></a>
                                        </li>
                                    <?php
                                        }elseif($this->session->userdata('hak_akses')=='pelamar'){
                                    ?>
                                        <li><a <?php if(uri_string()=='pelamar'){?> class="active"<?php } ?> href="<?php echo base_url('pelamar'); ?>"><i class="fa fa-user"></i>&nbsp; <?php echo $this->session->userdata('nama'); ?></a>
                                        </li>
                                    <?php 
                                        }
                                    ?>
                                    <li><a href="<?php echo base_url('login/logout/'.$this->session->userdata('hak_akses')); ?>"><i class="fa fa-sign-out"></i>&nbsp; Logout</a>
                                <?php
                                    }
                                ?>
                            </ul>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Top Bar -->
            
            <!-- Start Header ( Logo & Naviagtion ) -->
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
                        <!-- Start Navigation List -->
                        <div class="widget widget-search navbar-search">
                            <form action="<?php echo base_url('lowongan/cari') ?>" method="POST">
                                <input type="search" placeholder="Mencari berdasarkan Posisi . Keahlian . Perusahaan ..." name="search" />
                                <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a <?php if(uri_string()=="perusahaan"){?> class="active"<?php } ?>  href="<?php echo base_url('perusahaan'); ?>">Perusahaan</a>
                            </li>
                        </ul>
                        <!-- End Navigation List -->
                    </div>
                </div>
            </div>
            <!-- End Header ( Logo & Naviagtion ) -->
            
        </header>
        <!-- End Header -->

        <?php
            echo isset($content)? $content:'';
			$this->load->view('front/layouts/footer');
        ?>
            <!-- Go To Top Link -->
    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

    <div id="loader">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
    </body>
</html>