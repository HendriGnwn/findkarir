<!-- / Hero subheader -->
<table class="container hero-subheader" border="0" cellpadding="0" cellspacing="0" width="620" style="width: 620px;">
	<tr>
		<td class="hero-subheader__title" style="font-size: 20px; font-weight: bold; padding: 20px 0 15px 0;" align="left"></td>
	</tr>

	<tr>
		<td class="hero-subheader__content" style="font-size: 16px; line-height: 27px; color: #969696; padding: 0 60px 30px 0;" align="left">
			Hi <?php echo ucwords(strtolower($row->nama)) ?>, <br/>
			Berikut ini adalah identitas Anda.<br/> 
			<ul>
				<li>ID : <?php echo $row->id_pelamar ?></li>
				<li>Nama : <?php echo ucwords(strtolower($row->nama)) ?></li>
				<li>Email : <?php echo $row->email ?></li>
				<li>Password : <?php echo $row->pass_view ?></li>
			</ul>
			<br/>
			Salam Hangat,<br/>
			<?php echo $this->Config_Model->get_app_name() ?>
		</td>
	</tr>
</table>
<!-- /// Hero subheader -->