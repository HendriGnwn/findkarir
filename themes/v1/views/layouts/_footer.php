<?php

use app\helpers\Url;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!--=== Footer Version 3 ===-->
<div class="footer-v3">
    <div class="footer">
        <div class="container">
            <div class="row">
                <!-- About -->
                <div class="col-md-3 md-margin-bottom-40">
                    <a href="<?= Url::home() ?>"><img id="logo-footer" class="footer-logo" src="<?= Url::to('data/img/logo.png') ?>" alt="" width="150px">
                    </a>
                    <p>About Unify dolor sit amet, consectetur adipiscing elit. Maecenas eget nisl id libero tincidunt sodales.</p>
                    <p>Duis eleifend fermentum ante ut aliquam. Cras mi risus, dignissim sed adipiscing ut, placerat non arcu.</p>
                </div>
                <!--/col-md-3-->
                <!-- End About -->

                <div class="col-md-3 md-margin-bottom-40">
                    <div class="thumb-headline">
                        <h2><b><?= Yii::t('app.label', 'About Us') ?></b></h2>
                    </div>
                    <ul class="list-unstyled simple-list margin-bottom-20">
                        <li><a href="#">Background</a>
                        </li>
                        <li><a href="#">Carier with us</a>
                        </li>
                    </ul>
                </div>
                <!--/col-md-3-->

                <div class="col-md-3">
                    <div class="thumb-headline">
                        <h2><b><?= Yii::t('app.label', 'Find Jobs') ?></b></h2>
                    </div>
                    <ul class="list-unstyled simple-list margin-bottom-20">
                        <li><a href="#">Based on Position</a>
                        </li>
                        <li><a href="#">Based on Location</a>
                        </li>
                        <li><a href="#">Based on Company</a>
                        </li>
                    </ul>
                </div>
                <!--/col-md-3-->

                <div class="col-md-3">
                    <div class="thumb-headline">
                        <h2><b><?= Yii::t('app.label', 'Companies') ?></b></h2>
                    </div>
                    <ul class="list-unstyled simple-list margin-bottom-20">
                        <li><a href="#">Apply Jobs</a>
                        </li>
                        <li><a href="#">Term and Conditions</a>
                        </li>
                    </ul>
                </div>
                <!--/col-md-3-->
            </div>
        </div>
    </div>
    <!--/footer-->

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; FindKarir.com 2017. Hak cipta Dilindungi Undang-Undang</p>
                </div>
                <!-- Social Links -->
                <div class="col-md-6">
                    <ul class="social-icons pull-right">
                        <li>
                            <a href="#" data-original-title="Facebook" class="rounded-x social_facebook"></a>
                        </li>
                        <li>
                            <a href="#" data-original-title="Twitter" class="rounded-x social_twitter"></a>
                        </li>
                        <li>
                            <a href="#" data-original-title="Goole Plus" class="rounded-x social_googleplus"></a>
                        </li>
                        <li>
                            <a href="#" data-original-title="Linkedin" class="rounded-x social_linkedin"></a>
                        </li>
                        <li>
                            <a href="#" data-original-title="Pinterest" class="rounded-x social_pintrest"></a>
                        </li>
                    </ul>
                </div>
                <!-- End Social Links -->
            </div>
        </div>
    </div>
    <!--/copyright-->
</div>
<!--=== End Footer Version 3 ===-->