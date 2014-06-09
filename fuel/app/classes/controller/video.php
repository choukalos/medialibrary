<?php
class Controller_Video extends Controller_Template{

	public function action_index()
	{
		$data['videos'] = Model_Video::find('all');
		$this->template->title = "Videos";
		$this->template->content = View::forge('video/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('video');

		if ( ! $data['video'] = Model_Video::find($id))
		{
			Session::set_flash('error', 'Could not find video #'.$id);
			Response::redirect('video');
		}

		$this->template->title = "Video";
		$this->template->content = View::forge('video/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Video::validate('create');
			
			if ($val->run())
			{
				$video = Model_Video::forge(array(
					'filename' => Input::post('filename'),
					'extension' => Input::post('extension'),
					'duration' => Input::post('duration'),
					'width' => Input::post('width'),
					'height' => Input::post('height'),
					'directory' => Input::post('directory'),
					'thumbnail' => Input::post('thumbnail'),
				));

				if ($video and $video->save())
				{
					Session::set_flash('success', 'Added video #'.$video->id.'.');

					Response::redirect('video');
				}

				else
				{
					Session::set_flash('error', 'Could not save video.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Videos";
		$this->template->content = View::forge('video/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('video');

		if ( ! $video = Model_Video::find($id))
		{
			Session::set_flash('error', 'Could not find video #'.$id);
			Response::redirect('video');
		}

		$val = Model_Video::validate('edit');

		if ($val->run())
		{
			$video->filename = Input::post('filename');
			$video->extension = Input::post('extension');
			$video->duration = Input::post('duration');
			$video->width = Input::post('width');
			$video->height = Input::post('height');
			$video->directory = Input::post('directory');
			$video->thumbnail = Input::post('thumbnail');

			if ($video->save())
			{
				Session::set_flash('success', 'Updated video #' . $id);

				Response::redirect('video');
			}

			else
			{
				Session::set_flash('error', 'Could not update video #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$video->filename = $val->validated('filename');
				$video->extension = $val->validated('extension');
				$video->duration = $val->validated('duration');
				$video->width = $val->validated('width');
				$video->height = $val->validated('height');
				$video->directory = $val->validated('directory');
				$video->thumbnail = $val->validated('thumbnail');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('video', $video, false);
		}

		$this->template->title = "Videos";
		$this->template->content = View::forge('video/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('video');

		if ($video = Model_Video::find($id))
		{
			$video->delete();

			Session::set_flash('success', 'Deleted video #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete video #'.$id);
		}

		Response::redirect('video');

	}


}
