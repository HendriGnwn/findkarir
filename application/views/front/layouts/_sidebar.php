<!-- Sidebar -->
<div class="col-md-3 sidebar right-sidebar">
	<!-- Categories Widget -->
	<div class="widget widget-categories">
		<h4>Kategori <span class="head-line"></span></h4>
		<ul>
			<li><a <?php echo (uri_string() == 'berita') ? "class='active'" : '' ?> href="<?php echo base_url('berita'); ?>">Semua Berita</a></li>
			<?php foreach ($kategoriData as $data) { ?>
			<li>
				<a <?php echo ($data->slug == $this->uri->segment('3')) ? "class='active'" : '' ?> href="<?php echo base_url('page/detail/' . $data->slug); ?>"><?php echo $data->name; ?></a>
			</li>
		<?php } ?>
		</ul>
	</div>
</div>