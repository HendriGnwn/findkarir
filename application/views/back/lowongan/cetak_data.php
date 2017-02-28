
<html>
  <head>
    <title><?php echo $this->Config_Model->get_app_name_url() ?> Struk || <?php echo $row['aktivasi_id']; ?></title>
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
            <div class="col-xs-1">
            </div>
            <div class="col-xs-10">
              <div class="box box-primary">
                <div class="box-header">
                  <center><img src="<?php echo base_url('assets/img/logo.png'); ?>" width="200px">
                  <br>
                  <small>Gudangnya Informasi Lowongan Kerja</small></center><hr>
                  <h4 align="center">
                    <?php echo $title; ?>
                  </h4>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table" style="font-size: 10pt;">
                    <tr class="bg-gray">
                      <td colspan="3"><i class="fa fa-globe"></i>&nbsp;&nbsp; Deskripsi Perusahaan</td>
                    </tr>
                    <tr>
                      <td width="30%">ID Perusahaan</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['id_perusahaan']; ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Perusahaan</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['perusahaan']; ?></b></td>
                    </tr>
                    <tr class="bg-gray">
                      <td colspan="3"><i class="fa fa-globe"></i>&nbsp;&nbsp; Deskripsi Lowongan</td>
                    </tr>
                    <tr>
                      <td width="30%">ID Lowongan</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['id_lowongan']; ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Lowongan</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['nm_lowongan']; ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Daerah</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['kota']; ?></td>
                    </tr>
                    <tr class="bg-gray">
                      <td colspan="3"><i class="fa fa-globe"></i>&nbsp;&nbsp; Deskripsi Aktivasi</td>
                    </tr>
                    <tr>
                      <td width="30%">ID Aktivasi</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['id_aktivasi']; ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Golongan || Deskripsi</td>
                      <td width="1%">:</td>
                      <td><span class="btn btn-sm padding-2 <?php echo $row['kode']; ?>"><?php echo $row['nm_golongan']; ?></span> || <?php echo $row['rating']; ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Limit Waktu</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['limit']; ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Total Harga</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['harga']; ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Upload Bukti</td>
                      <td width="1%">:</td>
                      <td><div class="row"><div class="col-md-6"><img src="<?php echo $row['struk'];?>"/></div></div></td>
                    </tr>
                    <tr>
                      <td width="30%">Keterangan</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['ket']; ?></td>
                    </tr>
                    <tr>
                      <td align="center" colspan="3">Bogor, <?php echo tgl_indo(date('Y-m-d')); ?></td>
                    </tr>
                    <tr>
                      <td><div class="row"><div class="col-md-4"></div><div class="col-md-8">Petugas, 
                        <br><br>(<b><?php
                          if($row['id_user']=='' || $row['id_user']==null){
                            echo $this->session->userdata('nama');
                          }else{
                           $cek = $this->my_model->showById('job_user', array('id_user'=>$row['id_user']));
                          echo $cek->nama;} ?></b>)</div></div></td>
                      <td></td>
                      <td align="right">Atas Nama Perusahaan, <br><br>(<b><?php echo $row['perusahaan']; ?></b>)</td>
                    </tr>
                  </table>
                  <form action='<?php echo base_url('admin/lowonganById/'.$row['id_perusahaan']); ?>' method='post'>
                    <input type="submit" name="rtsubmit" id="irtubmit" value="" onclick="printWindow()" style=" border: 0px solid #000; background-color:#fff ">
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-xs-1">
            </div>
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
