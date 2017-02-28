<!-- Start Page Banner -->
<div class="page-banner">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Laporkan Iklan</h2>
				<p>Laporkan Iklan yang bermasalah di <?php echo $this->Config_Model->get_app_name_url() ?></p>
			</div>
			<div class="col-md-6">
				<ul class="breadcrumbs">
					<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
					<li>Laporkan Iklan</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- End Page Banner -->

<!-- Start Content -->
<div id="content">
	<div class="container">
		<div class="row">

			<div class="col-md-8">
				<?php
				if ($this->session->flashdata('berhasil') != null) {
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
				if ($this->session->flashdata('gagal') != null) {
					?>
					<div class="alert alert-info alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-info"></i> Gagal</h4>
						<?php echo $this->session->flashdata('gagal'); ?>
					</div>
					<?php
				}
				?>

				<!-- Classic Heading -->
				<h4 class="classic-title"><span>Isi Form di Bawah ini</span></h4>

				<!-- Start Contact Form -->
				<?php
				echo form_open($formAction, array('class' => 'contact-form form-style', 'id' => 'contact-form'));
				?>
				<div class="form-group">
					<div class="controls">
						<input type="hidden" name="lowongan_id" />
					</div>
				</div>
				<div class="form-group">
					<div class="controls">
						<textarea rows="7"  placeholder="Pesan" name="pesan" required></textarea>
					</div>
				</div>
				<button type="submit" id="submit" name="submit" class="btn-system btn-large"><i class="fa fa-send"></i>&nbsp;&nbsp; SEND</button>
				</form>
				<!-- End Contact Form -->

			</div>

			<div class="col-md-4">
				<!-- Classic Heading -->
				<h4 class="classic-title"><span>Informasi Lowongan Bermasalah</span></h4>
				<?php foreach($lowongans as $lowongan): ?>
				<h5><?php echo $lowongan->nm_lowongan ?></h5>
				<h5><?php echo $lowongan->nm_perusahaan ?></h5>
				<?php endforeach; ?>
			</div>

		</div>
	</div>
</div>
<!-- End Content -->