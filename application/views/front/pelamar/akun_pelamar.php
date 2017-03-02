<?php
	if(isset($row['jk'])? $row['jk']:''=='Laki-laki'){
		$jkSelect="Laki-laki";
	}elseif(isset($row['jk'])? $row['jk']:''=='Perempuan'){
		$jkSelect="Perempuan";
	}else{
		$jkSelect="";
	}
	$jk=array(
			''			=> '...',
			'Laki-laki'	=> 'Laki-laki',
			'Perempuan'	=> 'Perempuan',
		);

	if(isset($row['agama'])? $row['agama']:''=='Islam'){
		$agamaSelect="Islam";
	}else
	if(isset($row['agama'])? $row['agama']:''=='Kristen-Katolik'){
		$agamaSelect="Kristen-Katolik";
	}else
	if(isset($row['agama'])? $row['agama']:''=='Kristen-Protestan'){
		$agamaSelect="Kristen-Protestan";
	}else
	if(isset($row['agama'])? $row['agama']:''=='Hindu'){
		$agamaSelect="Hindu";
	}else
	if(isset($row['agama'])? $row['agama']:''=='Budha'){
		$agamaSelect="Budha";
	}else
	if(isset($row['agama'])? $row['agama']:''=='Konguchu'){
		$agamaSelect="Konguchu";
	}else{
		$agamaSelect="";
	}
	$agama=array(
			''					=> '...',
			'Islam'				=> 'Islam',
			'Kristen-Katolik'	=> 'Kristen - Katolik',
			'Kristen-Protestan'	=> 'Kristen - Protestan',
			'Hindu'				=> 'Hindu',
			'Budha'				=> 'Budha',
			'Konguchu'			=> 'Konguchu',
		);

	if(isset($row['pendidikan'])? $row['pendidikan']:''=='SMA/SMK Sederajat'){
		$pendSelect="SMA/SMK Sederajat";
	}else
	if(isset($row['pendidikan'])? $row['pendidikan']:''=='Akademi'){
		$pendSelect="Akademi";
	}else
	if(isset($row['pendidikan'])? $row['pendidikan']:''=='Sarjana'){
		$pendSelect="Sarjana";
	}else
	if(isset($row['pendidikan'])? $row['pendidikan']:''=='Pasca Sarjana'){
		$pendSelect="Pasca Sarjana";
	}else
	if(isset($row['pendidikan'])? $row['pendidikan']:''=='Doctor'){
		$pendSelect="Doctor";
	}else{
		$pendSelect="";
	}
	$pendidikan = array(
			''					=>'...',
			'SMA/SMK Sederajat'	=>'SMA/SMK Sederajat',
			'Akademi'			=>'Akademi',
			'Sarjana'			=>'Sarjana',
			'Pasca Sarjana'		=>'Pasca Sarjana',
			'Doctor'			=>'Doctor',
		);

	if(isset($row['sts_kawin'])? $row['sts_kawin']:''=='Belum Menikah'){
		$sts_kawinSelect="Belum Menikah";
	}elseif(isset($row['sts_kawin'])? $row['sts_kawin']:''=='Menikah'){
		$sts_kawinSelect="Menikah";
	}elseif(isset($row['sts_kawin'])? $row['sts_kawin']:''=='Cerai'){
		$sts_kawinSelect="Cerai";
	}else{
		$sts_kawinSelect="";
	}
	$sts_kawin=array(
			''			=> '...',
			'Belum Menikah'	=> 'Belum Menikah',
			'Menikah'	=> 'Menikah',
			'Cerai'	=> 'Cerai',
		);
