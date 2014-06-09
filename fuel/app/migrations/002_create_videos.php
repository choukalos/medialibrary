<?php

namespace Fuel\Migrations;

class Create_videos
{
	public function up()
	{
		\DBUtil::create_table('videos', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'filename' => array('constraint' => 255, 'type' => 'varchar'),
			'extension' => array('constraint' => 255, 'type' => 'varchar'),
			'duration' => array('constraint' => 255, 'type' => 'varchar'),
			'width' => array('constraint' => 11, 'type' => 'int'),
			'height' => array('constraint' => 11, 'type' => 'int'),
			'directory' => array('constraint' => 255, 'type' => 'varchar'),
			'thumbnail' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('videos');
	}
}