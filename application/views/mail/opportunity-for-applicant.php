<!-- / Hero subheader -->
<table class="container hero-subheader" border="0" cellpadding="0" cellspacing="0" width="620" style="width: 620px;">
	<tr>
		<td class="hero-subheader__title" style="font-size: 20px; font-weight: bold; padding: 20px 0 15px 0;" align="left"></td>
	</tr>

	<tr>
		<td class="hero-subheader__content" style="font-size: 16px; line-height: 27px; color: #969696; padding: 0 60px 30px 0;" align="left">
			Hi <?php echo ucwords(strtolower($applicant->nama)) ?>, <br/>
			Anda diundang oleh <b><?php echo $company->nm_perusahaan ?></b> untuk hadir karena Anda terpilih untuk mengikuti proses wawancara.<br/>
			Berikut ini alamat beserta keterangan lainnya.<br/>
			<ul>
				<li>Alamat : <?php echo $apply->almt_datang ?></li>
				<li>Tanggal : <?php echo $apply->tgl_datang ?></li>
				<li>Jam : <?php echo $apply->jam_datang ?></li>
			</ul>
			<br/>
			Salam Hangat,<br/>
			<?php echo $this->Config_Model->get_app_name() ?>
		</td>
	</tr>
</table>
<!-- /// Hero subheader -->