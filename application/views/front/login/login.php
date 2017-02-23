		<!-- Start Page Banner -->
		<div class="page-banner">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h2>Login Pencari Kerja</h2>
						<p>Langkah untuk Masuk ke Halaman Pribadi Anda</p>
					</div>
					<div class="col-md-4">
						<ul class="breadcrumbs">
							<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
							<li>Login</li>
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
                <div class="col-md-3"></div>
				<div class="col-md-6">
                    <div class="box box-danger">
                        <div class="box-header align-center">
                          <h4 class="box-title raleway padding-5" style="font-weight: normal;">Login Masuk Halaman Pribadi Anda</h4>
                        </div>
                        <div class="box-body">
                            <!-- Start daftar Form -->
                            <form role="form" class="contact-form form-style" id="contact-form" method="post" action="<?php echo $formAction; ?>">
                            <div class="form-group">
                            <div class="controls">
                            <input type="text" class="email" placeholder="Email atau ID" name="email" required/>
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="controls">
                            <input type="password" placeholder="Password Anda" name="password" required/>
                            </div>
                            </div>
                            
                            
                            <button type="submit" id="submit" class="btn-system btn-medium btn-block"><i class="fa fa-sign-in"></i>&nbsp;&nbsp; LOGIN</button>
                            <div class="padding-5">
                                <a href="<?php echo base_url('login/lupaPassword'); ?>">Lupa Password?</a>
                                <span style="float:right;" class="raleway align-right">Anda tidak punya Akun? <a href="<?php echo base_url('login/daftar'); ?>">Daftar Sekarang</a></span>
                            </div>
                            
                            </form>
                            <!-- End Daftar Form -->
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
			</div>
		</div>
		<!-- End Content -->