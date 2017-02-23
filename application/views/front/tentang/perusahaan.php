<?php
  $this->load->helper('fungsi_date');
?>
<!-- Start Page Banner -->
		<div class="page-banner">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h2>Halaman Perusahaan</h2>
						<p>Disini Anda mulai membaca ketentuan yang berlaku untuk pemasangan iklan lowongan kerja</p>
					</div>
					<div class="col-md-4">
						<ul class="breadcrumbs">
							<li><a href="<?php echo base_url(''); ?>">Beranda</a></li>
							<li>Perusahaan</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- End Page Banner -->
		
		
		
		
		<!-- Start Content -->
		<div id="content">
			<div class="container">
        <div class="row blog-post-page">
                   <div class="col-md-9 blog-box">
                      <?php
                      if($this->session->flashdata('gagal')!=null){
                      ?>
                        <div class="alert alert-info alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h4><i class="icon fa fa-info"></i> Gagal</h4>
                          <?php echo $this->session->flashdata('gagal'); ?>
                        </div>
                      <?php
                        }
                      ?>

                      <?php
                      if($this->session->flashdata('berhasil')!=null){
                      ?>
                        <div class="alert alert-info alert-success">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h4><i class="icon fa fa-info"></i> Berhasil</h4>
                          <?php echo $this->session->flashdata('berhasil'); ?>
                        </div>
                      <?php
                        }
                      ?>

                    <!-- Start Single Post Area -->
                    <div class="blog-post gallery-post">

                      <?php if($this->session->userdata('id_login')==null || $this->session->userdata('id_login')==''){ ?>

                    <div class="box box-danger">
                        <div class="box-header align-center">
                          <h4 class="box-title raleway padding-5" style="font-weight: normal;">Login Masuk Halaman Pribadi Perusahaan</h4>
                        </div>
                        <div class="box-body">
                            <!-- Start daftar Form -->
                            <form role="form" class="contact-form form-style" id="contact-form" method="post" action="<?php echo base_url('perusahaan/prosesLogin'); ?>">
                              <div class="row">
                                <div class="col-md-5">
                                  <div class="form-group">
                                  <div class="controls">
                                  <input type="text" placeholder="Email atau ID" name="id" required/>
                                  </div>
                                  </div>
                                </div>
                                <div class="col-md-5">
                                  <div class="form-group">
                                  <div class="controls">
                                  <input type="password" placeholder="Password" name="password" required/>
                                  </div>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <button type="submit" id="submit" class="btn-system btn-medium"><i class="fa fa-sign-in"></i>&nbsp;&nbsp; LOGIN</button>
                                </div>
                              </div>
                              <div class="padding-2">
                                <a href="<?php echo base_url('login/lupaPasswordPerusahaan') ?>">Lupa Password?</a>
                                <span style="float:right;" class="raleway align-right">Anda tidak punya Akun? <a href="<?php echo base_url('login/daftarPerusahaan'); ?>">Daftar Sekarang</a></span>
                              </div>
                            </form>
                            <!-- End Daftar Form -->
                        </div>
                    </div>

                    <?php } ?>
              
                    <!-- Start Single Post Content -->
                    <div class="post-content">
                     <div class="post-type"><i class="fa fa-pencil-square-o"></i></div>
                     <h2><?php echo isset($row['judul'])? $row['judul']:''; ?></h2>
                     <ul class="post-meta">
                       <li>By <a href="#">Admin</a></li>
                       <li><i class="fa fa-clock-o"></i>&nbsp; <?php echo tgl_indo_time1(isset($row['tgl_update'])? $row['tgl_update']:''); ?></li>
                     </ul>
                     <p><?php echo isset($row['deskripsi'])? $row['deskripsi']:''; ?></p>
                   </div>
                 </div>
                 <!-- End Single Post Content -->

                </div>
                <!-- End Single Post Area -->

                


                <!-- Sidebar -->
                <div class="col-md-3 sidebar right-sidebar">

                <!-- Categories Widget -->
                <div class="widget widget-categories">
                 <h4>Kategori <span class="head-line"></span></h4>
                 <ul>
                  <?php
                  
                    if($kategoriData!=''){
                      foreach($kategoriData as $data){
                  ?>
                  <li>
                   <a <?php if($data->id_tentang==$this->uri->segment('3')){echo "class='active'";} ?> href="<?php echo base_url('perusahaan/kategori/'.$data->id_tentang); ?>"><?php echo $data->kategori; ?></a>
                 </li>
                 <?php
                      }
                    }
                 ?>
                </ul>
                </div>

                </div>
                <!--End sidebar-->

                </div>
			</div>
		</div>
		<!-- End Content -->
