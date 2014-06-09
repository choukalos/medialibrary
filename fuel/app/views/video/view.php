<h2>Viewing <span class='muted'>#<?php echo $video->id; ?></span></h2>

<p>
	<strong>Filename:</strong>
	<?php echo $video->filename; ?></p>
<p>
	<strong>Extension:</strong>
	<?php echo $video->extension; ?></p>
<p>
	<strong>Duration:</strong>
	<?php echo $video->duration; ?></p>
<p>
	<strong>Width:</strong>
	<?php echo $video->width; ?></p>
<p>
	<strong>Height:</strong>
	<?php echo $video->height; ?></p>
<p>
	<strong>Directory:</strong>
	<?php echo $video->directory; ?></p>
<p>
	<strong>Thumbnail:</strong>
	<?php echo $video->thumbnail; ?></p>

<?php echo Html::anchor('video/edit/'.$video->id, 'Edit'); ?> |
<?php echo Html::anchor('video', 'Back'); ?>