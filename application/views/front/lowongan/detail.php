<?php
  foreach($loadLowongan as $lowongan):
?>
<!-- Start Page Banner -->
		<div class="page-banner">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h2><?php echo $lowongan->nm_lowongan; ?></h2>
						<p><?php echo $lowongan->nm_perusahaan; ?></p>
					</div>
					<div class="col-md-4">
						<ul class="breadcrumbs">
							<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
							<li><a href="<?php echo base_url('lowongan'); ?>">Lowongan</a></li>
              <li>Detail Lowongan</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- End Page Banner -->
		
		
		
		
		<!-- Start Content -->
		<div id="content">
			<div class="container">
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

				<div class="row blog-page">
					
					
					<!--Sidebar-->
					<div class="col-md-4 sidebar left-sidebar">
                        <div class="hr1 margin-30"></div>
						<div class="project-page row">
					                            <!-- Start Single Project Slider -->
                            <div class="project-content col-md-12">
                                <h4><span><?php echo $lowongan->nm_perusahaan; ?></span></h4>
                                <?php if($lowongan->logo!=''){ ?>
                                <p class="align-center">
                                    <img src="<?php echo base_url('assets/upload/img/'.$lowongan->logo) ?>" class="img-responsive" width="100%" />
                                </p>
                                <?php } ?>
                                <p><?php echo $lowongan->tentang; ?></p>
                                <h4><span>Detail Perusahaan</span></h4>
                                <ul>
                                    <li><i class="fa fa-map-marker"></i>&nbsp;&nbsp; <?php echo $lowongan->alamat; ?></li>
                                    <li><a target="_BLANK" href="http://<?php echo $lowongan->almt_web; ?>"><i class="fa fa-globe"></i>&nbsp; <?php echo $lowongan->almt_web; ?></a></li>
                                    <li><i class="fa fa-phone-square"></i>&nbsp;&nbsp; <?php echo $lowongan->no_telp; ?></li>
                                </ul>
                                <h4><span>Kirim Identitas Diri</span></h4>
                                <!-- Start Call Action -->
                                <div class="call-action bg-canvas clearfix">
                                    <!-- Call Action Button -->
                                    <div class="align-center" style="margin:20px 0 5px; padding: 0 20px;">
                                          <a href="<?php echo base_url('lowongan/melamar/'.$this->uri->segment('3')); ?>" style="color: #fff;" class="btn btn-system btn-medium btn-block">
                                            <i class="fa fa-send"></i>&nbsp;&nbsp; Lamar Sekarang
                                          </a>
                                      </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="align-left raleway" style="margin:8px 0 10px; padding: 0 20px;"><i class="fa fa-clock-o"></i> <?php echo tgl_indo($lowongan->date_post); ?></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="align-right raleway" style="margin:8px 0 10px; padding: 0 20px;"><i class="fa fa-times-circle"></i> <?php echo tgl_indo($lowongan->date_close); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Project Slider -->
                        </div>
                        <div class="row">
                            <div class="project-content col-md-12">
                                
                                <!-- End Call Action -->
                            </div>
                        </div>
                    </div>
					<!--End sidebar-->

                    <!-- Start Blog Posts -->
					<div class="col-md-8 blog-box bg-canvas">

						<div class="row blog-post-page">
                           <div class="col-md-12 blog-box">

                            <!-- Start Single Post Area -->
                            <div class="blog-post project-content">

                                <!-- Start Single Post Content -->
                                <div class="post-content">
                                 <div class="post-type"><i class="fa fa-pencil-square-o"></i></div>
                                 <h2><?php echo $lowongan->nm_lowongan; ?></h2>
                                 <ul class="post-meta">
                                   <li><?php echo $lowongan->nm_k_lowongan; ?></li>
								                  <li>
                                    <font style="font-family: raleway">
                                      <i class="fa fa-clock-o"></i>&nbsp; 
                                      <?php if(date('Y-m-d') >= $lowongan->date_limit){ echo "Lowongan sudah di tutup"; }else{echo tgl_indo($lowongan->date_post)." - ".tgl_indo($lowongan->date_close);} ?>
                                    </font>
                                  </li>
                                 </ul>
                                <ul>
                                    <li><font style="font-family: raleway"><i class="fa fa-map-marker"></i>&nbsp; <?php echo $lowongan->kota.", ".$lowongan->provinsi; ?></font></li>
                                    <li><a href="#"><i class="fa fa-dollar"></i>&nbsp;
                                        <?php 
                                          if(($this->session->userdata('id_login')!=''||$this->session->userdata('id_login')!=null)){
                                            echo $lowongan->gaji;
                                          }else{
                                            echo "Login untuk Melihat Gaji";
                                          }
                                        ?>
                                        </a>
                                    </li>
                                    <li><i class="fa fa-suitcase"></i>&nbsp;&nbsp; <?php echo $lowongan->nm_type; ?></li>
                                </ul>
                                <h4><span>Kualifikasi</span></h4>
                                 <p><?php echo $lowongan->kualifikasi; ?></p>
                                <h4><span>Benefit</span></h4>
                                 <p><?php echo $lowongan->benefit; ?></p>

                                 <div class="post-bottom clearfix">
                                  <div class="post-share">
                                    <span>Bagikan ke</span>
                                    <a class="facebook" href="javascript:void(0)" onclick="CenterWindow(1000,800,50,'https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('lowongan/detailLowongan/'.$this->uri->segment('3')); ?>','demo_win');"><i class="fa fa-facebook"></i></a>
                                    <a class="twitter" href="javascript:void(0)" onclick="CenterWindow(1000,800,50,'https://twitter.com/intent/tweet?url=<?php echo base_url('lowongan/detailLowongan/'.$this->uri->segment('3')); ?>','demo_win');"><i class="fa fa-twitter"></i></a>
                                    <a class="gplus" href="javascript:void(0)" onclick="CenterWindow(1000,800,50,'https://plus.google.com/share?url=<?php echo base_url('lowongan/detailLowongan/'.$this->uri->segment('3')); ?>','demo_win');"><i class="fa fa-google-plus"></i></a>
                                  </div>
                                </div>
                             </div>
                         <!-- End Single Post Content -->

                        </div>
                        <!-- End Single Post Area -->
					</div>
					<!-- End Blog Posts -->
				</div>
			</div>
        </div>
		</div>
	</div>
		<!-- End Content -->
<?php
  endforeach;
?>
    <script>
      function CenterWindow(windowWidth, windowHeight, windowOuterHeight, url, wname, features) {
        var centerLeft = parseInt((window.screen.availWidth - windowWidth) / 2);
        var centerTop = parseInt(((window.screen.availHeight - windowHeight) / 2) - windowOuterHeight);

        var misc_features;
        if (features) {
          misc_features = ', ' + features;
        }
        else {
          misc_features = ', status=no, location=no, scrollbars=yes, resizable=yes';
        }
        var windowFeatures = 'width=' + windowWidth + ',height=' + windowHeight + ',left=' + centerLeft + ',top=' + centerTop + misc_features;
        var win = window.open(url, wname, windowFeatures);
        win.focus();
        return win;
      }
    </script>