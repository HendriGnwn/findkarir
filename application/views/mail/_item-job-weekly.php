<tr>
	<td>
		<table class="container" border="0" cellpadding="0" cellspacing="0" width="100%" style="padding-bottom: 15px;" align="center">
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
		<b><a href="<?php echo base_url('lowongan/detailLowongan/'.$job->id_lowongan) ?>" style="color: #969696;text-decoration: none;"><?php echo $job->nm_lowongan ?></a></b><br/>
		<p style="margin-top:-3px;font-size:12px;"><?php echo $job->nm_perusahaan ?></p>
		<p style="margin-top:-18px;font-size:12px;"><?php echo $job->kota ?>, <?php echo $job->provinsi ?></p>
		<p style="margin-top:-18px;font-size:12px;"><?php echo $job->gaji ?></p>
	</td>
</tr>