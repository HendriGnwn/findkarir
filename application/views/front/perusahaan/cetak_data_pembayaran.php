<?php $this->load->helper('fungsi_date'); ?>
<html>
  <head>
    <title>JELOKER.COM CETAK DATA || <?php echo $row['aktivasi_id']; ?></title>
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/font_awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  </head>
<body>
<script type="text/javascript">
function printWindow(){
   bV = parseInt(navigator.appVersion)
   if (bV >= 4) window.print();
}
</script>
<?php
  $ket = array(
      'id'=>'ket', 'name'=>'ket',
      'value'=> isset($row['ket'])? $row['ket']:'',
      'class'=>'form-control',
    );
  $file = array(
      'id'=>'file', 'name'=>'file',
    );
?>
<!--<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />-->
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-body">
                  <h3 class="classic-title">Daftar Rekening Bank Transfer</h3>
                  <div class="alert alert-warning">Silahkan Anda Transfer ke salah satu Bank pada Tabel berikut ... Dan jika sudah Transfer Lanjut ke Konfirmasi Pembayaran ...</div>
                      <table class="table table-bordered table-strip table-responsive">
                        <tr>
                          <th width="4%" class="align-center">No</th>
                          <th width="20%" class="align-center">Nama Bank</th>
                          <th width="30%" class="align-center">Logo</th>
                          <th width="30%" class="align-center">Nomor Rekening</th>
                          <th width="30%" class="align-center">Atas Nama</th>
                        </tr>
                        <?php 
                          $no=1; 
                            foreach($loadBank as $data){ 
                          ?>
                        <tr>
                          <td align="center"><?php echo $no++; ?></td>
                          <td align="center"><b style="font-size: 11pt;"><?php echo $data->nm_bank; ?></b></td>
                          <td align="center"><img src="<?php echo base_url('assets/upload/img/'.$data->logo); ?>" width="150px"/></td>
                          <td align="center"><b style="font-size: 11pt;"><?php echo $data->kode_rek; ?></b></td>
                          <td align="center"><b style="font-size: 11pt;"><?php echo $data->nm_rek; ?></b></td>
                        </tr>
                        <?php } ?>
                      </table>
                  <br>
                  <h3 class="classic-title">Konfirmasi Pembayaran</h3>
                  <form role="form" action="<?php echo base_url('company'); ?>" method="POST" id="contact-form" class="contact-form form-style" enctype="multipart/form-data">
                  <table class="table raleway " style="font-size: 11pt;">
                    <tr>
                      <td colspan="3"><b><i class="fa fa-globe"></i>&nbsp;&nbsp; Isi Deskripsi Lowongan</b></td>
                    </tr>
                    <tr>
                      <td width="30%">ID Lowongan</td>
                      <td width="1%">:</td>
                      <td><b><?php echo isset($row['id_lowongan'])? $row['id_lowongan']:''; ?></b>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Lowongan</td>
                      <td width="1%">:</td>
                      <td><b><?php echo isset($row['nm_lowongan'])? $row['nm_lowongan']:''; ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Tgl Buka - Tutup Iklan</td>
                      <td width="1%">:</td>
                      <td><b><?php echo isset($row['iklan'])? $row['iklan']:''; ?></b></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Paket Pembayaran (Golongan)</td>
                      <td width="1%">:</td>
                      <td><span class="btn <?php echo isset($row['kode'])? $row['kode']:''; ?>"><?php echo isset($row['nm_golongan'])? $row['nm_golongan']:''; ?></span> | <?php echo isset($row['rating'])? $row['rating']:''; ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Limit Waktu Penayangan</td>
                      <td width="1%">:</td>
                      <td><?php echo isset($row['limit'])? $row['limit']:''; ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Total Harga</td>
                      <td width="1%">:</td>
                      <td><b><?php echo isset($row['harga'])? $row['harga']:''; ?></b></td>
                    </tr>
                    <tr>
                      <td colspan="3"><b><i class="fa fa-globe"></i>&nbsp;&nbsp; Input Konfirmasi Pembayaran</b></td>
                    </tr>
                    <tr>
                      <td>Keterangan Upload Bukti</td>
                      <td></td>
                      <td>Setelah Anda <b>Transfer Uang</b> ke salah satu <b>Rekening Kami</b>, <b>Struknya</b> kemudian Anda <b>Foto dan Lampirkan di bawah</b> yang sudah kami sediakan.</td>
                    </tr>
                    <tr>
                      <td width="30%">Upload Bukti Pembayaran</td>
                      <td width="1%">:</td>
                      <td><input type="file" name="file" disabled/><small>Max Size 1MB || Format .jpg|.png|.gif|.jpeg</small></td>
                    </tr>
                    <tr>
                      <td width="30%">Beri Keterangan</td>
                      <td width="1%">:</td>
                      <td><textarea name="ket" id="ket" disabled placeholder="Keterangan mengenai Penayangan Iklan Lowongan"></textarea></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td>
                       <input type="submit" name="rtsubmit" id="irtubmit" value="PRINT" onclick="printWindow()" />
                    </tr>
                  </table>
                </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
</body>
<script type="text/javascript">
document.onkeydown = function(e){
if (e.keyCode==13){//--Tombol ENTER--
   document.forms[0].rtsubmit.click();
  }
}
</script>
</html>
