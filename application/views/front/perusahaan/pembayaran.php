<?php
  $lowongan = array(
      'id'=>'lowongan', 'name'=>'lowongan',
      'value'=> isset($row['lowongan'])? $row['lowongan']:'',
    );
  $kualifikasi = array(
      'id'=>'kualifikasi', 'name'=>'kualifikasi',
      'value'=> isset($row['kualifikasi'])? $row['kualifikasi']:'',
    );
  $benefit = array(
      'id'=>'benefit', 'name'=>'benefit',
      'value'=> isset($row['benefit'])? $row['benefit']:'',
    );
  $kota = array(
      'id'=>'kota', 'name'=>'kota',
      'value'=> isset($row['kota'])? $row['kota']:'',
      'placeholder'=>'Kota',
    );
  $provinsi = array(
      'id'=>'provinsi', 'name'=>'provinsi',
      'value'=> isset($row['provinsi'])? $row['provinsi']:'',
      'placeholder'=>'Provinsi',
    );
  $date_post= array(
      'id'=>'date_post', 'name'=>'date_post',
      'value'=> isset($row['date_post'])? $row['date_post']:'',
      'placeholder'=>'Tanggal Buka Iklan',
    );
  $date_close= array(
      'id'=>'date_close', 'name'=>'date_close',
      'value'=> isset($row['date_close'])? $row['date_close']:'',
      'placeholder'=>'Tanggal Tutup Iklan',
    );
?>
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- Start Page Banner -->
    <div class="page-banner no-subtitle">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <h2>Konfirmasi Pembayaran Iklan Loker</h2>
            <p>Keterangan Iklan Lowongan Anda</p>
          </div>
          <div class="col-md-4">
            <ul class="breadcrumbs">
              <li><a href="<?php echo base_url(''); ?>">Beranda</a></li>
              <li><a href="<?php echo base_url('company'); ?>">Akun Perusahaan</a></li>
              <li>Konfirmasi Pembayaran</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- End Page Banner -->
    
    
    
    
    <!-- Start Content -->
    <div id="content">
      <div class="container">
        <?php
        $this->load->helper('fungsi_date');
        $this->load->model('fronModel');
                if($this->session->flashdata('berhasil')!=null){
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
                if($this->session->flashdata('gagal')!=null){
                ?>
                  <div class="alert alert-info alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> Gagal</h4>
                    <?php echo $this->session->flashdata('gagal'); ?>
                  </div>
                <?php
                  }
                ?>

        <section class="content-header">
          <h1 class="align-center">
            <?php echo $title; ?>
            <small>Preview</small>
          </h1>
          <br>
        </section>

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
                  <form role="form" action="<?php echo $formAction; ?>" method="POST" id="contact-form" class="contact-form form-style" enctype="multipart/form-data">
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
                      <td><input type="file" name="file" required/><small>Max Size 1MB || Format .jpg|.png|.gif|.jpeg</small></td>
                    </tr>
                    <tr>
                      <td width="30%">Transfer melalui</td>
                      <td width="1%">:</td>
                      <td>
                        <?php
                          foreach($loadBank as $bank){
                        ?>
                        <label for="number<?php echo $bank->id_rekening; ?>">
                          <input id="number<?php echo $bank->id_rekening; ?>" type="radio" name="bank" value="<?php echo $bank->nm_bank; ?>" required/><img src="<?php echo base_url('assets/upload/img/'.$bank->logo); ?>" width="100px" />
                        </label>
                        <?php 
                          }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Beri Keterangan</td>
                      <td width="1%">:</td>
                      <td><textarea name="ket" id="ket" required placeholder="Beritahu Informasi jika Anda sudah Transfer ke salah satu Bank, dan kirim pesan tentang Penayangan Iklan Anda"></textarea></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td><button type="submit" class="btn btn-system btn-medium"><i class="fa fa-check-square-o"></i>&nbsp; &nbsp; <?php echo $button; ?></button> | 
                      <a  target="_TAB2"  href="<?php echo base_url("company/cetakDataPembayaran/".$row['id_lowongan']."/".$row['aktivasi_id']); ?>" class="btn btn-success btn-medium"><i class="fa fa-print"></i>&nbsp; &nbsp; CETAK DATA</a></td>
                    </tr>
                  </table>
                </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
    </div>
  </div>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- Page Script -->
    <script>
          function limWak()
          {
            var kGol=$('#kGol').val();
            var kGol=$('#kGol').val();
              $.post('<?php echo base_url();?>index.php/company/golKetKategori/',
              {
                kGol:kGol
                
              },
              function(data) 
              {
              $('#limit').html(data);
            });
          }
         function selKGol()
          {
             var golongan=$('#golongan').val();
              $.post('<?php echo base_url();?>index.php/company/golDetailKategori/',
              {
                golongan:golongan
                
              },
              function(data) 
              {
              $('#kGol').html(data);
            });
          }
      $(function () {
        //Add text editor
        $("#kualifikasi").wysihtml5();
        $("#benefit").wysihtml5();
      });
    </script>        
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.date.extensions.js')?>" type="text/javascript"></script>
<script>
$(function () {
        //Datemask dd/mm/yyyy
        $("#date_post").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
        $("#date_close").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
});
  

</script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validate/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#contact-form").validate({
    rules:{
      katLowongan: {
        required: true,
      },
      lowongan: {
        required: true,
      },
      kualifikasi: {
        required: true,
      },
      benefit: {
        required: true,
      },
      gaji: {
        required: true,
      },
      kota: {
        required: true,
      },
      provinsi: {
        required: true,
      },
      type: {
        required: true,
      },
      date_post: {
        required: true,
      },
      date_close: {
        required: true,
      },
      golongan: {
        required: true,
      },
      kGol: {
        required: true,
      },
    },

    messages: {
      katLowongan: {
        required: "Kategori harap di isi",
       },
      lowongan: {
        required: "Lowongan harap di isi",
       },
       kualifikasi: {
        required: "Kualifikasi harap di isi",
       },
       benefit: {
        required: "Benefit harap di isi",
       },
       gaji: {
        required: "Gaji harap di isi",
       },
       kota: {
        required: "Kota harap di isi",
       },
       provinsi: {
        required: "Provinsi harap di isi",
       },
       type: {
        required: "Pekerjaan harap di isi",
       },
       date_post: {
        required: "Tanggal Buka harap di isi",
       },
       date_close: {
        required: "Tanggal Tutup harap di isi",
       },
       golongan: {
        required: "Golongan harap di isi",
       },
       kGol: {
        required: "Limit Waktu harap di isi",
       },
    }
  });
});
</script>
<style>
  label.error {
    margin: 2px 0 0 10px;
    color: #ff6666;
  }
</style>        