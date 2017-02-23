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
            <h2>Pasang Iklan Lowongan</h2>
            <p>Isi yang Lengkap dan Tepat Form di bawah ini</p>
          </div>
          <div class="col-md-4">
            <ul class="breadcrumbs">
              <li><a href="<?php echo base_url(''); ?>">Beranda</a></li>
              <li>Akun Perusahaan</li>
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
                <div class="box-header">
                  <h3 class="box-title">
                        <a href="<?php echo base_url('company/tambahIklan'); ?>"><span class="btn btn-system btn-medium"><i class="fa fa-arrow-left"></i>&nbsp; &nbsp; KEMBALI</span></a>
                  </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                  <br>
                  <h3 class="classic-title">Form Input Data Iklan Lowongan</h3>
                  <form role="form" action="<?php echo $formAction; ?>" method="POST" id="contact-form" class="contact-form form-style">
                  <table class="table raleway " style="font-size: 11pt;">
                    <tr>
                      <td colspan="3"><b><i class="fa fa-globe"></i>&nbsp;&nbsp; Isi Deskripsi Lowongan</b></td>
                    </tr>
                    <tr>
                      <td width="30%">Kategori Lowongan</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group">
                          <div class="controls">
                          <select name="katLowongan" id="katLowongan">
                              <option value="">...</option>
                              <?php
                                $katL=isset($row['id_k_low'])? $row['id_k_low']:'';
                                foreach($kat_lowongan as $data){
                              ?>
                              <option <?php if($data->id_k_low==$katL){echo "SELECTED";} ?> value="<?php echo $data->id_k_low; ?>"><?php echo $data->nm_k_lowongan; ?></option>
                              <?php
                                }
                              ?>
                            </select>
                            </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Lowongan</td>
                      <td width="1%">:</td>
                      <td>
                      <div class="form-group">
                        <div class="controls">
                          <?php echo form_input($lowongan); ?>
                        </div>
                      </div></td>
                    </tr>
                    <tr>
                      <td width="30%">Kualifikasi (Deskripsi)</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group">
                          <div class="controls">
                            <?php echo form_textarea($kualifikasi); ?>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Benefit</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="form-group">
                          <div class="controls">
                            <?php echo form_textarea($benefit); ?>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Rentan Gaji</td>
                      <td width="1%">:</td>
                      <?php
                        $gaji=isset($row['gaji'])? $row['gaji']:'';
                        $provinsi=isset($row['provinsi'])? $row['provinsi']:'';
                      ?>
                      <td>
                        <div class="form-group">
                          <div class="controls">
                            <select name="gaji" id="gaji">
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
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Kota, Provinsi</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="row">
                          <div class="col-md-6">
                           <?php echo form_input($kota); ?>
                          </div>
                          <div class="col-md-6">
                            <select name="provinsi" id="provinsi">
                              <option value="">-----Pilih Provinsi-----</option>
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
                        <select name="type" id="type">
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
                      <td colspan="3"><b><i class="fa fa-globe"></i>&nbsp;&nbsp; Isi Informasi Iklan</b></td>
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
                            <!--<span id="date_close"></span>-->
                          </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Paket Pembayaran (Golongan)</td>
                      <td width="1%">:</td>
                      <td>
                        <select name="golongan" id="golongan" onchange="selKGol()">
                            <option value="">...</option>
                            <?php
                              $g=isset($row['id_golongan'])? $row['id_golongan']:'';
                              foreach($gol as $data){
                            ?>
                            <option <?php if($data->id_golongan==$g){echo "SELECTED";} ?> value="<?php echo $data->id_golongan; ?>"><?php echo $data->nm_golongan; ?></option>
                            <?php
                              }
                            ?>
                          </select>

                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Limit Waktu - Harga</td>
                      <td width="1%">:</td>
                      <td>
                        <select name="kGol" id="kGol" onchange="limWak()">
                            <option value="">...</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Tanggal Limit Order</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="row">
                          <div class="col-md-4">
                             <span id="limit"></span>
                          </div>
                      </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td><button type="submit" class="btn btn-system btn-medium"><i class="fa fa-save"></i>&nbsp; &nbsp; <?php echo $button; ?></button></td>
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