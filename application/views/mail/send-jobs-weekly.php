<!-- / Hero subheader -->
<table class="container hero-subheader" border="0" cellpadding="0" cellspacing="0" width="620" style="width: 620px;">
	<tr>
		<td class="hero-subheader__title" style="font-size: 20px; font-weight: bold; padding: 20px 0 15px 0;" align="left"></td>
	</tr>

	<tr>
		<td class="hero-subheader__content" style="font-size: 16px; line-height: 27px; color: #969696; padding: 0 60px 0px 0;" align="left">
			Hi <?php echo ucwords(strtolower($row->nama)) ?>, <br/>
			Berikut adalah beberapa lowongan tersedia sesuai dengan passion Anda.<br/>
		</td>
	</tr>
	<?php 
	foreach ($jobs as $job) :
		$this->load->view('mail/_item-job-weekly', array('job' => $job));
	endforeach;
	?>
	<tr>
		<td>
			<table class="container" border="0" cellpadding="0" cellspacing="0" width="100%" style="padding-bottom: 10px;margin-top:-15px;" align="center">
				<tr>
					<td align="center">
						<table class="container" border="0" cellpadding="0" cellspacing="0" width="620" align="center" style="border-bottom: solid 1px #eeeeee; width: 620px;">
							<tr>
								<td align="center">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="hero-subheader__content" style="font-size: 16px; line-height: 27px; color: #969696; padding: 0 60px 0px 0;" align="left">
			Salam Hangat,<br/>
			<?php echo $this->Config_Model->get_app_name() ?>
		</td>
	</tr>
</table>
<!-- /// Hero subheader -->