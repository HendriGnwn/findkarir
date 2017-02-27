<script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
<!-- Start Page Banner -->
<div class="page-banner">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Bantuan</h2>
				<p>Kirim Pertanyaan atau yang berhubungan dengan <?php echo $this->Config_Model->get_app_name_url() ?></p>
			</div>
			<div class="col-md-6">
				<ul class="breadcrumbs">
					<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
					<li>Bantuan</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- End Page Banner -->

<!-- Start Map -->
<div id="map" data-position-latitude="<?php echo $this->Config_Model->get_app_contact_latitude() ?>" data-position-longitude="<?php $this->Config_Model->get_app_contact_longitude() ?>"></div>
<script>
	(function ( $ ) {
		$.fn.CustomMap = function (options) {

			var posLatitude = $('#map').data('position-latitude'),
					posLongitude = $('#map').data('position-longitude');

			var settings = $.extend({
				home: {latitude: posLatitude, longitude: posLongitude},
				text: '<div class="map-popup"><h4><?php echo $this->Config_Model->get_app_name_url() ?> | Gudangnya Informasi Lowongan Kerja</h4></div>',
				icon_url: $('#map').data('marker-img'),
				zoom: 15
			}, options);

			var coords = new google.maps.LatLng(settings.home.latitude, settings.home.longitude);

			return this.each(function () {
				var element = $(this);

				var options = {
					zoom: settings.zoom,
					center: coords,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					mapTypeControl: false,
					scaleControl: false,
					streetViewControl: false,
					panControl: true,
					disableDefaultUI: true,
					zoomControlOptions: {
						style: google.maps.ZoomControlStyle.DEFAULT
					},
					overviewMapControl: true,
				};

				var map = new google.maps.Map(element[0], options);

				var icon = {
					url: settings.icon_url,
					origin: new google.maps.Point(0, 0)
				};

				var marker = new google.maps.Marker({
					position: coords,
					map: map,
					icon: icon,
					draggable: false
				});

				var info = new google.maps.InfoWindow({
					content: settings.text
				});

				google.maps.event.addListener(marker, 'click', function () {
					info.open(map, marker);
				});

				var styles = [{"featureType": "landscape", "stylers": [{"saturation": -100}, {"lightness": 65}, {"visibility": "on"}]}, {"featureType": "poi", "stylers": [{"saturation": -100}, {"lightness": 51}, {"visibility": "simplified"}]}, {"featureType": "road.highway", "stylers": [{"saturation": -100}, {"visibility": "simplified"}]}, {"featureType": "road.arterial", "stylers": [{"saturation": -100}, {"lightness": 30}, {"visibility": "on"}]}, {"featureType": "road.local", "stylers": [{"saturation": -100}, {"lightness": 40}, {"visibility": "on"}]}, {"featureType": "transit", "stylers": [{"saturation": -100}, {"visibility": "simplified"}]}, {"featureType": "administrative.province", "stylers": [{"visibility": "on"}]}, {"featureType": "water", "elementType": "labels", "stylers": [{"visibility": "on"}, {"lightness": -25}, {"saturation": -100}]}, {"featureType": "water", "elementType": "geometry", "stylers": [{"hue": "#ffff00"}, {"lightness": -25}, {"saturation": -97}]}];

				map.setOptions({styles: styles});
			});

		};
	}(jQuery));

	jQuery(document).ready(function () {
		jQuery('#map').CustomMap();
	});
</script>
<!-- End Map -->

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
				<!-- <form role="form" class="" id="contact-form" method="POST"> -->
				<div class="form-group">
					<div class="controls">
						<input type="text" placeholder="Nama Lengkap Anda" name="nama" required/>
					</div>
				</div>
				<div class="form-group">
					<div class="controls">
						<input type="email" class="email" placeholder="Email Anda" name="email" required/>
					</div>
				</div>
				<div class="form-group">
					<div class="controls">
						<input type="text" placeholder="Subjek" name="subjek" required/>
					</div>
				</div>

				<div class="form-group">
					<div class="controls">
						<textarea rows="7"  placeholder="Pesan / Pertanyaan Anda kepada Kami" name="pesan" required></textarea>
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
											foreach ($captcha as $data):
												echo $data->captcha;
												$this->session->set_userdata(array('captcha' => $data->hcaptcha));
											endforeach;
											// echo "<br>";
											// echo $this->session->userdata('captcha');
											?>
										</b>                                    		
									</p>
								</div>
							</div>
							<div class="col-md-9">
								<input type="number" placeholder="Hasil" name="captcha" required/>
							</div>
						</div>
					</div>
				</div>
				<button type="submit" id="submit" class="btn-system btn-large"><i class="fa fa-send"></i>&nbsp;&nbsp; KIRIM BANTUAN</button>
				</form>
				<!-- End Contact Form -->

			</div>

			<div class="col-md-4">
				<?php $config = $this->Config_Model; ?>
				<!-- Classic Heading -->
				<h4 class="classic-title"><span>Informasi Kami</span></h4>

				<!-- Some Info -->
				<p><?php echo $config->get_app_name_url() ?> | Gudangnya Informasi Lowongan Kerja, Informasi lebih lanjut silahkan hubungi kami di:</p>

				<!-- Divider -->
				<div class="hr1" style="margin-bottom:10px;"></div>

				<!-- Info - Icons List -->
				<ul class="icons-list">
					<li><i class="fa fa-globe"></i> <strong>Alamat:</strong> <?php echo $config->get_app_contact_address(); ?></li>
					<li><i class="fa fa-envelope-o"></i> <strong>Email:</strong> <?php echo $config->get_app_contact_email(); ?></li>
					<li><i class="fa fa-phone-square"></i> <strong>Telp:</strong> <?php echo $config->get_app_contact_phone(); ?></li>
				</ul>

				<div class="hr1 margin-30"></div>

				<h4 class="classic-title"><span>Ikuti Kami di</span></h4>
				<div class="post-share">
					<a target="_TAB" class="facebook" href="<?php echo $config->get_app_facebook() ?>"><i class="fa fa-facebook"></i></a>
					<a target="_TAB" class="twitter" href="<?php echo $config->get_app_twitter() ?>"><i class="fa fa-twitter"></i></a>
					<a target="_TAB" class="gplus" href="<?php echo $config->get_app_google() ?>"><i class="fa fa-google-plus"></i></a>
				</div>
			</div>

		</div>
	</div>
</div>
<!-- End Content -->