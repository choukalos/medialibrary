<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Filename', 'filename', array('class'=>'control-label')); ?>

				<?php echo Form::input('filename', Input::post('filename', isset($video) ? $video->filename : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Filename')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Extension', 'extension', array('class'=>'control-label')); ?>

				<?php echo Form::input('extension', Input::post('extension', isset($video) ? $video->extension : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Extension')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Duration', 'duration', array('class'=>'control-label')); ?>

				<?php echo Form::input('duration', Input::post('duration', isset($video) ? $video->duration : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Duration')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Width', 'width', array('class'=>'control-label')); ?>

				<?php echo Form::input('width', Input::post('width', isset($video) ? $video->width : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Width')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Height', 'height', array('class'=>'control-label')); ?>

				<?php echo Form::input('height', Input::post('height', isset($video) ? $video->height : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Height')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Directory', 'directory', array('class'=>'control-label')); ?>

				<?php echo Form::input('directory', Input::post('directory', isset($video) ? $video->directory : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Directory')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Thumbnail', 'thumbnail', array('class'=>'control-label')); ?>

				<?php echo Form::input('thumbnail', Input::post('thumbnail', isset($video) ? $video->thumbnail : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Thumbnail')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>