<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- <title><?php echo $CI->_page_title ?></title> -->
        <title>Aplikasi Sistem Online STIKES KESOSI</title>
        <meta http-equiv="X-UA-Compatible" content="chrome=1" />
        <link href="<?php echo theme_url('css/fonts/stylesheet.css') ?>" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo theme_url('css/user.css') ?>" rel="stylesheet" type="text/css" media="all" />

        <script type="text/javascript" src="<?php echo theme_url('scripts/jquery.tools.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo theme_url('scripts/jquery.easing.1.3.js') ?>"></script>
        <script type="text/javascript" src="<?php echo theme_url('scripts/jquery.wysiwyg.js') ?>"></script>
        <script type="text/javascript" src="<?php echo theme_url('scripts/jquery.scroller.js') ?>"></script>
        <script type="text/javascript" src="<?php echo theme_url('scripts/jquery.positionPicker.js') ?>"></script>
        <script type="text/javascript" src="<?php echo theme_url('scripts/xn.js') ?>" data-xn-config="baseUrl: '<?php echo base_url() ?>'"></script>

        <link rel="shortcut icon" href="<?php echo theme_url('images/kesosi.ico') ?>" />
        <script type="text/javascript">
            $(function() {
                var setSystemDate = function() {
                    var dt = new Date();
                    $('#system-datetime').html(dt.format("dd/mm/yyyy hh:MM:ss"));
                };
                setSystemDate();
                setInterval(setSystemDate, 1000);
                try {
                    $("#fader").fadeIn(1000, function() {
                        xn.helper.form_resizer ();
                    });
                    $("#fader").css({
                        "width": "100%",
                        "height": "100%"
                    });
                    xn.helper.form_resizer ();

                } catch (e) {}
            });
        </script>
    </head>
    <body>
        <div id="fader">
            <div class="background">
                <!-- header -->
                <div id="main-header">
                    <div class="left">
                        <img src="<?php echo theme_url('images/kesosi.png') ?>" width="60" height="60" alt="" />
                    </div>
                    <div class="left">
                        <h1>Sistem Informasi Online</h1>
                        <h2>Sekolah Tinggi Ilmu Kesehatan Kesetiakawanan Sosial Indonesia</h2>
                    </div>
                    <div class="right">
                        <div>
                            Selamat Datang
                            <?php if ($CI->_get_user()->is_login): ?>
                            , <?php echo $CI->_get_user()->name ?> ( <?php echo $CI->_get_user()->groups[0]['name'] ?> )
                            <?php endif ?>
                        </div>
                        <div id="system-datetime">
                        </div>
                    </div>
                    <hr />
                </div>
                <div id="layout-header">
                    <div class="wrapper">
                        <?php if ($CI->auth->is_login()): ?>
                            <?php echo $this->admin_panel->show() ?>
                        <?php endif ?>
                    </div>
                </div>
                <!-- end header -->
                <div id="layout-slide">
                    <div id="layout-body">
                        <div class="wrapper">
                            <?php echo widget_view($CI->_view, $CI->_data); ?>
                        </div>
                    </div>

                    <div id="layout-footer">
                        <div id="footer-copyright">
                            <p>Copyright &copy; 2016 Stikes Kesosi. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