?>

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
						<h2>Selamat Datang di <strong class="accent-color">Halaman Pribadi Anda</strong></h2>
					</div>
					<div class="col-md-4">
						<ul class="breadcrumbs">
							<li><a href="<?php echo base_url(''); ?>">Beranda</a></li>
							<li>Akun Pribadi</li>
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
                                <h4><span><?php echo isset($row['nm_pelamar'])? $row['nm_pelamar']:''; ?></span></h4>
                                <?php
									if(isset($row['foto'])? $row['foto']:''!=''){
								?>
									<p class="align-center">
                                		<img src="<?php echo base_url('assets/upload/img/'.$row['foto']) ?>" class="img-responsive" width="100%" />
                                	</p>
								<?php
									}
								?>
                                <h4><span>Cari Lowongan Segera di Sini</span></h4>
                                <div class="call-action bg-canvas clearfix">
                                    <div class="align-center" style="margin:20px 0; padding: 0 20px;"><a href="<?php echo base_url('lowongan'); ?>" style="color: #fff;" class="btn btn-system btn-medium btn-block"><i class="fa fa-search"></i>&nbsp;&nbsp; Cari Lowongan</a></div>
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
					
					<!-- Page Content -->
					<div class="col-md-9 page-content">
						
						<div class="tabs-section">
							
							<!-- Nav Tabs -->
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-user"></i>Profil Anda</a></li>
								<li><a href="#tab-2" data-toggle="tab"><i class="fa fa-globe"></i>Lihat Semua Lamaran <span class="label label-success"><?php echo $this->fronModel->showNumRowsById('job_lamar', array('id_pelamar'=>$this->session->userdata('id_login'))); ?></span></a></li>
								<li><a href="#tab-3" data-toggle="tab"><i class="fa fa-calendar"></i>Jadwal Panggilan<span class="label label-warning"><?php echo $this->fronModel->showNumRowsById('job_lamar', array('id_pelamar'=>$this->session->userdata('id_login'), 'sts_lamar'=>1)); ?></span></a></li>
								<li><a href="#tab-4" data-toggle="tab"><i class="fa fa-cog"></i>Lanjutan</a></li>
								<li><a href="#tab-5" data-toggle="tab"><i class="fa fa-lock"></i>Kata Sandi</span></a></li>
								
							</ul>
							
							<!-- Tab panels -->
							<div class="tab-content">

								<!-- Tab Content 1 -->
								<div class="tab-pane fade in active" id="tab-1">
									<h4 class="classic-title">Profil Anda &nbsp;&nbsp;<a href="#tab-6" data-toggle="tab" title="Edit Data"><i class="fa fa-pencil-square"></i></a></h4>
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
											<h5>Foto</h5>
										</div>
										<div class="col-md-9">
											<div class="row">
												<div class="col-md-6">
													<?php
														if(isset($row['foto'])? $row['foto']:''!=''){
													?>
														<img src="<?php echo base_url('assets/upload/img/'.$row['foto']) ?>" />
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
											<h5>Nama Lengkap</h5>
										</div>
										<div class="col-md-9 margin-30">
											<h5><?php echo isset($row['nm_pelamar'])? $row['nm_pelamar']:'';?></h5>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5>No KTP</h5>
										</div>
										<div class="col-md-9 margin-30">
											<h5><?php echo isset($row['no_ktp'])? $row['no_ktp']:'';?></h5>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5>Tempat Tanggal Lahir</h5>
										</div>
										<div class="col-md-9 margin-30">
											<h5><?php echo isset($row['tmp_lhr'])? $row['tmp_lhr']:''; echo ", "; echo isset($row['tanggalLahir'])? $row['tanggalLahir']:''; ?></h5>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5>Jenis Kelamin, Agama</h5>
										</div>
										<div class="col-md-9 margin-30">
											<h5><?php echo isset($row['jk'])? $row['jk']:''; echo ", "; echo isset($row['agama'])? $row['agama']:''; ?></h5>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5>Pendidikan</h5>
										</div>
										<div class="col-md-9 margin-30">
											<h5><?php echo isset($row['pendidikan'])? $row['pendidikan']:'';?></h5>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5>Deskripsi Diri Anda</h5>
										</div>
										<div class="col-md-9 margin-30">
											<h5><?php echo isset($row['deskripsi'])? $row['deskripsi']:'';?></h5>
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
											<h5>Kota</h5>
										</div>
										<div class="col-md-9 margin-30">
											<h5><?php echo isset($row['kota'])? $row['kota']:''; echo ', '; echo isset($row['kodepos'])? $row['kodepos']:''; ?></h5>
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
											<h5>Email</h5>
										</div>
										<div class="col-md-9 margin-30">
											<h5><?php echo isset($row['email'])? $row['email']:'';?></h5>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5>Status Kawin</h5>
										</div>
										<div class="col-md-9 margin-30">
											<h5><?php echo isset($row['sts_kawin'])? $row['sts_kawin']:'';?></h5>
										</div>
									</div>
								</div>

								<div class="tab-pane pad" id="tab-6">
									<form role="form" class="contact-form form-style" id="contact-form" method="POST" action="<?php echo base_url('pelamar/prosesEditProfil'); ?>" enctype="multipart/form-data">
									<h4 class="classic-title"><a href="#tab-1" data-toggle="tab" title="Kembali"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp; Edit Profil Anda</a></h4>
									<div class="row">
										<div class="col-md-3">
											<h5>Foto</h5>
										</div>
										<div class="col-md-9">
											<?php if(isset($row['foto'])? $row['foto']:''!=''){?>
											<input type="file" name="file" /><small>Max Size 1MB || Format .jpg|.png|.gif|.jpeg</small>
											<?php }else{ ?>
											<input type="file" name="file" required/><small>Max Size 1MB || Format .jpg|.png|.gif|.jpeg</small>
											<?php } ?>
										</div>
									</div>
									<div class="hr1 margin-30"></div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5 style="font-size: 11pt; margin: 7px 0;">Nama Lengkap</h5>
										</div>
										<div class="col-md-9 margin-30">
											<div class="form-group">
		                                        <div class="controls">
		                                            <input type="text" placeholder="Nama Anda" value="<?php echo isset($row['nm_pelamar'])? $row['nm_pelamar']:'';?>" name="nm_pelamar" required/>
		                                        </div>
		                                    </div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5 style="font-size: 11pt; margin: 7px 0;">No KTP</h5>
										</div>
										<div class="col-md-9 margin-30">
											<div class="form-group">
		                                        <div class="controls">
		                                            <input type="number" placeholder="Nomor KTP" value="<?php echo isset($row['no_ktp'])? $row['no_ktp']:'';?>" name="no_ktp" required/>
		                                        </div>
		                                    </div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5 style="font-size: 11pt; margin: 7px 0;">Tempat Tanggal Lahir</h5>
										</div>
										<div class="col-md-9 margin-30">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
				                                        <div class="controls">
				                                            <input type="text" placeholder="Tempat Lahir" value="<?php echo isset($row['tmp_lhr'])? $row['tmp_lhr']:'';?>" name="tmp_lhr" required/>
				                                        </div>
				                                    </div>
				                                </div>
				                                <div class="col-md-6">
													<div class="form-group">
				                                        <div class="controls">
				                                            <input type="text" placeholder="Tanggal Lahir" value="<?php echo isset($row['tgl_lhr'])? $row['tgl_lhr']:'';?>" name="tgl_lhr" id="tgl_lhr" required/>
				                                        </div>
				                                    </div>
				                                </div>
				                            </div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5 style="font-size: 11pt; margin: 7px 0;">Jenis Kelamin, Agama</h5>
										</div>
										<div class="col-md-9 margin-30">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
				                                        <div class="controls">
				                                        	<?php echo form_dropdown('jk', $jk, $jkSelect); ?>
				                                        </div>
				                                    </div>
				                                </div>
				                                <div class="col-md-6">
													<div class="form-group">
				                                        <div class="controls">
				                                            <?php echo form_dropdown('agama', $agama, $agamaSelect); ?>
				                                        </div>
				                                    </div>
				                                </div>
				                            </div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5 style="font-size: 11pt; margin: 7px 0;">Pendidikan</h5>
										</div>
										<div class="col-md-9 margin-30">
											<div class="form-group">
		                                        <div class="controls">
		                                            <?php echo form_dropdown('pendidikan', $pendidikan, $pendSelect); ?>
		                                        </div>
		                                    </div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5 style="font-size: 11pt; margin: 7px 0;">Deskripsikan Diri Anda</h5>
										</div>
										<div class="col-md-9 margin-30">
											<div class="form-group">
		                                        <div class="controls">
		                                            <textarea placeholder="Deskripsi diri Anda" id="deskripsi" name="deskripsi" required><?php echo isset($row['deskripsi'])? $row['deskripsi']:''; ?></textarea>
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
		                                            <textarea placeholder="Alamat Lengkap Anda" name="alamat" required><?php echo isset($row['alamat'])? $row['alamat']:''; ?></textarea>
		                                        </div>
		                                    </div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5 style="font-size: 11pt; margin: 7px 0;">Kota, Kode Pos</h5>
										</div>
										<div class="col-md-9 margin-30">
											<div class="row">
												<div class="col-md-8">
													<div class="form-group">
				                                        <div class="controls">
				                                            <input type="text" placeholder="Kota" value="<?php echo isset($row['kota'])? $row['kota']:'';?>" name="kota" required/>
				                                        </div>
				                                    </div>
				                                </div>
				                                <div class="col-md-4">
													<div class="form-group">
				                                        <div class="controls">
				                                            <input type="number" placeholder="Kode Pos" value="<?php echo isset($row['kodepos'])? $row['kodepos']:'';?>" name="kodepos" required/>
				                                        </div>
				                                    </div>
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
		                                            <input type="text" placeholder="No Telp Max 12 Angka" value="<?php echo isset($row['no_telp'])? $row['no_telp']:'';?>" name="no_telp" required/>
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
		                                            <input type="email" class="email" placeholder="someone@domain.com" value="<?php echo isset($row['email'])? $row['email']:'';?>" name="email" required readonly="true"/>
		                                        </div>
		                                    </div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 margin-30">
											<h5 style="font-size: 11pt; margin: 7px 0;">Status Perkawinan</h5>
										</div>
										<div class="col-md-9 margin-30">
											<div class="form-group">
		                                        <div class="controls">
		                                        	<?php echo form_dropdown('sts_kawin', $sts_kawin, $sts_kawinSelect); ?>
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
									<h4 class="classic-title"><i class="fa fa-bars"></i>&nbsp;&nbsp;Daftar Lamaran Online Anda</h4>
									<table id="example" class="table table-bordered table-strip table-responsive">
										<thead>
											<tr>
												<th width="4%">No</th>
						                        <th>Lowongan</th>
						                        <th width="10%">Logo</th>
						                        <th>Jml Pelamar</th>
						                        <th>Status</th>
						                        <th>Tgl Melamar</th>
						                        <th>Jawaban</th>
						                    </tr>
										</thead>
										<tbody>
											<?php
												$no=1;
												if($loadLamaran!=''){
													foreach($loadLamaran as $dataLamaran){
											?>
											<tr>
												<td align="center"><?php echo $no++; ?></td>
												<td align="center"><?php echo $dataLamaran->nm_k_lowongan."<br>(".$dataLamaran->nm_lowongan.")"; ?></td>
												<td align="center"><?php if($dataLamaran->logo!='' || $dataLamaran->logo!=null){ ?><img src="<?php echo base_url('assets/upload/img/'.$dataLamaran->logo);?>" width="100%" /><br><?php }  echo $dataLamaran->nm_perusahaan; ?></td>
												<td align="center"><?php echo $this->fronModel->showNumRowsById('job_lamar', array('id_lowongan'=>$dataLamaran->id_lowongan));?></td>
												<td align="center"><?php if(date('Y-m-d') >= $dataLamaran->date_limit){echo "Lamaran sudah Tutup";}else{echo "Tutup Tgl<br>".tgl_indo($dataLamaran->date_limit);} ?></td>
												<td align="center"><?php echo tgl_indo_time($dataLamaran->tgl_create); ?></td>
												<td align="center">
													<?php
						                              if($dataLamaran->sts_lamar==1){
						                                echo "<span class='label label-success' title='Datang ke Alamat ".$dataLamaran->almt_datang.", Tanggal ".tgl_indo_time1($dataLamaran->tgl_create)."'>SEGERA DATANG</span>";
						                              }elseif($dataLamaran->sts_lamar==0){
						                                echo "<span class='label label-danger' title='Menunggu Konfirmasi dari Perusahaan'>MENUNGGU</span>";
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
									<h4 class="classic-title"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Jadwal Panggilan</h4>
									<table id="example1" class="table table-bordered table-strip table-responsive">
										<thead>
											<tr>
												<th width="4%">No</th>
						                        <th width="4%">Perusahaan</th>
						                        <th width="4%">No Telp</th>
						                        <th width="4%">Lowongan</th>
												<th width="10%">Tgl Datang</th>
												<th align="center" width="8%">Jam Datang</th>
												<th width="10%">Keterangan Alamat</th>
						                      </tr>
										</thead>
										<tbody>
											<?php
												$no=1;
												if($loadJadwal!=''){
													foreach($loadJadwal as $dataJadwal){
											?>
											<tr>
												<td align="center"><?php echo $no++; ?></td>
												<td align="center">
													<?php 
														if($dataJadwal->logo!=''){
													?>
														<img src="<?php echo base_url('assets/upload/img/'.$dataJadwal->logo) ?>" width="100px" /><br>
													<?php }
														echo $dataJadwal->nm_perusahaan; 
													?>

												</td>
												<td align="center"><?php echo $dataJadwal->no_telp; ?></td>
												<td align="center"><?php echo $dataJadwal->nm_lowongan; ?></td>
												<td align="center"><b><?php echo tgl_indo($dataJadwal->tgl_datang); ?></b></td>
												<td align="center"><b><?php echo $dataJadwal->jam_datang; ?></b></td>
												<td align="center"><b><?php echo $dataJadwal->almt_datang; ?></b></td>
											</tr>
											<?php } } ?>
										</tbody>
									</table>
								</div>
								
								<div class="tab-pane fade" id="tab-4">
									<h4 class="classic-title"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Passion <a href="#tab-tambah-passion" data-toggle="tab" title="Tambah Data"><i class="fa fa-plus-square"></i></a></h4>
									<table id="example1" class="table table-bordered table-strip table-responsive">
										<thead>
											<tr>
						                        <th>Passion</th>
												<th width="15%">Action</th>
						                    </tr>
										</thead>
										<tbody>
											<?php foreach($passions as $passion) : ?>
											<tr>
												<td><?php echo $passion->name ?></td>
												<td align="center">
													<a href="<?php echo base_url('pelamar/deletePassion/'.$passion->id) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
								
								<div class="tab-pane fade" id="tab-tambah-passion">
									<h4 class="classic-title"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Tambah Passion <a href="#tab-4" data-toggle="tab" title="Tambah Data"><i class="fa fa-arrow-left"></i></a></h4>
									<form class="contact-form form-style" method="post" action="<?php echo base_url('pelamar/addPassion'); ?>">
									<div class="row">
										<div class="col-md-3">
											<h5>Passions</h5>
										</div>
										<div class="col-md-9">
											<div class="form-group">
												<?php foreach($this->fronModel->show('job_k_lowongan', 'nm_k_lowongan', 'ASC') as $passion): ?>
		                                        <div class="controls">
		                                            <input id="passion_<?php echo $passion->id_k_low ?>" type="checkbox" name="passion[]" value="<?php echo $passion->id_k_low ?>"/>
													<label for="passion_<?php echo $passion->id_k_low ?>"><?php echo $passion->nm_k_lowongan ?></label>
		                                        </div>
												<?php endforeach; ?>
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
		                                            <button type="submit" name="submit" name="submit" class="btn btn-system btn-medium"><i class="fa fa-save"></i>&nbsp;&nbsp; Simpan</button>
		                                        </div>
		                                    </div>
										</div>
									</div>
									</form>
								</div>
								<!-- Tab Content 5 -->
								<div class="tab-pane fade" id="tab-5">
									<form class="contact-form form-style" id="contact-form" method="post" action="<?php echo base_url('pelamar/prosesEditPassword'); ?>">
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
        $("#deskripsi").wysihtml5();
        $("#kualifikasi").wysihtml5();
        $("#benefit").wysihtml5();
      });
    </script> 
    <script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.date.extensions.js')?>" type="text/javascript"></script>
<script>
$(function () {
        //Datemask dd/mm/yyyy
        $("#tgl_lhr").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
        $("#date_close").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
});
  

</script>
