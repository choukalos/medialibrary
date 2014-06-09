<?php
use Orm\Model;

class Model_Video extends Model
{
	protected static $_properties = array(
		'id',
		'filename',
		'extension',
		'duration',
		'width',
		'height',
		'directory',
		'thumbnail',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

    protected static $_many_many = array('tags');
	
	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('filename', 'Filename', 'required|max_length[255]');
		$val->add_field('extension', 'Extension', 'required|max_length[255]');
		$val->add_field('duration', 'Duration', 'required|max_length[255]');
		$val->add_field('width', 'Width', 'required|valid_string[numeric]');
		$val->add_field('height', 'Height', 'required|valid_string[numeric]');
		$val->add_field('directory', 'Directory', 'required|max_length[255]');
		$val->add_field('thumbnail', 'Thumbnail', 'required|max_length[255]');

		return $val;
	}

}
