<?php
	$this->load->helper('fungsi_date');
?>
<!-- Start Page Banner -->
<div class="page-banner">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h2><?php echo isset($page->name) ? $page->name : ''; ?></h2>
				<p>di Posting oleh Admin</p>
			</div>
			<div class="col-md-4">
				<ul class="breadcrumbs">
					<li><a href="<?php echo base_url(''); ?>">Beranda</a></li>
					<li><a href="#">Halaman</a></li>
					<li><?php echo isset($page->name) ? $page->name : ''; ?></li>
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
					<?php if (isset($page->foto) ? $page->foto : '' != null) { ?>
						<div class="post-head align-center">
							<div class="item align-center">
	                            <a class="lightbox" title="<?php echo isset($page->name) ? $page->name : ''; ?>" href="<?php echo base_url('assets/upload/img/' . $page->foto); ?>">
									<div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
									<img alt="<?php echo isset($page->name) ? $page->name : ''; ?>" src="<?php echo base_url('assets/upload/img/' . $page->foto); ?>">
	                            </a>
							</div>
						</div>
					<?php } ?>
					<!-- End Single Post (Gallery) -->

                    <!-- Start Single Post Content -->
                    <div class="post-content">
						<div class="post-type">
							<?php if (isset($page->foto) ? $page->foto : '' != null) { ?>
								<i class="fa fa-picture-o"></i>
							<?php } else { ?>
								<i class="fa fa-pencil-square-o"></i>
							<?php } ?>
						</div>
						<h2><?php echo isset($page->name) ? $page->name : ''; ?></h2>
						<ul class="post-meta">
							<li>By <a href="#">Admin</a></li>
							<li><i class="fa fa-clock-o"></i>&nbsp; <?php echo tgl_indo_time1($page->created_at); ?></li>
						</ul>
						<p><?php echo isset($page->description) ? $page->description: ''; ?></p>

					</div>
				</div>
				<!-- End Single Post Content -->

			</div>
			<!-- End Single Post Area -->

			<?php $this->load->view('front/layouts/_sidebar', array('kategoriData' => $kategoriData)) ?>
			
		</div>
	</div>
</div>
<!-- End Content -->