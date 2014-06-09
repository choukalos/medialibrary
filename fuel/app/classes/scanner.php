<?php 

use \Model\Video;
use \Thumbnail;

class Scanner {
	var $mediafiletypes = array();
	var $ffmpeglocation;
	var $thumbnailer;
	
	function __construct( $ffmpeglocation, array $mediafiletypes) {
//	  if (is_null($ffmpeglocation)) { $this->ffmpeglocation = $ffmpeglocation; }
//	  if (is_null($mediafiletypes)) { $this->mediafiletypes = $mediafiletypes; }
      $this->ffmpeglocation = $ffmpeglocation;
      $this->mediafiletypes = $mediafiletypes;
	  $thumblocation = DOCROOT . "/assets/img/thumbs";
	  $this->thumbnailer    = new \Thumbnail($ffmpeglocation,$thumblocation,"00:00:04.1", "160x120");
      return $this;
	}

    /**
	 * get_media_info returns all media info given a fully qualified filename
	 */
	public function get_media_info($filename) {
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

    /**
	 * scan_directory scans (recursively) a directory for media files
	 */
	public function scan_directory($basedir) {
	  $h_dir   = opendir($basedir);
	  while (false !== ($fname = readdir($h_dir))) {
		// process current directory
		if ($fname{0} == '.') continue;
		// check if directory else process the media file
		if (is_dir($basedir . $fname)) {
			echo "...Found directory:  $fname - calling recursively...\n";
			$this->scan_directory($basedir . $fname ."/");
		} else {
		  // Process file 
		  $path_info = pathinfo($basedir . $fname);
		  $dirname   = $path_info['dirname'] . "/";
		  $basename  = $path_info['basename'];
		  $fileext   = $path_info['extension'];
		  if (in_array($fileext,$this->mediafiletypes)) {
		    list($duration,$width,$height) = $this->get_media_info($basedir . "/" . $fname);
			// generate thumbnails for mediafiles....
			$video         = array( "filename"  => $basename,
			                        "extension" => $fileext,
								    "duration"  => $duration,
								    "width"     => $width,
								    "height"    => $height,
								    "directory" => $dirname,
								    "thumbnail" => "not supplied", );
		    echo " > $basename $fileext $duration $width $height $dirname\n";		
			// check if record exists;  if not add to video model
			$query = Model_Video::query()->where('filename', $video['filename'])->where('directory', $video['directory']);
			if ($query->count() == 0) {
				// record not found;  add the entry
				$new = Model_Video::forge($video);
				$new->save();
				$obj = $this->thumbnailer;
				$thumbfile = $obj->create($basedir . $fname, $new->id);
			} else {
				echo " Found record for $basename in $dirname; skipping \n";
			}
				
		  }
	    }
		// end of while loop
	  }  
	  // End of Function
	}
	
	// end of the class
}
	
?>