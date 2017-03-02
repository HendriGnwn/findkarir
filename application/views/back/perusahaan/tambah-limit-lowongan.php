<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.date.extensions.js')?>" type="text/javascript"></script>
<script>
$(function () {
        //Datemask dd/mm/yyyy
        $("#date").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
        $("#date_end").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
});
</script>
<?php
  $limit=array(
                'id'=>'limit','name'=>'limit',
                'placeholder'=>'Masukkan Limit',
                'value'=> isset($limit->limit)? $limit->limit:'',
                'class'=>'form-control'
    );
  $date=array(
                'id'=>'date','name'=>'date',
                'placeholder'=>'Tanggal Limit',
                'value'=> isset($limit->date)? $limit->date:'',
                'class'=>'form-control',
    );
  $dateSelesai=array(
                'id'=>'date_end','name'=>'date_end',
                'placeholder'=>'Tanggal Limit',
                'value'=> isset($limit->date)? $limit->date:'',
                'class'=>'form-control',
    );
?>
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">
                    Isi form di Bawah ini&nbsp;&nbsp;<a href="<?php echo base_url('admin/detailPerusahaan/'.$id); ?>"><span class="btn btn-primary btn-flat padding-2"><i class="fa fa-arrow-left"></i>&nbsp; &nbsp; KEMBALI</span></a>
                  </h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <?php echo form_open($formAction, array('id'=>'form-action', 'role'=>'form')); ?>
                  <table class="table">
                    <tr>
                      <td width="30%">Limit</td>
                      <td width="1%">:</td>
                      <td><?php echo form_input($limit);?></td>
                    </tr>
                    <tr>
                      <td width="30%">Tanggal Limit Mulai</td>
                      <td width="1%">:</td>
                      <td><?php echo form_input($date);?></td>
                    </tr>
					<tr>
                      <td width="30%">Tanggal Limit Selesai</td>
                      <td width="1%">:</td>
                      <td><?php echo form_input($dateSelesai);?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td colspan="3"><button type="submit" name="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i>&nbsp; &nbsp; <?php echo $button; ?></button></td>
                    </tr>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-validate/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#form-action").validate({
    rules:{
      limit: {
        required: true,
		digits: true,
      },
      date: {
        required: true,
      }
      date_end: {
        required: true,
      }
    },
    messages: {
      limit: {
        required: "limit harap di isi",
       },
      date: {
        required: "tanggal harap di isi"
      }
      date_end: {
        required: "tanggal harap di isi"
      }
    }
  });
});
</script>