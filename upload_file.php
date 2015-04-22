<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=0.6, maximum-scale=2.0, user-scalable=yes" />
<title>View Photo Lightbox</title>
<?php include_once("include_meta.shtml"); ?>
<!--link href="css/secondary.css" rel="stylesheet" type="text/css"-->
    <!--Scripts-->
    <!-- ceebox and prereqs -->
    <script type='text/javascript' src='js/jquery.js'></script>
    <script type='text/javascript' src='js/jquery.swfobject.js' ></script>
    <script type='text/javascript' src='js/jquery.metadata.js'></script>
    <!--script type='text/javascript' src='js/jquery.color.js'></script>
    <script type='text/javascript' src='js/jquery.ceebox.js'></script-->
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!--script src="colorbox/jquery.colorbox-min.js"></script>
	<script src="colorbox/jquery.colorbox.js"></script-->
	
   
	<!--link rel="stylesheet" href="css/colorbox.css"-->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/secondary.css" rel="stylesheet" type="text/css">
    <!--link rel="stylesheet" href="css/ceebox.css" type="text/css" media="screen" /-->
    
    
	<!-- css for lightbox -->        
	<link type="text/css" rel="stylesheet" href="release/featherlight.min.css" title="Featherlight Styles" />
        <!-- css for the lightbox ends -->
    
	<script type="text/javascript">document.documentElement.className += " js";</script>

    <!--End Scripts-->
    <!--Analytics-->
     <?php include_once("include_analytics.shtml"); ?>
    <!--End Analytics-->
	<link href="css/style2-sp.css" rel="stylesheet" type="text/css">
</head>
<!--=======================================Web page Layout=========================================-->

<body>
<!--=====================================Main Content Area==========================================-->
<div class="container_12">
<!--===================================Navigation, Logo and IFAS searchbox=============================-->
      
      <div id="logo-search" class="grid_12">
    <!-- text area-->
    <div class="grid_4 omega push_8" id="ICS"> 
           <?php include_once("include_text.shtml"); ?>
        </div>
    
    <!--End text area--> 
    
    <!--Top Navigation Area-->
    <div class="grid_12 alpha"> 
            <?php include "include_top_nav_drop_down.shtml"; ?> 
        </div>
    <!--End Top Navigation Area--> 
    
  </div>
      <!--End Navigation, Logo and Search Box-->
	 
	 <div class="clear"></div> 
<!--<div style="width:960px; margin:0px auto;">-->
<div id="content" class="grid_12" >
<div class="white-wrapper">
<?php

//----upload images to temp folder "images/temp/"
$allowedExts = array("gif", "jpeg", "jpg", "png","GIF","JPEG","JPG","PNG");
$exceedFlag = 0;
foreach ($_FILES["pictures"]["type"] as $key => $type){
	$exceedFlag = 1;
	//get the extension
	$temp = explode(".", $_FILES["pictures"]["name"][$key]);
	$extension = end($temp);
	//check file type and extension
	if ((($type == "image/gif")
	|| ($type == "image/jpeg")
	|| ($type == "image/jpg")
	|| ($type == "image/pjpeg")
	|| ($type == "image/x-png")
	|| ($type == "image/png"))
	&& in_array($extension, $allowedExts)) {
		if ($_FILES["pictures"]["error"][$key] > 0) {
			echo "Return Code: " . $_FILES["pictures"]["error"][$key] . "<br><br>";
		} else {		
			if (file_exists("images/hi-res/" . $_FILES["pictures"]["name"][$key])) {
				echo "<strong style='font-size:1rem;'>".$_FILES["pictures"]["name"][$key] . 
				"</strong>: <br>Already exists, successfully updated". "<br>";
			} else {
				echo "<strong style='font-size:1rem;'>".$_FILES["pictures"]["name"][$key] . 
				"</strong>: <br>Successfully uploaded". "<br>";				
			}
			move_uploaded_file($_FILES["pictures"]["tmp_name"][$key],"images/temp/" . $_FILES["pictures"]["name"][$key]);
			//echo "Stored in: " . "upload/" . $_FILES["pictures"]["name"][$key] . "<br><br>";
			echo "Type: " . $type . "<br>";
			echo "Size: " . round($_FILES["pictures"]["size"][$key] / 1024 / 1024 , 2) . " MB<br><br>";
			//echo "Temp file: " . $_FILES["pictures"]["tmp_name"][$key] . "<br>";
		}
	} else {
		echo 
		 
		
		"<h1>Failed to upload <span><br>". 
		$_FILES["pictures"]["name"][$key] .":&nbsp;Invalid file or it exceeds the maximum upload file size</span></h1> <br><br>";
	}
}

if($exceedFlag == 0){
	echo "<h1> Failed to upload <br><span>The uploaded files exceed the maximum upload file size</span> </h1> <br><br>";
}
else{


	//----scan temp folder "images/upload/" to extract metadata and generate metadata.php
	$commandoutput = "";
	$directory = "images/temp/";
			
	//Exiftool	
	
	// Location of exiftool.exe on server
	$exifcommand = "exiftool.exe ";
	// Output Type
	$exifcommand .= "-php ";
	// Metadata fields to collect
	$exifcommand .= "-SourceFile -FileName -CreateDate -Writer-Editor -Description -Keywords -ImageWidth -ImageHeight ";
	$exifcommand .= "-ColorMode -Creator -Credit -Source -FileSize -XResolution -YResolution ";
	// Image Directory to scan
	$exifcommand .= $directory . " ";
	// File to output data
	$exifcommand .= "> " . "images/metadata.php";

	unset($commandoutput);
	$commandoutput = array();

	// Execute Exiftool command
	exec($exifcommand, $commandoutput, $outputtest);



	//generate low-res and thumbnail
	include_once ("generate_thumbnail.php");


	//----upload metadata to database and move all the images from temp folder to "images/hi-res"

	// Location of PHP Metadata Array that was just created
	$mdarrayfile = "images/metadata.php";

	// Launch Metadata Upload script
	include_once ("metadata-upload.php");
	
}
echo"<p><a href='admin.php'>Upload more images</a></p>";
?></div>
  </div>
<div id="push" style="height:67em;"></div>
<div class="clear"></div>

<!--Footer-->

<div id="footer" style="height:9em;"> 
      <?php include_once("include_footer.shtml"); ?>
      Last Modified: <!-- #BeginDate format:Am1 -->March 6, 2015<!-- #EndDate --> 
    </div>
	
<!--</div>-->
</div>
<div id="footer-resources-background"> </div>
<div class="clear"></div>
<div id="footer-wrapper"> </div>

	<!-- scripts for the lightbox -->
	<script src="http://code.jquery.com/jquery-1.7.0.min.js"></script>
	<script src="release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
	<!-- scripts for the lightbox ends here -->
    
	</body>
</html>



