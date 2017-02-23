<?php
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=GenerateExcel.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
?>

<html>
	<head>
		<title>Generate to Excel</title>
	</head>
	<body>
		<h2>Pelamar <?php echo $perusahaan; ?></h2>
		<table border=1>
			<tr>
				<th>No</th>
				<th>ID Pelamar</th>
				<th>Nama</th>
				<th>KTP</th>
				<th>TTL</th>
				<th>Jenis Kelamin</th>
				<th>Agama</th>
				<th>Alamat</th>
				<th>Email</th>
				<th>Telp</th>
				<th>Pendidikan</th>
				<th>Status</th>
				<th>Tanggal Datang</th>
				<th>Ket Alamat Datang</th>
				<th>Keterangan</th>
			</tr>
			<?php
				$no=1;
				$this->load->helper('fungsi_date');
				foreach($loadData as $data){
			?>
			<tr>
				<td align="center"><?php echo $no++; ?></td>
				<td><?php echo $data->id_pelamar; ?></td>
				<td><?php echo $data->nama; ?></td>
				<td><?php echo $data->no_ktp; ?></td>
				<td><?php echo $data->tmp_lhr.", ".tgl_indo($data->tgl_lhr); ?></td>
				<td><?php echo $data->jk; ?></td>
				<td><?php echo $data->agama; ?></td>
				<td><?php echo $data->alamat." - ".$data->kota." ".$data->kodepos; ?></td>
				<td><?php echo $data->email; ?></td>
				<td><?php echo $data->no_telp; ?></td>
				<td><?php echo $data->pendidikan; ?></td>
				<td><?php
                    if($data->sts_lamar==1){
                        echo "DATANG";
                    }elseif($data->sts_lamar==0){
                    	echo "TERTUNDA";
                    }
                    ?>
                </td>
                <td><?php if($data->tgl_datang!='' && $data->jam_datang!=''){echo tgl_indo_time1($data->tgl_datang." ".$data->jam_datang);}else{echo "";} ?></td>
                <td><?php echo $data->almt_datang; ?></td>
				<td><?php echo $data->ket; ?></td>
			</tr>
			<?php
				}
			?>
		</table>
	</body>
</html>
