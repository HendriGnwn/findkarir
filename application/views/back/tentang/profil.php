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
                  <div class="modal-header bg-gray">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php echo $title; ?></h4>
                  </div>
                  <div class="modal-body">
                    <form action="<?php echo $formAction; ?>" method="POST" id="form-action">
                      <label>Alamat Perusahaan</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                          </span>
                          <input type="text" name="alamat" value="<?php echo isset($row['alamat'])? $row['alamat']:''; ?>" class="form-control" id="alamat"/>
                        </div><!-- /input-group -->
                        <br/>
                      <label>Lokasi Perusahaan (Google Maps)</label>
                        <div class="row">
                          <div class="col-md-6">
                          <label>Latitude</label>
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="fa fa-map-marker"></i>
                              </span>
                              <input type="text" name="latitude" value="<?php echo isset($row['latitude'])? $row['latitude']:''; ?>" class="form-control" id="latitude"/>
                            </div><!-- /input-group -->
                          </div>

                          <div class="col-md-6">
                          <label>Longitude</label>
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="fa fa-map-marker"></i>
                              </span>
                              <input type="text" name="longitude" value="<?php echo isset($row['longitude'])? $row['longitude']:''; ?>" class="form-control" id="longitude"/>
                            </div><!-- /input-group -->
                          </div>
                        </div>
                        <br />
                      <label>Email</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                          </span>
                          <input type="email" name="email" value="<?php echo isset($row['email'])? $row['email']:''; ?>" class="form-control" id="email"/>
                        </div><!-- /input-group -->
                        <br/>
                      <label>No Telp</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-phone"></i>
                          </span>
                          <input type="text" name="no_telp" value="<?php echo isset($row['no_telp'])? $row['no_telp']:''; ?>" class="form-control" id="no_telp"/>
                        </div><!-- /input-group -->
                        <br/>
                      <label>Url Website</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-globe"></i>
                          </span>
                          <input type="text" name="web_url" value="<?php echo isset($row['web_url'])? $row['web_url']:''; ?>" class="form-control" id="web_url"/>
                        </div><!-- /input-group -->
                        <br/>
                      <label>Url Facebook</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-facebook"></i>
                          </span>
                          <input type="text" name="facebook" value="<?php echo isset($row['facebook'])? $row['facebook']:''; ?>" class="form-control" id="facebook"/>
                        </div><!-- /input-group -->
                        <br/>
                      <label>Url Twitter</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-twitter"></i>
                          </span>
                          <input type="text" name="twitter" value="<?php echo isset($row['twitter'])? $row['twitter']:''; ?>" class="form-control" id="twitter"/>
                        </div><!-- /input-group -->
                        <br/>
                      <label>Url Google+</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-google-plus"></i>
                          </span>
                          <input type="text" name="google" value="<?php echo isset($row['google'])? $row['google']:''; ?>" class="form-control" id="google"/>
                        </div><!-- /input-group -->
                        <br/>
                      <label>Url Dribbble</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-dribbble"></i>
                          </span>
                          <input type="text" name="dribble" value="<?php echo isset($row['dribble'])? $row['dribble']:''; ?>" class="form-control" id="dribble"/>
                        </div><!-- /input-group -->
                        <br/>
                      <label>Url LinkedIn</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-linkedin"></i>
                          </span>
                          <input type="text" name="linkedin" value="<?php echo isset($row['linkedin'])? $row['linkedin']:''; ?>" class="form-control" id="linkedin"/>
                        </div><!-- /input-group -->
                        <br/> 
                      <label>Url Skype</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-skype"></i>
                          </span>
                          <input type="text" name="skype" value="<?php echo isset($row['skype'])? $row['skype']:''; ?>" class="form-control" id="skype"/>
                        </div><!-- /input-group -->
                        <br/> 
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; &nbsp; SIMPAN DATA PERUSAHAAN</button>
                    </form>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal -->
        </div>
      </section>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validate/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#form-action").validate({
    rules:{
      no_rek:{
        required: true,
      },
      nm_rek:{
        required: true,
      },
      nm_bank:{
        required: true,
      },
    },

    messages: {
      no_rek: {
        required: "Nomor Rekening harap di isi",
       },
      nm_rek: {
        required: "Atas Nama harap di isi",
       },
      nm_bank: {
        required: "Nama Bank harap di isi",
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