<?php 

class Thumbnail {
	var $ffmpeglocation;
	var $thumbnaildirectory;
	var $seconds;
	var $size;
	
	function __construct( $ffmpeglocation, $thumbnaildirectory, $seconds, $size) {
	  if(is_null($ffmpeglocation)) { $ffmpeglocation = 'ffmpeg'; }
	  $this->ffmpeglocation = $ffmpeglocation;
	  $this->thumbnaildirectory = $thumbnaildirectory;
	  $this->seconds = $seconds;
	  $this->size = $size;		
//	  if (is_null($ffmpeglocation))     { $this->ffmpeglocation     = $ffmpeglocation; } 
	  return $this;
	}
	
	public function create($mediafile,$id) {
	  $path_info = pathinfo($mediafile);
	  $dirname   = $path_info['dirname'] . "/";
	  $basename  = $path_info['basename'];
	  $filename  = $path_info['filename'];
	  $fileext   = $path_info['extension'];
	  $imagenm   = "$id" . ".png";
	  $imagefnm  = $this->thumbnaildirectory . "/" . $imagenm;
	  $cmd       = $this->ffmpeglocation . " -ss 00:00:04.01 -i \"$mediafile\" -f image2 -vframes 1 -s " . $this->size;
	  $cmd      .= " \"$imagefnm\" 2>&1";
	  shell_exec($cmd);	
	  return $imagenm;	
	}
}

?>
	