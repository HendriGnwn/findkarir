<?php
  $this->load->helper('fungsi_date');
?>
<!-- Start Page Banner -->
		<div class="page-banner">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h2>Berita jeLoker.com</h2>
						<p>Berita Mengenai jeLoker.com</p>
					</div>
					<div class="col-md-4">
						<ul class="breadcrumbs">
							<li><a href="<?php echo base_url(''); ?>">Beranda</a></li>
							<li><?php echo isset($row['untuk'])? $row['untuk']:''; ?></li>
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
                      if($loadBerita!=''){
                        foreach ($loadBerita as $dataBerita) {
                    ?>  
                    <!-- Start Post -->
                    <div class="blog-post image-post">
                    <?php
                      if($dataBerita->foto!=null){
                    ?>
                      <!-- Post Thumb -->
                      <div class="post-head align-center">
                        <a class="lightbox" title="<?php echo $dataBerita->judul; ?>" href="<?php echo base_url('assets/upload/img/'.$dataBerita->foto) ?>">
                          <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                          <img alt="<?php echo $dataBerita->judul; ?>" src="<?php echo base_url('assets/upload/img/'.$dataBerita->foto) ?>">
                        </a>
                      </div>
                    <?php
                      }
                    ?>
                      <!-- Post Content -->
                      <div class="post-content">
                        <div class="post-type">
                        <?php if($dataBerita->foto!=null){ ?>
                          <i class="fa fa-picture-o"></i>
                        <?php }else{ ?>
                          <i class="fa fa-pencil-square-o"></i>
                        <?php } ?>
                        </div>
                        <h2><a href="<?php echo base_url('berita/detail/'.$dataBerita->id_berita) ?>"><?php echo $dataBerita->judul; ?></a></h2>
                        <ul class="post-meta">
                          <li>By <a href="#">Admin</a></li>
                          <li><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo tgl_indo_time1($dataBerita->tgl); ?></li>
                        </ul>
                        <p><?php echo isiSingkat($dataBerita->deskripsi); ?></p>
                        <a class="main-button" href="<?php echo base_url('berita/detail/'.$dataBerita->id_berita) ?>">Selengkapnya <i class="fa fa-angle-right"></i></a>
                      </div>
                    </div>
                    <!-- End Post -->
                    <?php
                        }
                    }else{
                    ?>  
                        <div class="alert alert-info alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h4><i class="icon fa fa-info"></i>&nbsp; Informasi Lowongan Kerja</h4>
                          <?php echo isset($alert_kosong)? $alert_kosong:''; ?>
                        </div>
                    <?php
                        }
                    ?>
                    <!-- Start Pagination -->
                    <div class="row">
                      <div class="col-md-12 align-left">
                      <?php
                        echo $halaman;
                      ?>
                      </div>
                    </div>
                    <!-- End Pagination -->

                </div>
                <!-- End Single Post Area -->

                


                <!-- Sidebar -->
                <div class="col-md-3 sidebar right-sidebar">

                <!-- Categories Widget -->
                <div class="widget widget-categories">
                 <h4>Kategori <span class="head-line"></span></h4>
                 <ul>
                  <li><a <?php if(uri_string()=='berita'){echo "class='active'";} ?> href="<?php echo base_url('berita'); ?>">Berita jeLoker.com</a></li>
                  <?php
                    if($kategoriData!=''){
                      foreach($kategoriData as $data){
                  ?>
                  <li>
                   <a <?php if($data->id_tentang==$this->uri->segment('3')){echo "class='active'";} ?> href="<?php echo base_url('berita/tentang/'.$data->id_tentang); ?>"><?php echo $data->kategori; ?></a>
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