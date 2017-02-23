<!-- Start Page Banner -->
		<div class="page-banner">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h2>Daftar untuk Pasang Iklan Lowongan Kerja</h2>
						<p>Silahkan isi Form yang telah kami sediakan</p>
					</div>
					<div class="col-md-4">
						<ul class="breadcrumbs">
							<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
							<li>Daftar Pasang Iklan</li>
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
                <div class="col-md-2"></div>
				<div class="col-md-8">
                    <div class="box box-danger">
                        <div class="box-header align-center">
                          <h4 class="box-title raleway padding-5" style="font-weight: normal;">Mendaftar Pemasangan Iklan</h4>
                        </div>
                        <div class="box-body">
                            <!-- Start daftar Form -->
                            <?php
                                echo form_open($formAction, array('class'=>'contact-form form-style', 'id'=>'contact-form'));
                            ?>
                            <div class="row">

                                <div class="col-md-3">
                                    <label class="raleway" style="font-size: 11pt; margin: 7px 0;">Nama Perusahaan <span class="accent-color" style="font-size: 15pt;">*</span></span>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <div class="controls">
                                            <input type="text" placeholder="Nama Perusahaan" name="nama" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label class="raleway" style="font-size: 11pt; margin: 7px 0;">Alamat Lengkap <span class="accent-color" style="font-size: 15pt;">*</span></span>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <div class="controls">
                                            <textarea placeholder="Alamat Lengkap" name="alamat" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label class="raleway" style="font-size: 11pt; margin: 7px 0;">Email <span class="accent-color" style="font-size: 15pt;">*</span></span>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <div class="controls">
                                            <input type="email" class="email" placeholder="someone@gmail.com" name="email" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label class="raleway" style="font-size: 11pt; margin: 7px 0;">No Telp <span class="accent-color" style="font-size: 15pt;">*</span></span>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <div class="controls">
                                            <input type="number" name="no_telp" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="raleway" style="font-size: 11pt; margin: 7px 0;">No Fax</span>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <div class="controls">
                                            <input type="number" name="no_fax" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="form-group">
                            <div class="controls">
                                <label class="raleway"><b>Pembuktian bahwa Anda bukan Robot</b></label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div style="padding: 8px;" class="bg-canvas align-center">
                                            <p style="font-size: 14pt;">
                                                <b>
                                                <?php 
                                                    foreach($captcha as $data):
                                                        echo $data->captcha;
                                                        $this->session->set_userdata(array('captcha'=>$data->hcaptcha));
                                                    endforeach;
                                                    // echo "<br>";
                                                    // echo $this->session->userdata('captcha');
                                                ?>
                                                </b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Hasil" name="captcha" required/>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <button type="submit" id="submit" class="btn-system btn-medium btn-block"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp; DAFTAR</button>
                            <div class="padding-5 align-right">
                                <span class="raleway">Anda punya Akun? <a href="<?php echo base_url('perusahaan'); ?>">Login</a></span>
                            </div>
                            </form>
                            <!-- End Daftar Form -->
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
			</div>
		</div>
		<!-- End Content -->