<h2>Editing <span class='muted'>Video</span></h2>
<br>

<?php echo render('video/_form'); ?>
<p>
	<?php echo Html::anchor('video/view/'.$video->id, 'View'); ?> |
	<?php echo Html::anchor('video', 'Back'); ?></p>
