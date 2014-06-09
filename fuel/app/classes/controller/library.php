<?php

class Controller_Library extends Controller_Template
{

	public function action_index()
	{
		// Load up a paginated list of videos to be displayed
		$countVideos = Model_Video::query()->count();
		$pagination  = Pagination::forge('pagedvideos', array(
		    'pagination_url' => '/',
		    'total_items'    => $countVideos,
		    'per_page'       => 16,
		    'uri_segment'    => 'page',
		));
		$data['videos']     = Model_Video::query()->limit($pagination->per_page)->offset($pagination->offset)->get();
		$data['pagination'] = $pagination->render();
		$data["subnav"]     = array('index'=> 'active' );
		Asset::add_path('assets/images/thumbs/', 'img');
		
		// render
		$this->template->title = 'Library &raquo; Index';
		$this->template->content = View::forge('library/index', $data);
	}

	/*
    public function action_play($id = null) 
	{
		// find video to play
		is_null($id) and Response::redirect('library');
		
		if (! $data['video'] = Model_Video::find($id)) {
			Session::set_flash('error', 'Could not find video #' . $id );
			Response::redirect('library');
		}
		
		// Setup and stream video file
		$filenm   = escapeshellcmd($data['video']['directory'] . $data['video']['filename']);
		$fp       = @fopen( $filenm );
		$size     = filesize( $filenm );
		//$size   = file_exists( escapeshellcmd($filenm) );
		$length = $size;           // Content length
		$start  = 0;               // Start byte
		$end    = $size - 1;       // End byte
		header('Content-type: video/mp4');
		header("Accept-Ranges: 0-$length");
		header("Accept-Ranges: bytes");
		if (isset($_SERVER['HTTP_RANGE'])) {
		    $c_start = $start;
		    $c_end   = $end;
		    list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
		    if (strpos($range, ',') !== false) {
		        header('HTTP/1.1 416 Requested Range Not Satisfiable');
		        header("Content-Range: bytes $start-$end/$size");
		        exit;
		    }
		    if ($range == '-') {
		        $c_start = $size - substr($range, 1);
		    } else {
				$range   = explode('-', $range);
				$c_start = $range[0];
				$c_end   = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
		    }
		    $c_end = ($c_end > $end) ? $end : $c_end;
		    if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size) {
				        header('HTTP/1.1 416 Requested Range Not Satisfiable');
				        header("Content-Range: bytes $start-$end/$size");
				        exit;
		    }
		    $start  = $c_start;
		    $end    = $c_end;
		    $length = $end - $start + 1;
		    fseek($fp, $start);
		    header('HTTP/1.1 206 Partial Content');
		}
		header("Content-Range: bytes $start-$end/$size");
		header("Content-Length: ".$length);
		$buffer = 1024 * 8;
		while(!feof($fp) && ($p = ftell($fp)) <= $end) {
		  if ($p + $buffer > $end) {
			  $buffer = $end - $p + 1;
		  }
		  set_time_limit(0);
		  echo fread($fp, $buffer);
		  flush();
		}
		fclose($fp);
		//exit;
		// end of streamed video	
		
	}
	*/
	

	public function action_play($id = null)
	{
		// find video to play
		is_null($id) and Response::redirect('library');
		
		if (! $data['video'] = Model_Video::find($id)) {
			Session::set_flash('error', 'Could not find video #' . $id );
			Response::redirect('library');
		}
		$this->template->title = 'Play Video ' . $data['video']['filename'];
		$this->template->content = View::forge('library/play', $data);
	}
	
	public function action_scan()
	{
	    $basedir    = DOCROOT . "/assets/video/"; 
	    $FFMPEGEXEC = `which ffmpeg`;
		$MEDIATYPES = array("m4v");
		$scanner    = new \Scanner($FFMPEGEXEC,$MEDIATYPES);
		$scanner->scan_directory($basedir);
	    Session::set_flash('notice', "Scanning media files ...");
	    Response::redirect('library');		
	}

}
