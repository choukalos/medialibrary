<?php
return array(
	//'_root_'  => 'welcome/index',  // The default route
	'_root_'  => 'library/index',  // default route
	'_404_'   => 'welcome/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),

);