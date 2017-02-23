<?php
  $date_post= array(
      'id'=>'date_post', 'name'=>'date_post',
      'value'=> isset($row['date_post'])? $row['date_post']:'',
      'placeholder'=>'Tanggal Buka Iklan',
      'class'=>'form-control',
    );
  $date_close= array(
      'id'=>'date_close', 'name'=>'date_close',
      'value'=> isset($row['date_close'])? $row['date_close']:'',
      'placeholder'=>'Tanggal Tutup Iklan',
      'class'=>'form-control',
    );
  $file= array(
      'id'=>'file', 'name'=>'file',
    );
    $ket = array(
      'id'=>'ket', 'name'=>'ket',
      'value'=> isset($row['ket'])? $row['ket']:'',
      'class'=>'form-control',
    );
?>
<style>
      .example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
      }
      .example-modal .modal {
        background: transparent!important;
      }
    </style>
<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url('admin/golongan') ?>"><i class="fa fa-dashboard"></i> Data Lowongan</a></li>
            <li class="active"><?php echo $title; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content"><!-- Small boxes (Stat box) -->
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
          <div class="example-modal">
            <div class="modal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header <?php echo $row['kode']; ?>">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php echo $title; ?></h4>
                  </div>
                  <div class="modal-body">
                    <?php echo form_open_multipart($formAction, array('id'=>'form-action', 'role'=>'form')); ?>
                     <label for="date_post">Tanggal Buka Iklan</label>
                     <?php echo form_input($date_post); ?>
                     <br />
                     <label for="date_close">Tanggal Tutup Iklan</label>
                      <?php echo form_input($date_close); ?>
                      <br />
                      <label for="golongan">Golongan</label>
                        <select name="golongan" id="golongan" class="form-control" onchange="selKGol()">
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
                      <br />
                      <label for="kGol">Limit Waktu - Harga</label>
                        <select name="kGol" id="kGol" class="form-control" onchange="limWak()">
                            <option value="">...</option>
                            <?php
                              $kg=isset($row['id_k_golongan'])? $row['id_k_golongan']:'';
                              foreach($kgol as $data){
                            ?>
                            <option <?php if($data->id_k_golongan==$kg){echo "SELECTED";} ?> value="<?php echo $data->id_k_golongan; ?>"><?php echo $data->limit_waktu." Hari // Rp. ".number_format($data->harga, 0, ',', '.');?>,-</option>
                            <?php
                              }
                            ?>
                        </select>
                      <br />
                      <label>Tanggal Limit Order</label>
                      <br/>
                        <span id="limit"></span>
                      <br />
                      <br />
                      <label for="file">Upload Bukti</label>
                       <?php echo form_upload($file); ?><small>*Max Size 1MB || Format .jpg|.png|.gif|.jpeg</small>
                       <br />
                       <br />
                      <label for="ket">Keterangan</label>
                       <?php echo form_input($ket); ?>
                       <br />
                  </div>
                  <div class="modal-footer">
                      <a href="<?php echo base_url('admin/lowonganById/'.$this->uri->segment('3')); ?>" class="btn btn-danger pull-left" data-dismiss="modal">Close</a>
                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; &nbsp; Save Changes</button>
                    </form>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal -->
        </div>
      </section>
      <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery.min.js" type="text/javascript"></script>
      <script type="text/javascript">
         function limWak()
          {
            var kGol=$('#kGol').val();
            var kGol=$('#kGol').val();
              $.post('<?php echo base_url();?>index.php/admin/golKetKategori/',
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
              $.post('<?php echo base_url();?>index.php/admin/golDetailKategori/',
              {
                golongan:golongan
                
              },
              function(data) 
              {
              $('#kGol').html(data);
            });
          }
      </script>

<script src="<?php echo base_url(); ?>assets/plugins/jquery-validate/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#form-action").validate({
    rules:{
      date_post:{
        required: true,
      },
      date_close:{
        required: true,
      },
      golongan:{
        required: true,
      },
      kGol:{
        required: true,
      },
      file:{
        required: true,
      },
      ket:{
        required: true,
      },

    },

    messages: {
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
        required: "Limit harap di isi",
      },
      file: {
        required: "File Upload harap di isi",
      },
      ket: {
        required: "Keterangan harap di isi",
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