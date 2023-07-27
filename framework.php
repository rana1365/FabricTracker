<?php
session_start();
require_once("login/db_session_chk.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ZnZ Fabrics Tracing</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="jq-css/jquery-ui.css">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- for select search -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

     <!-- for datatable -->
    <link rel="stylesheet" href="bs-css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="bs-css/datatable.min.css">




    <!-- javascript -->


     <!-- <link rel="stylesheet" href="bs-css/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="bs-css/dataTables.bootstrap.css">
  <link rel="stylesheet" href="fa-css/css/font-awesome.min.css">
  <link rel="stylesheet" href="bs-css/datatable.min.css"> -->

  <script src="jq-js/jquery-3.5.1.min.js"></script>
  <script src="jq-js/jquery-ui.js"></script>
  <script src="jq-js/jquery.dataTable.min.js"></script>
  <script src="jq-js/html2pdf.bundle.min.js"></script>
  <script src="bs-js/bootstrap.min.js"></script> <!-- for bootstrap -->

  <script src="bs-js/datatable.min.js"></script> <!-- for data table -->
  <script src="bs-js/datatable.fixedHeader.min.js"></script> <!-- for data table -->
  <script src="bs-js/ddtf.js"></script> <!-- for data table -->

  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> <!-- for data table -->
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script> <!-- for data table -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> <!-- for data table -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> <!-- for data table -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> <!-- for data table -->
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script> <!-- for data table -->
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script> <!-- for data table -->

  <!-- Select2 -->
  <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
  <!-- Moment JS -->
  <script src="bower_components/moment/moment.js"></script>
  <!-- ChartJS -->
  <script src="bower_components/chart.js/Chart.js"></script>
  <!-- Slimscroll -->
  <!-- <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> -->
  <!-- FastClick -->
  <script src="bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- CK Editor -->
  <script src="bower_components/ckeditor/ckeditor.js"></script>
  <!-- Active Script -->

  <!-- select search choosen -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

  <!-- for barcode -->
  <script src="js_barcode/js_barcode.all.min.js"></script>
  <style>

		html, body
		{
			height: 100%;
		}


		#accordion .ui-accordion-content /* Just to make Accordion content as transparent */
		{
			  background:none;

		}


  </style>

  <script>

	  $( function()
	  {
			$("#accordion").accordion(
			{
					 heightStyle: "content", //another are heightStyle: "fill or auto",
					 collapsible: true
			}
			);
	  }
	  );

	  $( "#accordion" ).accordion( "option", "animate", 400 );

  	 //});
	 $(".accordion_menu").css({"color":"#C8D7E1","color":"#fff"});

	  function load_page(page_to_be_loaded)
	  {
		$("#row_for_display_bar").empty();
		$("#row_for_display_bar").load(page_to_be_loaded);
	  }

  </script>


</head>


<body style="zoom: 90%" class="hold-transition skin-blue sidebar-mini">

<!-- <div class="container"> -->
    <div class="container-fluid" style="height:100%; overflow:scroll; background-color:#F8F8F8;"> <!-- .container-fluid for width: 100% across all viewport and device sizes. -->

		  <div class="row" style="height:100%; width: 100%" id='single_row_for_whole_page'> <!-- Whole Screen has a single ROW  -->
            	<!-- Start of Menu Area -->
        				<?php

        					require_once('left_side_menu_bar/left_side_menu_bar_with_user_access.php');

        				?>
        				<!-- End of Menu Area -->

                    	<!-- Start of Content Area -->


        					<?php

        						require_once('content_area/top_bar.php');
        						require_once('content_area/display_section.php');




        					?>



                <?php
                  require_once('footer/footer.php');

                ?>

                <!-- End of Content Area -->

          </div> <!-- End of <div class="row"> -->

    </div> <!-- End of <div class="container-fluid" style="height:100%;">  -->

</body>
</html>
