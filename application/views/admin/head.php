<!DOCTYPE html>
<html style="height: auto; min-height: 100%;">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Penilaian Kinerja Dosen</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Chrome, Firefox OS and Opera -->
  <meta content='#f39c12' name='theme-color' />
  <!-- Windows Phone -->
  <meta content='#f39c12' name='msapplication-navbutton-color' />
  <!-- iOS Safari -->
  <meta content='yes' name='apple-mobile-web-app-capable' />
  <meta content='#f39c12' name='apple-mobile-web-app-status-bar-style' />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/bower_components/bootstrap/dist/css/bootstrap.min.css" ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/bower_components/font-awesome/css/font-awesome.min.css" ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/bower_components/Ionicons/css/ionicons.min.css" ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/dist/css/AdminLTE.min.css" ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/dist/css/skins/_all-skins.min.css" ?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/bower_components/morris.js/morris.css" ?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/bower_components/jvectormap/jquery-jvectormap.css" ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/bower_components/bootstrap-daterangepicker/daterangepicker.css" ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.css" ?>">
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/bower_components/datatables.net-bs/css/button.dataTables.min.css" ?>">
  <link rel="stylesheet" href="<?php echo base_url() . "assets/backend/bower_components/datatables.net-bs/css/select.dataTables.min.css" ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    .jqstooltip {
      position: absolute;
      left: 0px;
      top: 0px;
      visibility: hidden;
      background: rgb(0, 0, 0) transparent;
      background-color: rgba(0, 0, 0, 0.6);
      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
      -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
      color: white;
      font: 10px arial, san serif;
      text-align: left;
      white-space: nowrap;
      padding: 5px;
      border: 1px solid white;
      box-sizing: content-box;
      z-index: 10000;
    }

    .jqsfield {
      color: white;
      font: 10px arial, san serif;
      text-align: left;
    }
  </style>
</head>

<body class="sidebar-mini skin-yellow" style="height: auto; min-height: 100%;">