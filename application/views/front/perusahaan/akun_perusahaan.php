<!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
   
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $('#example').dataTable({
        });
        $('#example1').dataTable({
        });
      });
    </script>
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

<!-- Start Page Banner -->
		<div class="page-banner no-subtitle">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h2>Selamat Datang di <strong class="accent-color">Halaman Pribadi Perusahaan</strong></h2>
					</div>
					<div class="col-md-4">
						<ul class="breadcrumbs">
							<li><a href="<?php echo base_url(''); ?>">Beranda</a></li>
							<li>Akun Perusahaan</li>
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
				$this->load->helper('fungsi_date');
				$this->load->model('fronModel');
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
				<div class="row sidebar-page">

					<!--Sidebar-->
					<div class="col-md-3 sidebar left-sidebar">
                        <div class="hr1 margin-30"></div>
						<div class="project-page row">
					                            <!-- Start Single Project Slider -->
                            <div class="project-content col-md-12">
                                <h4><span><?php echo isset($row['nm_perusahaan'])? $row['nm_perusahaan']:''; ?></span></h4>
                                <?php
									if(isset($row['logo'])? $row['logo']:''!=''){
								?>
									<p class="align-center">
                                		<img src="<?php echo base_url('assets/upload/img/'.$row['logo']) ?>" class="img-responsive" width="100%" />
                                	</p>
								<?php
									}
								?>
                                <h4><span>Pasang Iklan Segera</span></h4>
                                <div class="call-action bg-canvas clearfix">
                                    <div class="align-center" style="margin:20px 0; padding: 0 20px;"><a target="_TAB" href="<?php echo base_url('company/tambahIklan'); ?>" style="color: #fff;" class="btn btn-system btn-medium btn-block"><i class="fa fa-plus-square"></i>&nbsp;&nbsp; Pasang Iklan</a></div>
                                </div>
                                <br>
                                <h4><span>Detail 5 Konfirmasi Pembayaran</span></h4>
                                <table class="table table-bordered table-strip table-responsive">
                                	<tr>
                                		<th class="align-center">
                                			ID Aktivasi
                                		</th>
										<th class="align-center">
                                			ID Lowongan
                                		</th>

                                		<th style="width:5%;" class="align-center">
                                			Aksi
                                		</th>
                                	</tr>
                                	<?php 
                                		if($loadKonfirmasi!=''){
                                			foreach($loadKonfirmasi as $konfirmasi){
                                	?>
                                	<tr>
                                		<td align="center">
                                			<a href=""><?php echo $konfirmasi->id_aktivasi; ?></a>
                                		</td>
                                		<td align="center">
                                			<a href=""><?php echo $konfirmasi->id_lowongan; ?></a>
                                		</td>
                                		<td align="center">
                                			<a href="<?php echo base_url('company/pembayaran/'.$konfirmasi->id_lowongan.'/'.$konfirmasi->id_aktivasi);?>" title="Konfirmasi" class="btn btn-warning color-white padding-2"><small><i class="fa fa-external-link-square"></i></small></a>
                                		</td>
                                	</tr>
                                	<?php 
                                			}
                                		}else{
                                	?>
                                	<tr>
                                		<td colspan="3" align="center">Tidak Ada Konfirmasi Pembayaran</td>
                                	</tr>
                                	<?php } ?>
                                	<tr>
                                </table>
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
					
					<!-- Page Content -->
					<div class="col-md-9 page-content">
						
						<div class="tabs-section">
							
							<!-- Nav Tabs -->
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-desktop"></i>Profil Perusahaan</a></li>
								<li><a href="#tab-2" data-toggle="tab"><i class="fa fa-globe"></i>Iklan Lowongan Anda <span class="label label-success"><?php echo $this->fronModel->showNumRowsById('job_lowongan', array('id_perusahaan'=>$this->session->userdata('id_login'))); ?></span></a></li>
								<li><a href="#tab-3" data-toggle="tab"><i class="fa fa-dollar"></i>Konfirmasi Pembayaran <span class="label label-warning"><?php echo $this->fronModel->pembayaranNumRows(); ?></span></a></li>
								<!--<li><a href="#tab-4" data-toggle="tab"><i class="fa fa-plus-square"></i>Pasang Iklan</span></a></li>-->
								<li><a href="#tab-5" data-toggle="tab"><i class="fa fa-lock"></i>Kata Sandi</span></a></li>
							</ul>
							
							<!-- Tab panels -->
							<div class="tab-content">

								<!-- Tab Content 1 -->
								<div class="tab-pane fade in active" id="tab-1">
									<h4 class="classic-title">Deskripsi Tentang Perusahaan &nbsp;&nbsp;<a href="#tab-6" data-toggle="tab" title="Edit Data"><i class="fa fa-pencil-square"></i></a></h4>
									<div class="row">
										<div class="col-md-3">
											<h5>ID</h5>
										</div>
										<div class="col-md-9">
											<h5><b><?php echo $this->session->userdata('id_login');?></b></h5>
										</div>
									</div>
									<div class="hr1 margin-30"></div>
									<div class="row">
										<div class="col-md-3">
											<h5>Logo</h5>
										</div>
										<div class="col-md-9">
											<div class="row">
												<div class="col-md-6">
													<?php
														if(isset($row['logo'])? $row['logo']:''!=''){
													?>
														<img src="<?php echo base_url('assets/upload/img/'.$row['logo']) ?>" />
													<?php
														}
													?>
												</div>
												<div class="col-md-6">
												</div>
											</div>
										</div>
									</div>
									<div class="hr1 margin-30"></div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5>Nama Perusahaan</h5>
										</div>
										<div class="col-md-9 margin-30">
											<h5><?php echo isset($row['nm_perusahaan'])? $row['nm_perusahaan']:'';?></h5>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5>No Izin</h5>
										</div>
										<div class="col-md-9 margin-30">
											<h5><?php echo isset($row['no_izin'])? $row['no_izin']:'';?></h5>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5>Tentang Perusahaan</h5>
										</div>
										<div class="col-md-9 margin-30">
											<h5><?php echo isset($row['tentang'])? $row['tentang']:'';?></h5>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5>Alamat</h5>
										</div>
										<div class="col-md-9 margin-30">
											<h5><?php echo isset($row['alamat'])? $row['alamat']:'';?></h5>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5>No Telp</h5>
										</div>
										<div class="col-md-9 margin-30">
											<h5><?php echo isset($row['no_telp'])? $row['no_telp']:'';?></h5>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5>No Fax</h5>
										</div>
										<div class="col-md-9 margin-30">
											<h5><?php echo isset($row['no_fax'])? $row['no_fax']:'';?></h5>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5>Email</h5>
										</div>
										<div class="col-md-9 margin-30">
											<h5><?php echo isset($row['email'])? $row['email']:'';?></h5>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5>Alamat Web</h5>
										</div>
										<div class="col-md-9 margin-30">
											<h5><?php echo isset($row['web_url'])? $row['web_url']:'';?></h5>
										</div>
									</div>
								</div>

								<div class="tab-pane pad" id="tab-6">
									<form role="form" class="contact-form form-style" id="contact-form" method="POST" action="<?php echo base_url('company/prosesEditProfil'); ?>" enctype="multipart/form-data">
									<h4 class="classic-title"><a href="#tab-1" data-toggle="tab" title="Kembali"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp; Edit Profil Perusahaan</a></h4>
									<div class="row">
										<div class="col-md-3">
											<h5>Logo</h5>
										</div>
										<div class="col-md-9">
											<?php if(isset($row['logo'])? $row['logo']:''!=''){?>
											<input type="file" name="file" /><small>Max Size 1MB || Format .jpg|.png|.gif|.jpeg</small>
											<?php }else{ ?>
											<input type="file" name="file" required/><small>Max Size 1MB || Format .jpg|.png|.gif|.jpeg</small>
											<?php } ?>
										</div>
									</div>
									<div class="hr1 margin-30"></div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5 style="font-size: 11pt; margin: 7px 0;">Nama Perusahaan</h5>
										</div>
										<div class="col-md-9 margin-30">
											<div class="form-group">
		                                        <div class="controls">
		                                            <input type="text" placeholder="Nama Perusahaan" value="<?php echo isset($row['nm_perusahaan'])? $row['nm_perusahaan']:'';?>" name="nm_perusahaan" required/>
		                                        </div>
		                                    </div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5 style="font-size: 11pt; margin: 7px 0;">No Izin</h5>
										</div>
										<div class="col-md-9 margin-30">
											<div class="form-group">
		                                        <div class="controls">
		                                            <input type="text" placeholder="Nomor Izin Perusahaan" value="<?php echo isset($row['no_izin'])? $row['no_izin']:'';?>" name="no_izin" required/>
		                                        </div>
		                                    </div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5 style="font-size: 11pt; margin: 7px 0;">Tentang Perusahaan</h5>
										</div>
										<div class="col-md-9 margin-30">
											<div class="form-group">
		                                        <div class="controls">
		                                            <textarea placeholder="Tentang Perusahaan" id="tentang" name="tentang" required><?php echo isset($row['tentang'])? $row['tentang']:''; ?></textarea>
		                                        </div>
		                                    </div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5 style="font-size: 11pt; margin: 7px 0;">Alamat</h5>
										</div>
										<div class="col-md-9 margin-30">
											<div class="form-group">
		                                        <div class="controls">
		                                            <textarea placeholder="Alamat Perusahaan" name="alamat" required><?php echo isset($row['alamat'])? $row['alamat']:''; ?></textarea>
		                                        </div>
		                                    </div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5 style="font-size: 11pt; margin: 7px 0;">No Telp</h5>
										</div>
										<div class="col-md-9 margin-30">
											<div class="form-group">
		                                        <div class="controls">
		                                            <input type="number" placeholder="" value="<?php echo isset($row['no_telp'])? $row['no_telp']:'';?>" name="no_telp" required/>
		                                        </div>
		                                    </div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5 style="font-size: 11pt; margin: 7px 0;">No Fax</h5>
										</div>
										<div class="col-md-9 margin-30">
											<div class="form-group">
		                                        <div class="controls">
		                                            <input type="number" placeholder="" value="<?php echo isset($row['no_fax'])? $row['no_fax']:'';?>" name="no_fax" required/>
		                                        </div>
		                                    </div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5 style="font-size: 11pt; margin: 7px 0;">Email</h5>
										</div>
										<div class="col-md-9 margin-30">
											<div class="form-group">
		                                        <div class="controls">
		                                            <input type="email" class="email" placeholder="someone@domain.com" value="<?php echo isset($row['email'])? $row['email']:'';?>" name="email" required/>
		                                        </div>
		                                    </div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5 style="font-size: 11pt; margin: 7px 0;">Alamat Web</h5>
										</div>
										<div class="col-md-9 margin-30">
											<div class="form-group">
		                                        <div class="controls">
		                                            <input type="text" placeholder="www.domain.com" value="<?php echo isset($row['web_url'])? $row['web_url']:'';?>" name="web_url" required/>
		                                        </div>
		                                    </div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
										</div>
										<div class="col-md-9 margin-30">
											<div class="form-group">
		                                        <div class="controls">
		                                            <button type="submit" name="submit" class="btn btn-system btn-medium"><i class="fa fa-save"></i>&nbsp;&nbsp; Edit Profil</button>
		                                        </div>
		                                    </div>
										</div>
									</div>
									</form>
								</div>
								<!-- Tab Content 2 -->
								<div class="tab-pane fade" id="tab-2">
									<h4 class="classic-title"><i class="fa fa-bars"></i>&nbsp;&nbsp;Daftar Iklan Loker Anda &nbsp;&nbsp;<a href="<?php echo base_url('company/tambahIklan'); ?>" title="Pasang Iklan Lowongan"><i class="fa fa-plus-square"></i></a>&nbsp;&nbsp; <a href="" title="Refresh Data"><i class="fa fa-refresh"></i></a></h4>
									<table id="example" class="table table-bordered table-strip table-responsive">
										<thead>
											<tr>
												<th rowspan="2" width="4%">No</th>
						                        <th rowspan="2" width="4%">ID</th>
						                        <th rowspan="2" width="20%">Lowongan</th>
						                        <th rowspan="2" width="3%">Jml Pelamar</th>
						                        <th colspan="2" align="center" width="17%">Limit</th>
						                        <th rowspan="2" width="8%">Status</th>
						                      </tr>
						                      <tr>
						                        <th width="10%">Tgl</th>
						                        <th width="7%">Selisih</th>
						                      </tr>
										</thead>
										<tbody>
											<?php
												$no=1;
												if($loadLowongan!=''){
													foreach($loadLowongan as $dataLowongan){
											?>
											<tr>
												<td align="center"><?php echo $no++; ?></td>
												<td align="center"><a target="_TAB" href="<?php echo base_url('company/detailIklan/'.$dataLowongan->id_lowongan); ?>"><?php echo $dataLowongan->id_lowongan; ?></a></td>
												<td align="center"><?php echo $dataLowongan->nm_lowongan; ?></td>
												<td align="center"><?php echo $this->fronModel->showNumRowsById('job_lamar', array('id_lowongan'=>$dataLowongan->id_lowongan));?></td>
												<td align="center"><?php echo tgl_indo($dataLowongan->date_limit); ?></td>
												<td align="center">
													<b>
													<?php 
                              							$cek = $this->fronModel->showById('job_aktivasi', array('id_lowongan'=>$dataLowongan->id_lowongan));
                              							echo $this->fronModel->setSelisihTgl(date('Y-m-d'), $cek->date_limit);
                            						?> Hari
                            						</b>
                            					</td>
												<td align="center">
													<?php
						                              if($dataLowongan->aktif==1){
						                                echo "<span class='label label-success'>TAYANG</span>";
						                              }elseif($dataLowongan->aktif==2){
						                                echo "<span class='label label-warning' title='Lihat Konfirmasi Pembayaran'>PERPANJANG</span>";
						                              }elseif($dataLowongan->aktif==0){
						                                echo "<span class='label label-danger'>TIDAK TAYANG</span>";                                
						                              }elseif($dataLowongan->aktif==3){
						                                if($dataLowongan->status==0){
						                                  echo "<span class='label label-warning' title='Lihat Konfirmasi Pembayaran'>KONFIRMASI</span>";
						                                }elseif($dataLowongan->status==1){
						                                  echo "<span class='label label-warning' title='Tunggu Proses dari Admin'>PROSES</span>";
						                                }
						                              }
						                            ?>
												</td>
											</tr>
											<?php
													}
												}
											?>
										</tbody>
									</table>
								</div>
								<!-- Tab Content 3 -->
								<div class="tab-pane fade" id="tab-3">
									<h4 class="classic-title"><i class="fa fa-bars"></i>&nbsp;&nbsp;Daftar yang harus di Bayar</h4>
									<table id="example1" class="table table-bordered table-strip table-responsive">
										<thead>
											<tr>
												<th width="4%">No</th>
						                        <th width="4%">ID Aktivasi</th>
						                        <th width="4%">ID Lowongan</th>
												<th width="5%">Gol</th>
												<th align="center" width="8%">Limit</th>
												<th width="10%">s/d Tgl</th>
												<th width="20%">Total</th>
												<th width="10%">Bayar</th>
						                        <th width="7%">Status</th>
						                      </tr>
										</thead>
										<tbody>
											<?php
												$no=1;
												if($loadLowongan!=''){
													foreach($loadLowongan as $dataLowongan){
											?>
											<tr>
												<td align="center"><?php echo $no++; ?></td>
												<td align="center">
													<?php if($dataLowongan->status==0){ ?>
														<a href="<?php echo base_url('company/pembayaran/'.$dataLowongan->id_lowongan.'/'.$dataLowongan->id_aktivasi); ?>">
															<?php echo $dataLowongan->id_aktivasi; ?>
														</a>
													<?php }elseif($dataLowongan->status==1 && $dataLowongan->aktif==2){ ?>
														<a href="<?php echo base_url('company/perpanjang/'.$dataLowongan->id_lowongan.'/'.$dataLowongan->id_aktivasi); ?>">
															<?php echo $dataLowongan->id_aktivasi; ?>
														</a>
													<?php } else{echo $dataLowongan->id_aktivasi; } ?>
													</td>
												<td align="center"><?php echo $dataLowongan->id_lowongan; ?></td>
												<td align="center">
													<?php 
						                              if($dataLowongan->id_golongan=="1"){
						                                echo "<span class='label ".$dataLowongan->kode."' data-toggle='tooltip' title='".$dataLowongan->rating."'>".$dataLowongan->nm_golongan."</span>";
						                              }elseif($dataLowongan->id_golongan=="2"){
						                                echo "<span class='label ".$dataLowongan->kode."' data-toggle='tooltip' title='".$dataLowongan->rating."'>".$dataLowongan->nm_golongan."</span>";
						                              }elseif($dataLowongan->id_golongan=="3"){
						                                echo "<span class='label ".$dataLowongan->kode."' data-toggle='tooltip' title='".$dataLowongan->rating."'>".$dataLowongan->nm_golongan."</span>";
						                              }

						                            ?>
												</td>
												<td align="center">
													<b>
													<?php 
                              							$cek = $this->fronModel->showById('job_aktivasi', array('id_lowongan'=>$dataLowongan->id_lowongan));
                              							echo $this->fronModel->setSelisihTgl(date('Y-m-d'), $cek->date_limit);
                            						?> Hari
                            						</b>
                            					</td>
												<td align="center"><?php echo tgl_indo($dataLowongan->date_limit); ?></td>
												<td align="center">Rp. <?php echo number_format($dataLowongan->harga, 0, ',', '.'); ?></td>
												<td align="center">
													<?php
						                              if($dataLowongan->status==1){
						                                echo "<a target='_BLANK' href='".base_url("company/cetakStrukLowongan/".$dataLowongan->id_aktivasi)."' data-toggle='tooltip' title='Sudah, Lihat Detail' class='label label-success'><i class='fa fa-check-square'></i></span>";
						                              }elseif($dataLowongan->status==0){
						                                echo "<span data-toggle='tooltip' title='Pending' class='label label-danger'><i class='fa fa-spinner'></i></span>";
						                              }
						                            ?>
												</td>
												<td align="center">
													<?php
						                              if($dataLowongan->aktif==1){
						                                echo "<span class='label label-success'>TAYANG</span>";
						                              }elseif($dataLowongan->aktif==2){
						                              ?>
															<a href='<?php echo base_url('company/perpanjang/'.$dataLowongan->id_lowongan.'/'.$dataLowongan->id_aktivasi); ?>'><span class='label label-warning'>PERPANJANG</span></a>
						                              <?php
						                              }elseif($dataLowongan->aktif==0){
						                                echo "<span class='label label-danger'>TIDAK TAYANG</span>";
						                              }elseif($dataLowongan->aktif==3){
						                                if($dataLowongan->status==0){
						                            ?>
						                                <a href='<?php echo base_url('company/pembayaran/'.$dataLowongan->id_lowongan.'/'.$dataLowongan->id_aktivasi); ?>'><span class='label label-warning'>KONFIRMASI</span></a>
						                            <?php
						                                }elseif($dataLowongan->status==1){
						                                  echo "<span class='label label-warning'>PROSES</span>";
						                                }
						                              }
						                            ?>
												</td>
											</tr>
											<?php
													}
												}
											?>
										</tbody>
									</table>
								</div>

								<!-- Tab Content 5 -->
								<div class="tab-pane fade" id="tab-5">
									<form class="contact-form form-style" id="contact-form" method="post" action="<?php echo base_url('company/prosesEditPassword'); ?>">
									<h4 class="classic-title"><i class="fa fa-lock"></i>&nbsp;&nbsp; Ubah Kata Sandi</h4>
									<div class="row">
										<div class="col-md-3">
											<h5>Password Lama</h5>
										</div>
										<div class="col-md-9">
											<div class="form-group">
		                                        <div class="controls">
		                                            <input type="password" placeholder="Password Lama" name="passlama" required/>
		                                        </div>
		                                    </div>
										</div>
									</div>
									<div class="hr1 margin-30"></div>
									<div class="row">
										<div class="col-md-3">
											<h5>Password Baru</h5>
										</div>
										<div class="col-md-9">
											<div class="form-group">
		                                        <div class="controls">
		                                            <input type="password" placeholder="Password Baru" name="passbaru" required/>
		                                        </div>
		                                    </div>
										</div>
									</div>
									<div class="hr1 margin-30"></div>
									<div class="row">
										<div class="col-md-3">
											<h5>Konfirmasi Password Baru</h5>
										</div>
										<div class="col-md-9">
											<div class="form-group">
		                                        <div class="controls">
		                                            <input type="password" placeholder="Konfirmasi Password Baru" name="konfpass" required/>
		                                        </div>
		                                    </div>
										</div>
									</div>
									<div class="hr1 margin-30"></div>
									<div class="row">
										<div class="col-md-3">
											
										</div>
										<div class="col-md-9">
											<div class="form-group">
		                                        <div class="controls">
		                                            <button type="submit" name="submit" class="btn btn-system btn-medium"><i class="fa fa-save"></i>&nbsp;&nbsp; Ubah Password</button>
		                                        </div>
		                                    </div>
										</div>
									</div>
									</form>
								</div>
							</div>
							<!-- End Tab Panels -->
							
						</div>
						</div>
						
					</div>
					<!-- End Page Content -->
					
				</div>
			</div>
		</div>
		<!-- End Content --><script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- Page Script -->
    <script>
      $(function () {
        //Add text editor
        $("#tentang").wysihtml5();
        $("#kualifikasi").wysihtml5();
        $("#benefit").wysihtml5();
      });
    </script> 
    <script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.date.extensions.js')?>" type="text/javascript"></script>
<script>
$(function () {
        //Datemask dd/mm/yyyy
        $("#date_post").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
        $("#date_close").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
});
  

</script>