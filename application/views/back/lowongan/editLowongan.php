<?php
  $lowongan = array(
      'id'=>'lowongan', 'name'=>'lowongan',
      'value'=> isset($row['lowongan'])? $row['lowongan']:'',
      'class'=>'form-control',
    );
  $kualifikasi = array(
      'id'=>'kualifikasi', 'name'=>'kualifikasi',
      'value'=> isset($row['kualifikasi'])? $row['kualifikasi']:'',
      'class'=>'form-control',
    );
  $benefit = array(
      'id'=>'benefit', 'name'=>'benefit',
      'value'=> isset($row['benefit'])? $row['benefit']:'',
      'class'=>'form-control',
    );
  $kota = array(
      'id'=>'kota', 'name'=>'kota',
      'value'=> isset($row['kota'])? $row['kota']:'',
      'placeholder'=>'Kota',
      'class'=>'form-control',
    );
  $provinsi = array(
      'id'=>'provinsi', 'name'=>'provinsi',
      'value'=> isset($row['provinsi'])? $row['provinsi']:'',
      'placeholder'=>'Provinsi',
      'class'=>'form-control',
    );
  $date_post= array(
      'id'=>'date_post', 'name'=>'date_post',
      'value'=> isset($row['date_post'])? $row['date_post']:'',
      'placeholder'=>'Date Post',
      'class'=>'form-control',
    );
  $date_update= array(
      'id'=>'date_update', 'name'=>'date_update',
      'value'=> isset($row['date_update'])? $row['date_update']:'',
      'placeholder'=>'Date Update',
      'class'=>'form-control',
    );
  $date_close= array(
      'id'=>'date_close', 'name'=>'date_close',
      'value'=> isset($row['date_close'])? $row['date_close']:'',
      'placeholder'=>'Date Close',
      'class'=>'form-control',
    );
