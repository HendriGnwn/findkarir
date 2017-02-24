<?php

$config = $this->Config_Model;
$pages1 = $this->fronModel->show('page WHERE category=1', 'name', 'ASC');
$pages2 = $this->fronModel->show('page WHERE category=2', 'name', 'ASC');
$pages3 = $this->fronModel->show('page WHERE category=3', 'name', 'ASC');

?>
<!-- Start Footer Section -->
        <footer>
            <div class="container">
                <div class="row footer-widgets">
                    <div class="col-md-3 col-xs-12">
                        <div class="footer-widget twitter-widget">
                            <h4>Tentang jeLoker.com<span class="head-line"></span></h4>
                            <ul>
                                <?php foreach ($pages1 as $page) : ?>
                                <li>
                                    <a href="<?php echo base_url('page/detail/'.$page->slug); ?>"><?php echo $page->name; ?></a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div><!-- .col-md-3 -->
                    
                    <!-- Start Twitter Widget -->
                    <div class="col-md-3 col-xs-12">
                        <div class="footer-widget twitter-widget">
                            <h4>Pencari Kerja<span class="head-line"></span></h4>
                            <ul>
                                <?php foreach ($pages3 as $page) : ?>
                                <li>
                                    <a href="<?php echo base_url('page/detail/'.$page->slug); ?>"><?php echo $page->name; ?></a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div><!-- .col-md-3 -->
                    <!-- End Twitter Widget -->

                    <div class="col-md-3 col-xs-12">
                        <div class="footer-widget twitter-widget">
                            <h4>Perusahaan<span class="head-line"></span></h4>
                            <ul>
                                <?php foreach ($pages2 as $page) : ?>
                                <li>
                                    <a href="<?php echo base_url('page/detail/'.$page->slug); ?>"><?php echo $page->name; ?></a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div><!-- .col-md-3 -->

                    
                    <!-- Start Contact Widget -->
                    <div class="col-md-3 col-xs-12">
                        <div class="footer-widget contact-widget">
                            <h4>Hubungi Kami<span class="head-line"></span></h4>
                            <ul>
                                <li><span><i class="fa fa-phone-square"></i></span>&nbsp; <?php echo $config->get_app_contact_phone() ?></li>
                                <li><span><i class="fa fa-envelope"></i></span>&nbsp; <?php echo $config->get_app_contact_email() ?></li>
                                <li><span><i class="fa fa-globe"></i></span>&nbsp; <?php echo $config->get_app_main_url() ?></li>
                            </ul>
                        </div>
                        <div class="footer-widget social-widget">
                            <h4>Follow Us<span class="head-line"></span></h4>
                            <ul class="social-icons">
                                <li>
                                    <a target="_TAB" class="facebook" href="<?php echo $config->get_app_facebook() ?>"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a target="_TAB" class="twitter" href="<?php echo $config->get_app_twitter() ?>"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a target="_TAB" class="google" href="<?php echo $config->get_app_google() ?>"><i class="fa fa-google-plus"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- .col-md-3 -->
                    <!-- End Contact Widget -->

                    
                </div><!-- .row -->

                <!-- Start Copyright -->
                <div class="copyright-section">
                    <div class="row">
                        <div class="col-md-6">
                            <p>&copy; <?php echo date('Y') ?> <?php echo $config->get_app_name_url() ?> -  All Rights Reserved <a target="_BLANK" href="http://atc.co.id">Jeloker.Com</a> </p>
                        </div><!-- .col-md-6 -->
                        <div class="col-md-6">
                            <ul class="footer-nav">
                                <li><a href="<?php echo base_url(); ?>">Beranda</a>
                                </li>
<!--                                <li><a href="<?php //echo base_url('sitemap.'); ?>">Peta Situs</a>-->
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