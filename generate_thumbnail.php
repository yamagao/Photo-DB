<?php
function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth_horizontal, $thumbHeight_vertical ) 
{
	// open the directory
	$dir = opendir( $pathToImages );

	// loop through it, looking for any/all JPG files:
	while (false !== ($fname = readdir( $dir ))) {
/*		if(file_exists($pathToThumbs.$fname)){
			//echo $pathToThumbs.$fname."<br><img src='".$pathToThumbs.$fname."'>";
			unlink($pathToThumbs.$fname);	
		}
*/		
		// load image and get image size
		$img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
		$width = imagesx( $img );
		$height = imagesy( $img );
		
		// if the image is horizontal
		if($width > $height){
			// calculate thumbnail size
			$new_width = $thumbWidth_horizontal;
			$new_height = floor( $height * ( $thumbWidth_horizontal / $width ) );
		}
		// if the image is vertical
		else{
			// calculate thumbnail size
			$new_height = $thumbHeight_vertical;
			$new_width = floor( $width * ( $thumbHeight_vertical / $height ) );
		}

		// create a new temporary image
		$tmp_img = imagecreatetruecolor( $new_width, $new_height );

		// copy and resize old image into new image 
		imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

		// add water mark for low-res
		if(file_exists($pathToThumbs."stamp.png")){
			// Load the stamp and the photo to apply the watermark to
			$stamp = imagecreatefrompng($pathToThumbs."stamp.png");
			// Set the margins for the stamp and get the height/width of the stamp image
			$sx = imagesx($stamp);
			$sy = imagesy($stamp);

			// Copy the stamp image onto our photo using the margin offsets and the photo 
			// width to calculate positioning of the stamp. 
			imagecopy($tmp_img, $stamp, imagesx($tmp_img)/2 - $sx/2, imagesy($tmp_img)/2 - $sy/2, 0, 0, imagesx($stamp), imagesy($stamp));
		}
		
		// save thumbnail into a file
		imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
	}
	// close the directory
	closedir( $dir );
}
// call createThumb function and pass to it as parameters the path 
// to the directory that contains images, the path to the directory
// in which thumbnails will be placed and the thumbnail's width. 
// We are assuming that the path will be a relative path working 
// both in the filesystem, and through the web for links
createThumbs("images/temp/","images/thumbnail/",400, 400);//200,200
createThumbs("images/temp/","images/low-res/",400, 400);//400,400
//createThumbs("images/hi-res/","images/thumbnail/",200, 200);
//createThumbs("images/hi-res/","images/low-res/",300, 300);
?>