?>
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <section class="content-header">
          <h1>
            Edit Iklan Lowongan
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url('admin/perusahaan') ?>"><i class="fa fa-laptop"></i> Data Perusahaan</a></li>
            <li><a href="<?php echo base_url('admin/lowonganById/'.$this->uri->segment('3')) ?>"><i class="fa fa-globe"></i> Iklan Perusahaan</a></li>
            <li class="active">Edit Iklan Lowongan</li>
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
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">
                    <?php echo $row['lowongan'] ?>&nbsp;&nbsp;<a href="<?php echo base_url('admin/lowonganById/'.$this->uri->segment('3')); ?>"><span class="btn btn-primary btn-flat padding-2"><i class="fa fa-arrow-left"></i>&nbsp; &nbsp; KEMBALI</span></a>
                  </h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form" action="<?php echo $formAction; ?>" method="POST">
                  <table class="table">
                    <tr class="bg-gray">
                      <td colspan="3"><i class="fa fa-laptop"></i>&nbsp;&nbsp; Keterangan Perusahaan</td>
                    </tr>
                    <tr>
                      <td width="30%">Perusahaan</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['nm_perusahaan'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Alamat</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['nm_perusahaan'] ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Telp // Email</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['telp'] ?> // <?php echo $row['email'] ?></td>
                    </tr>
                    <tr class="bg-gray">
                      <td colspan="3"><i class="fa fa-globe"></i>&nbsp;&nbsp; Keterangan Lowongan</td>
                    </tr>
                    <tr>
                      <td width="30%">ID</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['id'] ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Kategori</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['k_lowongan'] ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Lowongan</td>
                      <td width="1%">:</td>
                      <td><?php echo form_input($lowongan); ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Kualifikasi</td>
                      <td width="1%">:</td>
                      <td><?php echo form_textarea($kualifikasi); ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Benefit</td>
                      <td width="1%">:</td>
                      <td><?php echo form_textarea($benefit); ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Rentan Gaji</td>
                      <td width="1%">:</td>
                      <?php
                        $gaji=isset($row['gaji'])? $row['gaji']:'';
                      ?>
                      <td><select name="gaji" id="gaji" class="form-control">
                            <option value="">...</option>
                            <option <?php if($gaji=="Rp. 1.000.000 - Rp. 2.000.000"){echo "SELECTED";} ?> value="Rp. 1.000.000 - Rp. 2.000.000">Rp. 1.000.000 - Rp. 2.000.000</option>
                            <option <?php if($gaji=="Rp. 2.000.000 - Rp. 3.000.000"){echo "SELECTED";} ?> value="Rp. 2.000.000 - Rp. 3.000.000">Rp. 2.000.000 - Rp. 3.000.000</option>
                            <option <?php if($gaji=="Rp. 3.000.000 - Rp. 4.000.000"){echo "SELECTED";} ?> value="Rp. 3.000.000 - Rp. 4.000.000">Rp. 3.000.000 - Rp. 4.000.000</option>
                            <option <?php if($gaji=="Rp. 4.000.000 - Rp. 5.000.000"){echo "SELECTED";} ?> value="Rp. 4.000.000 - Rp. 5.000.000">Rp. 4.000.000 - Rp. 5.000.000</option>
                            <option <?php if($gaji=="Rp. 5.000.000 - Rp. 6.000.000"){echo "SELECTED";} ?> value="Rp. 5.000.000 - Rp. 6.000.000">Rp. 5.000.000 - Rp. 6.000.000</option>
                            <option <?php if($gaji=="Rp. 6.000.000 - Rp. 7.000.000"){echo "SELECTED";} ?> value="Rp. 6.000.000 - Rp. 7.000.000">Rp. 6.000.000 - Rp. 7.000.000</option>
                            <option <?php if($gaji=="Rp. 7.000.000 - Rp. 8.000.000"){echo "SELECTED";} ?> value="Rp. 7.000.000 - Rp. 8.000.000">Rp. 7.000.000 - Rp. 8.000.000</option>
                            <option <?php if($gaji=="Rp. 8.000.000 - Rp. 9.000.000"){echo "SELECTED";} ?> value="Rp. 8.000.000 - Rp. 9.000.000">Rp. 8.000.000 - Rp. 9.000.000</option>
                            <option <?php if($gaji=="Rp. 9.000.000 - Rp. 10.000.000"){echo "SELECTED";} ?> value="Rp. 9.000.000 - Rp. 10.000.000">Rp. 9.000.000 - Rp. 10.000.000</option>
                          </select>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Kota, Provinsi</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="row">
                          <div class="col-md-6">
                           <?php echo form_input($kota); $provinsi=isset($row['provinsi'])? $row['provinsi']:'';?>
                          </div>
                          <div class="col-md-6">
                           <select name="provinsi" id="provinsi" class="form-control">
                              <option value="">...</option>
                              <option <?php if($provinsi=="Nanggro Aceh Darussalam"){echo "SELECTED";} ?> value="Nanggro Aceh Darussalam">Nanggro Aceh Darussalam</option>
                              <option <?php if($provinsi=="Sumatera Utara"){echo "SELECTED";} ?> value="Sumatera Utara">Sumatera Utara</option>
                              <option <?php if($provinsi=="Sumatera Barat"){echo "SELECTED";} ?> value="Sumatera Barat">Sumatera Barat</option>
                              <option <?php if($provinsi=="Jambi"){echo "SELECTED";} ?> value="Jambi">Jambi</option>
                              <option <?php if($provinsi=="Bengkulu"){echo "SELECTED";} ?> value="Bengkulu">Bengkulu</option>
                              <option <?php if($provinsi=="Riau"){echo "SELECTED";} ?> value="Riau">Riau</option>
                              <option <?php if($provinsi=="Riau Kepulauan"){echo "SELECTED";} ?> value="Riau Kepulauan">Riau Kepulauan</option>
                              <option <?php if($provinsi=="Sumatera Selatan"){echo "SELECTED";} ?> value="Sumatera Selatan">Sumatera Selatan</option>
                              <option <?php if($provinsi=="Bangka Belitung"){echo "SELECTED";} ?> value="Bangka Belitung">Bangka Belitung</option>
                              <option <?php if($provinsi=="Lampung"){echo "SELECTED";} ?> value="Lampung">Lampung</option>
                              <option <?php if($provinsi=="Banten"){echo "SELECTED";} ?> value="Banten">Banten</option>
                              <option <?php if($provinsi=="D.K.I Jakarta"){echo "SELECTED";} ?> value="D.K.I Jakarta">D.K.I Jakarta</option>
                              <option <?php if($provinsi=="Jawa Barat"){echo "SELECTED";} ?> value="Jawa Barat">Jawa Barat</option>
                              <option <?php if($provinsi=="Jawa Tengah"){echo "SELECTED";} ?> value="Jawa Tengah">Jawa Tengah</option>
                              <option <?php if($provinsi=="D.I Yogyakarta"){echo "SELECTED";} ?> value="D.I Yogyakarta">D.I Yogyakarta</option>
                              <option <?php if($provinsi=="Bali"){echo "SELECTED";} ?> value="Bali">Bali</option>
                              <option <?php if($provinsi=="Nusa Tenggara Barat"){echo "SELECTED";} ?> value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                              <option <?php if($provinsi=="Nusa Tenggara Timur"){echo "SELECTED";} ?> value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                              <option <?php if($provinsi=="Kalimantan Barat"){echo "SELECTED";} ?> value="Kalimantan Barat">Kalimantan Barat</option>
                              <option <?php if($provinsi=="Kalimantan Tengah"){echo "SELECTED";} ?> value="Kalimantan Tengah">Kalimantan Tengah</option>
                              <option <?php if($provinsi=="Kalimantan Timur"){echo "SELECTED";} ?> value="Kalimantan Timur">Kalimantan Timur</option>
                              <option <?php if($provinsi=="Kalimantan Selatan"){echo "SELECTED";} ?> value="Kalimantan Selatan">Kalimantan Selatan</option>
                              <option <?php if($provinsi=="Sulawesi Utara"){echo "SELECTED";} ?> value="Sulawesi Utara">Sulawesi Utara</option>
                              <option <?php if($provinsi=="Sulawesi Barat"){echo "SELECTED";} ?> value="Sulawesi Barat">Sulawesi Barat</option>
                              <option <?php if($provinsi=="Sulawesi Tengah"){echo "SELECTED";} ?> value="Sulawesi Tengah">Sulawesi Tengah</option>
                              <option <?php if($provinsi=="Sulawesi Tenggara"){echo "SELECTED";} ?> value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                              <option <?php if($provinsi=="Sulawesi Selatan"){echo "SELECTED";} ?> value="Sulawesi Selatan">Sulawesi Selatan</option>
                              <option <?php if($provinsi=="Gorontalo"){echo "SELECTED";} ?> value="Gorontalo">Gorontalo</option>
                              <option <?php if($provinsi=="Maluku"){echo "SELECTED";} ?> value="Maluku">Maluku</option>
                              <option <?php if($provinsi=="Maluku Utara"){echo "SELECTED";} ?> value="Maluku Utara">Maluku Utara</option>
                              <option <?php if($provinsi=="Papua Barat"){echo "SELECTED";} ?> value="Papua Barat">Papua Barat</option>
                              <option <?php if($provinsi=="Papua Tengah"){echo "SELECTED";} ?> value="Papua Tengah">Papua Tengah</option>
                              <option <?php if($provinsi=="Papua Timur"){echo "SELECTED";} ?> value="Papua Timur">Papua Timur</option>
                            </select>
                          </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Pekerjaan</td>
                      <td width="1%">:</td>
                      <td>
                        <select name="type" id="type" class="form-control">
                            <option value="">...</option>
                            <?php
                              $kategori=isset($row['type'])? $row['type']:'';
                              foreach($kat as $data){
                            ?>
                            <option <?php if($data->id_type==$kategori){echo "SELECTED";} ?> value="<?php echo $data->id_type; ?>"><?php echo $data->nm_type; ?></option>
                            <?php
                              }
                            ?>
                          </select>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Tanggal Buka Iklan</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="row">
                          <div class="col-md-4">
                            <?php echo form_input($date_post); ?>
                          </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Tanggal Tutup Iklan</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="row">
                          <div class="col-md-4">
                            <?php echo form_input($date_close); ?>
                          </div>
                      </td>
                    </tr>
                    <tr class="bg-gray">
                      <td colspan="3"><i class="fa fa-globe"></i>&nbsp;&nbsp; Keterangan Lainnya</td>
                    </tr>
                    <tr>
                      <td width="30%">Aktivasi</td>
                      <td width="1%">:</td>
                      <td>
                        <?php
                          if($row['status']==1){
                            echo "<span data-toggle='tooltip' title='Sudah' class='label label-success'><i class='fa fa-check-square'></i></span>";
                          }elseif($row['status']==0){
                            echo "<span data-toggle='tooltip' title='Pending' class='label label-danger'><i class='fa fa-spinner'></i></span>";
                          }
                        ?>
                        &nbsp;&nbsp;&nbsp;
                        <?php echo $row['ket']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Bukti</td>
                      <td width="1%">:</td>
                      <td width="69%">
                        <?php
                          if($row['bukti']=='' || $row['bukti']==null){
                            echo "Pending";
                          }else{
                        ?>
                        <div class="row">
                          <div class="col-md-6">
                            <img width="100%" src="<?php echo base_url('assets/upload/img/'.$row['bukti']); ?>" class="img-responsive" style="border: 1px solid #ddd;" />
                          </div>
                        </div>
                        <?php
                          }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Golongan</td>
                      <td width="1%">:</td>
                      <td>
                          <?php 
                          if($row['id_golongan']=="1"){
                            echo "<span class='label label-success' data-toggle='tooltip' title='".$row['rating']."'>".$row['golongan']."</span>";
                          }elseif($row['id_golongan']=="2"){
                            echo "<span class='label label-warning' data-toggle='tooltip' title='".$row['rating']."'>".$row['golongan']."</span>";
                          }elseif($row['id_golongan']=="3"){
                            echo "<span class='label bg-gray' data-toggle='tooltip' title='".$row['rating']."'>".$row['golongan']."</span>";
                          }

                        ?>
                       </td>
                    </tr>
                    <tr>
                      <td width="30%">Status Penayangan</td>
                      <td width="1%">:</td>
                      <td>
                        <?php
                          if($row['aktif']==1){
                            echo "<span data-toggle='tooltip' title='Enable' class='label label-success'>ENABLE</span>";
                          }elseif($row['aktif']==2){
                            echo "<span data-toggle='tooltip' title='Memasuki masa Perpanjang' class='label label-warning'>PERPANJANG</span>";
                          }elseif($row['aktif']==0){
                            echo "<span data-toggle='tooltip' title='Disable' class='label label-danger'>DISABLE</span>";                                
                          }elseif($row['aktif']==3){
                            if($row['status']==0){
                              echo "<span data-toggle='tooltip' title='Belum bisa di Klik' class='label label-warning'>PENDING</span></a>";
                            }elseif($row['status']==1){
                              echo "<a data-toggle='tooltip' title='Klik untuk ENABLE'><span class='label label-warning'>KONFIRMASI</span></a>";                                
                            }
                          }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Pelamar</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['pelamar'] ?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td><button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; &nbsp; <?php echo $button; ?></button></td>
                    </tr>
                  </table>
                </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- Page Script -->
    <script>
      $(function () {
        //Add text editor
        $("#kualifikasi").wysihtml5();
        $("#benefit").wysihtml5();
      });
    </script>        