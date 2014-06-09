<?php
$basedir = "/Users/cchoukalos/Movies/"; 
$FFMPEGEXEC = "/usr/local/bin/ffmpeg";
$MEDIATYPES = array("m4v","avi","mpg","mkv","flv");
	
function get_media_info($filename) {
	global $FFMPEGEXEC;
	$cmd     = "$FFMPEGEXEC -i \"$filename\" 2>&1";
	//echo " >Exec CMD: $cmd \n";
	$cmdinfo = shell_exec($cmd);
	preg_match('/Duration\: (.+), start/',$cmdinfo,$durationmatches);
	if (count($durationmatches) > 0) {
	  // list($hours,$mins,$secs) = explode(':',$durationmatches[1]);
	  // $duration                = mktime($hours,$mins,$secs) - mktime(0,0,0);
	  $duration = $durationmatches[1];
    } else {
	  $duration = 0;
    }
	preg_match('/, (\d+)x(\d+) /',$cmdinfo,$resolutionmatches);
	if (count($resolutionmatches) > 2) {
  	  $width    = $resolutionmatches[1];
  	  $height   = $resolutionmatches[2];
    } else {
	  $width  = 0;
	  $height = 0;
	}
	return array($duration,$width,$height);
}	

function scan_directory($basedir) {
  global $MEDIATYPES;
  $h_dir   = opendir($basedir);
//  $rc      = array();
  while (false !== ($fname = readdir($h_dir))) {
	// process current directory
	if ($fname{0} == '.') continue;
	// check if directory else process the media file
	if (is_dir($basedir . $fname)) {
		echo "...Found directory:  $fname - calling recursively...\n";
		scan_directory($basedir . $fname ."/");
//		array_merge( $rc, scan_directory($basedir . $fname) );
	} else {
	  // Process file 
	  $path_info = pathinfo($basedir . $fname);
	  $dirname   = $path_info['dirname'] . "/";
	  $basename  = $path_info['basename'];
	  $fileext   = $path_info['extension'];
	  if (in_array($fileext,$MEDIATYPES)) {
	    list($duration,$width,$height) = get_media_info($basedir . $fname);
//		$rc = push( list($basename,$fileext,$duration,$width,$height,$dirname ) );
	    echo " > $basename $fileext $duration $width $height $dirname \n";
	  }
    }
	// end of while loop
  }  
  // End of Function
}
	
scan_directory($basedir);
	
	
	
	
	
	
?>