<!-- Start Page Banner -->
		<div class="page-banner">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h2>Lowongan</h2>
						<p>Daftar Lowongan tersedia di Halaman ini</p>
					</div>
					<div class="col-md-6">
						<ul class="breadcrumbs">
							<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
							<li>Lowongan</li>
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
					<div class="col-md-4 sidebar left-sidebar search-sidebar">
						
						<!-- Search Widget -->
						<div class="widget widget-search">
                            <div class="hr1 margin-30"></div>
							<h4>Cari Berdasarkan <span class="head-line"></span></h4>
							<form role="form" class="contact-form" id="contact-form" method="get" action="<?php echo base_url('lowongan/search'); ?>">
							    <div class="form-group">
								    <div class="controls">
								    <select name="gaji" class="form-control">
                                        <option value="">... Rentan Gaji ..</option>
									    <option value="Rp. 1.000.000 - Rp. 2.000.000">Rp. 1,000,000 - Rp. 2,000,000</option>
                                        <option value="Rp. 2.000.000 - Rp. 3.000.000">Rp. 2,000,000 - Rp. 3,000,000</option>
                                        <option value="Rp. 3.000.000 - Rp. 4.000.000">Rp. 3,000,000 - Rp. 4,000,000</option>
                                        <option value="Rp. 4.000.000 - Rp. 5.000.000">Rp. 4,000,000 - Rp. 5,000,000</option>
                                        <option value="Rp. 5.000.000 - Rp. 6.000.000">Rp. 5,000,000 - Rp. 6,000,000</option>
                                        <option value="Rp. 6.000.000 - Rp. 7.000.000">Rp. 6,000,000 - Rp. 7,000,000</option>
                                        <option value="Rp. 7.000.000 - Rp. 8.000.000">Rp. 7,000,000 - Rp. 8,000,000</option>
                                        <option value="Rp. 8.000.000 - Rp. 9.000.000">Rp. 8,000,000 - Rp. 9,000,000</option>
                                        <option value="Rp. 9.000.000 - Rp. 10.000.000">Rp. 9,000,000 - Rp. 10,000,000</option>
								    </select>
								    </div>
							    </div>
							    <div class="form-group">
								    <div class="controls">
								    <select name="provinsi" class="form-control">
									    <option value="">... Provinsi ...</option>
									    <option value="Nanggro Aceh Darussalam">Nanggro Aceh Darussalam</option>
									    <option value="Sumatera Utara">Sumatera Utara</option>
									    <option value="Sumatera Barat">Sumatera Barat</option>
                                        <option value="Jambi">Jambi</option>
                                        <option value="Bengkulu">Bengkulu</option>
                                        <option value="Riau">Riau</option>
                                        <option value="Riau Kepulauan">Riau Kepulauan</option>
                                        <option value="Sumatera Selatan">Sumatera Selatan</option>
                                        <option value="Bangka Belitung">Bangka Belitung</option>
                                        <option value="Lampung">Lampung</option>
                                        <option value="Banten">Banten</option>
                                        <option value="D.K.I Jakarta">D.K.I Jakarta</option>
                                        <option value="Jawa Barat">Jawa Barat</option>
                                        <option value="Jawa Tengah">Jawa Tengah</option>
                                        <option value="D.I Yogyakarta">D.I Yogyakarta</option>
                                        <option value="Bali">Bali</option>
                                        <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                        <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                                        <option value="Kalimantan Barat">Kalimantan Barat</option>
                                        <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                                        <option value="Kalimantan Timur">Kalimantan Timur</option>
                                        <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                                        <option value="Sulawesi Utara">Sulawesi Utara</option>
                                        <option value="Sulawesi Barat">Sulawesi Barat</option>
                                        <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                                        <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                        <option value="Gorontalo">Gorontalo</option>
                                        <option value="Maluku">Maluku</option>
                                        <option value="Maluku Utara">Maluku Utara</option>
                                        <option value="Papua Barat">Papua Barat</option>
                                        <option value="Papua Tengah">Papua Tengah</option>
                                        <option value="Papua Timur">Papua Timur</option>                                        
								    </select>
								    </div>
							    </div>
							    <div class="form-group">
								    <div class="controls">
								    <input type="text" class="nama" placeholder="Posisi" name="posisi" />
								    </div>
							    </div>
						    
							   	<button type="submit" id="submit" class="btn-system btn-medium btn-block">Cari Lowongan</button>
							   </form>
						</div>
					</div>
					<!--End sidebar-->
					
					
					<!-- Start Blog Posts -->
					<div class="col-md-8 blog-box">
						<?php
							if($loadLowongan!=''){
								foreach($loadLowongan as $lowongan){
						?>
						<!-- Start Post -->
						<div class="blog-post standard-post">
							<!-- Post Content -->
							<div class="post-content">
								<div class="post-type"><i class="fa fa-globe"></i></div>
								<?php
									if($lowongan->logo!=''){
								?>
									<img class="img-content" src="<?php echo base_url('assets/upload/img/'.$lowongan->logo); ?>" />
								<?php
									}
								?>
								<h2 style="font-size: 14pt;"><a href="<?php echo base_url('lowongan/detailLowongan/'.$lowongan->id_lowongan) ?>"><?php echo $lowongan->nm_lowongan; ?></a></h2>

								<ul class="post-meta">
									<li><a href="#"><i class="fa fa-laptop"></i>&nbsp; <?php echo $lowongan->nm_perusahaan; ?></a></li>
									<li><font style="font-family: raleway"><i class="fa fa-map-marker"></i>&nbsp; <?php echo $lowongan->kota.", ".$lowongan->provinsi; ?></font></li>
								</ul>
								<p><?php echo isiSingkat($lowongan->kualifikasi); ?></p>
								<ul class="post-meta">
									<li><font style="font-family: raleway"><?php echo $lowongan->nm_k_lowongan; ?></font></li>
									<li><a href="#"><i class="fa fa-dollar"></i>&nbsp; 
										<?php 
											if(($this->session->userdata('id_login')!=''||$this->session->userdata('id_login')!=null)){
										 		echo $lowongan->gaji;
											}else{
												echo "Login untuk Melihat Gaji";
											}
										?>
									</a></li>
									<li><font style="font-family: raleway"><i class="fa fa-clock-o"></i>&nbsp; <?php echo tgl_indo($lowongan->date_post)." - ".tgl_indo($lowongan->date_close); ?></font></li>
								</ul>
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
					<!-- End Blog Posts -->
					
					
				</div>
			</div>
		</div>
		<!-- End Content -->