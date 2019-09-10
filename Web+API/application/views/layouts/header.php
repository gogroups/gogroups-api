<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Admin Panel </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Novus Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="<?php echo base_url('public/css/bootstrap.css') ?>" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="<?php echo base_url('public/css/style.css') ?>" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="<?php echo base_url('public/css/font-awesome.css'); ?>" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
<script src="<?php echo base_url('public/js/jquery-1.11.1.min.js'); ?>"></script>
<script src="<?php echo base_url('public/js/modernizr.custom.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('public/css/select2.min.css');?>">
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="<?php echo base_url('public/css/animate.css') ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url('public/css/jquery.dataTables.css'); ?>" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/toastr.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/toastr.min.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/datepicker.css');?>">
<script type="text/javascript" src="<?php echo base_url('public/js/jquery.validate.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/jquery.validate.min.js') ?>"></script>
<script src="<?php echo base_url('public/js/wow.min.js') ?>"></script>
<script src="<?php echo base_url('public/js/jquery.dataTables.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/toastr.js')?>?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/toastr.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/select2.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/datepicker.js');?>"></script>
     <script src="//cdn.datatables.net/plug-ins/1.10.16/api/fnFilterClear.js"> </script>



<script type="text/javascript" src=" https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.0/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.0/js/buttons.print.min.js "></script>


	<script>
		 new WOW().init();

		  $(document).ready(function () {
            $('#sellerTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
                 $('#all_category_data').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

            $('#adsTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
            $('#groupTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

      $('#couponCodeTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

        $('#bannerTable').DataTable({
       
       
    } );
        });
	</script>
<!--//end-animate-->
<!-- Metis Menu -->
<script src="<?php echo base_url('public/js/metisMenu.min.js') ?>"></script>
<script src="<?php echo base_url('public/js/custom.js') ?>"></script>
<link href="<?php echo base_url('public/css/custom.css') ?>" rel="stylesheet">
<!--//Metis Menu -->
</head> 