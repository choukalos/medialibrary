<?php

namespace Fuel\Migrations;

class Create_videos_tags
{
	public function up()
	{
		\DBUtil::create_table('videos_tags', array(
			'video_id' => array('constraint' => 11, 'type' =>'int', 'unsigned' => true),
			'tag_id'   => array('constraint' => 11, 'type' =>'int', 'unsigned' => true),
		), array('video_id','tag_id'));
	}

	public function down()
	{
		\DBUtil::drop_table('videos_tags');
	}
}