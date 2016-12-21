<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <meta http-equiv="X-UA-Compatible" content="chrome=1" />
        <link href="<?php echo theme_url('css/fonts/stylesheet.css') ?>" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo theme_url('css/user.css') ?>" rel="stylesheet" type="text/css" media="all" />
        <link type="image/x-icon" href="<?php echo theme_url('images/kesosi.ico') ?>" rel="Shortcut icon" />

        <script type="text/javascript" src="<?php echo theme_url('scripts/jquery.tools.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo theme_url('scripts/jquery.easing.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo theme_url('scripts/xn.js') ?>" data-xn-config="baseUrl: '<?php echo base_url() ?>'"></script>
        <script type="text/javascript" src="<?php echo theme_url('scripts/jquery.wysiwyg.js') ?>"></script>
        <!-- <title><?php echo $CI->_page_title; ?></title> -->
        <title>Aplikasi Sistem Online STIKES KESOSI</title>
        <script>
            $(document).ready(function() {
                $("#login-footer a").fancybox({
                    'titlePosition'		: 'inside',
                    'transitionIn'		: 'none',
                    'transitionOut'		: 'none'
                });
            });

            $(function() {
                try {
                    $("#fader").fadeIn(100);
                    $("#fader").css({
                        "width": "100%",
                        "height": "100%"
                    });
                    jQuery(function($){
                        $.supersized({
                            slideshow         : 1,
                            autoplay          :	1,
                            start_slide       : 1,	
                            stop_loop         :	0,
                            random            : 0,
                            slide_interval    : 5000,	
                            transition        : 6, 	
                            transition_speed  :	500,
                            new_window        :	1,
                            pause_hover       : 0,	
                            keyboard_nav      : 0,	
                            performance       :	0,
                            image_protect     :	1,
                            min_width         : 0,
                            min_height        : 0,
                            vertical_center   : 1,	
                            horizontal_center : 1,	
                            fit_always        :	0,
                            fit_portrait      : 0,		
                            fit_landscape     : 0,
                            slide_links       :	"blank",
                            thumb_links       :	0,
                            thumbnail_navigation :  0,		
                            progress_bar      :	0,
                            mouse_scrub       :	0
                        });
                    });
                } catch (e) {}
            });
<?php if (!empty($errors)): ?>
    $(function() {
        $('#login-area > div').shake({times:8, delay:150, pixels:50});
    });
<?php endif ?>
        </script>
    </head>
    <body>
        <div id="fader">
            <div id="login-main-header">
                    <div class="left">
                        <img src="<?php echo theme_url('images/kesosi.png') ?>" width="60" height="60" alt="" />
                    </div>
                    <div class="left">
                        <h1>Sistem Informasi Online</h1>
                        <h2>Sekolah Tinggi Ilmu Kesehatan Kesetiakawanan Sosial Indonesia</h2>
                    </div>
            </div>
            <div id="layout-error">
                <?php echo xview_error() ?>
            </div>

            <div id="layout-login">
                <div class="wrapper">
                    <div id="login-area">
                        <div>
                            <form action="" method="post">
                                <img src="<?php echo theme_url('images/logo_login.png') ?>" alt="Informasi Unpam" class="logo_login" />
                                <div>
                                    <label for="username"><?php echo _('Username :') ?></label>
                                    <input type="text" name="login" value=""/ placeholder="Input Nim / Username">
                                </div>
                                <div>
                                    <label for="password"><?php echo _('Password :') ?></label>
                                    <input type="password" name="password" value=""/ placeholder="Password">
                                </div>
                                <div>
                                    <input type="hidden" name="continue" value="" />
                                </div>
                                <div class="last">
                                    <input type="submit" value="Login" />
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- <div id="login-footer">
                        <div class="informasi"><a href="<?php echo theme_url('info.html') ?>">Info Applikasi</a></div>
                        <p>Copyright &copy; 2011 Mahasiswa Universitas Pamulang. All rights reserved.</p>
                    </div> -->
                </div>
            </div>
        </div>
    </body>
</html>
