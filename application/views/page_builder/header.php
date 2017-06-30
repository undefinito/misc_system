<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title><?php echo empty($title)?'':$title ?></title>

	<!-- icon -->
	<link rel="shortcut icon" href="<?php echo asset_url('img/icon.png') ?>">

	<!-- BOOTSTRAP -->
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url('libs/bootstrap/css/bootstrap.min.css') ?>" />
	<!-- ADMINLTE -->
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url('libs/admin_lte/css/AdminLTE.min.css') ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url('libs/admin_lte/css/skins/skin-black.min.css') ?>" />
	<!-- FONTAWESOME -->
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url('libs/fontawesome/css/font-awesome.min.css') ?>">
	<!-- DATATABLES -->
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url('libs/datatables/DataTables-1.10.15/css/dataTables.bootstrap.min.css') ?>">
	<!-- SYSTEM-SPECIFIC CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url('scss/main.css') ?>">
</head>