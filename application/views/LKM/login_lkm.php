<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Penilaian Kinerja Dosen | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Chrome, Firefox OS and Opera -->
  <meta content='#d2d6de' name='theme-color' />
  <!-- Windows Phone -->
  <meta content='#d2d6de' name='msapplication-navbutton-color' />
  <!-- iOS Safari -->
  <meta content='yes' name='apple-mobile-web-app-capable' />
  <meta content='#d2d6de' name='apple-mobile-web-app-status-bar-style' />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/bower_components/bootstrap/dist/css/bootstrap.min.css" ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/bower_components/font-awesome/css/font-awesome.min.css" ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/bower_components/Ionicons/css/ionicons.min.css" ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/dist/css/AdminLTE.min.css" ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/plugins/iCheck/square/blue.css" ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/backend/pnotify/dist/pnotify.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/backend/pnotify/dist/pnotify.buttons.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/backend/pnotify/dist/pnotify.nonblock.css') ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="<?php echo base_url(); ?>"><b>E-Survey</b><br>Penilaian Kinerja Dosen</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg"><b>Login LKM</b><br>Sign in to start your session</p>

      <form method="post" action="<?php echo base_url('Kuisioner/proses_login_lkm'); ?>">
        <div class="input-group" style="margin-bottom: 20px;">
          <span class="input-group-addon "><i class="glyphicon glyphicon-user"></i></span>
          <input type="text" name="username" class="form-control" placeholder="Username">
        </div>
        <div class="input-group" style="margin-bottom: 20px;">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock "></i></span>
          <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat" id="login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/backend/bower_components/jquery/dist/jquery.min.js') ?>"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url('assets/backend/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url('assets/backend/plugins/iCheck/icheck.min.js') ?>"></script>
  <!-- PNotify -->
  <script src="<?php echo base_url('assets/backend/pnotify/dist/pnotify.js') ?>"></script>
  <script src="<?php echo base_url('assets/backend/pnotify/dist/pnotify.buttons.js') ?>"></script>
  <script src="<?php echo base_url('assets/backend/pnotify/dist/pnotify.nonblock.js') ?>"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#login').on('click', function(e) {
        e.preventDefault();

        $.ajax({
          type: $('form').attr("method"),
          url: $('form').attr("action"),
          data: $('form').serialize(),
          success: function(i) {
            if (i == 'true') {
              new PNotify({
                title: 'Success',
                text: 'Login Berhasil, Tunggu Sebentar',
                type: 'success',
                hide: true,
                styling: 'bootstrap3'
              });
              window.location.replace("<?= base_url('Dashboard_user') ?>");
            } else if (i == 'false') {
              new PNotify({
                title: 'Gagal',
                text: 'Login Gagal, Username dan Password tidak cocok dengan user manapun!',
                type: 'warning',
                hide: true,
                styling: 'bootstrap3'
              });
            } else if (i == 'false1') {
              new PNotify({
                title: 'Gagal',
                text: 'Login Gagal, Username dan Password Salah!',
                type: 'warning',
                hide: true,
                styling: 'bootstrap3'
              });
            }
          }
        });

      });
    });
  </script>

</body>

</html>