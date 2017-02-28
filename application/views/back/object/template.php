<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $this->Config_Model->get_app_name_url() ?> | <?php echo ucfirst(uri_string()); ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<meta name="robots" content="noindex,nofollow">
	<meta name="googlebot" content="noindex,nofollow">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.hg.css" />
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/icon_admin.png') ?>" />
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/font_awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
            <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
      </head>
  <body class="skin-blue">
    <div class="wrapper">
      
      <header class="main-header navbar-static-top">
        <!-- Logo -->
        <a href="<?php echo base_url('admin'); ?>" class="logo"><img src="<?php echo base_url(); ?>assets/img/logo_admin.png" /></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Notifikasi Bantuan">
                  <i class="fa fa-inbox"></i>
                  <?php
                      $this->load->model('my_model');
                      $this->load->helper('fungsi_date');
                      if($this->my_model->showBantuanNumRows(date('Y-m-d')." 00:00:00", adddate(date('Y-m-d'),"+1 day")." 00:00:00")==0){
                        echo "";
                      }else{
                        echo "<span class='label label-warning'>".$this->my_model->showBantuanNumRows(date('Y-m-d')." 00:00:00", adddate(date('Y-m-d'),"+1 day")." 00:00:00")."</span>";
                      }
                      $dataBantuan = $this->my_model->showBantuan(date('Y-m-d')." 00:00:00", adddate(date('Y-m-d'),"+1 day")." 00:00:00");
                    ?>
                </a>
                 <ul class="dropdown-menu">
                  <li class="header">Kiriman Pesan Pertanyaan Hari ini</li>
                  <li>
              
                    <ul class="menu">
                      <?php
                        if($dataBantuan!=null){
                        foreach($dataBantuan as $data){
                      ?>
                      <li class="text-kiri">
                        <a data-toggle="tooltip" href="<?php echo base_url('admin/kirimBantuan/'.$data->id_bantuan); ?>" title="Klik untuk Balas">
                          <h4>
                            <?php echo $data->nama; ?>
                            <small class="pull-right"><?php echo tgl_indo_time1($data->tgl); ?></small>
                          </h4>
                          <p><?php echo $data->subjek;?></p>
                        </a>
                      </li>
                      <?php
                        }
                      }else{
                        echo "<li><a href='#' align='center'>Tidak Ada Pesan</a></li>";
                      }
                      ?>
                    </ul>
                  </li>
                  <li class="footer"><a href="<?php echo base_url('admin/bantuan') ?>">Lihat Semua</a></li>
                </ul>
              </li>
              
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php if($this->session->userdata('foto')==''||$this->session->userdata('foto')==null){ ?>
                      <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="user-image" alt="User Image" />
                    <?php }else{ ?>
                      <img src="<?php echo base_url('assets/upload/img/'.$this->session->userdata('foto')); ?>" class="user-image" alt="User Image" />
                    <?php } ?>
                    <span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <?php if($this->session->userdata('foto')==''||$this->session->userdata('foto')==null){ ?>
                      <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image" />
                    <?php }else{ ?>
                      <img src="<?php echo base_url('assets/upload/img/'.$this->session->userdata('foto')); ?>" class="img-circle" alt="User Image" />
                    <?php } ?>
                    <p>
                      <?php echo $this->session->userdata('nama'); ?> - ADMIN
                      <small>Pemegang Keseluruhan Sistem</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a data-toggle="tooltip" title="Ubah Profil Anda" href="<?php echo base_url('admin/editProfil') ?>" class="btn btn-success btn-flat"><i class="fa fa-user"></i>&nbsp;&nbsp;Profile</a>
                    </div>
                    <div class="pull-right">
                      <a data-toggle="tooltip" title="Keluar Aplikasi" href="<?php echo base_url('admin/logout') ?>" class="btn btn-danger btn-flat"><i class="fa fa-power-off"></i>&nbsp;&nbsp; Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <?php if($this->session->userdata('foto')==''||$this->session->userdata('foto')==null){ ?>
                <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image" />
              <?php }else{ ?>
                <img src="<?php echo base_url('assets/upload/img/'.$this->session->userdata('foto')); ?>" class="img-circle" alt="User Image" />
              <?php } ?>
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->userdata('nama'); ?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

            </div>
          </div>

          <!-- search form 
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          .search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header" style="color: #fff; text-align: center; font-size: 11pt;">
            <?php
            $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
            $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
            echo $hari[date("w")].", ".date("j")." ".$bulan[date("n")]." ".date("Y");
            ?>
            &nbsp;<span id="clockDisplay" class="clockStyle"></span>
            </li>
            <li class="header">MENU NAVIGASI UTAMA</li>
            <li <?php if(uri_string()==''||uri_string()=='admin'||uri_string()=='admin/index'){ ?> class="active"<?php } ?>>
              <a href="<?php echo base_url('admin'); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <i class="fa fa-angle-right pull-right"></i>
              </a>
            </li>
            <li <?php if(uri_string()==''||uri_string()=='admin/perusahaan'){ ?> class="active"<?php } ?>>
              <a href="<?php echo base_url('admin/perusahaan'); ?>">
                <i class="fa fa-laptop"></i> <span>Manajemen Perusahaan</span>
                <i class="fa fa-angle-right pull-right"></i>
              </a>
            </li>
            <li <?php if(uri_string()=='admin/loker'||uri_string()=='admin/kLoker'||uri_string()=='admin/golongan'){ ?> class="active treeview"<?php }else{echo "treeview";} ?>>
              <a href="#">
                <i class="fa fa-globe"></i>
                <span>Manajemen Iklan Loker</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li <?php if(uri_string()=='admin/loker'){ ?> class="active"<?php } ?>>
                  <a href="<?php echo base_url('admin/loker'); ?>"><i class="fa fa-align-justify"></i> Lihat Lowongan</a>
                <li <?php if(uri_string()=='admin/kLoker'){ ?> class="active"<?php } ?>>
                  <a href="<?php echo base_url('admin/kLoker'); ?>"><i class="fa fa-circle-o"></i> Kategori Lowongan</a>
                </li>
                <li <?php if(uri_string()=='admin/golongan'){ ?> class="active"<?php } ?>>
                  <a href="<?php echo base_url('admin/golongan'); ?>"><i class="fa fa-circle-o"></i> Kategori Golongan</a>
                </li>
              </ul>
            </li>
            <li <?php if(uri_string()=='admin/order'){ ?> class="active"<?php } ?>>
              <a href="<?php echo base_url('admin/order'); ?>">
                <i class="fa fa-dollar"></i> <span>Manajemen Order Iklan</span>
                <i class="fa fa-angle-right pull-right"></i>
              </a>
            </li>
            <li <?php if(uri_string()=='admin/pendaftar'){ ?> class="active"<?php } ?>>
              <a href="<?php echo base_url('admin/pendaftar'); ?>">
                <i class="fa fa-group"></i> <span>Lihat Identitas Pendaftar</span>
                <i class="fa fa-angle-right pull-right"></i>
              </a>
            </li>
            <li <?php if(uri_string()=='admin/profilPerusahaan'||uri_string()=='admin/bank'||uri_string()=='admin/berita'||uri_string()=='admin/bantuan'||uri_string()=='admin/tentang'){ ?> class="active treeview"<?php }else{echo "treeview";} ?>>
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Manajemen Lainnya</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li <?php if(uri_string()=='admin/profilPerusahaan'){ ?> class="active"<?php } ?>>
                  <a href="<?php echo base_url('admin/profilPerusahaan'); ?>"><i class="fa fa-suitcase"></i> Profil Perusahaan</a>
                </li>
                <li <?php if(uri_string()=='admin/bank'){ ?> class="active"<?php } ?>>
                  <a href="<?php echo base_url('admin/bank'); ?>"><i class="fa fa-dollar"></i> Rekening Bank</a>
                </li>
                <li <?php if(uri_string()=='admin/berita'){ ?> class="active"<?php } ?>>
                  <a href="<?php echo base_url('admin/berita'); ?>"><i class="fa fa-book"></i> Lihat Berita</a>
                </li>
                <li <?php if(uri_string()=='admin/tentang'){ ?> class="active"<?php } ?>>
                  <a href="<?php echo base_url('admin/tentang'); ?>"><i class="fa fa-book"></i> Deskripsi Tentang</a>
                </li>
                <li <?php if(uri_string()=='admin/bantuan'){ ?> class="active"<?php } ?>>
                  <a href="<?php echo base_url('admin/bantuan'); ?>"><i class="fa fa-inbox"></i> Lihat Bantuan</a>
                </li>
              </ul>
            </li>
            <li <?php if(uri_string()=='admin/user'||uri_string()=='admin/tambahUser'){ ?> class="active treeview"<?php }else{echo "treeview";} ?>>
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Manajemen User</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li <?php if(uri_string()=='admin/tambahUser'){ ?> class="active"<?php } ?>>
                  <a href="<?php echo base_url('admin/tambahUser'); ?>"><i class="fa fa-plus-square"></i> Buat User Baru</a>
                </li>
                <li <?php if(uri_string()=='admin/user'){ ?> class="active"<?php } ?>>
                  <a href="<?php echo base_url('admin/user'); ?>"><i class="fa fa-align-justify"></i> Lihat User</a>
                </li>
              </ul>
            </li>
            <li>
              <a target="_BLANK" href="<?php echo base_url('beranda'); ?>">
                <i class="fa fa-laptop"></i> <span>Lihat Website</span>
                <i class="fa fa-angle-right pull-right"></i>
              </a>
            </li>
            <li <?php if(uri_string()==''||uri_string()=='admin/password'){ ?> class="active"<?php } ?>>
              <a href="<?php echo base_url('admin/password'); ?>">
                <i class="fa fa-lock"></i> <span>Ubah Password</span>
                <i class="fa fa-angle-right pull-right"></i>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <?php echo $content; ?>
      </div><!-- /.content-wrapper -->


    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; <?php echo date('Y'); ?> <a target="_BLANK" href="http://atc.co.id">Jeloker.Com</a>.</strong> All rights reserved.
      </footer>

    </div><!-- ./wrapper -->
        <!-- daterangepicker -->
    <script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>assets/dist/js/demo.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript">
    function renderTime(){
     var currentTime = new Date();
     var h = currentTime.getHours();
     var m = currentTime.getMinutes();
     var s = currentTime.getSeconds();
     if (h == 0){
      h = 24;
       }
       if (h < 10){
        h = "0" + h;
        }
        if (m < 10){
        m = "0" + m;
        }
        if (s < 10){
        s = "0" + s;
        }
     var myClock = document.getElementById('clockDisplay');
     myClock.textContent = h + ":" + m + ":" + s + "";    
     setTimeout ('renderTime()',1000);
     }
     renderTime();
    </script>

  </body>
</html>