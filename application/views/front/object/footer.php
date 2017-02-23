<!-- Start Footer Section -->
        <footer>
            <div class="container">
                <div class="row footer-widgets">
                    
                    
                    <div class="col-md-3 col-xs-12">
                        <div class="footer-widget twitter-widget">
                            <h4>Tentang jeLoker.com<span class="head-line"></span></h4>
                            <ul>
                                <?php
                                    $dataTentangLokeria = $this->fronModel->show('job_tentang WHERE id_k_tentang="1"', 'kategori', 'ASC');
                                    if($dataTentangLokeria!=''){
                                        foreach($dataTentangLokeria as $data){
                                ?>
                                <li>
                                    <a href="<?php echo base_url('berita/tentang/'.$data->id_tentang); ?>"><?php echo $data->kategori; ?></a>
                                </li>
                                <?php
                                        }
                                    }
                                ?>
                                <!-- <li>
                                    <p><a href="#">@GrayGrids </a> Lorem ipsum dolor et, consectetur adipiscing eli.</p>
                                    <span>28 February 2014</span>
                                </li> -->
                            </ul>
                        </div>
                    </div><!-- .col-md-3 -->
                    
                    <!-- Start Twitter Widget -->
                    <div class="col-md-3 col-xs-12">
                        <div class="footer-widget twitter-widget">
                            <h4>Pencari Kerja<span class="head-line"></span></h4>
                            <ul>
                                <?php
                                    $dataTentangLokeria = $this->fronModel->show('job_tentang WHERE id_k_tentang="3"', 'kategori', 'ASC');
                                    if($dataTentangLokeria!=''){
                                        foreach($dataTentangLokeria as $data){
                                ?>
                                <li>
                                    <a href="<?php echo base_url('berita/tentang/'.$data->id_tentang); ?>"><?php echo $data->kategori; ?></a>
                                </li>
                                <?php
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div><!-- .col-md-3 -->
                    <!-- End Twitter Widget -->

                    <div class="col-md-3 col-xs-12">
                        <div class="footer-widget twitter-widget">
                            <h4>Perusahaan<span class="head-line"></span></h4>
                            <ul>
                                <?php
                                    $dataTentangLokeria = $this->fronModel->show('job_tentang WHERE id_k_tentang="2"', 'kategori', 'ASC');
                                    if($dataTentangLokeria!=''){
                                        foreach($dataTentangLokeria as $data){
                                ?>
                                <li>
                                    <a href="<?php echo base_url('berita/tentang/'.$data->id_tentang); ?>"><?php echo $data->kategori; ?></a>
                                </li>
                                <?php
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div><!-- .col-md-3 -->

                    
                    <!-- Start Contact Widget -->
                    <div class="col-md-3 col-xs-12">
                        <div class="footer-widget contact-widget">
                            <h4>Hubungi Kami<span class="head-line"></span></h4>
                            <ul>
                                <li><span><i class="fa fa-phone-square"></i></span>&nbsp; <?php echo isset($no_telp)? $no_telp:''; ?></li>
                                <li><span><i class="fa fa-envelope"></i></span>&nbsp; <?php echo isset($email)? $email:''; ?></li>
                                <li><span><i class="fa fa-globe"></i></span>&nbsp; <?php echo isset($web)? $web:''; ?></li>
                            </ul>
                        </div>
                        <div class="footer-widget social-widget">
                            <h4>Follow Us<span class="head-line"></span></h4>
                            <ul class="social-icons">
                                <?php
                                    if(isset($facebook)? $facebook:''!=''){
                                ?>
                                <li>
                                    <a target="_TAB" class="facebook" href="http://<?php isset($facebook)? $facebook:''; ?>"><i class="fa fa-facebook"></i></a>
                                </li>
                                <?php
                                    }
                                    if(isset($twitter)? $twitter:''!=''){
                                ?>
                                <li>
                                    <a target="_TAB" class="twitter" href="http://<?php echo isset($twitter)? $twitter:''; ?>"><i class="fa fa-twitter"></i></a>
                                </li>
                                <?php
                                    }
                                    if(isset($google)? $google:''!=''){
                                ?>
                                <li>
                                    <a target="_TAB" class="google" href="http://<?php echo isset($google)? $google:''; ?>"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <?php
                                    }
                                    if(isset($dribbble)? $dribbble:''!=''){
                                ?>
                                <li>
                                    <a target="_TAB" class="dribbble" href="http://<?php echo isset($dribbble)? $dribbble:''; ?>"><i class="fa fa-dribbble"></i></a>
                                </li>
                                <?php
                                    }
                                    if(isset($linkedin)? $linkedin:''!=''){
                                ?>
                                <li>
                                    <a target="_TAB" class="linkdin" href="http://<?php echo isset($linkedin)? $linkedin:''; ?>"><i class="fa fa-linkedin"></i></a>
                                </li>
                                <?php
                                    }
                                    if(isset($skype)? $skype:''!=''){
                                ?>
                                <li>
                                    <a target="_TAB" class="skype" href="http://<?php echo isset($skype)? $skype:''; ?>"><i class="fa fa-skype"></i></a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div><!-- .col-md-3 -->
                    <!-- End Contact Widget -->

                    
                </div><!-- .row -->

                <!-- Start Copyright -->
                <div class="copyright-section">
                    <div class="row">
                        <div class="col-md-6">
                            <p>&copy; 2017 jeLoker.com -  All Rights Reserved <a target="_BLANK" href="http://atc.co.id">Jeloker.Com</a> </p>
                        </div><!-- .col-md-6 -->
                        <div class="col-md-6">
                            <ul class="footer-nav">
                                <li><a href="<?php echo base_url(); ?>">Beranda</a>
                                </li>
                                <li><a href="<?php echo base_url('bantuan'); ?>">Peta Situs</a>
                                </li>
                                <li><a href="#">Kebijakan Privasi</a>
                                </li>
                                <li><a href="<?php echo base_url('bantuan'); ?>">Bantuan</a>
                                </li>
                            </ul>
                        </div><!-- .col-md-6 -->
                    </div><!-- .row -->
                </div>
                <!-- End Copyright -->

            </div>
        </footer>
        <!-- End Footer Section -->
        
        
    </div>
    <!-- End Full Body Container -->