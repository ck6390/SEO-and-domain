<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seo Admin Panel</title>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-Icon" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-submenu.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">

    <!-- Latest compiled and minified JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>

   <!-- DataTables CSS -->
    <link href="<?php echo base_url(); ?>assets/datatables/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
   
	<?php date_default_timezone_set('Asia/Kolkata'); ?>

     <!--gallery-->
     <link rel="stylesheet" href="<?php echo base_url();?>assets/css/touchTouch.css">
     <script src="<?php echo base_url();?>assets/js/touchTouch.jquery.js"></script>
     <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/password_strength_lightweight.js"></script> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/password_strength.css">
    <script>
    $(document).ready(function($) {      
      $('#mySecondPassword').strength_meter({
            inputClass: 'c_strength_input',
            strengthMeterClass: 'c_strength_meter',
            toggleButtonClass: 'c_button_strength'
            });        
    });
</script>
</head>
<body>