<?php
session_start();
if ($_SESSION['admin'] !== true) {
	header('Location: secure/admin.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=0.6, maximum-scale=2.0, user-scalable=yes" />
<title>XXXXXXXX</title>

 <?php include 'include_meta.shtml';?>
<link href="css/secondary.css" rel="stylesheet" type="text/css">

<!-- featherlight lightbox -->
<link href="release/featherlight.min.css" type="text/css" rel="stylesheet" title="Featherlight Styles" />
<!--Scripts-->
<script type="text/javascript">document.documentElement.className += " js";</script>
 <?php include 'include_scripts.shtml';?>

<!--End Scripts-->
<!--Analytics-->
<?php include 'include_analytics.shtml';?>

<!--End Analytics-->
</head>
<!--=======================================Web page Layout=========================================-->

<body onload="popup()">
	<script>
	function popup() {
		$(document).ready(function() {
			$("#popup").click();
		});
	}
	</script>
	<?php 
		if($_SESSION['file_exceed_error'] === true){?>
			<a id="popup" href="#" data-featherlight=
			"<h2 style='font-size:2em; text-transform:none!important; margin-bottom:.5em; color:#428bca;'>Failed to upload</h2>
            <p style='font-size:1.2em;'>The uploaded files exceed the maximum upload file size</p>"
		></a>
		<?php $_SESSION['file_exceed_error'] = false;}
		else if($_SESSION['feature_upload'] === true){?>
			<a id="popup" href="#" data-featherlight=
			"<h2 style='font-size:2em; text-transform:none!important; margin-bottom:.5em; color:#428bca;'>Successfully uploaded</h2>
            <p style='font-size:1.2em;'>Featured photos are uploaded</p>"
		></a>
		<?php $_SESSION['feature_upload'] = false;}?>

<!--=====================================Main Content Area==========================================-->
<div class="container_12"> 
  <!--===================================Navigation, Logo and searchbox=============================-->
  
  <div id="logo-search" class="grid_12"><a id="XXX"  title="XXXXX" href="XXXXX">XXXXX</a> 
    <!-- Text area-->
    <div class="grid_4 omega push_8" id="ICS"> 
    <?php include 'include_text.shtml';?>
      
    </div>
    
    <!--End text area--> 
    
    <!--Top Navigation Area-->
    <div class="grid_12 alpha"> 
  
      <?php include 'include_top_nav_drop_down.shtml';?>
    </div>
    <!--End Top Navigation Area--> 
    
  </div>
  <!--End Navigation, Logo and Search Box-->
  
  <div class="clear"></div>
  <!--=============================Main Content Area===========================================-->
  <div id="content" class="grid_12">
    <div id="full-page-text">
    <h1>Photo Database Admin</h1>
    <div class="admin-photo-box grid_12">
   <form action="upload_file.php" method="post" enctype="multipart/form-data">
<div class="add-photos-database grid_12">
<input type="file" onchange="this.form.submit()" name="pictures[]" multiple><span>Add Photos to Database</span></div>
</form>
<form action="upload_file_feature.php" method="post" enctype="multipart/form-data">
<div class="add-feature-photos-database grid_12">
<input type="file" onchange="this.form.submit()" name="pictures[]" multiple><span>Add Featured Photos</span></div>
</form><div class="add-photos-database grid_12">
<span class="search"><a href="index.php">Search Photo Database</a></span></div></div></div>
  </div>
  <div class="clear"></div>
  <!--Footer-->
  <div id="footer">
  <?php include 'include_footer.shtml';?> 
  
    <div id="last-mod">Last Modified: <!-- #BeginDate format:Am1 -->April 20, 2015<!-- #EndDate --> </div>
  </div>
  <!--End Footer--> 
</div>
<div class="clear"></div>
<!--Social Media Box--><!--End Social Media Box--> 

<!--========================Featured: Our Services, Training, Branding============================--><!--End Featured Our Services, Training and Branding--> 

<!--===================================Featured Projects======================================--><!-- End Featured Projects -->

<div class="clear"></div>
<div id="footer-resources-background"> </div>
<div class="clear"></div>
<div id="footer-wrapper"> </div>

<!--End Main Content Area--> 

<!--PrettyPhoto Script--> 
<!--#include file="include_prettyphoto.shtml" --> 
<!--End PrettyPhoto Script--> 
<!--End Web Page layout-->
<script src="assets/js/jquery.min.js"></script>
<script src="release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
