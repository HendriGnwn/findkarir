<?php
  $this->load->helper('fungsi_date');
?>
<!-- Start Page Banner -->
		<div class="page-banner">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h2><?php echo isset($row['judul'])? $row['judul']:''; ?></h2>
            <p>di Posting oleh Admin</p>
					</div>
					<div class="col-md-4">
						<ul class="breadcrumbs">
							<li><a href="<?php echo base_url(''); ?>">Beranda</a></li>
              <li><a href="<?php echo base_url('berita'); ?>">Berita</a></li>
							<li>Detail Berita</li>
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

                    <!-- Start Single Post Area -->
                    <div class="blog-post gallery-post">

                        <!-- Start Single Post (Gallery Slider) -->
                        <?php if(isset($row['foto'])? $row['foto']:''!=null){ ?>
                        <div class="post-head align-center">
                          <div class="item align-center">
                            <a class="lightbox" title="<?php echo isset($row['judul'])?$row['judul']:''; ?>" href="<?php echo base_url('assets/upload/img/'.$row['foto']); ?>">
                              <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                              <img alt="<?php echo isset($row['judul'])?$row['judul']:''; ?>" src="<?php echo base_url('assets/upload/img/'.$row['foto']); ?>">
                            </a>
                          </div>
                        </div>
                        <?php } ?>
                      <!-- End Single Post (Gallery) -->

                    <!-- Start Single Post Content -->
                    <div class="post-content">
                     <div class="post-type">
                     <?php if(isset($row['foto'])? $row['foto']:''!=null){ ?>
                      <i class="fa fa-picture-o"></i>
                      <?php }else{ ?>
                      <i class="fa fa-pencil-square-o"></i>
                      <?php } ?>
                      </div>
                     <h2><?php echo isset($row['judul'])?$row['judul']:''; ?></h2>
                     <ul class="post-meta">
                       <li>By <a href="#">Admin</a></li>
                       <li><i class="fa fa-clock-o"></i>&nbsp; <?php echo tgl_indo_time1($row['tgl']); ?></li>
                     </ul>
                     <p><?php echo isset($row['deskripsi'])?$row['deskripsi']:''; ?></p>

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