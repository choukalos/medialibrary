<?php

namespace Fuel\Tasks;
use \Scanner;

class Scan {
	/**
	 * This method gets ran when a valid method name is not used in the command.
	 *
	 * Usage (from command line):
	 *
	 * php oil r scan
	 *
	 * @return string
	 */
	public function run($args = NULL)
	{
		echo "\n===========================================";
		echo "\nRunning DEFAULT task [Scan:Run]";
		echo "\n-------------------------------------------\n\n";

		/***************************
		 Put in TASK DETAILS HERE
		 **************************/
		$basedir    = DOCROOT . "public/assets/video/"; 
		$FFMPEGEXEC = `which ffmpeg`;
		$MEDIATYPES = array("m4v");
		$scanner    = new \Scanner($FFMPEGEXEC,$MEDIATYPES);
		$scanner->scan_directory($basedir);	
	}



	/**
	 * This method gets ran when a valid method name is not used in the command.
	 *
	 * Usage (from command line):
	 *
	 * php oil r scan:index "arguments"
	 *
	 * @return string
	 */
	public function index($args = NULL)
	{
		echo "\n===========================================";
		echo "\nRunning task [Scan:Index]";
		echo "\n-------------------------------------------\n\n";

		/***************************
		 Put in TASK DETAILS HERE
		 **************************/
	}

}
/* End of file tasks/scan.php */
