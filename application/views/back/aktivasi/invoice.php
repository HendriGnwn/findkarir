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
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url('admin/order') ?>"><i class="fa fa-dashboard"></i> Konfirmasi Order</a></li>
            <li class="active"><?php echo $title; ?></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
                <?php
                  $this->load->helper('fungsi_date');
                  if($this->session->flashdata('notification')!=null){
                ?>
                  <div class="alert alert-info alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> Informasi</h4>
                    <?php echo $this->session->flashdata('notification'); ?>
                  </div>
                  <?php
                    }
                  ?>
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
                  <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table">
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
                    <tr>
                      <td></td>
                      <td></td>
                      <td align="right">
                        <?php
                          if($row['aktif']=='3' && $row['status']=='1'){
                        ?>
                          <a href="<?php echo base_url('admin/prosesKonfirmasiAktivasi/'.$this->uri->segment('3').'/'.$row['id_lowongan']) ?>" class="btn btn-success btn-flat"><i class="fa fa-check-square"></i>&nbsp;&nbsp;Konfirmasi & Cetak Struk&nbsp;&nbsp;<i class="fa fa-print"></i></a>
                        <?php
                          }elseif(($row['aktif']=='1' || $row['aktif']=='0') && $row['status']=='1'){
                        ?>
                          <a href="<?php echo base_url('admin/cetakStrukLowongan/'.$this->uri->segment('3')) ?>" class="btn btn-success btn-flat"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak Struk</a>
                          <?php
                          }elseif($row['aktif']=='2' && $row['status']=='1'){
                        ?>
                          <a href="<?php echo base_url('admin/panjangLow/'.$row['id_perusahaan'].'/'.$row['id_lowongan'].'/'.$row['aktivasi_id']) ?>" class="btn btn-warning btn-flat"><i class="fa fa-check-square"></i>&nbsp;&nbsp;Perpanjang Iklan</a>&nbsp;&nbsp;
                          <a href="<?php echo base_url('admin/cetakStrukLowongan/'.$this->uri->segment('3')) ?>" class="btn btn-success btn-flat"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak Struk</a>
                        <?php } ?>
                      </td>
                    </tr>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-xs-1">
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
